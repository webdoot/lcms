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

    // tables, sequence is important
    private $tables = [ 'lcms_categories', 'lcms_articles', 'lcms_tags', 'lcms_article_tags', 'lcms_media', 'lcms_settings' ];

    public function __construct()
    {
        // if not App admin
        if(!Lcms::isUser()) return back()->withErrors(['User is not authorised...']);

        // set timezone
        date_default_timezone_set('Asia/Kolkata');
    }


    /**
     * Show backup
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
     * Create backup
     */
    public function create(Request $req)
    { 
        // validate
        $req->validate([
            'name'         => 'required|string|max:50', 
            'action'       => 'required|in:createbackup',
        ]);

        // Backup file details
        $datetime = date('YmdHi');
        $folder = $this->backup_folder. '/'. $datetime. '_'. str_replace(' ', '-', $req->name) ;          

        // Zip conversion
        $zip = new \ZipArchive();        
        $zipname = storage_path('app/'. $folder. '.zip');        
        if ($zip->open($zipname, \ZipArchive::CREATE)== TRUE)
        {   
            // add storage(uploads) dir to zip archive
            $this->addToZip($zip, public_path(config('lcms.storage')));

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

            // $zip->setArchiveComment('LCMS_BACKUP_APPVER_'. config('lcms.app_ver'). '_DBVER_'. config('lcms.app_db'));

            // close zip archive to save 
            $zip->close();
        }

        return back()->with('flash_success', 'Backup created.'); 
    }


    /**
     * Upload backup
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
     * Download file
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
     * Restore backup
     */
    public function show(Request $req, $id)
    {
        // validate
        $req->validate([
            'name' => 'required|string|max:80'
        ]);

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
        $location = $this->backup_folder. '/'. Str::beforeLast($req->name, '.') ;

        // Get all backup files
        $files = Storage::listContents($location);

        // delete records in reverse order due to foreign key constraint.
        foreach (array_reverse($this->tables) as $table) {          
            DB::table($table)->delete();
        }

        // insert records
        foreach ($this->tables as $table) {                 
            $records = Storage::get($location. '/'. $table. '.bkp') ;           
            foreach (json_decode($records) as $record) {
                DB::table($table)->insert((array) $record);
            }
        }

        return back()->with('flash_success', 'Backup restored.'); 

    }


    /**
     * Delete file
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
     */
    protected function addToZip(&$zip_obj, $source)
    {          
        $source_items = glob($source. '/*');
        foreach ($source_items as $key => $value){ 
            if (is_dir($value)) {
                $this->addToZip($zip_obj, $value);
            } 
            else {
                $pos = strpos($value, config('lcms.storage'));
                $zip_obj->addFromString(substr($value, $pos), file_get_contents($value));
            }            
        }               
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
