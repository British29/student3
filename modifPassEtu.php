<?php
session_start();
include 'conn.php';



     $email = $_SESSION["email"];
     $dup = mysqli_query($conn,"select * from users where email = '$email' ");
     $row = mysqli_fetch_assoc($dup);
     $id = $row["id"];
     $_SESSION['id'] = $row["id"];


// $pass = $_SESSION["password"];



?>
<!DOCTYPE html>
<html>

<head>
    <title>Tableau de bord de Etudiant</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <!------ Include the above in your HEAD tag -------- -->
    <SCRIPT language="Javascript">
        function checkpass() {
            if (document.profile_form.password1.value != document.profile_form.password2.value) {
                window.alert("mots de passe non conforme");
            }
            //     else {
            //     //    function bien(){ok}
        }
    </SCRIPT>
</head>

<?php


$error_email = '';

$error_pass = '';
$error = 0;
$success = '';

if (isset($_POST["button_action"])) {
    
    // $email_new = $_POST["email"];
    $pass_old = $_POST["password"];
    $pass_new = $_POST["password1"];
    // $Newpass = $pass;
    $checkdata=" SELECT password FROM users WHERE id='$id' AND password = '$pass_old'  ";
    $query=mysqli_query($conn, $checkdata);
    $row = mysqli_num_rows($query);
    if($row>0)
    {
     $update = mysqli_query($conn, "UPDATE users SET password = '$pass_new' WHERE id='$id' AND email='$email'");

        if ($update) {

            $_SESSION["id"]=$id;
            // $_SESSION['email']=$email_new;
            $_SESSION['password']=$pass_new;
            $success = 'Modifier avec succès !!!';
            header('Location: dashbordEtudiant.php');
        }
    }
    else
    {
        echo "ancien mot pass non correcte";
    }
}
   




?>

<body>
    <br>
    <a href="dashbordEtudiant.php">Retour</a>
    <div class="container" style="margin-top:30px">
        <span><?php echo $success; ?></span>
        <div class="card">
            <form method="post" name="profile_form" id="profile_form">

                <div class="card-body">
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Ancien mot de passe</label>
                            <div class="col-md-8">
                                <input type="password" name="password" id="password" class="form-control" value="<?php ?>" />
                                <span class="text-danger"> <?php echo $error_pass ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Nouveau mot de passe </label>
                            <div class="col-md-8">
                                <input type="password" name="password1" id="password1" class="form-control" maxlength="10" placeholder="**********" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Confirmez Nouveau mot de passe</label>
                            <div class="col-md-8">
                                <input type="password" name="password2" id="password2" class="form-control" maxlength="10" placeholder="**********" onchange="checkpass();" />
                            </div>
                        </div>
                    </div>
                </div>
                <div align="center">

                    <input type="submit" name="button_action" id="button_action" class="btn btn-primary" value="Enregistrer" />
                </div><br>
            </form>
        </div>
    </div>
    <br />
    <br />
<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
<link rel="stylesheet" href="css/datepicker.css" />
</body>

</html>


