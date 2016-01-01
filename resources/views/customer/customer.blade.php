@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Kunder</div>
                <div class="panel-body">
                    <div ng-controller="CustomerEditController">
                    {!! $html->table() !!}
                    <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-lg" ng-click="editCustomer(1000)">
                          Launch demo modal
                        </button>

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
                                    <div class="form-group">
                                        <label>Kundnummer</label>
                                        <input type="text" class="form-control" ng-model="customer.customer_id">
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
                                        <select class="form-control">
                                            <option ng-selected="customer.business">Företag</option>
                                            <option ng-selected="!customer.business">Privat</option>
                                        </select>
                                    </div>
                                </form>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Stäng</button>
                                <button type="button" class="btn btn-primary">Spara</button>
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
@endsection
