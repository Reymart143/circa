<div id="toast-container" class="toast-top-right" style="position: fixed; top: 20px; right: 20px; z-index: 9999;"></div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('success'))
            showToast(`{!! session('success') !!}`, 'success');
        @elseif(session('error'))
            showToast(`{!! session('error') !!}`, 'error');
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

    
<div class="app-header header-shadow" style="background-color: white;color:black;">
            <div class="app-header__logo">
                @php
                $preference = \App\Models\UserPreference::first();
                $logoPath = $preference && $preference->logo
                    ? asset($preference->logo)
                    : asset('assets/images/OroSMap.png');
            @endphp
            
            <img class="img-fluid rounded-circle nav-fit mr-1" id="avatar-Image" src="{{ $logoPath }}" alt="System Logo">
             eMenu Express
            
            <style>
                .nav-fit {
                    width: 50px;
                    height: 50px;
                    object-fit: cover;
                    border-radius: 50%;
                    border: 2px solid #ccc;
                }
            </style>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar" >
                            <span class="hamburger-box">
                                <span class="hamburger-inner" ></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="app-header__mobile-menu " >
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav" >
                        <span class="hamburger-box" >
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>

            <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>

            <div class="app-header__content">
                <div class="app-header-left">
                    {{-- <div class="search-wrapper">
                        <div class="input-holder">
                            <input type="text" class="search-input" placeholder="Type to search">
                            <button class="search-icon"><span></span></button>
                        </div>
                        <button class="close"></button>
                    </div> --}}
                </div>
                <div class="app-header-right">
              
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="btn-group">
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                          
                                             <img width="42" class="rounded-circle navprofilepic"
                                              src="{{ Auth::user()->image ? asset('profilepic/' . Auth::user()->image) : asset('assets/images/avatars/12.jpg') }}"
                                                                   >
                                            <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true" class="rm-pointers dropdown-menu-lg dropdown-menu dropdown-menu-right">
                                            <div class="dropdown-menu-header">
                                                <div class="dropdown-menu-header-inner bg-info">
                                                    <div class="menu-header-image opacity-2" style="background-image: url('../assets/images/dropdown-header/city3.jpg');"></div>
                                                    <div class="menu-header-content text-left">
                                                        <div class="widget-content p-0">
                                                            <div class="widget-content-wrapper">
                                                                <div class="widget-content-left mr-3">
                                                                    <img class="navprofilepic" id="navprofilepic"
                                                                    src="{{ Auth::user()->image ? asset('profilepic/' . Auth::user()->image) : asset('assets/images/avatars/12.jpg') }}"
                                                                    alt="No Picture Uploaded">
                                                                </div>
                                                                <div class="widget-content-left">
                                                                    <div class="widget-heading">   {{ Auth::user()->f_name ?? '' }}    {{ Auth::user()->m_name ?? ''}}    {{ Auth::user()->l_name ?? '' }}
                                                                    </div>
                                                                </div>
                                                                <div class="widget-content-right mr-2">
                                                                    <button id="logoutBtn" class="btn-pill btn-shadow btn-shine btn btn-focus">Logout</button>
                                                                
                                                                    <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                                        @csrf
                                                                    </form>
                                                                </div>
                                                                <script>
                                                                    document.getElementById('logoutBtn').addEventListener('click', function (e) {
                                                                        e.preventDefault();
                                                                
                                                                        Swal.fire({
                                                                            title: 'Are you sure?',
                                                                            text: "You will be logged out.",
                                                                            icon: 'warning',
                                                                            showCancelButton: true,
                                                                            confirmButtonText: 'Yes, logout',
                                                                            cancelButtonText: 'Cancel',
                                                                            reverseButtons: true,
                                                                            buttonsStyling: false,
                                                                            customClass: {
                                                                                confirmButton: 'btn btn-success mx-2', 
                                                                                cancelButton: 'btn btn-danger mx-2'    
                                                                            }
                                                                        }).then((result) => {
                                                                            if (result.isConfirmed) {
                                                                                document.getElementById('logoutForm').submit();
                                                                            }
                                                                        });
                                                                    });
                                                                </script>
                                                                <style>
                                                                    .navprofilepic {
                                                                        width: 50px;
                                                                        height: 50px;
                                                                        object-fit: cover; 
                                                                     
                                                                        border: 2px solid #ccc;
                                                                    }
            
                                                                 </style>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                       
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content-left ml-3 header-user-info">
                                    <div class="">
                                        {{ Auth::user()->f_name ?? '' }}
                                    </div>
                                    <div>
                                        @if(optional(Auth::user())->role == 1)
                                            <span class="badge badge-primary">Admin</span>
                                        @else
                                            <span class="badge badge-info">CASHIER</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- MAIN BODY -->
