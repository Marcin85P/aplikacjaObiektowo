<?php

	session_start();

	if(isset($_SESSION['login_user'])){
		header('Location: Menu.php');
		exit();
	}
?>

<!DOCTYPE html>

<html lang="pl">
	<head>
		<meta charset="utf-8"/>
		<title>Budżet - Menu</title>
		<meta name="author" content="Marcin Piwowar"/>
		
		<meta http-equiv="X-Ua-Compatible" content="IE=edge,chrome=1">
		
		<link rel="stylesheet" href="hamburgerMenu.css" type="text/css" />
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"/>
		<link rel="stylesheet" href="main.css" type="text/css" />
		<link rel="stylesheet" href="css/fontello.css"/>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">
	</head>
	
<body>
		
	
	<span style="color:red; font-size:30px"> Błąd serwera! Przepraszamy!
			
		
	</div>

</body>

</html>