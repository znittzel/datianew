@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default" id="panel_order">
                <div class="panel-heading">
                    <span class="text-left">Skapa användare</span>
                </div>
                <div class="panel-body panel-content-default">
                    <form action="/admin/user/create" id="create_user" method="post" novalidate>
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label>Namn</label>
                            <input type="text" name="name" class="form-control" data-parsley-required data-parsley-minlenght="2" data-parsley-maxlenght="255">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" data-parsley-emailexists="true" data-parsley-required data-parsley-minlenght="2" data-parsley-type="email" data-parsley-maxlenght="255">
                        </div>
                        <div class="form-group">
                            <label>Lösenord</label>
                            <input type="password" id="password" name="password" class="form-control" data-parsley-required >
                        </div>
                        <div class="form-group">
                            <label>Upprepa lösenord</label>
                            <input type="password" name="password_again" class="form-control" data-parsley-required data-parsley-equalto="#password">
                        </div>
                        <div class="form-group">
                            <label>Rättigheter</label>
                            <select name="group_id" class="form-control">
                                <option value="2">Användare</option>
                                <option value="1">Administratör</option>
                            </select>
                        </div>
                        <input type="submit" class="btn btn-default btn-lg" value="Skapa användare"> 
                    </form>
                </div>
                <div class="panel-footer">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $("#create_user").parsley({
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