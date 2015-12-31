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
                            <th>#</th>
                            <th>Kundnr</th>
                            <th>Namn</th>
                            <th>Telefonnr</th>
                            <th>Skapad</th>
                        </thead>
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
            $('#CustomerTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('customer.data') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'customer_id', name: 'customer_id' },
                    { data: 'name', name: 'name' },
                    { data: 'telephone_number', name: 'telephone_number' },
                    { data: 'created_at', name: 'created_at' }
                ]
            });
        });
    </script>
@endsection
