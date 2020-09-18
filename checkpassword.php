<?php
session_start();

include 'conn.php';

   $password = htmlspecialchars($_POST['password']);
   $password1 = htmlspecialchars($_POST['password1']);
   $password2 = htmlspecialchars($_POST['password2']);

    // Insertion des données dans la base de données 
    
   $coded = $_SESSION["id"];
    $update = mysqli_query($conn, "update users set `password` = '$password1' where id = '$coded'");
if ($update) {
    $status = 'modifier avec succès';
    $_SESSION["qlq"]= $password1;
    header('Location: dashbordEtudiant.php');
} else {
    echo  'Echec modification, Veuillez reprendre.';
}

                            
    mysqli_close($conn);
?>
