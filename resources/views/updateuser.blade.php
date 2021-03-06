@extends('layouts.template') <!-- use template from previous slide -->
@section('main') <!-- define a section called main -->
<div class="alert alert-info"><?php echo trans('lang.Updating in progress...'); ?></div>
<div class="container-fluid">
	{!! Form::open(['data-toggle' => 'validator']) !!}
	<div class="row">
	<div class=" col-sm-3 col-xs-12">
		<div class="form-group has-feedback">
			{!! Form::label('user_id', trans('lang.Select user'), ['class' => 'control-label']) !!}
			<br>
			<select class="form-control dropdown" id="user_id" name="user_id" required>
				<option value="">User</option>
				<?php
				foreach ($users as $user) {
				?>
				<option value="<?php echo $user->id ?>"><?php echo $user->name ?></option>
				<?php
				}
				?>
			</select>
			<span class="hidden-xs glyphicon form-control-feedback" aria-hidden="true"></span>
	        <div class="help-block with-errors"></div>
		</div>
	</div>
	<div class=" col-sm-6 col-xs-12">
		<div class="form-group has-feedback">
			{!! Form::label('user_email', trans('lang.Update email address'), ['class' => 'control-label']) !!}
			{!! Form::email('user_email', null, ['class' => 'form-control', 'required' => 'required']) !!}
			<span class="hidden-xs glyphicon form-control-feedback" aria-hidden="true"></span>
			<div class="help-block with-errors"></div>
		</div>
	</div>
	<div class=" col-sm-3 col-xs-12">
		<div class="form-group has-feedback">
			{!! Form::label('user_role', trans('lang.To change current user type'), ['class' => 'control-label']) !!} <br>
			<select class="form-control dropdown" id="user_role" name="user_role" required>
				<option value="">Role</option>
				<option value="1">
					User
				</option>
				<option value="3">
					Moderator
				</option>
				<option value="2">
					Administrator
				</option>
			</select>
			<span class="hidden-xs glyphicon form-control-feedback" aria-hidden="true"></span>
	        <div class="help-block with-errors"></div>
		</div>
	</div>
	</div>
	<br />
	<div class="form-group col-xs-12 col-sm-12 col-md-12 text-center">
		<button id="formSubmitId" type="submit" class="btn btn-success" style="display:visible" ><?php echo trans('lang.Submit'); ?></button>
    </div>
	{!! Form::close() !!}
</div>
@stop

@section('script')
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
<script>
	var userlist=<?php echo json_encode($users); ?>;
</script>
<script type="text/javascript" charset="utf8" src="/js/update.js"></script>

@stop
