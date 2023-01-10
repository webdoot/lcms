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
use Webdoot\Lcms\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Webdoot\Lcms\Lcms;

class TagController extends Controller
{
    public function index()
    {
        $d['tags'] = Tag::get();
        return view('lcms::tag.index', $d);
    }

    
    public function create()
    {
        // if not App admin
        if(!Lcms::isUser()) return back()->withErrors(['User is not authorised...']); 
       
        return view('lcms::tag.create');
    }

    
    public function store(Request $req)
    {   
        // if not App admin
        if(!Lcms::isUser()) return back()->withErrors(['User is not authorised...']);

        // validate
        $req->validate([
            'name'         => 'required|string',     
            'description'  => 'nullable|string',
            'action'       => 'required|in:tag',
        ]);

        $data =  $req->only(['name', 'description']); 

        // create category
        $tag = Tag::create($data);

        return redirect()->route('lcms_tag.edit', $tag->id)->with('flash_success', 'Tag created.');        
    }

    
    public function show($id)
    {
        $d['tag'] = Tag::find($id);
        return view('lcms::tag.show', $d);
    }

    
    public function edit($id)
    {
        $d['tag'] = Tag::find($id);     
        return view('lcms::tag.edit', $d);
    }

    
    public function update(Request $req, $id)
    {
        // if not App admin
        if(!Lcms::isUser()) return back()->withErrors(['User is not authorised...']);

        // validate
        $req->validate([
            'name'         => 'required|string',     
            'description'  => 'nullable|string',
            'action'       => 'required|in:tag',
        ]);

        $data =  $req->only(['name', 'description']); 

        // update
        Tag::find($id)->update($data);        

        return back()->with('flash_success', 'Tag updated.');
    }

    
    public function destroy($id)
    {
        // if not App admin
        if(!Lcms::isUser()) return back()->withErrors(['User is not authorised...']);

        Tag::destroy($id);
        
        return back()->with('flash_success', 'Tag deleted.');
        
    }
}
