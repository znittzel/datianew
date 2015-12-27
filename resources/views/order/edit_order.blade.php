@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-{{ $order->state() }}">
                <div class="panel-heading">
                    <span class="text-left">Editera order</span>
                    <span class="pull-right"><a href="/order/{{ $order->id }}/show">Tillbaka till order {{ $order->order_id }}</a></span>
                </div>
                <div class="panel-body panel-content-default">
                     @if (session("status"))
                        {!! session("status") !!}
                    @endif
                    <form method="post" class="col-md-6" action="/order/{{ $order->id }}/update" style="padding:15px;">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                        <div class="row">
                            <div class="form-group">
                                <label>Kundnummer</label>
                                <input type="text" name="customer_id" class="form-control" value="{{ $order->customer_id }}" />
                                <input type="text" class="form-control" value="{{ $order->customer()->name }}" disabled />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label>Orderid</label>
                                <input type="text" value="{{ $order->order_id }}" name="order_id" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label>Ärende</label>
                                <textarea name="context" style="resize:vertical;" class="form-control" rows="5">{!! nl2br(e($order->context)) !!}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="1" {{{ ($order->status == '1') ? 'selected' : '' }}}>Ej påbörjad</option>
                                    <option value="2" {{{ ($order->status == '2') ? 'selected' : '' }}}>Påbörjad</option>
                                    <option value="4" {{{ ($order->status == '4') ? 'selected' : '' }}}>Avslutad</option>
                                    <option value="3" {{{ ($order->status == '3') ? 'selected' : '' }}}>Arkiverad</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label>Typ</label>
                                <input type="text" name="type" class="form-control" value="{{ $order->type }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label>Tillbehör</label>
                                <input type="text" name="accessories" class="form-control" value="{{ $order->accessories }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label>Lösenord</label>
                                <input type="text" name="password" value="{{ $order->password }}" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label>Låda</label>
                                <input type="text" name="box" class="form-control" value="{{ $order->box }}" />
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Prioritering</label>
                                <select class="form-control" name="prio">
                                    <option value="0" {{{ (!$order->prio) ? 'selected' : '' }}}>Normal</option>
                                    <option value="1" {{{ ($order->prio) ? 'selected' : '' }}}>Hög</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Sign</label>
                                <input type="text" name="sign" value="{{ $order->sign }}" class="form-control"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <input type="submit" class="btn btn-warning" value="Uppdatera" style="width:100%;" />
                            </div>
                        </div>
                    </form>
                    <div class="col-md-6" ng-controller="OrderEditEventsController">
                        <table class="table table-striped" id="orderEvents">
                            <tr>
                                <th>#</th>
                                <th>Kommentar</th>
                                <th>Sign</th>
                                <th></th>
                            </tr>
                            @foreach ($order->events as $event) 
                                <tr id="{{ $event->order_event_id }}">
                                    <td><a href="/orderevent/{{ $order->order_event_id }}/edit">{{ $event->order_event_id }}</a></td>
                                    <td>{!! $event->comment !!}</td>
                                    <td>{{ $event->sign }}</td>
                                    <td><button ng-really-click="delete({{ $event->order_event_id }})" ng-really-message="Ta bort kommentar #{{ $event->order_event_id }}?" class="btn btn-danger btn-xs">Ta bort</button></td>
                                </tr>       
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
