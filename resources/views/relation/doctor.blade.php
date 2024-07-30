@extends('layouts.app')

@section('content')

    <div>
        All doctors for hospital
    </div>
    <br>

    <table class="table table-dark">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">name</th>
            <th scope="col">title</th>
        </tr>
        </thead>
        <tbody>
        @if( isset($doctors) && $doctors->count() > 0 )
            @foreach($doctors as $doctor)
                <tr>
                    <th scope="row">{{$doctor->id}}</th>
                    <td>{{$doctor->name}}</td>
                    <td>{{$doctor->title}}</td>
                    <td>
                        <a href="{{route('doctor.services', $doctor-> id)}}" class="btn btn-success">
                            services
                        </a>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@stop

