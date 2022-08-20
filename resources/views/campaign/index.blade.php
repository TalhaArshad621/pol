@extends('layouts.app')
@push("css")
  <link rel="stylesheet" type="text/css" href="{{ asset("Datatables/datatables.css") }}">
@endpush
@section('content')

<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="/campaigns">Campaign</a></li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Location Table</h5>
              <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#addNewCampaignModal">
                Register Location
              </button>
              <!-- Table with stripped rows -->
              <table id="campaign-table" class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>City</th>
                        <th>Start Campaign</th>
                        <th>edit</th>
                        <th>delete</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>City</th>
                        <th>Start Campaign</th>
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

<div class="modal fade" id="addNewCampaignModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add new Campaign</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Multi Columns Form -->
          <form class="row g-3" id="campaign-form">
            @csrf
            <div class="col-md-12">
              <label for="inputName5" class="form-label">Name</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
            </div>
            <div class="col-md-12">
              <label for="address" class="form-label">Location code</label>
              <select name="lc" id="lc" class="form-select">
                  <option value="">Select Location Code</option>
                  @foreach ($location_code as $item)
                      <option value="{{ $item->id }}">{{ $item->lc }}</option>
                  @endforeach
              </select>
            </div>
            <div class="col-md-12">
                <label for="contactNumber" class="form-label">city</label>
                <input type="text" class="form-control" id="city" name="city" placeholder="Enter contact city">
            </div>
          </form><!-- End Multi Columns Form -->
        </div>
        <div class="modal-footer">
            <button id="add-campaign" type="button" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div><!-- End Large Modal-->


<div class="modal fade" id="editCampaignModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Campaign</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Multi Columns Form -->
        <form class="row g-3" id="edit-campaign-form">
          @csrf
          <input type="hidden" class="form-control" name="editCampiagnId" id="editCampiagnId">
          <div class="col-md-12">
            <label for="inputName5" class="form-label">Name</label>
            <input type="text" class="form-control" id="editName" name="editName" placeholder="Enter Name">
          </div>
          <div class="col-md-12">
            <label for="address" class="form-label">Location code</label>
            <select name="editLc" id="editLc" class="form-select">
                <option value="">Select Location Code</option>
                @foreach ($location_code as $item)
                    <option value="{{ $item->id }}">{{ $item->lc }}</option>
                @endforeach
            </select>
          </div>
          <div class="col-md-12">
              <label for="contactNumber" class="form-label">city</label>
              <input type="text" class="form-control" id="editCity" name="editCity" placeholder="Enter contact city">
          </div>
        </form><!-- End Multi Columns Form -->
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="updateCampaign()">Submit</button>
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
  $('#campaign-table').DataTable().ajax.reload(null,false)
}
//add usergroup
$('#add-campaign').on('click', function(e) {
    e.preventDefault();
    var form = $("#campaign-form").serialize();

    $.ajax({
    type: "POST",
    url: '{{ url(route('campaigns.store')) }}',
    data: form,
    success: function(response) {
      $('#addNewCampaignModal').modal('hide');
      $('body').removeClass('modal-open');
      $('.modal-backdrop').remove();
      $('#campaign-form')[0].reset();
        if(response.status == 200) {
            swal({
                title: 'Success',
                text: 'Campaign Added Successfully!',
                icon: 'success',
                buttons: true
            }).then(function(value) {
                if(value === true) {
                  reloadTable();
                }
            });
        } else {
          swal("Oops!", "Campaign Not Added!", "error");
        }
    }
  });  
});


//get client info ,fill the edit modal form,
function showServiceEdit(id){
  $.ajax({
      type: "GET",
      url:  "{{ url(route('campaign.show','')) }}"+ "/" +id,
      success: function(response) {
        if(response.code == 200) {
          $("#editCampiagnId").attr("value",id);
          $("#editName").attr("value",response.data.name);
          $("#editCity").attr("value",response.data.city);
          $("#editLc").val(response.data.lc).change();
          $("#editCampaignModal").modal("toggle");
        }
      }
  });
}

//get client info ,fill the edit modal form,
function showRequestModal(id){
  $.ajax({
      type: "GET",
      url:  "{{ url(route('patient.get','')) }}"+ "/" +id,
      success: function(response) {
        if(response.code == 200) {
          $("#PatientId").attr("value",id);
          $("#requestName").attr("value",response.data.name);
          $("#requestAge").attr("value" ,response.data.age);
          $("#addNewRequestModal").modal("toggle");
        }
      }
  });
}

//update patient
function updateCampaign() {
  var form = $("#edit-campaign-form").serialize();
  $.ajax({
    type: "PUT",
    url: '{{ url(route('campaign.update','')) }}/' + $('#editCampiagnId').val(),
    data: form,
    success: function(response) {
      $("#editCampaignModal").modal("hide");
      $('#edit-campaign-form')[0].reset();
      if(response.code == 200){
        swal({
              title: 'Success',
              text: 'Campiagn Updated Successfully!',
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

function startCampaign(id){
  $.ajax({
      type: "GET",
      url:  "{{ url(route('campaign.start','')) }}"+ "/" +id,
      success: function(response) {
        console.log(response);
        if(response.code == 200) {
          alert(response.message);
          window.location.replace("{{ url(route('campaign.create','')) }}"+ "/" +id);
        } else {
          alert(response.message);
          window.location.replace("{{ url(route('campaign.create','')) }}"+ "/" +id);
        }
      }
  });
}

// DataTables
// DataTables
$(document).ready( function () {    
  $('#campaign-table').DataTable({
      "ajax": '{{ url(route('campaigns.index')) }}',
      "method": "GET",
      columns: [
        {"data": "id"},
        {"data": "name"},
        {"data": "lc"},
        {"data": "city"},
        {
          "data": null,
            "render": function (data,type, row) {
            return `<a id="campaignStart" onclick="startCampaign(${row.id})"   class="btn btn-primary campaignStart"><i class="bi bi-plus-circle"></i></a>`
          }
        },
        {
          "data": null,
          "render": function (data,type, row) {
            return '<button id="editBtn" onclick="showServiceEdit('+row.id+')" class="btn btn-success"><i class="bi bi-pen"></i></button>'
          }
        },
        {
          "data": null,
            "render": function (data,type, row) {
            return '<button id="deleteBtn" class="btn btn-danger"><i class="bi bi-trash"></i></button>'
          }
        }
        ],
          'aoColumnDefs': [{
          'bSortable': false,
          'aTargets': ['nosort']
        }],
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        'columnDefs': [
            { responsivePriority: 1, targets: 1 },
            { className: 'text-center', targets: [0, 1, 2, 3, 4, 5, 6 ] },
        ]
  }); 
});
</script>

@endpush