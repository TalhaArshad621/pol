@extends('layouts.app')
@push("css")
  <link rel="stylesheet" type="text/css" href="{{ asset("Datatables/datatables.css") }}">
@endpush
@section('content')

<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="/report">Report</a></li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Report</h5>
             
              <!-- Table with stripped rows -->
              <table id="report-table" class="table">
                <thead>
                    <tr>
                        <th>Blood Type</th>
                        <th>Quantity</th>
                        <th>Location</th>
                        <th>date</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Blood Type</th>
                        <th>Quantity</th>
                        <th>Location</th>
                        <th>date</th>
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
  $('#report-table').DataTable({
      "ajax": '{{ url(route('get.report')) }}',
      "method": "GET",
      columns: [
        {"data": "blood_type"},
        {"data": "quantity"},
        {"data": "name"},
        {"data": "date"},
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
            { className: 'text-center', targets: [0, 1, 2, 3] },
        ]
  }); 

});
</script>

@endpush