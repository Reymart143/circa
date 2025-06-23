@extends('layouts.app')
@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="fa fa-users icon-gradient bg-mean-fruit"></i>
                    </div>
                    <div>
                       Total Users
                        <div class="badge badge-success">{{ $total_users = App\Models\User::whereNot('role',1)->count(); }}</div>
                    </div>
                </div>
               
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h2 class="card-title"><i class="fa fa-users"></i> Users List</h2>
                            <form action="{{ route('users/index') }}" method="GET" class="form-inline d-flex">
                                <input type="text" name="search" class="form-control mr-2" placeholder="Search users..." value="{{ request('search') }}">
                                <button type="submit" class="btn btn-outline-danger mr-2">Search</button>
                                <a href="{{ route('users/index') }}" class="btn btn-outline-secondary">Clear</a>
                            </form>
                        </div>
                        
                        <div class="card-body">
                            <div class="row">
                                @foreach ($users as $user)
                                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                        <div class="card">
                                            <div class="card-header">
                                                <span class="text-success"><i class="fa fa-user"></i> {{$user->l_name}} {{$user->f_name}} {{$user->m_name}}</span>
                                                <div class="btn-group float-right">
                                                    <div class="btn-group dropdown">
                                                        <button type="button" aria-haspopup="true" data-toggle="dropdown" aria-expanded="false" class="btn-icon btn-icon-only btn btn-link">
                                                            <i class="pe-7s-menu btn-icon-wrapper"></i>
                                                        </button>
                                                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu-shadow dropdown-menu-right dropdown-menu-hover-link dropdown-menu" style="">
                                                            <h6 tabindex="-1" class="dropdown-header">Action</h6>
                                                            <a href="{{ route('users.details', $user->id) }}" type="button" tabindex="0" class="dropdown-item">
                                                                <i class="fa fa-eye mr-2"></i> Details
                                                            </a>
                                                            <a type="button"  href="{{ route('users.edit', $user->id) }}" tabindex="0" class="dropdown-item">
                                                                <i class="fa fa-edit mr-2"></i> Edit
                                                            </a>
                                                            <form class="delete-form"  method="POST" action="{{ route('users.delete', $user->id) }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" tabindex="0" class="dropdown-item delete-button">
                                                                    <i class="fa fa-trash mr-2"></i> DELETE
                                                                </button>
                                                             </form> 
                                                        </div>
                                                    </div>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        {{-- <a href="{{ route('users.show', $user->id) }}" class="dropdown-item"><i class="fa fa-eye"></i> Details</a>
                                                        <a href="{{ route('users.edit', $user->id) }}" class="dropdown-item"><i class="fa fa-edit"></i> Edit</a>
                                                        <form class="delete-form" action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="dropdown-item delete-button"><i class="fa fa-trash"></i> Delete</button>
                                                        </form> --}}
                                                        <script>
                                                            document.addEventListener('DOMContentLoaded', function() {
                                                                document.querySelectorAll('.delete-button').forEach(function(button) {
                                                                    button.addEventListener('click', function() {
                                                                        Swal.fire({
                                                                            title: 'Are you sure?',
                                                                            text: 'You will not be able to recover this data!',
                                                                            icon: 'warning',
                                                                            showCancelButton: true,
                                                                            confirmButtonColor: '#d33',
                                                                            cancelButtonColor: '#3085d6',
                                                                            confirmButtonText: 'Yes, delete it!',
                                                                            reverseButtons: true,
                                                                            buttonsStyling: false,
                                                                            customClass: {
                                                                                confirmButton: 'btn btn-primary mx-2', 
                                                                                cancelButton: 'btn btn-danger mx-2'    
                                                                            }
                                                                        }).then((result) => {
                                                                            if (result.isConfirmed) {
                                                                                button.closest('.delete-form').submit();
                                                                            }
                                                                        });
                                                                    });
                                                                });
                                                            });
                                                        </script>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body" style="height: 100%;">
                                                <div class="d-flex flex-column align-items-center justify-content-center">
                                                    <div class="upload-container">
                                                        <img id="avatarImage"
                                                             src="{{ $user->image ? asset($user->image) : $user->image  }}"
                                                             alt="No Picture Upload"
                                                             class="img-fluid rounded-circle avatar-fit">
                                                    </div>
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
                                                <p><i class="fa fa-envelope"></i> Username: {{ $user->username}}</p>
                                                <p>Position: 
                                                    @if($user->role == 2)
                                                    <span class="badge bg-info" style="font-size:4mm;color:white">Cashier
                                                    </span>
                                                 
                                                    @else
                                                    <span class="badge bg-success" style="font-size:4mm">Customer
                                                    </span>
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
        
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <div class="card" style="height: 95%;">
                                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                            <a class="stretched-link text-center" href="{{ route('users/create')}}">
                                                <button class="btn btn-gradient-primary btn-primary btn-shadow-primary"> <i class="fa fa-plus fa-3x"></i> </button>
                                                <p class="mt-2">Add New User</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Pagination Section -->
            <div class="card-footer mt-2 ">
                <div class="col-12 pagination-rounded">
                    {{ $users->appends(['search' => request('search')])->links() }}
                </div>
            </div> 
        </div>
        
        
    </div>

@endsection