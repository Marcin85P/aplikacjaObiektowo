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
		<title>Budżet - Rejestracja</title>
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
			
			<form method="post" action="registrationaction.php">
				<div id="window">
					<div class="row1">
						
						<div class="col-12">
							<p class="word">REJESTRACJA</p>
						</div>	
						
						<div class="col-12">
							<input type="text" name="nick" placeholder="Login" 
							value=
							"<?php
								if (isset($_SESSION['fr_nick'])) {
									echo $_SESSION['fr_nick'];
									unset($_SESSION['fr_nick']);
								}
							 ?>"/>
								<div class="err_log">
								<?php
									if(isset($_SESSION['e_nick'])) {
										echo $_SESSION['e_nick'];
										unset($_SESSION['e_nick']);
									}
								?>
								</div>
						</div>	
						
						<div class="col-12">
							<input type="password" name="pass1" placeholder="Hasło"/>
								<div class="err_log">
									<?php
										if(isset($_SESSION['e_pass'])) {
											echo $_SESSION['e_pass'];
											unset($_SESSION['e_pass']);
										}
									?>
								</div>
						</div>
						
						<div class="col-12">
							<input type="password" name="pass2" placeholder="Powtórz hasło"/>
								<div class="err_log">
									<?php
										if(isset($_SESSION['e_pass2'])) {
											echo $_SESSION['e_pass2'];
											unset($_SESSION['e_pass2']);
										}
									?>
								</div>
						</div>
					</div>
					
					<div class="row1">
						<div class="col-12">
							<input type="submit" value="Zarejestruj się!">
						</div>
					</div>
					
					<div class='reg'>
					<a href="index.php">Powrót do strony logowania.</a>
				</div>
					
				</div>
				
			</form>
		</div>
		
				
		<footer id="footer">		
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
			
			<div class="info">		
				Wszelkie prawa zastrzeżone &copy 2018		
			</div>
		</footer>
	
	</body>
</html>