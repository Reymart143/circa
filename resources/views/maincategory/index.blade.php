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
                                <h5 class="card-title mb-0">Main Category List</h5>
                                <button class="btn btn-success" onclick="openModal()"><i class="fa fa-plus"></i> Add Main Category</button>
                            </div>
                            
                            <!-- Add table-responsive class here -->
                            <div class="table-responsive">
                                <table class="mb-0 table table-striped" id="maincat_table">
                                    <thead>
                                        <tr>
                                            <th>Main Category Name</th>
                                            <th>Start Time</th>
                                             <th>End Time</th>
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
    <div class="modal fade" id="addMainCategory" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addCategoryLabel">Add Main Category</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form>
                @csrf
                <div class="form-group">
                  <label for="categoryName">Category Name</label>
                  <input type="text" class="form-control" id="main_name" name="main_name" placeholder="Enter main category name">
                  <span id="main_name-error" style="color:red" class="is-invalid" role="alert"></span>
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
      <div class="modal fade" id="editMainCategory" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
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
                  <input type="text" class="form-control" id="editmain_name" name="editmain_name" placeholder="Enter main category name">
                  <span id="main_name-error" style="color:red" class="is-invalid" role="alert"></span>
                </div>
                 <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="quantity">Time Start</label>
                        <input type="time" class="form-control" id="editstart_time" name="editstart_time">
                        <span id="quantity-error" class="text-danger" role="alert"></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="price">End Time</label>
                        <input type="time" class="form-control" id="editend_time" name="editend_time">
                        <span id="price-error" class="text-danger" role="alert"></span>
                    </div>
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
            $('#addMainCategory').appendTo('body').modal('show');
          
        }
        $('#add_cat_btn').on('click', function (e) {
            e.preventDefault(); 

            var main_name = $('#main_name').val().trim();
            var start_time = $('#start_time').val(); 
            var end_time = $('#end_time').val(); 
            var errors = false;

            if (main_name === '') {
                $('#main_name').addClass('is-invalid');
                $('#main_name-error').text('Please input Category Name.');
                errors = true;
            } else {
                $('#main_name').removeClass('is-invalid');
                $('#main_name-error').text('');
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
                main_name: main_name,
                start_time: start_time,
                end_time :end_time,
            };

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: '/add_maincategory', 
                data: formData,
                dataType: 'json',
                success: function (response) {
                    $('#main_name').val('');
                     $('#start_time').val('');
                    $('#end_time').val('');
                    Swal.fire({
                        title: 'Successfully Added Category',
                        text: 'Successfully Added Main ',
                        icon: 'success',
                    });
                    $('#maincat_table').DataTable().ajax.reload();
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
                    $('#editMainCategory').appendTo('body').modal('show');
                
                    $.ajax({
                        url: "/maincategory/edit/" + id + "/",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: "json",
                        success: function (data) {
                            $('#editmain_name').val(data.result.main_name)
                            $('#editstart_time').val(data.result.start_time)
                             $('#editend_time').val(data.result.end_time)
                            $('#editLabel').html('<i class="fa fa-edit"?></i> Edit Main Category');
                            $('#edit-btn').val('Update');
                            $('#action').val('Edit');
                         
                        
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
                        var mainCategoryform = {
                            'id': id,
                            'main_name': $('#editmain_name').val(),
                            'start_time': $('#editstart_time').val(),
                            'end_time': $('#editend_time').val(),
                        };

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                     
                        $.ajax({
                            type: 'post',
                            url: '{{ route("maincategory/update") }}',
                            data: mainCategoryform,
                            dataType: 'json',
                            success: function (response) {
                            $('#maincat_table').DataTable().ajax.reload();
                            Swal.fire({
                                title: 'Successfully Updated',
                                text: 'This Main Category Information Is Now Updated',
                                icon: 'success',
                            });
                            $('#editMainCategory').modal('hide');
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
                        
                            url: "{{ url('maincategory.delete/') }}/" + id,
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

                                    $('#maincat_table').DataTable().ajax.reload();
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
                $('#maincat_table').DataTable({
              
                    "processing": true,
                   
                    serverSide: true,
                    ajax: "{{ route('maincategory/category') }}",

                    columns: [
                        {
                            data: 'main_name',
                            name: 'main_name',
                            render: function(data) {
                                return data ? `<div class="text-wrap ">${data}</div>` : '<div class="text-wrap">No data</div>';
                            }
                        },
                       {
                            data: 'start_time',
                            name: 'start_time',
                            render: function(data) {
                                return data
                                    ? `<div class="text-wrap">${formatTo12Hour(data)}</div>`
                                    : '<div class="text-wrap">No data</div>';
                            }
                        },
                        {
                            data: 'end_time',
                            name: 'end_time',
                            render: function(data) {
                                return data
                                    ? `<div class="text-wrap">${formatTo12Hour(data)}</div>`
                                    : '<div class="text-wrap">No data</div>';
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
                function formatTo12Hour(timeStr) {
                    if (!timeStr) return '';
                    const [hourStr, minuteStr] = timeStr.split(':');
                    let hour = parseInt(hourStr);
                    const minute = parseInt(minuteStr);
                    const ampm = hour >= 12 ? 'PM' : 'AM';
                    hour = hour % 12 || 12; // convert to 12-hour format
                    return `${hour}:${minute.toString().padStart(2, '0')} ${ampm}`;
                }

            });
    </script>
    
@endsection