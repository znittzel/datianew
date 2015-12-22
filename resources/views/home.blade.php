@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Översikt</div>
                <div class="panel-body">
                    <div class="col-md-4">
                        <h4>Företag</h4>
                        <ul class="dashboard-order-list">
                            @foreach($business as $order_b)
                            <li class="dashboard-order-list-element">
                                @if ($order_b->status == '5')
                                    <a href="/order/{{  $order_b->order_id }}" class="btn btn-primary btn-block">{{ $order_b->customer()->first()->name  }}</a>
                                @else
                                    <a href="/order/{{  $order_b->order_id }}" class="btn btn-info btn-block">{{ $order_b->customer()->first()->name  }}</a>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h4>Privat</h4>
                        <ul class="dashboard-order-list">
                            @foreach($private as $order_s)
                            <li class="dashboard-order-list-element">
                                @if ($order_s->status == '1')
                                    <a href="/order/{{  $order_s->order_id }}" class="btn btn-danger btn-block">{{ $order_s->customer()->first()->name  }}</a>
                                @else
                                    <a href="/order/{{  $order_s->order_id }}" class="btn btn-warning btn-block">{{ $order_s->customer()->first()->name  }}</a>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h4>Färdiga</h4>
                        <ul class="dashboard-order-list">
                            @foreach($finished as $order_f)
                            <li class="dashboard-order-list-element">
                                <a href="/order/{{  $order_f->order_id }}" class="btn btn-success btn-block">{{ $order_f->customer()->first()->name  }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
