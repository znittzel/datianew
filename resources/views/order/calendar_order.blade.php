@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default" id="panel_order">
                <div class="panel-heading">
                    <span class="text-left">Kalender</span>
                    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#orderModal">
                      Launch demo modal
                    </button>
                </div>
                <div class="panel-body panel-content-default" ng-controller="CalendarController">
                    <div id="calendar"></div>
                <div class="panel-footer">
                    <!-- Modal -->
                    <div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="Order">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel"><% data.customer.name %></h4>
                          </div>
                          <div class="modal-body">
                            ...
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                          </div>
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
        
@endsection