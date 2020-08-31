@extends('layout')
@section('content')
{!! Form::open(['action' =>'ClientController@store', 'method' => 'POST','files'=>true])!!}
	@if (session('success'))
    <div class="alert alert-success mt-2 mb-2">
        {{ session('success') }}
    </div>
    @endif
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
    <div class="col-md-6 mt-4">
        
			 <div class="form-group required">
				{!! Form::label("NAME") !!}
				{!! Form::text("name", null ,["class"=>"form-control"]) !!}	
				@if ($errors->has('name'))
    				<small class="form-text text-danger">
        				{{ $errors->first('name') }}
     				</small>
				@endif
			</div>

			 <div class="form-group required">
				{!! Form::label("EMAIL") !!}
				{!! Form::text("email", null ,["class"=>"form-control"])!!}
				@if ($errors->has('email'))
    				<small class="form-text text-danger">
        				{{ $errors->first('email') }}
     				</small>
				@endif
			</div>

			 <div class="form-group required">
				{!! Form::label("PHONE") !!}
				{!! Form::text("phone", null ,["class"=>"form-control"]) !!}
				@if ($errors->has('phone'))
    				<small class="form-text text-danger">
        				{{ $errors->first('phone') }}
     				</small>
				@endif
			</div>

			<div class="form-group required">
				{!! Form::label("TECNOLOGIA") !!}
				
				{!! Form::select('id_skill', $skill, 1, ["class"=>"form-control", 'placeholder' => 'skill']) !!}
				@if ($errors->has('id_skill'))
    				<small class="form-text text-danger">
        				{{ $errors->first('id_skill') }}
     				</small>
				@endif
			</div>

			<div class="form-group">
				{!! Form::label('Avatar') !!}
				{!! Form::file('avatar', ["class"=>"form-control"]) !!}
				
				@if ($errors->has('id_skill'))
    				<small class="form-text text-danger">
        				{{ $errors->first('id_skill') }}
     				</small>
				@endif
			</div>
        <div class="well well-sm clearfix">
            <button class="btn btn-success pull-right" title="Save" type="submit">Create</button>
        </div>
    </div>
 
{!! Form::close() !!}
@endsection