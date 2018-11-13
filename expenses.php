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
		<title>Budżet - Dodaj wydatek</title>
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
	
		<article>
		
			<div class="article">
			
				<div class="container">
					<h2 class="title">Dodaj wydatek</h2>
				
				<form action="action_expenses.php" method="post">
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
								<label>Sposób płatności:</label>
							</div>
							
							<div class="col-sm-12 col-md-8">
								<input type="text" name="payment_methods" list="payment"
								value=
								"<?php
									if (isset($_SESSION['payment_methods'])) {
										echo $_SESSION['payment_methods'];
										unset($_SESSION['payment_methods']);
									}
								 ?>"/>
								 
									 <datalist id="payment">
									 
										<option value="Gotówka">
										<option value="Karta debetowa">
										<option value="Karta kredytowa">
									 </datalist>
									 
								<div class="err_log">
								<?php
									if(isset($_SESSION['e_payment_methods'])) {
										echo $_SESSION['e_payment_methods'];
										unset($_SESSION['e_payment_methods']);
									}
								?>
								</div>
							</div>
								
							<div class="col-sm-12 col-md-4">
									<label>Kategoria:</label>
							</div>
							
							<div class="col-sm-12 col-md-8">
								<input type="text" name="category" list="category"
								value=
								"<?php
									if (isset($_SESSION['category_expenses'])) {
										echo $_SESSION['category_expenses'];
										unset($_SESSION['category_expenses']);
									}
								 ?>"/>
								 
									 <datalist id="category">
									 
										<option value="Jedzenie">
										<option value="Mieszkanie">
										<option value="Transport">
										<option value="Telekomunikacja">
										<option value="Opieka zdrowotna">
										<option value="Ubranie">
										<option value="Higiena">
										<option value="Dzieci">
										<option value="Rozrywka">
										<option value="Wycieczka">
										<option value="Szkolenia">
										<option value="Ksiażki">
										<option value="Oszczędności">
										<option value="Na złotą jesień (emerytura)">
										<option value="Spłata długów">
										<option value="Darowizna">
										<option value="Inne wydatki">
									 
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
								><?php
										if (isset($_SESSION['comment'])) {
											echo $_SESSION['comment'];
											unset($_SESSION['comment']);
										}
									 ?></textarea>	
							</div>
							
						</div>
						
					</div>
				
						<input type="submit"value="Dodaj">
						<a href="Menu.php"><input type="button" value="Anuluj"></a>
				</form>
				
				</div>
			
			</div>
		
		</article>
	
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