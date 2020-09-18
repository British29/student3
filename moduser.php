<?php
session_start();
include 'conn.php';


$user_id = $_SESSION["id"];

$slq = mysqli_query($conn, "select username, email, password, phone, file_name from users where id=$user_id");
$row = mysqli_fetch_assoc($slq);
$username =$row["username"];
$email =$row["email"];
$pass =$row["password"];
$phone =$row["phone"];
$file_name = $row["file_name"];

?>

<!DOCTYPE html>
<html>

<head>
    <title>Attendance profile</title>
    <meta charset="utf-8">
    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">

    <!-- JS, Popper.js, and jQuery -->

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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

$error_username = '';
$error_email = '';
$error_pass = '';
$error_phone = '';
$error_image = '';
$error = 0;
$success = '';

if (isset($_POST["button_action"])) {
    $username_new = $_POST["username"];
    $email_new = $_POST["email"];
    $pass1_new = $_POST["password"];
    $pass2_new = $_POST["password1"];
    $phone_new = $_POST["phone"];
    $Newpass = $pass;

    if ($pass != $pass1_new || $username_new == '') {
        if ($username_new == '') {
            $error_username = 'le nom doit pas etre nul';
        }
        if ($pass != $pass1_new) {
            $error_pass = 'mot de passe saisi est incorrect';
        }
    } else {
        if ($pass2_new != '') {
            $Newpass = $pass2_new;
        }

        if ($_FILES['file']['name']) {
            $FName = md5($_FILES['file']['name']);
            echo $_FILES['file']['name'];
            $NewFile = "uploads/" . $FName;
            if (!move_uploaded_file($_FILES['file']['tmp_name'], $NewFile)) {
                die("Failed to move file " . $_FILES['file']['tmp_name'] . " to " . $FName);
            } else {
                $update = mysqli_query($conn, "UPDATE users SET username = '$username_new', email= '$email_new', password = '$Newpass' , phone = '$phone_new', file_name = '$NewFile' WHERE id='$user_id'");
            }
        } //si fichier n'existe pas
        else {
            $update = mysqli_query($conn, "UPDATE users SET username = '$username_new', email= '$email_new', password = '$Newpass' WHERE id='$users_id'");
        }
        $update = mysqli_query($conn, "UPDATE users SET username = '$username_new', email= '$email_new', password = '$Newpass', phone= '$phone_new' WHERE id='$user_id'");

        if ($update) {

            $_SESSION["id"]=$user_id;
            $_SESSION['email']=$email_new;
            $_SESSION['password']=$Newpass;
            $status = 'success';
            $success = '<div class="alert alert-success">Profile Details Change Successfully</div>';
           
            
            header('Location: dashbordEtudiant.php');
        } else {
            echo  'Echec modification, Veuillez reprendre.';
        }


        mysqli_close($conn);
    }
}




?>

<body>

    <div class="container" style="margin-top:30px">
        <span><?php echo $success; ?></span>
        <div class="card">
        
            <form method="post" name="profile_form" id="profile_form" enctype="multipart/form-data">
                 <div class="card-body">
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Nom & Prenoms<span class="text-danger"></span></label>
                            <div class="col-md-8">
                                <input type="text" name="username" id="username" class="form-control" value="<?php echo$username ?>" />
                                <span class="text-danger"><?php echo$error_username ?> </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Email<span class="text-danger"></span></label>
                            <div class="col-md-8">
                                <input type="text" name="email" id="email" class="form-control" value="<?php echo$email ?>" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Ancien Mot de passe <span class="text-danger"></span></label>
                            <div class="col-md-8">
                                <input type="password" name="password" id="password" class="form-control" value="<?php echo$pass?>" />
                                <span class="text-danger"> <?php echo $error_pass ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Telephone<span class="text-danger"></span></label>
                            <div class="col-md-8">
                                <input type="text" name="phone" id="phone" class="form-control" value="<?php echo$phone ?>" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Photos de Profil<span class="text-danger"></span></label>
                            <div class="col-md-8">
                                <input type="file" name="file" />
                                <span class="text-muted"></span><br />
                                <img src="<?php echo $file_name?>" class="img-thumbnail" style="width:200px;height:200px;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer" align="center">


                    <input type="submit" name="button_action" id="button_action" class="btn btn-primary" value="Modifier" />
                </div>
            </form>
        </div>
    </div>
    <br />
    <br />
    <a href="dashbordEtudiant.php">Retour</a>
</body>

</html>


