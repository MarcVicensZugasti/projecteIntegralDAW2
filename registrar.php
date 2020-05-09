<?php
	include "connection.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Crea el teu compte</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<style type="text/css">
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
	</style>
</head>
<body>
	<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand active"><span class="coloreame">LA TEVA LLIBRERIA ONLINE</span></a>
				</div>
				<ul class="nav nav-tabs">
					<li class="nav-item"><a class="nav-link " href="index.php">PRINCIPAL</a></li>
					<li class="nav-item"><a class="nav-link " href="llibres.php">LLIBRES</a></li>
					<li class="nav-item"><a class="nav-link " href="loginClient.php">ACCEDEIX</a></li>
					<li class="nav-item"><a class="nav-link " href="contacte.php">CONTACTA'NS</a></li>
				</ul>

			</div>
		</nav>		
	<section>
		<div class="imatgeRegistre">
			<br><br>
			<div class="caixa2">
				<br><br>
				<h1 style="text-align: center; font-size: 40px;">La teva Llibreria Online</h1><br>
				<h1 style="text-align: center; font-size: 25px;">Formulari de Registre</h1><br>
				<form name="Registre" action="" method="post">
					<div class="login">
					<input class="form-control" type="text" name="primerNom" placeholder="Primer nom" required=""><br>
					<input class="form-control" type="text" name="primerCognom" placeholder="Primer cognom" required=""><br>
					<input class="form-control" type="text" name="username" placeholder="Nom d'usuari" required=""><br>
					<input class="form-control" type="password" name="password" placeholder="Contrasenya" required=""><br>
					<input class="form-control" type="text" name="email" placeholder="Correu electrònic" required=""><br><br>
					<input class="btn btn-dark" type="submit" name="submit" value="Crea" style="width: 60px; height: 40px; margin: auto 70px;">
				</div>
				</form>
			</div>
		</div>
	</section>
	</body>
	<?php

		if(isset($_POST['submit'])){
			$count = 0;
			$sql = "SELECT username from `client`";
			$res = mysqli_query($db,$sql);

			while ($row = mysqli_fetch_assoc($res)) {
				if($row['username'] == $_POST['username']){
					$count = $count + 1;
				}	
			}
			if($count == 0){
			//Si el contador segueix a 0, ens deixarà crear el compte ja que el nom d'usuari no s'haurà repetit.
			mysqli_query($db,"INSERT INTO `client` VALUES('$_POST[primerNom]','$_POST[primerCognom]','$_POST[username]','$_POST[password]','$_POST[email]','avatar2.png ');");
			?>
				<script type="text/javascript">
					alert("L'usuari ha estat creat.");
				</script>
			<?php
			} else {
			?>
				<script type="text/javascript">
					alert("L'usuari ja existeix.");
				</script>
			<?php
			}
		}
	?>
</html>