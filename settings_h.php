<?php
	
	session_start();
	
	if(!isset($_SESSION['login_user'])){	
		header('Location: index.php');
		exit();
	}
	
?>

<!DOCTYPE html>

<html lang="pl">
	<head>
		<meta charset="utf-8"/>
		<title>Budżet - Menu</title>
		<meta name="author" content="Marcin Piwowar"/>
		
		<meta http-equiv="X-Ua-Compatible" content="IE=edge,chrome=1">
		
		<link rel="stylesheet" href="hamburgerMenu.css" type="text/css" />
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"/>
		<link rel="stylesheet" href="main.css" type="text/css" />
		<link rel="stylesheet" href="css/fontello.css"/>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">
	</head>
	
<body>

	<div class="conteinerStyle">
	
		<header>
		
			<div class="logo">
				<h1>Budżet osobisty</h1>
				<?php echo "<p style='color:#f0f0f0; text-align:right; margin-right:15px; margin-bottom:2px'>Użytkownik: $_SESSION[user]</p>";?>
			</div>
			
			<nav class="page-navigation clearfix">
			
				<label class="navigation-toggle" for="input-toggle">
					<span></span>
					<span></span>
					<span></span>
				</label>
			
				<input type="checkbox" id="input-toggle">
				
				<ul class="menu">
					<li><a href="incomes.php">Dodaj przychód</a></li>
					<li><a href="expenses.php">Dodaj wydatek</a></li>
					<li><a href="balanceView.php">Przegląd bilansu</a></li>
					<li><a href="settings_h.php">Ustawienia</a></li>
					<li><a href='logout.php' class="logout">Wyloguj się</a></li>	
				</ul>
					
			</nav>
			
		</header>
	
		<div class="container" style="margin-top:60px">
				
			<br/>
			<br/>
			<label style="min-width: 240px; color:#79572d">Zmiana hasła:</label>

				<form method="post" action="settings.php">
					<div class="row">			
						<div class="col-md-12 col-lg-7">
							<div id="windowSetting">				
							
								<div class="row">
									<div class="col-md-9 col-lg-8">
										<input type="password"  name="pass_o" placeholder="Podaj stare hasło"/>
										<div class="err_log">
										<?php
											if(isset($_SESSION['e_pass2'])) {
												echo $_SESSION['e_pass2'];
												unset($_SESSION['e_pass2']);
											}
										?>
										</div>
									</div>
									
									<div class="col-md-9 col-lg-8">
										<input type="password"  name="pass_n" placeholder="Podaj nowe hasło"/>
										<div class="err_log">
										<?php
											if(isset($_SESSION['e_pass'])) {
												echo $_SESSION['e_pass'];
												unset($_SESSION['e_pass']);
											}
										?>
										</div>
					
									</div>
									
									<div class="col-md-3 col-lg-4">
										<input type="submit" style="min-width:120px; margin-top:0" value="Zmień">
									</div>
								</div>
										
							</div>
						</div>
					</div>
				</form>
			
		</div>
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