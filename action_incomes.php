<?php

	class Variables {
		private $_amount;
		private $_date;
		private $_category;
		private $_comment;
		
		function setAmount($amount) 			{$this->_amount = $amount;}
		function setEnteredDate($date) 		{$this->_date = $date;}
		function setCategory($category) 		{$this->_category = $category;}
		function setComment($comment) 		{$this->_comment = $comment;}
		
		function getAmount()						{return $this->_amount;}
		function getEnteredDate()					{return $this->_date;}
		function getCategory()						{return $this->_category;}
		function getComment()						{return $this->_comment;}
	}

	class Incomes extends Variables{		
		function checkAmount(){
			$amount = $this->getAmount();
			
			if(empty($amount)) {
				$_SESSION['e_amount'] = "Podaj kwotę przychodu!";
				return false;
			}
			else if(!is_numeric($amount)){
				$_SESSION['e_amount'] = "Podana wartość musi być liczbą!";
				return false;
			}
			else {
				$_SESSION['amount'] = $amount;
				return true;
			}
		}
		
		function checkEnteredDate(){
			$date = $this->getEnteredDate();
			
			if(empty($date)){
				$_SESSION['e_date'] = "Ustaw datę przychodu!";
				return false;
			}
			else {
				$_SESSION['date'] = $date;
				return true;
			}
		}
		
		function checkCategory(){
			$category = $this->getCategory();
			
			$category = mb_strtolower($category, 'UTF-8');
			
			if(empty($category)){
				$_SESSION['e_category'] = "Podaj kategorię przychodu!";
				return false;
			} else {
				$_SESSION['category'] = $category;
				return true;
			}
		}

		function addIncomesFunction(){
			$amount = $this->getAmount();
			$date = $this->getEnteredDate();
			$category = $this->getCategory();
			$comment = $this->getComment();
			
			if(empty($comment)){
				$comment = "";
			}
			
			require_once "connect.php";
			
			$connect = new mysqli($host, $db_user, $db_password, $db_name);
			
			if($connect->connect_errno!=0){
				return 1;
			}
			
			else {
				$connect -> query ('SET NAMES utf8');
				$connect -> query ('SET CHARACTER_SET utf8_unicode_ci');
				
				$result = $connect->query("SELECT id FROM incomes_category_assigned_to_users WHERE name = '$category' AND user_id = $_SESSION[id]");
				$num = $result->num_rows;
				
				if($num<=0) {
					$result->close;
					$connect->query("INSERT INTO incomes_category_assigned_to_users VALUES (NULL, $_SESSION[id], '$category')");
					$result = $connect->query("SELECT id FROM incomes_category_assigned_to_users WHERE name = '$category' AND user_id = $_SESSION[id]");
				}
					
				$line = $result->fetch_assoc();
				
				if ($connect->query ("INSERT INTO incomes VALUES (NULL, $_SESSION[id], $line[id], '$amount', '$date', '$comment')")) {

					unset($_SESSION['amount']);
					unset($_SESSION['date']);
					unset($_SESSION['category']);
					unset($_SESSION['comment']);
					
					$result->close();
					$_SESSION['incomes_OK'] = true;
					return 0;
				}
				else {
					if(!$result) return 1;
				}				
				$connect->close();
			}			
		}
	}

	session_start();
	
	if(!isset($_POST['amount'])){	
		header('Location: Menu.php');
		exit();
	}
	
	$nrCaseIncomes = new Incomes();
	
	$_POST['amount'] = str_replace(",",".",$_POST['amount']);
	$nrCaseIncomes->setAmount($_POST["amount"]);
	$nrCaseIncomes->setEnteredDate($_POST["date"]);
	$nrCaseIncomes->setCategory($_POST["category"]);
	$nrCaseIncomes->setComment($_POST["comment"]);
	
	$amountTrue = $nrCaseIncomes->checkAmount();
	$dateTrue = $nrCaseIncomes->checkEnteredDate();
	$categoryTrue = $nrCaseIncomes->checkCategory();

	if($amountTrue == true && $dateTrue == true && $categoryTrue == true){
		$nrCaseIncomes->addIncomesFunction();
	} else $nrCaseIncomes = 2;
	
	switch($nrCaseIncomes){
		case 0 : header('Location:Menu.php');break;
		case 1 : header('Location:error_server.php');break;
		case 2 : header('Location:incomes.php');break;
		default : header('Location:error_server.php');
	}

?>