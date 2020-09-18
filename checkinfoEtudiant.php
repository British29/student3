<?php
include_once 'conn.php';
$result = mysqli_query($conn,"SELECT users.username, attendance.id, attendance.datesign, attendance.statut, attendance.motif 
	FROM attendance, users 
	WHERE attendance.iduser = users.id AND attendance.statut = 'abscent' AND attendance.motif = 'RAS'");
?>
<!DOCTYPE html>
<html>
<head>
<title>Student</title>
</head>
<body>

<table>
	<tr>
		<td>Id</td>
		<td> Nom & Prenoms</td>
		<td>Date</td>
		<td>Statut</td>
		<td>Motif</td>
		<td>Modifier</td>
	</tr>


<?php
$i=0;
while($row = mysqli_fetch_array($result)) {
if($i%2==0)
$classname="even";
else
$classname="odd";
?>
<tr class="<?php if(isset($classname)) echo $classname;?>">
<td><?php echo $row["id"]; ?></td>
<td><?php echo $row["username"]; ?></td>
<td><?php echo $row["datesign"]; ?></td>
<td><?php echo $row["statut"]; ?></td>
<td><?php echo $row["motif"]; ?></td>

<td><a href="modif.php?id=<?php echo $row["id"]; ?>">Modifier</a></td>
</tr>
<?php
$i++;
}
?>
</table>
</body>
</html>
