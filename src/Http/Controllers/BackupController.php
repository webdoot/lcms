<?php

/*
 |---------------------------------------------------
 | LARVEL CONTENT MANAGEMENT SYSTEM (LCMS)
 | WEBDOOT SOFTWARE DEVELOPEMT 
 |---------------------------------------------------
 */

namespace Webdoot\Lcms\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Webdoot\Lcms\Models\Article;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Webdoot\Lcms\Lcms;

class BackupController extends Controller
{
    private $backup_folder = 'lcms_backup';     // storage/app/

    private $backup_comment;             // backup comment for version comparison

    // tables, sequence is important
    private $tables = [ 'lcms_categories', 'lcms_articles', 'lcms_tags', 'lcms_article_tags', 'lcms_media', 'lcms_settings' ];

    public function __construct()
    {
        // if not App admin
        if(!Lcms::isUser()) return back()->withErrors(['User is not authorised...']);

        // set timezone
        date_default_timezone_set('Asia/Kolkata');

        // $this->backup_comment = 'LCMSBKP_APPVER_'. config('lcms.app_ver'). '_DBVER_'. config('lcms.app_db');
    }


    /**
     * LIST backup page
     */
    public function index()
    {
        $items = array_reverse(Storage::listContents($this->backup_folder)); 
        $backups = [];
        foreach ($items as $file) {
            // only zip files are taken
            if ($file['type'] == 'file' && $file['extension'] == 'zip') {
                $file['id'] = $this->extractId($file['basename']);
                $file['name'] = $this->extractName($file['basename']);
                $file['date'] = date('d-m-Y H:i', strtotime($file['id']));
                $backups[] = $file;
            }            
        }
        $d['backups'] = $backups;

        return view('lcms::backup.index', $d);
    }


    /**
     * CREATE backup
     */
    public function create(Request $req)
    { 
        // validate
        $req->validate([
            'name'         => 'required|string|max:50', 
            'action'       => 'required|in:createbackup',
        ]);

        // take backup
        if ($this->backup($req->name)) {
             return back()->with('flash_success', 'Backup created.'); 
         } 

        return back()->with('flash_error', 'Backup not created.'); 
    }


    /**
     * UPLOAD backup
     */
    public function store(Request $req)
    {   
        // validate
        $req->validate([
            'bkpfile'      => 'required|file|mimes:zip|max:50000',  
            'action'       => 'required|in:createbackup',
        ]);

        if($req->hasFile('bkpfile')) {            
            // file info
            $file = $req->file('bkpfile');

            // check backup file authenticity
            if(! $this->isLcmsBackup($file)) {
                return back()->with('flash_error', 'File is not Lcms backup or corrupt');
            }

            $org_name = $file->getClientOriginalName();
            $name = str_replace(' ', '-', pathinfo($org_name, PATHINFO_FILENAME));
            $ext = strtolower(pathinfo($org_name, PATHINFO_EXTENSION));

            // folder info : store- storage/app/lcms_backup
            $folder = $this->backup_folder ;
            $file_name= substr($name, 0, 40). '-(upload).'. $ext ;

            // upload
            if ($file->move(storage_path('app/'. $folder), $file_name)) {                
                return back()->with('flash_success', 'Backup uploaded.');                
            }
            
            return back()->with('flash_error', 'Backup not uploaded.');            
        }             
    }


    /**
     * DOWNLOAD file
     */
    public function edit(Request $req, $id)
    {
        // validate
        $req->validate([
            'name' => 'required|string|max:80'
        ]);

        $file = storage_path('app/'. $this->backup_folder. '/'. $req->name);
        return response()->download($file);
    }


    /**
     * RESTORE backup
     */
    public function show(Request $req, $id)
    {
        // validate
        $req->validate([
            'name' => 'required|string|max:80'
        ]);

        // ----------- --- Make Auto Backup ----------
        $this->backup('Auto backup');
        // ---------------- End Auto Backup -----------

        // ------------------ Unzip ------------------
        $bkp_file_path = storage_path('app/'. $this->backup_folder. '/'. $req->name) ;
        $unzip_dir_path = storage_path('app/'. $this->backup_folder. '/'. Str::beforeLast($req->name, '.')) ;

        // Zip conversion : unzip into storage/app/lcms_backup/(zip filename as foldername)
        $zip = new \ZipArchive();               
        if ($zip->open($bkp_file_path, \ZipArchive::RDONLY)== TRUE)
        {
            $zip->extractTo($unzip_dir_path);
            $zip->close(); 
        }
        // ------------------- End Unzip ---------------

        // Unzipped backup folder location
        $unzip_dir = $this->backup_folder. '/'. Str::beforeLast($req->name, '.') ;

        // Get all backup files
        $files = Storage::listContents($unzip_dir);

        // delete records in reverse order due to foreign key constraint.
        foreach (array_reverse($this->tables) as $table) {          
            DB::table($table)->delete();
        }

        // insert records into table
        foreach ($this->tables as $table) {                 
            $records = Storage::get($unzip_dir. '/'. $table. '.bkp') ;           
            foreach (json_decode($records) as $record) {
                DB::table($table)->insert((array) $record);
            }
        }

        // copy "lcms_uploads" into public path
        \File::copyDirectory( $unzip_dir_path. '/'. config('lcms.storage'), public_path(config('lcms.storage')));

        // copy "view" into public path
        \File::copyDirectory( $unzip_dir_path. '/'. 'view', base_path('resources/views'));

        // copy "controller" into public path
        \File::copyDirectory( $unzip_dir_path. '/'. 'controller', base_path('app/Http/Controllers'));

        // copy "model" into public path
        \File::copyDirectory( $unzip_dir_path. '/'. 'model', base_path('app/Models'));

        return back()->with('flash_success', 'Backup restored.'); 
    }


