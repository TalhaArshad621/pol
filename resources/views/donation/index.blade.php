@extends('layouts.app')
@push("css")
  <link rel="stylesheet" type="text/css" href="{{ asset("Datatables/datatables.css") }}">
@endpush
@section('content')

<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="/donation">Donation</a></li>
        </ol>
    </div>
</div>
@if(Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{Session::get('success')}}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Donation Table</h5>
              <a class="btn btn-primary mb-4" href="{{ route('donate.blood') }}" role="button">Donate Blood</a>
              <!-- Table with stripped rows -->
              <table id="donation-table" class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>blood type</th>
                        <th>Quantity</th>
                        <th>Donation Type</th>
                        <th>Location</th>
                        <th>view</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                      <th>Id</th>
                      <th>Name</th>
                      <th>blood type</th>
                      <th>Quantity</th>
                      <th>Donation Type</th>
                      <th>Location</th>
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

<div class="modal fade" id="addNewDonationModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add new Donation</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Multi Columns Form -->
          <form class="row g-3" id="donation-form">
            @csrf
            
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
        <form class="row g-3" id="edit-donation-form">
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
  $('#donation-table').DataTable().ajax.reload(null,false)
}

// DataTables
$(document).ready( function () {    
  $('#donation-table').DataTable({
      "ajax": '{{ url(route('donations.index')) }}',
      "method": "GET",
      columns: [
        {"data": "id"},
        {"data": "name"},
        {"data": "blood_type"},
        {"data": "quantity"},
        {"data": "donation_type"},
        {"data": "location"},
        {
          "data": null,
            "render": function (data,type, row) {
            return '<button id="requestBtn" class="btn btn-primary"><i class="bi bi-eye"></i></button>'
          }
        },
        ],
          'aoColumnDefs': [{
          'bSortable': false,
          'aTargets': ['nosort']
        }],
        'columnDefs': [
            { responsivePriority: 1, targets: 1 },
            { className: 'text-center', targets: [0, 1, 2, 3, 4, 5, 6 ] },
        ]
  }); 
});
</script>

@endpush