@extends('_partial.app')

@push('css')
    <style>

        .text-small{
            font-size: 13px;
        }

        .table{
            width:100%
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="container">

                <div class="jumbotron mt-4">
                    <a href="{{ url('/') }}" class="btn btn-secondary">Home page</a>
                    <div class="col-md-4 offset-md-4">

                        {!! Form::open(['route'=>'city.create','method'=>'post']) !!}
                            <div class="form-group">
                                <label for="name" class="form-label text-muted">new city</label>
                                <div class="input-group mb-3">
                                    {!! Form::text('name', null, ['class'=>'form-control','placeholder'=>'city name']) !!}
                                    <div class="input-group-append">
                                      <button class="btn btn-primary" type="submit">create</button>
                                    </div>
                                  </div>
                            </div>
                        {!! Form::close() !!}

                    </div>

                    <div class="col-md-6 offset-md-3 mt-4">
                        <h3 class="text-muted text-capitalize text-center">our cities</h3>
                        <table class="table table-striped bg-white text-center">
                            <thead>
                                <tr class="text-small">
                                    <th>#id</th>
                                    <th>name</th>
                                    <th>attach delivery times</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Cities as $city)
                                    <tr>
                                        <td> {{ $city->id }} </td>
                                        <td> {{ $city->name }} </td>
                                        <td>
                                            <a href="{{route('delivery.attach',$city->id)}}" class="btn btn-primary btn-sm">Attach</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
