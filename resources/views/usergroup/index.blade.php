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
                            <th>edit</th>
                            <th>delete</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>User Group</th>
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
          <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div><!-- End Large Modal-->

<div class="modal fade" id="editUserGroupModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit User Group</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Multi Columns Form -->
        <form class="row g-3" id="userGroupEditForm">
          @csrf
          <input type="hidden" name="userGroupEditID" id="userGroupEditID">
          <div class="col-md-6">
            <label for="inputName5" class="form-label">Name</label>
            <input type="text" class="form-control" id="userGroupEditName" name="userGroupEditName" placeholder="Enter Name">
          </div>
          <div class="col-md-6">
            <label for="inputslug5" class="form-label">slug</label>
            <input type="text" class="form-control" id="userGroupEditSlug" name="userGroupEditSlug" placeholder="Enter slug">
          </div>
          @include('usergroup.permissionEdit',$permissions=[])
        </form><!-- End Multi Columns Form -->
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="updateUserGroup()">Submit</button>
          <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div><!-- End Large Modal-->

@endsection

@push('js')


<script>

$('.patientEdit,  .requestEdit, .bloodbagEdit, .donatorEdit, .donationEdit, .UserEdit, .usergroupEdit, .donationRequestEdit, .campaignEdit, .reportEdit').on('change', function(e) {
    let className = '.' + ($(this).attr('class'))+'SelectAll';
   ($( '.' + ($(this).attr('class')) +':checked').length == $( '.' + ($(this).attr('class'))).length) ?  $(className).prop('checked',true) : $(className).prop('checked',false);  
});

// tablereload
function reloadTable(){
  $('#userGroup-table').DataTable().ajax.reload(null,false)
}

// slug
function convertToSlug(Text) {
  return Text.toLowerCase()
             .replace(/ /g, '-')
             .replace(/[^\w-]+/g, '');
}

$("#userGroupname").on("input", function (){
  var userGroup = $("#userGroupname").val();
  $("#slug").attr("value", convertToSlug(userGroup));
})

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
        if(response.code == 200) {
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

//get User Group info ,fill the edit modal form,
function showUserGroupEdit(id){
  $.ajax({
      type: "GET",
      url:  "{{ url(route('userGroup.get','')) }}"+ "/" +id,
      success: function(response) {
        if(response.code == 200) {
          $("#userGroupEditID").attr("value",id);
          $("#userGroupEditName").attr("value",response.data.name);
          $("#userGroupEditSlug").attr("value",response.data.slug);
          const all_permissions = [".patientEdit", ".requestEdit", ".bloodbagEdit",".donatorEdit",".donationEdit",".UserEdit",".usergroupEdit",".donationRequestEdit",".campaignEdit",".reportEdit"];
          $(all_permissions).map(function(index){
              let sub_permissions = all_permissions[index];
              $(sub_permissions).map(function(index,el){
               if(response.permissions.includes(Number(el.value)) ){
                 let n  = $(sub_permissions)[index];
                 $(n).prop("checked",true);
               }
              });
            $(all_permissions[index]+':checked').length == $(all_permissions[index]).length ? $(all_permissions[index]+ 'SelectAll' ).prop('checked',true) :  $(all_permissions[index]+ 'SelectAll' ).prop('checked',false) ;
          });
          $("#editUserGroupModal").modal("toggle");
        }
      }
  });
}

//update user group
function updateUserGroup() {
  var form = $("#userGroupEditForm").serialize();
  $.ajax({
    type: "PUT",
    url: '{{ url(route('usergroup.update','')) }}/' + $('#userGroupEditID').val(),
    data: form,
    success: function(response) {   
      if(response.code == 200){
        $("#editUserGroupModal").modal("hide");
        $('#userGroupEditForm')[0].reset();
        swal({
                title: 'Success',
                text: 'User Group Updated Successfully!',
                icon: 'success',
                buttons: true
            }).then(function(value) {
                if(value === true) {                    
                  reloadTable();
                }
            });
      } else{

        swal("Oops!", "Dubplicate information... User Group Not Updated!", "error");
      }
    },
    error: function(response){
      swal("Oops!", "User Group Not Updated!", "error");
    }
  });  
}

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
            return '<button id="editBtn" class="btn btn-success" onclick="showUserGroupEdit('+data.id+')" value="'+data.id+'" ><i class="bi bi-pen"></i></button>'
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