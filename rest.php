<?php

session_start();

try{
    $pdo = new PDO('mysql:host=localhost;dbname=projetsnir;charset=utf8','root', '');
}catch (PDOException $e){
     die ('Connexion à la base de données : ECHEC');
}

// Recherche de la méthode
$req_type=$_SERVER['REQUEST_METHOD']; // GET, POST, PUT ou DELETE

if(isset($_SERVER['PATH_INFO'])){ // URL : rest.php/......
    $cheminURL=$_SERVER['PATH_INFO'];
    $cheminURL_tableau=explode('/',$cheminURL); // Conversion chaîne de caractères en tableau
}

if($req_type=='GET'){
  
    if(isset($cheminURL_tableau[1]) && $cheminURL_tableau[1]=="utilisateur"){
      // La requete SQL
      $req = "SELECT * FROM utilisateur where u_login=?";
      // Preparation de la requete
      $reqpreparer=$pdo->prepare($req);
      $tableauDeDonnees=array($cheminURL_tableau[2]) ;
      // Exécution de la requete
      $reqpreparer->execute($tableauDeDonnees);
      // récupération de la réponse
      $reponse=$reqpreparer->fetchAll(PDO::FETCH_ASSOC);
      //print_r($reponse);
      $reqpreparer->closeCursor();
      if(empty($reponse)){
        echo "{'status':'error','message':'Pseudo inconnu'}";
      }else{
        $reponse_tableau=array('status'=>'success','valeur'=>$reponse);
        echo json_encode($reponse_tableau);
      }
    }

    if(isset($cheminURL_tableau[1]) && $cheminURL_tableau[1]=="materiel"){
      // La requete SQL
      $req = "SELECT * FROM materiel";
      // Preparation de la requete
      $reqpreparer=$pdo->prepare($req);
      $tableauDeDonnees=array() ;
      // Exécution de la requete
      $reqpreparer->execute($tableauDeDonnees);
      // récupération de la réponse
      $reponse=$reqpreparer->fetchAll(PDO::FETCH_ASSOC);
      //print_r($reponse);
      $reqpreparer->closeCursor();
      if(empty($reponse)){
        echo "{'status':'error','message':'Erreur'}";
      }else{
        $reponse_tableau=array('status'=>'success','valeur'=>$reponse);
        echo json_encode($reponse_tableau);
      }

    }
    else if(isset($cheminURL_tableau[1]) && $cheminURL_tableau[1]=="materiel"){
      $m_id = $cheminURL_tableau[2];
      // La requete SQL
      $req = "SELECT * FROM materiel WHERE m_id=?";
      // Preparation de la requete
      $reqpreparer=$pdo->prepare($req);
      $tableauDeDonnees=array($m_id) ;
      // Exécution de la requete
      $reqpreparer->execute($tableauDeDonnees);
      // récupération de la réponse
      $reponse=$reqpreparer->fetchAll(PDO::FETCH_ASSOC);
      //print_r($reponse);
      $reqpreparer->closeCursor();
      if(empty($reponse)){
        echo '{"status":"error","message":"Erreur"}';
      }else{
        $reponse_tableau=array('status'=>'success','valeur'=>$reponse);
        echo json_encode($reponse_tableau);
      }
  /************************************************************************/

    }
}
else if($req_type=='POST'){
  $donneesRecues_json=file_get_contents("php://input");
  $donneeRecues_tableau=json_decode($donneesRecues_json,true);
  //print_r($donneeRecues_tableau);


  if(isset($cheminURL_tableau[1]) && $cheminURL_tableau[1]=="connexion"){
    // La requete SQL
    $req = "SELECT * FROM utilisateur where u_login=? and u_pwd=?";
    // Preparation de la requete
    $reqpreparer=$pdo->prepare($req);
    $tableauDeDonnees=array($donneeRecues_tableau["u_login"],$donneeRecues_tableau["u_pwd"]) ;
    // Exécution de la requete
    $reqpreparer->execute($tableauDeDonnees);
    // récupération de la réponse
    $reponse=$reqpreparer->fetchAll(PDO::FETCH_ASSOC);
    //print_r($reponse);
    $reqpreparer->closeCursor();
    if(empty($reponse)){
      $reponse_tableau=array('status'=>'error','message'=>'Identifiant ou mot de passe incorrect');
    }else{
      $_SESSION["login"] = $donneeRecues_tableau["u_login"];
      $reponse_tableau=array('status'=>'success');
    }
    echo json_encode($reponse_tableau);

  
  }
if(isset($cheminURL_tableau[1]) && $cheminURL_tableau[1]=="deconnexion") {
  session_destroy();
  $reponse_tableau=array('status'=>'success');
  echo json_encode($reponse_tableau);
}

  if(isset($cheminURL_tableau[1]) && $cheminURL_tableau[1]=="materiel"){
    // La requete SQL
    $req = "INSERT INTO materiel(m_nom, m_ip, m_mac, m_commentaire, m_site, m_fabricant, m_cb, m_type, m_actif) values(?,?,?,?,?,?,?,?,?)";
    // Preparation de la requete
    $reqpreparer=$pdo->prepare($req);
    $tableauDeDonnees=array($donneeRecues_tableau["nom"],$donneeRecues_tableau["ip"],$donneeRecues_tableau["mac"],$donneeRecues_tableau["commentaire"],
    $donneeRecues_tableau["site"],$donneeRecues_tableau["fabricant"],$donneeRecues_tableau["code-barre"],$donneeRecues_tableau["type"],$donneeRecues_tableau["actif"]) ;
    // Exécution de la requete
    $reqpreparer->execute($tableauDeDonnees);
  
    $reqpreparer->closeCursor();
    $reponse_tableau=array('status'=>'success');
    echo json_encode($reponse_tableau);

  }
/************************************************************************/



}
else if($req_type=='PUT'){

}else if($req_type=='DELETE'){
  $donneesRecues_json=file_get_contents("php://input");
  $donneeRecues_tableau=json_decode($donneesRecues_json,true);

  if(isset($cheminURL_tableau[1]) && $cheminURL_tableau[1]=="materiel"){
    echo "Suppression à gérer\n";
    print_r($donneeRecues_tableau);
    $req = "DELETE FROM materiel WHERE m_id=?";
    echo $req ;
    $reqpreparer=$pdo->prepare($req);
    $tableauDeDonnees=array($donneeRecues_tableau["m_id"]);
    $reqpreparer->execute($tableauDeDonnees);
    //echo $donneeRecues_tableau["m_id"];
   
  }
}else{
  echo "Attention méthode non prise en compte";
}
 
 ?>