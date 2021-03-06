@extends('/user/app/app')
@section('content')
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Admin List</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Admin</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Admin List</li>
                </ol>
              </nav>
            </div>
            <div class="col-xl-12 order-xl-1">
	          <div class="card">
	            <!-- Card header -->
	            <div class="card-header border-0">
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
	            <!-- Light table -->
	            <div class="table-responsive">
	              <table class="table align-items-center table-flush" id="myTable">
	                <thead class="thead-light">
	                  <tr>
	                    <th scope="col" class="sort" data-sort="name">No</th>
	                    <th scope="col" class="sort" data-sort="budget">Nama</th>
	                    <th scope="col" class="sort" data-sort="status">Email</th>
	                    <th scope="col" class="sort" data-sort="completion">Perusahaan</th>
	                    <th scope="col" class="sort" data-sort="completion">Tlp</th>
	                    <th <th scope="col" class="sort" data-sort="completion">Tgl Daftar</th>
	                    <th scope="col">Aksi</th>
	                  </tr>
	                </thead>
	                <tbody class="list">
	                  	@php
	                		$no = 1;
	                	@endphp
	                	@foreach($admin as $key => $data)
						<tr>
							<th scope="row">
							  {{$no++}}
							</th>
							<td class="budget">
							  {{$data->name}}
							</td>
							<td>
							  {{$data->username}}
							</td>
							<td>
							  {{$data->company_name}}
							</td>
							<td>
							  {{$data->tlp}}
							</td>
							<td>
							  {{$data->created_at}}
							</td>
							<td class="text-left">
							  <div class="dropdown">
							    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							      <i class="fas fa-ellipsis-v"></i>
							    </a>
							    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
							      <a class="dropdown-item" href="{{route('user.adminDetail',$data->id_admin)}}">Edit/Detail</a>
							      <a class="dropdown-item" href="{{route('user.resetPasswordAdmin',$data->id_admin)}}">Reset Password</a>
							      <a class="dropdown-item" href="{{route('user.deleteAdmin',$data->id_admin)}}">Delete</a>
							    </div>
							  </div>
							</td>
						</tr>
						@endforeach
	                </tbody>
	              </table>
	            </div>
	            <!-- Card footer -->
	            <div class="card-footer py-4">
	            </div>
	          </div>
	        </div>
          </div>
        </div>
      </div>
    </div>
@endsection