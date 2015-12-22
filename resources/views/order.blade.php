@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-{{ $style['panel'] }}">
                <div class="panel-heading">
                    <span class="text-left">Order {{ $order->order_id }}</span>
                    <span class="pull-right"><i>{{ $order->created_at }}</i></span>
                </div>
                <div class="panel-body panel-content-{{ $style['panel'] }}">
                    <legend class="text-center">{{ $order->order_id. ' - '.$order->customer()->first()->name }}</legend>
                    <p class="order-heading">{!! $order->context !!}</p>
                    <hr/>
                    @foreach($order->events as $event)

                    <div class="row order-comment-row" style="margin:5px;">
                        <div class="col-md-7 order-comment">{!! $event->comment !!}</div>
                        <div class="col-md-4 order-comment">{{ $event->created_at }}</div>
                        <div class="col-md-1 order-comment">{{ $event->sign }}</div>
                    </div>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
