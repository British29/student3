<?php
// ici database connect
include 'conn.php';
session_start();
if(count($_POST)>0) {
mysqli_query($conn,"UPDATE attendance SET id = '".$_POST['id']."', motif = '".$_POST['motif']."' WHERE id ='".$_POST['id']."'");
 	                
$message = "Modification reussi avec succès";

}
$result = mysqli_query($conn,"SELECT users.username, attendance.id, attendance.datesign, attendance.statut, attendance.motif 
	FROM attendance, users 
	WHERE attendance.id='" . $_GET['id'] . "'");

$row= mysqli_fetch_array($result);
?>
<html>
<head>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<title>Modification</title>
</head>
<body>
<form name="frmUser" method="post" action="">
<div><?php if(isset($message)) { echo $message; } ?>
</div>
<center>

	<h1 style="color:blue;">MODIFICATION DU MOTIF</h1><br><br>

<div class="container col-sm-3 border">

<div style="padding-bottom:5px;"></div>

<input type="hidden" name="id" class="txtField" value="<?php echo $row['id']; ?>">
<input type="hidden" name="id"  value="<?php echo $row['id']; ?>">

STATUT<br>
<input type="text" disabled="disabled" name="statut" class="txtField" value="<?php echo $row['statut']; ?>">
<br>
<br>
MOTIF<br>
<input type="text" name="motif" class="txtField" value="<?php echo $row['motif']; ?>">
<br>
<br>

<input type="submit" name="submit" value="modifier" class="btn btn-lg btn-success">
<div>clique<a href="dashbord.php">ici</a> pour se retourner sur votre tableau de bord</div>


</form>
</div>
</center>

</body>
</html>