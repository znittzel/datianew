@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default" id="panel_order">
                <div class="panel-heading">
                    <span class="text-left">Kalender</span>
                </div>
                <div class="panel-body panel-content-default" ng-controller="CalendarController">
                    <div id="calendar"></div>
                </div>
                <div class="panel-footer">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@endsection