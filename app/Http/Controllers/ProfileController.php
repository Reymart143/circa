<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function profile(){
        return view('profile'); 
    }
       public function userUpdate(Request $request){
        
        $user = Auth::user();
        $first_name = $request->input('f_name');
        $middle_name = $request->input('m_name');
        $last_name = $request->input('l_name');
        $date_birth = $request->input('date_birth');
        $civil_status = $request->input('civil_status');
        $gender = $request->input('gender');
        $phone_no = $request->input('phone_no');
        $location = $request->input('location');
        $username = $request->input('username');
        $password = $request->input('password');
        $new_password = $request->input('new_password'); 

        $update_info = [
            'f_name'    => $first_name,
            'm_name'   => $middle_name,
            'l_name'     => $last_name,
            'date_birth'    => $date_birth,
            'civil_status'  => $civil_status,
            'gender'        => $gender,
            'phone_no'      => $phone_no,
            'location'      => $location,
            'username'      => $username,
        ];

        $newPassword = $request->input('new_password');
        if(!empty($newPassword)){
            if(!Hash::check($request->input('password'), $user->password)){
                return response()->json(['message' => 'Old password is incorrect'], 400);
            }

            $update_info['password'] = Hash::make($newPassword);
        }

        $profile_update = DB::table('users')
            ->where('id', $user->id)
            ->update($update_info);

        if($profile_update > 0){
            return response()->json(['message'=>'Profile update successfully!']);
        }else{
            return response()->json(['message'=>'User not found']);
        }
    }

    
    public function imageUpdate(Request $request)
    {
    
        if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('profilepic'), $filename);
                $request->image = 'profilepic/' . $filename;
            }
            else{
                return redirect()->back()->with('error', 'Please select new image');
            }
     
        DB::table('users')
            ->where('id', $request->profilepic_id)
            ->update(['image' => $filename]);
    
         return redirect()->back()->with('success', ' Profile Pic Updated successfully.');
    }
}
