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
                    <span class="pull-right"><i>{{ $order->booked_at .' - '. $order->sign }}</i></span>
                </div>
                <div class="panel-body panel-content-{{ $order->state() }}">
                    <legend class="text-center"><a href="/order/{{ $order->id }}/edit">{{ $order->order_id }}</a> - <a href="/customer/{{ $order->customer()->first()->id }}/show">{{$order->customer()->first()->name }}</a></legend>
                    @if (session('status'))
                        {!! session('status') !!}
                    @endif
                    <div class="well">
                        <p class="order-heading">{!! nl2br(e($order->context)) !!}</p>
                    </div>
                    <div id="comments" class="col-md-8">
                        @foreach($order->events as $event)

                        <div class="row order-comment-row">
                            <div class="col-md-7 order-comment">{!! $event->comment !!}</div>
                            <div class="col-md-4 order-comment">{{ $event->created_at }}</div>
                            <div class="col-md-1 order-comment">{{ $event->sign }}</div>
                        </div>

                        @endforeach
                    </div>
                    <div class="col-md-4">
                        <ul class="list-group" id="articles">
                          @foreach($order->articles as $article)
                          <li class="list-group-item">
                            {{ $article->article_list()->first()->article_id }} - {{$article->sign}}
                            <span class="badge">{{$article->quantity}} st</span>
                          </li>
                          @endforeach
                        </ul>
                    </div>
                    <br>
                    <!-- Button trigger modal -->
                </div>
                <div class="panel-footer">
                    <div class="@if($order->status != 4 && $order->status != 3) {{'hidden'}} @endif" id="div_deliver_order">
                        <button type="submit" class="btn btn-default btn-lg @if($order->status == 3) {{'hidden'}} @endif" data-toggle="modal" data-target="#modalDeliver">
                          <i class="fa fa-mail-forward"></i> Lämna ut
                        </button>
                        <button class="btn btn-default btn-lg @if($order->status != 3) {{'pull-right'}} @endif" data-toggle="modal" data-target="#modalInformation">
                            <i class="fa fa-info"></i> Information
                        </button>
                    </div>

                    <div class="@if($order->status == 4 || $order->status == 3) {{ 'hidden' }} @endif" id="div_ongoing_order">
                        <button type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#modalComment">
                          <i class="fa fa-comment"></i> Kommentera
                        </button>
                        <button type="button" class="btn btn-default btn-lg @if($order->status == 4) {{ 'hidden' }} @endif" data-toggle="modal" data-target="#modalArticle">
                          <i class="fa fa-plus"></i> Lägg till artikel
                        </button>
                        <button class="btn btn-default btn-lg pull-right" data-toggle="modal" data-target="#modalInformation">
                            <i class="fa fa-info"></i> Information
                        </button>
                    </div>
                    <!-- Modal Comment -->
                    <div class="modal fade" id="modalComment" tabindex="-1" role="dialog" aria-labelledby="Comment" ng-controller="CommentOrderController">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" ng-click="closeModal()" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-btn fa-comment"></i> Kommentera</h4>
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
                    <!-- Modal Add Article -->
                    <div class="modal fade" id="modalArticle" tabindex="-1" role="dialog" aria-labelledby="Article" ng-controller="AddArticleOrderController">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" ng-click="closeModal()" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-btn fa-tag"></i> Lägg till artikel</h4>
                          </div>
                          <div class="modal-body">
                            <form class="form-horizontal" novalidate id="article_order">
                                {!! csrf_field() !!}
                                <input type="hidden" ng-model="article.order_id" ng-init="article.order_id='{{ $order->order_id }}'">
                              <fieldset>
                                <div class="form-group">
                                  <div class="col-lg-10">
                                    <input class="form-control" data-parsley-articleexists="false" type="text" name="article_id" ng-model="article.article_id" placeholder="Artikelnummer"></input>
                                    <span class="help-block">Skriv artikelnummret för att hämta artikeln.</span>
                                  </div>
                                </div>
                                <div class="form-group col-lg-10">
                                    <div class="input-group">
                                        <input class="form-control" data-parsley-type="number" type="number" name="quantity" placeholder="Antal" ng-model="article.quantity" data-parsley-type="number"></input>
                                        <span class="help-block">Ange antal att addera.</span>
                                        <div class="input-group-addon">st</div>
                                    </div>
                                </div>
                                <div class="form-group">
                                  <div class="col-lg-3">
                                    <input type="text" ng-model="article.sign" placeholder="Sign" data-parsley-required class="form-control" id="sign">
                                  </div>
                                </div>
                              </fieldset>
                            </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" ng-click="closeModal()">Stäng</button>
                            <button type="button" class="btn btn-primary" ng-click="save(article)">Spara</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Modal Information -->
                    <div class="modal fade" id="modalInformation" tabindex="-1" role="dialog" aria-labelledby="Information">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-btn fa-info"></i> Information <span class="label label-{{ $order->state() }}">{{ $order->stateName() }}</span></h4>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-md-2">
                                <p><i class="fa fa-automobile"></i> Regnr</p>
                                <h5>{{ $order->reg_number }}</h5>
                              </div>
                              <div class="col-md-4">
                                  <p>Tillbehör</p>
                                  <h5>{{ $order->accessories }}</h5>
                              </div>
                              <div class="col-md-4">
                                  <p><i class="fa fa-mobile"></i> Telefonnr</p>
                                  <h5>
                                    <a href="tel:{{$order->customer()->first()->telephone_number}}">{{ $order->customer()->first()->telephone_number }}</a>
                                  </h5>
                              </div>
                              <div class="col-md-2">
                                  <p>Plats</p>
                                  <h5>{{ $order->place }}</h5>
                              </div>
                            </div>
                            <hr/>
                            <div class="row">
                              <div class="col-md-3">
                                <p><i class="fa fa-calendar-o"></i> Datum</p>
                                <h5>@if ($order->booked_at) {{ date('Y-m-d',strtotime($order->booked_at)) }} @endif</h5>
                              </div>
                              <div class="col-md-3">
                                <p><i class="fa fa-clock-o"></i> Tid</p>
                                <h5>@if ($order->booked_at) {{ date('H:i',strtotime($order->booked_at)) }} @endif</h5>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Stäng</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Modal Deliver -->
                    <div class="modal fade" id="modalDeliver" tabindex="-1" role="dialog" aria-labelledby="Lämna ut">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-btn fa-mail-forward"></i> Lämna ut</h4>
                          </div>
                          <div class="modal-body row">
                            <form action="/order/{{ $order->id }}/archive" class="form-inline" method="post" novalidate id="archive_order">
                              {!! csrf_field() !!}
                              <div class="form-group">
                                  <label class="col-lg-2 control-label">Sign</label>
                                  <div class="col-lg-10">
                                      <input type="text" data-parsley-required class="form-control" name="sign" >
                                  </div>
                              </div>
                              <button type="submit" class="btn btn-default btn-lg">Lämna ut</button>
                          </form>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Stäng</button>
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

    $("#article_order").parsley({
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