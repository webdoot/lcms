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
use Webdoot\Lcms\Http\Requests\MenuCreateRequest;
use Webdoot\Lcms\Http\Requests\MenuUpdateRequest;
use Webdoot\Lcms\Lcms;

class MenuController extends Controller
{
    public function index()
    {
        // dd(Article::find(9)->content_json);

        $d['menus'] = Article::where('type', 'menu')->latest()->get();
        return view('lcms::menu.index', $d);
    }

    
    public function create()
    {
        return view('lcms::menu.create');
    }

    
    public function store(MenuCreateRequest $req)
    {
        $data['title'] = $req->title;
        $data['content'] = json_encode($req->menu);

        // ------ mandatory fields ------
        $data['category_id'] = 1;
        $data['owner_id'] = Auth::id();
        $data['type'] = 'menu';
        // ---- end mandatory fields ----

        $article = Article::create($data);
        $article->code = 'm_'. $article->id ;
        $article->save();

        return redirect()->route('lcms_menu.index')->with('flash_success', 'Menu created.');

    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        // if not App admin
        if(!Lcms::isAdmin()) return back()->withErrors(['User is not authorised...']);

        Article::destroy($id);

        return back()->with('flash_success', 'Menu deleted.');
    }
}
