/****************************/
Serveur
/****************************/

Le log du site est accessible depuis: www-labs.iro.umontreal.ca/~log
Entrer le nom du compte et le mot de passe.
NB: le site est une redirection de www-labs.iro.umontreal.ca/~relis vers relis.iro.umontreal.ca

Les logs se mettent � jour si et seulement si on teste depuis www-labs.iro.umontreal.ca/~relis

/****************************/
Base de donn�es
/****************************/

La base de donn�es est faite sous MySQL
Elle comprend deux parties essentielles
- La partie statique (qui ne change pas de structure pour tous les instances de ReLiS)
- La partie dynamique (Qui est fonction de la classification � faire)

La partie statique comprend les tables suivantes :
	- relis_paper
	- relis_paperauthor
	- relis_author
	- relis_assigned
	- relis_users
	- relis_usergroup
	- relis_exclusion
	- relis_zref_exclusioncrieria
	- relis_venue

	
La partie dynamique :
	- relis_classification  : Cette table est toujours pr�sente mais sa structure est fonction de la classification � faire
	- relis_classification_intent
	- relis_classification_intent_relation 
	- relis_classification_scope
	- relis_zref_domain
	- relis_zref_intent
	- relis_zref_intent_relation
	- relis_zref_language
	- relis_zref_scope

Les scripts MySQL sont disponibles par ssh depuis le compte relis@frontal.iro.umontreal.ca.
Par ssh, se connecter sur le compte et entrer le mot de passe de 14 caract�res.
Entrer: mysql -u relis -p -h www-labs.iro.umontreal.ca
Suivi du mot de passe correspondant � la base de donn�es accessible en lecture seulement ou
lecture et �criture.

Cr�ation d�une base:
Le nom de la base de donn�es doit obligatoirement commencer par le nom du compte suivi du nom
qu�on souhaite lui donner.
Par exemple: �relis_bddName�.

Ins�rer un script dans la base de donn�es existante:
mysql -h www-labs.iro.umontreal.ca -u relis -p relis_db < nom_du_fichier.sql
Le mot de passe demand� par la suite est celui du compte mysql dans lequel se fait l�insertion.
Pour tout compl�ment d�information: http://support.iro.umontreal.ca/doku.php?id=logiciel:mysql

/****************************/

Application

/****************************/

L'application est d�velopp�e en utilisant l'architecture MVC (Model - Vue - Contr�leur) pour s�parer les donn�es, la pr�sentation et les traitements.
Le d�veloppement est fait avec le Framework MVC de PHP CodeIgniter 3.0
Le code source est plac� dans 3 dossiers principaux � savoir
	-relis_sys/ : partie syst�me donc la partie o� se trouve la d�claration et d�finition des Libraires et fonctions de CodeIgniter 
			(Elle est re�ue tel qu'elle lors de l'installation de CodeIgniter)
	-relis_app/ : partie application, c'est l� que se trouve le code qui concerne notre application elle comprend des sous dossiers :
		- config : pour les configurations de l'application
		- controllers: qui comprends les contr�leurs (partie qui s'occupe des traitement)
		- views : qui comprend les Vue (partie qui s'occupe de la pr�sentation)
		- models : qui comprend les mod�les (partie qui s'occupe des donn�s donc qui communique avec la base de donn�es)
		- libraries et helpers : comprennent d�autres fonctions qui sont utilis�s dans les parties cit�s ci-haut.
		Pour plus d'info sur la configuration et la structure d'une application CodeIgniter une bonne documentation est disponible sur : http://www.codeigniter.com/docs
	- cside/ : partie qui comprend le code CSS et Java Script utilis� dans l�application. Il comprend entre autre:
			- la librarie bootstrapp utilis� pour le design de l'application
			- la librarie hightcharts utilis� pour l'affichage des graphiques
			- JQuery
			- Les icones utilis�s
			- les images
