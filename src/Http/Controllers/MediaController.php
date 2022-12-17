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
use Webdoot\Lcms\Models\Media;
use Webdoot\Lcms\Lcms;

class MediaController extends Controller
{
    public function index(Request $req)
    {
        // Both normal(sidebar link) & ajax request(select header)
        // validate
        $req->validate([
            'type' => 'sometimes|required|string|in:all,photo,video,pdf,doc',
        ]);

        if ($req->type == 'photo') {
            $d['medias'] = Media::whereIn('ext', config('lcms.media_types.photo'))->latest()->get();
        }
        elseif ($req->type == 'video') {
            $d['medias'] = Media::whereIn('ext', config('lcms.media_types.video'))->latest()->get();
        }
        elseif ($req->type == 'pdf') {
            $d['medias'] = Media::whereIn('ext', config('lcms.media_types.pdf'))->latest()->get();
        }
        elseif ($req->type == 'doc') {
            $d['medias'] = Media::whereIn('ext', config('lcms.media_types.doc'))->latest()->get();
        }
        else {
            $d['medias'] = Media::latest()->get();
        }
        return view('lcms::media.index', $d);
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $req)
    {
        // Ajax opration from Dropzone
        if($req->hasFile('media_file')) {            
            // file info
            $file = $req->file('media_file');
            $org_name = $file->getClientOriginalName();
            $name = str_replace(' ', '-', pathinfo($org_name, PATHINFO_FILENAME));
            $ext = strtolower(pathinfo($org_name, PATHINFO_EXTENSION));

            // folder info : store- public/lcms_uploads
            $folder = config('lcms.storage'). '/'. date('Y'). '/'. date('m-d');
            $file_name= substr($name, 0, 25).'-'.time().'.'.$ext;

            // upload
            if ($file->move(public_path($folder),$file_name)) {
                // update db
                $media = new Media;
                $media->name = $file_name;
                $media->url = '/'. $folder. '/'. $file_name;
                $media->ext = $ext;
                // owner details
                $media->user_id = Auth::id();
                $media->save();
                
                return response()->json(['success'=>$file_name]);
            }
            
            return response()->json(['error'=>'Unexpected error occured...']);            
        }        
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        // Ajax request from model for image attribute edit
        return response()->json(['id'=>$id]);
    }

    
    public function update(Request $request, $id)
    {
        // Ajax request from model
        // return response()->json(['id'=>$id]);
    }

    
    public function destroy($id)
    {
        //
    }
}
