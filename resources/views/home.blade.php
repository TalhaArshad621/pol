@extends('layouts.app')

@section('content')
<div class="container">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->
      <section class="section dashboard">
        <div class="row">
  
          <!-- Left side columns -->
          <div class="col-lg-8">
            <div class="row">
  
              <!-- Sales Card -->
              <div class="col-xxl-4 col-md-6">
                <div class="card info-card sales-card">
                  <div class="card-body">
                    <h5 class="card-title">Donations <span>| Today</span></h5>
  
                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="ri-heart-add-fill"></i>
                      </div>
                      <div class="ps-3">
                        <h6>{{ $donation }}</h6>
                        <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>
  
                      </div>
                    </div>
                  </div>
  
                </div>
              </div><!-- End Sales Card -->
  
              <!-- Revenue Card -->
              <div class="col-xxl-4 col-md-6">
                <div class="card info-card revenue-card">
  
                  <div class="card-body">
                    <h5 class="card-title">Donators <span>| This Month</span></h5>
  
                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bx bxs-donate-heart"></i>
                      </div>
                      <div class="ps-3">
                        <h6>{{ $donator }}</h6>
                        <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span>
  
                      </div>
                    </div>
                  </div>
  
                </div>
              </div><!-- End Revenue Card -->
  
              <!-- Customers Card -->
              <div class="col-xxl-4 col-xl-12">
  
                <div class="card info-card customers-card">
  
                  <div class="card-body">
                    <h5 class="card-title">Campaigns <span>| Running</span></h5>
  
                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-megaphone-fill"></i>
                      </div>
                      <div class="ps-3">
                        <h6>1244</h6>
                        <span class="text-danger small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">decrease</span>
  
                      </div>
                    </div>
  
                  </div>
                </div>
  
              </div><!-- End Customers Card -->
  
              <!-- Reports -->
              <div class="col-12">
                <div class="card">
  
                  <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                      <li class="dropdown-header text-start">
                        <h6>Filter</h6>
                      </li>
  
                      <li><a class="dropdown-item" href="#">Today</a></li>
                      <li><a class="dropdown-item" href="#">This Month</a></li>
                      <li><a class="dropdown-item" href="#">This Year</a></li>
                    </ul>
                  </div>
  
                  <div class="card-body">
                    <h5 class="card-title">Reports <span>/Today</span></h5>
  
                    <!-- Line Chart -->
                    <div id="reportsChart"></div>
  
                    <script>
                      document.addEventListener("DOMContentLoaded", () => {
                        new ApexCharts(document.querySelector("#reportsChart"), {
                          series: [{
                            name: 'Sales',
                            data: [31, 40, 28, 51, 42, 82, 56],
                          }, {
                            name: 'Revenue',
                            data: [11, 32, 45, 32, 34, 52, 41]
                          }, {
                            name: 'Customers',
                            data: [15, 11, 32, 18, 9, 24, 11]
                          }],
                          chart: {
                            height: 350,
                            type: 'area',
                            toolbar: {
                              show: false
                            },
                          },
                          markers: {
                            size: 4
                          },
                          colors: ['#4154f1', '#2eca6a', '#ff771d'],
                          fill: {
                            type: "gradient",
                            gradient: {
                              shadeIntensity: 1,
                              opacityFrom: 0.3,
                              opacityTo: 0.4,
                              stops: [0, 90, 100]
                            }
                          },
                          dataLabels: {
                            enabled: false
                          },
                          stroke: {
                            curve: 'smooth',
                            width: 2
                          },
                          xaxis: {
                            type: 'datetime',
                            categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
                          },
                          tooltip: {
                            x: {
                              format: 'dd/MM/yy HH:mm'
                            },
                          }
                        }).render();
                      });
                    </script>
                    <!-- End Line Chart -->
  
                  </div>
  
                </div>
              </div><!-- End Reports -->
              <!-- Recent Sales -->
              <div class="col-12">
                <div class="card recent-sales">
                  <div class="card-body">
                    <h5 class="card-title">Blood Bags <span>| Inventory</span></h5>
  
                    <table class="table table-borderless datatable">
                      <thead>
                        <tr>
                          <th scope="col">id</th>
                          <th scope="col">Blood Type</th>
                          <th scope="col">donation Type</th>
                          <th scope="col">Quantity</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($blood_bags as $item)
                        <tr>
                          <th scope="row"><a href="#">{{ $item->id }}</a></th>
                          <td>{{ $item->blood_type }}</td>
                          <td><a href="#" class="text-primary">{{ $item->donation_type }}</a></td>
                          <td>{{ $item->quantity_cc }}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
  
                  </div>
  
                </div>
              </div><!-- End Recent Sales -->
  
            </div>
          </div><!-- End Left side columns -->
  
          <!-- Right side columns -->
          <div class="col-lg-4">
  
            <!-- Recent Activity -->
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Blood Bags Alert</h5>
  
                <div class="activity" id="activity">
  
                  {{-- <div class="activity-item d-flex">
                    <div class="activite-label">32 min</div>
                    <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                    <div class="activity-content">
                      Quia quae rerum <a href="#" class="fw-bold text-dark">explicabo officiis</a> beatae
                    </div>
                  </div><!-- End activity item-->
  
                  <div class="activity-item d-flex">
                    <div class="activite-label">56 min</div>
                    <i class='bi bi-circle-fill activity-badge text-danger align-self-start'></i>
                    <div class="activity-content">
                      Voluptatem blanditiis blanditiis eveniet
                    </div>
                  </div><!-- End activity item--> --}}
{{--   
                  <div class="activity-item d-flex">
                    <div class="activite-label">2 hrs</div>
                    <i class='bi bi-circle-fill activity-badge text-primary align-self-start'></i>
                    <div class="activity-content">
                      Voluptates corrupti molestias voluptatem
                    </div>
                  </div><!-- End activity item-->
  
                  <div class="activity-item d-flex">
                    <div class="activite-label">1 day</div>
                    <i class='bi bi-circle-fill activity-badge text-info align-self-start'></i>
                    <div class="activity-content">
                      Tempore autem saepe <a href="#" class="fw-bold text-dark">occaecati voluptatem</a> tempore
                    </div>
                  </div><!-- End activity item-->
  
                  <div class="activity-item d-flex">
                    <div class="activite-label">2 days</div>
                    <i class='bi bi-circle-fill activity-badge text-warning align-self-start'></i>
                    <div class="activity-content">
                      Est sit eum reiciendis exercitationem
                    </div>
                  </div><!-- End activity item-->
  
                  <div class="activity-item d-flex">
                    <div class="activite-label">4 weeks</div>
                    <i class='bi bi-circle-fill activity-badge text-muted align-self-start'></i>
                    <div class="activity-content">
                      Dicta dolorem harum nulla eius. Ut quidem quidem sit quas
                    </div>
                  </div><!-- End activity item--> --}}
  
                </div>
  
              </div>
            </div><!-- End Recent Activity -->
  
            <!-- Budget Report -->
            <div class="card">
              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>
  
                  <li><a class="dropdown-item" href="#">Today</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
              </div>
  
              <div class="card-body pb-0">
                <h5 class="card-title">Budget Report <span>| This Month</span></h5>
  
                <div id="budgetChart" style="min-height: 400px;" class="echart"></div>
  
                <script>
                  document.addEventListener("DOMContentLoaded", () => {
                    var budgetChart = echarts.init(document.querySelector("#budgetChart")).setOption({
                      legend: {
                        data: ['Allocated Budget', 'Actual Spending']
                      },
                      radar: {
                        // shape: 'circle',
                        indicator: [{
                            name: 'Sales',
                            max: 6500
                          },
                          {
                            name: 'Administration',
                            max: 16000
                          },
                          {
                            name: 'Information Technology',
                            max: 30000
                          },
                          {
                            name: 'Customer Support',
                            max: 38000
                          },
                          {
                            name: 'Development',
                            max: 52000
                          },
                          {
                            name: 'Marketing',
                            max: 25000
                          }
                        ]
                      },
                      series: [{
                        name: 'Budget vs spending',
                        type: 'radar',
                        data: [{
                            value: [4200, 3000, 20000, 35000, 50000, 18000],
                            name: 'Allocated Budget'
                          },
                          {
                            value: [5000, 14000, 28000, 26000, 42000, 21000],
                            name: 'Actual Spending'
                          }
                        ]
                      }]
                    });
                  });
                </script>
  
              </div>
            </div><!-- End Budget Report -->
  
          </div><!-- End Right side columns -->
  
        </div>
      </section>
</div>
@endsection
@push('js')
<script>
 $(document).ready(function () {
  var color = ['text-success','text-danger', 'text-primary' , 'text-info', 'text-warning', 'text-muted'];
    $.ajax({
        type: "GET",
        url:  "{{ url(route('bloodBag-report')) }}",
        success: function(response) {
            $.each(response.missing_blood_type, function (key, value) {
              var html = `
                <div class="activity-item d-flex">
                  <div class="activite-label">${key + 1}</div>
                    <i class='bi bi-circle-fill activity-badge ${color[key]} align-self-start'></i>
                    <div class="activity-content">
                      <a href="#" class="fw-bold text-dark">${value.blood_type} </a> Bags Not Available
                    </div>
                </div>
              `;
              $( "#activity" ).append( html );
            })
        }
    });
 })
</script>
@endpush