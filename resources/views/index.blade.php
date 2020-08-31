@extends('layout') 
@section('content')
<div class="col-md-12">
    @if (session('success'))
    <div class="alert alert-success mt-2 mb-2">
        {{ session('success') }}
    </div>
    @endif
    <div class="table-responsive mt-4">
        <table class="table table-bordered table-condensed table-striped">
            <thead>
                <th>Avatar</th>
                <th>ID</th>
                <th>NAME</th>
                <th>EMAIL</th>
                <th>PHONE</th>
                <th>Skill</th>
                <th colspan = 2>ACTION</th>
            </thead>

            <tbody>
                @foreach($data as $row)
                <tr>
                    <td><img src="{{asset('/storage/images/'.$row->avatar)}}" class="rounded mx-auto d-block" alt="..." style="width:50px; height:50px;"></td>
                    <td>{{$row->id }}</td>
                    <td>{{$row->nombre }}</td>
                    <td>{{$row->email }}</td>
                    <td>{{$row->phone }}</td>
                    <td>{{$row->name }}</td>

                    <td>
                        <a href="{{ route('clients.edit', $row->id)}}" class="btn btn-warning">Edit</a>
                        
                        <form action="{{ route('clients.destroy', $row->id)}}" method="post" class="mt-2">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
       <a class="btn btn-primary btn-lg btn-block" href="{{ route('clients.create')}}">Crear Cliente</a>
    </div>
    <div>
    </div>
</div>

@endsection