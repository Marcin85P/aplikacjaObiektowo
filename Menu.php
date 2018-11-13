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
				<?php echo "<p style='color:white; text-align:right; margin-right:15px; margin-bottom:2px'>Użytkownik: $_SESSION[user]</p>";?>
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
	
		<main>
		
			<article>
			
				<div class="con">
				
					<div class="article">
					
					<?php
						if(isset($_SESSION['incomes_OK'])){
							echo "<p>Twój przychód został dodany pomyślnie!</p>";
							echo "<a href='Menu.php'><input type='button' value='OK'></a>";
							unset($_SESSION['incomes_OK']);
						}
						else if(isset($_SESSION['expenses_OK'])){
							echo "<p>Twój wydatek został dodany pomyślnie!</p>";
							echo "<a href='Menu.php'><input type='button' value='OK'></a>";
							unset($_SESSION['expenses_OK']);
						}
						else if(isset($_SESSION['update_password_successful'])){
							echo "<p>Twoje hasło zostało zmienione!</p>";
							echo "<a href='Menu.php'><input type='button' value='OK'></a>";
							unset($_SESSION['update_password_successful']);
						}
						else if(isset($_SESSION['update_email_successful'])){
							echo "<p>Twój e-mail został zmieniony!</p>";
							echo "<a href='Menu.php'><input type='button' value='OK'></a>";
							unset($_SESSION['update_email_successful']);
						}
						else{
							echo "<h2 style='font-variant:small-caps; letter-spacing:3px; margin-bottom:20px'>Kontroluj swój budżet osobisty</h2>
							<p>Strona, która pomaga kontrolować Twoje wydatki. Przeglądaj swój bilans i sprawdź czy w ostatnim czasie zaoszczędziłeś czy się zadłużyłeś.</p>";
						}
					?>
					
					</div>
					
				</div>
				
			</article>
			
		</main>
		
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