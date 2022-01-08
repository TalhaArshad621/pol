@extends('layouts.app')
@push("css")
  <link rel="stylesheet" type="text/css" href="{{ asset("Datatables/datatables.css") }}">
@endpush
@section('content')

<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="/patient">Patient</a></li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Patient Table</h5>
              <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#addNewPatientModal">
                Add Patient
              </button>
              <!-- Table with stripped rows -->
              <table id="patient-table" class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Blood Type</th>
                        <th>view</th>
                        <th>edit</th>
                        <th>delete</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Blood Type</th>
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

<div class="modal fade" id="addNewPatientModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add new Patient</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Multi Columns Form -->
          <form class="row g-3" id="patient-form">
            @csrf
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
            <button id="add-patient" type="button" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div><!-- End Large Modal-->


<div class="modal fade" id="editPatientModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update new Patient</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Multi Columns Form -->
        <form class="row g-3" id="edit-patient-form">
          @csrf
          <input type="hidden" class="form-control" name="editPatientId" id="editPatientId">
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
          <button id="edit-patient" type="button" class="btn btn-primary" onclick="updatePatient()">Submit</button>
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
      <form id="PatientDeleteForm" class="form-horizontal" role="form" method="post" action="">
        @csrf  
        <div class="mb-3">
            <input type="hidden" class="form-control" id="patientDeleteID" name="patientDeleteID" required  >
          </div>
          <h5 class="modal-title" id="deleteModal_UserLabel">Delete</h5>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button  id="deleteUserBtn" type="button" class="btn btn-danger" onclick="deletePatient()">Delete</button>
      </div>
    </div>
  </div>
</div>
@endsection


@push('js')

<script>
// tablereload
function reloadTable(){
  $('#patient-table').DataTable().ajax.reload(null,false)
}
//add usergroup
$('#add-patient').on('click', function(e) {
    e.preventDefault();
    var form = $("#patient-form").serialize();

    $.ajax({
    type: "POST",
    url: '{{ url(route('patient.create')) }}',
    data: form,
    success: function(response) {
      $('#addNewPatientModal').modal('hide');
      $('body').removeClass('modal-open');
      $('.modal-backdrop').remove();
      $('#patient-form')[0].reset();
        if(response.status == 200) {
            swal({
                title: 'Success',
                text: 'Patient Added Successfully!',
                icon: 'success',
                buttons: true
            }).then(function(value) {
                if(value === true) {
                  reloadTable();
                }
            });
        } else {
          swal("Oops!", "Patient Not Added!", "error");
        }
    }
  });  
});

//get client info ,fill the edit modal form,
function showServiceEdit(id){
  $.ajax({
      type: "GET",
      url:  "{{ url(route('patient.get','')) }}"+ "/" +id,
      success: function(response) {
        if(response.code == 200) {
          $("#editPatientId").attr("value",id);
          $("#editName").attr("value",response.data.name);
          $("#editAddress").val(response.data.address);
          $("#editContact_num").attr("value" ,response.data.contact_num);
          $("#editAge").attr("value" ,response.data.age);
          $("#editGender").val(response.data.gender).change();
          $("#editblood_type").val(response.data.blood_type).change();
          $("#editPatientModal").modal("toggle");
        }
      }
  });
}

//update patient
function updatePatient() {
  var form = $("#edit-patient-form").serialize();
  $.ajax({
    type: "PUT",
    url: '{{ url(route('patient.update','')) }}/' + $('#editPatientId').val(),
    data: form,
    success: function(response) { 
      $("#editPatientModal").modal("hide");
      $('#edit-patient-form')[0].reset();
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

function showPatientDelete(id){
  $.ajax({
      type: "GET",
      url:  "{{ url(route('patient.get','')) }}"+ "/" +id,
      success: function(response) {
        if(response.code == 200) {
          $("#deleteModal_Label").html("Delete Patient ");
          $("#patientDeleteID").attr("value",id);
          $("#deleteModal_UserLabel").html("Are you sure You want to Delete Patient");
          $("#deleteModal").modal("toggle");
        }
      }
  });
}

// Delete Patient
function deletePatient(){
  var form = $("#PatientDeleteForm").serialize();
  $.ajax({
    type: "DELETE",
    url: '{{ url(route('patient.destroy','')) }}/'+ $('#patientDeleteID').val(),
    data: form,
    success: function(response) {
      $('#deleteModal').modal('hide');
      $('#PatientDeleteForm')[0].reset();
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
  $('#patient-table').DataTable({
      "ajax": '{{ url(route('patients.index')) }}',
      "method": "GET",
      columns: [
        {"data": "id"},
        {"data": "name"},
        {"data": "age"},
        {"data": "gender"},
        {"data": "blood_type"},
        {
          "data": null,
            "render": function (data,type, row) {
            return '<button id="deleteBtn" class="btn btn-success"  value ="'+data.id+ '"><i class="bi bi-eye-fill"></i></button>'
          }
        },
        {
          "data": null,
          "render": function (data,type, row) {
            return '<button id="editBtn" class="btn btn-success" onclick="showServiceEdit('+data.id+')" value="'+data.id+'" ><i class="bi bi-pen"></i></button>'
          }
        },
        {
          "data": null,
            "render": function (data,type, row) {
            return '<button id="deleteBtn" class="btn btn-danger" onclick="showPatientDelete('+data.id+')"  value="'+data.id+'"><i class="bi bi-trash"></i></button>'
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