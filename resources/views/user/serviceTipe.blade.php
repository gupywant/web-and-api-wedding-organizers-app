@extends('/user/app/app')
@section('content')
	<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('user.serviceTypeAdd')}}" method="post">
        	{{csrf_field()}}
        	<div class="row">
	            <div class="col-lg-12">
	            	<div class="form-group">
	                	<label class="form-control-label" for="input-username">Type</label>
	                	<input type="text" name="name" id="input-username" class="form-control" placeholder="Nama Type">
	            	</div>
	            </div>
	            <div class="col-lg-12">
					<div class="form-group">
						<label class="form-control-label" for="input-email">Deskripsi</label>
						<textarea rows="4" class="form-control" name="description" placeholder="Deskripsi Tipe"></textarea>
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
              <h6 class="h2 text-white d-inline-block mb-0">Service Type</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Service</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Service Type</li>
                </ol>
              </nav>
            </div>
            <div class="col-xl-12 order-xl-1">
	          <div class="card">
	            <!-- Card header -->
	            <div class="card-header border-0">
	            	<div class="row">
		            	<div class="col-8">
		            		<h3 class="mb-0">Service Type</h3>
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
	            <!-- Light table -->
	            <div class="table-responsive">
	              <table class="table align-items-center table-flush" id="myTable">
	                <thead class="thead-light">
	                  <tr>
	                    <th scope="col" class="sort" data-sort="name">No</th>
	                    <th scope="col" class="sort" data-sort="budget">Nama</th>
	                    <th scope="col" class="sort" data-sort="status">Deskripsi</th>
	                    <th scope="col">Aksi</th>
	                  </tr>
	                </thead>
	                <tbody class="list">
	                @php
	                	$no = 1;
	                @endphp
	                @foreach($type as $key => $data)
	               	<!-- Modal -->
					<div class="modal fade" id="Modal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel">Detail/ Update</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <div class="modal-body">			        	
					        <form action="{{route('user.serviceTypeEdit',$data->id_type)}}" method="post">
					        	{{csrf_field()}}
					        	<div class="row">				            
									<div class="row">
									    <div class="col-lg-12">
									    	<div class="form-group">
									        	<label class="form-control-label" for="input-username">Jenis</label>
									        	<input value="{{$data->name}}" type="text" name="name" id="input-username" class="form-control" placeholder="Type Name">
									    	</div>
									    </div>
									    <div class="col-lg-12">
											<div class="form-group">
												<label class="form-control-label" for="input-email">Deskripsi</label>
												<textarea rows="4" class="form-control" name="description" placeholder="Description">{{$data->description}}</textarea>
											</div>
									    </div>
									</div>
						        </div>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					        <button type="submit" class="btn btn-primary">Save</button>
					      </div>
					      </form>
					  </div>
					</div>
				</div>
					<!-- end of modal -->
		                  <tr>
		                    <th scope="row">
		                		{{$no++}}
		                    </th>
		                    <td class="budget">
		                      {{$data->name}}
		                    </td>
		                    <td>
		                    	@if(strlen($data->description)<=50)
		                    		{{$data->description}}
		                    	@else
		                    		{{substr($data->description,0,50)}}...
		                    	@endif
		                    </td>
		                    <td class="text-left">
		                      <div class="dropdown">
		                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		                          <i class="fas fa-ellipsis-v"></i>
		                        </a>
		                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
		                          <a class="dropdown-item" data-toggle="modal" data-target="#Modal{{$key}}">
								 	Detail/Edit</a>
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