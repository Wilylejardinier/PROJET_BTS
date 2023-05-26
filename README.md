# **PROJET_BTS** #





### XLS Condition ###
-m_cb : code-barres **unique** pour chaque équipement. Il doit être **unique** et ne **pas contenir de caractères spéciaux**.

-m_nom : nom de l'équipement. Il peut contenir des **lettres**, des **chiffres** et des **caractères spéciaux**, mais ne doit pas dépasser **50 caractères**.

-m_type : type d'équipement _(par exemple, PC, imprimante, téléphone)_. Il peut contenir des lettres, des chiffres et des caractères spéciaux, mais ne doit pas dépasser **32 caractères**.

-m_site : emplacement de l'équipement _(par exemple, bureau 1, salle de conférence)_. Il peut contenir des **lettres**, des **chiffres** et des **caractères spéciaux**, mais ne doit pas dépasser **32 caractères**.

-m_ip : adresse IP de l'équipement. Il doit être sous la forme **"xxx.xxx.xxx.xxx"** et être **unique** pour chaque équipement.

-m_mac : adresse MAC de l'équipement. Elle doit être sous la forme **"xx-xx-xx-xx-xx-xx"** et être **unique** pour chaque équipement.

-m_fabricant : nom du fabricant de l'équipement. Il peut contenir des **lettres**, des **chiffres** et des **caractères spéciaux**, mais ne doit pas dépasser **50 caractères**.

-m_commentaire : commentaire sur l'équipement. Il peut contenir des lettres, des chiffres et des caractères spéciaux, mais ne doit pas dépasser **150 caractères**.

-m_actif : indication sur l'état de l'équipement _(par exemple, "oui" ou "non")_. Il ne doit pas dépasser 8 caractères.

_(Il est important de respecter ces règles de remplissage pour éviter les erreurs lors de l'importation des données dans la table **"materiel"**. De plus, vous devez vous assurer que les données sont valides et cohérentes pour éviter toute erreur ou perte de données.)_ 
