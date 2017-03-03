@extends('layouts.template')
@section('main')
    <div class="container-fluid">

        <div class="row">
            <div class="col-xs-12 col-sm-9">

                <div class=" col-xs-12 mx-auto row" style="height:100px">
                    <?php
                    $flag_cdn = "/img/flag_default.jpg";
                    if ($student->country_iso2 !== "OT") {
                        $flag_cdn = "https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/2.8.0/flags/4x3/" . strtolower($student->country_iso2) . ".svg";
                    }
                    ?>

                    <h1><b style="float:left"><?php echo $student->name?>　</b>
                        <img padding="10px" style="float:left" class="img-rounded nation" src="<?php echo $flag_cdn ?>"
                             height="34px"></h1>
                </div>

                <div class="col-xs-12 ">
                    <p><span class="glyphicon glyphicon-user"></span> Kattis account: <a href="#" target="_blank"><b><?php echo $student->kattis ?></b></a><br>
                    <p><span class="glyphicon glyphicon-star"></span> Achievement details: </p>

                    <ol>
                        <?php
                        foreach ($achievements as $achievement) {
                            $name = $allAchievements->where('id', $achievement->achievement_id)->first()->achievement_name;
                            $max = $allAchievements->where('id', $achievement->achievement_id)->first()->max_stars;
                            if ($max != 1) {

                        ?>
                                <li><?php echo $name . " " . $achievement->cnt . "/" . $max ?></li>
                        <?php
                            } else {
                        ?>
                                <li><?php echo $name ?></li>
                        <?php
                            }
                        ?>
                        <?php
                        }
                        ?>
                    </ol>

                    <p><span class="glyphicon glyphicon-comment"></span> Specific (public) comments about this student:
                    </p>

                    </p>
                </div>

            </div>

            <div class="hidden-xs  col-sm-3" style="height:200px">
                <div style="height:20px"></div>
                <div>
                    <img class="img-circle student-avatar" src="<?php echo $student->image ?>" height="130px"
                         width="130px"></div>
            </div>

        </div>

        <div class="row" style="height:50px">

        </div>

        <div class="col-xs-12 col-md-offset-4 col-md-4">
            <ul class=" nav nav-tabs nav-justified" style="height:80px" role="tablist">
                <li role="presentation" class=" active" role="presentation"><a href="#scoretable" aria-controls="1" role="tab" data-toggle="tab">Detailed Score</a></li>
                <li role="presentation"><a href="#chart" aria-controls="2" role="tab" data-toggle="tab">Graphicalized Performance</a></li>
            </ul>
        </div>

        <!-- Tab panes -->
        <div class="col-xs-12">

            <?php
            $spe = array_sum($scores["mc"]) + array_sum($scores["tc"]);
            $dil = array_sum($scores["hw"]) + array_sum($scores["pb"]) + array_sum($scores["ks"]) + array_sum($scores["ac"]);
            $sum = $spe + $dil;
            ?>

            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active fade in" id="scoretable">
                    <table class="table table-condensed">
                        <thead>
                        <tr>
                            <th width="70px"></th>
                            <th width="150px">Component</th>
                            <th width="100px">Sum</th>
                            <th class="hidden-xs hidden-sm">01</th>
                            <th class="hidden-xs hidden-sm">02</th>
                            <th class="hidden-xs hidden-sm">03</th>
                            <th class="hidden-xs hidden-sm">04</th>
                            <th class="hidden-xs hidden-sm">05</th>
                            <th class="hidden-xs hidden-sm">06</th>
                            <th class="hidden-xs hidden-sm">07</th>
                            <th class="hidden-xs hidden-sm">08</th>
                            <th class="hidden-xs hidden-sm">09</th>
                            <th class="hidden-xs hidden-sm">10</th>
                            <th class="hidden-xs hidden-sm">11</th>
                            <th class="hidden-xs hidden-sm">12</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                        <?php
                        $keymap = [
                            'mc' => "Mini Contests",
                            'tc' => 'Team Contests',
                            'hw' => 'Homework',
                            'pb' => 'Problem Bs',
                            'ks' => 'Kattis Sets',
                            'ac' => 'Achievements',
                        ];

                        $keys = array_keys($scores);
                        foreach ($keys as $key) {
                        ?>
                        <tr>
                            <?php
                            if($key == "mc") {
                            ?>
                                <td style="vertical-align:middle" rowspan="2"><b>SPE<br> <?php echo $spe ?></b></td>
                            <?php
                            }
                            if($key == "hw") {
                            ?>
                                <td style="vertical-align:middle" rowspan="4"><b>DIL<br><?php echo $dil?> </b></td>
                            <?php
                            }
                            ?>

                            <td><?php echo $keymap[$key] ?></td>
                            <?php
                            if ($key == "mc" || $key == "tc" || $key == "hw") {
                            ?>
                                <td><?php echo sprintf("%.1f", array_sum($scores[$key])) ?></td>
                            <?php
                            } else {
                            ?>
                                <td><?php echo array_sum($scores[$key]) ?></td>
                            <?php
                            }
                            for ($i = 0; $i < count($scores[$key]); $i++) {
                                if (is_numeric($scores[$key][$i])) {
                                    if ($key == "mc" || $key == "tc" || $key == "hw") {
                            ?>
                                        <td class="hidden-xs hidden-sm"><?php echo sprintf("%.1f", $scores[$key][$i]) ?></td>
                            <?php
                                    } else {
                            ?>
                                        <td class="hidden-xs hidden-sm"><?php echo $scores[$key][$i] ?></td>
                            <?php
                                    }
                                } else {
                            ?>
                                    <td class="hidden-xs hidden-sm empty"><?php echo $scores[$key][$i] ?></td>
                            <?php
                                }
                            ?>
                            <?php
                            }
                            ?>
                        </tr>
                        <?php
                        }
                        ?>
                        <tr>
                            <td colspan="2"><b>Sum</b></td>
                            <td><b> <?php echo $sum?> </b></td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div role="tabpanel" class="tab-pane fade col-xs-12 col-md-4 col-md-offset-4" id="chart">
                    <canvas role="tabpanel" class="tab-pane" id="myChart" style="background-color: white" width="200"
                            height="200"></canvas>
                </div>

                @if (Auth::check())
                    <div class="col-xs-12" style="height:50px;"></div>
                    @can('isAdmin', Auth::user())
                        {!! Form::open(['method' => 'DELETE', 'onsubmit' => 'return ConfirmDelete()']) !!}
                        <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-4 col-lg-offset-2">
                            {!! Form::hidden('id', $student->id) !!}
                            {!! Form::submit('Delete', ['class' => 'form-control btn-danger']) !!}
                        </div>
                        {!! Form::close() !!}
                        <a class="col-xs-6 col-sm-6 col-md-6 col-lg-4 btn btn-success"
                           href=<?php echo '"/student/' . $student->id . '/edit"' ?>>Update</a>
                    @endcan
                    @can('isModerator', Auth::user())
                        <a class="col-md-8 col-lg-4 col-md-offset-2 col-lg-offset-4 btn btn-success"
                           href=<?php echo '"/student/' . $student->id . '/edit"' ?>>Update</a>
                    @endcan
                @endif
            </div>
        </div>
    </div>
@stop

@section('script')
    <script>
        function ConfirmDelete() {
            var alert = confirm("Wipe this student out of the face of the Earth. Really?");
            if (alert) {
                return true;
            } else {
                return false;
            }
        }

        var studentName = "<?php echo $student->name ?>";
        var data = [
            <?php echo array_sum($scores["mc"]) ?>,
            <?php echo array_sum($scores["tc"]) ?>,
            <?php echo array_sum($scores["hw"]) ?>,
            <?php echo array_sum($scores["pb"]) ?>,
            <?php echo array_sum($scores["ks"]) ?>,
            <?php echo array_sum($scores["ac"]) ?>
        ];
        var topStudentName = "<?php echo $topStudent["name"] ?>";
        var topData = [
            <?php echo $topStudent["mc"] ?>,
            <?php echo $topStudent["tc"] ?>,
            <?php echo $topStudent["hw"] ?>,
            <?php echo $topStudent["pb"] ?>,
            <?php echo $topStudent["ks"] ?>,
            <?php echo $topStudent["ac"] ?>
        ];
    </script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.bundle.min.js"></script>
    <script type="text/javascript" src="/js/radarchart.js"></script>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-92961727-1', 'auto');
        ga('send', 'pageview');

    </script>
@stop
