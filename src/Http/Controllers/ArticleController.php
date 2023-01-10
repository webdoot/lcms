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
use Webdoot\Lcms\Http\Requests\ArticleUpdateRequest;
use Webdoot\Lcms\Models\Article;
use Webdoot\Lcms\Models\Media;
use Illuminate\Support\Facades\Auth;
use Webdoot\Lcms\Lcms;

class ArticleController extends Controller
{
    public function index()
    {
        $d['articles'] = Article::where('type', 'article')->latest()->get();
        return view('lcms::article.index', $d);
    }

    
    public function create()
    {
        // if not App admin
        if(!Lcms::isAdmin()) return back()->withErrors(['User is not authorised...']); 

        $d['medias'] = Media::latest()->get();       
        return view('lcms::article.create', $d);
    }

    
    public function store(ArticleCreateRequest $req)
    {   
        // if not App admin
        if(!Lcms::isAdmin()) return back()->withErrors(['User is not authorised...']);

        // Article data
        $article =  $req->only(['title', 'sub_title', 'label', 'content', 'sub_content', 'media']);

        // ----- mandatory fields ------
        $article['category_id'] = 1;
        $article['owner_id'] = Auth::id();
        $article['type'] = 'article';
        // ---- end mandatory fields ----

        // Meta
        if (!empty($req->meta_keys[0])) {
            foreach ($req->meta_keys as $key => $value) {             
                if ($value) { 
                    $meta[$value] = $req->meta_vals[$key] ?: '';  
                }
            }                
        $article['meta'] = $meta ;
        }
        
        $article['published_at'] = now();

        // create article
        $article = Article::create($article);

        // update code
        $article->code = 'a_'. $article->id ;
        $article->save();

        return redirect()->route('lcms_article.edit', $article->id)->with('flash_success', 'Article created.');        
    }

    
    public function show($id)
    {
        $d['article'] = Article::find($id);
        return view('lcms::article.show', $d);
    }

    
    public function edit($id)
    {
        $d['article'] = Article::find($id);
        $d['medias'] = Media::latest()->get();       
        return view('lcms::article.edit', $d);
    }

    
    public function update(ArticleUpdateRequest $req, $id)
    {
        // Article data
        $article =  $req->only(['title', 'sub_title', 'label', 'content', 'sub_content', 'media']);

        // Meta
        if (!empty($req->meta_keys[0])) {
            foreach ($req->meta_keys as $key => $value) {             
                if ($value) { 
                    $meta[$value] = $req->meta_vals[$key] ?: '';  
                }
            }                
        $article['meta'] = $meta ;
        }
        
        // update
        Article::find($id)->update($article);

        return back()->with('flash_success', 'Article updated.');
    }

    
    public function destroy($id)
    {
        // if not App admin
        if(!Lcms::isAdmin()) return back()->withErrors(['User is not authorised...']);

        Article::destroy($id);

        return back()->with('flash_success', 'Article deleted.');
    }
}
