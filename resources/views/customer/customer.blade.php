@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Kunder</div>
                <div class="panel-body">
                    <div ng-controller="CustomerEditController" id="customer_div">
                    {!! $html->table() !!}
                        <!-- Modal -->
                        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel"><% customer.name %></h4>
                              </div>
                              <div class="modal-body">
                                <form>
                                    <input type="hidden" name="_token" ng-model="token" ng-init="{!! csrf_token() !!}">
                                    <input type="hidden" name="row_id" ng-model="rowId">
                                    <div class="form-group">
                                        <label>Kundnummer</label>
                                        <input type="text" disabled class="form-control" ng-model="customer.customer_id">
                                    </div>
                                    <div class="form-group">
                                        <label>Namn</label>
                                        <input type="text" class="form-control" ng-model="customer.name">
                                    </div>
                                    <div class="form-group">
                                        <label>Telefonnummer</label>
                                        <input type="text" class="form-control" ng-model="customer.telephone_number">
                                    </div>
                                    <div class="form-group">
                                        <label>Typ</label>
                                        <select class="form-control"  ng-model="customer.business">
                                            <option ng-selected="customer.business" value="1">Företag</option>
                                            <option ng-selected="!customer.business" value="0">Privat</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Omdöme</label>
                                        <select class="form-control" ng-model="customer.reputation">
                                            <option ng-selected="customer.reputation == 0" value="0">Inget omdöme</option>
                                            <option ng-selected="customer.reputation == 1" value="1">Problem med betalning</option>
                                            <option ng-selected="customer.reputation == 2" value="2">Faktureras inte</option>
                                        </select>
                                    </div>
                                </form>
                              </div>
                              <div class="modal-footer">
                                <a href="/customer/<% customer.id %>/show" class="pull-left">Mer information</a>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Stäng</button>
                                <button type="button" class="btn btn-primary" ng-click="saveCustomer(customer, rowId)">Spara</button>
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
    {!! $html->scripts() !!}

    <script type="text/javascript">
        var editCustomerJavascript = function(customer_id, id) {
            angular.element($("#customer_div")).scope().editCustomer(customer_id, id);
        }
    </script>
@endsection
