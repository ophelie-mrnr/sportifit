# sportifit
Conseils et programmes sportif et nutritif

C'est un site web qui regroupe le domaine du sport et de la santé.
Il a pour objectif d’aider les personnes à améliorer leur mode de vie et leur santé avec des programmes de fitness et des conseils en nutrition.



*Pour prendre notre site Web et le mettre sur votre serveur, voici comment procéder* 



# INSTALLATION D'UN SERVEUR WEB

 Vous devez obligatoirement avoir un serveur Web. Si vous en avez déjà un vous pouvez passer cette partie.

* Pour les utilisateurs de Windows, télécharger Mamp ou Wamp allez sur leur site respectif.
Télécharger Mamp si vous êtes sur Mac Os X  et Lamp si vous êtes sur Linux.

* Installer le logiciel correspondant à votre système d'exploitation.



 # INSTALLATION DE GIT

* Sur Linux, nous devez suivre les commandes suivantes : https://git-scm.herokuapp.com/download/linux

* Sur Mac, vous pouvez télécharger GitHub via l'adresse suivante : https://mac.github.com/

* Sur Windows, vous pouvez télécharger GitHub via cette adresse : https://windows.github.com/


 # INSTALLATION DE bdsportifit


1. [Télécharger l'archive du site web à l'adresse ici](https://github.com/ophelie-mrnr/sportifit/archive/master.zip)

2. Décompresser l'archive à l'aide de winrar ou winzip

3. Vous obtenez un répertoire nommé "sportifit". 

4. Récupérer le fichier bdsportifit.sql disponible dans le sous repertoire BDD du répertoire nommé "sportifit".
 Ce fichier est indispensable au bon fonctionnement du site.

5. Lancer le logiciel Mamp/Lamp ou Wamp

6. Ouvrir votre navigateur Web préféré, et taper l'adresse suivante "http://localhost/phpmyadmin". 
**Par défaut: l'identidiant est "root" et  le password est "root"  pour Mac Os X et Linux et aucun password pour Windows**
Vous pourrez modifier votre mot de passe une fois connecté.

7. Création d'une base de données "bdsportifit" :
Toujours à l'adresse "http://localhost/phpmyadmin" c'est -à- dire sur phpmyadmin, cliquer sur nouvelle base de données en haut à gauche.
  Il y a deux champs, dans le premier qui est vide écrire "bdsportifit"( nommez votre base "bdsportifit") 
Dans le menu déroulant avec écrit "Interclassement" choisir "utf8_general_ci" vers le bas de la liste. 
Ensuite Valider, la base de données est créée. 

8. Importation de la base de données:
Dans la suite vous aurez à importer la base de données du site web.
Cliquer sur le nom de votre base de données bdsportifit dans le menu vertical à gauche ensuite cliquez sur le bouton "importer" dans le menu horizontal en haut.
Puis cliquer sur parcourir et aller chercher le fichier bdsportifit.sql disponible dans le sous repertoire BDD du répertoire nommé "sportifit"
Une fois fait, cliquer sur importer, votre base de données est ainsi complète.
