@extends('layouts.template')
@section('main')
<div class="container-fluid">
    <div id="chart" style='width: 100%; height: 1000px'></div>
    <div id="chartfilter"></div>
</div>

@stop
@section('script')
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
    var json = <?php echo json_encode($data); ?>;
</script>
<script type="text/javascript" src="/js/multiseries-chart.js"></script>
@stop
