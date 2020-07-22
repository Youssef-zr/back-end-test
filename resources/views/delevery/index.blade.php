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

@php
    $times = [];
    $a=1;

    while($a <= 31){
        $times[$a] = $a;
        $a++;
    }
@endphp

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="container">

                <div class="jumbotron mt-4">
                    <a href="{{ url('/') }}" class="btn btn-secondary">Home page</a>

                    <div class="col-md-4 offset-md-4">
                        <h5 class="text-capitalize text-center text-muted">add new delivery time</h5>

                        {!! Form::open(['route'=>'delevery.create','method'=>'post']) !!}

                                <div class="form-group">
                                    {!! Form::label('dateStart', 'delivery start', ['class'=>'form-label text-muted']) !!}
                                    {!! Form::select('dateStart',$times, old('dateStart'), ['class'=>'form-control']) !!}
                                </div>
                                <div class="form-group">

                                    {!! Form::label('dateEnd', 'delivery end', ['class'=>'form-label text-muted']) !!}
                                    {!! Form::select('dateEnd',$times, old('dateEnd'), ['class'=>'form-control']) !!}
                                </div>

                                <button class="btn btn-primary" type="submit">create</button>
                        {!! Form::close() !!}

                    </div>

                    <div class="col-md-6 offset-md-3 mt-4">
                        <h3 class="text-muted text-capitalize text-center">our delivery times</h3>
                        <table class="table table-striped bg-white text-center text-capitalize">
                            <thead>
                                <tr class="text-small">
                                    <th>#id</th>
                                    <th>delevry at</th>
                                    <th>date start</th>
                                    <th>date end</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($deliveryTimes as $time)
                                    <tr>
                                        <td>{{ $time->id}} </td>
                                        <td>{{ $time->delevery_at}} </td>
                                        <td>{{ $time->dateStart}} </td>
                                        <td>{{ $time->dateEnd}} </td>
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
