<?php
	include "connection.php";
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Contacta'ns</title>
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
			height: 130px;
		}
		.nav-link{
			color:white;
		}
		.wrapper2{
			width: 1000px;
			height: 630px;
			background-color: black;
			opacity: .8;
			color: white;
			padding: 10px;
			margin: 20px auto;

		}
		body{
			background-image: url("imatges/llibreria.jpg");
		}
		.form-control{
			height: 90px;
			width: 60%;
			margin-left: 180px;
		}
		.table{
			color:white;
		}
		.scroll{
			width: 100%;
			height: 400px;
			overflow: auto;
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
						<br><br><br><br><br>
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
							<li class="nav-item"><a class="nav-link " href="informacioEncarrec.php">ENCARRECS</a></li>
							<li class="nav-item"><a class="nav-link " href="expirat.php">EXPIRATS</a></li>
						</ul>
					</nav>
					<?php
				} else {
					?>
						<nav class="navbar navbar-inverse" style="float: right;">
						<div class="container-fluid">
						<br><br><br><br>
						<ul class="nav nav-tabs">
							<li class="nav-item"><a class="nav-link " href="index.php">PRINCIPAL</a></li>
							<li class="nav-item"><a class="nav-link " href="loginClient.php">ACCEDEIX</a></li>
							<li class="nav-item"><a class="nav-link " href="registrar.php">REGISTRE</a></li>
							<li class="nav-item"><a class="nav-link " href="llibres.php">LLIBRES</a></li>
						</ul>
					</nav>
					<?php
				}
			?>
			
		</div>
	</nav>

		<br><br><br>

		<div class="wrapper2">
			<div>
				<h1 style="font-size: 15px; color:white; margin-left: 270px">Si tens qualsevol sugerència o dubte, envia'ns un comentari!</h1>
				<form style="" action="" method="post">
					<input class="form-control" type="text" name="comentari" placeholder="Envia'ns les teves sugerencies."><br>
					<input class="btn btn-dark" type="submit" name="submit" value="Comenta" style="width: 100px; height: 40px; margin-left: 420px">
				</form>
			</div>
			<br>
		<div class="scroll">
			<?php
			//Si apretem el botó del formulari...
				if(isset($_POST['submit'])){
					//Inserim a la taula de comentaris el missatge i l'usuari del compte que es troba conectat.
					$sql = "INSERT INTO `comentaris` VALUES('$_SESSION[login_user]','','$_POST[comentari]');";
					if(mysqli_query($db,$sql)){
						//Els comentaris seran ordenats per id, és a dir, els primers anirant avall i els més recents a la part superior.
						$q="SELECT * FROM `comentaris` ORDER BY `comentaris`.`id` DESC";
						$res = mysqli_query($db,$q);
						echo "<table class='table table-bordered'>";
						while($row = mysqli_fetch_assoc($res)){
							echo "<tr>";
								echo "<td>"; echo "$_SESSION[login_user]".":&nbsp"; echo $row['comentari']; echo "</td>";
							echo "</tr>";
						}
					}
				} else {
						$q="SELECT * FROM `comentaris` ORDER BY `comentaris`.`id` DESC";
						$res = mysqli_query($db,$q);
						echo "<table class='table table-bordered'>";
						while($row = mysqli_fetch_assoc($res)){
							echo "<tr>";
								echo "<td>"; echo $row['comentari']; echo "</td>";
							echo "</tr>";
						}
					}
			?>
		</div>
	</div>
</body>
</html>