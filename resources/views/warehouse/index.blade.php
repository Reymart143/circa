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
                                <h5 class="card-title mb-0">Warehouse Details</h5>
                                <button class="btn btn-shadow btn-success" onclick="openModalWarehouse()"><i class="fa fa-plus"></i>Add Warehouse Details</button>
                            </div>
                            
                            <!-- Add table-responsive class here -->
                            <div class="table-responsive">
                                <table class="mb-0 table table-striped" id="warehouse_table">
                                    <thead>
                                        <tr>
                                            <th>Warehouse Name</th>
                                            <th>Location</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
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
    <div class="modal fade" id="addWarehouse" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addCategoryLabel">Add Warehouse Details</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
               <form>
                @csrf
                <div class="form-group">
                  <label for="categoryName">Warehouse Name</label>
                 <input type="text" class="form-control" id="warehouse_name" name="warehouse_name" ></input>
                 <span id="warehouse_name-error" style="color:red" class="is-invalid" role="alert"></span>
                </div>
                
                 <div class="form-group">
                  <label for="categoryDescription">Location</label>
                  <input type="text" class="form-control" id="location" name="location" ></input>
                   <span id="location-error" style="color:red" class="is-invalid" role="alert"></span>
                </div>
               <div class="form-group">
                <label for="usable">Status</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="status" value="0">
                    <label class="form-check-label" for="usableYes">Active</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="status" value="1">
                    <label class="form-check-label" for="usableNo">NotActive</label>
                </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-shadow btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" id="add_warehouse_btn" class="btn btn-shadow btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
      {{-- edit modal --}}
      <div class="modal fade" id="editWarehouse" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editCategoryLabel">Edit Warehouse</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form>
                @csrf
                  <div class="form-group">
                  <label for="categoryName">Warehouse Name</label>
                 <input type="text" class="form-control" id="editwarehouse_name" name="editwarehouse_name" ></input>
                
                </div>
                
                 <div class="form-group">
                  <label for="categoryDescription">Location</label>
                  <input type="text" class="form-control" id="editlocation" name="editlocation" ></input>
                   <span id="location-error" style="color:red" class="is-invalid" role="alert"></span>
                </div>
               <div class="form-group">
                <label for="usable">Status</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="editstatus" id="editstatus" value="0">
                    <label class="form-check-label" for="usableYes">Active</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="editstatus" id="editstatus" value="1">
                    <label class="form-check-label" for="usableNo">Not Active</label>
                </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" id="edit-btn-warehouse" class="btn btn-primary">Update changes</button>
            </div>
          </div>
        </div>
      </div>
      <script>
        function openModalWarehouse(){
     
            $('#addWarehouse').appendTo('body').modal('show');
          
        }
        $('#add_warehouse_btn').on('click', function (e) {
            e.preventDefault(); 

            var warehouse_name = $('#warehouse_name').val().trim();
            var status = $('input[name="status"]:checked').val();
            var location = $('#location').val().trim();
          
            var errors = false;

            if (warehouse_name === '') {
                $('#warehouse_name').addClass('is-invalid');
                $('#warehouse_name-error').text('Please input warehouse.');
                errors = true;
            } else {
                $('#warehouse_name').removeClass('is-invalid');
                $('#warehouse_name-error').text('');
            }
            if (location === '') {
                $('#location').addClass('is-invalid');
                $('#location-error').text('Please input location');
                errors = true;
            } else {
                $('#location').removeClass('is-invalid');
                $('#location-error').text('');
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
                warehouse_name: warehouse_name,
                status: status,
                location : location,
              
            };

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: '/warehouse.store', 
                data: formData,
                dataType: 'json',
                success: function (response) {
                    $('#tractor').val('');
                    // $('#category_details').val('');
                    Swal.fire({
                        title: 'Successfully Added Warehouse Details',
                        text: 'Successfully Added Warehouse Details',
                        icon: 'success',
                    });
                    $('#warehouse_table').DataTable().ajax.reload();
                    $('#addWarehouse').modal('hide');
                },
                error: function (xhr) {
                    Swal.fire({
                        title: 'Error',
                        text: 'An error occurred while creating the Warehouse Details.',
                        icon: 'error',
                    });
                }
            });
        });
              function editmodalWarehouse(id){
                    // $('#edit-btn').text('Update Info');
                    $('#editWarehouse').appendTo('body').modal('show');
                
                    $.ajax({
                        url: "/warehouse.edit/" + id + "/",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: "json",
                        success: function (data) {
                           $('#editwarehouse_name').val(data.result.warehouse_name)
                            $('input[name="editstatus"][value="' + data.result.status + '"]').prop('checked', true);

                            $('#editlocation').val(data.result.location)
                            // $('#editLabel').html('<i class="fa fa-edit"?></i> Edit Category');
                            // $('#edit-btn').val('Update');
                            $('#action').val('Edit');
                            $('#editWarehouse').modal('show');
                        
                            $('#edit-btn-warehouse').off('click').on('click', function () {
                                updateWarehouse(id);
                            });
                        },
                        error: function (data) {
                            var errors = data.responseJSON;
                        }
                    });
                }
                //update
                    function updateWarehouse(id) {
                        var WarehouseDform = {
                            'id': id,
                            'warehouse_name': $('#editwarehouse_name').val(),
                            'status': $('input[name="editstatus"]:checked').val(),
                            'location': $('#editlocation').val(),
                        };

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                     
                        $.ajax({
                            type: 'post',
                            url: '{{ route("warehouse/update") }}',
                            data: WarehouseDform,
                            dataType: 'json',
                            success: function (response) {
                            $('#warehouse_table').DataTable().ajax.reload();
                            Swal.fire({
                                title: 'Successfully Updated',
                                text: 'This Warehouse Is Now Updated',
                                icon: 'success',
                            });
                            $('#editWarehouse').modal('hide');
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
                    function confirmDeleteWarehouse (id) {
                        
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
                                deleteWarehouse(id);
                            } else {
                                Swal.fire(
                                    'Deletion canceled',
                                    'This was not deleted.',
                                    'info'
                                )
                            }
                        });
                    }

                    function deleteWarehouse(id) {
                        
                        $.ajax({
                        
                            url: "{{ url('warehouse.delete/') }}/" + id,
                            type: 'DELETE',
                            
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            
                            success: function(response) {
                                
                                Swal.fire(
                                    'Deleted!',
                                    'The Warehouse Details has been deleted.',
                                    'success'
                                ).then(() => {

                                    $('#warehouse_table').DataTable().ajax.reload();
                                });
                            },
                            error: function(xhr, status, error) {
                            
                                Swal.fire(
                                    'Error!',
                                    'An error occurred while deleting the Warehouse Details.',
                                    'error'
                                );
                            }
                        });
                    }
    </script>
          <script>
            
             $(document).ready(function() {
                $('#warehouse_table').DataTable({
              
                    "processing": true,
                   
                    serverSide: true,
                    ajax: "{{ route('warehouse/index') }}",

                    columns: [
                        {
                            data: 'warehouse_name',
                            name: 'warehouse_name',
                            render: function(data) {
                                  return data ? `<div class="text-wrap">${data}</div>` : '<div class="text-wrap">No data</div>';
                            }
                        },
                       {
                            data: 'location',
                            name: 'location',
                            render: function(data) {
                                   return data ? `<div class="text-wrap">${data}</div>` : '<div class="text-wrap">No data</div>';
                            }
                        },
                         {
                            data: 'status',
                            name: 'status',
                            render: function(data) {
                                if(data == 0){
                                    return data ? `<span class="badge badge-success"> Active </span>` : '<div class="text-wrap">No data</div>';
                                }
                                else{
                                    return data ? `<span class="text-wrap badge badge-danger"> Not Active </span>` : '<div class="text-wrap">No data</div>';
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