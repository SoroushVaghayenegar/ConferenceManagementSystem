@extends('layouts.app')

<script src="/js/d3.js"></script>
<script src="/js/d3.min.js"></script>



@section('title', 'Reports')



@section('content')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>


<div class="row">
        <div class="col-lg-12">
          <h3 class="page-header"><i class="icon_piechart"></i> Reports</h3>
        </div>
</div>

<div class="container">
    <div class="panel panel-dark" >
        <ul class="nav nav-tabs nav-justified">
            <li class="active"><a data-toggle="tab" href="#currentConferences"><strong>Current Conferences</strong></a></li>
            <li><a data-toggle="tab" href="#pastConferences"><strong>Past Conferences</strong></a></li>
        </ul>
        
        <div class="tab-content">
            <div id="currentConferences" class="tab-pane fade in active">
                <div class="panel-body">
                <h3 style="color:#ff4d4d">Choose conference:</h3>
                    <strong>
                        <select class="form-control" style="background-color: #006bb3; color:#d9d9d9">
                            @if (count($current_conferences) > 0)
                                @foreach ($current_conferences as $current_conference)
                                    <option value="{{$current_conference->id}}">{{$current_conference->name}}</option>
                                @endforeach
                            @else
                                <option>No conferences available!</option>
                            @endif

                        </select>
                    </strong>
                    <br/>
                    <div class="current-graph"></div>
                </div>
            </div>
            <div id="pastConferences" class="tab-pane fade">
                <div class="panel-body">
                    <h3 style="color:#ff4d4d">Choose conference:</h3>
                    <button id="alo">aasdasd</button>
                    <strong>
                        <select class="form-control" style="background-color: #006bb3; color:#d9d9d9">
                            @if (count($past_conferences) > 0)
                                @foreach ($past_conferences as $past_conference)
                                    <option>{{$past_conference->name}}</option>
                                @endforeach
                            @else
                                <option>No conferences available!</option>
                            @endif

                        </select>
                    </strong>
                    <br/>
                    <div class="past-graph"></div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">



if(window.screen.availWidth > 640)
    var size = '20px'
else
    var size = '100%'

$(function () {
    $('.current-graph').highcharts({
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
        },
        title: {
            text: 'Gender PieChart'
        },
        tooltip: {
            pointFormat: 'Percentage: <b>{point.percentage:.1f}%</b> <br/>Number: <b>{point.y}</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: true,
                    format: '{point.name} <b>{point.percentage:.1f}%</b> ',
                    style:{
                        fontSize: size
                    }
                   
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Gender',
            data: [
                ['Men', 50],
                ['Women', 50]
            ]
        }]
    });
});

$(function () {
    $('.past-graph').highcharts({
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
        },
        title: {
            text: 'Gender PieChart'
        },
        tooltip: {
            pointFormat: 'Percentage: <b>{point.percentage:.1f}%</b> <br/>Number: <b>{point.y}</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: true,
                    format: '{point.name} <b>{point.percentage:.1f}%</b> ',
                    style:{
                        fontSize: size
                    }
                   
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Gender',
            data: [
                ['Men', 45.0],
                ['Women', 118.5]
            ]
        }]
    });

    
});

/**
 * Dark theme for Highcharts JS
 * 
 */

// Load the fonts
Highcharts.createElement('link', {
   href: '//fonts.googleapis.com/css?family=Unica+One',
   rel: 'stylesheet',
   type: 'text/css'
}, null, document.getElementsByTagName('head')[0]);

