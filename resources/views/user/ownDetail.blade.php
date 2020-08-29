@extends('/user/app/app')
@section('content')
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Update User</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">User</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Update User</li>
                </ol>
              </nav>
            </div>
            <div class="col-xl-12 order-xl-1">
	          <div class="card">
	            <div class="card-header">
	              <div class="row align-items-center">
	                <div class="col-8">
	                  <h3 class="mb-0">Update User</h3>
	                </div>
	              </div>
	            </div>
	            <div class="card-body">
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
	              <form action="{{$route}}" method="post">
	                <h6 class="heading-small text-muted mb-4">User information</h6>
	                <div class="pl-lg-4">
	                  <div class="row">
	                  	{{csrf_field()}}
	                    <div class="col-lg-6">
	                      <div class="form-group">
	                        <label class="form-control-label" for="input-username">Name</label>
	                        <input type="text" name="name" id="input-username" class="form-control" placeholder="Nama" value="{{$user->name}}" required="">
	                      </div>
	                    </div>
	                    <div class="col-lg-6">
	                      <div class="form-group">
	                        <label class="form-control-label" for="input-first-name">Email Updateress</label>
	                        <input type="email" id="input-first-name" name="username" class="form-control" placeholder="Email" value="{{$user->username}}" required="">
	                      </div>
	                    </div>
	                  </div>
	                  <div class="row">
	                    <div class="col-lg-6">
	                       <div class="form-group">
							  <label class="form-control-label" for="input-last-name">Gender</label>
							  <select name="gender" class="form-control" id="sel1">
							    <option value="1" @if($user->gender==1) selected @endif>Male</option>
							    <option value="2" @if($user->gender==2) selected @endif>Female</option>
							  </select>
							</div>
	                    </div>
	                    <div class="col-lg-6">
	                       	<div class="form-group">
	                       		<label class="form-control-label" for="input-last-name">Birth Date</label>
								<div class="input-group">
								    <div class="input-group-prepend">
								      <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
								    </div>
								    <input class="flatpickr datetimepicker form-control" name="birth_date" type="text" placeholder="Tanggal Lahir" value="{{$user->birth_date}}" required="">
								</div>
							</div>
	                    </div>
	                  </div>
	                </div>
	                <hr class="my-4" />
	                <!-- Updateress -->
	                <h6 class="heading-small text-muted mb-4">Contact information</h6>
	                <div class="pl-lg-4">
	                  <div class="row">
	                    <div class="col-md-4">
	                      <div class="form-group">
	                        <label class="form-control-label" for="input-Updateress">Perusahaan</label>
	                        <input id="input-Updateress" name="company" name="Updateress" class="form-control" placeholder="kosongkan untuk Standart user" value="{{$user->company_name}}" type="text">
	                      </div>
	                    </div>
	                    <div class="col-md-4">
	                      <div class="form-group">
	                        <label class="form-control-label" for="input-Updateress">Phone Number</label>
	                        <input id="input-Updateress" name="tlp" name="Updateress" class="form-control" placeholder="No Tlp" type="text" value="{{$user->tlp}}" required="">
	                      </div>
	                    </div>
	                    <div class="col-md-4">
	                      <div class="form-group">
	                        <label class="form-control-label" for="input-Updateress">Address</label>
	                        <input id="input-Updateress" name="address" class="form-control" placeholder="Alamat"  type="text" value="{{$user->address}}" required="">
	                      </div>
	                    </div>
	                  </div>
	                  <div class="row">
	                    <div class="col-lg-4">
	                      <div class="form-group">
	                        <label class="form-control-label" for="input-city">City</label>
	                        <input type="text" name="city" id="input-city" name="city" class="form-control" placeholder="Kota" value="{{$user->city}}" required="">
	                      </div>
	                    </div>
	                    <div class="col-lg-4">
	                      <div class="form-group">
	                        <label class="form-control-label" for="input-country">Province</label>
	                        <input type="text" id="input-country" name="province" class="form-control" placeholder="Proivisi" value="{{$user->province}}" required="">
	                      </div>
	                    </div>
	                    <div class="col-lg-4">
	                      <div class="form-group">
	                        <label class="form-control-label" for="input-country">Postal code</label>
	                        <input type="number" id="input-postal-code" name="postal_code" class="form-control" placeholder="Kode Pos" value="{{$user->postal_code}}" required="">
	                      </div>
	                    </div>
	                  </div>
	                </div>
	            </div>
	            <div class="card-footer">
	              <div class="row align-items-center">
	                <div class="col-8">
	                  <h3 class="mb-0">Update User</h3>
	                </div>
	                <div class="col-4 text-right">
	                  <input type="submit" class="btn btn-md btn-primary" value="Update User">
	                </div>
	              </div>
	            </div>
	              </form>
	          </div>
	        </div>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
    flatpickr('.datetimepicker', {
      dateFormat: "Y-m-d",
    });
  </script>
@endsection