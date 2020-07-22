@extends('_partial.app')

@push('css')
    <style>

        .disabled{
            background: rgb(223, 45, 45) !important;
            color:#eee
        }
        .btn,.btn-group{
            float:right;
            clear: both;
            margin-bottom: 10px;
        }
    </style>
@endpush

@section('content')

    <div class="container ">
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron mt-4">
                    <a href="{{ url('/') }}" class="btn btn-secondary">Home page</a>

                    <h2 class="text-center text-muted text-capitalize">attach delevery times to <span> " {{ $city->name }} "</span></h2>
                    <div class="col-md-6 offset-md-3">
                        {!! Form::open([ 'route'=> ['city.attachDelevery',$city->id] ]) !!}
                        <div class="form-group">
                            {!! Form::select('times[]', $deleveryTimes->pluck('delevery_at','id'), null,['multiple'=>true,'class'=>'form-control']) !!}
                        </div>

                        <button type="submit" class="btn btn-primary m-auto">Attach</button>

                        {!! Form::close() !!}
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-6 offset-md-3 mt-4">
                        <h2 class="text-center text-muted text-capitalize">
                            our delevery times of {{$city->name}}
                        </h2>

                        @if(count($city_delevery_times))

                            <div class="btn-group">
                                <a href="{{ url('city/'.$city->id.'/delevery/1') }}" alt='disable this time' class="btn btn-danger btn-sm">disable all</a>
                                <a href="{{ url('city/'.$city->id.'/delevery/0') }}" alt='disable this time' class="btn btn-primary btn-sm">enabled all</a>
                            </div>

                            <table class="table table-striped table-inverse  text-center mt-2 bg-white">
                                <thead>
                                    <th>city</th>
                                    <th>delevery time</th>
                                    <th>actions</th>
                                </thead>

                                <tbody>
                                    @foreach ($city_delevery_times as $time)
                                        <tr class="{{ $time->pivot->status == 1 ? 'disabled' : '' }}">
                                            <td>{{$city->name}}</td>
                                            <td>{{$time->delevery_at}}</td>
                                            <td>
                                                 {{-- {{$time->pivot->status}} --}}
                                                @if ($time->pivot->status == 0)
                                                    <a href="{{ url('city/'.$city->id.'/delevery/'.$time->id.'/1') }}" alt='disable this time' class="btn btn-warning btn-sm">disable</a>
                                                    @else
                                                    <a href="{{ url('city/'.$city->id.'/delevery/'.$time->id.'/0') }}" alt='enable this time' class="btn btn-success btn-sm">enabled</a>
                                                @endif

                                            </td>
                                        </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-danger mt-4" role="alert">
                                <h5 class='text-center text-capitalize'>no delevery times for this city attach new</h5>
                            </div>
                        @endif

                </div>
            </div>
        </div>
        </div>
    </div>

@endsection
