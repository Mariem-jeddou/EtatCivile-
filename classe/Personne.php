<?php
	// Classe Personne 
	class Personne {
		//Declaration des attributs
		private $nom;
		private $prenom;
		private $date_naissance;
		private $sexe;
		private $groupe_sanguin;
		private $poids;
		private $taille;
		private $observations;
		private $photo;

		/* 
			Les getters et les setters
		**/
		public function setNom($nom){
			$this->nom=$nom;
		}
		public function getNom()
		{
			return $this->nom;
		} 
		public function setPrenom($prenom){
			$this->prenom=$prenom;
		}
		public function getPrenom()
		{
			return $this->prenom;
		}
		public function setDate_naissance($date_naissance){
			$this->date_naissance=$date_naissance;
		}
		public function getDate_naissance()
		{
			return $this->date_naissance;
		}
		public function setSexe($sexe){
			$this->sexe=$sexe;
		}
		public function getSexe()
		{
			return $this->sexe;
		}
		public function setGroupe_sanguin($groupe_sanguin){
			$this->groupe_sanguin=$groupe_sanguin;
		}
		public function getGroupe_sanguin()
		{
			return $this->groupe_sanguin;
		}
		public function setPoids($poids){
			$this->poids=$poids;
		}
		public function getPoids()
		{
			return $this->poids;
		}
		public function setTaille($taille){
			$this->taille=$taille;
		}
		public function getTaille()
		{
			return $this->taille;
		}
		public function setObservations($observations){
			$this->observations=$observations;
		}	
		public function getObservations()
		{
			return $this->observations;
		}
		public function setPhoto($photo){
			$this->photo=$photo;
		}
		public function getPhoto()
		{
			return $this->photo;
		}
		//methode ajouter personne permet d'ajouter une nouvelle personne
		function ajouter_personne($nom, $prenom,$date_naissance,$sexe,$groupe_sanguin,$poids,$taille,$observations, $photo){
			$idcon=@mysql_connect("localhost","root",""); // Les attributs de connexion � la base de donn�es
			mysql_select_db("etat_civile",$idcon); // Sel�ction de la base de donn�es 
			$req="insert into personne(nom,prenom,date_naissance,sexe,groupe_sanguin,poids,taille,observations,photo) values('$nom','$prenom','$date_naissance','$sexe','$groupe_sanguin','$poids','$taille','$observations','$photo')"; //Requ�te pour ins�rer une personne 
			mysql_query($req) or die(mysql_error()); //Ex�cution de la requ�te 
		}
	}

?>