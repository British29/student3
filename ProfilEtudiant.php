<?php

include 'conn.php';
session_start();
$id = $_GET['id'];


      $dup = mysqli_query($conn,"select * from users where id = '$id'");
      $row = mysqli_fetch_assoc($dup);
      $id = $row["id"];
      $_SESSION["id"]= $row["id"];
      $_SESSION["username"]= $row["username"];
      $_SESSION["email"]= $row["email"];
      $_SESSION["phone"]= $row["phone"];
      $_SESSION["sex"]= $row["sex"];
      $_SESSION["file_name"]= $row["file_name"];





      // Le graphe
    


$req = "select  case when mois=1 then CONCAT('Janavier-',ANNEE)
              when mois=2 then CONCAT('Fevrier-',ANNEE)
			  when mois=3 then CONCAT('Mars-',ANNEE)
			  when mois=4 then CONCAT('Avril-',ANNEE)
			  when mois=5 then CONCAT('Mai-',ANNEE)
			  when mois=6 then CONCAT('Juin-',ANNEE)
			  when mois=7 then CONCAT('Juillet-',ANNEE)
			  when mois=8 then CONCAT('Aout-',ANNEE)
			  when mois=9 then CONCAT('Septembre-',ANNEE)
			  when mois=10 then CONCAT('Octobre-',ANNEE)
			  when mois=11 then CONCAT('Novembre-',ANNEE)
			  when mois=12 then CONCAT('Decembre-',ANNEE) end MOIS_NOM,
			  nonbre from(
 SELECT YEAR (datesign) ANNEE,MONTH (datesign)  mois ,COUNT(id) nonbre 
 FROM `attendance` WHERE iduser = '$_SESSION[id]' AND statut = 'present' GROUP BY  MONTH (datesign),YEAR (datesign)
 ) as t"; 


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

<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
  title: {
    text: "PRESENCE "
  },
  axisX: {
    title: "mois"
  },

   axisY: {
    title: "nombre signature"
  },
  
  data: [{        
        type: "line",
        lineColor:"red", //**Change the color here
    markerSize: 25,
    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
  }]
});
chart.render();
 
}
</script>
</head>
<body class="container bg-light">
<br>
<br>
<br>
   

    
    </div>
<div class="row bg-primary text-light">
  <div class="col-3 p-2"><h1><?php echo $_SESSION["username"]; ?></h1></div>
  <div class="col p-2"></div>
  <div class="col-1 p-1 d-flex flex-reverse "><!-- <button type="button" class="btn btn-primary"><a href="" class="text-light">Home</a></button> --><br/></div>
  <div class="col-2 p-2 d-flex flex-reverse text-light">
<div>
<form method="post" action="update.php"  >
 <input type="hidden" name="editId" value="<?php echo $row["id"];?>"/>
 
</form>

</div>
 </div>


</div><br>  <br>
   
      

<div class="container emp-profile">
            <form method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">

                            <img class="rounded-circle" src="<?php echo $_SESSION["file_name"];?>" alt="file_name"/>
                            <br>
                            <div class="file">
                        
                                <div class="col-md-2">
                        
                          </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>NOM & PRENOMS</label>
                                            </div>
                                            <div class="col-md-6">
                   <p style="color:blue; font-family: FreeMono, monospace;"><?php echo $_SESSION["username"]; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>EMAIL</label>
                                            </div>
                                            <div class="col-md-6">
                   <p style="color:blue; font-family: FreeMono, monospace;"><?php echo $_SESSION["email"]; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>TELEPHONE</label>
                                            </div>
                                            <div class="col-md-6">
                    <p style="color:blue; font-family: FreeMono, monospace;"><?php echo $_SESSION["phone"]; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>SEXE</label>
                                            </div>
                                            <div class="col-md-6">
                    <p style="color: blue; font-family: FreeMono, monospace;"><?php echo $_SESSION["sex"]; ?></p>
                                            </div>
                                        </div>
                            </div>
                    
                </div>
                
            </form>  
            </div>
        </div>
<br><br>
<br><br>



<div class="col-10" id="chartContainer" style="height: 370px; width: 100%;"></div>


<br><br>
<br><br>


    <style>
	.table-content{border-top:#CCCCCC 4px solid; width:50%;}
	.table-content th {padding:5px 20px; background: #F0F0F0;vertical-align:top;} 
	.table-content td {padding:5px 20px; border-bottom: #F0F0F0 1px solid;vertical-align:top;} 
	</style>
	</head>
	
	<body>
 

 <!-- signature -->
 <?php
 
      $sql = "SELECT `id`,`iduser`, `datesign`, `statut`, `motif` FROM `attendance` WHERE `statut`= 'abscent' AND `iduser`= '$id'";
	$result = mysqli_query($conn,$sql);
      
      
?>


    <div class="demo-content">
		<h2 class="title_with_link">Student attendance</h2>
 
<?php if(!empty($result))	 { ?>
<table class="table table-bordered table-hovered">
          <thead>
        <tr>
                     
          <th><span>DATE</span></th>
          <th><span>STAUT</span></th> 
          <th><span>JUSTIFICATION</span></th>        
        	  
        </tr>
      </thead>
    <tbody>
	<?php
		while($row = mysqli_fetch_array($result)) {
	?>
        <tr>
			
			<td><?php echo $row["datesign"]; ?></td>
			<td><?php echo $row["statut"]; ?></td>
      <td><?php echo $row["motif"]; ?></td>
      <td> <a href="updateProfilEtudiant.php?id=<?php echo $row["id"]; ?>"><i class="fas fa-edit"></i>Mofier</a></td>

		</tr>
   <?php
		}
   ?>
   <tbody>
  </table>
<?php } ?>
 
  </div>




 <!-- fin signature -->
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>









