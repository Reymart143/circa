<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
<<<<<<< HEAD

=======
use DB;
use Illuminate\Support\Facades\Hash;
>>>>>>> ba3da6ef301860262896a0370b6d45bdf4309bd5
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
<<<<<<< HEAD
            Session()->put(['isLogin'=>1]);
            return response()->json([
                'success' => true,
                'redirect' => route('Dashboard'),
            ]);   
=======
            if($user->role == 1){
                Session()->put(['isLogin'=>1]);
                return response()->json([
                    'success' => true,
                    'redirect' => route('Dashboard'),
                ]); 
            }elseif($user->role == 0){
                Session()->put(['isLogin'=>1]);
                return response()->json([
                    'success' => true,
                    'redirect' => route('menu'),
                ]); 
            }
              
>>>>>>> ba3da6ef301860262896a0370b6d45bdf4309bd5
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
<<<<<<< HEAD
=======
    public function RegisterView(){
        return view('auth.register');
    }
    public function RegisterStore(Request $request){

        $user = DB::table('users')->insert([
            'f_name'   => $request->f_name,
            'l_name'   => $request->l_name,
            'm_name'   => $request->m_name,
            'gender'   => $request->gender,
            'location' => $request->location,
            'date_birth' => $request->date_birth,
            'phone_no' => $request->phone_no,
            'username' => $request->username,
            'role'     => '0',
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('/')->with('success', 'User created successfully.');
    }
>>>>>>> ba3da6ef301860262896a0370b6d45bdf4309bd5
}