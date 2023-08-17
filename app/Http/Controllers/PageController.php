<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    function userLoginPage():View{
        return view('pages.auth.login-page');
    }

    function userRegistrationPage():View{
        return view('pages.auth.register-page');
    }

    function sendOtpToEmail():View{
        return view('pages.auth.sendotp-page');
    }

    function otpVerificationforpass():View{
        return view('pages.auth.otp-verify-page');
    }

    function resetUseerPassword():View{
        return view('pages.auth.password-reset-page');
    }

    function userLogout(){
        return redirect('/loginPage')->cookie('token', '', -1);
    }


    function userProfilePage():View{
        return view('pages.dashboard.user-profile-page');
    }


    function eventCategoryPage():View{
        return view('pages.dashboard.event-category-page');
    }

    function eventPageShow():View{
        return view('pages.dashboard.event-page');
    }

    function taskPageShow():View{
        return view('pages.dashboard.tasks-page');
    }


}
