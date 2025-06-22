<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityLog;

class UserController extends Controller
{
    public function index(Request $request){
        $query = User::whereNotIn('role', [1]);
        
        if ($request->has('search') && $search = $request->search) {
         
            $query->where(function ($q) use ($search) {
                $q ->orWhere('m_name', 'LIKE', "%{$search}%")
                ->orWhere('f_name', 'LIKE', "%{$search}%")
                  ->orWhere('l_name', 'LIKE', "%{$search}%")
                  ->orWhere('username', 'LIKE', "%{$search}%");
            });
        }
        $users = $query->paginate(10);
   
        return view('users.index', compact('users'));
   
    }
    public function create(){
        return view('users.create');
    }
    public function store(Request $request)
    {
        try {
            $user = new User();
            $user->f_name = $request->f_name;
            $user->m_name = $request->m_name;
            $user->l_name = $request->l_name;
            $user->date_birth = $request->date_birth;
            $user->civil_Status = $request->civil_Status;
            $user->gender = $request->gender;
            $user->location = $request->location;
            $user->phone_no = $request->phone_no;
            // $user->role = $request->role;
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
    
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads'), $filename);
                $user->image = 'uploads/' . $filename;
            }
            else{
                $user->image = 'No image uploaded';
            }
            $user->save();
           
            return redirect()->route('users/index')->with('success', 'User created successfully.');
        } catch (\Exception $e) {
          
            return back()->with('error', 'User creation failed: ' . $e->getMessage());
        }
    }
    public function edit($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
    
        return view('users.edit', compact('user'));
    }
    public function show($id)
    {
        // dd($id);
        $user = DB::table('users')->where('id', $id)->first();
    
        return view('users.details', compact('user'));
    }
    public function update(Request $request)
    {
        $user = User::findOrFail($request->user_id);
    
        $user->f_name = $request->f_name;
        $user->m_name = $request->m_name;
        $user->l_name = $request->l_name;
        $user->date_birth = $request->date_birth;
        $user->civil_status = $request->civil_status;
        $user->gender = $request->gender;
        $user->location = $request->location;
        $user->phone_no = $request->phone_no;
        // $user->role = $request->role;
        $user->username = $request->username;
    
        if ($request->hasFile('image')) {
             $file = $request->file('image');
                $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads'), $filename);
                $user->image = 'uploads/' . $filename;
        } else {
            $user->image = $user->image;
        }
    
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
      
        $user->save();
       
        return redirect()->route('users/index')->with('success', 'User updated successfully!');
    }
    public function delete($id){
        return view('confirm-delete', ['id'=> $id]);
    }

    public function hardDelete($id){
        try{
            $user = User::findOrFail($id);
            $user->delete();
           
            return redirect()->route('users/index')->with('success', 'User Deleted Successfully!');
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json(['error' => 'User not found'], 404);
        }
        catch(\Exception $e){
            return response()->json(['error'=> 'An error occured while deleting the user'], 500);
        }
    } 
    
}
