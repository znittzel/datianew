@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="text-left">Ny artikel</span>
                </div>
                <div class="panel-body panel-content-default">
                    <legend class="text-center">Skapa ny artikel</legend>
                    @if (session("status"))
                        {!! session("status") !!}
                    @endif
                    <form action="/article/create" class="col-md-6" method="post" id="create_article" novalidate ng-controller="CreateArticleController">
                        <input type="hidden" value="{!! csrf_token() !!}" name="_token" />
                        <div class="form-group">
                            <label>Artikelnummer</label>
                            <input type="text" name="article_id" class="form-control" data-parsley-articleexists="true" data-parsley-required data-parsley-maxlenght="255"/>
                        </div>
                        <div class="form-group">
                            <label>Benämning</label>
                            <input type="text" name="name" class="form-control" data-parsley-required data-parsley-maxlenght="255"/>
                        </div>
                        <div class="form-group">
                        	<label for="price">Pris</label>
						    <div class="input-group">
						      <input type="text" class="form-control" name="price" id="price" data-parsley-type="number" data-parsley-required >
						      <div class="input-group-addon">kr</div>
						    </div>
                        </div>
                        <div class="form-group">
                            <label>Enhet</label>
                            <select class="form-control" name="unit" data-parsley-required >
                                <option value="Styck">Styck</option>
                                <option value="Timme">Timme</option>
                            </select>
                        </div>
                        <input type="submit" class="btn btn-success" value="Skapa artikel" />
                    </form> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $("#create_article").parsley({
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