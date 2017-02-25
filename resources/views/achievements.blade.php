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
                <tr>
                    <td>

                    </td>
                </tr>
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
@stop
