@extends('layouts.app')

@section('content')
    <div class="title m-md-0">
        All hospitals
    </div>
    <br>

    <table class="table table-dark">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">name</th>
            <th scope="col">address</th>
            <th scope="col">operation</th>
        </tr>
        </thead>
        <tbody>
        @if( isset($hospitals) && $hospitals->count() > 0 )
            @foreach($hospitals as $hospital)
                <tr>
                    <th scope="row">{{$hospital->id}}</th>
                    <td>{{$hospital->name}}</td>
                    <td>{{$hospital->address}}</td>
                    <td>
                        <a class="btn btn-info" href="{{route('doctors', $hospital->id)}}">
                            doctors
                        </a>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@stop
