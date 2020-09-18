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

<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<script src="https://kit.fontawesome.com/yourcode.js"></script>


<script>
window.onload = function() {
 
var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  theme: "light1", // "light1", "light2", "dark1", "dark2"
  title:{
    text: "ELEVES PRESENTS"
  },
  axisY: {
    title: "Nombres de presence"
    
  },
  data: [{
    type: "column", 
    showInLegend: true,
    yValueFormatInt: "#,##0.## signatures",
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


<style>

body {font-family: "Lato", sans-serif;
font-size: 15px; 
}

.sidebar {
  height: 100%;
  width: 230px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: khaki;
  overflow-x: hidden;
  padding-top: 16px;
  text-decoration: none;
}

.sidebar a {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 20px;
  color: #818181;
  display: block;
}

.sidebar a:hover {
  color: #f1f1f1;
}


@media screen and (max-height: 450px) {
  .sidebar {padding-top: 15px;}
  .sidebar a {font-size: 18px;}
}

nav{font-family: "lato", cooper;

      background: blue;


}

h1{
  width: 800px;
  height: 50px;
  color: white;

}
th{

  color: red;
}

td{

  color: blue;
}


</style>
<div class="sidebar "><br><br><br>
    <a href="graphPresence.php"><i class="fa fa-bar-chart"></i> Liste de presence</a><br><br><br>

    <a href="affichageProfil.php"><i class="fa fa-users"></i> Informations generale</a><br><br><br>

    <a href="graphAbsence.php"><i class="fa fa-bar-chart-o"></i> Liste des absents</a><br><br><br>

    <a href="modifPassProf.php"><i class="far fa-edit"></i> Modifier mot de passe</a><br><br><br>

  <a href="logout.php"><i class="fas fa-sign-out-alt" ></i> Deconnexion</a>
</div>


<center>

  <nav>

      <h1></h1>

  </nav><br><br>
  

<div class="container sm-3" id="chartContainer" style="height: 370px; width: 100%;"></div><br><br><br><br>



<?php

$sql = "SELECT users.username, COUNT('attendance.datesign') AS presence  FROM attendance, users WHERE users.id = attendance.iduser AND attendance.statut = 'present' GROUP BY username";

  $result = mysqli_query($conn,$sql);
?>
<?php if(!empty($result))  { ?>
  <div class="container col.sm-3">
  <div class="card-body">
  <div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="50%" cellspacing="0">

<div><h1 style="color: red;">TABLEAU DES PRESENTS</h1></div><br>

          <thead>
        <tr>
                      
          <th><span>NOM & PRENOMS</span></th>
          <th><span>NOMBRES DE PRESENCE</span></th> 

            
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
  


<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>


</body>
</html>