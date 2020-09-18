<?php

include 'conn.php';

// If file upload form is submitted 
    $status = $statusMsg = '';
    //var_dump($_POST);
if(isset($_POST)) {
    
    $status = 'error';
    $path = 'uploads/'; // Repertoire de telechargement
     
    if(!empty($_FILES["file"]["name"])) { 
        // Obtention information sur le fichier 
        $fileName = basename($_FILES["file"]["name"]); 
        $ext = $_FILES['file']['tmp_name']; 
        
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION)); 

        // On peut télécharger la même image en utilisant la rand function
        $final_image = rand(1000,1000000).$fileName;
         
        // Autoriser certains formats d'images 
        $allowTypes = array('jpg','png','jpeg','gif'); 
         
        if(in_array($fileType, $allowTypes)){
            
            $path = $path.strtolower($final_image); 
            
             
            $result=move_uploaded_file($ext,$path);
             

            if($result){
                
                $username = htmlspecialchars($_POST['username']);
                $email = htmlspecialchars($_POST['useremail']);
                $phone = htmlspecialchars($_POST['userphone']);
                $password = htmlspecialchars($_POST['userpass']);
                $sex = $_POST['sex'];
                
                // Insertion des données dans la base de données 
                $insert = mysqli_query($conn,"INSERT into users (username, email, password,phone, sex ,file_name)
                VALUES ('$username','$email','$password','$phone','$sex','$path')"); 
                
                if($insert){ 
                    $status = 'success';
                     
                }else{ 
                    $status =  'Echec du téléchargement, Veuillez reprendre.'; 
                }  
            }else{ 
              $status ='Désolé, seul les types JPG, JPEG, PNG, & GIF sont autorisés.'; 
            } 
     }else{ 
        $status =  'selectionner une image à télécharger.'; 
     }
    } else{
        $status = 'le champ image est vide';
    }
}  
    mysqli_close($conn);

$output=array('msg'=>$status ); 
echo json_encode($output);
?>
