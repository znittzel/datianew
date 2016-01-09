@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="text-left">Skapa ny order</span>
                </div>
                <div class="panel-body panel-content-default">
                    <form method="post" action="/order/create" id="create_order_form" ng-controller="OrderController">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                        <input type="hidden" name="status" value="1" />
                            <legend><i class="fa fa-calendar"></i> Datum & tid</legend>
                            <div class="form-group">
                                <label> Bokad den...</label>
                                <div class='input-group date' id='datetimepicker-book'>
                                    <input type='text' class="form-control" name="booked_at" data-parsley-required/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="exampleInputAmount">Arbetstid (i timmar)</label>
                                <div class="input-group">
                                  <div class="input-group-addon">Beräknad arbetstid</div>
                                  <input type="text" class="form-control" name="estimated_time" data-parsley-required placeholder="timmar">
                                  <div class="input-group-addon">h</div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Hämtas av kund den...</label>
                                <div class='input-group date' id='datetimepicker-pickup'>
                                    <input type='text' class="form-control" name="pickup_at"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                            <legend>Orderinformation</legend>
                            <div class="form-group form-inline">
                                <div class="input-group">
                                    <label><i class="fa fa-user"></i> Kundnummer</label>
                                    <input type="text" class="form-control" data-parsley-whitespace="trim" value="@if(isset($_GET['customer_id'])) {{ $_GET['customer_id'] }} @endif" id="customer_id" name="customer_id" data-parsley-required data-parsley-type="number">
                                </div>
                                <button type="button" class="btn btn-default btn-sm" ng-click="modalGetCustomer()">
                                  Kundlista
                                </button>
                            </div>
                            <div class="form-group">
                                <label><i class="fa fa-user"></i> Kundnamn</label>
                                <input type="text" disabled class="form-control" id="customer_name" value="@if(isset($_GET['customer_name'])) {{ $_GET['customer_name'] }} @endif" data-parsley-required />
                            </div>
                            <div class="form-group form-inline">
                                <div class="input-group">
                                    <label><i class="fa fa-file-o"></i> Ordernummer</label>
                                    <input type="text" id="order_id" name="order_id" ng-model="order.id" ng-change="trimOrderId()" data-parsley-whitespace="trim" class="form-control" data-parsley-required data-parsley-type="number" data-parsley-orderexists="true">
                                </div>
                                <button type="button" class="btn btn-default btn-sm" ng-click="getNextOrderId()">
                                  Hämta nästa
                                </button>
                            </div>
                            <div class="form-group">
                                <label><i class="fa fa-header"></i> Titel</label>
                                <input type="text" name="title" class="form-control" data-parsley-required data-parsley-maxlength="255" />
                            </div>
                            <div class="form-group">
                                <label><i class="fa fa-align-left"></i> Beskrivning</label>
                                <textarea name="context" style="resize:vertical;" class="form-control" rows="5" data-parsley-maxlength="1000"></textarea>
                            </div>
                            <div class="form-group">
                                <label><i class="fa fa-automobile"></i> Regnr</label>
                                <input type="text" name="reg_number" class="form-control" placeholder="ABC123" data-parsley-required data-parsley-maxlength="6" data-parsley-minlength="6">
                            </div>
                            <div class="form-group">
                                <label>Tillbehör</label>
                                <input type="text" name="accessories" class="form-control" data-parsley-maxlength="255">
                            </div>
                            <div class="form-group col-sm-4">
                                <label><i class="fa fa-square-o"></i> Plats</label>
                                <input type="text" name="plats" class="form-control" data-parsley-maxlength="255"/>
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Prioritering</label>
                                <select class="form-control" name="prio">
                                    <option value="0">Normal</option>
                                    <option value="1">Hög</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label><i class="fa fa-check-square-o"></i> Sign</label>
                                <input type="text" name="sign" class="form-control" data-parsley-required data-parsley-maxlength="2" />
                            </div>

                        <input type="submit" class="btn btn-success" value="Skapa" style="width:100%;" />

                        <!--GET CUSTOMER MODAL -->
                        <div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-user"></i> Kundlista</h4>
                              </div>
                              <div class="modal-body">
                                <label>Kunder</label>
                                <select class="form-control" ng-model="customer" ng-options="customer.customer_id as customer.name for customer in customers">
                                    <option value="">--- Välj kund ---</option>
                                </select>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Avbryt</button>
                                <button type="button" class="btn btn-primary" ng-click="chooseCustomer(customer)">Välj</button>
                              </div>
                            </div>
                          </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $("#create_order_form").parsley({
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
        format: 'YYYY-MM-DD HH:mm',
        sideBySide: true,
        calendarWeeks: true
    });
    $('#datetimepicker-pickup').datetimepicker({
        format: 'YYYY-MM-DD HH:mm',
        sideBySide: true,
        calendarWeeks: true
    });
</script>
@endsection
