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
                        <div class="form-group">
                            <label>Kundnummer</label>
                            <input type="text" class="form-control" data-parsley-whitespace="trim" ng-model="customer.id" ng-change="getCustomer()" id="customer_id" name="customer_id" data-parsley-minlength="4" data-parsley-required data-parsley-type="number">
                        </div>
                        <div class="form-group">
                            <label>Kundnamn</label>
                            <input type="text" disabled class="form-control" id="customer_name" data-parsley-required />
                        </div>
                        <hr/>
                        <div class="form-group">
                            <label>Ordernummer</label>
                            <input type="text" name="order_id" ng-model="order.id" ng-change="trimOrderId()" data-parsley-whitespace="trim" class="form-control" data-parsley-required data-parsley-type="number">
                        </div>
                        <div class="form-group">
                            <label>Ärende</label>
                            <textarea name="context" style="resize:vertical;" class="form-control" rows="5" data-parsley-required data-parsley-maxlength="1000"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Typ</label>
                            <input type="text" name="type" class="form-control" data-parsley-maxlength="255">
                        </div>
                        <div class="form-group">
                            <label>Tillbehör</label>
                            <input type="text" name="accessories" class="form-control" data-parsley-maxlength="255">
                        </div>
                        <div class="form-group">
                            <label>Lösenord</label>
                            <input type="text" name="password" class="form-control" data-parsley-maxlength="255">
                        </div>
                        <div class="form-group col-sm-4">
                            <label>Låda</label>
                            <input type="text" name="box" class="form-control" data-parsley-maxlength="255"/>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>Prioritering</label>
                            <select class="form-control" name="prio">
                                <option value="0">Normal</option>
                                <option value="1">Hög</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>Sign</label>
                            <input type="text" name="sign" class="form-control" data-parsley-required data-parsley-maxlength="2" />
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Skapa" style="width:100%;" />
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
</script>
@endsection
