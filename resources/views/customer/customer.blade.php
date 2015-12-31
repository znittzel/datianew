@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Kunder</div>
                <div class="panel-body">
                    <!-- <div class="form-group form-inline pull-right">
                        <label>Sök:</label>
                        <input type="text" id="searchInput" class="form-control">
                    </div> -->
                    <table class="table" id="CustomerTable">
                        <thead>
                            <th>#
                            </th>
                            <th>Kundnr
                            </th>
                            <th>Namn
                            </th>
                            <th>Telefonnr
                            </th>
                            <th>Typ
                            </th>
                            <th>Omdöme
                            </th>
                        </thead>
                        <tbody ng-controller="CustomerSearchController" id="fbody">
                            @foreach($customers as $customer)
                            <tr>
                                <td>{{ $customer->id }}</td>
                                <td>{{ $customer->customer_id }}</td>
                                <td><a href="/customer/{{ $customer->id }}/show">{{ $customer->name }}</a></td>
                                <td>{{ $customer->telephone_number }}</td>
                                <td>
                                    @if ($customer->business)
                                    <span class="label label-primary">Företag</span>
                                    @else
                                    <span class="label label-success">Privat</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="label label-{{ $customer->getStatusByReputation()['status'] }}">
                                        {{ $customer->getStatusByReputation()['message'] }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#CustomerTable").DataTable();
        });
    </script>
@endsection
