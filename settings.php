<?php

	interface SetVariables{
		function setOldPass($pass_old);
		function setNewPass($pass_new);
	}

	interface GetVariables{
		function getOldPass();
		function getNewPass();	
	}

	class Variables implements SetVariables, GetVariables{
		private $_oldPassword;
		private $_newPassword;
		
		function setOldPass($pass_old)			{$this->_oldPassword = $pass_old;}
		function setNewPass($pass_new)		{$this->_newPassword = $pass_new;}
		
		function getOldPass()							{return $this->_oldPassword;}
		function getNewPass()							{return $this->_newPassword;}
	}

	class Settings extends Variables{		
		function changePassword(){
			
			require_once "connect.php";
			
			$connect = new mysqli($host, $db_user, $db_password, $db_name);
				
			if($connect->connect_errno!=0){
				return 1;
			}
			else {
				$pass_o = $this->getOldPass();
				$pass_n = $this->getNewPass();
				
				$query = "SELECT password FROM users WHERE id = $_SESSION[id]";			
				$result = $connect->query($query);
				
				$password_base = $result->fetch_assoc();
				
				$pass_base = $password_base['password'];
				
				if ((strlen($pass_n) < 6) || (strlen($pass_n) > 20)) {
					$_SESSION['e_pass'] = "Hasło musi posiadać od 6 do 20 znaków!";
					return 2;
				}
				
				if (password_verify($pass_o, $pass_base)){ 
					$pass_hash_n = password_hash($pass_n, PASSWORD_DEFAULT);
					
					$connect->query("UPDATE users SET password='$pass_hash_n' WHERE id=$_SESSION[id]");
					$_SESSION['update_password_successful'] = true;
				
					$connect->close();
					return 0;
				}
				else{
					$_SESSION['e_pass2'] = "Twoje stare hasło nie jest poprawne!";
					return 2;
				}
			}					
		}
	}
	
	session_start();
	
	if(!isset($_SESSION['login_user'])){	
		header('Location: index.php');
		exit();
	}
	
	if(!isset($_POST['pass_o'])){
		header('Location:settings_h.php');
		exit();
	}
	
	$val = new Settings();
	$val->setOldPass($_POST["pass_o"]);
	$val->setNewPass($_POST["pass_n"]);
	
	switch($val->changePassword()){
		case 0 : header('Location:Menu.php');break;
		case 1 : header('Location:error_server.php');break;
		case 2 : header('Location:settings_h.php');break;
		default : header('Location:error_server.php');
	}
	
?>