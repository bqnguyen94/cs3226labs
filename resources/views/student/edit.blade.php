@extends('layouts.template')

@section('link')
<link media="all" rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.6/css/fileinput.min.css">
@stop

@section('main')
<div class="container-fluid">
    <p>
        <b>Update profile of <?php echo $student->name ?></b>
    </p>
    {!! Form::open(['files' => true, 'data-toggle' => 'validator']) !!}
    <div class="row">
        <div class="col-sm-6 col-xs-12">
            <div class="form-group has-feedback">
                {!! Form::label('nick', 'Nick name:', ['class' => 'control-label']) !!}
                <input type="text" class="form-control" name="nick" value="<?php echo $student->nick ?>" data-minlength="4" maxlength="30" data-minlength-error="Your nick name really that short meh?!" required>
                <span class="hidden-xs glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if ($errors->first('nick'))
                    {!! $errors->first('nick', '<br /><small class="error">:message</small>') !!}
                @endif
            </div>
        </div>
        <div class="col-sm-6 col-xs-12">
            <div class="form-group has-feedback">
                {!! Form::label('name', 'Full name:', ['class' => 'control-label']) !!}
                <input type="text" class="form-control" name="name" value="<?php echo $student->name ?>" data-minlength="4" maxlength="30" data-minlength-error="Your name really that short meh?!" required>
                <span class="hidden-xs glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if ($errors->first('name'))
                    {!! $errors->first('name', '<br /><small class="error">:message</small>') !!}
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 col-xs-12">
            <div class="form-group has-feedback">
                {!! Form::label('kattis', 'Kattis account:', ['class' => 'control-label']) !!}
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon3">https://open.kattis.com/users/</span>
                    <input type="text" class="form-control" name="kattis" value="<?php echo $student->kattis ?>" data-minlength="4" maxlength="30" data-minlength-error="Your kattis account name really that short meh?!" required>
                </div>
                <span class="hidden-xs glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if ($errors->first('kattis'))
                    {!! $errors->first('kattis', '<br /><small class="error">:message</small>') !!}
                @endif
            </div>
        </div>
        <div class="col-sm-6 col-xs-12">
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
                    $student->country_iso2,
                    [
                    'class' => 'form-control dropdown',
                    'required' => 'required',
                    ])
                !!}
                <span class="hidden-xs glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if ($errors->first('country'))
                    {!! $errors->first('country', '<br /><small class="error">:message</small>') !!}
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-sm-6 col-xs-12">
            <label class="control-label">Upload a profile picture</label>
            <input name='image' id="input-1" type="file" class="file">
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th width="100px">Component</th>
                <th width="50px" class="hidden-xs">Sum</th>
                <th style="text-align: center">01</th>
                <th style="text-align: center">02</th>
                <th style="text-align: center">03</th>
                <th style="text-align: center">04</th>
                <th style="text-align: center">05</th>
                <th style="text-align: center">06</th>
                <th style="text-align: center">07</th>
                <th style="text-align: center">08</th>
                <th style="text-align: center">09</th>
                <th style="text-align: center">10</th>
                <th style="text-align: center">11</th>
                <th style="text-align: center">12</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Mini Contests</td>
                <td id="sum-mc" class="hidden-xs"></td>
                <?php
                $mcs = explode(",", $score["mc"]);
                for ($i = 0; $i < count($mcs); $i++) {
                ?>
                <td>
                    <div class="form-group has-feedback">
                        <input required="required" class="score-input form-control" name="mc[]" type="text" pattern="(^(?!0$)[0-3](?:[,.][05])?$)|x.y|4|4.0" value="<?php echo $mcs[$i] ?>">
                        <span class="hidden-xs glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                </td>
                <?php
                }
                ?>
            </tr>
            <tr>
                <td>Team Contests</td>
                <td id="sum-tc" class="hidden-xs"></td>
                <?php
                $tcs = explode(",", $score["tc"]);
                for ($i = 0; $i < count($tcs); $i++) {
                ?>
                <td>
                    <div class="form-group has-feedback">
                        <input required="required" class="score-input form-control" name="tc[]" type="text" pattern="(^(?!$)[0-3](?:[,.][05])?$)|x.y|4|4.0" value="<?php echo $tcs[$i] ?>">
                        <span class="hidden-xs glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                </td>
                <?php
                }
                ?>
            </tr>
            <tr>
                <td>Homework</td>
                <td id="sum-hw" class="hidden-xs"></td>
                <?php
                $hws = explode(",", $score["hw"]);
                for ($i = 0; $i < count($hws); $i++) {
                ?>
                <td>
                    <div class="form-group has-feedback">
                        <input required="required" class="score-input form-control" name="hw[]" type="text" pattern="(^(?!$)[0-3](?:[,.][05])?$)|x.y|4|4.0" value="<?php echo $hws[$i] ?>">
                        <span class="hidden-xs glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                </td>
                <?php
                }
                ?>
            </tr>
            <tr>
                <td>Problem Bs</td>
                <td id="sum-pb" class="hidden-xs"></td>
                <?php
                $pbs = explode(",", $score["pb"]);
                for ($i = 0; $i < count($pbs); $i++) {
                ?>
                <td>
                    <div class="form-group has-feedback">
                        <input required="required" class="score-input form-control" name="pb[]" type="text" pattern="(^(?!$)[0-4]?$)|x" value="<?php echo $pbs[$i] ?>">
                        <span class="hidden-xs glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                </td>
                <?php
                }
                ?>
            </tr>
            <tr>
                <td>Kattis Sets</td>
                <td id="sum-ks" class="hidden-xs"></td>
                <?php
                $kss = explode(",", $score["ks"]);
                for ($i = 0; $i < count($kss); $i++) {
                ?>
                <td>
                    <div class="form-group has-feedback">
                        <input required="required" class="score-input form-control" name="ks[]" type="text" pattern="(^(?!$)[0-4]?$)|x" value="<?php echo $kss[$i] ?>">
                        <span class="hidden-xs glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                </td>
                <?php
                }
                ?>
            </tr>

            <tr>
                <td>Sub Total</td>
                <td id="sum"></td>
            </tr>
        </tbody>
    </table>

    <div id="achievement-panel">
        <p>
            <b>Achievements</b>
        </p>
        <?php
        $count = 0;
        foreach ($achievements as $achievement) {
            $count++;
        ?>
        <div class="form-group removeclass<?php echo $count ?>">
        <div class="row achievement-row">
            <div class="col-sm-3 nopadding">
                <div class="form-group has-feedback">
                    <div class="input-group">
                        <div class="input-group-btn">
                            <button class="btn btn-danger" type="button"  onclick="remove_ac_fields(<?php echo $count ?>);"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button>
                        </div>
                        <select class="form-control dropdown" id="ac_type" name="ac_types[]" required>
                            <option value="">Achievement</option>
                            <?php
                            foreach ($allAchievements as $allAchievement) {
                                if ($allAchievement->id == $achievement->achievement_id) {
                            ?>
                                    <option selected="selected" value="<?php echo $allAchievement->id ?>"><?php echo $allAchievement->achievement_name ?></option>
                            <?php
                                } else {
                            ?>
                                    <option value="<?php echo $allAchievement->id ?>"><?php echo $allAchievement->achievement_name ?></option>
                            <?php
                                }
                            ?>

                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-sm-2 nopadding">
                <div class="form-group has-feedback">
                    <select class="form-control dropdown" id="ac_week" name="ac_weeks[]" required>
                        <option selected="selected" value="">Week</option>
                        <?php
                        for ($i = 1; $i <= 8; $i++) {
                            if ($i == $achievement->week) {
                        ?>
                                <option selected="selected" value="<?php echo $i ?>"><?php echo $i ?></option>
                        <?php
                            } else {
                        ?>
                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                        <?php
                            }
                        ?>

                        <?php
                        }
                        ?>
                    </select>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-sm-7 nopadding">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" id="ac_reason" name="ac_reasons[]" value="<?php echo $achievement->reason ?>" placeholder="Reason" maxlength="30" required>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
        </div>
        </div>
        <?php
        }
        ?>
    </div>

    <button class="btn btn-success" type="button"  onclick="add_ac_fields();"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </button>
    <br />
    <div class="form-group col-xs-12 col-sm-12 col-md-12 text-center">
        <button id="btn-submit" type="submit" class="btn btn-success">Update</button>
    </div>
    {!! Form::close() !!}
</div>
@stop

@section('script')
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/javascript-canvas-to-blob/3.6.0/js/canvas-to-blob.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.6/js/fileinput.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
<script type="text/javascript" charset="utf8" src="/js/edit.js"></script>
<script>
    var ac = <?php echo count($achievements) ?>
</script>
@stop
