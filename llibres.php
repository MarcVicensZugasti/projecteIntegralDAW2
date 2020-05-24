<?php
	include "connection.php";
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Llibres</title>
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
		.srch{
			padding-left: 1400px;
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
									echo "<img class='img-circle profile_img' height=30 width=30 color=white src='imatges/".$_SESSION['foto']."'>"; 
									echo "&nbsp".$_SESSION['login_user'];
								?>
							</a>
							</li>
							<li class="nav-item"><a class="nav-link " href="index.php">PRINCIPAL</a></li>
							<li class="nav-item"><a class="nav-link " href="informacioEncarrec.php">ENCARRECS</a></li>
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
							<li class="nav-item"><a class="nav-link " href="loginClient.php">ACCEDEIX</a></li>
							<li class="nav-item"><a class="nav-link " href="registrar.php">REGISTRE</a></li>
							<li class="nav-item"><a class="nav-link " href="contacte.php">CONTACTA'NS</a></li>
						</ul>
					</nav>
					<?php
				}
			?>
			
		</div>
	</nav>
	<div class="srch">
		<form class="navbar-form" method="post" name="form1">
			<input class="btn btn-light" type="submit" name="submit1" value="Demana" style="height: 40px; width: 100px; float: right;">
			<input style="width: 200px; float: right;" class="form-control" type="text" name="llibreID" placeholder="ID del llibre" required="">
		</form>
	</div>
	<br><br>
	<div>
		<form class="navbar-form" method="post" name="form1">
			<input class="btn btn-light" type="submit" name="submit2" value="Cerca" style="height: 40px; width: 100px; float: right;">
			<input style="width: 200px; float: right;" class="form-control" type="text" name="ISBN" placeholder="ISBN del llibre" required="">
		</form>
	</div>
	<h2>Llistat de llibres</h2>
	<?php
		$var2 = '<p>Sí</p>';
		date_default_timezone_set('Europe/Madrid');
		$date = date('Y-m-d', time());
		$_POST['date'] = $date;
		$date2 = date('Y-m-d', strtotime($date." + 30 days"));
		$_POST['date2'] = $date2;
		$res = mysqli_query($db,"SELECT * FROM `llibres`;");

	if(isset($_POST['submit2'])){
		if(isset($_SESSION['login_user'])){
			$seleccionat = mysqli_query($db,"SELECT * FROM `llibres` where ISBN = $_POST[ISBN];");
			while($row = mysqli_fetch_assoc($seleccionat)){
				echo "<table class='table table-bordered'>";
				echo "<tr style='background-color: #804000;'>";
					echo "<th>"; echo "ID";	echo "</th>";
					echo "<th>"; echo "Títol";	echo "</th>";
					echo "<th>"; echo "ISBN";	echo "</th>";
					echo "<th>"; echo "Autor";	echo "</th>";
					echo "<th>"; echo "Editorial";	echo "</th>";
					echo "<th>"; echo "Estat";	echo "</th>";
					echo "<th>"; echo "Quantitat";	echo "</th>";
					echo "<th>"; echo "Gèneres";	echo "</th>";
					echo "<th>"; echo "Disponibilitat";	echo "</th>";
				echo "</tr>";
				echo "<tr>";
					echo "<td>"; echo $row['llibreID']; echo "</td>";
					echo "<td>"; echo $row['nom']; echo "</td>";
					echo "<td>"; echo $row['ISBN']; echo "</td>";
					echo "<td>"; echo $row['autor']; echo "</td>";
					echo "<td>"; echo $row['editorial']; echo "</td>";
					echo "<td>"; echo $row['estat']; echo "</td>";
					echo "<td>"; echo $row['quantitat']; echo "</td>";
					echo "<td>"; echo $row['gèneres']; echo "</td>";
					echo "<td>"; echo $row['aprovacio']; echo "</td>";
				echo "</tr>";
			}
			echo "</table>";
		} else {
			?>
				<script type="text/javascript">
					alert("Has d'entrar al compte per poder buscar un llibre.");
				</script>
			<?php
		}
	}
	
	echo "<table class='table table-bordered table-hover'>";
	echo "<tr style='background-color: #804000;'>";
		echo "<th>"; echo "ID";	echo "</th>";
		echo "<th>"; echo "Títol";	echo "</th>";
		echo "<th>"; echo "ISBN";	echo "</th>";
		echo "<th>"; echo "Autor";	echo "</th>";
		echo "<th>"; echo "Editorial";	echo "</th>";
		echo "<th>"; echo "Estat";	echo "</th>";
		echo "<th>"; echo "Quantitat";	echo "</th>";
		echo "<th>"; echo "Gèneres";	echo "</th>";
		echo "<th>"; echo "Disponibilitat";	echo "</th>";
	echo "</tr>";

	while($row = mysqli_fetch_assoc($res)){
		echo "<tr>";
		echo "<td>"; echo $row['llibreID']; echo "</td>";
		echo "<td>"; echo $row['nom']; echo "</td>";
		echo "<td>"; echo $row['ISBN']; echo "</td>";
		echo "<td>"; echo $row['autor']; echo "</td>";
		echo "<td>"; echo $row['editorial']; echo "</td>";
		echo "<td>"; echo $row['estat']; echo "</td>";
		echo "<td>"; echo $row['quantitat']; echo "</td>";
		echo "<td>"; echo $row['gèneres']; echo "</td>";
		echo "<td>"; echo $row['aprovacio']; echo "</td>";
		echo "</tr>";
	}
	echo "</table>";
	if(isset($_POST['submit1'])){
		if(isset($_SESSION['login_user'])){
			mysqli_query($db,"INSERT INTO encarrecs Values('','$_SESSION[login_user]','$_POST[llibreID]','','Sí','$_POST[date]','$_POST[date2]');");
			mysqli_query($db,"UPDATE llibres SET quantitat = quantitat - 1 where llibreID = $_POST[llibreID]");
			?>
				<script type="text/javascript">
					window.location = "informacioEncarrec.php";
				</script>
			<?php
		} else {
			?>
				<script type="text/javascript">
					alert("Has d'entrar al compte per poder realitzar un encàrrec.");
				</script>
			<?php
		}
	}

	/*if(isset($_POST['submit2'])){
		if(isset($_SESSION['login_user'])){
			$seleccionat = mysqli_query($db,"SELECT * FROM `llibres` where ISBN = $_POST[ISBN];");
			while($row = mysqli_fetch_assoc($seleccionat)){
				echo "<table class='table table-bordered'>";
				echo "<tr style='background-color: #804000;'>";
					echo "<th>"; echo "ID";	echo "</th>";
					echo "<th>"; echo "Títol";	echo "</th>";
					echo "<th>"; echo "ISBN";	echo "</th>";
					echo "<th>"; echo "Autor";	echo "</th>";
					echo "<th>"; echo "Editorial";	echo "</th>";
					echo "<th>"; echo "Estat";	echo "</th>";
					echo "<th>"; echo "Quantitat";	echo "</th>";
					echo "<th>"; echo "Gèneres";	echo "</th>";
					echo "<th>"; echo "Disponibilitat";	echo "</th>";
				echo "</tr>";
				echo "<tr>";
					echo "<td>"; echo $row['llibreID']; echo "</td>";
					echo "<td>"; echo $row['nom']; echo "</td>";
					echo "<td>"; echo $row['ISBN']; echo "</td>";
					echo "<td>"; echo $row['autor']; echo "</td>";
					echo "<td>"; echo $row['editorial']; echo "</td>";
					echo "<td>"; echo $row['estat']; echo "</td>";
					echo "<td>"; echo $row['quantitat']; echo "</td>";
					echo "<td>"; echo $row['gèneres']; echo "</td>";
					echo "<td>"; echo $row['aprovacio']; echo "</td>";
				echo "</tr>";
			}
			echo "</table>";
		} else {
			?>
				<script type="text/javascript">
					alert("Has d'entrar al compte per poder buscar un llibre.");
				</script>
			<?php
		}
	}*/
	?>

</body>
</html>