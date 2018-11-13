<?php

	session_start();

	if(isset($_SESSION['login_user'])){
		header('Location: Menu.php');
		exit();
	}
?>

<!DOCTYPE html>

<html lang="pl">
	<head>
		<meta charset="utf-8"/>
		<title>Budżet - Logowanie</title>
		<meta name="author" content="Marcin Piwowar"/>
		
		<meta http-equiv="X-Ua-Compatible" content="IE=edge,chrome=1">
		
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"/>
		<link rel="stylesheet" href="style.css" type="text/css" />
		<link rel="stylesheet" href="css/fontello.css"/>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">
		
	</head>
	
<body>
	<div class="conteinerStyle">
	
		<div class="logo">
			<h1>Budżet osobisty</h1>
		</div>

		<form action="login.php" method="post">
			<div id="window">

				<div class="row1">
					<div class="col-12">
						<p class="word">LOGOWANIE</p>
					</div>
					<div class="col-12">
						<input type="text" name="log" placeholder="Login" 
						value=
							"<?php
								if (isset($_SESSION['login'])) {
									echo $_SESSION['login'];
									unset($_SESSION['login']);
								}
							 ?>"/>
					</div>
						
					<div class="col-12">
						<input type="password" name="loginpassword" placeholder="Hasło"/>
					</div>
				</div>
				
				<div class="err_log">Nieprawidłowy login lub hasło!</div>
				
				<div class="row1">
					<div class="col-12">
						<input type="submit" value="Zaloguj">
					</div>
				</div>

				<div class='reg'>
						<h6>Nie masz jeszcze konta?</h6>
						<a href='registration.php'>Zarejestruj się!</a>
				</div>
				
			</div>
		</form>
		
	</div>
	
	<footer id="footer">

		<div class="container">
		
			<div class="row">
			
				<div class="col-4">
					<div class="fb">
						<i class="icon-facebook"></i> 
					</div>
				</div>
				
				<div class="col-4">	
					<div class="yt">
						<i class="icon-youtube"></i> 
					</div>
				</div>
				
				<div class="col-4">
					<div class="tw">
						<i class="icon-twitter"></i> 
					</div>
				</div>
				
			</div>
			
		</div>
	
		<div class="info">	
			Wszelkie prawa zastrzeżone &copy 2018
		</div>

	</footer>

</body>

</html>