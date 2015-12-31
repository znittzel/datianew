@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Arkiv</div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <th><a href="?sort=id">#</a>
                                @if (!isset($_GET['sort']) || $_GET['sort'] == 'id')
                                <span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span>
                                @endif
                            </th>
                            <th><a href="?sort=order_id">Ordernr</a>
                                @if (isset($_GET['sort']) && $_GET['sort'] == 'order_id')
                                <span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span>
                                @endif
                            </th>
                            <th>Kund</th>
                            <th>Orderinfo</th>
                            <th>Datum</th>
                            <th><a href="?sort=sign">Sign</a>
                                @if (isset($_GET['sort']) && $_GET['sort'] == 'sign')
                                <span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span>
                                @endif
                            </th>
                        </thead>
                        <tbody>
                            @foreach($archive as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td><a href="/order/{{ $order->id }}/show">{{ $order->order_id }}</a></td>
                                <td><a href="/customer/{{ $order->customer()->id }}/show">{{ $order->customer()->name }}</a></td>
                                <td>
                                    <small>
                                        <span class="fw-semi-bold">Type:</span>
                                        &nbsp; {{ $order->type }}
                                    </small>
                                    <br>
                                    <small>
                                        <span class="fw-semi-bold">Tillbehör:</span>
                                        &nbsp; {{ $order->accessories }}
                                    </small>
                                </td>
                                <td>
                                    <small>
                                        <span class="fw-semi-bold">Påbörjad:</span>
                                        &nbsp; {!! $order->startedAt() !!}
                                    </small>
                                    <br>
                                    <small>
                                        <span class="fw-semi-bold">Avslutad:</span>
                                        &nbsp; {!! $order->finishedAt() !!}
                                    </small>
                                </td>
                                <td>{{ $order->sign }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="btn-toolbar text-center" role="toolbar" aria-label="...">
                        @if (isset($_GET['sort']))
                            {!! $archive->appends(['sort' => $_GET['sort']])->links() !!}
                        @else
                            {!! $archive->appends(['sort' => 'id'])->links() !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
