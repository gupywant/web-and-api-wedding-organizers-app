@extends('/user/app/app')
@section('content')
	<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Tips & Tricks</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('user.tipsAdd')}}" method="post" enctype="multipart/form-data" >
        	{{csrf_field()}}
        	<div class="row">
	            <div class="col-lg-12">
	            	<div class="form-group">
	                	<label class="form-control-label" for="input-username">Title</label>
	                	<input type="text" name="title" id="input-username" class="form-control" placeholder="Judul" required="">
	            	</div>
	            </div>
                <div class="col-lg-12">
                	<label for="name">Add Image(s)</label>
                    <div class="form-group">
                      <input type="file" class="form-control-file" name="image" multiple>
                    </div>
                </div>
	            <div class="col-lg-12">
					<div class="form-group">
						<label class="form-control-label" for="input-email">Content</label>
						<textarea name="content" required></textarea>
		                <script>
		                        CKEDITOR.replace( 'content' );
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
              <h6 class="h2 text-white d-inline-block mb-0">Tips & Tricks List</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Tips & Tricks</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Tips & Tricks List</li>
                </ol>
              </nav>
            </div>
            <div class="col-xl-12 order-xl-1">
	          <div class="card">
	            <!-- Card header -->
	            <div class="card-header border-0">
	            	<div class="row">
		            	<div class="col-8">
		            		<h3 class="mb-0">Tips & Tricks</h3>
		                </div>
		                <div class="col-4 text-right">
		                  	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
							 	Add Tips & Tricks
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
	            @foreach($tips as $key => $data)
				  <div class="card">
				    <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapse{{$key}}" aria-controls="collapseOne">
				    	<div class="row">
				    		<div class="col-sm-8">
						      <h5 class="mb-0">
						        <button class="btn btn-link">
						          {{$data->title}}
						        </button>
						      </h5>
						    </div>
						    <div class="col-sm-4 text-right">
						    	<a href="{{route('user.deleteTips',$data->id_tips)}}"><i class="fas fa-trash"></i></a>
						    </div>
					    </div>
				    </div>

				    <div id="collapse{{$key}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
				      <div class="card-body">
				      	<div class="row">
					      	<div class="col-sm-12 text-center">
						      	@if(!empty($data->image))
		                    		<img width="30%" src="{{URL::asset('/filesdat')}}/tips/{{$data->id_tips}}{{'/'.$data->image}}">
		                    	@else
		                    		<img width="30%" src="{{URL::asset('/filesdat/default/default_photo.png')}}">
		                    	@endif
					      	</div>
					      	<div class="col-sm-12">
					        	{!! $data->content !!}
					      	</div>
					     </div>
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