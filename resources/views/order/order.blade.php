@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-{{ $order->state() }}">
                <div class="panel-heading">
                    @if ($order->status == 3)
                        <span class="text-left">Order {{ $order->order_id }} <span class="label label-default">Arkiverad</span></span>
                    @else
                        <span class="text-left">Order {{ $order->order_id }}</span>
                    @endif
                    <span class="pull-right"><i>{{ $order->created_at .' - '. $order->sign }}</i></span>
                </div>
                <div class="panel-body panel-content-{{ $order->state() }}">
                    <legend class="text-center"><a href="/order/{{ $order->id }}/edit">{{ $order->order_id }}</a> - <a href="/customer/{{ $order->customer()->first()->id }}/show">{{$order->customer()->first()->name }}</a></legend>
                        
                    <table class="table table-striped">
                        <tr>
                            <th>Typ</th>
                            <th>Tillbehör</th>
                            <th>Lösenord</th>
                            <th>Låda</th>
                            <th>Telefonnummer</th>
                        </tr>
                        <tr class="active">
                            <td>{{ $order->type }}</td>
                            <td>{{ $order->accessories }}</td>
                            <td>{{ $order->password }}</td>
                            <td>{{ $order->box }}</td>
                            <td><a href="tel:{{$order->customer()->first()->telephone_number}}">{{ $order->customer()->first()->telephone_number }}</a></td>
                        </tr>
                    </table>
                    <p class="order-heading">{!! nl2br(e($order->context)) !!}</p>
                    <hr/>

                    @foreach($order->events as $event)

                    <div class="row order-comment-row" style="margin:5px;">
                        <div class="col-md-7 order-comment">{!! $event->comment !!}</div>
                        <div class="col-md-4 order-comment">{{ $event->created_at }}</div>
                        <div class="col-md-1 order-comment">{{ $event->sign }}</div>
                    </div>

                    @endforeach
                    <br>
                    @if ($order->status != '3' && $order->status != '4')
                    <form method="post" action="/order/{{ $order->id }}/comment" id="comment_order">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                        <div class="form-group">
                            <label>Kommentar</label>
                            <textarea name="comment" data-parsley-required style="resize:vertical;" class="form-control" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Sign</label>
                            <input type="text" data-parsley-required name="sign" style="width:10em;" class="form-control"/>
                            <label>
                              <input type="checkbox" name="finished"> Avsluta
                            </label>
                        </div>
                        <input type="submit" class="btn btn-default" value="Kommentera" />
                    </form>
                    @elseif ($order->status == '4')
                    <form method="post" action="/order/{{ $order->id }}/archive">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                        <div class="form-group">
                            <label>Sign</label>
                            <input type="text" name="sign" style="width:10em;" class="form-control"/>
                        </div>
                        <input type="submit" class="btn btn-default" value="Lämna ut" />
                    </form>
                    @else
                    <form method="post" action="/order/{{ $order->id }}/return_order">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                        <div class="form-group">
                            <label>Sign</label>
                            <input type="text" name="sign" style="width:10em;" class="form-control"/>
                        </div>
                        <input type="submit" class="btn btn-default" value="Slå tillbaka" />
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $("#comment_order").parsley({
        trigger:      'change',
        successClass: "has-success",
        errorClass: "has-error",
        classHandler: function (el) {
            return el.$element.closest('.form-group');
        },
        errorsWrapper: '<div class="invalid-message"></div>',
        errorTemplate: '<span></span>',
    });
</script>
@endsection