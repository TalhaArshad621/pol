@extends('layouts.app')
@push("css")
  <link rel="stylesheet" type="text/css" href="{{ asset("Datatables/datatables.css") }}">
@endpush
@section('content')

<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="/campaign">Camapign</a></li>
            <li class="breadcrumb-item active"><a href="/campaign-create">Campaign Create</a></li>
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
              <h5 class="card-title">Donate Blood</h5>
              <hr>
              <div id="searchDonor" class="row" style="align-items: flex-end">
                  <div class="col-md-6">
                    <label for="" class="form-label">Search Donor</label>
                    <input type="text" class="form-control" name="cnic" id="cnic" maxlength="13" placeholder="Enter Donor 13 digit cnic">
                    </div>
                    <div class="col-md-5 pt-4">
                        <button class="btn btn-info" id="getCnic">
                            Search
                        </button>
                    </div>
              </div>
              <!-- Multi Columns Form -->
              <form id="donorFound" class="row g-3 none" action="{{ route('campaign.store') }}" method="POST">
                @csrf
                <input type="hidden" name="donor_id" id="donor_id">
                <input type="hidden" name="location_id" id="location_id" value="{{ $id }}">
                    <div class="col-md-6">
                        <label for="" class="form-label">Donor Name</label>
                        <input 
                        type="text"
                        id="donor_name"
                        class="form-control"
                        disabled
                        >
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Blood Type</label>
                        <input 
                        type="text"
                        class="form-control"
                        id="blood_type"
                        disabled
                        >
                    </div>
                <div class="col-md-6">
                  <label for="" class="form-label">Hemoglobin g/dl</label>
                  <input 
                  type="text"
                  id="hemoglobin_gDl"
                  name="hemoglobin_gDl"
                  class="form-control"
                  >
              </div>
              <div class="col-md-6">
                  <label for="" class="form-label">Temperature</label>
                  <input 
                  type="text"
                  class="form-control"
                  id="temperature"
                  name="temperature"
                  >
              </div>
              <div class="col-md-6">
                  <label for="" class="form-label">Blood Pressure</label>
                  <input 
                  type="text"
                  class="form-control"
                  id="blood_pressure"
                  name="blood_pressure"
                  >
              </div>
              <div class="col-md-6">
                  <label for="" class="form-label">Pulse Rate bpm</label>
                  <input 
                  type="text"
                  class="form-control"
                  id="pulse_rate_BPM"
                  name="pulse_rate_BPM"
                  >
              </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Blood Amount</label>
                        <input 
                        type="number"
                        class="form-control"
                        id="blood_amount"
                        name="blood_amount"
                        placeholder="Enter the Donation amount"
                        >
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Donation Type</label>
                        <select name="donation_type" id="donation_type" class="form-select">
                            <option value="">Select donation type</option>
                            <option value="blood">Blood</option>
                            <option value="plasma">Plasma</option>
                            <option value="platelets">Platelets</option>
                            <option value="power_red">power Red</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                </form><!-- End Multi Columns Form -->
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
                <input type="text" maxlength="13" class="form-control" id="donor_cnic" name="cnic" placeholder="Enter 13 digit cnic number">
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
@endsection

@push('js')
    <script >
        $("#getCnic").on('click', function(){
            let cnic = $("#cnic").val();
            $.ajax({
                type: "GET",
                url:  "{{ url(route('donator.get','')) }}"+ "/" +cnic,
                success: function(response) {
                    if(response.data){
                        $("#searchDonor").css("display",'none');
                        $("#donorFound").removeClass("none");
                        $("#donor_name").attr("value",response.data.name);
                        $("#blood_type").attr("value",response.data.blood_type);
                        $("#donor_id").attr("value", response.data.id);
                    } else{
                        alert("donator not found");
                        $('#addNewDonatorModal').modal('show'); 
                        $("#donor_cnic").attr("value",cnic)
                    }
                }
            });
        });
        
        //add donator
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
    </script>
@endpush