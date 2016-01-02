@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="text-left">Kundnummer {{ $customer->customer_id }}</span>
                </div>
                <div class="panel-body panel-content-default">
                    <legend class="text-center">{{ $customer->name }}</legend>
                    @if (session('status'))
                        {!! @session('status') !!}
                    @endif
                    <div class="col-md-6">
                        <form action="/customer/{{ $customer->id }}/update" method="post">
                            <input type="hidden" value="{!! csrf_token() !!}" name="_token" />
                            <div class="form-group">
                                <label>Kundnummer</label>
                                <input type="text" disabled name="customer_id" value="{{ $customer->customer_id }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Namn</label>
                                <input type="text" name="name" value="{{ $customer->name }}" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Typ</label>
                                {{ Form::select('business', ['Privat', 'Företag'], $customer->business, ['class' => 'form-control']) }}
                            </div>
                            <div class="form-group">
                                <label>Telefonnummer</label>
                                <input type="text" name="telephone_number" value="{{ $customer->telephone_number }}" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Omdöme</label>
                                {{ Form::select('reputation', ['Inget omdöme', 'Problem med betalning', 'Faktureras ej'], $customer->reputation, ['class' => 'form-control']) }}
                            </div>
                            <input type="submit" class="btn btn-warning" value="Ändra" />
                        </form> 
                    </div>
                    <div class="col-md-6" ng-controller="CustomerEditOrdersController">
                        <table class="table table-striped" id="customerOrders">
                            <tr>
                                <th>Orderid</th>
                                <th>Typ</th>
                                <th>Status</th>
                                <th></th>
                            </tr>

                            @foreach ($customer->orders as $order)
                                <tr class="{{ $order->state() }}" id="{{ $order->id }}">
                                    <td><a href="/order/{{ $order->id }}/show">{{ $order->order_id }}</a></td>
                                    <td>{{ $order->type }}</td>
                                    <td><span class="label label-{{$order->state()}}">{{ $order->stateName() }}</span></td>
                                    <td><button class="btn btn-danger btn-xs" ng-really-click="delete({{ $order->id }})" ng-really-message="Ta bort kommentar #{{ $order->order_id }}?">Ta bort</button</td>
                                </tr>
                            @endforeach

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
