@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-{{ $order->state() }}">
                <div class="panel-heading">
                    <span class="text-left">Order {{ $order->order_id }}</span>
                    <span class="pull-right"><i>{{ $order->created_at }}</i></span>
                </div>
                <div class="panel-body panel-content-{{ $order->state() }}">
                    <legend class="text-center">{{ $order->order_id }} - <a href="/customer/{{ $order->customer()->id }}">{{$order->customer()->name }}</a></legend>
                    <p class="order-heading">{!! $order->context !!}</p>
                    <hr/>

                    @foreach($order->events as $event)

                    <div class="row order-comment-row" style="margin:5px;">
                        <div class="col-md-7 order-comment">{!! $event->comment !!}</div>
                        <div class="col-md-4 order-comment">{{ $event->created_at }}</div>
                        <div class="col-md-1 order-comment">{{ $event->sign }}</div>
                    </div>

                    @endforeach

                    @if ($order->status != '3' && $order->status != '4')
                    <form method="post" action="/order/{{ $order->id }}/edit">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                        <div class="form-group">
                            <label>Kommentar</label>
                            <textarea name="comment" style="resize:vertical;" class="form-control" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Sign</label>
                            <input type="text" name="sign" style="width:10em;" class="form-control"/>
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
                    <form method="post" action="/order/{{ $order->id }}/return">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                        <input type="submit" class="btn btn-default" value="Slå tillbaka" />
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
