@extends('layouts.app')



@section('title', 'Reports')



@section('content')

<script src="/js/highcharts.js"></script>
<script src="/js/highcharts-3d.js"></script>


<div class="row">
        <div class="col-lg-12">
          <h3 class="page-header"><i class="icon_piechart"></i> Reports</h3>
        </div>
</div>

<div class="container">

  <a href="{{ URL::to('manage_conferences') }}" id="back" class="btn btn-backToC"><i class="fa fa-arrow-left"></i>  Go back to Conferences</a>

  <div class="panel panel-default">
    
@if(Auth::user()->is_admin)
    <div class="panel-body">
      
        <h3><strong>Choose Conference Type:</strong></h3> 

    
        <h4><label class="radio-inline"><input type="radio" name="type" value="current">Current Conferences</label>
        <label class="radio-inline"><input type="radio" name="type" value="past">Past Conferences</label></h4>
        <br/>
        <br/>

        <img id="loading" src="/img/loading.gif" style="display:none" align="middle">
          
        <div id="dropdown" class="row" style="display:none">

            <span class="h4 col-md-2">
              <strong>Select a conference</strong> 
            </span>
      
      

          
            <button type="button" class="btn btn-default" id="select_conference_button">Select </button>&nbsp; 
        

              <div class="col-md-6">
                <select class="form-control" id="conference_dropdown">
                  <option></option>
                </select>
              </div>
          
        </div>
      @endif


 @if($report != null )
 
  <div class="panel panel-default" >

    <h2 align='center' ><strong>{{$conference->name}}</strong></h2>
    <h2 align='right'>
    <button type="button" class="btn btn-print" id="print" >Print Report</button></h2>

    <ul class="nav nav-tabs nav-justified">
          @if(!$event_facilitator)
            <li class="active"><a data-toggle="tab" href="#chart"><strong>Conference Chart Report</strong></a></li>
          @endif
          @foreach($events as $key=>$event)
            @if($event_facilitator)
              @if($key == 0)
                <li class="active"><a data-toggle="tab" href="#{{$event->id}}"><strong>Event {{++$key}}: {{$event->name}}</strong></a></li>
              @else
                <li><a data-toggle="tab" href="#{{$event->id}}"><strong>Event {{++$key}}: {{$event->name}}</strong></a></li>
              @endif
            @endif
          @endforeach
          <li><a data-toggle="tab" href="#table"><strong>Table Report</strong></a></li>
        </ul>
        <div class="tab-content">
          @if(!$event_facilitator)
            <div id="chart" class="tab-pane fade in active">
              <div class="conference1">
              </div>
            </br>
              <div class="conference2" >
              </div>
            </div>
          @endif


          @foreach($events as $key=>$event)
            @if($event_facilitator)
              @if($key == 0)
                <div id="{{$event->id}}" class="tab-pane fade in active">
              @else
                <div id="{{$event->id}}" class="tab-pane fade">
              @endif
            @endif
              <div class="event{{$event->id}}">

              </div>

              <div class="event2{{$event->id}}">
              </div>
            </div>
          @endforeach

          <div id="table" class="tab-pane fade">
            <div class="panel-body">
              <table id="report_table" class="table table-bordered" border="1" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                          <th colspan="14" style="color:#4d4d4d"><h1><strong>Conference Report<strong></h1></th>
                          
                      </tr>
                      <tr>
                          <th colspan="7" style="border-right: thick solid gray">Male Count</th>
                          <th colspan="7">Female Count</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                        <td colspan="7" style="border-right: thick solid gray">{{$male_count}}</td>
                        <td colspan="7">{{$female_count}}</td>
                      </tr>
                  
                      
                      <tr>
                          <th colspan="14" style="color: #ff4d4d">Grouped By Age</th>
                      </tr>

                      <tr>
                        <th>0 - 10</th>
                        <th>10 - 20</th>
                        <th>20 - 30</th>
                        <th>30 - 40</th>
                        <th>40 - 50</th>
                        <th>50 - 60</th>
                        <th style="border-right: thick solid gray"> > 60</th>

                        <th>0 - 10</th>
                        <th>10 - 20</th>
                        <th>20 - 30</th>
                        <th>30 - 40</th>
                        <th>40 - 50</th>
                        <th>50 - 60</th>
                        <th> > 60</th>
                      </tr>
                      
                  
                      <tr>
                        <td>{{$younger_than_ten_male}}</td>
                        <td>{{$ten_to_twenty_male}}</td> 
                        <td>{{$twenty_to_thirty_male}}</td> 
                        <td>{{$thirty_to_forty_male}}</td>
                        <td>{{$forty_to_fifty_male}}</td>
                        <td>{{$fifty_to_sixty_male}}</td>
                        <td style="border-right: thick solid gray">{{$older_than_sixty_male}}</td>

                        <td>{{$younger_than_ten_female}}</td>
                        <td>{{$ten_to_twenty_female}}</td> 
                        <td>{{$twenty_to_thirty_female}}</td> 
                        <td>{{$thirty_to_forty_female}}</td>
                        <td>{{$forty_to_fifty_female}}</td>
                        <td>{{$fifty_to_sixty_female}}</td>
                        <td>{{$older_than_sixty_female}}</td>
                      </tr>

                      @foreach($events as $key=>$event)
                        <tr style="border-top: 10pt solid black">
                            <th colspan="14" style="color:#4d4d4d"><h1><strong>Event {{++$key}}: {{$event->name}} Report<strong></h1></th>
                            
                        </tr>
                        <tr>
                          <th colspan="7" style="border-right: thick solid gray">Male Count</th>
                          <th colspan="7">Female Count</th>
                      </tr>
                      <tr>
                        <td colspan="7" style="border-right: thick solid gray">{{$event->male_count}}</td>
                        <td colspan="7">{{$event->female_count}}</td>
                      </tr>
                  
                      
                      <tr>
                          <th colspan="14" style="color: #ff4d4d">Grouped By Age</th>
                      </tr>

                      <tr>
                        <th>0 - 10</th>
                        <th>10 - 20</th>
                        <th>20 - 30</th>
                        <th>30 - 40</th>
                        <th>40 - 50</th>
                        <th>50 - 60</th>
                        <th style="border-right: thick solid gray"> > 60</th>

                        <th>0 - 10</th>
                        <th>10 - 20</th>
                        <th>20 - 30</th>
                        <th>30 - 40</th>
                        <th>40 - 50</th>
                        <th>50 - 60</th>
                        <th> > 60</th>
                      </tr>
                      
                  
                      <tr>
                        <td>{{$event->younger_than_ten_male}}</td>
                        <td>{{$event->ten_to_twenty_male}}</td> 
                        <td>{{$event->twenty_to_thirty_male}}</td> 
                        <td>{{$event->thirty_to_forty_male}}</td>
                        <td>{{$event->forty_to_fifty_male}}</td>
                        <td>{{$event->fifty_to_sixty_male}}</td>
                        <td style="border-right: thick solid gray">{{$event->older_than_sixty_male}}</td>

                        <td>{{$event->younger_than_ten_female}}</td>
                        <td>{{$event->ten_to_twenty_female}}</td> 
                        <td>{{$event->twenty_to_thirty_female}}</td> 
                        <td>{{$event->thirty_to_forty_female}}</td>
                        <td>{{$event->forty_to_fifty_female}}</td>
                        <td>{{$event->fifty_to_sixty_female}}</td>
                        <td>{{$event->older_than_sixty_female}}</td>
                      </tr>
                      @endforeach
                  </tbody>
              </table>
          </div>
          </div>
        </div>
      </div>
    

  @endif
  
  </div>
