<?php
	
	session_start();
	
	require_once "question.php";
	require_once "balanceViewAction.php";
	
	if(!isset($_SESSION['login_user'])){	
		header('Location: index.php');
		exit();
	}
	
?>

<!DOCTYPE html>

<html lang="pl">
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		
		<title>Budżet - Przegląd bilansu</title>
		<meta name="author" content="Marcin Piwowar"/>
		
		<meta http-equiv="X-Ua-Compatible" content="IE=edge,chrome=1">
		
		<link rel="stylesheet" href="hamburgerMenu.css" type="text/css" />
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"/>
		<link rel="stylesheet" href="main.css" type="text/css" />
		<link rel="stylesheet" href="css/fontello.css"/>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>		
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

		<div class="D-menu">
				
			<div id="buttonSticky">
			
				<button id="item">Okres</button>	
				
				<div id="submenu">
					<a href="balanceView.php">Bieżący miesiąc</a>
					<a href="previous_month_action.php">Poprzedni miesiąc</a>
					<a href="current_year_action.php">Bieżący rok</a>
					<a href="custom.php">Niestandardowy</a>
				</div>		
					
			</div>
									
		</div>
				
		<div style="clear: both;"></div>
		
		<div class="container">
		
			<div class="row">
			
					<div class="col-lg-7 col-md-12">
			
					<div id="table">
					
						<div class="table-responsive">
						
							<table class="tb">

								<thead>
								
								<tr>
									<th colspan="4" class="tableTitle">Przychody
									<?php 
									if(isset($_SESSION['score'])){
										echo " ".$_SESSION['score'];
									}
									?>
									</th>
								</tr>
								
								<tr>
									<th class="date3">Data</th>
									<th class="category1">Kategoria</th>
									<th class="amount2">Kwota (PLN)</th>
									<th class="comment4">Komentarz</th>
									
								</tr>
								</thead>
								
								<tbody>

	<?php 
		$action = new Tabels();
		$connect = $action->connect();
		$action->tableView(askAQuestionIncome(), "incomes", $connect);
	?>

								<tr>
									<th class="sum">Suma</th>
									<td style="background-color: #db8534" class="position"></td>
									<th style="font-size:17px" class="position"><?php if(isset($_SESSION['suma_k'])) {echo number_format($_SESSION['suma_k'], 2);} ?></th>
									<td style="background-color: #db8534" class="position"></td>
								</tr>
								
								</tbody>
								
							</table>
							
						</div>
						
					</div>
					
					</div>
					
					<div class="col-lg-5 col-md-12">
					
						<div class="diagram">
							
							<canvas id="ChartIncomes" width="300" height="250"></canvas>
							<?php 
								if($_SESSION['suma_k'] != 0) {
									echo "<script src='diagramIncomes.js'></script>";
								}
								
								unset($_SESSION['suma_k']);
							?>
							
						</div>
					
					</div>
					
					<div style="clear: both;"></div>
				
					<div class="col-lg-7 col-md-12">
					
					<div id="table">
					
						<div class="table-responsive">
						
							<table class="tb">

								<thead>
								
									<tr>
										<th colspan="4" class="tableTitle">Wydatki
										<?php 
										if(isset($_SESSION['score'])){
											echo " ".$_SESSION['score'];
											unset($_SESSION['score']);
										}
										?>
										</th>
									</tr>
									
									<tr>
										<th class="date3">Data</th>
										<th class="category1">Kategoria</th>
										<th class="amount2">Kwota (PLN)</th>
										<th class="comment4">Komentarz</th>
									</tr>
									
								</thead>
								
								<tbody>
								
	<?php 
		$action = new Tabels();
		$connect = $action->connect();
		$action->tableView(askAQuestionExpense(), "expenses", $connect); 
	?>							
	
									<tr>
									<th class="sum">Suma</th>
									<td style="background-color: #db8534" class="position"></td>
									<th style="font-size:17px" class="position"><?php if(isset($_SESSION['suma_k'])) {echo number_format($_SESSION['suma_k'], 2);} ?></th>
									<td style="background-color:#db8534" class="position"></td>
								</tr>
								
								</tbody>
								
							</table>
							
						</div>
						
					</div>
					
					</div>
					
					<div class="col-lg-5 col-md-12">
			
						<div class="diagram">
						
							<canvas id="ChartExpenses" width="300" height="250"></canvas>
							<?php 
								if($_SESSION['suma_k'] != 0) {
									echo "<script src='diagramExpenses.js'></script>";
								}
								
								unset($_SESSION['suma_k']);
							?>
						
						</div>
					
					</div>
						
						<div style="clear: both;"></div>
			</div>
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
	
	<script src="jquery-3.3.1.min.js"></script>
	
	<script>

	$(document).ready(function() {
		var NavY = $('.D-menu').offset().top;
	 
	var stickyNav = function(){
		var ScrollY = $(window).scrollTop();
			  
		if (ScrollY > NavY) { 
			$('.D-menu').addClass('sticky');
		} else {
			$('.D-menu').removeClass('sticky'); 
		}
	};
	 
	stickyNav();
	 
		$(window).scroll(function() {
			stickyNav();
		});
	});
	
	</script>
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

	<script src="bootstrap/js/bootstrap.min.js"></script>
	
</body>

</html>