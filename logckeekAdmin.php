<?php
 include 'conn.php';
 session_start();
 if (isset($_POST['connexion'])) {
    $sql = "SELECT * FROM professeur where email = '".$_POST["email"]."' and password = '".$_POST["password"]."'";
    $result = $conn->query($sql);
   
    if($result -> num_rows > 0){
     $_SESSION["email"] = $_POST["email"];
     echo "success";
    }else{
     echo "fail";
    }
 }

 ?>