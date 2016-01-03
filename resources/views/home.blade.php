@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Översikt</div>
                <div class="panel-body">
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs centered">
                          <li class=""><a href="#private" data-toggle="tab" aria-expanded="true">Privat</a></li>
                          <li class="active"><a href="#company" data-toggle="tab" aria-expanded="false">Företag</a></li>
                          <li class="">
                            <a href="#priority" data-toggle="tab" aria-expanded="false">Prioriterade
                                @if ($prio->count() != 0)
                                    <i class="fa fa-exclamation" style="color:red;"></i>
                                @endif 
                            </a>
                          </li>
                          <li class=""><a href="#finished" data-toggle="tab" aria-expanded="false">Avslutade</a></li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                          <div class="tab-pane fade" id="private">
                            <div class="list-group">
                              @foreach($private as $p_order)
                                @if(!$p_order->customer->business)
                                <h6>
                                  <a href="/order/{{ $p_order->id }}/show" class="list-group-item text-center">
                                    {!! $p_order->order_id.' - '.$p_order->customer->name !!}
                                    <span class="label label-{{ $p_order->state() }} pull-right ">{{$p_order->stateName()}}</span>
                                  </a>
                                </h6>
                                @endif
                              @endforeach
                            </div>
                          </div>
                          <div class="tab-pane fade active in" id="company">
                            <div class="list-group">
                              @foreach($company as $c_order)
                                @if($c_order->customer->business)
                                <h6>
                                  <a href="/order/{{ $c_order->id }}/show" class="list-group-item text-center">
                                    {{ $c_order->order_id.' - '.$c_order->customer->name }}
                                    <span class="label label-{{ $c_order->state() }} pull-right ">{{$c_order->stateName()}}</span>
                                  </a>
                                </h6>
                                @endif
                              @endforeach
                            </div>
                          </div>
                          <div class="tab-pane fade" id="priority">
                            <div class="list-group">
                              @foreach($prio as $prio_order)
                                <h6>
                                  <a href="/order/{{ $prio_order->id }}/show" class="list-group-item text-center">
                                    {{ $prio_order->order_id.' - '.$prio_order->customer->name }}
                                    <span class="label label-{{ $prio_order->state() }} pull-right ">{{$prio_order->stateName()}}</span>
                                  </a>
                                </h6>
                              @endforeach
                            </div>
                          </div>
                          <div class="tab-pane fade" id="finished">
                            <div class="list-group">
                              @foreach($finished as $f_order)
                                <h6>
                                  <a href="/order/{{ $f_order->id }}/show" class="list-group-item text-center">
                                    {{ $f_order->order_id.' - '.$f_order->customer->name }}
                                    <span class="label label-{{ $f_order->state() }} pull-right ">{{$f_order->stateName()}}</span>
                                  </a>
                                </h6>
                              @endforeach
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
