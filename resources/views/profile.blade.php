@extends('layouts.app')
@section('content')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="card-shadow-primary profile-responsive card-border mb-3 card" >
                    <div class="dropdown-menu-header" >
                        <div class="dropdown-menu-header-inner bg-blue  " >
                         
                            <div class="menu-header-content btn-pane-right">
                                <div class="avatar-icon-wrapper mr-2 avatar-icon-xl">
                                    {{-- <div class="avatar-icon rounded overflow-hidden">
                                        <img class="img-fluid avatar-fit"  
                                             src="{{ Auth::user()->image ? asset(Auth::user()->image) : asset('assets/images/avatars/12.jpg') }}" 
                                             alt="User Avatar" id="profilePicture">
                                             
                                    </div>
                                    <input type="file" id="image" name="image" style="display: none;" accept="image/png, image/gif, image/jpeg">
    
                                    <input type="hidden" name="image" class="image-tag">
                                    <button type="button" class="btn btn-info upload-image-btn rounded-circle mt-2 mb-2" onclick="profile_modal()"><i class="fa fa-camera"></i></button>
                                     --}}
                                    <form action="{{ route('user/upload/update') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                            <div class="col-md-12">
                                              
                                                <input type="hidden" name="profilepic_id" id="profilepic_id" value="{{ Auth::user()->id }}">
                                                <div class="d-flex flex-column align-items-center justify-content-center">
                                                    <div class="upload-container">
                                                        
                                                    <img class="img-fluid rounded-circle profileImages-fit" id="profileImages"
                                                    src="{{ Auth::user()->image ? asset('profilepic/' . Auth::user()->image) : asset('assets/images/avatars/12.jpg') }}"
                                                    alt="No Picture Uploaded">


                                                        <style>
                                                            .profileImages-fit {
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
                       
                                                <script>
                                                    function uploadImage() {
                                                        document.getElementById('image').click();
                                                    }
                                                
                                                    document.getElementById('image').addEventListener('change', function(event) {
                                                        const selectedImage = event.target.files[0];
                                                        if (selectedImage) {
                                                            const avatarImage = document.getElementById('profileImages');
                                                            avatarImage.src = URL.createObjectURL(selectedImage);
                                                        }
                                                    });
                                                
                                                </script>
                                                <button type="submit" class="btn btn-primary"> Upload Now</button>
                                        </div>
                                     </form>
                             
                                       <script>
                                    $(document).ready(function () {
                                        $('[data-toggle="tooltip"]').tooltip({
                                            template: '<div class="tooltip larger-tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>',
                                            html: true
                                        });
                                    });
                                </script>
                                
                                <style>
                                    .larger-tooltip .tooltip-inner {
                                        max-width: 300px; 
                                        font-size: 16px; 
                                    }
                                </style>
                                    
                                    @php
                                        $themeColor = Auth::user()->preference->system_color ?? '#4CAF50';

                                        $hex = str_replace('#', '', $themeColor);
                                        $r = hexdec(substr($hex, 0, 2));
                                        $g = hexdec(substr($hex, 2, 2));
                                        $b = hexdec(substr($hex, 4, 2));

                                        $luminance = (0.299 * $r + 0.587 * $g + 0.114 * $b);
                                        $textColor = $luminance > 186 ? '#000000' : '#FFFFFF'; 
                                        @endphp
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
                                   <style>
                                        .bg-blue{
                                            background-color: {{ $themeColor }};
                                            color: {{ $textColor }};
                                            border-color: {{ $themeColor }};
                                        }
                                        .bg-orange{
                                            background-color:orangered;
                                            color: white;
                                        }
                                  
                                    </style>
                                    
                                </div>
                                <div>
                                    <h5 class="menu-header-title">{{ Auth::user()->f_name}} {{ Auth::user()->m_name}} {{ Auth::user()->l_name}}</h5>
                                    <h6 class="menu-header-subtitle">  
                                        @if(Auth::user()->role == 0)
                                        Users
                                        @elseif(Auth::user()->role == 1)
                                        Administrator
                                        @else
                                        Farmers
                                        @endif
                                    </h6>
                                </div>
                            
                            </div>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="p-0 list-group-item">
                            <div class="card-body">
                                <form action="{{ route('users.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                
                                    <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                              
                                    <div class="row">
                                        <!-- LEFT COLUMN: Personal Info -->
                                        <div class="col-md-6">
                                            <p class="text-success"><i class="fa fa-user"></i> Personal Information</p>
                                    
                                            <!-- First Name -->
                                            <div class="form-group">
                                                <label>First Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="f_name" value="{{ old('f_name', Auth::user()->f_name) }}" required>
                                            </div>
                                    
                                            <!-- Middle Name -->
                                            <div class="form-group">
                                                <label>Middle Name <small class="text-black-50">Optional</small></label>
                                                <input type="text" class="form-control" name="m_name" value="{{ old('m_name', Auth::user()->m_name) }}">
                                            </div>
                                    
                                            <!-- Last Name -->
                                            <div class="form-group">
                                                <label>Last Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="l_name" value="{{ old('l_name', Auth::user()->l_name) }}" required>
                                            </div>
                                    
                                            <!-- Date of Birth -->
                                            <div class="form-group">
                                                <label>Date of Birth <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control" name="date_birth" value="{{ old('date_birth', Auth::user()->date_birth) }}" required>
                                            </div>
                                    
                                            <!-- Civil Status -->
                                            <div class="form-group">
                                                <label>Civil Status <span class="text-danger">*</span></label>
                                                <select name="civil_status" class="form-control" required>
                                                    @php $status = Auth::user()->civil_status; @endphp
                                                    <option value="Single" {{ old('civil_status', $status) == 'Single' ? 'selected' : '' }}>Single</option>
                                                    <option value="Widowed" {{ old('civil_status', $status) == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                                                    <option value="Divorced" {{ old('civil_status', $status) == 'Divorced' ? 'selected' : '' }}>Divorced</option>
                                                    <option value="Married" {{ old('civil_status', $status) == 'Married' ? 'selected' : '' }}>Married</option>
                                                    <option value="Separated" {{ old('civil_status', $status) == 'Separated' ? 'selected' : '' }}>Separated</option>
                                                </select>
                                            </div>
                                    
                                            <!-- Gender -->
                                            <div class="form-group">
                                                <label>Gender <span class="text-danger">*</span></label><br>
                                                @php $gender = Auth::user()->gender; @endphp
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="gender" value="male" {{ old('gender', $gender) == 'male' ? 'checked' : '' }}>
                                                    <label class="form-check-label">Male</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="gender" value="female" {{ old('gender', $gender) == 'female' ? 'checked' : '' }}>
                                                    <label class="form-check-label">Female</label>
                                                </div>
                                            </div>
                                    
                                            <!-- Phone Number -->
                                            <div class="form-group">
                                                <label>Phone Number <small class="text-black-50">Optional</small></label>
                                                <input type="text" class="form-control" name="phone_no" value="{{ old('phone_no', Auth::user()->phone_no) }}">
                                            </div>
                                    
                                            <!-- Location -->
                                            <div class="form-group">
                                                <label>Location <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="location" value="{{ old('location', Auth::user()->location) }}" required>
                                            </div>
                                        </div>
                                    
                                        <!-- RIGHT COLUMN: Account Info -->
                                        <div class="col-md-6">
                                            <p class="text-success"><i class="fa fa-lock"></i> Account Information</p>
                                    
                                            <!-- Username -->
                                            <div class="form-group">
                                                <label>Username <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="username" value="{{ old('username', Auth::user()->username) }}" required>
                                            </div>
                                    
                                            <!-- Current Password -->
                                            {{-- <div class="form-group">
                                                <label>Current Password <span class="text-danger">*</span></label>
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Current Password">
                                            </div>
                                    
                                            <!-- New Password -->
                                            <div class="form-group">
                                                <label>New Password <small class="text-black-50">Optional</small></label>
                                                <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter New Password">
                                            </div>
                                    
                                            <!-- Confirm Password -->
                                            <div class="form-group">
                                                <label>Confirm Password <small class="text-black-50">Optional</small></label>
                                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm New Password">
                                            </div> --}}
                                             
                                        <div class="form-group row password-fields" style="display: none;">
                                            <label for="inputOldPassword" class="col-sm-3 col-form-label">Old Password</label>
                                            <div class="col-sm-6">
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Old Password">
                                            </div>
                                        </div>
                                        <div class="form-group row password-fields" style="display: none;">
                                            <label for="inputNewPassword" class="col-sm-3 col-form-label">New Password</label>
                                            <div class="col-sm-6">
                                                <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter New Password">
                                            </div>
                                        </div>
                                        <div class="form-group row password-fields" style="display: none;">
                                            <label for="inputConfirmPassword" class="col-sm-3 col-form-label">Confirm Password</label>
                                            <div class="col-sm-6">
                                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Re-Enter Password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10" style="display: flex;">
                                                <button type="button" class="btn btn-danger change-password">Change Password</button>
                                                <button type="button" class="btn btn-danger hide-password" style="display: none;">Hide Password Field</button>
                                                <button type="button" class="btn btn-shadow btn-gradient-alternate" id="save_btn" style="margin-left:10px;">Save Changes</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    
                                    {{-- <!-- Submit Button -->
                                    <div class="card-footer d-flex justify-content-between">
                                        <button type="button" id="upload_btn" class="btn btn-success float-end" style="width: 20%;"><i class="fa fa-edit"></i> Update Changes</button>
                                    </div> --}}
                                    
                                </form>
                                      
                            </div>


                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
   {{-- UPDATE PFOFILE PICTURE MODAL --}}
<div class="modal fade" id="updateImageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content edit-content">
        <div class="modal-header" >
            <h5 class="modal-title" id="updateImageModalLabel" style="margin-left:15px; margin-top: 5px;"><i class=" fa fa-gallery fa-image"></i> Update Profile Picture</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div id="user_upload"></div>
            <div class="modal-body">
                <input type="file" accept="image/*" id="image" name="image" style="display: none;">
                <input type="hidden"  name="image" class="image-tag">
                <button style="width: 100%;height:100%" class="btn btn-secondary">
                <label for="image" class="profile-btn">
                <div style="cursor: pointer;margin-top:10%;margin-left:10%"> <i class="fa-regular fa-image fa-3x"></i></div> Click to open gallery </label>
                </button>
            </div>
        
            <div class="modal-footer" style="border-top: 1px solid #ccc;">
            <button type="button" id="upload_btn" class="btn btn-primary" style="margin-top: -6px;">Update</button>
            </div>
        </div>
    </div>
  </div>
<script>
 const saveBtn = document.querySelector('#save_btn');
    saveBtn.addEventListener('click', () => {
        const first_name = document.querySelector('input[name="f_name"]').value;
        const middle_name = document.querySelector('input[name="m_name"]').value;
        const last_name = document.querySelector('input[name="l_name"]').value;
        const date_birth = document.querySelector('input[name="date_birth"]').value;
        const civil_status = document.querySelector('select[name="civil_status"]').value;
        const gender = document.querySelector('input[name="gender"]:checked')?.value || '';
        const phone_no = document.querySelector('input[name="phone_no"]').value;
        const location = document.querySelector('input[name="location"]').value;
        const username = document.querySelector('input[name="username"]').value;
      
        const oldPasswordField = document.getElementById("password");
        const newPasswordField = document.getElementById("new_password");
        const confirmPasswordField = document.getElementById("confirm_password");
        const newPasswordValue = newPasswordField.value;
        const confirmPasswordValue = confirmPasswordField.value;
        const confirmError = document.getElementById('confirm-password-error');
    
        if (newPasswordValue !== confirmPasswordValue) {
            if (confirmError) {
                confirmError.style.display = 'block';
                confirmError.textContent = 'Password does not match!';
            }
            if (confirmPasswordField) {
                confirmPasswordField.classList.add('is-invalid');
            }
            setTimeout(() => {
                if (confirmError) {
                    confirmError.style.display = 'none';
                    confirmError.textContent = '';
                }
                if (confirmPasswordField) {
                    confirmPasswordField.classList.remove('is-invalid');
                }
            }, 5000);
            return;
        }
    
        const formData = new FormData();
        formData.append('f_name', first_name);
        formData.append('m_name', middle_name);
        formData.append('l_name', last_name);
        formData.append('date_birth', date_birth);
        formData.append('civil_status', civil_status);
        formData.append('gender', gender);
        formData.append('phone_no', phone_no);
        formData.append('location', location);
        formData.append('username', username);
        formData.append('password', oldPasswordField.value);
        formData.append('new_password', newPasswordField.value);
    
    
        $.ajax({
            url: "/profile/update",
            method: "POST",
            processData: false,
            contentType: false,
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                $('#password').val('');
                $('#new_password').val('');
                $('confirm_password').val('');
                Swal.fire({
                    title: 'Successfully Updated',
                    text: 'All the changes are now updated',
                    icon: 'sucess',
                });
            },
            error: function (data) {
                const errorMessage = data.responseJSON.message;
                const passwordError = document.getElementById('password-error');
                const passwordField = document.getElementById('password');
    
                if (passwordError) {
                    passwordError.style.display = 'block';
                    passwordError.textContent = errorMessage;
                }
                if (passwordField) {
                    passwordField.classList.add('is-invalid');
                }
    
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errorMessage,
                });
    
                setTimeout(function () {
                    if (passwordError) {
                        passwordError.style.display = 'none';
                        passwordError.textContent = '';
                    }
                    if (passwordField) {
                        passwordField.classList.remove('is-invalid');
                    }
                    Swal.close();
                }, 5000);
            }
        });
    });
