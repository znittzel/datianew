@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Översikt</div>
                <div class="panel-body">
                    <div>
                        <legend class="text-center">Arkiverade</legend>
                        @foreach($archive as $order)
                        <a href="/order/{{  $order->id }}/show">
                            {{ $order->order_id }}
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
