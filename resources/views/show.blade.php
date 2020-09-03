@extends('layout')
@section('content')
<div class="col-md-6 mt-4">
	<img src="{{asset('/storage/images/'.$data[0]->avatar)}}" class="rounded mt-2 mx-auto d-block" alt="..." style="width:100px; height:100px;">
<div class="form-group required">
				{!! Form::label("NAME") !!}
				{!! Form::text("name", $data[0]->nombre ,["class"=>"form-control","required"=>"required"]) !!}	
			</div>

			 <div class="form-group required">
				{!! Form::label("EMAIL") !!}
				{!! Form::text("email", $data[0]->email ,["class"=>"form-control"])!!}
			</div>

			 <div class="form-group required">
				{!! Form::label("PHONE") !!}
				{!! Form::text("phone", $data[0]->phone ,["class"=>"form-control"]) !!}
			</div>

			<div class="form-group required">
				{!! Form::label("TECNOLOGIA") !!}
				
				{!! Form::text('id_skill', $data[0]->name, ["class"=>"form-control"]) !!}
			</div>

			<div class="form-group required">
				{!! Form::label("Cita") !!}
				
				{!! Form::text('cita', $data[0]->cita, ["class"=>"form-control"]) !!}
			</div>

			<a href="{{ action('ClientController@SendEmail', ['id' => $data[0]->id]) }}" class="btn btn-success">Enviar</a>
</div>
@endsection