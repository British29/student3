<?php

$answer=null;

 try{
  $conn= new PDO("mysql:host=localhost; dbname=classepresence",'root','');
 }catch(PDOException $e){
  die("Erreur de connexion à la base de donnée: " . $e->getMessage());
 }
 


if (isset($_POST['email'])) {

  $email = $_POST['email'];

  $verif_email = "SELECT * FROM users WHERE email ='$email'" ;
                 $ver_email = $conn->query($verif_email);
                 $verif_user_email = $ver_email->fetch();
                 if (!$verif_user_email) {

                  $answer= 'ok'; 
           
                  } else $answer = 'ce Email a deja ete utilisé'; 



  $output=array('msg'=>$answer); 

echo json_encode($output);

  exit();

}
  
  

  if (isset($_POST['phone'])) {

    $phone = $_POST['phone'];


  $verif_phone = "SELECT * FROM users WHERE phone = '$phone'" ;
                 $ver_phone = $conn->query($verif_phone);
                 $verif_user_phone = $ver_phone->fetch();
                 if (!$verif_user_phone) {

                  $answer= 'ok'; 
           
                  } else $answer = 'ce numero a deja ete utilisé'; 
}
   $output=array('msg'=>$answer); 

echo json_encode($output);

  exit();

?>