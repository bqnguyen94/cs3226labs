@extends('layouts.template') <!-- use template from previous slide -->
@section('main') <!-- define a section called main -->

<div class="alert alert-info"> Updating in progress...</div>
<div class="container-fluid">
	{!! Form::open() !!}
	{!! Form::label('username', 'Enter the user name', ['class' => 'control-label']) !!}
	{!! Form::text('username', 'null', ['class' => 'control-label']) !!}
	{!! Form::label('email', 'To update email address', ['class' => 'control-label']) !!}
	{!! Form::text('email', null, ['class' => 'form-control']) !!}
	{!! Form::label('password', 'Enter password', ['class' => 'control-label']) !!}
	{!! Form::text('password', null, ['class' => 'form-control']) !!}
	
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