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
use Webdoot\Lcms\Http\Requests\GalleryCreateRequest;
use Webdoot\Lcms\Http\Requests\GalleryUpdateRequest;
use Webdoot\Lcms\Lcms;

class GalleryController extends Controller
{
    public function index()
    {
        $d['gallery'] = Article::where('type', 'gallery')->latest()->get();
        return view('lcms::gallery.index', $d);
    }

    
    public function create()
    {
        return view('lcms::gallery.create');
    }

    
    public function store(GalleryCreateRequest $req)
    {
        $data['title'] = $req->title;

        $data['content'] = json_encode($req->gallery);

        // ------ mandatory fields ------
        $data['category_id'] = 1;
        $data['owner_id'] = Auth::id();
        $data['type'] = 'gallery';
        // ---- end mandatory fields ----

        $article = Article::create($data);
        $article->code = 'g_'. $article->id ;
        $article->save();

        return redirect()->route('lcms_gallery.index')->with('flash_success', 'Gallery created.');

    }

    
    public function show($id)
    {
        $d['gallery'] = Article::where('type', 'gallery')->find($id);
        return view('lcms::gallery.show', $d);
    }

    
    public function edit($id)
    {
        $d['gallery'] = Article::where('type', 'gallery')->find($id);
        return view('lcms::gallery.edit', $d);
    }

    
    public function update(GalleryUpdateRequest $req, $id)
    {
        $data['title'] = $req->title;
        $data['content'] = json_encode($req->gallery);
        Article::find($id)->update($data);

        return back()->with('flash_success', 'Gallery updated.');
    }

    
    public function destroy($id)
    {
        // if not App admin
        if(!Lcms::isAdmin()) return back()->withErrors(['User is not authorised...']);

        Article::destroy($id);

        return back()->with('flash_success', 'Gallery deleted.');
    }
}
