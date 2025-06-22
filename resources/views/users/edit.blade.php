@extends('layouts.app')

@section('content')
<div class="app-main__outer">
    <div class="app-main__inner">
        <section class="content">
            <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    <h2 class="card-title">  <i class="fa fa-plus"></i> Add New Users </h2>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <!-- Personal Information Section -->
                                <input type="hidden" name="user_id" id="user_id" value="{{ $user->id}}">
                                <p class="text-success"><i class="fa fa-user"></i> Personal Information</p>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>First Name</label> <span class="text-danger">*</span>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                </div>
                                                <input type="text" class="form-control" id="f_name" name="f_name" placeholder="Enter First Name" value="{{ old('f_name', $user->f_name) }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Middle Name -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Middle Name</label> <small class="text-black-50">Optional</small>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                </div>
                                                <input type="text" class="form-control" id="m_name" name="m_name" placeholder="Enter Middle Name" value="{{ old('m_name', $user->m_name) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Last Name -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Last Name</label> <span class="text-danger">*</span>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                </div>
                                                <input type="text" class="form-control" id="l_name" name="l_name" placeholder="Enter Last Name" value="{{ old('l_name', $user->l_name) }}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                                <!-- Date of Birth, Civil Status, Gender, and Location -->
                                <div class="row">
                                    <!-- Date of Birth -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Date of Birth</label> <span class="text-danger">*</span>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                </div>
                                                <input type="date" class="form-control" id="date_birth" name="date_birth" value="{{ old('date_birth', $user->date_birth) }}" required>
                                            </div>
                                        </div>
                                    </div>
                            
                                    <!-- Civil Status -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Civil Status</label> <span class="text-danger">*</span>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                </div>
                                                <select name="civil_status" class="form-control" id="civil_status" required>
                                                    <option value="Single" {{ old('civil_status', $user->civil_status) == 'Single' ? 'selected' : '' }}>Single</option>
                                                    <option value="Widowed" {{ old('civil_status', $user->civil_status) == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                                                    <option value="Divorced" {{ old('civil_status', $user->civil_status) == 'Divorced' ? 'selected' : '' }}>Divorced</option>
                                                    <option value="Married" {{ old('civil_status', $user->civil_status) == 'Married' ? 'selected' : '' }}>Married</option>
                                                    <option value="Separated" {{ old('civil_status', $user->civil_status) == 'Separated' ? 'selected' : '' }}>Separated</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                            
                                    <!-- Gender -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Gender</label> <span class="text-danger">*</span>
                                            <div class="d-flex align-items-center">
                                                <div class="form-check mr-3">
                                                    <input type="radio" class="form-check-input" id="male" name="gender" value="male" {{ old('gender', $user->gender) == 'male' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="male">Male</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="female" name="gender" value="female" {{ old('gender', $user->gender) == 'female' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="female">Female</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                                <!-- Phone Number, Location, Role -->
                                <div class="row">
                                    <!-- Phone Number -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Phone Number</label> <small class="text-black-50">Optional</small>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                                </div>
                                                <input type="text" class="form-control" id="phone_no" name="phone_no" placeholder="Enter Phone Number" value="{{ old('phone_no', $user->phone_no) }}">
                                            </div>
                                        </div>
                                    </div>
                            
                                    <!-- Location -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Location</label> <span class="text-danger">*</span>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-location"></i></span>
                                                </div>
                                                <input type="text" class="form-control" id="location" name="location" placeholder="Enter Location" value="{{ old('location', $user->location) }}" required>
                                            </div>
                                        </div>
                                    </div>
                            
                                    <!-- Role -->
                                    {{-- <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Role</label> <span class="text-danger">*</span>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-cog"></i></span>
                                                </div>
                                                <select name="role" class="form-control" id="role" required>
                                                    <option value="0" {{ old('role', $user->role) == '0' ? 'selected' : '' }}>Users</option>
                                                    <option value="2" {{ old('role', $user->role) == '2' ? 'selected' : '' }}>Farmers</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                            
                                <!-- Account Information Section -->
                                <p class="text-success"><i class="fa fa-user"></i> Account Information</p>
                                <div class="row">
                                    <!-- Username -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Username</label> <span class="text-danger">*</span>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                </div>
                                                <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" value="{{ old('username', $user->username) }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Password</label> <span class="text-danger">*</span>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                                </div>
                                                <input type="password" class="form-control" id="password" name="password" required placeholder="Enter Username">
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="col-md-4">
                                        <div class="d-flex flex-column align-items-center justify-content-center">
                                            <div class="upload-container">
                                                <img class="img-fluid rounded-circle avatar-fit" id="avatarImage"  src="{{ $user->image ? asset($user->image) : asset('assets/images/avatars/12.jpg') }}" alt="User Profile Image">
                                                <style>
                                                    .avatar-fit {
                                                        width: 80px;
                                                        height: 80px;
                                                        object-fit: cover; 
                                                        border-radius: 50%;
                                                        border: 2px solid #ccc;
                                                    }
    
                                                </style>
                                            </div>
                                            <input type="file" id="image" name="image" style="display: none;" accept="image/png, image/gif, image/jpeg">
    
                                            <input type="hidden" name="image" class="image-tag">
                                            <button type="button" class="btn btn-info upload-image-btn rounded-circle mt-2 mb-2" onclick="uploadImage()"><i class="fa fa-camera"></i></button>
                                      
                                        </div>
                                        <div class="alert alert-secondary text-center text-white"> Need to Upload Image  </div>
                                        <script>
                                            function uploadImage() {
                                                document.getElementById('image').click();
                                            }
                                        
                                            document.getElementById('image').addEventListener('change', function(event) {
                                                const selectedImage = event.target.files[0];
                                                if (selectedImage) {
                                                    const avatarImage = document.getElementById('avatarImage');
                                                    avatarImage.src = URL.createObjectURL(selectedImage);
                                                }
                                            });
                                        
                                        </script>
                                  </div>
                                    
                                </div>
                                <div class="card-footer d-flex justify-content-between">
                                <a href="{{ route('users/index')}}" class="btn btn-secondary" style="margin-left:70%;width:20%"><i class="fa fa-undo"></i> Back</a>
                                    <button type="submit" class="btn btn-primary" style="margin-left:2%;width:20%"><i class="fa fa-edit"></i> Update</button>
                                </div>
                                </form>                   
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </section>
    </div>
   
@endsection