</div>
  
    
</div>




<script type="text/javascript">

$(document).ready(function(){

  
  var oldURL = document.referrer.split("/").pop();
  if(oldURL == "manage_conferences")
    document.getElementById("back").style.visibility = "visible" ;
  
  @if(!Auth::user()->is_admin)
    document.getElementById("back").style.visibility = "visible" ;
  @endif

})


$("input[name='type']").change(function(){
    document.getElementById("loading").style.display = "block";
    $("#dropdown").fadeOut("fast");

    if ($(this).val() === 'current') {
      $.ajax({
            url: '/reports',
            type: 'GET',
            success: function(data){
              $("#conference_dropdown").empty();
              @foreach($current_conferences as $current_conferences)
              $("#conference_dropdown").append("<option value='{{$current_conferences->id}}'>{{$current_conferences->name}}</option>")
              @endforeach
            }
      });
            
    } else if ($(this).val() === 'past') {
      $.ajax({
            url: '/reports',
            type: 'GET',
            success: function(data){
              $("#conference_dropdown").empty();
              @foreach($past_conferences as $past_conferences)
              $("#conference_dropdown").append("<option value='{{$past_conferences->id}}'>{{$past_conferences->name}}</option>")
              @endforeach
            }
      });
    }
    document.getElementById("loading").style.display = "none";
    $("#dropdown").fadeIn("slow");
});

