@extends('layouts.app')

@section('content')
<div class="app-main__outer">
    <div class="app-main__inner">
        <section class="content">
            <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="ml-3">
                                <a href="{{ route('users/index')}}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Back</a>
                        </div>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <div class="row justify-content-center">
                            
                                    <!-- Profile Picture -->
                                    <div class="col-md-3 text-center">
                                        <img class="img-fluid avatar-fit" id="avatarImage"  src="{{ $user->image ? asset($user->image) : asset('assets/images/avatars/12.jpg') }}" alt="User Profile Image">
                                                <style>
                                                    .avatar-fit {
                                                        width: 270px;
                                                        height: 340px;
                                                        object-fit: cover; 
                                                      
                                                        border: 2px solid #ccc;
                                                    }
    
                                                </style>
                                    </div>
                            
                                    <!-- Personal and Account Details -->
                                    <div class="col-md-9">
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <h5 class="text-success mb-3"><i class="fa fa-user"></i> Personal Details</h5>
                                                <p><strong>Full Name:</strong> {{ $user->f_name }} {{ $user->m_name }} {{ $user->l_name }}</p>
                                                <p><strong>Position:</strong> POS USER</p>
                                                <p><strong>Date of Birth:</strong> {{ $user->date_birth }}</p>
                                                <p><strong>Civil Status:</strong> {{ $user->civil_status }}</p>
                                                <p><strong>Gender:</strong> {{ $user->gender }}</p>
                                                <p><strong>Location:</strong> {{ $user->location }}</p>
                                                <p><strong>Phone Number:</strong> {{ $user->phone_no }}</p>
                                            </div>
                                        </div>
                            
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="text-primary mb-3"><i class="fa fa-user-circle"></i> Account Details</h5>
                                                <p><strong>Username:</strong> {{ $user->username }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              
                            </div>             
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </section>
    </div>
   
@endsection