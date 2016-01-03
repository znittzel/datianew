@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-{{ $order->state() }}" id="panel_order">
                <div class="panel-heading">
                    @if ($order->status == 3)
                        <span class="text-left">Order {{ $order->order_id }} <span class="label label-default">Arkiverad</span></span>
                    @else
                        <span class="text-left">Order {{ $order->order_id }}</span>
                    @endif
                    <span class="pull-right"><i>{{ $order->created_at .' - '. $order->sign }}</i></span>
                </div>
                <div class="panel-body panel-content-{{ $order->state() }}">
                    <h4 class="text-center"><a href="/order/{{ $order->id }}/edit">{{ $order->order_id }}</a> - <a href="/customer/{{ $order->customer()->first()->id }}/show">{{$order->customer()->first()->name }}</a></h4>
                    @if (session('status'))
                        {!! session('status') !!}
                    @endif
                    <table class="table">
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
                    <div id="comments">
                        @foreach($order->events as $event)

                        <div class="row order-comment-row">
                            <div class="col-md-7 order-comment">{!! $event->comment !!}</div>
                            <div class="col-md-4 order-comment">{{ $event->created_at }}</div>
                            <div class="col-md-1 order-comment">{{ $event->sign }}</div>
                        </div>

                        @endforeach
                    </div>
                    <br>
                    <!-- Button trigger modal -->
                    
                    <div class="col-md-3 @if($order->status != 4) {{'hidden'}} @endif" id="div_deliver_order">
                        <form action="/order/{{ $order->id }}/archive" method="post" novalidate id="archive_order">
                            {!! csrf_field() !!}
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Sign</label>
                                    <div class="col-lg-10">
                                        <input type="text" data-parsley-required class="form-control" name="sign" >
                                    </div>
                                </div>
                                <br>
                                <div class="col-lg-10 col-lg-offset-2">
                                    <button type="submit" class="btn btn-default">Lämna ut</button>
                                  </div>
                            </fieldset>
                        </form>
                    </div>

                    <button type="button" id="btn_comment" class="btn btn-default btn-lg @if($order->status == 4) {{ 'hidden' }} @endif" data-toggle="modal" data-target="#modalComment">
                      Kommentera
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="modalComment" tabindex="-1" role="dialog" aria-labelledby="Comment" ng-controller="CommentOrderController">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" ng-click="closeModal()" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Kommentera</h4>
                          </div>
                          <div class="modal-body">
                            <form class="form-horizontal" novalidate id="comment_order">
                                {!! csrf_field() !!}
                                <input type="hidden" ng-model="comment.order_id" ng-init="comment.order_id = {{$order->order_id}}">
                                <input type="hidden" ng-model="comment.panel_classname" ng-init="comment.panel_classname='panel-{{$order->state()}}'">
                              <fieldset>
                                <div class="form-group">
                                  <label for="textArea" class="col-lg-2 control-label">Kommentar</label>
                                  <div class="col-lg-10">
                                    <textarea class="form-control" ng-model="comment.comment" data-parsley-maxlength="1000" data-parsley-required rows="3" id="textArea"></textarea>
                                    <span class="help-block">Skriv din kommentar ovan. Max 1000 tecken.</span>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="inputSign" class="col-lg-2 control-label">Sign</label>
                                  <div class="col-lg-10">
                                    <input type="text" ng-model="comment.sign" data-parsley-required class="form-control" id="sign">
                                  </div>
                                </div>
                                <div class="form-group">
                                    <div class="checkbox col-lg-10 col-md-offset-2">
                                      <label>
                                        <input type="checkbox" ng-model="comment.finished" id="finished"> Avsluta order
                                      </label>
                                    </div>
                                </div>
                              </fieldset>
                            </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" ng-click="closeModal()">Stäng</button>
                            <button type="button" class="btn btn-primary" ng-click="save(comment)">Spara</button>
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

    $("#archive_order").parsley({
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