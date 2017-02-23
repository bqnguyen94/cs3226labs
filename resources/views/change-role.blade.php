@extends('layouts.template') <!-- use template from previous slide -->
@section('main') <!-- define a section called main -->
<div class="container-fluid">
	<table>
		<thead>
			<th>Name</th>
			<th>Change</th>
		</thead>
		<tbody>
			@foreach($users as $user)
			<tr>
				<td>$user->name</td>
				@if($user->role==User::ROLE_USER)
				<td></td>
				@elseif($user->role==User::ROLE_MOD)
				<td></td>
				@endif
			</tr>
			@endforeach
		</tbody>
	</table>
</div>                
@stop

@section('script')
<script type="text/javascript" src="/js/index.js"></script>
@stop
