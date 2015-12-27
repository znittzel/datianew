@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Översikt</div>
                <div class="panel-body">
                    <div class="col-md-6">
                        <legend class="text-center">Pågående</legend>
                        <ul class="dashboard-order-list">
                            @foreach($onGoing as $order_on)
                            <li class="dashboard-order-list-element">
                                <a href="/order/{{  $order_on->id }}/show" class="btn btn-{{ $order_on->state() }} btn-block">{{ $order_on->customer()->name }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <legend class="text-center">Färdiga, ej utlämnade</legend>
                        <ul class="dashboard-order-list">
                            @foreach($finished as $order_f)
                            <li class="dashboard-order-list-element">
                                <a href="/order/{{  $order_f->id }}/show" class="btn btn-success btn-block">{{ $order_f->customer()->name }}</a>
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
