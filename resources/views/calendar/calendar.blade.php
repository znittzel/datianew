@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default" id="panel_order">
                <div class="panel-heading">
                    <span class="text-left">Kalender</span>
                </div>
                <div class="panel-body panel-content-default" ng-controller="CalendarController">
                    <div id="calendar"></div>
                    <!-- Modal -->
                    <div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="Order">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel"><% data.customer.name %> -  <% data.event.title %>
                                <span class="label <% view.stateLabel %>">
                                    <% view.stateLabelName %>
                                </span>
                            </h4>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-md-2">
                                <p><i class="fa fa-automobile"></i> Regnr</p>
                                <h5><% data.order.reg_number %></h5>
                              </div>
                              <div class="col-md-4">
                                  <p>Tillbehör</p>
                                  <h5><% data.order.accessories %></h5>
                              </div>
                              <div class="col-md-4">
                                  <p><i class="fa fa-mobile"></i> Telefonnr</p>
                                  <h5>
                                    <a href="tel:<% data.customer.telephone_number %>"><% data.customer.telephone_number %></a>
                                  </h5>
                              </div>
                              <div class="col-md-2">
                                  <p>Plats</p>
                                  <h5><% data.order.place %></h5>
                              </div>
                            </div>
                            <br>
                            <div class="row">
                              <div class="col-md-6">
                                <legend>Bokad</legend>
                                <div class="col-md-6">
                                  <p><i class="fa fa-calendar-o"></i> Datum</p>
                                  <h5 ng-if="data.order.booked_at"><% data.order.booked_at | date:'yyyy-MM-dd' %></h5>
                                </div>
                                <div class="col-md-6">
                                  <p><i class="fa fa-clock-o"></i> Tid</p>
                                  <h5 ng-if="data.order.booked_at"><% data.order.booked_at | date:'HH:mm' %></h5>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <legend>Hämtas</legend>
                                <div class="col-md-6">
                                  <p><i class="fa fa-calendar-o"></i> Datum</p>
                                  <h5 ng-if="data.order.booked_at"><% data.order.pickup_at | date:'yyyy-MM-dd' %></h5>
                                </div>
                                <div class="col-md-6">
                                  <p><i class="fa fa-clock-o"></i> Tid</p>
                                  <h5 ng-if="data.order.booked_at"><% data.order.pickup_at | date:'HH:mm' %></h5>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <a href="/order/<% data.order.id %>/show" class="pull-left">Gå till order</a>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
                <div class="panel-footer">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@endsection