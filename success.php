<?php 
session_start();
include('conn.php');
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

  <title>Signature</title>
</head>
<body>


<center>

<h1 style="size: 40px;"> BIENVENUE</h1>
<p><h6>Appuyer sur la touche ok pour sortir</h6></p>

<button type="submit" class="btn btn-success"><a href="logout.php">OK</a></button><br>

<p>Vous pouvez Accedez à votre<a href="dashbordEtudiant.php"> tableau</a></p>


</center>


<?php 
     $email = $_SESSION["email"];
     $dup = mysqli_query($conn,"select * from users where email = '$email' ");
     $row = mysqli_fetch_assoc($dup);
     $id = $row["id"];
     $_SESSION['id'] = $row["id"];
     $_SESSION['username'] = $row["username"];
     $_SESSION['email'] = $row["email"];
     $_SESSION['password'] = $row["password"];
     $_SESSION['phone'] = $row["phone"];
     $_SESSION['sex'] = $row["sex"];
     $_SESSION['file_name'] = $row["file_name"];
     $date = date('Y-m-d');
    

    $verif = mysqli_query($conn, "SELECT * FROM attendance WHERE iduser='$id' AND datesign='$date'");
    if (mysqli_num_rows($verif) == 0) {
        echo "<script>alert(\"le cours n'a pas encor debuté\")</script>"; 
    }
    else{
        $row_verif= mysqli_fetch_assoc($verif);
        $salle = $row_verif["salle"];
    
        $statut = $row_verif["statut"];
        if ($salle == 1) {
            echo "<script>alert(\"le cours est fini\")</script>";
        } else {
            if (mysqli_num_rows($verif) == 1 && $statut != 'present') {
                $insertion = "UPDATE attendance SET statut='present' WHERE iduser= '$id' AND datesign='$date'";

                mysqli_query($conn, $insertion);
                echo "<script>alert(\"Vous avez bien signé\")</script>";
                
            } else {
                if (mysqli_num_rows($verif) == 0) {
                    echo "<script>alert(\"le cours n'a pas encor debuté\")</script>";
                } else {
                    echo "<script>alert(\"Vous avez deja signé\")</script>";
                }
            }
        }
    }


?>

</body>
</html>