</script>

{{-- UPDATE BUTTON AND FUNCTION OF THE PROFILE PICTURE --}}
<script>
    function profile_modal(){
        $('#updateImageModal').appendTo('body').modal('show');
        $('#updateImageModal').modal('show');
        $('[data-toggle="popover"]').popover();

        $(document).ready(function() {

            $('.profile-btn').on('click', function(e) {
                e.preventDefault();
                
                $('#image').trigger('click');
            });
            
            $('#image').on('change', function (e) {
                var filesSelected = document.getElementById('image').files[0];
                var reader = new FileReader();
                reader.readAsDataURL(filesSelected);

                reader.onload = function () {
                    console.log(reader.result)
                    $(".image-tag").val(reader.result);
                    $('#profilePicture').attr('src', reader.result);
                }
            });

            const profileBtn = document.querySelector('#upload_btn');

            profileBtn.addEventListener('click', () => {
                const image = document.querySelector('.image-tag').value; 

                $.ajax({
                    url: "/user/upload/update",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    data: {
                        image: image,
                    },
                    success: function (data) {
                        setTimeout(function() {
                            resultSection.innerHTML = ''; 
                            $('#updateImageModal').modal('hide'); 
                        }, 2000);

                        const alertHTML = '<div class="alert alert-success small-alert" role="alert" style="background-color:green;color:white; border-radius: 0;">' + data.message + '</div>';
                        const resultSection = document.getElementById('user_upload');
                        resultSection.innerHTML = alertHTML;
                        
                        for (let i = 0; i < displayElements.length; i++) {
                            displayElements[i].textContent = inputElements[i].value;
                        }                       
                    },
                    error: function (data) {
                        Swal.fire({
                            title: 'ERROR',
                            text: 'An error occured upon changing your profile picture',
                            icon: 'error',
                        });
                    }
                });
            });
        });
    }
</script>

{{-- HIDDEN PASSWORD FIELDS AND BUTTON --}}
<script>
    document.querySelector('.change-password').addEventListener('click', function () {
        document.querySelectorAll('.password-fields').forEach(function (element) {
            element.style.display = 'flex';
        });
        this.style.display = 'none';
        document.querySelector('.hide-password').style.display = 'block';
    });

    document.querySelector('.hide-password').addEventListener('click', function () {
        document.querySelectorAll('.password-fields').forEach(function (element) {
            element.style.display = 'none';
        });
        this.style.display = 'none';
        document.querySelector('.change-password').style.display = 'block';
    });

</script>
@endsection