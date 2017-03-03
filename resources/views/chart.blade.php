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
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-92961727-1', 'auto');
    ga('send', 'pageview');

</script>
@stop
