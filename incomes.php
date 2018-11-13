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
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<title>Budżet - Dodaj przychód</title>
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
	
		<main>
		
			<article>
			
				<div class="article">
				
				<div class="container">
				
					<h2 class="title">Dodaj przychód</h2>
					
					<form action="action_incomes.php" method="post">
						<div id="window">
						
							<div class="row">
							
								<div class="col-sm-12 col-md-4">
										<label>Kwota (PLN):</label>
								</div>
								
								<div class="col-sm-12 col-md-8">
										<input type="amount" name="amount" 
										value=
											"<?php
												if (isset($_SESSION['amount'])) {
													echo $_SESSION['amount'];
													unset($_SESSION['amount']);
												}
											 ?>"/>
								
									<div class="err_log">
										<?php
											if(isset($_SESSION['e_amount'])) {
												echo $_SESSION['e_amount'];
												unset($_SESSION['e_amount']);
											}
										?>
									</div>
								</div>
										
										
								<div class="col-sm-12 col-md-4">
											<label>Data:</label>
								</div>
								
								<div class="col-sm-12 col-md-8">
									<input type="date" name="date"
									value=
										"<?php
											if (isset($_SESSION['date'])) {
												echo $_SESSION['date'];
												unset($_SESSION['date']);
											}
										 ?>"/>
										
										<div class="err_log">
										<?php
											if(isset($_SESSION['e_date'])) {
												echo $_SESSION['e_date'];
												unset($_SESSION['e_date']);
											}
										?>
										</div>
								</div>
										
								<div class="col-sm-12 col-md-4">
											<label>Kategoria:</label>
								</div>
								
								<div class="col-sm-12 col-md-8">
									<input type="text" list="category" name="category"
									value=
										"<?php
											if (isset($_SESSION['category'])) {
												echo $_SESSION['category'];
												unset($_SESSION['category']);
											}
										 ?>"/>
										 <datalist id="category">
										 
											<option value="Wynagrodzenie">
											<option value="Odsetki bankowe">
											<option value="Sprzedaż na allegro">
											<option value="Inne">
										 
										 </datalist>
										 
										 <div class="err_log">
										<?php
											if(isset($_SESSION['e_category'])) {
												echo $_SESSION['e_category'];
												unset($_SESSION['e_category']);
											}
										?>
										</div>
										 
								</div>
								
								<div class="col-sm-12 col-md-4">						
											<label>Komentarz:</label>
								</div>
								
								<div class="col-md-12 col-lg-8">
											<textarea name="comment" placeholder="Wprowadź komentarz..."
											></textarea>	
								</div>
										
										<div style="clear: both;"></div>
							</div>
						
						</div>
								<input type="submit" value="Dodaj">								
								<a href="Menu.php"><input type="button" value="Anuluj"></a>
								
					</form>
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