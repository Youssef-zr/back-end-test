@extends('_partial.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2 mt-4">
            <div class="jumbotron">
                <h3 class="text-muted text-capitalize text-center"></h3>

                <ul class="list-group">
                    <li class="list-group-item active">Quick links</li>
                    <li class="list-group-item"><a href="{{ url('cities') }}"> Our cities</a></li>
                    <li class="list-group-item"><a href="{{ url('delevery') }}"> Our delivery times</a></li>
                    <li class="list-group-item"><a href="{{ url('order/new') }}"> Add new order</a></li>
                  </ul>
            </div>
        </div>
    </div>
</div>
@endsection
