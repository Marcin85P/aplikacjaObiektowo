<?php

	function setLastDate(){
		return date('Ymd');
	}
	
	function setFirstDate(){
		return date('Y');
	}

	session_start();
	
	if(!isset($_SESSION['login_user'])){	
		header('Location: index.php');
		exit();
	}
	
	$_SESSION['choice'] = true;
	
	$_SESSION['last_date'] = setLastDate();
	$_SESSION['first_day'] = setFirstDate();
	
	$_SESSION['score'] = "(bieżący rok)";
				
	header('Location:balanceView.php');