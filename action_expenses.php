<?php
	
	class Variables {
		private $_amount;
		private $_date;
		private $_payment_methods;
		private $_category;
		private $_comment;
		
		function setAmount($amount) 										{$this->_amount = $amount;}
		function setEnteredDate($date) 									{$this->_date = $date;}
		function setPaymentMethods($payment_methods)			{$this->_payment_methods =$payment_methods;}
		function setCategory($category) 									{$this->_category = $category;}
		function setComment($comment) 								{$this->_comment = $comment;}
		
		function getAmount()													{return $this->_amount;}
		function getEnteredDate()											{return $this->_date;}
		function getPaymentMethods()										{return $this->_payment_methods;}
		function getCategory()												{return $this->_category;}
		function getComment()												{return $this->_comment;}
	}

	class Expenses extends Variables{	
		function checkAmount(){
			$amount = $this->getAmount();
			
			if(empty($amount)) {
				$_SESSION['e_amount'] = "Podaj kwotę wydatku!";
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
				$_SESSION['e_date'] = "Ustaw datę wydatku!";
				return false;
			}
			else {
				$_SESSION['date'] = $date;
				return true;
			}
		}
		
		function checkPaymentMethods(){
			$payment_methods = $this->getPaymentMethods();
			
			$payment_methods = mb_strtolower($payment_methods, 'UTF-8');
			
			if(empty($payment_methods)) {
				$_SESSION['e_payment_methods'] = "Podaj sposób płatności!";
				return false;
			}
			else {
				$_SESSION['payment_methods'] = $payment_methods;
				return true;
			}
		}
		
		function checkCategory(){
			$category = $this->getCategory();
			
			$category = mb_strtolower($category, 'UTF-8');
			
			if(empty($category)){
				$_SESSION['e_category'] = "Podaj kategorię wydatku!";
				return false;
			}
			else {
				$_SESSION['category_expenses'] = $category;
				return true;
			}
		}

		function addExpensesFunction(){
			$amount = $this->getAmount();
			$date = $this->getEnteredDate();
			$payment_methods = $this->getPaymentMethods();
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
				
				$result = $connect->query("SELECT id FROM expenses_category_assigned_to_users WHERE name = '$category' AND user_id = $_SESSION[id]");
				$num = $result->num_rows;
				
				if($num<=0) {
					$result->close;
					$connect->query("INSERT INTO expenses_category_assigned_to_users VALUES (NULL, $_SESSION[id], '$category')");
					$result = $connect->query("SELECT id FROM expenses_category_assigned_to_users WHERE name = '$category' AND user_id = $_SESSION[id]");
				}
				
				$line = $result->fetch_assoc();
				
				$result->close;
				$result = $connect->query("SELECT id FROM payment_methods_assigned_to_users WHERE name = '$payment_methods' AND user_id = $_SESSION[id]");
				$num_payment = $result->num_rows;
				
				if($num_payment<=0) {
					$result->close;
					$connect->query("INSERT INTO payment_methods_assigned_to_users VALUES (NULL, $_SESSION[id], '$payment_methods')");
					$result = $connect->query("SELECT id FROM payment_methods_assigned_to_users WHERE name = '$payment_methods' AND user_id = $_SESSION[id]");
				}
				
				$line_payment = $result->fetch_assoc();
				
				if ($connect->query ("INSERT INTO expenses VALUES (NULL, $_SESSION[id], $line[id], $line_payment[id], '$amount', '$date', '$comment')")) {
				
					unset($_SESSION['amount']);
					unset($_SESSION['date']);
					unset($_SESSION['payment_methods']);
					unset($_SESSION['category_expenses']);
					unset($_SESSION['comment']);
					
					$result->close();
					$_SESSION['expenses_OK'] = true;
					
					return 0;
				}
				else{
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
	
	$nrCaseExpenses = new Expenses();
	
	$_POST['amount'] = str_replace(",",".",$_POST['amount']);
	$nrCaseExpenses->setAmount($_POST['amount']);
	$nrCaseExpenses->setEnteredDate($_POST['date']);
	$nrCaseExpenses->setPaymentMethods($_POST['payment_methods']);
	$nrCaseExpenses->setCategory($_POST['category']);
	$nrCaseExpenses->setComment($_POST['comment']);
	
	$amountTrue = $nrCaseExpenses->checkAmount();
	$dateTrue = $nrCaseExpenses->checkEnteredDate();
	$paymentTrue = $nrCaseExpenses->checkPaymentMethods();
	$categoryTrue = $nrCaseExpenses->checkCategory();

	if($amountTrue == true && $dateTrue == true && $paymentTrue == true && $categoryTrue == true){
		$nrCaseExpenses->addExpensesFunction();
	} else $nrCaseExpenses = 2;
	
	switch($nrCaseExpenses){
		case 0 : header('Location:Menu.php');break;
		case 1 : header('Location:error_server.php');break;
		case 2 : header('Location:expenses.php');break;
		default : header('Location:error_server.php');
	}

?>