$("#select_conference_button").click(function(){
        
        window.location.href = '/reports/' + $('#conference_dropdown').val();
    });

function printData()
{
   var table=document.getElementById("table");

   var chart=document.getElementById("chart");
   newWin= window.open("");

   newWin.document.write('<h1 style="text-align: center"><strong>Conference Report</strong></h1>');
   newWin.document.write(chart.outerHTML);
   newWin.document.write('<br/> <br/>');
   @if($report != null )
     @foreach($events as $key=>$event)
      var ev{{$key}} = document.getElementById("{{$event->id}}");

      newWin.document.write('<h1 style="text-align: center"><strong>Event: {{$event->name}} Report</strong></h1>');
      newWin.document.write(ev{{$key}}.outerHTML);
      newWin.document.write('<br/> <br/>');
     @endforeach
  @endif 
   newWin.document.write('<h1 style="text-align: center"><strong>Table Report</strong></h1>');
   newWin.document.write(table.outerHTML);
   newWin.print();
   newWin.close();
}

$('#print').on('click',function(){
printData();
})



@if($report != null )

@foreach($events as $key=>$event)

$(function () {
    $('.event{{$event->id}}').highcharts({
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
        },
        title: {
            text: 'Gender Pie chart'
        },
        tooltip: {
            pointFormat: '{series.name} {point.name}: <b>{point.y}</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: true,
                    format: ' {point.name} <br/> <b>{point.percentage:.1f}%</b>'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Number of ',
            data: [
                ['Male', {{$event->male_count}}],
                ['Female', {{$event->female_count }}],
            ]
        }]
    });
});


                


$(function () {
    $('.event2{{$event->id}}').highcharts({
        chart: {
            type: 'column',
            options3d: {
                enabled: true,
                alpha: 15,
                beta: 15,
                viewDistance: 100,
                depth: 40
            }
        },

        title: {
            text: 'Number of Participants, grouped by Age'
        },

        xAxis: {
            categories: [' < 10', '10 - 20', '20 - 30', '30 - 40', '40 - 50', '50 - 60', '60 >']
        },

        yAxis: {
            allowDecimals: false,
            min: 0,
            title: {
                text: 'Number of Participants'
            }
        },

        tooltip: {
            headerFormat: '<b>{point.key}</b><br>',
            pointFormat: '<span style="color:{series.color}">\u25CF</span> {series.name}: {point.y} / {point.stackTotal}'
        },

        plotOptions: {
            column: {
                stacking: 'normal',
                depth: 40
            }
        },

        series: [{
            name: 'Male',
            data: [{{$event->younger_than_ten_male}},
                   {{$event->ten_to_twenty_male}},
                   {{$event->twenty_to_thirty_male }},
                   {{$event->thirty_to_forty_male }},
                   {{$event->forty_to_fifty_male }},
                   {{$event->fifty_to_sixty_male }},
                   {{$event->older_than_sixty_male}}],
            stack: 'count'
        }, {
            name: 'Female',
            data: [{{$event->younger_than_ten_female}},
                   {{$event->ten_to_twenty_female}},
                   {{$event->twenty_to_thirty_female}},
                   {{$event->thirty_to_forty_female}},
                   {{$event->forty_to_fifty_female}},
                   {{$event->fifty_to_sixty_female}},
                   {{$event->older_than_sixty_female}}],
            stack: 'count'
        }
        ]
    });
});

@endforeach

@if(!$event_facilitator)

