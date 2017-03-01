@extends('layouts.template')

@section('link')
<link media="all" rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.6/css/fileinput.min.css">
@stop

@section('main')
<div class="container-fluid">
    <p>
        <b>Create New Student in CS3233 S2 AY 2016/17</b>
    </p>
    {!! Form::open(['files' => true, 'data-toggle' => 'validator']) !!}
    <div class="row">
        <div class=" col-md-6 col-xs-6">
            <div class="form-group has-feedback">
                {!! Form::label('nick', 'Nick name:', ['class' => 'control-label']) !!}
                <input type="text" class="form-control" name="nick" data-minlength="4" maxlength="30" data-minlength-error="Your nick name really that short meh?!" required>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if ($errors->first('nick'))
                    {!! $errors->first('nick', '<br /><small class="error">:message</small>') !!}
                @endif
            </div>
        </div>
        <div class=" col-md-6 col-xs-6">
            <div class="form-group has-feedback">
                {!! Form::label('name', 'Full name:', ['class' => 'control-label']) !!}
                <input type="text" class="form-control" name="name" data-minlength="4" maxlength="30" data-minlength-error="Your name really that short meh?!" required>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if ($errors->first('name'))
                    {!! $errors->first('name', '<br /><small class="error">:message</small>') !!}
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class=" col-md-6 col-xs-6">
            <div class="form-group has-feedback">
                {!! Form::label('kattis', 'Kattis account:', ['class' => 'control-label']) !!}
                <div class="input-group">
                    <span class="hidden-xs input-group-addon" id="basic-addon3">https://open.kattis.com/users/</span>
                    <input type="text" class="form-control" name="kattis" data-minlength="4" maxlength="30" data-minlength-error="Your kattis account name really that short meh?!" required>
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if ($errors->first('kattis'))
                    {!! $errors->first('kattis', '<br /><small class="error">:message</small>') !!}
                @endif
            </div>
        </div>
        <div class=" col-md-6 col-xs-6">
            <div class="form-group has-feedback">
                {!! Form::label('country', 'Nationality:', ['class' => 'control-label']) !!}
                <br />
                {!! Form::select('country', [
                    'SG' => 'SGP - Singaporean',
                    'CN' => 'CHN - Chinese',
                    'VN' => 'VNM - Vietnamese',
                    'ID' => 'IDN - Indonesia',
                    'OT' => 'Other Nationality'
                    ],
                    null,
                    [
                    'placeholder' => 'Select Nationality',
                    'class' => 'form-control dropdown',
                    'required' => 'required',
                    ])
                !!}
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if ($errors->first('country'))
                    {!! $errors->first('country', '<br /><small class="error">:message</small>') !!}
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6 col-xs-6">
            <label class="control-label">Upload a profile picture</label>
            <input name='image' id="input-1" type="file" class="file">
        </div>
    </div>
    <br/>
    <div class="form-group col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-success">Submit</button>
    </div>
    {!! Form::close() !!}
</div>
@stop

@section('script')
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/javascript-canvas-to-blob/3.6.0/js/canvas-to-blob.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.6/js/fileinput.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
@stop
