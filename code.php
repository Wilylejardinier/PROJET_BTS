<?php
session_start();
include('dbconfig.php');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

if(isset($_POST['sauvegarder_donnees_excel']))
{
    $nomFichier = $_FILES['importer_fichier']['name'];
    $extension_fichier = pathinfo($nomFichier, PATHINFO_EXTENSION);

    $extensions_autorisees = ['xls','csv','xlsx', 'ods'];

    if(in_array($extension_fichier, $extensions_autorisees))
    {
        $cheminFichierSource = $_FILES['importer_fichier']['tmp_name'];
        $tableur = IOFactory::load($cheminFichierSource);
        $donnees = $tableur->getActiveSheet()->toArray();

        $compteur = "0";
        foreach($donnees as $ligne)
        {
            if($compteur > 0)
            {
                $m_nom = $ligne['0'];
                $m_ip = $ligne['1'];
                $m_mac = $ligne['2'];
                $m_fabricant = $ligne['3'];
                $m_type = $ligne['4'];

                $requeteMateriel = "INSERT INTO materiel (m_nom, m_ip, m_mac, m_fabricant, m_type) VALUES ('$m_nom','$m_ip','$m_mac','$m_fabricant','$m_type')";
                $resultat = mysqli_query($conn, $requeteMateriel);
                $msg = true;
            }
            else
            {
                $compteur = "1";
            }
        }

        if(isset($msg))
        {
            $_SESSION['message'] = "Importation réussie";
            header('Location: index.php');
            exit(0);
        }
        else
        {
            $_SESSION['message'] = "Importation échouée";
            header('Location: index.php');
            exit(0);
        }
    }
    else
    {
        $_SESSION['message'] = "Fichier invalide";
        header('Location: index.php');
        exit(0);
    }
}
?>
