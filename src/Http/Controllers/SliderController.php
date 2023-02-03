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
use Webdoot\Lcms\Http\Requests\SliderCreateRequest;
use Webdoot\Lcms\Http\Requests\SliderUpdateRequest;
use Webdoot\Lcms\Lcms;

class SliderController extends Controller
{
    public function index()
    {
        $d['slides'] = Article::where('type', 'slider')->latest()->get();
        return view('lcms::slider.index', $d);
    }

    
    public function create()
    {
        return view('lcms::slider.create');
    }

    
    public function store(SliderCreateRequest $req)
    {
        $data['title'] = $req->title;
        $data['content'] = $req->slides ? json_encode($req->slides) : null;

        // ------ mandatory fields ------
        $data['category_id'] = 1;
        $data['owner_id'] = Auth::id();
        $data['type'] = 'slider';
        // ---- end mandatory fields ----

        $article = Article::create($data);
        $article->code = 's_'. $article->id ;
        $article->save();

        return redirect()->route('lcms_slider.index')->with('flash_success', 'Slider created.');

    }

    
    public function show($id)
    {
        $d['slide'] = Article::where('type', 'slider')->find($id);
        return view('lcms::slider.show', $d);
    }

    
    public function edit($id)
    {
        $d['slide'] = Article::where('type', 'slider')->find($id);
        return view('lcms::slider.edit', $d);
    }

    
    public function update(SliderUpdateRequest $req, $id)
    {
        $data['title'] = $req->title;
        $data['content'] = $req->slides ? json_encode($req->slides) : null;
        Article::find($id)->update($data);

        return back()->with('flash_success', 'Slider updated.');
    }

    
    public function destroy($id)
    {
        // if not App admin
        if(!Lcms::isAdmin()) return back()->withErrors(['User is not authorised...']);

        Article::destroy($id);

        return back()->with('flash_success', 'Slider deleted.');
    }
}
