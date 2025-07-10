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
                                <h5 class="card-title mb-0">Table Number List</h5>
                                <button class="btn btn-success" onclick="openModaltable()"><i class="fa fa-plus"></i> Add Table Number</button>
                            </div>
                            
                            <!-- Add table-responsive class here -->
                            <div class="table-responsive">
                                <table class="mb-0 table table-striped" id="tableno_table">
                                    <thead>
                                        <tr>
                                            <th>TABLE NO</th>
                                            <th>STATUS</th>
                                            <th>ACTION</th>
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
    <div class="modal fade" id="addTable" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addCategoryLabel">Add Table Number</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form>
                @csrf
                <p><strong>Instruction:</strong> To add a table number, you may enter a single number (e.g., <code>5</code>) or a range of numbers (e.g., <code>1-10</code>) to create multiple table entries at once. Please ensure the table numbers do not already exist.</p>

                <div class="form-group">
                  <label for="categoryName">Table Number</label>
                  <input type="text" class="form-control" id="table_no" name="table_no" placeholder="Enter table number (e.g., 1-50)">
                  <span id="table_no-error" style="color:red" class="is-invalid" role="alert"></span>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" id="add_table_btn" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
      {{-- edit modal --}}
      <div class="modal fade" id="editTable" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editCategoryLabel">Edit Table Number</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form>
                @csrf
                  <div class="form-group">
                  <label for="edittable_no">Table Number</label>
                  <input type="text" class="form-control" id="edittable_no" name="edittable_no" placeholder="Enter table number">
                  <span id="edittable_no-error" style="color:red" class="is-invalid" role="alert"></span>
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
        function openModaltable(){
   
            $('#addTable').appendTo('body').modal('show');
          
        }
        $('#add_table_btn').on('click', function (e) {
            e.preventDefault(); 

            var table_no = $('#table_no').val().trim();
            if (!/^(\d+)(\s*-\s*\d+)?$/.test(table_no)) {
                $('#table_no').addClass('is-invalid');
                $('#table_no-error').text('Enter a valid number or range like 1-50.');
                errors = true;
            }
            var errors = false;

            if (table_no === '') {
                $('#table_no').addClass('is-invalid');
                $('#table_no-error').text('Please input Table Number.');
                errors = true;
            } else {
                $('#table_no').removeClass('is-invalid');
                $('#table_no-error').text('');
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
                table_no: table_no,
            };

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

         $.ajax({
                type: 'POST',
                url: '/table_no.store', 
                data: formData,
                dataType: 'json',
                success: function (response) {
                    $('#table_no').val('');
                    Swal.fire({
                        title: 'Success',
                        text: response.message,
                        icon: 'success',
                    });
                    $('#tableno_table').DataTable().ajax.reload();
                    $('#addTable').modal('hide');
                },
                error: function (xhr) {
                        let message = 'An error occurred while creating the Table Number.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }
                        Swal.fire({
                            title: 'Error',
                            text: message,
                            icon: 'error',
                        });
                    }

            });

        });
              function editmodaltable(id){
                    // $('#edit-btn').text('Update Info');
                    $('#editTable').appendTo('body').modal('show');
                
                    $.ajax({
                        url: "/tableno/edit/" + id + "/",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: "json",
                        success: function (data) {
                            $('#edittable_no').val(data.result.table_no)
                            // $('#edit_category_details').val(data.result.category_details)
                            // $('#editLabel').html('<i class="fa fa-edit"?></i> Edit Category');
                            $('#edit-btn').val('Update');
                            $('#action').val('Edit');
                     
                        
                            $('#edit-btn').off('click').on('click', function () {
                                updateTable(id);
                            });
                        },
                        error: function (data) {
                            var errors = data.responseJSON;
                        }
                    });
                }
                //update
                    function updateTable(id) {
                        var tableform = {
                            'id': id,
                            'table_no': $('#edittable_no').val(),
                        };

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                     
                        $.ajax({
                            type: 'post',
                            url: '{{ route("tableno/update") }}',
                            data: tableform,
                            dataType: 'json',
                            success: function (response) {
                            $('#tableno_table').DataTable().ajax.reload();
                            Swal.fire({
                                title: 'Successfully Updated',
                                text: 'This Table Number Information Is Now Updated',
                                icon: 'success',
                            });
                            $('#editTable').modal('hide');
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
                                deleteTable(id);
                            } else {
                                Swal.fire(
                                    'Deletion canceled',
                                    'The Table Number was not deleted.',
                                    'info'
                                )
                            }
                        });
                    }

                    function deleteTable(id) {
                        
                        $.ajax({
                        
                            url: "{{ url('tableno.delete/') }}/" + id,
                            type: 'DELETE',
                            
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            
                            success: function(response) {
                                
                                Swal.fire(
                                    'Deleted!',
                                    'The Table Number has been deleted.',
                                    'success'
                                ).then(() => {

                                    $('#tableno_table').DataTable().ajax.reload();
                                });
                            },
                            error: function(xhr, status, error) {
                            
                                Swal.fire(
                                    'Error!',
                                    'An error occurred while deleting the Table Number.',
                                    'error'
                                );
                            }
                        });
                    }
    </script>
          <script>
            
             $(document).ready(function() {
                $('#tableno_table').DataTable({
              
                    "processing": true,
                   
                    serverSide: true,
                    ajax: "{{ route('tableno') }}",

                    columns: [
                        {
                            data: 'table_no',
                            name: 'table_no',
                            render: function(data) {
                                return data ? `<div class="text-wrap">${data}</div>` : '<div class="text-wrap">No data</div>';
                            }
                        },
                        {
                            data: 'status',
                            name: 'status',
                            render: function(data) {
                                if(data == 0){
                                    return '<span class="badge badge-success">Available</span>';
                                }
                                else{
                                     return '<span class="badge badge-danger">Not Available</span>';
                                }
                            }
                        },
                        
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