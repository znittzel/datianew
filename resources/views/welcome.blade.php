@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Välkommen</div>

                <div class="panel-body">
                    @if(session("status"))
                        {!! session("status") !!}
                    @endif
                    Autoexpertens ordersystem 2.0.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
