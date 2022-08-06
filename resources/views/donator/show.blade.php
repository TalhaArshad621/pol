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
        <div class="col-xl-4">

          <div class="card info-card revenue-card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bx bxs-donate-heart"></i>
                </div>
              <h2 class="pt-1">{{ $donator->name }}</h2>
              <h3>Blood Donor</h3>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#donations">Donations</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#pre-exam">Pre Exams</button>
                </li>

              </ul>
              <div class="tab-content pt-2">
                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8">{{ $donator->name }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Cnic</div>
                    <div class="col-lg-9 col-md-8">{{ $donator->cnic }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Gender</div>
                    <div class="col-lg-9 col-md-8">{{ $donator->gender }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Blood Type</div>
                    <div class="col-lg-9 col-md-8">{{ $donator->blood_type }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Age</div>
                    <div class="col-lg-9 col-md-8">{{ $donator->age }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Donation Points</div>
                    <div class="col-lg-9 col-md-8">{{ $donator->points }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Next Donation Date</div>
                    <div class="col-lg-9 col-md-8">{{ $donator->nextSafeDonationDate }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Address</div>
                    <div class="col-lg-9 col-md-8">{{ $donator->address }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8">{{ $donator->number }}</div>
                  </div>

                </div>

                <div class="tab-pane fade donations pt-3" id="donations">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table text-center">
                                <thead>
                                    <tr>
                                        <th>
                                            Blood bags
                                        </th>
                                        <th>
                                            Donation Type
                                        </th>
                                        <th>
                                            Location
                                        </th>
                                        <th>
                                            Donation Date
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($donation as $item)
                                    <tr>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->donation_type }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{  \Carbon\Carbon::parse($item->created_at)->format("Y-m-d") }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade pt-3" id="pre-exam">
                  <table class="table text-center">
                    <thead>
                      <tr>
                        <th>
                          Hemoglobin g/dl
                        </th>
                        <th>
                          Temperature F
                        </th>
                        <th>
                          Blood Pressure
                        </th>
                        <th>
                          Pulse Rate BPM
                        </th>
                        <th>
                          Conducted on
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($preExam as $item)
                          <tr>
                            <td>{{ $item->hemoglobin_gDl }}</td>
                            <td>{{ $item->temperature_F }}</td>
                            <td>{{ $item->blood_pressure }}</td>
                            <td>{{ $item->pulse_rate_BPM }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format("Y-m-d") }}</td>
                          </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>

              </div><!-- End Bordered Tabs -->

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