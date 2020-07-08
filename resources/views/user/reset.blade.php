<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style type="text/css">
  .form-gap {
    padding-top: 70px;
  }
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<div class="form-gap"></div>
<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="text-center">
            <h3><i class="fa fa-lock fa-4x"></i></h3>
            <h2 class="text-center">Reset Password</h2>
            <p>Tulis password baru dibawah.</p>
            <div class="panel-body">

              <form action="{{route('user.resetPost')}}?username={{$username}}" id="register-form" role="form" autocomplete="off" class="form" method="post">
                {{ csrf_field() }}
                @if(session()->has('message'))
                  <div class="alert alert-danger">
                      {{ session()->get('message') }}
                  </div>
                @endif
                <input type="hidden" name="key" value="{{$token}}">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
                    <input id="password" name="pass1" placeholder="password baru" class="form-control"  type="password">
                  </div>
                  <br/>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
                    <input id="password" name="pass2" placeholder="Tulis ulang password baru" class="form-control"  type="password">
                  </div>
                </div>
                <div class="form-group">
                  <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                </div>
                
                <input type="hidden" class="hide" name="token" id="token" value=""> 
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
	</div>
</div>