@extends('/user/app/app')
@section('content')
	<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Faq</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('user.faqAdd')}}" method="post">
        	{{csrf_field()}}
        	<div class="row">
	            <div class="col-lg-12">
	            	<div class="form-group">
	                	<label class="form-control-label" for="input-username">Pertanyaan</label>
	                	<input type="text" name="pertanyaan" id="input-username" class="form-control" placeholder="Nama Type">
	            	</div>
	            </div>
	            <div class="col-lg-12">
					<div class="form-group">
						<label class="form-control-label" for="input-email">Deskripsi</label>
						<textarea name="jawaban" required></textarea>
		                <script>
		                        CKEDITOR.replace( 'jawaban' );
		                </script>
					</div>
	            </div>
	        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- end of modal -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Faq List</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Faq</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Faq List</li>
                </ol>
              </nav>
            </div>
            <div class="col-xl-12 order-xl-1">
	          <div class="card">
	            <!-- Card header -->
	            <div class="card-header border-0">
	            	<div class="row">
		            	<div class="col-8">
		            		<h3 class="mb-0">Faq</h3>
		                </div>
		                <div class="col-4 text-right">
		                  	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
							 	Add Type
							</button>
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
	            <div id="accordion">
	            @foreach($faq as $key => $data)
				  <div class="card">
				    <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapse{{$key}}" aria-controls="collapseOne">
				    	<div class="row">
				    		<div class="col-sm-8">
						      <h5 class="mb-0">
						        <button class="btn btn-link">
						          {{$data->pertanyaan}}
						        </button>
						      </h5>
						    </div>
						    <div class="col-sm-4 text-right">
						    	<a href="{{route('user.deleteFaq',$data->id_faq)}}"><i class="fas fa-trash"></i></a>
						    </div>
					    </div>
				    </div>

				    <div id="collapse{{$key}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
				      <div class="card-body">
				        {!! $data->jawaban !!}
				      </div>
				    </div>
				  </div>
				@endforeach
				</div>
	            <div class="card-footer py-4">
	            </div>
	          </div>
	        </div>
          </div>
        </div>
      </div>
    </div>
@endsection