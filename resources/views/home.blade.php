@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Översikt</div>
                <div class="panel-body">
                    <div class="col-md-6">
                        <h4>Privat</h4>
                        <ul class="dashboard-order-list">
                            @foreach($private as $order_s)
                            <li class="dashboard-order-list-element">
                                <a href="/order/{{  $order_s->order_id }}" class="btn btn-{{ $order_s->state() }} btn-block">{{ $order_s->customer()->name }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h4>Färdiga, ej utlämnade</h4>
                        <ul class="dashboard-order-list">
                            @foreach($finished as $order_f)
                            <li class="dashboard-order-list-element">
                                <a href="/order/{{  $order_f->order_id }}" class="btn btn-success btn-block">{{ $order_f->customer()->name }}</a>
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
