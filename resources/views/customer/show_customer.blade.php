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
                    
                    <div class="col-md-6">
                        <form action="/customer/{{ $customer->id }}" method="post">
                            <input type="hidden" value="{!! csrf_token() !!}" name="_token" />
                            <div class="form-group">
                                <label>Kundnummer</label>
                                <input type="text" name="customer_id" value="{{ $customer->customer_id }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Namn</label>
                                <input type="text" name="name" value="{{ $customer->name }}" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Typ</label>
                                <select class="form-control" name="business">
                                    @if ($customer->business)
                                    <option value="1">Företag</option>
                                    <option value="0">Privat</option>
                                    @else
                                    <option value="0">Privat</option>
                                    <option value="1">Företag</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Telefonnummer</label>
                                <input type="text" name="telephone_number" value="{{ $customer->telephone_number }}" class="form-control" />
                            </div>
                            <input type="submit" class="btn btn-success" value="Ändra" />
                        </form> 
                    </div>
                    <div class="col-md-6">
                        <table class="table table-striped">
                            <tr>
                                <th>Orderid</th>
                                <th>Typ</th>
                            </tr>

                            @foreach ($customer->orders as $order)
                                <tr class="{{ $order->state() }}">
                                    <td><a href="/order/{{ $order->id }}/show">{{ $order->order_id }}</a></td>
                                    <td>{{ $order->type }}</td>
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
