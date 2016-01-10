@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Däck</div>
                    <div class="panel-body">
                        <div>

                          <!-- Nav tabs -->
                          <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#file" aria-controls="file" role="tab" data-toggle="tab">Ta emot</a></li>
                            <li role="presentation"><a href="#return" aria-controls="return" role="tab" data-toggle="tab">Lämna tillbaka</a></li>
                          </ul>

                          <!-- Tab panes -->
                          <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="file">
                                <div class="well well-lg">
                                    @if(session("status"))
                                        {!! session("status") !!}
                                    @endif
                                    <form action="/tire/file" method="post" novalidate id="file_tire" ng-controller="FileTiresController">
                                        {!! csrf_field() !!}
                                        <div class="input-group">
                                            <label>Inlämningsdatum & tid</label>
                                            <div class='input-group date' id='datetimepicker-file'>
                                                <input type='text' class="form-control" name="filed_at" value="{!! date('Y-m-d H:i') !!}"/>
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                        <hr/>
                                        <div class="input-group">
                                            <label><i class="fa fa-user"></i> Kund <button class="btn btn-default btn-sm">Hämta</button></label>
                                            <input type="number" class="form-control" id="customer_id" data-parsley-customerexists="false" placeholder="Kundnummer" name="customer_id" data-parsley-required>
                                            <input type="text" class="form-control" id="customer_name" placeholder="Namn" name="customer_name" disabled data-parsley-required>
                                        </div>
                                        <hr/>
                                        <div class="input-group">
                                            <label><i class="fa fa-automobile"></i> Regnummer</label>
                                            <input type="text" name="reg_number" placeholder="ABC123" data-parsley-required class="form-control">
                                        </div>
                                        <hr/>
                                        <div class="input-group">
                                            <label>Däcktyp</label>
                                            <select class="form-control" name="type" data-parsley-required>
                                                <option value="vinter">Vinter</option> 
                                                <option value="sommar">Sommar</option> 
                                                <option value="allround">Allround</option> 
                                            </select>
                                        </div>
                                        <div class="input-group">
                                            <label>Antal</label>
                                            <select class="form-control" name="number_of_tires" data-parsley-required>
                                                <option value="4" selected>4</option>
                                                <option value="3">3</option>
                                                <option value="2">2</option>
                                                <option value="1">1</option>
                                            </select>
                                        </div>
                                        <br>
                                        <div class="input-group">
                                          <label>Däckkvalité (fritext)</label>
                                          <textarea class="form-control" name="quality" style="resize:vertical;" rows="4"></textarea>
                                        </div>
                                        <hr/>
                                        <div class="form-group">
                                            <label>Plats</label>
                                            <input class="form-control" data-parsley-required name="position" type="text"></input>
                                        </div>
                                        <input type="submit" class="btn btn-success" value="Lämna in">
                                    </form>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="return">...</div>
                          </div>

                        </div>
                    </div>        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section("script")
<script type="text/javascript">
    $("#file_tire").parsley({
        trigger:      'change',
        successClass: "has-success",
        errorClass: "has-error",
        classHandler: function (el) {
            return el.$element.closest('.form-group');
        },
        errorsWrapper: '<div class="invalid-message"></div>',
        errorTemplate: '<span></span>',
    });

    $('#datetimepicker-file').datetimepicker({
        format: 'YYYY-MM-DD HH:mm',
        sideBySide: true,
        calendarWeeks: true,
        useCurrent: true
    });
</script>
@endsection
