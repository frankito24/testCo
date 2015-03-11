@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Login</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					@if(Session::has('message'))
					<div class="row" style=''>

					<div class="col-md-4 col-md-offset-4 alert alert-dismissable alert-danger">
					  <button type="button" class="close" data-dismiss="alert">×</button>
					  <strong>Oh Error!</strong> {{Session::get('message')}}.
					</div>
					</div>
					@endif

						{{Form::open(array('url'=>'/login','method'=>'POST', 'class'=>'form-horizontal'))}}
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<fieldset class="row form-group">
							<div class="col-md-4 col-md-offset-4">
								{{Form::label('email','Email: ')}}
								@if($errors->has('email'))
								{{Form::label('email',$errors->first('email'),array('class'=>'label label-warning'))}}
								@endif
							{{Form::email('email',Input::old('email'),array('class'=>'form-control',"required"=>"true","id"=>"email"))}}
							</div>
						</fieldset>
						<fieldset class="row form-group">
							<div class="col-md-4 col-md-offset-4">
								{{Form::label('password','Password de Usuario: ')}}
								@if($errors->has('password'))
								{{Form::label('password',$errors->first('password'),array('class'=>'label label-warning'))}}
								@endif
							{{Form::password('password',array('class'=>'form-control',"required"=>"true", 'minlength'=>'8'))}}
							</div>
						</fieldset>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary" style="margin-right: 15px;">
									Login
								</button>	
							</div>
						</div>
						{{Form::close()}}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
