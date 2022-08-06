@extends('layouts.app')
@push("css")
  <link rel="stylesheet" type="text/css" href="{{ asset("Datatables/datatables.css") }}">
@endpush
@section('content')

<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="/store">Blood Bags</a></li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Blood Bags Table</h5>
             
              <!-- Table with stripped rows -->
              <table id="store-table" class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Donation type</th>
                        <th>Blood Type</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Donation type</th>
                        <th>Blood Type</th>
                        <th>Quantity</th>
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
  $('#store-table').DataTable({
      "ajax": '{{ url(route('bloodBag.index')) }}',
      "method": "GET",
      columns: [
        {"data": "id"},
        {"data": "donation_type"},
        {"data": "blood_type"},
        {"data": "quantity_cc"},
        ],
          'aoColumnDefs': [{
          'bSortable': false,
          'aTargets': ['nosort']
        }],
        'columnDefs': [
            { responsivePriority: 1, targets: 1 },
            { className: 'text-center', targets: [0, 1, 2, 3] },
        ]
  }); 
});
</script>

@endpush