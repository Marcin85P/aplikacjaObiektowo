<?php

	function setActualDate(){
		$_SESSION['last_date'] = date('Ymd');
		$_SESSION['first_day'] = date('Ym01');
		$_SESSION['score'] = '(bieżący miesiąc)';
	}

	function setDate($firstD, $lastD){
		$_SESSION['last_date'] = str_replace('-', '', $lastD);
		$_SESSION['first_day'] = str_replace('-', '', $firstD);
		
		if((empty($_SESSION['first_day'])) || (empty($_SESSION['last_date']))) {
			$_SESSION['e_input'] = "<span style='color:red'>Ustaw datę!</span>";
			setActualDate();
			header('Location: custom.php');
			exit();
		}
		
		if($_SESSION['first_day'] > $_SESSION['last_date']) {
			$_SESSION['first_day'] = str_replace('-', '', $lastD);
			$_SESSION['last_date'] = str_replace('-', '', $firstD);
			$_SESSION['score'] = "(od ".$lastD." do ".$firstD.")";
		}
		else{
			$_SESSION['score'] = "(od ".$firstD." do ".$lastD.")";
		}
	}

	session_start();
	
	if(!isset($_SESSION['login_user'])){	
		header('Location: index.php');
		exit();
	}

	$_SESSION['choice'] = true;
	
	setDate($_POST['custom_input_1'], $_POST['custom_input_2']);
				
	header('Location:balanceView.php');
