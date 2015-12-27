@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="text-left">Event #{{$orderevent->order_event_id}}</span>
                    <span class="pull-right"><a href="/order/{{ $orderevent->order()->id }}/edit">Tillbaka till order {{ $orderevent->order_id }}</a></span>
                </div>
                <div class="panel-body panel-content-default">
                    @if (session("status"))
                        {!! session("status") !!}
                    @endif
                    <form action="/orderevent/{{ $orderevent->order_event_id }}/update" method="post" id="edit_orderevent" ng-controller="EditOrderEventController">
                        <input type="hidden" value="{!! csrf_token() !!}" name="_token">
                        <div class="form-group">
                            <label>Tillhör order</label>
                            <input type="text" disabled value="{{ $orderevent->order_id }}" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Kommentar</label>
                            <textarea style="resize:vertical;" class="form-control" rows="5" data-parsley-maxlength="1000" data-parsley-required name="comment">{!! $orderevent->comment !!}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Sign</label>
                            <input class="form-control" name="sign" type="text" value="{{ $orderevent->sign }}" data-parsley-required>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-warning" value="Ändra">
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
    $("#edit_orderevent").parsley({
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