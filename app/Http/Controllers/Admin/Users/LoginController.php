<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function getLogin(){
        return view('admin.users.login', [
            'title' => 'Đăng Nhập Hệ Thống'
        ]);
    }
    

    public function postLogin(Request $request){
        // Validate login credentials
        $request->validate([
            'email' => 'required|email:filter',
            'password' => 'required',
        ]);

        // Attempt to log in the user
        if (Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ], $request->input('remember'))) {
            
            // Check if the user is authenticated
            if (Auth::check()) {
                $user = Auth::user(); // Get the currently authenticated user

                // Check user role and redirect accordingly
                if ($user->role === '1') { // Admin
                    return redirect()->route('main'); // Redirect to admin main page
                } elseif ($user->role === '0') { // Regular user
                    return redirect()->route('home'); // Redirect to user dashboard
                }
            }
        }

        // If authentication fails, redirect back with an error message
        Session::flash('error', 'Email hoặc Password không đúng');
        return redirect()->route('getLogin'); // Redirect to the login page
    }   


    public function getLogout(){
        Auth::logout();
        return redirect()->route('getLogin');
    }
    
}


