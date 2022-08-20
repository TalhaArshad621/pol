@extends('layouts.app')
@push("css")
  <link rel="stylesheet" type="text/css" href="{{ asset("Datatables/datatables.css") }}">
@endpush
@section('content')

<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="/donators">Donator</a></li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Donator Table</h5>
              <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#addNewDonatorModal">
                Add Donator
              </button>
              <!-- Table with stripped rows -->
              <table id="donator-table" class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Blood Type</th>
                        <th>next donation</th>
                        <th>view</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Blood Type</th>
                        <th>next donation</th>
                        <th>view</th>
                    </tr>
                </tfoot>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
</div>

<div class="modal fade" id="addNewDonatorModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add new Donator</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Multi Columns Form -->
          <form class="row g-3" id="donator-form">
            @csrf
            <input type="hidden" name="app" id="app" value="0">
            <div class="col-md-12">
              <label for="inputName5" class="form-label">Name</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
            </div>
            <div class="col-md-12">
              <label for="address" class="form-label">Address</label>
              <textarea type="text" class="form-control" id="address" name="address" placeholder="Enter Address"></textarea>
            </div>
            <div class="col-md-12">
                <label for="contactNumber" class="form-label">Contact number</label>
                <input type="text" class="form-control" id="contact_num" name="contact_num" placeholder="Enter contact number">
            </div>
            <div class="col-md-12">
                <label for="contactNumber" class="form-label">CNIC</label>
                <input type="text" maxlength="13" class="form-control" id="cnic" name="cnic" placeholder="Enter 13 digit cnic number">
            </div>
            <div class="col-md-6">
              <label for="Age" class="form-label">Age</label>
              <input type="number" class="form-control" id="age" name="age" placeholder="Enter Age">
            </div>
            <div class="col-md-6">
              <label for="gender" class="form-label">gender</label>
              <select class="form-select" name="gender" id="gender" >
                <option selected>Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
              </select>
            </div>
            <div class="col-md-6">
                <label for="BloodType" class="form-label">Blood Type</label>
                <select class="form-select" name="blood_type" id="blood_type" >
                  <option selected>Select Blood Type</option>
                  <option value="A+">A+</option>
                  <option value="A-">A-</option>
                  <option value="B+">B+</option>
                  <option value="B-">B-</option>
                  <option value="AB+">AB+</option>
                  <option value="AB-">AB-</option>
                  <option value="O+">O+</option>
                  <option value="O-">O-</option>
                </select>
              </div>
          </form><!-- End Multi Columns Form -->
        </div>
        <div class="modal-footer">
            <button id="add-donator" type="button" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div><!-- End Large Modal-->


<div class="modal fade" id="editDonatorModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update new Donator</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Multi Columns Form -->
        <form class="row g-3" id="edit-donator-form">
          @csrf
          <input type="hidden" class="form-control" name="editDonatorId" id="editDonatorId">
          <div class="col-md-12">
            <label for="inputName5" class="form-label">Name</label>
            <input type="text" class="form-control" id="editName" name="editName" placeholder="Enter Name">
          </div>
          <div class="col-md-12">
            <label for="address" class="form-label">Address</label>
            <textarea type="text" class="form-control" id="editAddress" name="editAddress" placeholder="Enter Address"></textarea>
          </div>
          <div class="col-md-12">
              <label for="contactNumber" class="form-label">Contact number</label>
              <input type="text" class="form-control" id="editContact_num" name="editContact_num" placeholder="Enter contact number">
          </div>
          <div class="col-md-12">
              <label for="contactNumber" class="form-label">CNIC</label>
              <input type="number" maxlength="13" class="form-control" id="editCnic" name="editCnic" placeholder="Enter 13 digit cnic number">
          </div>
          <div class="col-md-6">
            <label for="Age" class="form-label">Age</label>
            <input type="number" class="form-control" id="editAge" name="editAge" placeholder="Enter Age">
          </div>
          <div class="col-md-6">
            <label for="gender" class="form-label">gender</label>
            <select class="form-select" name="editGender" id="editGender" >
              <option selected>Select Gender</option>
              <option value="male">Male</option>
              <option value="female">Female</option>
            </select>
          </div>
          <div class="col-md-6">
              <label for="BloodType" class="form-label">Blood Type</label>
              <select class="form-select" name="editblood_type" id="editblood_type" >
                <option selected>Select Blood Type</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
              </select>
            </div>
        </form><!-- End Multi Columns Form -->
      </div>
      <div class="modal-footer">
          <button id="edit-donator" type="button" class="btn btn-primary" onclick="updateDonator()">Submit</button>
          <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div><!-- End Large Modal-->