Highcharts.theme = {
   colors: ["#0099ff", "#ff66cc", "#f45b5b", "#7798BF", "#aaeeee", "#ff0066", "#eeaaee",
      "#55BF3B", "#DF5353", "#7798BF", "#aaeeee"],
   chart: {
      backgroundColor: {
         linearGradient: { x1: 0, y1: 0, x2: 1, y2: 1 },
         stops: [
            [0, '#303136'],
            [1, '#303136']
         ]
      },
      style: {
         fontFamily: "'Unica One', sans-serif",
      },
      plotBorderColor: '#606063'
   },
   title: {
      style: {
         color: '#E0E0E3',
         textTransform: 'uppercase',
         fontSize: '30px'
      }
   },
   subtitle: {
      style: {
         color: '#E0E0E3',
         textTransform: 'uppercase',
      }
   },
   xAxis: {
      gridLineColor: '#707073',
      labels: {
         style: {
            color: '#E0E0E3',

         }
      },
      lineColor: '#707073',
      minorGridLineColor: '#505053',
      tickColor: '#707073',
      title: {
         style: {
            color: '#A0A0A3',


         }
      }
   },
   yAxis: {
      gridLineColor: '#707073',
      labels: {
         style: {
            color: '#E0E0E3',

         }
      },
      lineColor: '#707073',
      minorGridLineColor: '#505053',
      tickColor: '#707073',
      tickWidth: 1,
      title: {
         style: {
            color: '#A0A0A3',
         }
      }
   },
   tooltip: {
      backgroundColor: 'rgba(0, 0, 0, 0.85)',
      style: {
         color: '#F0F0F0',

      }
   },
   plotOptions: {
      series: {
         dataLabels: {
            color: '#B0B0B3'

         },
         marker: {
            lineColor: '#333'
         }
      },
      boxplot: {
         fillColor: '#505053'
      },
      candlestick: {
         lineColor: 'white'
      },
      errorbar: {
         color: 'white'
      }
   },
   legend: {
      itemStyle: {
         color: '#E0E0E3'
      },
      itemHoverStyle: {
         color: '#FFF'
      },
      itemHiddenStyle: {
         color: '#606063'
      }
   },
   credits: {
      style: {
         color: '#666',

      }
   },
   labels: {
      style: {
         color: '#707073'
      }
   },

   drilldown: {
      activeAxisLabelStyle: {
         color: '#F0F0F3'
      },
      activeDataLabelStyle: {
         color: '#F0F0F3'
      }
   },

   navigation: {
      buttonOptions: {
         symbolStroke: '#DDDDDD',
         theme: {
            fill: '#505053'
         }
      }
   },

   // scroll charts
   rangeSelector: {
      buttonTheme: {
         fill: '#505053',
         stroke: '#000000',
         style: {
            color: '#CCC'
         },
         states: {
            hover: {
               fill: '#707073',
               stroke: '#000000',
               style: {
                  color: 'white'
               }
            },
            select: {
               fill: '#000003',
               stroke: '#000000',
               style: {
                  color: 'white'
               }
            }
         }
      },
      inputBoxBorderColor: '#505053',
      inputStyle: {
         backgroundColor: '#333',
         color: 'silver'
      },
      labelStyle: {
         color: 'silver'
      }
   },

   navigator: {
      handles: {
         backgroundColor: '#666',
         borderColor: '#AAA'
      },
      outlineColor: '#CCC',
      maskFill: 'rgba(255,255,255,0.1)',
      series: {
         color: '#7798BF',
         lineColor: '#A6C7ED'
      },
      xAxis: {
         gridLineColor: '#505053'
      }
   },

   scrollbar: {
      barBackgroundColor: '#808083',
      barBorderColor: '#808083',
      buttonArrowColor: '#CCC',
      buttonBackgroundColor: '#606063',
      buttonBorderColor: '#606063',
      rifleColor: '#FFF',
      trackBackgroundColor: '#404043',
      trackBorderColor: '#404043'
   },

   // special colors for some of the
   legendBackgroundColor: 'rgba(0, 0, 0, 0.5)',
   background2: '#505053',
   dataLabelsColor: '#B0B0B3',
   textColor: '#C0C0C0',
   contrastTextColor: '#F0F0F3',
   maskColor: 'rgba(255,255,255,0.3)'
};

// Apply the theme
Highcharts.setOptions(Highcharts.theme);
</script>

@endsection