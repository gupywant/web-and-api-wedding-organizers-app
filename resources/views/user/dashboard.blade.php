@extends('/user/app/app')
@section('content')
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Dashboard</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
                </ol>
              </nav>
            </div>
          </div>
          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">View's This Month</h5>
                      <span class="h2 font-weight-bold mb-0">{{$newViews}}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                        <i class="ni ni-active-40"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    @if($oldViews<=$newViews)
                      <span class="text-success mr-2"><i class="fa fa-arrow-up"></i>{{$percentageViews}}%</span>
                    @else
                      <span class="text-danger mr-2"><i class="fa fa-arrow-down"></i>{{$percentageViews}}%</span>
                    @endif
                    <span class="text-nowrap">Since last month</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">New users</h5>
                      <span class="h2 font-weight-bold mb-0">{{$newUser}}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                        <i class="ni ni-chart-pie-35"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    @if($oldUser<=$newUser)
                      <span class="text-success mr-2"><i class="fa fa-arrow-up"></i>{{$percentageUsers}}%</span>
                    @else
                      <span class="text-danger mr-2"><i class="fa fa-arrow-down"></i>{{$percentageUsers}}%</span>
                    @endif
                    <span class="text-nowrap">Since last month</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total Service</h5>
                      <span class="h2 font-weight-bold mb-0">{{$service}}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                        <i class="ni ni-money-coins"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-nowrap">Your Total</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Service Active</h5>
                      <span class="h2 font-weight-bold mb-0">{{$servicePerformance}}%</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                        <i class="ni ni-chart-bar-32"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    @if($oldServiceReserved<=$newServiceReserved)
                      <span class="text-success mr-2"><i class="fa fa-arrow-up"></i>{{$percentageRserverdSerivice}}%</span>
                    @else
                      <span class="text-danger mr-2"><i class="fa fa-arrow-down"></i>{{$percentageRserverdSerivice}}%</span>
                    @endif
                    <span class="text-nowrap">Since last month</span>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">5 Most Viewed Service by User</h3>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  @if(session('message'))
                  <div class="card-header bg-transparent pb-2">
                    <div class="alert alert-success">
                      <strong>Sukses!</strong> {!!session('message')!!}.
                    </div>
                  </div>
                  @endif
                  @if(session('alert'))
                  <div class="card-header bg-transparent pb-2">
                    <div class="alert alert-danger">
                      <strong>Gagal!</strong> {!!session('alert')!!}.
                    </div>
                  </div>
                  @endif
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Visitor Name</th>
                    <th scope="col">Total</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                    $no = 1;
                  @endphp
                  @foreach($visitGraf as $key => $data)
                  <tr>
                    <th scope="row">
                      {{$no++}}
                    </th>
                    <td>
                      {{$data->name}}
                    </td>
                    <td>
                      {{$data->count}}
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
@endsection