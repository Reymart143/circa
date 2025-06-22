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
                            <form action="{{ route('users.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                            <p class="text-success"><i class="fa fa-user"></i> Personal Information</p>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>First Name</label> <span class="text-danger">*</span>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                            </div>
                                            <input type="text" class="form-control" id="f_name" name="f_name" placeholder="Enter First Name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Middle Name</label>  <small class="text-black-50">Optional</small>

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                            </div>
                                            <input type="text" class="form-control" id="m_name" name="m_name" placeholder="Enter Middle Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Last Name</label> <span class="text-danger">*</span>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                            </div>
                                            <input type="text" class="form-control" id="l_name" name="l_name" placeholder="Enter Last Name" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Date of Birth</label> <span class="text-danger">*</span>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            <input type="date" class="form-control" id="date_birth" name="date_birth" required>
                                        </div>
                                    </div>
                                    <script>
                                        document.getElementById('date_birth').addEventListener('change', function() {
                                            var inputDate = new Date(this.value);
                                            var currentDate = new Date();
                                            var age = currentDate.getFullYear() - inputDate.getFullYear();
                                            var m = currentDate.getMonth() - inputDate.getMonth();
                                            if (m < 0 || (m === 0 && currentDate.getDate() < inputDate.getDate())) {
                                                age--;
                                            }

                                            if (age < 15) {
                                                Swal.fire({
                                                    title: 'Invalid Date of Birth!',
                                                    text: 'You must be at least 15 years old.',
                                                    icon: 'error',
                                                    confirmButtonText: 'Ok'
                                                });
                                                this.value = ''; 
                                            }
                                        });
                                        </script>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Civil Status</label> <span class="text-danger">*</span>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                            </div>
                                            <select name="civil_status" class="form-control" id="civil_status" required>
                                                <option >Select Civil Status</option>
                                                <option value="Single">Single</option>
                                                <option value="Widowed">Widowed</option>
                                                <option value="Divorced">Divorced</option>
                                                <option value="Married">Married</option>
                                                <option value="Separated">Separated</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Gender</label> <span class="text-danger">*</span>
                                        <div class="input-group">
                                         
                                            <div class="d-flex align-items-center">
                                                <div class="form-check mr-3">
                                                    <input type="radio" class="form-check-input" id="male" name="gender" value="male">
                                                    <label class="form-check-label" for="male">Male</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="female" name="gender" value="female">
                                                    <label class="form-check-label" for="female">Female</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Location</label> <span class="text-danger">*</span>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-location"></i></span>
                                            </div>
                                            <input type="text" class="form-control" id="location" name="location" placeholder="Enter First Name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Phone Number</label>  <small class="text-black-50">Optional</small>

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                            </div>
                                            <input type="text" class="form-control" id="phone_no" name="phone_no" placeholder="Enter Middle Name">
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Role</label> <span class="text-danger">*</span>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-cog"></i></span>
                                            </div>
                                            <select name="role" class="form-control" id="role" required>
                                                <option >Select Role</option>
                                                <option value="0">Users</option>
                                                <option value="2">Farmers</option>
                                            </select>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                            <p class="text-success"><i class="fa fa-user"></i> Account Information</p>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Username</label> <span class="text-danger">*</span>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                            </div>
                                            <input type="text" class="form-control" id="username" name="username" required placeholder="Enter Username">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Password</label> <span class="text-danger">*</span>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                            </div>
                                            <input type="password" class="form-control" id="password" name="password" required placeholder="Enter Username">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex flex-column align-items-center justify-content-center">
                                        <div class="upload-container">
                                            <img class="img-fluid rounded-circle userimage-fit" id="userImage" src="{{ asset('assets/images/avatars/12.jpg') }}" alt="Image">
                                            <style>
                                                .userimage-fit {
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
                                                const avatarImage = document.getElementById('userImage');
                                                avatarImage.src = URL.createObjectURL(selectedImage);
                                            }
                                        });
                                    
                                    </script>
                              </div>
                                
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                            <a href="{{ route('users/index')}}" class="btn btn-gradient-dark btn-dark btn-shadow-dark" style="margin-left:70%;width:20%"><i class="fa fa-undo"></i> Back</a>
                                <button type="submit" class="btn btn-primary" style="margin-left:2%;width:20%"><i class="fa fa-plus"></i> Create</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </section>
    </div>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#save_staff_btn').on('click', function(e){
          e.preventDefault(); 
          
          var f_name = $('#f_name').val().trim();
          var m_name = $('#m_name').val().trim();
          var l_name = $('#l_name').val().trim();
          var username = $('#username').val().trim();
          var location = $('#location').val().trim();
          var gender = $('input[name="gender"]:checked').val();
          var date_birth = $('#date_birth').val().trim();
          var civil_status = $('#civil_status').val().trim();
          var role = $('#role').val();
          var image = $('.image-tag').val().trim();
          var password = $('#password').val().trim();
        //   var confirmPassword = $('#confirmPassword').val().trim();
        //   var errors = false;
      
          // Validation checks
        //   if (first_name === '') {
        //       $('#first_name').addClass('is-invalid');
        //       $('#name-error').text('Please enter a name.');
        //       errors = true;
        //   } else {
        //       $('#first_name').removeClass('is-invalid');
        //       $('#name-error').text('');
        //   }if (email.trim() === '') {
        //       $('#email').addClass('is-invalid');
        //       $('#email-error').text('Please enter an employee ID.');
        //       errors = true;
        //   } else {
        //       $('#email').removeClass('is-invalid');
        //       $('#email-error').text('');
        //   }
      
        //   if (role === null) {
        //   $('#role').addClass('is-invalid');
        //   $('#role-error').text('Please select a position.');
        //   errors = true;
        //   } else {
        //   $('#role').removeClass('is-invalid');
        //   $('#role-error').text('');
        //   }
         
      
        //   if (municipality.trim() === '') {
        //   $('#municipality').addClass('is-invalid');
        //   $('#address-error').text('Please select a address.');
        //   errors = true;
        //   } else {
        //   $('#municipality').removeClass('is-invalid');
        //   $('#address-error').text('');
        //   }
      
      
      
        //   if (password.trim() === '') {
        //       $('#password').addClass('is-invalid');
        //       $('#password-error').text('Please enter a password.');
        //       errors = true;
        //   }  else if (password !== confirmPassword) {
        //       $('#password').addClass('is-invalid');
        //       $('#confirmPassword').addClass('is-invalid');
        //       $('#password-error').text('Password do not match');
        //       errors = true;
        //   } else {
        //       $('#password').removeClass('is-invalid');
        //       $('#password-error').text('');
        //   }
          
      
        //   if (errors) {
        //       Swal.fire({
        //           title: 'Register Failed',
        //           text: 'Please fill in all required fields.',
              
        //           icon: 'error',
        //       });
        //       return; 
        //   }
      
          
          var userform = {
              'id': $('#hidden_id').val(),
              'f_name': f_name,
              'm_name': m_name,
              'l_name': l_name,
              'username': username,
              'role': role,
              'civil_status': civil_status,
              'image': image,
              'location': location,
              'date_birth': date_birth,
              'gender': gender,
              'password': password
          
          }
          $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
          });
          $.ajax({
              type: 'POST',
              url: "{{ route('users.store') }}",
              data: userform,
              dataType: 'json',
              success: function(response) {
              Swal.fire({
                  position:'center',
                  icon: 'success',
                  title: 'Successfully Registered',
                  showConfirmButton: false,
                  timer: 1500
              });
              $('#avatarImage').attr('src', '{{ asset('images/avatars/12.jpgg') }}');
              $('#username').val('');
              $('#gender').val('');
              $('#civil_status').val('');
              $('#date_birth').val('');
              $('#role').val('');
            //   $('#confirmPassword').val('');
              $('#f_name').val('');
              $('#m_name').val('');
              $('#l_name').val('');
              $('#location').val('');
              $('#password').val('');
            }
          })
        });
        $('#image').on('change', function (e) {
          var filesSelected = document.getElementById('image').files[0];
          var reader = new FileReader();
          reader.readAsDataURL(filesSelected);
          reader.onload = function () {
              console.log(reader.result)
              $(".image-tag").val(reader.result);
              // $("#previewImage").attr("src", reader1.result);
          }
          });
      </script> --}}
@endsection