@extends('layouts.app')
@push("css")
  <link rel="stylesheet" type="text/css" href="{{ asset("Datatables/datatables.css") }}">
@endpush

@section('content')

<div class="row page-titles mx-0">
  <div class="col p-md-0">
      <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
          <li class="breadcrumb-item active"><a href="/user">User</a></li>
      </ol>
  </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">User Table</h5>
              <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#addNewUserModal">
                Add user
              </button>
              <!-- Table with stripped rows -->
              <table id="user-table" class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>email</th>
                        <th>view</th>
                        @if (Auth::user()->hasPermissionTo('update_user'))
                        <th>edit</th>
                        @endif
                        @if (Auth::user()->hasPermissionTo('delete_user'))
                        <th>delete</th>
                        @endif
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>email</th>
                        <th>view</th>
                        @if (Auth::user()->hasPermissionTo('update_user'))
                        <th>edit</th>
                        @endif
                        @if (Auth::user()->hasPermissionTo('delete_user'))
                        <th>delete</th>
                        @endif
                    </tr>
                </tfoot>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
</div>

<div class="modal fade" id="addNewUserModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add new User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Multi Columns Form -->
          <form class="row g-3" id="user-form">
            <div class="col-md-12">
              <label for="inputName5" class="form-label">Name</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
            </div>
            <div class="col-md-12">
              <label for="inputEmail5" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
            </div>
            <div class="col-md-6">
              <label for="inputPassword5" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
            </div>
            <div class="col-md-6">
              <label for="confirmPassword" class="form-label">confirm Password</label>
              <input type="password" class="form-control" id="c_password" placeholder="confirm password" name="c_password">
            </div>
            <div class="col-md-6">
              <label for="confirmPassword" class="form-label">User Roles</label>
              <select class="form-select" name="roles" id="roles" >
                <option selected>Select Roles</option>
                @foreach ($roles as $key => $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
              </select>
            </div>
          </form><!-- End Multi Columns Form -->
        </div>
        <div class="modal-footer">
            <button id="add-user" type="button" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div><!-- End Large Modal-->

<!-- User Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModal_Label">Delete</h5>
      </div>
      <div class="modal-body">
      <form id="UserDeleteForm" class="form-horizontal" role="form" method="post" action="">
        @csrf  
        <div class="mb-3">
            <input type="hidden" class="form-control" id="userDeleteID" name="userDeleteID" required  >
          </div>
          <h5 class="modal-title" id="deleteModal_UserLabel">Delete</h5>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button  id="deleteUserBtn" type="button" class="btn btn-danger" onclick="deleteUser()">Delete</button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('js')

<script>

// tablereload
function reloadTable(){
  $('#user-table').DataTable().ajax.reload(null,false)
}

function showUserDelete(id){
  $.ajax({
      type: "GET",
      url:  "{{ url(route('users.get','')) }}"+ "/" +id,
      success: function(response) {
        if(response.code == 200) {
          $("#deleteModal_Label").html("Delete User ");
          $("#userDeleteID").attr("value",id);
          $("#deleteModal_UserLabel").html("Are you sure You want to Delete User");
          $("#deleteModal").modal("toggle");
        }
      }
  });
}
// Delete User
function deleteUser(){
  var form = $("#UserDeleteForm").serialize();
  $.ajax({
    type: "DELETE",
    url: '{{ url(route('users.destroy','')) }}/'+ $('#userDeleteID').val(),
    data: form,
    success: function(response) {
      $('#deleteModal').modal('hide');
      $('#UserDeleteForm')[0].reset();
      if(response.code == 200 ) {  
        swal({
            title: 'Success',
            text: 'User Deleted Successfully!',
            icon: 'success',
            buttons: true
        }).then(function(value) {
          if(value === true) {
            reloadTable();
          }
        });
      }
    }, error: function(response){
      swal("Oops!", "User Not Deleted!", "error");
    }
  });  
}
  //loading datatable
  $(document).ready( function () {    
  var password = '';
  var c_password = '';
  var dt = $("#user-table");

  $('input[name=password]').keyup(function(){
       password = $(this).val();
    });

    $('input[name=c_password]').keyup(function(){
       c_password = $(this).val();
      });

    $('#user-table').DataTable({
        "ajax": '{{ url(route('users.index')) }}',
        "method": "GET",
        columns: [
          {"data": "id"},
          {"data": "name"},
          {"data": "email"},
          {
            "data": null,
             "render": function (data,type, row) {
              return '<button id="deleteBtn" class="btn btn-success"  value ="'+data.id+ '"><i class="bi bi-eye-fill"></i></button>'
            }
          },
          @if (Auth::user()->hasPermissionTo('update_user'))
          {
            "data": null,
            "render": function (data,type, row) {
              return '<button id="editBtn" class="btn btn-success" onclick="showEmployeeEdit('+data.id+')" value="'+data.id+'" ><i class="bi bi-pen"></i></button>'
            }
          },  
          @endif
          @if (Auth::user()->hasPermissionTo('delete_user'))
          {
            "data": null,
             "render": function (data,type, row) {
              return '<button id="deleteBtn" class="btn btn-danger" onclick="showUserDelete('+data.id+')"  value="'+data.id+'"><i class="bi bi-trash"></i></button>'
            }
          }
          @endif
          ],
            'aoColumnDefs': [{
            'bSortable': false,
            'aTargets': ['nosort']
          }]
    }); 
      // ADD NEW USER
  $('#add-user').on('click', function(e) {
      e.preventDefault();
      var form = $("#user-form").serialize();
     
      if(c_password != password) {
          swal("Oops!", "Password Not Matched!", "error");
      } else {
        $.ajax({
            type: "POST",
            url: '{{ url(route('user.create')) }}',
            data: form,
            success: function(response) {
              $('#addNewUserModal').modal('hide');
              $('body').removeClass('modal-open');
              $('.modal-backdrop').remove();
              $('#user-form')[0].reset();
                if(response.status == 200) {
                    swal({
                        title: 'Success',
                        text: 'User Added Successfully!',
                        icon: 'success',
                        buttons: true
                    }).then(function(value) {
                        if(value === true) {
                          reloadTable();
                        }
                    });
                } else {
                  swal("Oops!", "User Not Added!", "error");
                }
            }
        });
      }
  });

});


</script>
    
@endpush