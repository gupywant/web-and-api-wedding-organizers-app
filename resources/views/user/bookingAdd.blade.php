@extends('/user/app/app')
@section('content')
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Booking Add</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Booking</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Booking Add</li>
                </ol>
              </nav>
            </div>
            <div class="col-xl-12 order-xl-1">
	          <div class="card">
	            <div class="card-header">
	              <div class="row align-items-center">
	                <div class="col-8">
	                  <h3 class="mb-0">Add booking</h3>
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
	              <form action="{{route('user.bookingAddNew')}}" method="post">
	              	{{csrf_field()}}
	                <h6 class="heading-small text-muted mb-4">Booking information</h6>
	                <div class="pl-lg-4">
	                <div class="row">
	                    <div class="col-lg-6">
	                       <div class="form-group">
							  	<label class="form-control-label" for="input-last-name">User Booking</label>
							 	<select class="form-control select2" name="id_user">
							        @foreach($user as $data)
							        	<option value="{{$data->id_user}}">{{$data->username}} - {{$data->name}}</option>
							        @endforeach
							    </select>
							</div>
	                    </div>
	                    <div class="col-lg-6">
	                       <div class="form-group">
							  <label class="form-control-label" for="input-last-name">Service Vendor</label>
							  <select class="form-control select3" id="sel1" name="id_item" onchange="getDate(this.value)">
							  			<option>Pilih Layanan EO</option>
							    	@foreach($services as $data)
							        	<option value="{{$data->id_item}}">{{$data->company_name}} - {{$data->name}}</option>
							        @endforeach
							  </select>
							</div>
	                    </div>
	                  </div>
	                  <div class="row">
	                    <div class="col-lg-6">
	                       	<div class="form-group">
	                       		<label class="form-control-label" for="input-last-name">Book Start</label>
								<div class="input-group">
								    <div class="input-group-prepend">
								      <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
								    </div>
								    <input class="flatpickr datetimepicker form-control" type="text" placeholder="Tanggal Mulai" id="date1" name="start" required="" disabled="">
								</div>
							</div>
	                    </div>
	                    <div class="col-lg-6">
	                       	<div class="form-group">
	                       		<label class="form-control-label" for="input-last-name">Book Start</label>
								<div class="input-group">
								    <div class="input-group-prepend">
								      <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
								    </div>
								    <input class="flatpickr datetimepicker form-control" type="text" placeholder="Tanggal Akhir" id="date2" name="end" required="" disabled="">
								</div>
							</div>
	                    </div>
	                  </div>
	                </div>
	            </div>
	            <div class="card-footer">
	              <div class="row align-items-center">
	                <div class="col-8">
	                  <h3 class="mb-0">Add Booking</h3>
	                </div>
	                <div class="col-4 text-right">
	                  <input type="submit"  class="btn btn-md btn-primary" value="Add Booking"/>
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
    //fetch date
    var exdisableDate;
    function getDate(id){
		fetch('{{route('user.date')}}?id_item='+id)
		  .then(response => response.json())
		  .then(result => {
				console.log('Success:', result.disableDate);
			 	$('#date1').prop( "disabled", false );
				$('#date2').prop( "disabled", false );
				flatpickr('.datetimepicker', {
		      		enableTime: true,
		      		dateFormat: "Y-m-d H:i:00",
		      		disable: result.disableDate
		    	});
			})
	}
  </script>
@endsection