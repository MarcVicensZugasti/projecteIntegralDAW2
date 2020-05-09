<?php
	include "connection.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Canvi de contrasenya</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<style>
		.coloreame {
			color: white;
		}
		.navbar-inverse{
			background-color: black;
			opacity: .8;
		}
		.nav-link{ 	
			color:white;
		}
		footer{
			opacity: .8;
		}
		.alert-danger{
			width: 270px;
			margin-left: 820px;
			margin-top: 100px;
		}
		body{
			background-image: url(imatges/pas.jpg);
			background-size: 1950px;
			background-position: center;
			background-attachment: fixed;
			background-repeat: no-repeat;
		}
		.wrapper4{
			width: 400px;
			width: 400px;
			margin: 100px auto;
			background-color: black;
		}
		.caixa3{
			height: 500px;
		    width: 500px;
		    background-color: #0d1f1f;
		    margin: 100px auto;
		    opacity: .8;
		    color: white;
		}
		.alert-success{
			width: 300px;
			margin-left: 820px;
			margin-top: 100px;
		}
	</style>

</head>
<body>
		<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand active"><span class="coloreame">LA TEVA LLIBRERIA ONLINE</span></a>
			</div>
			<?php
				if(isset($_SESSION['login_user'])){
					?>
					<nav class="navbar navbar-inverse" style="float: right;">
						<div class="container-fluid">
						<br><br><br><br><br><br>
						<ul class="nav nav-tabs">
							<li class="nav-item>" style="color: white"><a class="nav-link" href="perfil.php">
								<?php
									echo "<img class='img-circle profile_img' height=30 width=30 src='imatges/".$_SESSION['foto']."'>"; 
									echo "&nbsp".$_SESSION['login_user'];
								?>
							</a>
							</li>
							<li class="nav-item"><a class="nav-link " href="index.php">PRINCIPAL</a></li>
							<li class="nav-item"><a class="nav-link " href="logout.php">SURT</a></li>
							<li class="nav-item"><a class="nav-link " href="llibres.php">LLIBRES</a></li>
							<li class="nav-item"><a class="nav-link " href="contacte.php">CONTACTA'NS</a></li>
						</ul>
					</nav>

					<?php
					} else {
					?>
						<nav class="navbar navbar-inverse" style="float:right;">
						<div class="container-fluid">
						<ul class="nav nav-tabs">
							<li class="nav-item"><a class="nav-link " href="index.php">PRINCIPAL</a></li>
							<li class="nav-item"><a class="nav-link " href="loginClient.php">ACCEDEIX</a></li>
							<li class="nav-item"><a class="nav-link " href="registrar.php">REGISTRE</a></li>
							<li class="nav-item"><a class="nav-link " href="llibres.php">LLIBRES</a></li>
							<li class="nav-item"><a class="nav-link " href="contacte.php">CONTACTA'NS</a></li>
						</ul>
					</nav>
					<?php
				}
			?>
		</div>
	</nav>
	<div class="caixa3">
		<br><br>
		<h1 style="text-align: center; font-size: 40px;">La teva Llibreria Online</h1><br>
		<h1 style="text-align: center; font-size: 25px;">Canvi de contrasenya</h1><br>
		<form style=" margin: auto 122px;" action="" method="post">
			<input type="text" name="username" class="form-control" placeholder="Nom d'usuari" required=""><br>
			<input type="text" name="email" class="form-control" placeholder="Correu" required=""><br>
			<input type="text" name="password" class="form-control" placeholder="Nova contrasenya" required=""><br>
			<button style="margin: auto 90px;" class="btn btn-dark" type="submit" name="submit">Canviar</button>
		</form>
	</div>
	<?php
	//Si apretem el botó del formulari...
		if(isset($_POST['submit'])){
			//Si l'usuari i el correu introduits són els assignats a l'usuari que s'ha introduit, seran canviats.
			if(mysqli_query($db,"UPDATE client SET password = '$_POST[password]' WHERE username = '$_POST[username]' && email = '$_POST[email]';")){
				?>
					<div class="alert alert-success">
						<strong>La contrasenya ha estat canviada.</strong>
					</div>
				<?php
			}
		}
	?>
</body>
</html>