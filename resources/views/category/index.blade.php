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
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="card-title mb-0">Category List</h5>
                                <button class="btn btn-success" onclick="openModal()"><i class="fa fa-plus"></i>Add Category</button>
                            </div>
                            
                            <!-- Add table-responsive class here -->
                            <div class="table-responsive">
                                <table class="mb-0 table table-striped" id="cat_table">
                                    <thead>
                                        <tr>
                                            <th>Category ID</th>
                                            <th>Category Name</th>
                                            <th>Category Details (optional)</th>
                                            {{-- <th>Status</th> --}}
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Data will be inserted here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         
        
    </div>
    
    {{-- modals --}}
    <div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addCategoryLabel">Add Category</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form>
                @csrf
                <div class="form-group">
                  <label for="categoryName">Category Name</label>
                  <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Enter category name">
                  <span id="category_name-error" style="color:red" class="is-invalid" role="alert"></span>
                </div>
                <div class="form-group">
                  <label for="categoryDescription">Description</label>
                  <textarea class="form-control" id="category_details" name="category_details" rows="3" placeholder="Enter description"></textarea>
                </div>
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
      <div class="modal fade" id="editCategory" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editCategoryLabel">Edit Category</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form>
                @csrf
                <div class="form-group">
                  <label for="categoryName">Category Name</label>
                  <input type="text" class="form-control" id="edit_category_name" name="edit_category_name" placeholder="Enter category name">
                  <span id="category_name-error" style="color:red" class="is-invalid" role="alert"></span>
                </div>
                <div class="form-group">
                  <label for="categoryDescription">Description</label>
                  <textarea class="form-control" id="edit_category_details" name="edit_category_details" rows="3" placeholder="Enter description"></textarea>
                </div>
                
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
            $('#addCategoryLabel').html('<i class="fa fa-plus"></i> Add Category');
            $('#addCategory').appendTo('body').modal('show');
          
        }
        $('#add_cat_btn').on('click', function (e) {
            e.preventDefault(); 

            var category_name = $('#category_name').val().trim();
            var category_details = $('#category_details').val().trim(); // fixed
            var errors = false;

            if (category_name === '') {
                $('#category_name').addClass('is-invalid');
                $('#category_name-error').text('Please input Category Name.');
                errors = true;
            } else {
                $('#category_name').removeClass('is-invalid');
                $('#category_name-error').text('');
            }

            if (errors) {
                Swal.fire({
                    title: 'Input Failed',
                    text: 'Please fill in all required fields.',
                    icon: 'error',
                });
                return; 
            }

            var formData = {
                id: $('#hidden_id').val(),
                category_name: category_name,
                category_details: category_details
            };

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: '/add_category', 
                data: formData,
                dataType: 'json',
                success: function (response) {
                    $('#category_name').val('');
                    $('#category_details').val('');
                    Swal.fire({
                        title: 'Successfully Added Category',
                        text: 'Successfully Added Category Settings',
                        icon: 'success',
                    });
                    $('#cat_table').DataTable().ajax.reload();
                    $('#addCategory').modal('hide');
                },
                error: function (xhr) {
                    Swal.fire({
                        title: 'Error',
                        text: 'An error occurred while creating the category.',
                        icon: 'error',
                    });
                }
            });
        });
              function editmodalcategory(id){
                    $('#edit-btn').text('Update Info');
                    $('#editCategory').appendTo('body').modal('show');
                
                    $.ajax({
                        url: "/category/edit/" + id + "/",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: "json",
                        success: function (data) {
                            $('#edit_category_name').val(data.result.category_name)
                            $('#edit_category_details').val(data.result.category_details)
                            $('#editLabel').html('<i class="fa fa-edit"?></i> Edit Category');
                            $('#edit-btn').val('Update');
                            $('#action').val('Edit');
                            $('#editCategory').modal('show');
                        
                            $('#edit-btn').off('click').on('click', function () {
                                updateCategory(id);
                            });
                        },
                        error: function (data) {
                            var errors = data.responseJSON;
                        }
                    });
                }
                //update
                    function updateCategory(id) {
                        var Categoryform = {
                            'id': id,
                            'category_name': $('#edit_category_name').val(),
                            'category_details': $('#edit_category_details').val(),
                        };

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                     
                        $.ajax({
                            type: 'post',
                            url: '{{ route("category/update") }}',
                            data: Categoryform,
                            dataType: 'json',
                            success: function (response) {
                            $('#cat_table').DataTable().ajax.reload();
                            Swal.fire({
                                title: 'Successfully Updated',
                                text: 'This Category Information Is Now Updated',
                                icon: 'success',
                            });
                            $('#editCategory').modal('hide');
                            },
                            error: function (error) {
                                Swal.fire({
                                title: 'Something Went Wrong ',
                                text: 'Please Check you input fields',
                                icon: 'error',
                            });
                            }
                        });
                    }
                    function confirmDelete(id) {
                        
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
                                deleteCat(id);
                            } else {
                                Swal.fire(
                                    'Deletion canceled',
                                    'The Category was not deleted.',
                                    'info'
                                )
                            }
                        });
                    }

                    function deleteCat(id) {
                        
                        $.ajax({
                        
                            url: "{{ url('category.delete/') }}/" + id,
                            type: 'DELETE',
                            
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            
                            success: function(response) {
                                
                                Swal.fire(
                                    'Deleted!',
                                    'The Category has been deleted.',
                                    'success'
                                ).then(() => {

                                    $('#cat_table').DataTable().ajax.reload();
                                });
                            },
                            error: function(xhr, status, error) {
                            
                                Swal.fire(
                                    'Error!',
                                    'An error occurred while deleting the category.',
                                    'error'
                                );
                            }
                        });
                    }
    </script>
          <script>
            
             $(document).ready(function() {
                $('#cat_table').DataTable({
              
                    "processing": true,
                   
                    serverSide: true,
                    ajax: "{{ route('settings/category') }}",

                    columns: [
                        {
                            data: 'category_id',
                            name: 'category_id',
                            render: function(data) {
                                return data ? `<button class="text-wrap btn btn-outline-warning">${data}</button>` : '<div class="text-wrap">No data</div>';
                            }
                        },
                        {
                            data: 'category_name',
                            name: 'category_name',
                            render: function(data) {
                                return data ? `<div class="text-wrap">${data}</div>` : '<div class="text-wrap">No data</div>';
                            }
                        },
                        {
                            data: 'category_details',
                            name: 'category_details',
                            render: function(data) {
                                return data ? `<div class="text-wrap">${data}</div>` : '<div class="text-wrap">No data</div>';
                            }
                        },
                        // {
                        //     data: 'status',
                        //     name: 'status',
                        //     render: function(data) {
                        //         if (data === 1) {
                        //             return '<div class="text-wrap">Not Activated</div>';
                        //         } else if (data === 0) {
                        //             return '<div class="text-wrap">Activated</div>';
                        //         } else {
                        //             return '<div class="text-wrap">No data</div>';
                        //         }
                        //     }
                        // },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ]
                });
            });
    </script>
    
@endsection