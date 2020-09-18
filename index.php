<!DOCTYPE html>
<html>
<head>

   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <!-- <link href="css/style.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>


	<title></title>
</head>
<body>

	<style>

		body{

			background: khaki;
		}
		
		nav{font-family: "lato", cooper;

			background: blue;
			text-decoration: black;
		}

		h1{

			text-align: center;
			text-decoration-color: red;
		}

		.sidebar{
			width: 100px;
			height: 100%;
			background: red;
		}

		h4{
			text-align: center;
			text-decoration-color: red;
		}

/* Texte défilant */
.content {
	display: block;
	margin: 40px auto;
	padding: 0;
	overflow: hidden;
	position: relative;
	/*	table-layout: fixed;*/
	width: 600px;
	height: 60px;
}
.message {
	display: block;
	margin-left: -100%;
	padding: 0 5px;
	font-size: 2rem;
	text-align: left;
	animation: defilement 50s infinite linear;
}
.message:after {
	content: attr(data-text);
	position: absolute;
	white-space: nowrap;
	padding-left: 10px;
}
 @keyframes defilement {
 0%, 100% {
margin-left:70%;
}
 99.99% {
margin-left:-100%;
}
}

	</style>


<nav>

		<span class="message"> ATTENDANCE STUDENT </span> 

</nav>


<div class="container">
		
		 <br><br> <h4>BIENVENUE AU MENU DE DEMARRAGE</h4><br><br><br><br><br>

  <div class="row">	 
	 <div class="col-sm-3">
	  	<div class="card card-signin">
	  		<div class="card-body">
	  			<div class="card-title text-center">
			    		<a href="inscrit.php">
			    			<img src="inscrit.jpg" height="60%" width="100%">	
			    		</a><div class="desc" style="color: blue;">INSCRIPTION</div>
		    			
		</div>
			</div>
				</div>
	</div>

	<div class="row col-sm-3">
	  	<div class="card card-signin">
	  		<div class="card-body">
	  			<div class="card-title text-center">
			    		<a href="signer.php">
			    			<img src="signature.png" height="60%" width="85%">	
			    		</a><div class="desc" style="color: blue;">SIGNATURE</div>
			    			
		</div>
			</div>
				</div>

	</div>

	<div class="col-sm-3">
	  	<div class="card card-signin">
	  		<div class="card-body">
	  			<div class="card-title text-center">
			    		<a href="connecAdmin.php">
			    			<img src="images.png" height="60%" width="85%">	
			    		</a><div class="desc" style="color: blue;">PROFESSEUR</div>
			    			
		</div>
			</div>
				</div>

	</div>


	<div class="col-sm-3">
	  	<div class="card card-signin">
	  		<div class="card-body">
	  			<div class="card-title text-center">
			    		<a href="connecEtu.php">
			    			<img src="dashbord prof.jpg" height="60%" width="80%">	
			    		</a><div class="desc" style="color: blue;">TABLEAU DE BORD ELEVES</div>
			    			
		</div>
			</div>
				</div>


	</div>


  </div>

</div>


</body>
</html>