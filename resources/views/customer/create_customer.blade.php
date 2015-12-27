@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="text-left">Ny kund</span>
                </div>
                <div class="panel-body panel-content-default">
                    <legend class="text-center">Skapa ny kund</legend>
                    @if (session("status"))
                        {!! session("status") !!}
                    @endif
                    <form action="/customer/create" method="post" id="create_customer" ng-controller="CreateCustomerController">
                        <input type="hidden" value="{!! csrf_token() !!}" name="_token" />
                        <div class="form-group" id="customer_id">
                            <label>Kundnummer</label>
                            <input type="text" ng-model="customer.id" ng-change="checkCustomerId()" name="customer_id" class="form-control" data-parsley-required>
                        </div>
                        <div class="alert alert-danger" id="div_customer_exists" style="display:none;">Kund existerar!</div>
                        <div class="form-group">
                            <label>Namn</label>
                            <input type="text" name="name" class="form-control" data-parsley-required />
                        </div>
                        <div class="form-group">
                            <label>Typ</label>
                            <select class="form-control" name="business">
                                <option value="0">Privat</option>
                                <option value="1">Företag</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Telefonnummer</label>
                            <input type="text" name="telephone_number" class="form-control" />
                        </div>
                        <input type="submit" class="btn btn-success" value="Skapa kund" />
                    </form> 

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $("#create_customer").parsley({
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