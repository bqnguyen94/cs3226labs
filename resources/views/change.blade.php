@extends('layouts.template') <!-- use template from previous slide -->
@section('main') <!-- define a section called main -->
<div class="container-fluid">
	<table>
		<thead>
			<th>Name</th>
			<th>Change</th>
			<th>Name</th>
			<th>Change</th>
		</thead>
		<tbody>
		
			<tr>
				<td>User</td>
				<td>Role</td>
				<td>Button to switch</td>
				<td>Button to update</td>
			</tr>
			
		</tbody>
	</table>
</div>                
@stop

@section('script')
<script type="text/javascript" src="/js/index.js"></script>
@stop
