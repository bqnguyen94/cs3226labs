@extends('layouts.template')
@section('main')
<div class="container-fluid">
    <h2 style="text-align: center">
        Achievements
    </h2>
    <br />
    <div class="row">
        <div class="form-group col-lg-4 col-md-6 col-lg-offset-4 col-xs-8 col-md-offset-3 col-xs-offset-2">
            <select class="form-control dropdown" id="achievement">
                <option selected="selected" value="">Achievement</option>
                <?php
                foreach ($data["achievements"] as $achievement) {
                ?>
                <option value="<?php echo $achievement["id"] ?>"><?php echo $achievement["name"] ?></option>
                <?php
                }
                ?>
            </select>
        </div>
    </div>
    <div id="student-list-panel" class=" col-lg-4 col-md-6 col-lg-offset-4 col-xs-8 col-md-offset-3 col-xs-offset-2">
        <table class="table">
            <thead>
                <tr>
                    <th class="col-md-5" style="text-align: center">Student</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    </div>
</div>
@stop
@section('script')
<script type="text/javascript">
    var data = <?php echo json_encode($data) ?>;
</script>
<script type="text/javascript" src="/js/achievements.js"></script>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-92961727-1', 'auto');
    ga('send', 'pageview');

</script>
@stop
