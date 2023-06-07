function recupererUnUtilisateur(){
  const xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var reponseServeur_objet=JSON.parse(this.responseText); // this.responseText est la réponse du serveur à une requête http
      console.log(reponseServeur_objet.status);
      document.getElementById('donnees').innerHTML=reponseServeur_objet.valeur[0].nom;
    }
  };
  xhttp.open("GET", "rest.php/utilisateur/login1");
  xhttp.send();

}

function ajaxConnexion(){
  const xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var reponseServeur_objet=JSON.parse(this.responseText); // this.responseText est la réponse du serveur à une requête http
      if(reponseServeur_objet.status=="success"){
         window.location.replace("consulte.php");
      }else{
        alert(reponseServeur_objet.message);
      }
    }
  };
  xhttp.open("POST", "rest.php/connexion");
  var donnees='{"u_login":"'+document.getElementById('u_login').value+'","u_pwd":"'+document.getElementById('u_pwd').value+'"}';
  xhttp.send(donnees);

}
function ajaxDeconnexion(){
  const xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var reponseServeur_objet=JSON.parse(this.responseText); // this.responseText est la réponse du serveur à une requête http 
      console.debug(this.responseText);
      if(reponseServeur_objet.status=="success"){
         window.location.replace("connexion.php");
      }else{
        alert(reponseServeur_objet.message);
      }
    }
  };
  xhttp.open("POST", "rest.php/deconnexion");
  xhttp.send();

}


function recupererMateriel(){
  const xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      console.debug(this.responseText);
      var reponseServeur_objet=JSON.parse(this.responseText); // this.responseText est la réponse du serveur à une requête http
      
      var materiel="<table><thead><tr>\
					<th>Nom</th><th>IP</th><th>MAC</th><th>Commentaire</th><th>Site</th><th>Fabricant</th><th>Code Barre</th><th>Type</th><th>Actif</th><th></th><th>Supprimer</th></tr></thead>";
			
          if(reponseServeur_objet.status == "success") {
          console.log(reponseServeur_objet.valeur);

      var reponse=reponseServeur_objet.valeur;

      
      for(let i=0;i<reponse.length;i++){
        materiel+="<tr>\
					<td>"+reponse[i].m_nom+"</td>\
          <td>"+reponse[i].m_ip+"</td>\
          <td>"+reponse[i].m_mac+"</td>\
          <td>"+reponse[i].m_commentaire+"</td>\
          <td>"+reponse[i].m_site+"</td>\
          <td>"+reponse[i].m_fabricant+"</td>\
          <td>"+reponse[i].m_cb+"</td>\
          <td>"+reponse[i].m_type+"</td>\
          <td>"+reponse[i].m_actif+"</td>\
					<td><a href=\"modifier.php?m_id="+reponse[i].m_id+"\"><button>Modifier</button></a></td>\
          <td><button onclick=\"supprimerMateriel('"+reponse[i].m_id+"')\">X</button></td></tr>";
          
      }
    }
      materiel+="</table>";

      document.getElementById('materiel').innerHTML=materiel;
    }
  };
  xhttp.open("GET", "rest.php/materiel");
  xhttp.send();

}

function recupererUnMateriel(m_id)
{
  console.debug("Recuperation d'un materiel en cours...");
  const xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var reponseServeur_objet=JSON.parse(this.responseText); // this.responseText est la réponse du serveur à une requête http
      console.debug(reponseServeur_objet);
      console.debug(reponseServeur_objet.valeur[0].m_nom);
      document.getElementById("nom").value = reponseServeur_objet.valeur[0].m_nom;
      document.getElementById("ip").value = reponseServeur_objet.valeur[0].m_ip;
      document.getElementById("mac").value = reponseServeur_objet.valeur[0].m_mac;
      document.getElementById("commentaire").value = reponseServeur_objet.valeur[0].m_commentaire;
      document.getElementById("site").value = reponseServeur_objet.valeur[0].m_site;
      document.getElementById("fabricant").value = reponseServeur_objet.valeur[0].m_fabricant;
      document.getElementById("code-barre").value = reponseServeur_objet.valeur[0].m_code-barre;
      document.getElementById("type").value = reponseServeur_objet.valeur[0].m_type;
      document.getElementById("Actif").value = reponseServeur_objet.valeur[0].m_actif;
      //document.getElementById("select").selectedIndex = 0
      //A REFAIRE :document.getElementById("type").value = reponseServeur_objet.valeur[0].t_type;

    }
  };
  xhttp.open("GET", "rest.php/materiel/"+m_id);
  xhttp.send();  
}


function supprimerMateriel(m_id)
{
  const xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      console.debug("Suppression du materiel correctement exécutée");
      recupererMateriel();
    }
  };

  xhttp.open("DELETE", "rest.php/materiel");
  var donnees='{"m_id":"'+m_id+'"}';
  console.debug(donnees);
  xhttp.send(donnees);

}

function ajouterMateriel(){
  const xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var reponseServeur_objet=JSON.parse(this.responseText); // this.responseText est la réponse du serveur à une requête http
      if(reponseServeur_objet.status=="success"){
         window.location.replace("consulte.php");
      }else{
        alert(reponseServeur_objet.message);
      }
    }
  };
  xhttp.open("POST", "rest.php/materiel");
  var donnees='{"nom":"'+document.getElementById('nom').value+'","ip":"'+document.getElementById('ip').value+'","mac":"'+document.getElementById('mac').value+
  '","commentaire":"'+document.getElementById('commentaire').value+'","site":"'+document.getElementById('site').value+'","fabricant":"'+document.getElementById('fabricant').value+
  '","code-barre":"'+document.getElementById('code-barre').value+'","type":"'+document.getElementById('type').value+'","actif":"'+document.getElementById('actif').value+'"}';
  xhttp.send(donnees);

}
