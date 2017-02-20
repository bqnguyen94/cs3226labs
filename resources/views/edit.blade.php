@extends('template')
@section('main')
<div class="container-fluid">
    <p>
        <b>Update profile of <?php echo $student->name ?></b>
    </p>
    {!! Form::open(['files' => true]) !!}
    <div class="form-group">
        {!! Form::label('nick', 'Nick name:', ['class' => 'control-label']) !!}
        @if ($errors->first('nick'))
            {!! $errors->first('nick', '<br /><small class="error">:message</small>') !!}
        @endif
        {!! Form::text('nick', $student->nick, ['class' => 'form-control']) !!}

    </div>
    <div class="form-group">
        {!! Form::label('name', 'Full name:', ['class' => 'control-label']) !!}
        @if ($errors->first('name'))
            {!! $errors->first('name', '<br /><small class="error">:message</small>') !!}
        @endif
        {!! Form::text('name', $student->name, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('kattis', 'Kattis account:', ['class' => 'control-label']) !!}
        @if ($errors->first('kattis'))
            {!! $errors->first('kattis', '<br /><small class="error">:message</small>') !!}
        @endif
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon3">https://open.kattis.com/users/</span>
            {!! Form::text('kattis', $student->kattis, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
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
                        {!! Form::text('mc[]', $mcs[$i], ['class' => 'score-input form-control']) !!}
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
                        {!! Form::text('tc[]', $tcs[$i], ['class' => 'score-input form-control']) !!}
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
                        {!! Form::text('hw[]', $hws[$i], ['class' => 'score-input form-control']) !!}
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
                        {!! Form::text('pb[]', $pbs[$i], ['class' => 'score-input form-control']) !!}
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
                        {!! Form::text('ks[]', $kss[$i], ['class' => 'score-input form-control']) !!}
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
                        {!! Form::text('ac[]', $acs[$i], ['class' => 'score-input form-control']) !!}
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
