//[Dashboard Javascript]

//Project:	Crypto Admin - Responsive Admin Template
//Primary use:   Used only for the main dashboard (index.html)


$(function () {

  'use strict';

//sparkline chart
	$("#sparkline0").sparkline([1,4,8,4,6,8,5,7,2,7,4,1 ], {
        type: 'line',
        width: '100%',
        height: '80',
        lineColor: '#e0bc00',
        fillColor: '#e0bc0073',
        minSpotColor:'#e0bc00',
        maxSpotColor: '#e0bc00',
        highlightLineColor: 'rgba(0, 0, 0, 0.2)',
        highlightSpotColor: '#4f4f4f'
    });
	$("#sparkline1").sparkline([1,2,3,4,3,6,3,5,3,8,4,2 ], {
        type: 'line',
        width: '100%',
        height: '80',
        lineColor: '#03a9f3',
        fillColor: '#03a9f37d',
        minSpotColor:'#03a9f3',
        maxSpotColor: '#03a9f3',
        highlightLineColor: 'rgba(0, 0, 0, 0.2)',
        highlightSpotColor: '#03a9f3'
    });
    $("#sparkline2").sparkline([0,3,6,3,4,2,6,1,8,4,4,2 ], {
        type: 'line',
        width: '100%',
        height: '80',
        lineColor: '#ab8ce4',
        fillColor: '#ab8ce494',
        minSpotColor:'#ab8ce4',
        maxSpotColor: '#ab8ce4',
        highlightLineColor: 'rgba(0, 0, 0, 0.2)',
        highlightSpotColor: '#ab8ce4'
    });
    $("#sparkline3").sparkline([2,4,7,3,5,3,6,3,4,3,2,1,2 ], {
        type: 'line',
        width: '100%',
        height: '80',
        lineColor: '#e4e7ea',
        fillColor: '#e4e7ea5c',
        minSpotColor:'#e4e7ea',
        maxSpotColor: '#e4e7ea',
        highlightLineColor: 'rgba(0, 0, 0, 0.2)',
        highlightSpotColor: '#e4e7ea'
    });

  
//airdrop counter
    $('#airdrop_counter').countdown('2028/10/15'), function(event){
      $('#airdrop_counter_day').html(event.strftime('%d'));
      $('#airdrop_counter_hour').html(event.strftime('%H'));
      $('#airdrop_counter_minute').html(event.strftime('%M'));
      $('#airdrop_counter_second').html(event.strftime('%S'));
    }
}); // End of use strict
