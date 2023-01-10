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
use Webdoot\Lcms\Models\Article;
use Webdoot\Lcms\Models\Media;
use Webdoot\Lcms\Models\Category;
use Webdoot\Lcms\Models\Tag;

class DashboardController extends Controller
{
 	public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function dashboard()
    {
        $article = Article::get();
        $d['article'] = $article->where('type', 'article')->count();
        $d['menu'] = $article->where('type', 'menu')->count();
        $d['slider'] = $article->where('type', 'slider')->count();
        $d['gallery'] = $article->where('type', 'gallery')->count();
        $d['post'] = $article->where('type', 'post')->count();

        $d['media'] = Media::get()->count();
        $d['category'] = Category::get()->count();
        $d['tag'] = Tag::get()->count();
        return view('lcms::dashboard.index', $d);
    }
    

    // Redirect on /dashboard
    public function dashboardRedirect()
    { 
        return redirect()->route('lcms_dashboard');
    }
}
