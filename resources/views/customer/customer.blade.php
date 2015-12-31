@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Kunder</div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <th><a href="?sort=id">#</a>
                                @if (!isset($_GET['sort']) || $_GET['sort'] == 'id')
                                <span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span>
                                @endif
                            </th>
                            <th><a href="?sort=customer_id">Kundnr</a>
                                @if (isset($_GET['sort']) && $_GET['sort'] == 'customer_id')
                                <span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span>
                                @endif
                            </th>
                            <th><a href="?sort=name">Namn</a>
                                @if (isset($_GET['sort']) && $_GET['sort'] == 'name')
                                <span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span>
                                @endif
                            </th>
                            <th><a href="?sort=telephone_number">Telefonr</a>
                                @if (isset($_GET['sort']) && $_GET['sort'] == 'telephone_number')
                                <span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span>
                                @endif
                            </th>
                            <th><a href="?sort=business">Typ</a>
                                @if (isset($_GET['sort']) && $_GET['sort'] == 'business')
                                <span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span>
                                @endif
                            </th>
                            <th><a href="?sort=reputation">Omdöme</a>
                                @if (isset($_GET['sort']) && $_GET['sort'] == 'reputation')
                                <span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span>
                                @endif
                            </th>
                        </thead>
                        <tbody>
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
                    <div class="btn-toolbar text-center" role="toolbar" aria-label="...">
                        @if (isset($_GET['sort']))
                            {!! $customers->appends(['sort' => $_GET['sort']])->links() !!}
                        @else
                            {!! $customers->appends(['sort' => 'id'])->links() !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
