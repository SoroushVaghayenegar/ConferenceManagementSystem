@extends('layouts.app')

<script src="/js/d3.js"></script>
<script src="/js/d3.min.js"></script>



@section('title', 'Reports')



@section('content')

<script src="js/highcharts.js"></script>
<script src="js/highcharts-3d.js"></script>
<script src="js/exporting.js"></script>


<div class="row">
        <div class="col-lg-12">
          <h3 class="page-header"><i class="icon_piechart"></i> Reports</h3>
        </div>
</div>

<div class="wrapper">
    
</div>


<script type="text/javascript">

genderData = [
                ['Men', 45.0],
                ['Women', 26.8],
            ]

$(function () {
    $('#').highcharts({
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
        },
        title: {
            text: 'Browser market shares at a specific website, 2014'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Browser share',
            data: genderData
        }]
    });
});


</script>

@endsection