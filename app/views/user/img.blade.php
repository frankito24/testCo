@extends('app')

@include('slider')

@section('content')


<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Album de Foto</div>
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

					@if(Session::has('messagePersonal'))
					<div class="alert alert-dismissable alert-info">
					  <button type="button" class="close" data-dismiss="alert">×</button>
					  <strong>Actualizaci&oacute;n Completa!</strong> {{Session::get('messagePersonal')}}.
					</div>
					@endif

					@if(Session::has('messageEdit'))
					<div class="alert alert-danger">
					  <button type="button" class="close" data-dismiss="alert">×</button>
					  <strong>Whoops!</strong> There were some problems with your input.
					  <ul>
							<li>{{Session::get('messageEdit')}}.</li>
					  </ul>
					</div>
					@endif

					{{Form::open(array('url'=>'/deleteImage','method'=>'POST'))}}

						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<fieldset class="row form-group">
							<div class="col-md-4 col-md-offset-4">
								{{--*/ $a = 0; /*--}}
								<table class="table" >
								 @foreach ($pictures as $pic)
										@if($a == 0)
											<tr class="success" >
										@endif
										
										<td  width="30%">
										{{Form::checkbox('photo[]',$pic->id)}} <img class="img-rounded" width="100" height="100" src="{{asset($pic->photo)}}" alt="Foto" >
										</td>

										@if($a == 2)
											</tr>
											{{--*/ $a =0;/*--}}
										@else
										{{--*/ $a +=1;/*--}}
										@endif   
								@endforeach
								</table>
							</div>
						</fieldset>

						
						@if($pictures->count()>0)
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Eliminar Foto
								</button>
							</div>
						</div>
						@else
						<div class="alert alert-danger">
							<strong>Whoops!</strong> Don't exist photo in this album.<br><br>
						</div>
						@endif

						<br><br><br><br>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<div id="slider1_container" style="position: relative; top: 0px; left: 0px; width: 600px; height: 300px;">
								    <!-- Slides Container -->
								    <div u="slides" style="cursor: move; position: absolute; overflow: hidden; left: 0px; top: 0px; width: 600px; height: 300px;">
								       
								        @foreach ($pictures as $pic)
											<div>
												<img u="image" src="{{asset($pic->photo)}}" />
											</div>    
										@endforeach
								    </div>
								</div>
							</div>
						</fieldset>

						
					{{Form::close()}}
				</div>
			</div>
		</div>
	</div>
</div>


@endsection