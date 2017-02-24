@extends('layouts.template')
@section('main')
<div class="container-fluid">
    <p>
        <b>Update profile of <?php echo $student->name ?></b>
    </p>
    {!! Form::open(['files' => true]) !!}
    <div class="row">
        <div class="form-group col-md-6 col-xs-6">
            {!! Form::label('nick', 'Nick name:', ['class' => 'control-label']) !!}
            @if ($errors->first('nick'))
                {!! $errors->first('nick', '<br /><small class="error">:message</small>') !!}
            @endif
            {!! Form::text('nick', $student->nick, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group col-md-6 col-xs-6">
            {!! Form::label('name', 'Full name:', ['class' => 'control-label']) !!}
            @if ($errors->first('name'))
                {!! $errors->first('name', '<br /><small class="error">:message</small>') !!}
            @endif
            {!! Form::text('name', $student->name, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6 col-xs-6">
            {!! Form::label('kattis', 'Kattis account:', ['class' => 'control-label']) !!}
            @if ($errors->first('kattis'))
                {!! $errors->first('kattis', '<br /><small class="error">:message</small>') !!}
            @endif
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon3">https://open.kattis.com/users/</span>
                {!! Form::text('kattis', $student->kattis, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group col-md-6 col-xs-6">
            {!! Form::label('country', 'Nationality:', ['class' => 'control-label']) !!}
            @if ($errors->first('country'))
                {!! $errors->first('country', '<br /><small class="error">:message</small>') !!}
            @endif
            <br />
            {!! Form::select('country', [
                'SG' => 'SGP - Singaporean',
                'CN' => 'CHN - Chinese',
                'VN' => 'VNM - Vietnamese',
                'ID' => 'IDN - Indonesia',
                'OT' => 'Other Nationality'
                ],
                $student->country_iso2,
                ['class' => 'form-control dropdown']) !!}
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th width="100px">Component</th>
                <th width="50px">Sum</th>
                <th width="20px" width="100px" style="text-align: center">01</th>
                <th width="20px" width="100px" style="text-align: center">02</th>
                <th width="20px" width="100px" style="text-align: center">03</th>
                <th width="20px" width="100px" style="text-align: center">04</th>
                <th width="20px" width="100px" style="text-align: center">05</th>
                <th width="20px" width="100px" style="text-align: center">06</th>
                <th width="20px" width="100px" style="text-align: center">07</th>
                <th width="20px" width="100px" style="text-align: center">08</th>
                <th width="20px" width="100px" style="text-align: center">09</th>
                <th width="20px" width="100px" style="text-align: center">10</th>
                <th width="20px" width="100px" style="text-align: center">11</th>
                <th width="20px" width="100px" style="text-align: center">12</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Mini Contests</td>
                <td></td>
                <div class="form-group">
                    <?php
                    $mcs = explode(",", $score["mc"]);
                    for ($i = 0; $i < count($mcs); $i++) {
                    ?>
                    <td>
                        <input required="required" class="score-input form-control" name="mc[]" type="text" pattern="(^(?!0$)[0-3](?:[,.][05])?$)|x.y|4|4.0" value="<?php echo $mcs[$i] ?>">
                    </td>
                    <?php
                    }
                    ?>
                </div>
            </tr>
            <tr>
                <td>Team Contests</td>
                <td></td>
                <div class="form-group">
                    <?php
                    $tcs = explode(",", $score["tc"]);
                    for ($i = 0; $i < count($tcs); $i++) {
                    ?>
                    <td>
                        <input required="required" class="score-input form-control" name="tc[]" type="text" pattern="(^(?!$)[0-3](?:[,.][05])?$)|x.y|4|4.0" value="<?php echo $tcs[$i] ?>">
                    </td>
                    <?php
                    }
                    ?>
                </div>
            </tr>
            <tr>
                <td>Homework</td>
                <td></td>
                <div class="form-group">
                    <?php
                    $hws = explode(",", $score["hw"]);
                    for ($i = 0; $i < count($hws); $i++) {
                    ?>
                    <td>
                        <input required="required" class="score-input form-control" name="hw[]" type="text" pattern="(^(?!$)[0-3](?:[,.][05])?$)|x.y|4|4.0" value="<?php echo $hws[$i] ?>">
                    </td>
                    <?php
                    }
                    ?>
                </div>
            </tr>
            <tr>
                <td>Problem Bs</td>
                <td></td>
                <div class="form-group">
                    <?php
                    $pbs = explode(",", $score["pb"]);
                    for ($i = 0; $i < count($pbs); $i++) {
                    ?>
                    <td>
                        <input required="required" class="score-input form-control" name="pb[]" type="text" pattern="(^(?!$)[0-4]?$)|x" value="<?php echo $pbs[$i] ?>">
                    </td>
                    <?php
                    }
                    ?>
                </div>
            </tr>
            <tr>
                <td>Kattis Sets</td>
                <td></td>
                <div class="form-group">
                    <?php
                    $kss = explode(",", $score["ks"]);
                    for ($i = 0; $i < count($kss); $i++) {
                    ?>
                    <td>
                        <input required="required" class="score-input form-control" name="ks[]" type="text" pattern="(^(?!$)[0-4]?$)|x" value="<?php echo $kss[$i] ?>">
                    </td>
                    <?php
                    }
                    ?>
                </div>
            </tr>
            <tr>
                <td>Achievements</td>
                <td></td>
                <div class="form-group">
                    <?php
                    $acs = explode(",", $score["ac"]);
                    for ($i = 0; $i < count($acs); $i++) {
                    ?>
                    <td>
                        <input required="required" class="score-input form-control" name="ac[]" type="text" pattern="(^(?!$)[0-4]?$)|x" value="<?php echo $acs[$i] ?>">
                    </td>
                    <?php
                    }
                    ?>
                </div>
            </tr>
        </tbody>
    </table>
    <br />
    <div class="form-group col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-success">Update</button>
    </div>
    {!! Form::close() !!}
</div>
@stop
