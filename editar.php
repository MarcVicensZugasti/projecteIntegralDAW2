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
		.form-control
		{
			width:250px;
			height: 38px;
		}
		.form1
		{
			margin: 0 850px;
		}
		label
		{
			color: black;
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
	<br>
	<div style="text-align: center;"><b>Benvingut/da, </b>
	<?php
		echo $_SESSION['login_user'];
	?>
	</div>
	<?php
		//Seleccionarem totes les dades de l'usuari que es troba conectat per a que les visualitzi abans de canviar-les.
		$sql = "SELECT * FROM client WHERE username='$_SESSION[login_user]'";
		$result = mysqli_query($db,$sql) or die (mysql_error());
		while ($row = mysqli_fetch_assoc($result)) {
			$primerNom=$row['primerNom'];
			$primerCognom=$row['primerCognom'];
			$username=$row['username'];
			$password=$row['password'];
			$email=$row['email'];
			$foto=$row['foto'];
		}

	?>
	<div class="form1">
		<br>
		<form action="" method="post" enctype="multipart/form-data">

		<label><h5>Nom: </h5></label>
		<input class="form-control" type="text" name="primerNom" value="<?php echo $primerNom; ?>">
		<br>
		<label><h5>Cognom:</h5></label>
		<input class="form-control" type="text" name="primerCognom" value="<?php echo $primerCognom; ?>">
		<br>
		<label><h5>Usuari</h5></label>
		<input class="form-control" type="text" name="username" value="<?php echo $username; ?>">
		<br>
		<label><h5>Contrasenya</h5></label>
		<input class="form-control" type="text" name="password" value="<?php echo $password; ?>">
		<br>
		<label><h5>Correu:</h5></label>
		<input class="form-control" type="text" name="email" value="<?php echo $email; ?>">
		<br>
		<label><h5>Fotografia:</h5></label>
		<input class="form-control" type="file" name="foto" value="<?php echo $foto; ?>">

		<br>
		<div style="padding-left: 80px;">
			<button class="btn btn-warning" type="submit" name="submit">Guardar</button></div>
	</form>
</div>	
<?php
if(isset($_POST['submit']))
		{
			//La fotografia seleccionada com a nou avatar, serà inclosa a la carpeta imatges del projecte, així també la posarem com avatar a la part superior dreta. (si no concorden bé els colors, pot ser que no es visualitzi.)
			move_uploaded_file($_FILES['foto']['tmp_name'],"imatges/".$_FILES['foto']['name']);

			$primerNom=$_POST['primerNom'];
			$primerCognom=$_POST['primerCognom'];
			$username=$_POST['username'];
			$password=$_POST['password'];
			$email=$_POST['email'];
			$foto=$_FILES['foto']['name'];

			$sql1= "UPDATE client SET foto='$foto', primerNom='$primerNom', primerCognom='$primerCognom', username='$username', password='$password', email='$email' WHERE username='".$_SESSION['login_user']."';";

			if(mysqli_query($db,$sql1))
			{
				?>
					<script type="text/javascript">
						alert("Guardat.");
						window.location="perfil.php";
					</script>
				<?php
			}
		}
 	?>
</body>
</html>		