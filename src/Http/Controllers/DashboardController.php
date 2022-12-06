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

class DashboardController extends Controller
{
 	public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function dashboard()
    {
        return view('lcms::dashboard');
    }
    

    // Redirect on /dashboard
    public function dashboardRedirect()
    { 
        return redirect()->route('lcms_dashboard');
    }
}
