 <?php include 'db_connect.php' ?>
 <?php 
 $query = "SELECT vacancy.position, COUNT(application.id) as application_count FROM vacancy INNER JOIN application ON vacancy.id = application.position_id GROUP BY vacancy.position";
$result = $conn->query($query);
$positionsData = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $positionsData[] = [$row["position"], (int)$row["application_count"]];
    }
} else {
    echo "No matching vacancies found";
}


?>
 <html>

 <head>
     <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
     <script type="text/javascript">
     google.charts.load('current', {
         'packages': ['bar']
     });
     google.charts.setOnLoadCallback(drawChart);

     function drawChart() {
         var data = google.visualization.arrayToDataTable([
             ['Position', 'Applications'],
             <?php
        foreach ($positionsData as $item) {
            echo "['" . $item[0] . "', " . $item[1] . "],";
        }
        ?>
         ]);

         var options = {
             title: 'Applications per Position',
             chartArea: {
                 width: '50%'
             },
             hAxis: {
                 title: 'Total Applications',
                 minValue: 0
             },
             vAxis: {
                 title: 'Position'
             }
         };

         var options = {
             chart: {
                 title: 'Company\'s Applicants'

             },
             bars: 'horizontal' // Required for Material Bar Charts.
         };

         var chart = new google.charts.Bar(document.getElementById('barchart_material'));

         chart.draw(data, google.charts.Bar.convertOptions(options));
     }
     </script>
 </head>

 <body>
     <div id="barchart_material" style="width: 900px; height: 500px;"></div>
 </body>

 </html>