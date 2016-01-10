@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-{{ $order->state() }}">
                <div class="panel-heading">
                    <span class="text-left">Editera order</span>
                    <span class="pull-right"><a style="color:black;" href="/order/{{ $order->id }}/show">Tillbaka till order {{ $order->order_id }}</a></span>
                </div>
                <div class="panel-body panel-content-default">
                    <div class="row">
                         @if (session("status"))
                            {!! session("status") !!}
                        @endif

                        <form method="post" id="edit_order_form" ng-controller="OrderController" action="/order/{{ $order->id }}/update" style="padding:15px;">
                            <div class="col-md-6">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                                <div class="form-group">
                                    <label>Kundnummer</label>
                                    <input type="text" disabled class="form-control" value="{{ $order->customer()->first()->customer_id }}" name="customer_id" data-parsley-required data-parsley-type="number">
                                </div>
                                <div class="form-group">
                                    <label>Kundnamn</label>
                                    <input type="text" disabled class="form-control" value="{{ $order->customer()->first()->name }}" id="customer_name" data-parsley-required />
                                </div>
                                <div class="form-group">
                                    <label>Ordernummer</label>
                                    <input type="text" disabled name="order_id" value="{{ $order->order_id }}" class="form-control" data-parsley-required data-parsley-type="number">
                                </div>
                                <div class="form-group">
                                    <label>Titel</label>
                                    <input class="form-control" name="title" data-parsley-required type="text" value="{{ $order->event()->first()->title }}">
                                </div>
                                <div class="form-group">
                                    <label>Beskrivning</label>
                                    <textarea name="context" style="resize:vertical;" class="form-control" rows="5">{!! $order->context !!}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="1" {{{ ($order->status == '1') ? 'selected' : '' }}}>Ej påbörjad</option>
                                        <option value="2" {{{ ($order->status == '2') ? 'selected' : '' }}}>Påbörjad</option>
                                        <option value="4" {{{ ($order->status == '4') ? 'selected' : '' }}}>Avslutad</option>
                                        <option value="3" {{{ ($order->status == '3') ? 'selected' : '' }}}>Arkiverad</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Regnr</label>
                                    <input type="text" name="reg_number" class="form-control" value="{{ $order->reg_number }}">
                                </div>
                                <div class="form-group">
                                    <label>Tillbehör</label>
                                    <input type="text" name="accessories" class="form-control" value="{{ $order->accessories }}">
                                </div>
                                <div class="form-group col-sm-4">
                                    <label>Plats</label>
                                    <input type="text" name="place" class="form-control" value="{{ $order->place }}" />
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
                                    <input type="text" name="sign" value="{{ $order->sign }}" class="form-control" data-parsley-required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <legend>Datum & tid</legend>
                                <div class="form-group">
                                    <label>Bokad</label>
                                    <div class='input-group date' id='datetimepicker-book'>
                                        <input type='text' class="form-control" name="booked_at" value="{{ $order->booked_at }}" data-parsley-required />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="exampleInputAmount">Arbetstid (i timmar)</label>
                                    <div class="input-group">
                                      <div class="input-group-addon">Arbetstid</div>
                                      <input type="text" class="form-control" name="estimated_time" value="{{ $order->estimated_time }}" data-parsley-required placeholder="timmar">
                                      <div class="input-group-addon">h</div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Hämtas av kund</label>
                                    <div class='input-group date' id='datetimepicker-pickup'>
                                        <input type='text' class="form-control" name="pickup_at" value="{{ $order->pickup_at }}"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                                <hr/>
                                <table class="table table-striped" id="orderEvents" ng-controller="OrderEditEventsController">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kommentar</th>
                                            <th>Sign</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($order->events as $event) 
                                        <tr id="{{ $event->order_event_id }}">
                                            <td><a href="/orderevent/{{ $event->order_event_id }}/edit">{{ $event->order_event_id }}</a></td>
                                            <td>{!! $event->comment !!}</td>
                                            <td>{{ $event->sign }}</td>
                                            <td><button ng-really-click="delete({{ $event->order_event_id }})" ng-really-message="Ta bort kommentar #{{ $event->order_event_id }}?" class="btn btn-danger btn-xs">Ta bort</button></td>
                                        </tr>       
                                    @endforeach
                                    </tbody>
                                </table>
                                <hr/>
                                <table class="table table-striped" id="articles" ng-controller="ArticlesEditController">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Artikel</th>
                                            <th>Antal</th>
                                            <th>Sign</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($order->articles as $article)
                                        <tr id="article_{{ $article->id }}">
                                            <td><a href="/article/order/{{ $article->id }}/edit">{{ $article->id }}</a></td>
                                            <td>{{ $article->article_list()->first()->article_id }}</td>
                                            <td>{{ $article->quantity }}</td>
                                            <td>{{ $article->sign }}</td>
                                            <td><button ng-really-click="delete({{$article->id}})" ng-really-message="Ta bort artikel #{{$article->id}}?" class="btn btn-danger btn-xs">Ta bort</button></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <input type="submit" class="btn btn-warning" value="Uppdatera" style="width:100%;" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $("#edit_order_form").parsley({
        trigger:      'change',
        successClass: "has-success",
        errorClass: "has-error",
        classHandler: function (el) {
            return el.$element.closest('.form-group');
        },
        errorsWrapper: '<div class="invalid-message"></div>',
        errorTemplate: '<span></span>',
    });

    $('#datetimepicker-book').datetimepicker({
        format: 'YYYY-MM-DD HH:mm'
    });
    $('#datetimepicker-pickup').datetimepicker({
        format: 'YYYY-MM-DD HH:mm'
    });
</script>
@endsection