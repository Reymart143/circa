<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>POS SYSTEM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="msapplication-tap-highlight" content="no">

    <link rel="stylesheet" href="../assets/css/base.min.css">
    <!-- In your <head> -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

</head>

<body>
<div class="app-container app-theme-white body-tabs-shadow h-100">
    <div id="toast-container" class="toast-top-right" style="position: fixed; top: 20px; right: 20px; z-index: 9999;"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if(session('success'))
                showToast("{{ session('success') }}", 'success');
            @elseif(session('error'))
                showToast("{{ session('error') }}", 'error');
            @endif
        });

        function showToast(message, type) {
            const toastContainer = document.getElementById('toast-container');
            const toast = document.createElement('div');
            toast.className = 'toast toast-' + type;
            toast.innerHTML = '<div class="toast-message">' + message + '</div>';
            toastContainer.appendChild(toast);
            setTimeout(() => {
                toast.remove();
            }, 4000);
        }
    </script>
    <div class="app-container h-100">
        <div class="h-100">
            <div class="h-100 no-gutters row">
                <!-- Slider Section -->
                <div class="d-none d-lg-block col-lg-6 h-100">
                    <div class="slider-light">
                        <div class="slick-slider">
                             <!-- Slide 3 -->
                            <div>
                                <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-sunny-morning" tabindex="-1">
                                    <div class="slide-img-bg" style="background-image: url('../assets/images/carosel.png');"></div>
                                    <div class="slider-content">
                                        <h3>POS SYSTEM</h3>
                                        <p>Track your sales product using technology</p>
                            
                                    </div>
                                </div>
                            </div>
                            <!-- Slide 1 -->
                            {{-- <div>
                                <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-plum-plate" tabindex="-1">
                                    <div class="slide-img-bg" style="background-image: url('../assets/images/originals/crop1.jpg');"></div>
                                    <div class="slider-content">
                                        <h3>Growing Strong Together</h3>
                                        <p>With sustainable practices, agriculture can drive communities forward while preserving the environment for future generations.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Slide 2 -->
                            <div>
                                <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-premium-dark" tabindex="-1">
                                    <div class="slide-img-bg" style="background-image: url('../assets/images/originals/crop2.jpg');"></div>
                                    <div class="slider-content">
                                        <h3>Innovation in Agriculture</h3>
                                        <p>Empowering farmers with the tools and knowledge to increase productivity while maintaining ecological balance.</p>
                                    </div>
                                </div>
                            </div> --}}
                           
                        </div>
                    </div>
                    <script>
                        $(document).ready(function(){
                            $('.slick-slider').slick({
                                dots: true,
                                arrows: true,
                                infinite: true,
                                speed: 500,
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                adaptiveHeight: true,
                            });
                        });
                    </script>
                </div>

                <!-- Login Form Section -->
                <div class="h-100 d-flex bg-white justify-content-center align-items-center col-md-12 col-lg-6">
                    <div class="mx-auto app-login-box col-md-8">
                        <div class="app-logo-inverse mx-auto mb-3"></div>
                        <div class="modal-dialog w-100 mx-auto">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="h5 modal-title text-center">
                                        <h4 class="mt-2">
                                            @php
                                            $preference = \App\Models\UserPreference::first();
                                            $logoPath = $preference && $preference->logo
                                                ? asset($preference->logo)
                                                : asset('assets/images/OroSMap.png');
                                        @endphp
                                        
                                        <img class="img-fluid avatar-fit" id="avatarImage" src="{{ $logoPath }}" alt="System Logo">
                                        
                                        <style>
                                            .avatar-fit {
                                                width: 150px;
                                                height: 100px;
                                                object-fit: cover; 
                                                border-radius: 10%;
                                                border: 2px solid #ccc;
                                            }
                                        </style>
                                        
                                        
                                            <style>
                                                .badge {
                                                    text-transform: none !important;
                                                }
                                            </style>
                                        </h4>
                                        <span class="badge badge-success text-white">LOGIN PORTAL</span>
                                    </div>
                                    <form id="loginForm" method="POST">
                                        @csrf
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <label for="username" class="fa fa-user"> Username</label>
                                                <div class="position-relative form-group">
                                                    <input name="username" id="username" placeholder="Input Username here..." type="text" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="password" class="fa fa-lock"> Password</label>
                                                <div class="position-relative form-group">
                                                    <input name="password" id="password" placeholder="Input Password here..." type="password" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="float-right">
                                            <button class="btn btn-shadow btn-gradient-primary btn-lg" type="submit">Log in</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="text-center text-white opacity-8 mt-3">Copyright © ArchitectUI 2019</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $('#loginForm').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: "{{ route('login.submit') }}",
            method: "POST",
            data: $(this).serialize(),
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Login successful!',
                        text: 'Redirecting to dashboard...',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = response.redirect;
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Login failed',
                        text: response.message
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: 'Something went wrong. Please try again.'
                });
            }
        });
    });
</script>
</body>
</html>
