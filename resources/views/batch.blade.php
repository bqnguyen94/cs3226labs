@extends('template')
@section('main')
<div class="container-fluid">
    <h2 style="text-align: center">
        Batch Mode
    </h2>
    <br />
    {!! Form::open() !!}
    <div class="row">
        <div class="form-group col-lg-2 col-md-3 col-lg-offset-4 col-xs-6 col-md-offset-3">
            {!! Form::label('category', 'Category:', ['class' => 'control-label']) !!}
            @if ($errors->first('category'))
                {!! $errors->first('category', '<br /><small class="error">:message</small>') !!}
            @endif
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
        </div>
        <div class="form-group col-lg-2 col-md-3 col-xs-6">
            {!! Form::label('week', 'Week:', ['class' => 'control-label']) !!}
            @if ($errors->first('week'))
                {!! $errors->first('week', '<br /><small class="error">:message</small>') !!}
            @endif
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
        </div>
    </div>
    <div class="col-md-6 col-lg-4 col-md-offset-3 col-lg-offset-4">
        <table class="table">
            <thead>
                <tr>
                    <th class="col-md-5" style="text-align: center">Student</th>
                    <th class="col-md-2" style="text-align: center">Score</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < count($students); $i++) {
                    $student = $students[$i];
                ?>
                <tr>
                    <td><?php echo $student->name ?></td>
                    <td style="text-align: center">{!! Form::text('scores[]', null, ['required' => 'required', 'class' => 'score-input form-control']) !!}</td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="form-group col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-success">Add Score</button>
    </div>
    {!! Form::close() !!}


</div>
@stop
@section('script')
<script type="text/javascript" src="/js/batch.js"></script>
@stop