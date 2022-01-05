@extends('layouts.app')
@push("css")
  <link rel="stylesheet" type="text/css" href="{{ asset("Datatables/datatables.css") }}">
@endpush

@section('content')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="/usergroup">User Group</a></li>
        </ol>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                  <h5 class="card-title">User Group Table</h5>
                  <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#addNewUserGroupModal">
                    Add user group
                  </button>
                  <!-- Table with stripped rows -->
                  <table id="userGroup-table" class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>User Group</th>
                            <th>view</th>
                            <th>edit</th>
                            <th>delete</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>User Group</th>
                            <th>view</th>
                            <th>edit</th>
                            <th>delete</th>
                        </tr>
                    </tfoot>
                  </table>
                  <!-- End Table with stripped rows -->
    
                </div>
              </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addNewUserGroupModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add new User Group</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Multi Columns Form -->
        <form class="row g-3" id="userGroupAddForm">
          <div class="col-md-6">
            <label for="inputName5" class="form-label">Name</label>
            <input type="text" class="form-control" id="userGroupname" name="userGroupname" placeholder="Enter Name">
          </div>
          <div class="col-md-6">
            <label for="inputslug5" class="form-label">slug</label>
            <input type="text" class="form-control" id="slug" name="slug" placeholder="Enter slug">
          </div>
          @include('usergroup.permissions',$permissions=[])
        </form><!-- End Multi Columns Form -->
      </div>
      <div class="modal-footer">
          <button id="addusergroup" type="button" class="btn btn-primary">Submit</button>
          <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div><!-- End Large Modal-->

@endsection

@push('js')


<script>
//add usergroup
$('#addusergroup').on('click', function(e) {
    e.preventDefault();
    var form = $("#userGroupAddForm").serialize();

    $.ajax({
    type: "POST",
    url: '{{ url(route('userGroup.create')) }}',
    data: form,
    success: function(response) {
      $('#addNewUserGroupModal').modal('hide');
      $('body').removeClass('modal-open');
      $('.modal-backdrop').remove();
      $('#userGroupAddForm')[0].reset();
        if(response.status == 200) {
            swal({
                title: 'Success',
                text: 'User Group Added Successfully!',
                icon: 'success',
                buttons: true
            }).then(function(value) {
                if(value === true) {
                  reloadTable();
                }
            });
        } else {
          swal("Oops!", "User Group Not Added!", "error");
        }
    }
  });  
});

// DataTables
$(document).ready( function () {    
  $('#userGroup-table').DataTable({
      "ajax": '{{ url(route('userGroup.index')) }}',
      "method": "GET",
      columns: [
        {"data": "id"},
        {"data": "name"},
        {
          "data": null,
            "render": function (data,type, row) {
            return '<button id="deleteBtn" class="btn btn-success"  value ="'+data.id+ '"><i class="bi bi-eye-fill"></i></button>'
          }
        },
        {
          "data": null,
          "render": function (data,type, row) {
            return '<button id="editBtn" class="btn btn-success" onclick="showEmployeeEdit('+data.id+')" value="'+data.id+'" ><i class="bi bi-pen"></i></button>'
          }
        },
        {
          "data": null,
            "render": function (data,type, row) {
            return '<button id="deleteBtn" class="btn btn-danger" onclick="showUserDelete('+data.id+')"  value="'+data.id+'"><i class="bi bi-trash"></i></button>'
          }
        }
        ],
          'aoColumnDefs': [{
          'bSortable': false,
          'aTargets': ['nosort']
        }]
  }); 
});
</script>
@endpush