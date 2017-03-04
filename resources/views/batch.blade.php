@extends('layouts.template')
@section('main')
<div class="container-fluid">
    <h2 style="text-align: center">
        Batch Mode
    </h2>
    <br />
    {!! Form::open(['data-toggle' => 'validator']) !!}
    <div class="row">
        <div class="form-group col-lg-2 col-md-3 col-lg-offset-4 col-xs-6 col-md-offset-3">
            {!! Form::label('category', trans('lang.Category:'), ['class' => 'control-label']) !!}
            <br />
            {!! Form::select('category', [
                'mc' => 'Mini Contests',
                'tc' => 'Team Contests',
                'hw' => 'Homework',
                'pb' => 'Problem Bs',
                'ks' => 'Kattis Sets'
                ],
                null,
                [
                'placeholder' => 'Choose a Category',
                'class' => 'form-control dropdown',
                'id' => 'choose-category'
                ])
            !!}
            @if ($errors->first('category'))
                {!! $errors->first('category', '<br /><small class="error">:message</small>') !!}
            @endif
        </div>
        <div class="form-group col-lg-2 col-md-3 col-xs-6">
            {!! Form::label('week', trans('lang.Week:'), ['class' => 'control-label']) !!}
            <br />
            {!! Form::select('week',
                [],
                null,
                [
                'placeholder' => 'Choose a category first lah!',
                'class' => 'form-control dropdown',
                'id' => 'choose-week'
                ])
            !!}
            @if ($errors->first('week'))
                {!! $errors->first('week', '<br /><small class="error">:message</small>') !!}
            @endif
        </div>
    </div>
    <div class="col-md-6 col-lg-4 col-md-offset-3 col-lg-offset-4">
        <table class="table">
            <thead>
                <tr>
                    <th class="col-md-5" style="text-align: center"><?php echo trans('lang.Student'); ?></th>
                    <th class="col-md-2" style="text-align: center"><?php echo trans('lang.Score'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < count($students); $i++) {
                    $student = $students[$i];
                ?>
                <tr>
                    <td><?php echo $student->name ?></td>
                    <td style="text-align: left;">
                        <div class="form-group has-feedback">
                            <input type="text" class="score-input form-control" name="scores[]" required disabled="disabled">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="form-group col-xs-12 col-sm-12 col-md-12 text-center">
        <button id="btn-submit" type="submit" class="btn btn-success"><?php echo trans('lang.Add Score'); ?></button>
    </div>
    {!! Form::close() !!}


</div>
@stop
@section('script')
<script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
<script type="text/javascript" src="/js/batch.js"></script>
@stop
