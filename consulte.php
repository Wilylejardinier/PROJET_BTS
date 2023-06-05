<?php
	session_start();	
	if(!isset($_SESSION["login"]))
	{
		header('Location: connexion.php');
	}
	?>


<!DOCTYPE html>
<html>
<head>
	<title>Gestion du Matériel</title>
	<style>
		body {
			margin: 0;
			padding: 0;
			font-family: Arial, sans-serif;
		}
		header {
			background-color: #333;
			color: #fff;
			text-align: center;
			padding: 20px;
		}
		nav {
			background-color: #ddd;
			padding: 10px;
			overflow: auto;
		}
		nav a {
			display: inline-block;
			padding: 10px;
			background-color: #fff;
			color: #333;
			margin-right: 10px;
			text-decoration: none;
			border-radius: 5px;
		}
		nav a:hover {
			background-color: #333;
			color: #fff;
		}
		.container {
			max-width: 1200px;
			margin: 0 auto;
			padding: 20px;
		}
		h2 {
			margin-top: 0;
		}
		form {
			display: flex;
			align-items: center;
			margin-bottom: 20px;
		}
		form input[type="text"] {
			flex: 1;
			padding: 10px;
			margin-right: 10px;
			border: none;
			border-radius: 5px;
			font-size: 16px;
		}
		form button {
			background-color: #333;
			color: #fff;
			border: none;
			padding: 10px;
			border-radius: 5px;
			font-size: 16px;
			cursor: pointer;
		}
		table {
			width: 100%;
			border-collapse: collapse;
			margin-top: 20px;
		}
		th, td {
			padding: 10px;
			text-align: left;
			border-bottom: 1px solid #ddd;
		}
		th {
			background-color: #333;
			color: #fff;
		}
		tr:hover {
			background-color: #f5f5f5;
		}
		.yes {
			color: green;
			font-weight: bold;
		}
		.no {
			color: red;
			font-weight: bold;
		}
		button {
  			background-color: #f00;
 			color: #fff;
  			border: none;
  			padding: 5px;
  			border-radius: 50%;
  			font-size: 14px;
  			cursor: pointer;
			text-align: center;
		}
	</style>
</head>
<body>
	<header>
		<h1>Gestion du Matériel</h1>
	</header>
	<nav>
		<a href="ajoute.php">Ajouter</a>
		<a href="#">Modifier</a>
		<a id="deconnexion" href="#">deconnexion</a>
		<a href="index.php" href="#">Import Excel</a>
	</nav>
	<div class="container">
		<h2>Consulter Materiel</h2>
		<div id="materiel"></div>
	</div>
	<script src="ajax.js"></script> <!-- Lien vers le fichier JavaScript contenant le code Ajax -->
	<script>recupererMateriel();
	document.getElementById("deconnexion").addEventListener("click",ajaxDeconnexion);
</script>
</body>
</html>

                   
