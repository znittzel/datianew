@extends('layouts.app')

@section('content')
	<div class="container spark-screen">
	    <div class="row">
	        <div class="col-md-10 col-md-offset-1">
	            <div class="panel panel-default">
	                <div class="panel-heading">Kunder</div>
	                <div class="panel-body">
	                    <table class="table table-bordered" id="users-table">
					        <thead>
					            <tr>
					                <th>Id</th>
					                <th>Name</th>
					                <th>Email</th>
					                <th>Created At</th>
					                <th>Updated At</th>
					            </tr>
					        </thead>
					    </table>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
@endsection

@section('script')
<script>
	$(function() {
	    $('#users-table').DataTable({
	        processing: true,
	        serverSide: true,
	        ajax: '{!! route('datatables.data') !!}',
	        columns: [
	            { data: 'id', name: 'id' },
	            { data: 'name', name: 'name' },
	            { data: 'email', name: 'email' },
	            { data: 'created_at', name: 'created_at' },
	            { data: 'updated_at', name: 'updated_at' }
	        ]
	    });
	});
</script>
@endsection