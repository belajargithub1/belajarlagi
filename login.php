<?php
session_start();
if(isset($_SESSION['email'])) {
	header('location:tampil.php');
}

require 'Classes/Login_controller.php';
session_start();

if(isset($_POST["submit"])) {
	$login = new Login_controller;
	$email    = htmlentities($_POST["email"]);
	$password = htmlentities($_POST["password"]);

	if(!empty($_POST["remember"])) {
		$remember = $_POST["remember"];
	}
	else {
		$remember = NULL;
	}

	$login->getData($email,$password,$remember);
}
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Login Here</title>
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-primary">
	<div class="container">
		<div class="row justify-content-center" style="margin-top: 100px;">
			<div class="col-4">
				<h1 class="text-center text-light">Login Here!</h1>
				<?php
				if(isset($_POST["submit"])) {
					echo "<div class='alert alert-danger'>$login->message</div>";
				}
				if(isset($_GET["pesan"])) {
					echo "<div class='alert alert-info'>".$_GET['pesan']."</div>";
				}
				 ?>
				<form method="post" action="login.php" id="formlogin">
					<div class="form-group">
						<p><input type="text" name="email" placeholder="Email" class="form-control mb-3" id="email" value="<?php echo $_COOKIE['email'] ?>"><span id="emailspan"></span></p>
					</div>

					<div class="form-group">
						<p><input type="password" name="password" placeholder="Password" class="form-control mb-3" id="password" value="<?php echo $_COOKIE['password'] ?>"><span id="passwordspan"></span></p>
					</div>

					<div class="form-check">
						<p><input type="checkbox" name="remember" class="form-check-input" id="remember">
						<label class="form-check-label" for="remember">Remember Me</label><span id="rememberspan"></span></p>
					</div>

					<input type="submit" name="submit" value="Login" class="btn btn-outline-light btn-block">
					<a href="register.php" class="btn btn-danger btn-block">Register</a>
				</form>
			</div>
		</div>
	</div>

	<script src="assets/Js/bootstrap.min.js"></script>
	<script src="assets/Js/jquery-3.3.1.min.js"></script>
	<script src="assets/Js/validasi_login.js"></script>
</body>
</html>
