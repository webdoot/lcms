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
use Webdoot\Lcms\Http\Requests\PostCreateRequest;
use Webdoot\Lcms\Http\Requests\PostUpdateRequest;
use Webdoot\Lcms\Models\Article;
use Webdoot\Lcms\Models\Media;
use Webdoot\Lcms\Models\Category;
use Webdoot\Lcms\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Webdoot\Lcms\Lcms;

class PostController extends Controller
{
    public function index()
    {
        $d['posts'] = Article::where('type', 'post')->latest()->get();
        return view('lcms::post.index', $d);
    }

    
    public function create()
    {
        // if not App admin
        if(!Lcms::isAdmin()) return back()->withErrors(['User is not authorised...']); 

        $d['medias'] = Media::latest()->get();       
        $d['categories'] = Category::get();       
        $d['tags'] = Tag::get();       
        return view('lcms::post.create', $d);
    }

    
    public function store(PostCreateRequest $req)
    {
        // if not App user
        if(!Lcms::isUser()) return back()->withErrors(['User is not authorised...']); 

        // Article data
        $data =  $req->only(['title', 'sub_title', 'content', 'media', 'category_id']);

        // ----- mandatory fields ------
        $data['owner_id'] = Auth::id();
        $data['type'] = 'post';
        // ---- end mandatory fields ----

        // Meta
        if (!empty($req->meta_keys[0])) {
            foreach ($req->meta_keys as $key => $value) {             
                if ($value) { 
                    $meta[$value] = $req->meta_vals[$key] ?: '';  
                }
            }                
        $data['meta'] = $meta ;
        }
        
        $data['published_at'] = now();

        // create post
        $article = Article::create($data);

        // update relation
        $article->tags()->attach($req->tags);

        // update code
        $article->code = 'p_'. $article->id ;
        $article->save();

        return redirect()->route('lcms_post.edit', $article->id)->with('flash_success', 'Post created.');        
    }

    
    public function show($id)
    {
        $d['post'] = Article::find($id);
        return view('lcms::post.show', $d);
    }

    
    public function edit($id)
    {
        $d['post'] = Article::find($id);
        $d['categories'] = Category::get();
        $d['tags'] = Tag::get();
        $d['medias'] = Media::latest()->get();       
        return view('lcms::post.edit', $d);
    }

    
    public function update(PostUpdateRequest $req, $id)
    {
        // Article data
        $data =  $req->only(['title', 'sub_title', 'content', 'media', 'category_id']);

        // Meta
        if (!empty($req->meta_keys[0])) {
            foreach ($req->meta_keys as $key => $value) {             
                if ($value) { 
                    $meta[$value] = $req->meta_vals[$key] ?: '';  
                }
            }                
        $data['meta'] = $meta ;
        }
        
        // update
        $article = Article::find($id);
        $article->update($data);

        // update relation
        $article->tags()->detach();
        $article->tags()->attach($req->tags);

        return back()->with('flash_success', 'Article updated.');
    }

    
    public function destroy($id)
    {
        // if not App admin
        if(!Lcms::isAdmin()) return back()->withErrors(['User is not authorised...']);

        $article = Article::find($id);
        $article->tags()->detach();
        $article->delete();

        return back()->with('flash_success', 'Article deleted.');
    }
}
