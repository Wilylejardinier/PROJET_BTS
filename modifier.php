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
			margin-bottom: 30px;
		}
		form {
			display: flex;
			flex-wrap: wrap;
			align-items: center;
			margin-bottom: 20px;
		}
		form label {
			display: block;
			width: 100%;
			margin-bottom: 10px;
			font-weight: bold;
		}
		form input[type="text"], form select {
			width: calc(33.33% - 5px);
			padding: 10px;
			margin-bottom: 10px;
			border: 1px solid black;
			border-radius: 5px;
			font-size: 16px;
		}
		form .half-width {
			width: calc(50% - 5px);
			margin-right: 10px;
		}
		form button {
			background-color: #333;
			color: #fff;
			border: none;
			padding: 10px;
			border-radius: 5px;
			font-size: 16px;
			cursor: pointer;
			margin-top: 10px;
			display: block;
			margin: 0 auto;
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
	</style>
</head>
<body>
	<header>
		<h1>Gestion du Matériel</h1>
	</header>
	<nav>
		<a href="ajoute.php">Ajouter</a>
		<a href="consulte.php">Consulter</a>
	</nav>
    <div class="container">
		<h2>Modifier Matériel</h2>
		<form>
			<div style="display:flex;flex-wrap:wrap;">
				<div style="width:33%;">
					<label for="nom">Nom:</label>
					<input type="text" id="nom" name="nom">
				</div>
				<div style="width:33%;">
					<label for="type">Type:</label>
					<input type="text" id="type" name="type">
				</div>
				<div style="width:33%;">
					<label for="site">Site:</label>
					<input type="text" id="site" name="site">
				</div>
				<div style="width:33%;">
					<label for="ip">IP:</label>
					<input type="text" id="ip" name="ip">
				</div>
				<div style="width:33%;">
					<label for="mac">Adresse MAC:</label>
					<input type="text" id="mac" name="mac">
				</div>
				<div style="width:33%;">
					<label for="fabricant">Fabricant:</label>
					<input type="text" id="fabricant" name="fabricant">
				</div>
				<div style="width:33%;">
					<label for="code-barre">Code barre:</label>
					<input type="text" id="code-barre" name="code-barre">
				</div>
				<div style="width:100%;">
					<label for="commentaire">Commentaire:</label>
					<textarea id="commentaire" name="commentaire"></textarea>
				</div>
				<div style="width:33%;">
					<label for="actif">Actif:</label>
					<select id="actif" name="actif">
						<option value="oui">Oui</option>
						<option value="non">Non</option>
					</select>
				</div>
				<div style="width:100%;">
					<input type="button" id="bouton_materiel" class="fond_bleu police_blanche" value="Modifier">
				</div>
			</form>
			</div>
			<script src="ajax.js"></script> <!-- Lien vers le fichier JavaScript contenant le code Ajax -->
			
			

