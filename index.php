<?php session_start(); ?> 
<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Metadonnées de la page -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Importation Excel Dans la Base de Données</title>
    <!-- Inclusion du CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <!-- Ajout du logo -->
        <div class="row justify-content-center mt-4">
            <div>
                <img src=".\img\LOGO_IMEF.PNG" alt="Logo">
            </div>
        </div>
        <!-- Affichage d'un message stocké en session -->
        <div class="row">
            <div class="col-md-12 mt-4">
                <?php
                if(isset($_SESSION['message']))
                {
                    echo "<h4>".$_SESSION['message']."</h4>";
                    unset($_SESSION['message']);
                }
                ?>
                <!-- Début du formulaire d'importation -->
                <div class="card">
                    <div class="card-header">
                        <h4>Importation Excel Dans la Base de Données</h4>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST" enctype="multipart/form-data">
                            <input type="file" name="importer_fichier" class="form-control" />
                            <button type="submit" name="sauvegarder_donnees_excel" class="btn btn-primary mt-3">Importer</button>
                            <a href="consulte.php" class="btn btn-secondary mt-3">Retour</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Inclusion du JS de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
