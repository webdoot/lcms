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
use Webdoot\Lcms\Http\Requests\ArticleCreateRequest;
use Webdoot\Lcms\Models\Article;
use Illuminate\Support\Facades\Auth;
use Webdoot\Lcms\Lcms;

class ArticleController extends Controller
{
    public function index()
    {
        // dd(Lcms::isAdmin());

        $d['articles'] = Article::where('type', 'article')->latest()->get();
        return view('lcms::article.index', $d);
    }

    
    public function create()
    {
        // if not App admin
        if(!Lcms::isAdmin()) return back()->withErrors(['User is not authorised...']);        
        return view('lcms::article.create');
    }

    
    public function store(ArticleCreateRequest $req)
    {   
        // dd($req->all());

        // if not App admin
        if(!Lcms::isAdmin()) return back()->withErrors(['User is not authorised...']);

        // Article data
        $article =  $req->only(['title', 'sub_title', 'label', 'content', 'sub_content']);

        $article['category_id'] = 1;
        $article['owner'] = ["user_id"=>Auth::id(), "role"=>""];
        $article['type'] = 'article';

        // Meta
        if (!empty($req->meta_keys[0])) {
            foreach ($req->meta_keys as $key => $value) {             
                if ($value) { 
                    $metas[$value] = $req->meta_vals[$key] ?: '';  
                }
            }                
        }
        $article['metas'] = $metas ;
        
        $article['status'] = 'published';   // published|draft
        $article['published_at'] = now();

        Article::create($article);
        return back()->with('flash_success', 'Article published.');
        
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        dd('here');
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        dd('here2');
    }
}
