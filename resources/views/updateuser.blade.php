@extends('layouts.template') <!-- use template from previous slide -->
@section('main') <!-- define a section called main -->

<div class="alert alert-info"> Updating in progress...</div>
<div class="container-fluid">
	{!! Form::open() !!}
	{!! Form::label('username', 'Enter the user name', ['class' => 'control-label']) !!}<br>
	{!! Form::text('username', '', ['class' => 'control-label']) !!}
	<br><br>
	{!! Form::label('email', 'To update email address', ['class' => 'control-label']) !!}
	{!! Form::text('email', null, ['class' => 'form-control']) !!}
	<br><br>
	
	<div>
		{!! Form::label('role', 'To change current user type', ['class' => 'control-label']) !!} <br>
		<table style="justified text-align:center">
			<thead>
			<th width="80px"> Unchanged</th>
			<th width="80px"> User</th>
			<th width="80px"> Moderator</th>
			<th width="80px"> Admin</th>
			</thead>
			<tbody>
				<td>{{!! Form::radio('role', 'unchanged', true) !!}}</td>
				<td>{{!! Form::radio('role', 'user', false ) !!}}</td>
				<td>{{!! Form::radio('role', 'moderator', false) !!}}</td>
				<td>{{!! Form::radio('role', 'admin', false) !!}}</td>

			</tbody>

		</table>

	</div>
	
	
	
	
	<div class="form-group">
		<button id="formSubmitId" type="submit" class="btn btn-success" style="display:visible" >Submit</button>
    </div>
	{!! Form::close() !!}
</div>                
@stop

@section('script')
<script type="text/javascript" src="/js/index.js">
</script>

 <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@stop