<?php

include 'conn.php';

$req = "SELECT users.username, COUNT('attendance.datesign') AS presence  FROM attendance, users WHERE users.id = attendance.iduser AND attendance.statut = 'present' GROUP BY username";


 if($result=$conn->query($req)){
$dataPoints = array();
$graph = array();
while($row=$result->fetch_row()){
  array_push($graph,array("y" => $row[1], "label" => "$row[0]"));

}
 }


$dataPoints = $graph;

 
?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="style.css">


<script>
window.onload = function() {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light5",
	title:{
		text: "Student attendance"
	},
	axisY: {
		title: "Nbr of presences"
	},
	data: [{
		type: "column",
		yValueFormatString: "#,##0.## signatures",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
<!-- Style de la table -->

</head>
<body class="">


</div>
  

<div class="col-10" id="chartContainer" style="height: 370px; width: 100%;"></div>


<br><br>
<br><br>
<?php

       		$sql = "SELECT users.username, COUNT('attendance.datesign') AS presence  FROM attendance, users WHERE usrers.id = attendance.iduser AND attendance.statut = 'present' GROUP BY username";
	$result = mysqli_query($conn,$sql);
?>
<?php if(!empty($result))	 { ?>
  <div class="card mb-4">
              <div class="card-header">
                  <i class="fas fa-table mr-1"></i>
                    Attendance table
              </div>
  <div class="card-body">
  <div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="50%" cellspacing="0">
          <thead>
        <tr>
                      
          <th width="30%"><span>Stusent</span></th>
          <th width="50%"><span>Number of presence</span></th> 

            
        </tr>
      </thead>
    <tbody>
	<?php
		while($row = mysqli_fetch_array($result)) {
	?>
        <tr>
			<td><?php echo $row["username"]; ?></td>
			<td><?php echo $row["presence"]; ?></td>
			

		</tr>
   <?php
		}
   ?>
   <tbody>
  </table>
</div>
</div>

<?php } ?>
  
  <br><br>
  <br><br>


<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                               
                            </div>
                        </div>
                    </div>
                </footer>
</body>
</html>



