<?php
session_start();
include('dbconfig.php');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

if(isset($_POST['sauvegarder_donnees_excel']))
{
    // Vérifier si un fichier a été uploadé
    if (!isset($_FILES['importer_fichier']) || $_FILES['importer_fichier']['size'] == 0) {
        $_SESSION['message'] = "Aucun fichier n'a été sélectionné. Veuillez sélectionner un fichier à importer.";
        header('Location: index.php');
        exit(0);
    }

    $nomFichier = $_FILES['importer_fichier']['name'];
    $extension_fichier = pathinfo($nomFichier, PATHINFO_EXTENSION);
    $extensions_autorisees = ['xls','csv','xlsx', 'ods'];

    if(in_array($extension_fichier, $extensions_autorisees))
    {
        $cheminFichierSource = $_FILES['importer_fichier']['tmp_name'];
        $tableur = IOFactory::load($cheminFichierSource);
        $donnees = $tableur->getActiveSheet()->toArray();

        $erreurs = [];
        $compteur = 0;
        $requetes = [];

        foreach($donnees as $numLigne => $ligne)
        {
            if($compteur > 0)
            {
                $m_designation = mysqli_real_escape_string($conn, substr($ligne['0'], 0, 50));
                $m_type = mysqli_real_escape_string($conn, substr($ligne['1'], 0, 32));
                $m_site = mysqli_real_escape_string($conn, substr($ligne['2'], 0, 32));
                $m_ip = mysqli_real_escape_string($conn, substr($ligne['3'], 0, 16));
                $m_mac = mysqli_real_escape_string($conn, substr($ligne['4'], 0, 50));
                $m_fabricant = mysqli_real_escape_string($conn, substr($ligne['5'], 0, 50));
                $m_commentaire = mysqli_real_escape_string($conn, substr($ligne['6'], 0, 150));
                $m_actif = mysqli_real_escape_string($conn, substr($ligne['7'], 0, 8));

                if($m_designation == "") {
                    $erreurs['designation'][] = $numLigne + 1;
                }
                if($m_type == "") {
                    $erreurs['type'][] = $numLigne + 1;
                }
                if($m_site == "") {
                    $erreurs['site'][] = $numLigne + 1;
                }
                if($m_actif == "") {
                    $erreurs['actif'][] = $numLigne + 1;
                }

                $requetes[] = "INSERT INTO materiel (m_nom, m_type, m_site, m_ip, m_mac, m_fabricant, m_commentaire, m_actif) 
                    VALUES ('$m_designation','$m_type','$m_site','$m_ip','$m_mac','$m_fabricant', '$m_commentaire', '$m_actif')";
            }
            else
            {
                $compteur = 1;
            }
        }

        if(count($erreurs) > 0) {
            $erreurMessage = "Des données obligatoires manquent :\n";
            foreach($erreurs as $colonne => $lignes) {
                $erreurMessage .= "La cellule de la colonne $colonne aux lignes " . implode(",", $lignes) . " est vide.<br>";
            }
            $_SESSION['message'] = nl2br($erreurMessage);
            header('Location: index.php');
            exit(0);
        }
        else
        {
            foreach($requetes as $requeteMateriel) {
                $resultat = mysqli_query($conn, $requeteMateriel);
            }

            $_SESSION['message'] = "Importation réussie";
            header('Location: index.php');
            exit(0);
        }
    }
    else
    {
        echo "Format de fichier non pris en charge. Veuillez télécharger un fichier .xls, .csv, .xlsx ou .ods.";
    }
}

?>
