<?php

 include 'conn.php';

      

 ?>

<!DOCTYPE html>
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


<!-- Insérer le script pour debuter et terminer les cours -->

        <SCRIPT language="Javascript">
        function debut_cours() {

            fr_validation.submit();

        }
        function fin_cours() {

            fin_validation.submit();
        }

    </SCRIPT>

    <!-- Fin du script pour debuter et terminer les cours -->

 </head>

	 <title>La liste des eleves present</title>


</head>
<body>

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
      height: 100px;


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

  <nav><br>

      <h1 style="text-align: center;">BIENVENUE</h1>

  </nav><br><br>
 

   <!-- Debut des cards avec debut et fin des cours -->
    <div class="container">
          <div class="col-xl-3 col-md-6">
                  <div class="card bg-primary">
                        <div class="card-body">
                            <form action="dashbord.php" method="post" name="fr_validation">
                                <input class="card bg-primary" type="submit" name="submit" value="Début des cours" onclick="debut_cours();">
                            </form>
                        </div>             
                  </div>
          </div>
    </div>


    <br><br>                 

     <div class="container">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning">
                    <div class="card-body">
                        <form action="dashbord.php" method="post" name="fin_validation">
                            <input class="card bg-warning" type="submit" name="fin_submit" value="fin des cours" onclick="fin_cours();">
                        </form>
                    </div>
              </div>
        </div>
    </div>
<br><br><br>
<!-- script php pour debuter et mettre fin au cours -->
  
  <?php
                if (isset($_POST["submit"])) {
                   
     $date = date("Y-m-d");
                    
                     $verif = mysqli_query($conn,"SELECT datesign FROM attendance WHERE  datesign='$date'");
  
                    if (mysqli_num_rows($verif) == 0) {
                        
                        $insertion = "INSERT INTO `attendance` (`iduser`, `statut`, `datesign`) select distinct id, 'abscent', '$date' from users";
    mysqli_query($conn, $insertion);
                    } else {
                        echo "Les cours ont déjà débuté";
                    }
                }

                if (isset($_POST["fin_submit"])) {
                    

                    //  Debut de la journée
                    $date = date("Y-m-d");
                    $verif = mysqli_query($conn, "SELECT datesign FROM attendance WHERE  datesign = '$date'");
                    if (mysqli_num_rows($verif) != 0) {
                       
                        $update = "UPDATE attendance SET salle = 1 WHERE datesign = '$date' ";
                        mysqli_query($conn, $update);
                        echo "Fin de cours";
                    } else {
                        echo "fin de cours echec";
                    }
                }

                ?>


 </center>
</body>
</html>