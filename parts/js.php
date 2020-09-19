<script src="dist/js/jquery-3.3.1.min.js"></script>
<script src="dist/js/bootstrap.min.js"></script>
<script src="dist/js/fa.js"></script>
<script src="dist/js/app.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script>
        Highcharts.chart('container', {
  credits: {
    enabled: false
  },
  chart: {
    type: 'spline',
    scrollablePlotArea: {
      minWidth: 600,
      scrollPositionX: 1
    },
    backgroundColor: 'transparent',
    
    
  },
  legend: {
    itemStyle:{color:'#9ba8fe'},
    itemHoverStyle: { color: '#FFF'}
    
  },
  exporting: { enabled: false },
  title: {
    text: '',
    align: 'left'
  },
  xAxis: {
    type: 'datetime',
    labels: {
      overflow: 'justify',
      style :{
        color: "#9ba8fe"
      }
    }
  },
  yAxis: {
    title: {
      text: 'Speed (H/s)',
      style :{
        color: "#9ba8fe"
      } 
    },
    labels:{
      style :{
        color: "#9ba8fe"
      }
    },
    minorGridLineWidth: 0,
    gridLineWidth: 0,
    alternateGridColor: null,
    min: 0,
    startOnTick: false,
    endOnTick: false
  },
  tooltip: {
    valueSuffix: ' H/s'
  },
  plotOptions: {
    spline: {
      lineWidth: 4,
      states: {
        hover: {
          lineWidth: 5
        }
      },
      marker: {
        enabled: false
      },
      pointInterval: 3600000,
    }
  },
  series: [ {
    name: 'Hashrate',
    yAxis: 0,
    data: 
      <?php echo $app->get_chart_data($_COOKIE['xmr_address']); ?>    
  }],
  navigation: {
    menuItemStyle: {
      fontSize: '10px',
      
    }
  }
});
    </script>