<!-- Patient Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModal_Label">Delete</h5>
      </div>
      <div class="modal-body">
      <form id="DonatorDeleteForm" class="form-horizontal" role="form" method="post" action="">
        @csrf  
        <div class="mb-3">
            <input type="hidden" class="form-control" id="donatorDeleteID" name="donatorDeleteID" required  >
          </div>
          <h5 class="modal-title" id="deleteModal_UserLabel">Delete</h5>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" onclick="deleteDonator()">Delete</button>
      </div>
    </div>
  </div>
</div>

@endsection


@push('js')

<script>
// tablereload
function reloadTable(){
  $('#donator-table').DataTable().ajax.reload(null,false)
}
//add usergroup
$('#add-donator').on('click', function(e) {
    e.preventDefault();
    var form = $("#donator-form").serialize();

    $.ajax({
    type: "POST",
    url: '{{ url(route('donator.create')) }}',
    data: form,
    success: function(response) {
      $('#addNewDonatorModal').modal('hide');
      $('body').removeClass('modal-open');
      $('.modal-backdrop').remove();
      $('#donator-form')[0].reset();
        if(response.status == 200) {
            swal({
                title: 'Success',
                text: 'Donator Added Successfully!',
                icon: 'success',
                buttons: true
            }).then(function(value) {
                if(value === true) {
                  reloadTable();
                }
            });
        } else {
          swal("Oops!", "Donator Not Added!", "error");
        }
    }
  });  
});

//get client info ,fill the edit modal form,
function showDonatorEdit(id){
  $.ajax({
      type: "GET",
      url:  "{{ url(route('patient.get','')) }}"+ "/" +id,
      success: function(response) {
        if(response.code == 200) {
          $("#editDonatorId").attr("value",id);
          $("#editName").attr("value",response.data.name);
          $("#editAddress").val(response.data.address);
          $("#editContact_num").attr("value" ,response.data.contact_num);
          $("#editCnic").attr("value" ,response.data.cnic);
          $("#editAge").attr("value" ,response.data.age);
          $("#editGender").val(response.data.gender).change();
          $("#editblood_type").val(response.data.blood_type).change();
          $("#editDonatorModal").modal("toggle");
        }
      }
  });
}

//update patient
function updateDonator() {
  var form = $("#edit-donator-form").serialize();
  $.ajax({
    type: "PUT",
    url: '{{ url(route('patient.update','')) }}/' + $('#editDonatorId').val(),
    data: form,
    success: function(response) { 
      $("#editDonatorModal").modal("hide");
      $('#edit-donator-form')[0].reset();
      if(response.code == 200){
        swal({
              title: 'Success',
              text: 'Patient Updated Successfully!',
              icon: 'success',
              buttons: true
          }).then(function(value) {
              if(value === true) {                        
                reloadTable();
              }
          });
      } 
    },
    error: function(response){
      swal("Oops!",response.responseJSON.message , "error");
    }
  });  
}

function showDonatorDelete(id){
  $.ajax({
      type: "GET",
      url:  "{{ url(route('patient.get','')) }}"+ "/" +id,
      success: function(response) {
        if(response.code == 200) {
          $("#deleteModal_Label").html("Delete Patient ");
          $("#donatorDeleteID").attr("value",id);
          $("#deleteModal_UserLabel").html("Are you sure You want to Delete Patient");
          $("#deleteModal").modal("toggle");
        }
      }
  });
}

// Delete Patient
function deleteDonator(){
  var form = $("#DonatorDeleteForm").serialize();
  $.ajax({
    type: "DELETE",
    url: '{{ url(route('patient.destroy','')) }}/'+ $('#donatorDeleteID').val(),
    data: form,
    success: function(response) {
      $('#deleteModal').modal('hide');
      $('#DonatorDeleteForm')[0].reset();
      if(response.code == 200 ) {  
        swal({
            title: 'Success',
            text: 'Patient Deleted Successfully!',
            icon: 'success',
            buttons: true
        }).then(function(value) {
          if(value === true) {
            reloadTable();
          }
        });
      }
    }, error: function(response){
      swal("Oops!", "Patient Not Deleted!", "error");
    }
  });  
}
// DataTables
$(document).ready( function () {    
  $('#donator-table').DataTable({
      "ajax": '{{ url(route('donators.index')) }}',
      "method": "GET",
      columns: [
        {"data": "id"},
        {"data": "name"},
        {"data": "age"},
        {"data": "gender"},
        {"data": "blood_type"},
        {"data": 'nextSafeDonationDate'},
        {
          "data": null,
            "render": function (data,type, row) {
               return '<a  class="btn btn-primary" href ="/donators/' +row.id +'"><i class="bi bi-eye"></i></a>'
          }
        },
        ],
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
          'aoColumnDefs': [{
          'bSortable': false,
          'aTargets': ['nosort']
        }],
        'columnDefs': [
            { responsivePriority: 1, targets: 1 },
            { className: 'text-center', targets: [0, 1, 2, 3, 4, 5, 6] },
        ]
  }); 
});
</script>

@endpush