$(function () {
    $('.conference1').highcharts({
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
        },
        title: {
            text: 'Gender Pie chart'
        },
        tooltip: {
            pointFormat: '{series.name} {point.name}: <b>{point.y}</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: true,
                    format: ' {point.name} <br/> <b>{point.percentage:.1f}%</b>'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Number of ',
            data: [
                ['Male', {{$male_count}}],
                ['Female', {{$female_count}}],
            ]
        }]
    });
});



$(function () {
    $('.conference2').highcharts({
        chart: {
            type: 'column',
            options3d: {
                enabled: true,
                alpha: 15,
                beta: 15,
                viewDistance: 100,
                depth: 40
            }
        },

        title: {
            text: 'Number of Participants, grouped by Age'
        },

        xAxis: {
            categories: [' < 10', '10 - 20', '20 - 30', '30 - 40', '40 - 50', '50 - 60', '60 >']
        },

        yAxis: {
            allowDecimals: false,
            min: 0,
            title: {
                text: 'Number of Participants'
            }
        },

        tooltip: {
            headerFormat: '<b>{point.key}</b><br>',
            pointFormat: '<span style="color:{series.color}">\u25CF</span> {series.name}: {point.y} / {point.stackTotal}'
        },

        plotOptions: {
            column: {
                stacking: 'normal',
                depth: 40
            }
        },

        series: [{
            name: 'Male',
            data: [{{$younger_than_ten_male}}, 
                   {{$ten_to_twenty_male}}, 
                   {{$twenty_to_thirty_male}}, 
                   {{$thirty_to_forty_male}},
                   {{$forty_to_fifty_male}},
                   {{$fifty_to_sixty_male}},
                   {{$older_than_sixty_male}}],
            stack: 'count'
        }, {
            name: 'Female',
            data: [{{$younger_than_ten_female}}, 
                   {{$ten_to_twenty_female}}, 
                   {{$twenty_to_thirty_female}}, 
                   {{$thirty_to_forty_female}},
                   {{$forty_to_fifty_female}},
                   {{$fifty_to_sixty_female}},
                   {{$older_than_sixty_female}}],
            stack: 'count'
        }
        ]
    });
});


@endif
// Load the fonts
Highcharts.createElement('link', {
   href: '//fonts.googleapis.com/css?family=Unica+One',
   rel: 'stylesheet',
   type: 'text/css'
}, null, document.getElementsByTagName('head')[0]);

Highcharts.theme = {
   colors: ["#0099ff", "#ff33cc"],
   chart: {
      
      style: {
         fontFamily: "'Unica One', sans-serif"
      },
      plotBorderColor: '#606063'
   },
   title: {
      style: {
         color: 'black',
         textTransform: 'uppercase',
         fontSize: '30px'
      }
   },
   subtitle: {
      style: {
         color: '#E0E0E3',
         textTransform: 'uppercase'
      }
   },
   xAxis: {
      gridLineColor: '#707073',
      labels: {
         style: {
            color: 'black'
         }
      },
      lineColor: '#707073',
      minorGridLineColor: '#505053',
      tickColor: '#707073',
      title: {
         style: {
            color: '#A0A0A3'

         }
      }
   },
   yAxis: {
      gridLineColor: '#707073',
      labels: {
         style: {
            color: 'black'
         }
      },
      lineColor: '#707073',
      minorGridLineColor: '#505053',
      tickColor: '#707073',
      tickWidth: 1,
      title: {
         style: {
            color: '#A0A0A3'
         }
      }
   },
   tooltip: {
      backgroundColor: 'rgba(0, 0, 0, 0.85)',
      style: {
         color: '#F0F0F0',
         fontSize: '15px'
      }
   },
   plotOptions: {
      series: {
         dataLabels: {
            color: 'black',
            style: {
         color: '#F0F0F0',
         fontSize: '15px'
      }

         },
         marker: {
            lineColor: '#333'
         },

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
         color: 'black'
      },
      itemHoverStyle: {
         color: 'black'
      },
      itemHiddenStyle: {
         color: '#606063'
      }
   },
   credits: {
      style: {
         color: '#666'
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
@endif
</script>

@endsection