    /**
     * DELETE file
     */
    public function destroy(Request $req, $id)
    {   
        // validate
        $req->validate([
            'name' => 'required|string|max:80'
        ]);

        // check right file is selected
        if ($this->extractId($req->name) != $id) {
            return back()->with('flash_error', 'Un-authorised action.'); 
        }

        $location = $this->backup_folder. '/'. $req->name ;

        if (Storage::delete($location)) { 
            if (Storage::exists(Str::beforeLast($location, '.'))) {
                // if exist unzipped folder: delete
                Storage::deleteDirectory(Str::beforeLast($location, '.'));
            }    
            return back()->with('flash_success', 'Backup deleted.');
        }
        return back()->with('flash_error', 'Backup not deleted.');        
    }  


    /**
     * Add files to zip archive
     * $source_folder: folder which content to be taken.
     * $dest_folder: folder in zip archive in which content to be paste. If not $source_folder
     *      is taken into account.
     */
    protected function addToZip(&$zip_obj, $source_path, $source_folder, $dest_folder='')
    {          
        $source_items = glob($source_path. '/*');
        foreach ($source_items as $key => $value){ 
            if (is_dir($value)) {
                $this->addToZip($zip_obj, $value, $source_folder, $dest_folder);
            } 
            else {
                $dest_folder = $dest_folder ? $dest_folder. '/' : '';                
                $pos = strpos($value, $source_folder);
                $zip_obj->addFromString($dest_folder. substr($value, $pos), file_get_contents($value));
            }            
        }               
    }


    /**
     * Backup creator
     * @param backup name
     */
    protected function backup($bkp_name)
    {
        // Backup zip filename
        $datetime = date('YmdHi');
        $folder = $this->backup_folder. '/'. $datetime. '_'. str_replace(' ', '-', $bkp_name) ;

        $backup_file_path =storage_path('app/'. $folder. '.zip');

        // Zip conversion
        $zip = new \ZipArchive();                
        if ($zip->open($backup_file_path, \ZipArchive::CREATE)== TRUE)
        {   
            // add table data to zip archive
            foreach ($this->tables as $table) {
                $filename = $table. '.bkp';            
                // table columns name
                $columns = Schema::getColumnListing($table);
                // table data        
                $records = DB::table($table)->get()->toArray();  
                // add to zip archive
                $zip->addFromString($filename, json_encode($records));
            }

            // add storage(uploads) dir to zip archive
            $upload_path = public_path(config('lcms.storage'));
            if (file_exists($upload_path)) {
                $this->addToZip($zip, $upload_path, basename($upload_path));
            }

            // add views/fontend dir to zip archive
            $view_path = base_path('resources/views/frontend');
            if (file_exists($view_path)) {
                $this->addToZip($zip, $view_path, basename($view_path), 'view');
            } 

            // add Controllers/frontend dir to zip archive
            $controller_path = base_path('app/Http/Controllers/Frontend');
            if (file_exists($controller_path)) {
                $this->addToZip($zip, $controller_path, basename($controller_path), 'controller');
            } 

            // add Models/fronend dir to zip archive
            $model_path = base_path('app/Models/Frontend');
            if (file_exists($model_path)) {
                $this->addToZip($zip, $model_path, basename($model_path), 'model');
            }

            // Use for version compatibility test
            // $zip->setArchiveComment($this->backup_comment);

            // close zip archive to save 
            $zip->close();
            return true;
        }
        return false;
    }


    /**
     * Make id of file
     * @param string
     */
    protected function extractId($filename)
    {
        return substr($filename, 0, 12);
    }


    /**
     * Make name human redable 
     * @param string
     */
    protected function extractName($filename) 
    {
        $filename = substr($filename, 13);
        $filename = Str::beforeLast($filename, '.');
        return str_replace('-', ' ', $filename);
    }


    /**
     * Checku whether supplied file is Lcms backup file
     * @param file
     */
    protected function isLcmsBackup($file)
    {   
        // check file name pattern
        $id = substr($file->getClientOriginalName(), 0, 12);
        $seprator = substr($file->getClientOriginalName(), 12, 1);
        if (!is_numeric($id) || $seprator != '_') {
            return false;
        }

        // check files into zip archive
        $zip = new \ZipArchive();
        if ($zip->open($file, \ZipArchive::RDONLY)== TRUE)
        {   
            // get all files from zip archive
            $files=[];
            for ($i = 0; $i < $zip->numFiles; $i++) {
                $files[] = $zip->getNameIndex($i);
            }

            // compare zip archive
            foreach ($this->tables as $table) {
                $filename = $table. '.bkp';     

                if (!in_array($filename, $files)) {
                     return false;
                 } 
            }

            return true; 
        }
    }
    
}
