<?php
	include "connection.php";
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Perfil</title>
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
		.wrapper3{
			width: 400px;
			margin: 0 auto;
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
							<li class="nav-item"><a class="nav-link " href="informacioEncarrec.php">ENCARRECS</a></li>
							<li class="nav-item"><a class="nav-link " href="contacte.php">CONTACTA'NS</a></li>
						</ul>
					</nav>

					<?php
				} 
			?>
		</div>
	</nav>
	<div class="contenidor">
	<div class="wrapper3">
	<h2 style="text-align: center;">El meu perfil:</h2><br>
	<?php
	$q = mysqli_query($db,"SELECT * FROM client where username = '$_SESSION[login_user]';");
	$row = mysqli_fetch_assoc($q);
	echo "<div style='text-align: center;'>
	<img class='img-circle profile_img' height=110 width=120 src='imatges/".$_SESSION['foto']."'></div>";
	?>
	<br>
	<div style="text-align: center;"><b>Benvingut/da, </b>
	<?php
		echo $_SESSION['login_user'];
	?>
	</div>
	<br>
	<?php
		echo "<table class='table table-bordered'>"; 

		echo "<tr>";
			echo "<td>";
				echo "<b>Nom: &nbsp</b>";
			echo "</td>";
			echo "<td>";
				echo $row['primerNom'];
			echo "</td>";
		echo "</tr>";

		echo "<tr>";
			echo "<td>";
				echo "<b>Cognom: &nbsp</b>";
			echo "</td>";
			echo "<td>";
				echo $row['primerCognom'];
			echo "</td>";
		echo "</tr>";

		echo "<tr>";
			echo "<td>";
				echo "<b>Nom d'usuari: &nbsp</b>";
			echo "</td>";
			echo "<td>";
				echo $row['username'];
			echo "</td>";
		echo "</tr>";

		echo "<tr>";
			echo "<td>";
				echo "<b>Contrasenya: </b>";
			echo "</td>";
			echo "<td>";
				echo $row['password'];
			echo "</td>";
		echo "</tr>";

		echo "<tr>";
			echo "<td>";
				echo "<b>Correu electrònic: &nbsp</b>";
			echo "</td>";
			echo "<td>";
				echo $row['email'];
			echo "</td>";
		echo "</tr>";

		echo "<tr>";
			echo "<td>";
				echo "<b>ID d'usuari: </b>";
			echo "</td>";
			echo "<td>";
				echo $row['id'];
			echo "</td>";
		echo "</tr>";

		echo "</table>";
	?>
		<form action="" method="post">
		<button class="btn btn-dark" style="float:right; width:80px; margin-right:150px;" name="submit1">Editar</button>
	</form>
	<?php
	if(isset($_POST['submit1']))
 				{
 					?>
 						<script type="text/javascript">
 							window.location="editar.php"
 						</script>
 					<?php
 				}
 				 		$q=mysqli_query($db,"SELECT * FROM client where username='$_SESSION[login_user]' ;");
 				?>
</div>
</div>
</body>
</html>