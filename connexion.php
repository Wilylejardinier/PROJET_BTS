<!DOCTYPE html>
<html>
<head>
    <script src="ajax.js"></script> <!-- Lien vers le fichier JavaScript contenant le code Ajax -->
    <title>Gestion du stock - Connexion</title>
    <link rel="stylesheet" href="styles.css"> <!-- Lien vers le fichier CSS -->
</head>
<body>
    <div class="container">
        <img src="logo.png" class="logo" alt="Logo"> <!-- Logo de l'application -->
        <h1 class="title">Gestion du stock</h1> <!-- Titre centré -->
        <form id="form_connexion" action="" method="get">
            <input type="text" id="u_login" name="u_login" placeholder="Nom d'utilisateur" required>
            <input type="password" id="u_pwd" name="u_pwd" placeholder="Mot de passe" required>
            <input type="button" id="bouton_connexion" class="fond_bleu police_blanche" value="Valider">
        </form>
    </div>
    <script>
        document.getElementById("bouton_connexion").addEventListener("click", ajaxConnexion);
      </script>
</body>
</html>