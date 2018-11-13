<?php
	
	class Variables {
		private $_login;
		private $_password;
		
		function setLogin($login)						{$this->_login = $login;}
		function setPassword($password)		{$this->_password = $password;}
		
		function getLogin()								{return $this->_login;}	
		function getPassword()						{return $this->_password;}
	}

	class Login extends Variables{		
		function checkPass(){ 
			require_once 'connect.php';
			
			 $connect = new mysqli($host, $db_user, $db_password, $db_name);
			 
			 if($connect->connect_errno!=0){
				return 1;
			 }
			 
			 else{
				
				$log = $this->getLogin();
				$pass = $this->getPassword();
				
				$log = htmlentities($log, ENT_QUOTES, "UTF-8");
				
				if($result = $connect->query(sprintf("SELECT * FROM users WHERE username='%s'", mysqli_real_escape_string($connect, $log)))) {
					$how_many_found_users = $result->num_rows;
						
						if($how_many_found_users>0){
							$line = $result->fetch_assoc();
							
							if (password_verify($pass, $line['password'])){
								$_SESSION['id'] = $line['id'];
								$_SESSION['user'] = $line['username'];
								$_SESSION['password'] = $line['password'];
								
								$_SESSION['login_user'] = true;
								
								return 0;
								
							}else return 2;

						}else return 2;
				}
				
				$connect->close();
			}		 
		}		
	}
	
	if(!isset($_POST["log"]) || !isset($_POST["loginpassword"])){
		header('Location:index.php');
		exit();
	}
	
	session_start();
 
	$val = new Login();
	$val->setLogin($_POST["log"]);
	$val->setPassword($_POST["loginpassword"]);
	
	if(isset($_POST["log"])){
		$_SESSION['login'] = $_POST["log"];
	}
	
	switch($val->checkPass()){
		case 0 : header('Location:Menu.php');break;
		case 1 : header('Location:error_server.php');break;
		case 2 : header('Location:bad_login.php');break;
		default : header('Location:error_server.php');
	}
?>