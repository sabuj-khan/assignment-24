<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    function userDashboard():View{
        return view('pages.dashboard.user-dashboard-page');
    }
}
