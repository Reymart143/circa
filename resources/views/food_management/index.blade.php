@extends('layouts.app')
@section('content')
<div class="app-main__outer">
    <div class="app-main__inner">
        {{-- <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    {{-- <div class="page-title-icon">
                        <i class="fa fa-users icon-gradient bg-mean-fruit"></i>
                    </div> --}}
                    {{-- <div>
                       Total Users
                        <div class="badge badge-success">{{ $total_users = App\Models\User::whereNot('role',1)->count(); }}</div>
                    </div> 
                </div>
            </div>
        </div> --}}
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                           

                         <div style="position: relative; display: inline-block; margin-bottom:10px;">
                            <img src="{{ asset('assets/images/pic.png') }}" alt="Chef" 
                                style="position: absolute; top: -40px; left: -45px; height: 80px; z-index: 1; background: transparent;">
                            
                            <span class="badge badge-primary mb-0" 
                                style="padding:5mm; background-color: #a60404; color:white; position: relative; z-index: 0;">
                                Food Management
                            </span>

                           
                        </div>
                             <button class="btn btn float-right" style="background-color: rgb(228, 83, 21); color: white;" onclick="openModal()">
                                <i class="fa fa-plus"></i> Add Dish
                            </button>
                             <div class="row mb-3">
                                <div class="col-md-4 d-flex">
                                    <label for="" class="col-md-6" style="margin-left:-4%"> Filter Food Categories :</label>
                                    <select id="categoryFilter" class="form-control">
                                        <option value="">All Categories</option>
                                        @foreach (DB::table('categories')->get() as $category)
                                            <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                           
                           <div class="table-responsive">
                                <table class="table" id="product_table" style="display: none;"></table>
                                <div id="card-container" class="row"></div>
                            </div>

                            <script>
                            $(document).ready(function() {
                                var table = $('#product_table').DataTable({
                                    processing: true,
                                    serverSide: true,
                                    ajax: {
                                        url: "{{ route('product/index') }}",
                                        data: function (d) {
                                            d.category = $('#categoryFilter').val(); 
                                        }
                                    },
                                    columns: [
                                        { data: 'product_name' },
                                        { data: 'category' },
                                        { data: 'start_time' },
                                        { data: 'end_time' },
                                        { data: 'price' },
                                        { data: 'discount' },
                                        { data: 'status' },
                                        { data: 'description' },
                                        { data: 'image' }, 
                                        { data: 'action', orderable: false, searchable: false }
                                    ],
                                    drawCallback: function(settings) {
                                        var api = this.api();
                                        var data = api.rows({ page: 'current' }).data();
                                        $('#card-container').empty();

                                        data.each(function(row) {
                                            var startTime = row.start_time ? formatTime(row.start_time) : '0';
                                            var endTime = row.end_time ? formatTime(row.end_time) : '0';
                                            var price = `₱ ${Number(row.price).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
                                            var statusButton = row.status == 0 
                                                ? `<span class="badge bg-success text-white ml-5" style="cursor: pointer;" onclick="updateStatus(${row.id}, 1)"><i class="fa fa-check"></i> Available</span>`
                                                : `<span class="badge bg-danger text-white ml-5" style="cursor: pointer;" onclick="updateStatus(${row.id}, 0)"><i class="fa fa-exclamation"></i> Not Available</span>`;

                                            var imagePath = '/' + row.image;

                                            var card = `
                                                <div class="col-md-3 mb-4">
                                                    <div class="card h-10 shadow-lg border border-warning mt-3">
                                                        <img src="${imagePath}" class="card-img-top" style="height: 150px; object-fit: cover;">
                                                        <div class="card-body d-flex flex-column">
                                                            <h5 class="card-title">${row.product_name}</h5>
                                                            <p class="card-text small">${row.description || ''}</p>
                                                            <p class="mb-1"><strong>Category:</strong> ${row.category}</p>
                                                            <p class="mb-1"><strong>Availability:</strong> ${startTime} - ${endTime}</p>
                                                            <p class="mb-1"><strong>Price:</strong> ${price}</p>
                                                            
                                                             <p>${statusButton}</p>
                                                            <div class="mt-auto ml-4">
                                                                ${row.action}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>`;
                                            
                                            $('#card-container').append(card);
                                        });
                                    }
                                });
                                $('#categoryFilter').on('change', function() {
                                    table.ajax.reload();
                                });
                                function formatTime(timeString) {
                                    var parts = timeString.split(':');
                                    var hours = parseInt(parts[0]);
                                    var minutes = parts[1];
                                    var ampm = hours >= 12 ? 'PM' : 'AM';
                                    hours = hours % 12;
                                    hours = hours ? hours : 12;
                                    return `${hours}:${minutes} ${ampm}`;
                                }
                            });
                            function updateStatus(id, newStatus) {
                                    $.ajax({
                                        url: '/product/update-status',
                                        type: 'POST',
                                        data: {
                                            id: id,
                                            status: newStatus,
                                            _token: '{{ csrf_token() }}'
                                        },
                                        success: function(response) {
                                            if (response.success) {
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: 'Status Updated!',
                                                    text: response.message,
                                                    timer: 1500,
                                                    showConfirmButton: false
                                                });
                                                $('#product_table').DataTable().ajax.reload(); 
                                            } else {
                                                Swal.fire('Error', 'Failed to update status.', 'error');
                                            }
                                        },
                                        error: function() {
                                            Swal.fire('Error', 'Something went wrong.', 'error');
                                        }
                                    });
                                }

                            </script>


                        </div>
                    </div>
                </div>
            </div>
        </div>
         
        
    </div>
    
    {{-- modals --}}
    <div class="modal fade" id="addproduct" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header" style="background-color: #a60404; color:white">
              <h5 class="modal-title" id="addCategoryLabel">Add Food</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form id="product_form">
                @csrf
                <h6 class="text-primary mt-3 mb-3"><i class="fa fa-user"></i> Product Information</h6>
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex flex-column align-items-center justify-content-center">
                          
                            <input type="file" id="image" name="image" style="display: none;" accept="image/png, image/gif, image/jpeg">

                            <input type="hidden" name="image" class="image-tag">
                            <button type="button" class="btn btn-info upload-image-btn rounded-circle mt-2 mb-2" onclick="uploadImages()"><i class="fa fa-camera"></i></button>
                        
                        </div>
                        <div class="alert alert-secondary text-center text-white"> Need to Upload Image  </div>
                        <script>
                            function uploadImages() {
                                document.getElementById('image').click();
                            }
                        
                            document.getElementById('image').addEventListener('change', function(event) {
                                const selectedImage = event.target.files[0];
                                if (selectedImage) {
                                    const avatarImage = document.getElementById('addImage');
                                    avatarImage.src = URL.createObjectURL(selectedImage);
                                }
                            });
                        
                        </script>
                    </div>
                    <div class="col-md-6">
                          <div class="upload-container">
                                <img class="img-fluid  addimage-fit" id="addImage" src="{{ asset('assets/images/avatars/12.jpg') }}" alt="dImage">
                                <style>
                                    .addimage-fit {
                                        width: 300px;
                                        height: 200px;
                                        object-fit: cover; 
                                        
                                        border: 2px solid #ccc;
                                    }

                                </style>
                            </div>
                    </div>
                </div>
               
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="product_name">Product Name</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product Name" required>
                        <span id="product_name-error" class="text-danger" role="alert"></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="category">Category Name</label>
                        <select class="form-control" id="category" name="category" required>

                            <option value="" disabled selected>Select type of Category</option>
                            @foreach (DB::table('categories')->get() as $category)
                                <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                        <span id="category-error" class="text-danger" role="alert"></span>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="quantity">Time Start</label>
                        <input type="time" class="form-control" id="start_time" name="start_time">
                        <span id="quantity-error" class="text-danger" role="alert"></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="price">End Time</label>
                        <input type="time" class="form-control" id="end_time" name="end_time">
                        <span id="price-error" class="text-danger" role="alert"></span>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" id="price" name="price" placeholder="Set Price" required>
                        <span id="price-error" class="text-danger" role="alert"></span>
                    </div>
                    {{-- <div class="form-group col-md-6">
                        <label for="price">Discount when login</label>
                        <input type="number" class="form-control" id="discount" name="discount" placeholder="Set discount when user login" required>
                        <span id="discount-error" class="text-danger" role="alert"></span>
                    </div> --}}
                    <div class="form-group col-md-6">
                        <label for="description">Food Description</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="" >
                        <span id="description-error" class="text-danger" role="alert"></span>
                    </div>
                </div>
                 {{-- <div class="form-row">
                    
                    
                </div> --}}
            </form>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" id="add_cat_btn" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
      {{-- edit modal --}}
      <div class="modal fade" id="editproduct" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editCategoryLabel">Edit Product</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                      <form id="product_form">
                @csrf
                <h6 class="text-primary mt-3 mb-3"><i class="fa fa-user"></i> Product Information</h6>
            
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex flex-column align-items-center justify-content-center">
                          
                            <input type="file" id="editimage" name="editimage" style="display: none;" accept="image/png, image/gif, image/jpeg">

                        <input type="hidden" name="image" class="image-tag">
                        <button type="button" class="btn btn-info upload-image-btn rounded-circle mt-2 mb-2" onclick="uploadImage()"><i class="fa fa-camera"></i></button>
                        
                        </div>
                        <div class="alert alert-secondary text-center text-white"> Need to Upload Image  </div>
                        <script>
                            function uploadImage() {
                                document.getElementById('editimage').click();
                            }

                            document.getElementById('editimage').addEventListener('change', function(event) {
                                const selectedImage = event.target.files[0];
                                if (selectedImage) {
                                    const avatarImage = document.getElementById('avatarImage');
                                    avatarImage.src = URL.createObjectURL(selectedImage);
                                }
                            });
                        </script>
                    </div>
                    <div class="col-md-6">
                          <div class="upload-container">
                                <img class="img-fluid avatar-fit" id="avatarImage"  
                                src="{{ asset('assets/images/avatars/12.jpg') }}" 
                                alt="User Profile Image">
                                <style>
                                    .avatar-fit{
                                        width: 300px;
                                        height: 240px;
                                        object-fit: cover; 
                                        
                                        border: 2px solid #ccc;
                                    }

                                </style>
                            </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="product_name">Product Name</label>
                        <input type="text" class="form-control" id="editproduct_name" name="editproduct_name" placeholder="Product Name">
                        <span id="product_name-error" class="text-danger" role="alert"></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="category">Category Name</label>
                        <select class="form-control" id="editcategory" name="editcategory" required>
                            <option value="" disabled selected>Select type of Category</option>
                            @foreach (DB::table('categories')->get() as $category)
                                <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="quantity">Start Time</label>
                        <input type="time" class="form-control" id="editstart_time" name="editstart_time" placeholder="Add Stock">
                        <span id="quantity-error" class="text-danger" role="alert"></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="price">End Time</label>
                        <input type="time" class="form-control" id="editend_time" name="editend_time" placeholder="Set Price">
                        <span id="price-error" class="text-danger" role="alert"></span>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="reorder">Price</label>
                        <input type="number" class="form-control" id="editprice" name="editprice" placeholder="Set Reorder Point">
                        <span id="reorder-error" class="text-danger" role="alert"></span>
                    </div>
                    {{-- <div class="form-group col-md-6">
                        <label for="warehouse">Discount</label>
                       <input type="number" class="form-control" id="editdiscount" name="editdiscount">
                    </div> --}}
                     <div class="form-group col-md-6">
                        <label for="reorder">Description</label>
                        <input type="text" class="form-control" id="editdescription" name="editdescription" placeholder="Set Reorder Point">
                        <span id="reorder-error" class="text-danger" role="alert"></span>
                    </div>
                </div>
                {{-- <div class="form-row">
                   
                  
                </div> --}}
            </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" id="edit-btn" class="btn btn-primary">Update changes</button>
            </div>
          </div>
        </div>
      </div>
      <script>
         function openModal(){
            $('#addproduct').appendTo('body').modal('show');
          
        }
        $('#add_cat_btn').on('click', function (e) {
            e.preventDefault();

           var product_name = ($('#product_name').val() || '').trim();
            var category = ($('#category').val() || '').trim();
            var start_time = $('#start_time').val();
            var end_time = $('#end_time').val();
            var price = ($('#price').val() || '').trim();
            var discount = $('#discount').val();
            var description = $('#description').val();
            var imageFile = $('#image')[0].files[0];
            var errors = false;

            if (product_name === '') {
                $('#product_name').addClass('is-invalid');
                $('#product_name-error').text('Product name is required.');
                errors = true;
            } else {
                $('#product_name').removeClass('is-invalid');
                $('#product_name-error').text('');
            }

            if (category === '') {
                $('#category').addClass('is-invalid');
                $('#category-error').text('category is required.');
                errors = true;
            } else {
                $('#category').removeClass('is-invalid');
                $('#category-error').text('');
            }
            
            if (price === '') {
                $('#price').addClass('is-invalid');
                $('#price-error').text('Price is required.');
                errors = true;
            } else if (parseFloat(price) < 0) {
                $('#price').addClass('is-invalid');
                $('#price-error').text('Price cannot be negative.');
                errors = true;
            } else {
                $('#price').removeClass('is-invalid');
                $('#price-error').text('');
            }
            if (!imageFile) {
                    Swal.fire({
                        title: 'Image Required',
                        text: 'Please upload an image.',
                        icon: 'error',
                    });
                    return;
            }
            if (errors) {
                Swal.fire({
                    title: 'Input Failed',
                    text: 'Please fill in all required fields.',
                    icon: 'error',
                });
                return;
            }

            var formData = new FormData();
                formData.append('product_name', product_name);
                formData.append('start_time', start_time);
                formData.append('end_time', end_time);
                formData.append('description', description);
                formData.append('price', price);
                formData.append('discount', discount);
                formData.append('category', category);
                formData.append('image', imageFile);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: '/product.store',
                data: formData,
                dataType: 'json',
                processData: false,  
                contentType: false,
                success: function (response) {
                    Swal.fire({
                        title: 'Successfully Submitted',
                        text: 'The information has been saved.',
                        icon: 'success',
                    });
                     $('#product_form').trigger("reset"); 
                    $('.is-invalid').removeClass('is-invalid'); 
                    $('.invalid-feedback').text(''); 
                    $('#product_table').DataTable().ajax.reload();

                    $('#userImage').attr('src', '{{ asset("assets/images/avatars/12.jpg") }}');
                },
                error: function (xhr) {
                    Swal.fire({
                        title: 'Error',
                        text: 'An error occurred while submitting the form.',
                        icon: 'error',
                    });
                }
            });
        });
           function editmodalproduct(id){
                    // $('#edit-btn').text('Update Info');
                    $('#editproduct').appendTo('body').modal('show');
                
                    $.ajax({
                        url: "/product/edit/" + id + "/",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: "json",
                        success: function (data) {
                           $('#editproduct_name').val(data.result.product_name);
                            $('#editstart_time').val(data.result.start_time);
                            $('#editend_time').val(data.result.end_time);
                            $('#editdiscount').val(data.result.discount);
                            $('#editprice').val(data.result.price);
                            $('#editcategory').val(data.result.category);
                            $('#editdescription').val(data.result.description);
                            $('#edit-btn').val('Update');
                            $('#action').val('Edit');
                            $('#editCategory').modal('show');
                            if (data.result.image) {
                                $('#avatarImage').attr('src', '/' + data.result.image);
                            } else {
                                $('#avatarImage').attr('src', '{{ asset("assets/images/avatars/12.jpg") }}');
                            }
                            $('#edit-btn').off('click').on('click', function () {
                                updateproduct(id);
                            });
                        },
                        error: function (data) {
                            var errors = data.responseJSON;
                        }
                    });
                }
                //update
               function updateproduct(id) {
                    var product_name = $('#editproduct_name').val().trim();
                    var category = $('#editcategory').val().trim();
                    var start_time = $('#editstart_time').val().trim();
                    var end_time = $('#editend_time').val().trim();
                    var price = $('#editprice').val().trim();
                    var discount = $('#editdiscount').val();
                    var description = $('#editdescription').val().trim();
                    var imageFile = $('#editimage')[0].files[0]; // Image file

                    var errors = false;

                    if (product_name === '') {
                        $('#editproduct_name').addClass('is-invalid');
                        $('#product_name-error').text('Product name is required.');
                        errors = true;
                    } else {
                        $('#editproduct_name').removeClass('is-invalid');
                        $('#product_name-error').text('');
                    }

                    if (category === '') {
                        $('#editcategory').addClass('is-invalid');
                        errors = true;
                    } else {
                        $('#editcategory').removeClass('is-invalid');
                    }

                    if (price === '') {
                        $('#editprice').addClass('is-invalid');
                        $('#price-error').text('Price is required.');
                        errors = true;
                    } else if (parseFloat(price) < 0) {
                        $('#editprice').addClass('is-invalid');
                        $('#price-error').text('Price cannot be negative.');
                        errors = true;
                    } else {
                        $('#editprice').removeClass('is-invalid');
                        $('#price-error').text('');
                    }

                    if (errors) {
                        return; 
                    }

                    var formData = new FormData();
                    formData.append('id', id);
                    formData.append('product_name', product_name);
                    formData.append('category', category);
                    formData.append('start_time', start_time);
                    formData.append('end_time', end_time);
                    formData.append('price', price);
                    formData.append('discount', discount);
                    formData.append('description', description);
                    if (imageFile) {
                        formData.append('image', imageFile);
                    }

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: 'POST',
                        url: '{{ route("product/update") }}',
                        data: formData,
                        processData: false,
                        contentType: false,
                        dataType: 'json',
                        success: function (response) {
                            $('#product_table').DataTable().ajax.reload();
                            Swal.fire({
                                title: 'Successfully Updated',
                                text: 'This product information has been updated.',
                                icon: 'success',
                            });
                            $('#editproduct').modal('hide');
                        },
                        error: function (error) {
                            Swal.fire({
                                title: 'Something Went Wrong',
                                text: 'Please check your input fields.',
                                icon: 'error',
                            });
                        }
                    });
                }


                function confirmDeleteProduct(id) {
                        
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!',
                            reverseButtons: true,
                            buttonsStyling: false,
                            customClass: {
                                confirmButton: 'btn btn-primary mx-2', 
                                cancelButton: 'btn btn-danger mx-2'    
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                deleteProduct(id);
                            } else {
                                Swal.fire(
                                    'Deletion canceled',
                                    'The Product was not deleted.',
                                    'info'
                                )
                            }
                        });
                    }

                    function deleteProduct(id) {
                        
                        $.ajax({
                        
                            url: "{{ url('product.delete/') }}/" + id,
                            type: 'DELETE',
                            
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            
                            success: function(response) {
                                
                                Swal.fire(
                                    'Deleted!',
                                    'The Product has been deleted.',
                                    'success'
                                ).then(() => {

                                    $('#product_table').DataTable().ajax.reload();
                                });
                            },
                            error: function(xhr, status, error) {
                            
                                Swal.fire(
                                    'Error!',
                                    'An error occurred while deleting the Product.',
                                    'error'
                                );
                            }
                        });
                    }   
      </script>
 
@endsection