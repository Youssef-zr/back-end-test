
<div class="container">

    @if(!empty($errors->any()))
        <div class="alert alert-danger mt-4 text-center" role="alert">
            @foreach ($errors->all() as $err)
                <h4>{{ $err }}</h4>
            @endforeach
        </div>
    @endif

    @if(!empty(Session()->has('msgSuccess')))
    <div class="alert alert-success mt-4 text-center text-capitalize" role="alert">
        <h4>{{Session('msgSuccess')}}</h4>
    </div>
    @endif

</div>
