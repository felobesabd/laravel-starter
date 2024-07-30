@extends('layouts.app')

@section('content')
    <div class="container">
        <div class=" position-ref full-height">

            @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('success')}}
                </div>
                <br>
            @endif

            <div class="content">
                <div class="title m-b-md">services</div>
                <br>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">name</th>
                    </tr>
                    </thead>
                    <tbody>

                    @if(isset($services) && $services -> count() > 0 )
                        @foreach($services as $service)
                            <tr>
                                <th scope="row">{{$service -> id}}</th>
                                <td>{{$service -> name}}</td>
                            </tr>
                        @endforeach
                    @endif

                    </tbody>
                </table>

                <br><br>
                <form method="POST" action="{{route('save.doctor.services')}}">
                    @csrf

                    <div class="form-group">
                        <label for="exampleInputEmail1">Choose Doctor</label>
                        <select class="form-control" name="doctor_id">
                            @foreach($doctors as $doctor)
                                <option value="{{$doctor -> id}}">{{$doctor -> name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Choose Services</label>
                        <select class="form-control" name="servicesIds[]" multiple>
                            @foreach($allServices as $allService)
                                <option value="{{$allService -> id}}">{{$allService -> name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">save</button>
                </form>
            </div>
        </div>
    </div>
@stop

