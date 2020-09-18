<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <!-- <link href="css/style.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<title> Formulaire Enregistrement</title>


</head>
<body>

      <center>
         <div class="container col-sm-3 border">
             <h1>Formulaires</h1>
              <img src="classe.jpg">
             <form method="POST" enctype="multipart/form-data" id="Enregistrer_form">
                 <div class="form-group">
                   <label for="nom">Nom et Prenoms</label>
                   <input type="text" class="form-control" name="username" id="UserName" placeholder="Entrer votre nom et Prenoms" required>
                 </div>
                 
                 <div class="form-group">
                   <label for="email">Adresse Email</label>
                   <input type="email" class="form-control" name="useremail" id="UserEmail" placeholder="Email" placeholder="votre Email" required onkeyup="checkemail();">
                   <div id="email_status" style="color: green"></div>
                 </div>

                <div class="form-group">
                   <label for="password">Mot de passe</label>
                   <input type="password" class="form-control"  name="userpass" id="UserPassword" placeholder="votre mot de passe" maxlength="10" required>
                 </div>

                <div class="form-group">
                   <label for="password2">Confirmation Mot de passe</label>
                   <input type="password" class="form-control"  name="userpass2" id="UserPassword2" placeholder="Repeter le mot de passe" required maxlength="10" onkeyup="checkpass();">
                   <div id="pass_status" style="color: green"></div>
                 </div>

                <div class="form-group">
                   <label for="nu">Telephone</label>
                   <input type="telephone" class="form-control"  name="userphone" id="UserPhone" placeholder="votre numero de telephone" required onkeyup="checkphone();">
                   <div id="phone_status" style="color: green"></div>
                 </div><br>

                <div class="form-group">
                    <input type="radio" name="sex" value="homme">
                    <label for="homme">Homme</label>
                    <input type="radio" name="sex" value="femme">
                    <label for="femme">Femme</label>
                    <input type="radio" name="sex" value="autre">
                    <label for="autre">Autres</label><br>

                  </div>

                  <div class="form-group">
                        <input type="file" class="form-control" name="file" id="image"/>
                  </div><br>

                 <div class="form-group form-button">
                    <button class="btn btn-lg btn-success" type="submit" id="Enregistrer" name="submit_form">Enregistrer</button>
                 </div>
             </form>
             Cliquer <a href="index.php">ici</a> pour retourner à l'accueil.
     </center>
   </div>

 <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>

    <script>

        function checkphone()//Fonction qui vérifie si le téléphone existe ou pas
        {
            var phone=document.getElementById( "UserPhone" ).value;
                
            if(phone)
            {
                $.ajax({
                    type: 'post',
                    url: 'checkdata.php',
                    data: {
                    user_phone:phone,
                    },
                    success: function (response) {
                        $( '#phone_status' ).html(response);
                        if(response=="OK")  
                        {
                            return true;  
                        }
                        else
                        {
                            return false; 
                        }
                    }
                });
            }
                else
                {
                    $( '#phone_status' ).html("");
                    return false;
                }
        }

        function checkemail()//Fonction qui vérifie si le mail existe ou pas
        {
        var email=document.getElementById( "UserEmail" ).value;
            
        if(email)
        {
            $.ajax({
                type: 'post',
                url: 'checkdata.php',
                data: {
                user_email:email,
                },
                success: function (response) {
                    $( '#email_status' ).html(response);
                    if(response=="OK")  
                    {
                        return true;  
                    }
                    else
                    {
                        return false; 
                    }
                }
            });
            }
            else
            {
                $( '#email_status' ).html("");
                return false;
            }
        }

        function checkpass()//Fonction qui vérifie si les mMdp correspondent
        {
            var pass2=document.getElementById( "UserPassword2" ).value;
            var pass=document.getElementById( "UserPassword" ).value;
                
            if(pass2)
            {
                $.ajax({
                    type: 'post',
                    url: 'checkdata.php',
                    data: {
                    user_pass2:pass2,
                    user_pass:pass,
                    },
                    success: function (response) {
                        $( '#pass_status' ).html(response);
                        if(response=="OK")  
                        {
                            return true;  
                        }
                        else
                        {
                            return false; 
                        }
                    }
                });
            }
                else
                {
                    $( '#pass_status' ).html("");
                    return false;
                }
        }



        $(document).ready(function() {
	
    $("#Enregistrer_form").on("submit", function(e){
		e.preventDefault();
		    var namehtml=$('#phone_status').html();
            var emailhtml=$('#email_status').html();
            var passhtml=$('#pass_status').html();
            if((namehtml == "OK") && (emailhtml == "OK") && (passhtml == "OK"))
            {
                var form = $(this);// (this) fait reference a ["Enregistrer_form"]    
                var formdata = new FormData(form[0]);
                formdata.append("file", $('#image')); 
                $.ajax({
                    method: "POST",
                    enctype: 'multipart/form-data',// type d'encodage 
                    url: "checkdataConfirm.php",
                    processData: false,
                    contentType: false,
                    cache: false,
                    dataType: "JSON",
                    // envoi des donné hmtl sous forme JSON au lieu de html afin de simplifier les choses,
                    // 
                    data: formdata,
				success: function(insertResult){
					//var insertResult = JSON.parse(data);
					if(insertResult.msg == 'success'){
                        $("#Enregistrer_form").trigger('reset');
                        $('#result').html('<div class="alert alert-success alert-dismissible fade show" role="alert">Inscription reussie, veillez inscrire un nouveau etudiant ou vous connecter <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					}
					else{
						 
                    alert(insertResult.msg);
                        $('#result').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"> '+insertResult.msg+' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					}
					
				}
			});
            }
            else
            {
                $('#result').html('<div class="alert alert-warning alert-dismissible fade show" role="alert"> Email ou Contact exist déjà<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                return false;//On ne peut pas s'incrire
            }
	});
});




        function checkall()
        {
            var namehtml=document.getElementById("phone_status").innerHTML;
            var emailhtml=document.getElementById("email_status").innerHTML;
            var passhtml=document.getElementById("pass_status").innerHTML;

            if((namehtml && emailhtml && passhtml)=="OK")
            {
                return true;//On peut s'inscrire
            }
            else
            {
                return false;//On ne peut pas s'incrire
            }
        }



    </script>

   </body>
</html>