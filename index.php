<?php
// Connexion à la base de données
$servername = "51.178.17.79";
$username = "Ascaba";
$password = "aScaba2023**";
$dbname = "ProjetSN";
$conn = new mysqli($servername, $username, $password, $dbname);
// Vérification de la connexion
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// Traitement de l'importation des données
if (isset($_POST['submit'])) {
  // Vérification du fichier CSV
  if ($_FILES['file']['type'] == 'text/csv' || $_FILES['file']['type'] == 'application/vnd.ms-excel') {
    // Ouverture du fichier
    $file = fopen($_FILES['file']['tmp_name'], 'r');
    // Vérification de la première ligne
    $header = fgetcsv($file);
    if ($header[0] != 'm_cb' || $header[1] != 'm_nom' || $header[2] != 'm_type' || $header[3] != 'm_site' || $header[4] != 'm_ip' || $header[5] != 'm_mac' || $header[6] != 'm_fabricant' || $header[7] != 'm_commentaire' || $header[8] != 'm_actif') {
      echo 'Le fichier CSV n\'est pas conforme aux règles de remplissage.';
      exit;
    }
    // Importation des données
    while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
      $sql = "INSERT INTO materiel (m_cb, m_nom, m_type, m_site, m_ip, m_mac, m_fabricant, m_commentaire, m_actif) VALUES ('$data[0]', '$data[1]', '$data[2]', '$data[3]', '$data[4]', '$data[5]', '$data[6]', '$data[7]', '$data[8]')";
      if ($conn->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }
    // Fermeture du fichier
    fclose($file);
    // Confirmation de l'importation
    echo "Les données ont été importées avec succès.";
  } else {
    echo 'Le fichier doit être au format CSV ou XLS.';
    exit;
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Importation de données</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <form enctype="multipart/form-data" method="post">
    <input type="file" name="file">
    <input type="submit" name="submit" value="Importer">
  </form>
</body>
</html>
