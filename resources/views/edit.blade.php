@extends('layout')

@section('content')
    {!! Form::open(['action' =>['ClientController@update',$data->id], 'method' => 'PUT','files'=>true])!!}
		@if ($errors->any())
    	<div class="col-md-12 mt-2">
     		<div class="alert alert-danger">
            	<ul>
                	@foreach ($errors->all() as $error)
                    	<li>{{ $error }}</li>
                	@endforeach
            	</ul>
        	</div>
    	</div>
		@endif
        <div class="col-md-6">  

			<img src="{{asset('/storage/images/'.$data->avatar)}}" class="rounded mt-2 mx-auto d-block" alt="..." style="width:100px; height:100px;">

			 <div class="form-group required">
				{!! Form::label("NAME") !!}
				{!! Form::text("name", $data->nombre ,["class"=>"form-control","required"=>"required"]) !!}
			</div>

			 <div class="form-group required">
				{!! Form::label("EMAIL") !!}
				{!! Form::text("email", $data->email ,["class"=>"form-control","required"=>"required"]) !!}
			</div>

			 <div class="form-group required">
				{!! Form::label("PHONE") !!}
				{!! Form::text("phone", $data->phone ,["class"=>"form-control","required"=>"required"]) !!}
			</div>

			<div class="form-group required">
				{!! Form::label("TECNOLOGIA") !!}
				
				{!! Form::select('id_skill', $skill, $data->id_skill, ["class"=>"form-control custom-select", 'placeholder' => 'skill']) !!}
				@if ($errors->has('id_skill'))
    				<small class="form-text text-danger">
        				{{ $errors->first('id_skill') }}
     				</small>
				@endif
			</div>

			<div class="form-group">
				{!! Form::label('Avatar') !!}
				{!! Form::file('avatar',["class"=>"form-control"]) !!}
				
				@if ($errors->has('id_skill'))
    				<small class="form-text text-danger">
        				{{ $errors->first('id_skill') }}
     				</small>
				@endif
			</div>

            <div class="well well-sm clearfix">
                <button class="btn btn-success btn-block pull-right" title="Save" type="submit">Update</button>
            </div>
        </div>
        
    {!! Form::close() !!}
@endsection