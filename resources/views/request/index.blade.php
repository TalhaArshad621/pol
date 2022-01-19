@extends('layouts.app')
@push("css")
  <link rel="stylesheet" type="text/css" href="{{ asset("Datatables/datatables.css") }}">
@endpush
@section('content')

<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="/request">Request</a></li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Request Table</h5>

              <!-- Table with stripped rows -->
              <table id="request-table" class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Patient</th>
                        <th>Quantity</th>
                        <th>Blood Type</th>
                        <th>level</th>
                        <th>Status</th>
                        <th>edit</th>
                        <th>delete</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Patient</th>
                        <th>Quantity</th>
                        <th>Blood Type</th>
                        <th>level</th>
                        <th>Status</th>
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


@endsection


@push('js')

<script>

// DataTables
$(document).ready( function () {    
  $('#request-table').DataTable({
      "ajax": '{{ url(route('requests.index')) }}',
      "method": "GET",
      columns: [
        {"data": "id"},
        {"data": "name"},
        {"data": "amount"},
        {"data": "bloodGroup"},
        {"data": "level"},
        {
          "data": "status",
            "render": function (data,type, row) {
              if(data == 0){
            return '<span class="badge bg-warning text-dark p-2">pending</span>'
            }
            else{
              return '<span class="badge bg-primary p-2">Approved</span>'
            }
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
        }],
        'columnDefs': [
            { responsivePriority: 1, targets: 1 },
            { className: 'text-center', targets: [0, 1, 2, 3, 4, 5, 6, 7 ] },
        ]
  }); 
});
</script>

@endpush