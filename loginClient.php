<?php
	include "connection.php";
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Accedeix al teu compte</title>
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
	</style>

</head>
<body>
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand active"><span class="coloreame">LA TEVA LLIBRERIA ONLINE</span></a>
				</div>
				<ul class="nav nav-tabs">
					<li class="nav-item"><a class="nav-link" href="index.php">PRINCIPAL</a></li>
					<li class="nav-item"><a class="nav-link" href="llibres.php">LLIBRES</a></li>
					<li class="nav-item"><a class="nav-link" href="contacte.php">CONTACTA'NS</a></li>
				</ul>

			</div>
		</nav>
	<section>
		<div class="imatgeLogin">
			<br><br>
			<div class="caixa1">
				<br><br>
				<h1 style="text-align: center; font-size: 40px;">La teva Llibreria Online</h1><br>
				<h1 style="text-align: center; font-size: 25px;">Formulari de Login</h1><br>
				<form name="Login" action="" method="post">
					<div class="login">
					<input class="form-control" type="text" name="username" placeholder="Nom d'usuari" required=""><br><br>
					<input class="form-control" type="password" name="password" placeholder="Contrasenya" required=""><br><br>
					<input class="btn btn-dark" type="submit" name="submit" value="Entra" style="width: 60px; height: 40px; margin: auto 90px;">
				</div>
				
				<p style="color: white;">
					<br><br><br>
					<a style="color: white;" href="canviPassword.php">&nbspHas oblidat la contrasenya?</a> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
					No tens compte?  <a style="color:white;" href="registrar.php">Registra't</a>
				</p>
				</form>
			</div>
		</div>
	</section>
	<?php
		$count = 0;
		if(isset($_POST['submit'])){
			$res = mysqli_query($db,"SELECT * FROM `client` WHERE username='$_POST[username]' AND password='$_POST[password]';");

			$row = mysqli_fetch_assoc($res);

			$count = mysqli_num_rows($res);
		if($count == 0){
			?>
			<div class="alert alert-danger">
				<strong>Usuari o contrasenya erronis.</strong>
			</div>
			<?php
		} else {
			/*Si concorden els hi assignem foto, si no, no fem res.*/
			$_SESSION['login_user'] = $_POST['username'];
			$_SESSION['foto'] = $row['foto'];
			?>
			<script type="text/javascript">
				window.location = "index.php";
			</script>
			<?php
		}
		}
	?>
</body>
</html>