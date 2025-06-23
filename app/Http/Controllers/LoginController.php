<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

  
    /**
     * Where to redirect users after login.
     *
     * @var string
     */


    /**
     * Create a new controller instance.
     *
     * @return void
     */

    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }

    
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        return redirect('/'); 
    }
    
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();  
            Session()->put(['isLogin'=>1]);
            return response()->json([
                'success' => true,
                'redirect' => route('Dashboard'),
            ]);   
        }

        $user = \App\Models\User::where('username', $request->username)->first();

        if ($user) {
            \Log::error('Invalid login attempt for username: ' . $request->username);
            return response()->json([
                'success' => false,
                'message' => 'Incorrect password.',
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'User not Found!',
            ]);
        }
      
        return view('auth.login');
    }
}