<?php
	include "connection.php";
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Expirats</title>
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
		.btn-success{
			margin-left: 200px;
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
							<li class="nav-item"><a class="nav-link " href="logout.php">SURT</a></li>
							<li class="nav-item"><a class="nav-link " href="llibres.php">LLIBRES</a></li>
							<li class="nav-item"><a class="nav-link " href="informacioEncarrec.php">ENCARRECS</a></li>
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
	</nav><br>
					<div class="srch">
						<form method="post" action="" name="form1">
							<input style="width: 300px; margin-left: 85px;" type="text" name="username" class="form-control" placeholder="Usuari" required=""><br>
							<input style="width: 300px; margin-left: 85px;" type="text" name="llibreID" class="form-control" placeholder="ID Llibre" required=""><br>
							<button class="btn btn-success" name="submit" type="submit">Entregar</button><br><br>
						</form>
					</div>
					<p style="margin-right: 0 auto; margin">Els usuaris que marquin un llibre expirat com a retornat sense haver-lo tornat, seran multats per part de la Biblioteca Online.</p>
					<?php
					if(isset($_POST['submit'])){
						//Un cop apretat el botó, el llibre serà marcat com a retornat, augmentant així la quantitat a la llista de llibres.
						$var1 = '<p style="color:yellow;background-color:green;">RETORNAT</p>';
						mysqli_query($db,"UPDATE encarrecs SET Aprovació = '$var1' where username='$_POST[username]' and llibreID='$_POST[llibreID]'");
						mysqli_query($db,"UPDATE llibres SET quantitat = quantitat + 1 where llibreID = $_POST[llibreID]");
					}

	$c = 0;
	if(isset($_SESSION['login_user'])){
		//Tots els llibres encarregats tindran una condicio Sí, que canviarà a Retornat o Expirat depenent del que passi.
			$sql="SELECT client.username,email,llibres.llibreID,nom,autor,editorial,encarrecs.dataEncarrec,dataRetorn,Aprovació
			FROM client
			INNER JOIN encarrecs ON client.username = encarrecs.username
			INNER JOIN llibres ON encarrecs.llibreID = llibres.llibreID
			WHERE encarrecs.Aprovació !='' and encarrecs.Aprovació !='Sí' ORDER BY `encarrecs`.`dataRetorn` ASC";
			$res = mysqli_query($db,$sql);

			echo "<table class='table table-bordered table-hover' >";
			echo "<tr style='background-color: #6db6b9e6;'>";
				echo "<th>"; echo "Data inici";  echo "</th>";
				echo "<th>"; echo "Data final";  echo "</th>";
				echo "<th>"; echo "ID Llibre";  echo "</th>";
				echo "<th>"; echo "Títol";  echo "</th>";
				echo "<th>"; echo "Autor";  echo "</th>";
				echo "<th>"; echo "Editorial";  echo "</th>";
				echo "<th>"; echo "Estat";  echo "</th>";
				
			echo "</tr>";	

			while($row=mysqli_fetch_assoc($res)){

				echo "<tr>";
				echo "<td>"; echo $row['dataEncarrec']; echo "</td>";
				echo "<td>"; echo $row['dataRetorn']; echo "</td>";
				echo "<td>"; echo $row['llibreID']; echo "</td>";
				echo "<td>"; echo $row['nom']; echo "</td>";
				echo "<td>"; echo $row['autor']; echo "</td>";
				echo "<td>"; echo $row['editorial']; echo "</td>";
				echo "<td>"; echo $row['Aprovació']; echo "</td>";

				
				echo "</tr>";
			}
		echo "</table>";

			
		} else {
			echo "</br></br></br>"; 
			echo "<h2><b>";
			echo "Sisplau, accedeix al compte per poder veure els encàrrecs.";
			echo "</b></h2>";
		}
		?>
</body>
</html>