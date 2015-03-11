@extends('app')

@section('script')

	

@include('slider')

<script type="text/javascript">

$(function(){

//					Form::text('date_birth',Input::old('date_birth'),array('class'=>'form-control',"required"=>"true","id"=>"date_birth"))}}
	//alert("hola mundo");


});

$(function(){
        // Datepicker
        $.datepicker.setDefaults( $.datepicker.regional[ "" ] );
        $('#date_birth').datepicker({
            inline: true,
            dateFormat: 'yy-dd-mm',
            //minDate: "+0D",
            //maxDate: "+0D",
            showButtonPanel: true,
            closeText: 'Cerrar',
            prevText: '<<',
            nextText: '>>',
            currentText: 'Hoy',
            monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
            'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
            monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
            'Jul','Ago','Sep','Oct','Nov','Dic'],
            dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
            dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
            dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
            weekHeader: 'Sm',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''
        });
    });



</script>

@endsection

@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Actualización del perfil</div>
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

					{{Form::open(array('url'=>'/update','files'=>true,'enctype'=>'multipart/form-data','method'=>'POST'))}}

						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<fieldset class="row form-group">
							<div class="col-md-4 col-md-offset-4">
								{{Form::label('photo','Foto: ')}}
								@if($errors->has('photo'))
								{{Form::label('photo',$errors->first('photo'),array('class'=>'label label-warning'))}}
								@endif
							{{Form::File('photo[]', array('class'=>'form-control','multiple'))}}
							</div>
						</fieldset>

						<fieldset class="row form-group">
							<div class="col-md-4 col-md-offset-4">
								{{Form::label('name','Nombre: ')}}
								@if($errors->has('name'))
								{{Form::label('name',$errors->first('name'),array('class'=>'label label-warning'))}}
								@endif
							{{Form::text('name',$name,array('class'=>'form-control',"id"=>"name"))}}
							</div>
						</fieldset>

						<fieldset class="row form-group">
							<div class="col-md-4 col-md-offset-4">
								{{Form::label('last_name','Apellido: ')}}
								@if($errors->has('last_name'))
								{{Form::label('last_name',$errors->first('last_name'),array('class'=>'label label-warning'))}}
								@endif
							{{Form::text('last_name',$last_name,array('class'=>'form-control',"id"=>"last_name"))}}
							</div>
						</fieldset>

						<fieldset class="row form-group">
							<div class="col-md-4 col-md-offset-4">
								{{Form::label('phone','Telefono: ')}}
								@if($errors->has('phone'))
								{{Form::label('phone',$errors->first('phone'),array('class'=>'label label-warning'))}}
								@endif
							{{Form::text('phone',$phone,array('class'=>'form-control',"id"=>"phone"))}}
							</div>
						</fieldset>

						<fieldset class="row form-group">
							<div class="col-md-4 col-md-offset-4">
							{{Form::label('date_birth', 'Fecha de Nacimiento: ')}}
							@if($errors->has('date_birth'))
							    {{Form::label('date_birth',$errors->first('date_birth'),array('class'=>'label label-warning'))}}
							    @endif
							{{Form::text('date_birth',$date_birth,array('class'=>'form-control',"id"=>"date_birth"))}}
		
							</div>
						</fieldset>	

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Submit
								</button>
							</div>
						</div>

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