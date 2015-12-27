@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="text-left">Editera</span>
                </div>
                <div class="panel-body panel-content-default">
                    <form method="post" action="/order/{{ $order->id }}/update" style="padding:15px;">
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
