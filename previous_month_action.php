<?php

	function setFirstDate(){
		$date = date('Ym01');
		$date = $date - 100;
		return $date;
	}

	function setLastDate(){
		$date = date('Ym01');
		$date = $date - 1;
		return $date;
	}

	session_start();
	
	if(!isset($_SESSION['login_user'])){	
		header('Location: index.php');
		exit();
	}
	
	$_SESSION['choice'] = true;
	
	$_SESSION['first_day'] = setFirstDate();
	$_SESSION['last_date'] = setLastDate();
	
	$_SESSION['score'] = "(poprzedni miesiąc)";
				
	header('Location:balanceView.php');
