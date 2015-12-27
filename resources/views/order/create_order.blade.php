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
                    <form method="post" action="/order/create" style="padding:15px;">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                        <div class="row">
                            <div class="form-group">
                                <label>Kund</label>
                                <select class="form-control" name="customer_id">
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->customer_id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label>Orderid</label>
                                <input type="text" name="order_id" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label>Ärende</label>
                                <textarea name="context" style="resize:vertical;" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label>Typ</label>
                                <input type="text" name="type" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label>Tillbehör</label>
                                <input type="text" name="accessories" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label>Lösenord</label>
                                <input type="text" name="password" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label>Låda</label>
                                <input type="text" name="box" class="form-control"/>
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
                                <input type="text" name="sign" class="form-control"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <input type="submit" class="btn btn-success" value="Skapa" style="width:100%;" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
