<?php
    $json = file_get_contents('https://www.alphavantage.co/query?function=GLOBAL_QUOTE&outputsize=full&symbol=PETR4.SA&apikey=KX67IE53MVD2VYU7');

    $data = json_decode($json, true);

    $itens = $data['Time Series (Daily)'];
    
    // echo "<pre>" . json_encode($itens, JSON_PRETTY_PRINT) . "</pre>";
?>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Data', 'Close'],
            <?php 
                $i = 1;
                foreach ($itens as $k => $v) {
                    $data = str_replace('-', '/', $k);
                    if ($i == 365) {
                      break;
                    }
                    $valor = $v['4. close'];
            ?>
            ['<?php echo $data ?>', <?php echo $valor ?>],
            
            <?php $i++; } ?>
        ]);

        var options = {
          title: 'PETRY4',
          hAxis: {title: 'Data',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>

  </head>
  <body>
    <div id="chart_div" style="width: 100%; height: 500px;"></div>
  </body>
</html>