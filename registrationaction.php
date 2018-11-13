<?php

	class Variables {
		private $_login;
		private $_password1;
		private $_password2;
		
		function setLogin($login)					{$this->_login = $login;}	
		function setPassword1($pass1)		{$this->_password1 = $pass1;}
		function setPassword2($pass2)		{$this->_password2 = $pass2;}
		
		function getLogin()							{return $this->_login;}
		function getPassword1()					{return $this->_password1;}		
		function getPassword2()					{return $this->_password2;}
	}

	class Registration extends Variables{		
		function checkNick(){
			$nick = $this->getLogin();
			
			if ((strlen($nick)<3) || (strlen($nick)>20)) {
				$_SESSION['e_nick'] = "Login musi posiadać od 3 do 20 znaków!";
				return false;
			}
			
			if (ctype_alnum($nick) == false || preg_match('@[ęóąśłżźćńĘÓĄŚŁŻŹĆŃ]@', $nick)) {
				$_SESSION['e_nick'] = "Login może składać się tylko z liter i cyfr (bez polskich znaków)";
				return false;
			}
			
			else return true;
		}
		
		function checkPassword(){
			$pass1 = $this->getPassword1();
			$pass2 = $this->getPassword2();
			
			if ((strlen($pass1) < 6) || (strlen($pass1) > 20)) {
				$_SESSION['e_pass'] = "Hasło musi posiadać od 6 do 20 znaków!";
				return false;
			}
			
			if ($pass1 != $pass2) {
				$_SESSION['e_pass2'] = "Podane hasła nie są identyczne!";
				return false;
			}
			
			else return true;
		}
		
		function checkRegistration(){
			$nick = $this->getLogin();
			$password = $this->getPassword1();
			
			$pass_hash = password_hash($password, PASSWORD_DEFAULT);
			
			require_once "connect.php";
			
			$connect = new mysqli($host, $db_user, $db_password, $db_name);
				
			if($connect->connect_errno!=0){
				return 1;
			}
			else {
				
				$result = $connect->query("SELECT id FROM users WHERE username='$nick'");
				
				if(!$result) return 1;
				
				$how_many_found_nick = $result->num_rows;
				
				if ($how_many_found_nick > 0) {
					$_SESSION['e_nick'] = "Istnieje już użytkownik o takim nicku! Wybierz inny.";
					return 2;
				}
					
				if ($result = $connect->query ("INSERT INTO users VALUES (NULL, '$nick', '$pass_hash')")) {
					
					$result = $connect->query("SELECT id FROM users WHERE username='$nick'");
					$line = $result->fetch_assoc();
					$id_user = $line['id'];
					$result->close();
					
					$connect->query("INSERT INTO expenses_category_assigned_to_users (id, user_id, name) SELECT NULL, '$id_user', expenses_category_default.name FROM expenses_category_default");					
					$connect->query("INSERT INTO incomes_category_assigned_to_users (id, user_id, name) SELECT NULL, '$id_user', incomes_category_default.name FROM incomes_category_default");						
					$connect->query("INSERT INTO payment_methods_assigned_to_users (id, user_id, name) SELECT NULL, '$id_user' , payment_methods_default.name FROM payment_methods_default");
					
					$_SESSION['successful_registration'] = true;
					
					return 0;
				}
				else {
					if(!$result) return 1;
				}
				
				$connect->close();
			}
		}		
	}
	
	if(!isset($_POST["nick"]) || !isset($_POST["pass1"])){
		header('Location:registration.php');
		exit();
	}
	
	session_start();
	
	if(isset($_POST["nick"])){
		$_SESSION['fr_nick'] = $_POST["nick"];
	}
	
	$nr_case = new Registration();
	$nr_case->setLogin($_POST["nick"]);
	$nr_case->setPassword1($_POST["pass1"]);
	$nr_case->setPassword2($_POST["pass2"]);
	
	$nick = $nr_case->checkNick();
	$password = $nr_case->checkPassword();
	
	if($nick == true && $password == true){

		switch($nr_case->checkRegistration()){
			case 0 : header('Location:index.php');break;
			case 1 : header('Location:error_server.php');break;
			case 2 : header('Location:registration.php');break;
			default : header('Location:error_server.php');
		}
	}
	
	else header("Location:registration.php");
?>