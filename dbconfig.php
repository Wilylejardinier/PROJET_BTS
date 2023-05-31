<?php
    // Paramètres de connexion à la base de données
    $hote = "localhost";
    $nom_utilisateur = "root";
    $mot_de_passe = "";
    $base_de_donnees = "projetsnir";

    // Création de la connexion à la base de données
    $conn = mysqli_connect($hote, $nom_utilisateur, $mot_de_passe, $base_de_donnees);

    // Vérification de la connexion
    if (!$conn) {
        die("Erreur de connexion : " . mysqli_connect_error());
    }
    echo "Connexion réussie";
?>