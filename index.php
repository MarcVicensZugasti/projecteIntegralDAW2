<?php
	session_start();
?>
<!DOCTYPE html> 
<html> 
<head>
	<title>Biblioteca</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<style type="text/css">
	.nav-link{
		color: #804000;
	}
	.navbar-inverse{
		background-color: #FDFD96;
	}
	header{
		background-color: #FDFD96;
		opacity: .8;
	}
	footer{
		background-color: #FDFD96;
		opacity: .8;
	}
	</style>
</head>
<body>
	<div class="wrapper">
		<header>
			<div class="logoPagina">
				<img class="midaLlibre" src="imatges/llibre.png" />
				<h1 style="color: #804000; font-size: 20px">LA TEVA BIBLIOTECA ONLINE</h1>
			</div>

			<?php
				if(isset($_SESSION['login_user'])){
					?>
					<nav class="navbar navbar-inverse" style="float: right;">
						<div class="container-fluid">
						<br><br><br><br><br><br>
						<ul class="nav nav-tabs">
							<li class="nav-item>" style="color: #804000"><a class="nav-link" href="perfil.php">
								<?php
									echo "<img class='img-circle profile_img' height=30 width=30 src='imatges/".$_SESSION['foto']."'>"; 
									echo "&nbsp".$_SESSION['login_user'];
								?>
							</a>
							</li>
							<li class="nav-item"><a class="nav-link " href="llibres.php">LLIBRES</a></li>
							<li class="nav-item"><a class="nav-link " href="informacioEncarrec.php">ENCARRECS</a></li>
							<li class="nav-item"><a class="nav-link " href="expirat.php">EXPIRATS</a></li>
							<li class="nav-item"><a class="nav-link " href="logout.php">SURT</a></li>
							<li class="nav-item"><a class="nav-link " href="contacte.php">CONTACTA'NS</a></li>
						</ul>
					</nav>
				<?php
					} else {
				?>
					<nav class="navbar navbar-inverse" style="float: right;">
						<div class="container-fluid">
							<br><br><br><br><br><br>
							<ul class="nav nav-tabs">
								<li class="nav-item"><a class="nav-link " href="index.php">PRINCIPAL</a></li>
								<li class="nav-item"><a class="nav-link " href="llibres.php">LLIBRES</a></li>
								<li class="nav-item"><a class="nav-link " href="loginClient.php">ACCEDEIX</a></li>
								<li class="nav-item"><a class="nav-link " href="registrar.php">REGISTRE</a></li>
								<li class="nav-item"><a class="nav-link "href="contacte.php">CONTACTA'NS</a></li>
							</ul>
					</nav>
				<?php
				}
				?>
		</header>
		<section>
			<div class="sectionImatge">
			<br><br>
			<div class="caixa">
				<br>
				<h1 style="text-align: center; font-size: 40px;">Benvinguts a la Biblioteca Online</h1><br><br>
				<h1 style="text-align: center; font-size: 27px;">Obrim a les 09:00</h1><br><br>
				<h1 style="text-align: center; font-size: 27px;">Tanquem a les 21:00</h1><br>
			</div>
			</div>
			<footer>
			<p style="color: #804000; text-align: center; float: center;">
				<br>
				Correu electrònic: &nbsp bibliotecaOnline@gmail.com<br><br>
				Telèfon: &nbsp +34 789456123<br><br>
				© Biblioteca Online 2020 
			</p>
		</footer>
		</section>
	</div>
</body>
</html>