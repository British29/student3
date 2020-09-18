<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db="classepresence";
	$conn = mysqli_connect($servername, $username, $password,$db);

      $sql = "select * from users";
      $result = mysqli_query($conn,$sql);
      
      
?>

<html>
	<head>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<script src="https://kit.fontawesome.com/yourcode.js"></script>

    <title>Profile des differents eleves</title>		
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

	</head>

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
	
	<body>
    <div class="demo-content">
		<h1 style="text-align: center; color:blue;">PROFILE DES DIFFERENTS ETUDIANTS</h1><br><br><br>
  <form name="frmSearch" method="post" action="">

<?php if(!empty($result))	 { ?>
	<div class="container sm-3">

<table class="table table-bordered table-hovered">
          <thead>
        <tr>
                  
          <th><span>NOM & PRENOMS</span></th>
          <th><span>EMAIL</span></th>          
          <th><span>SEXE</span></th>
		  <th><span>TELEPHONE</span></th>
		  <th><span>PROFIL</span></th>	  
        </tr>
      </thead>
    <tbody>
	<?php
		while($row = mysqli_fetch_array($result)) {
	?>
        <tr>
		
			<td><?php echo $row["username"]; ?></>
			<td><?php echo $row["email"]; ?></td>
			<td><?php echo $row["sex"]; ?></td>
			<td><?php echo $row["phone"]; ?></td>
			<td> <a href="ProfilEtudiant.php?id=<?php echo $row["id"]; ?>"><i class="fas fa-user">Profil</i></a></td>
			

		</tr>
   <?php
		}
   ?>
   <tbody>
  </table>
<?php } ?>
  </form>
  </div>
  </div>

</body>
</html>