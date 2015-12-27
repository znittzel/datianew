@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="text-left">Kunder</span>
                </div>
                <div class="panel-body panel-content-default">
                    <table class="table">
                        <tr>
                            <th>Kund id</th>
                            <th>Namn</th>
                            <th>Typ</th>
                            <th>Telefonnummer</th>
                        </tr>
                        @foreach ($customers as $customer)

                        <tr>
                            <td>{{ $customer->customer_id }}</td>
                            <td><a href="/customer/{{ $customer->id }}">{{ $customer->name }}</a></td>
                            <td>
                                @if ($customer->business) 
                                    Företag
                                @else
                                    Privat
                                @endif
                            </td>
                            <td>{{ $customer->telephone_number }}</td>
                        </tr>

                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
