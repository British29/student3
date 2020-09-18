<!DOCTYPE HTML>
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
</head>
	<title></title>
  <script
  src="http://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  <script type="text/javascript">
  $(document).ready(function() {
    $('#connexion').click(function() {
      var connexion = true;
      $.ajax({
        type: "POST",
        url: 'logckeekEtu.php',
        data: {
          connexion : connexion,
          email: $("#email").val(),
          password: $("#password").val()
        },
        success: function(data)
        {
          if (data === 'success') {
            
            window.location.assign('dashbordEtudiant.php');
          }
          else {
            alert("Mauvaise combinaison d'email et de mot de passe!!!");
          }
        }
      });
    });
  });
  </script>
</head>
<body>	



<center>

<div class="container col-sm-3 border">

    <center><h3>Connectez-vous</h3></center>
    <img src="classe.jpg">

    <form>

        <div class="form-group">
       <br>   <label class="nu">Email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Entre votre email" required>
      </div>

      <div class="form-group">
           <label class="nu">Mot de Passe</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Entrer votre mot de passe" maxlength="10" required>
      </div>
          
            
       <center><button class="btn btn-lg btn-primary" id="connexion">connexion</button></center>



      <div class="container pt-3 my-3 border">
        <p class="mt-5 mb-3 text-muted text-center">si vous n'avez pas de compte <a href="inscrit.php">Inscrivez-vous</a></p></div>


       
   </form>
   </div>
   </center>
</div>



</body>
</html> 