@extends('layouts.default')
@section('content')
	
<div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-12 col-lg-12 mx-auto">
	    	@if ($errors->any())
				    <div class="row alert alert-danger">
				        <ul>
				            @foreach ($errors->all() as $error)
				                <li>{{ $error }}</li>
				            @endforeach
				        </ul>
				    </div>
				@endif
        <div class="card border-0 shadow rounded-3 my-5">
          <div class="card-body p-4 p-sm-5">
            <h5 class="card-title text-center mb-5 fw-light fs-5">LOGIN</h5>
						<form method="POST" action="">
							{{ csrf_field() }}
							<input type="hidden" name="submit" value="1">
							<div class="form-group">
						    <label for="name">Email</label>
						    <input type="email" class="form-control" name="email" placeholder="email" value="{{old('email')}}">
						  </div>
						  <div class="form-group">
						    <label for="name">Password</label>
						    <input type="text" class="form-control" name="password" placeholder="password" value="{{old('password')}}">
						  </div>
						  <button type="submit" class="btn btn-primary">Submit</button>
						</form>
        </div>
        </div>
      </div>
    </div>
</div>
@stop
