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
         window.location.replace("test.html");
      }else{
        alert(reponseServeur_objet.message);
      }
    }
  };
  xhttp.open("POST", "rest.php/connexion");
  var donnees='{"u_login":"'+document.getElementById('u_login').value+'","u_pwd":"'+document.getElementById('u_pwd').value+'"}';
  xhttp.send(donnees);

}

function recupererMateriel(){
  const xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var reponseServeur_objet=JSON.parse(this.responseText); // this.responseText est la réponse du serveur à une requête http
      console.log(reponseServeur_objet.valeur);

      var reponse=reponseServeur_objet.valeur;

      var materiel="<table><thead><tr>\
					<th>Nom</th><th>IP</th><th>MAC</th><th>Commentaire</th><th>Site</th><th>Fabricant</th><th>Code Barre</th><th>Type</th><th>Actif</th><th>Supprimer</th></tr></thead>";
			
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
					<td><button>X</button></td></tr>";
      }
      materiel+="</table>";

      document.getElementById('materiel').innerHTML=materiel;
    }
  };
  xhttp.open("GET", "rest.php/materiel");
  xhttp.send();

}

function ajouterMateriel(){
  const xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var reponseServeur_objet=JSON.parse(this.responseText); // this.responseText est la réponse du serveur à une requête http
      if(reponseServeur_objet.status=="success"){
         window.location.replace("test.html");
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
