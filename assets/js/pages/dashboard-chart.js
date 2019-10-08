//[Dashboard chart Javascript]

//Project:	Crypto Admin - Responsive Admin Template


 		
//-----amchart
var chartData = generateChartData();

function generateChartData() {
  var chartData = [];
  var firstDate = new Date( 2012, 0, 1 );
  firstDate.setDate( firstDate.getDate() - 1000 );
  firstDate.setHours( 0, 0, 0, 0 );

  var a = 2000;
 
  for ( var i = 0; i < 1000; i++ ) {
    var newDate = new Date( firstDate );
    newDate.setHours( 0, i, 0, 0 );

    a += Math.round((Math.random()<0.5?1:-1)*Math.random()*10);
    var b = Math.round( Math.random() * 100000000 );

    chartData.push( {
      "date": newDate,
      "value": a,
      "volume": b
    } );
  }
  return chartData;
}
/*
var chart = AmCharts.makeChart( "chartdiv1", {
  "type": "stock",
  "theme": "light",
  "categoryAxesSettings": {
    "minPeriod": "mm"
  },

  "dataSets": [ {
    "color": "#e0bc00",
    "fieldMappings": [ {
      "fromField": "value",
      "toField": "value"
    }, {
      "fromField": "volume",
      "toField": "volume"
    } ],

    "dataProvider": chartData,
    "categoryField": "date"
  } ],

  "panels": [ {
    "showCategoryAxis": false,
    "title": "Value",
    "percentHeight": 70,

    "stockGraphs": [ {
      "id": "g1",
      "valueField": "value",
      "type": "smoothedLine",
      "lineThickness": 2,
      "bullet": "round"
    } ],


    "stockLegend": {
      "valueTextRegular": " ",
      "markerType": "none"
    }
  }, {
    "title": "Volume",
    "percentHeight": 30,
    "stockGraphs": [ {
      "valueField": "volume",
      "type": "column",
      "cornerRadiusTop": 2,
      "fillAlphas": 1
    } ],

    "stockLegend": {
      "valueTextRegular": " ",
      "markerType": "none"
    }
  } ],

  "chartScrollbarSettings": {
    "graph": "g1",
    "usePeriod": "10mm",
    "position": "top"
  },

  "chartCursorSettings": {
    "valueBalloonsEnabled": true
  },

  "periodSelector": {
    "position": "top",
    "dateFormat": "YYYY-MM-DD JJ:NN",
    "inputFieldWidth": 150,
    "periods": [ {
      "period": "hh",
      "count": 1,
      "label": "1 hour"
    }, {
      "period": "hh",
      "count": 2,
      "label": "2 hours"
    }, {
      "period": "hh",
      "count": 5,
      "selected": true,
      "label": "5 hour"
    }, {
      "period": "hh",
      "count": 12,
      "label": "12 hours"
    }, {
      "period": "MAX",
      "label": "MAX"
    } ]
  },

  "panelsSettings": {
    "usePrefixes": true
  },

  "export": {
    "enabled": true,
    "position": "bottom-right"
  }
} );


//-----amchart4
var chart = AmCharts.makeChart("chartdiv4", {
    "type": "serial",
    "theme": "light",
    "autoMarginOffset":20,
    "marginRight":80,
    "dataProvider": [{
        "date": "2009-10-01",
        "value": 3,
        "fromValue": 2,
        "toValue": 5
    }, {
        "date": "2009-10-02",
        "value": 5,
        "fromValue": 4,
        "toValue": 6
    }, {
        "date": "2009-10-03",
        "value": 15,
        "fromValue": 12,
        "toValue": 18
    }, {
        "date": "2009-10-04",
        "value": 13,
        "fromValue": 10.4,
        "toValue": 15.6
    }, {
        "date": "2009-10-05",
        "value": 17,
        "fromValue": 13.6,
        "toValue": 20.4
    }, {
        "date": "2009-10-06",
        "value": 15,
        "fromValue": 12,
        "toValue": 18
    }, {
        "date": "2009-10-09",
        "value": 19,
        "fromValue": 15.2,
        "toValue": 22.8
    }, {
        "date": "2009-10-10",
        "value": 21,
        "fromValue": 16.8,
        "toValue": 25.2
    }, {
        "date": "2009-10-11",
        "value": 20,
        "fromValue": 16,
        "toValue": 24
    }, {
        "date": "2009-10-12",
        "value": 20,
        "fromValue": 16,
        "toValue": 24
    }, {
        "date": "2009-10-13",
        "value": 19,
        "fromValue": 15.2,
        "toValue": 22.8
    }, {
        "date": "2009-10-16",
        "value": 25,
        "fromValue": 20,
        "toValue": 30
    }, {
        "date": "2009-10-17",
        "value": 24,
        "fromValue": 19.2,
        "toValue": 28.8
    }, {
        "date": "2009-10-18",
        "value": 26,
        "fromValue": 20.8,
        "toValue": 31.2
    }, {
        "date": "2009-10-19",
        "value": 27,
        "fromValue": 21.6,
        "toValue": 32.4
    }, {
        "date": "2009-10-20",
        "value": 25,
        "fromValue": 20,
        "toValue": 30
    }, {
        "date": "2009-10-23",
        "value": 29,
        "fromValue": 23.2,
        "toValue": 34.8
    }, {
        "date": "2009-10-24",
        "value": 28,
        "fromValue": 22.4,
        "toValue": 33.6
    }, {
        "date": "2009-10-25",
        "value": 30,
        "fromValue": 24,
        "toValue": 36
    }, {
        "date": "2009-10-26",
        "value": 72,
        "fromValue": 57.6,
        "toValue": 86.4
    }, {
        "date": "2009-10-27",
        "value": 43,
        "fromValue": 34.4,
        "toValue": 51.6
    }, {
        "date": "2009-10-30",
        "value": 31,
        "fromValue": 24.8,
        "toValue": 37.2
    }, {
        "date": "2009-11-01",
        "value": 30,
        "fromValue": 24,
        "toValue": 36
    }, {
        "date": "2009-11-02",
        "value": 29,
        "fromValue": 23.2,
        "toValue": 34.8
    }, {
        "date": "2009-11-03",
        "value": 27,
        "fromValue": 21.6,
        "toValue": 32.4
    }, {
        "date": "2009-11-04",
        "value": 26,
        "fromValue": 20.8,
        "toValue": 31.2
    }],
    "valueAxes": [{
        "axisAlpha": 0,
        "position": "left"
    }],
    "graphs": [{
        "id": "fromGraph",
        "lineAlpha": 0,
        "showBalloon": false,
        "valueField": "fromValue",
        "fillAlphas": 0
    }, {
        "fillAlphas": 0.2,
        "fillToGraph": "fromGraph",
        "lineAlpha": 0,
        "showBalloon": false,
        "valueField": "toValue"
    }, {
        "valueField": "value",
        "balloonText":"<div style='margin:10px; text-align:left'><span style='font-size:11px'>allowed: [[fromValue]] - [[toValue]]</span><br><span style='font-size:18px'>Value:[[value]]</span></div>",
        "fillAlphas": 0
    }],
    "chartCursor": {
        "fullWidth": true,
        "cursorAlpha": 0.05,
        "valueLineEnabled":true,
        "valueLineAlpha":0.5,
        "valueLineBalloonEnabled":true
    },
    "dataDateFormat": "YYYY-MM-DD",
    "categoryField": "date",
    "categoryAxis": {
     "position":"top",
        "parseDates": true,
        "axisAlpha": 0,
        "minHorizontalGap": 25,
        "gridAlpha": 0,
        "tickLength": 0,
        "dateFormats": [{
            "period": 'fff',
            "format": 'JJ:NN:SS'
        }, {
            "period": 'ss',
            "format": 'JJ:NN:SS'
        }, {
            "period": 'mm',
            "format": 'JJ:NN'
        }, {
            "period": 'hh',
            "format": 'JJ:NN'
        }, {
            "period": 'DD',
            "format": 'DD'
        }, {
            "period": 'WW',
            "format": 'DD'
        }, {
            "period": 'MM',
            "format": 'MMM'
        }, {
            "period": 'YYYY',
            "format": 'YYYY'
        }]
    },

    "chartScrollbar":{

    },

    "export": {
        "enabled": true
    }
});

chart.addListener("dataUpdated", zoomChart);

function zoomChart(){
    chart.zoomToDates(new Date(2009,9,20, 15), new Date(2009,10,3,12));
}

*/
