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
use Webdoot\Lcms\Models\Category;
use Illuminate\Support\Facades\Auth;
use Webdoot\Lcms\Lcms;

class CategoryController extends Controller
{
    public function index()
    {
        $d['category'] = Category::get();
        return view('lcms::category.index', $d);
    }

    
    public function create()
    {
        // if not App admin
        if(!Lcms::isUser()) return back()->withErrors(['User is not authorised...']); 
       
        return view('lcms::category.create');
    }

    
    public function store(Request $req)
    {   
        // if not App admin
        if(!Lcms::isUser()) return back()->withErrors(['User is not authorised...']);

        // validate
        $req->validate([
            'name'         => 'required|string',     
            'description'  => 'nullable|string',
            'action'       => 'required|in:category',
        ]);

        $data =  $req->only(['name', 'description']); 

        // create category
        $category = Category::create($data);

        return redirect()->route('lcms_category.edit', $category->id)->with('flash_success', 'Category created.');        
    }

    
    public function show($id)
    {
        $d['category'] = Category::find($id);
        return view('lcms::category.show', $d);
    }

    
    public function edit($id)
    {
        $d['category'] = Category::find($id);     
        return view('lcms::category.edit', $d);
    }

    
    public function update(Request $req, $id)
    {
        // if not App admin
        if(!Lcms::isUser()) return back()->withErrors(['User is not authorised...']);

        // validate
        $req->validate([
            'name'         => 'required|string',     
            'description'  => 'nullable|string',
            'action'       => 'required|in:category',
        ]);

        $data =  $req->only(['name', 'description']); 

        // update
        Category::find($id)->update($data);        

        return back()->with('flash_success', 'Category updated.');
    }

    
    public function destroy($id)
    {
        // if not App admin
        if(!Lcms::isUser()) return back()->withErrors(['User is not authorised...']);

        if ($id != 1) {
            Category::destroy($id);
            return back()->with('flash_success', 'Category deleted.');
        }
        
        return back()->with('flash_error', 'Category not deleted.');
        
    }
}
