<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link id="callCss" rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="screen"/>
		<link id="callCss" rel="stylesheet" href="css/css.css" type="text/css" media="screen"/>
		<link href="css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css">
		<title>Etat civile</title>
		<style>
		
            fieldset.scheduler-border {
                border: 2px groove #ddd !important;
                padding: 0 1.4em 1.4em 1.4em !important;
                margin: 1.5em 0 !important;
				margin-top:10px;
            }
            legend.scheduler-border {
                font-size: 1.0em !important;
                font-weight: bold !important;
                text-align: left !important;
                color:FF8C00;
                width:inherit;
                padding:0 10px; /* To give a bit of padding on the left and right */
                border-bottom:none;
            }
			
			
        </style>
		
		<?php
			session_start();  
			include("/classe/Personne.php");// on importe la classe Personne pour puisse l'utiliser
			// on verifie si l'utilisateur a soumis la requete
			if(isset($_POST['ajouter']) && $_POST['ajouter']=='Submit'){

			$personne =new Personne();// on instance un objet de la classe Personne afin d'appeler la methode ajouter_personne
			$dossier = 'photos/'; // Dessier pour insérer la photo
			$path= basename($_FILES['photo']['name']);
			$personne->setPhoto($_FILES['photo']['name']);
			if (move_uploaded_file($_FILES['photo']['tmp_name'], $dossier.$path)) {
				echo "image uploader";
			}
			
			/**
				Les donneés soumis dans le formulaire
			*/
			$personne->setNom($_POST['nom']);
			$personne->setPrenom($_POST['prenom']);
			$personne->setDate_naissance($_POST['date_naissance']);
			$personne->setSexe($_POST['sexe']);
			$personne->setGroupe_sanguin($_POST['groupe_sanguin']);
			$personne->setPoids($_POST['poids']);
			$personne->setTaille($_POST['taille']);
			$personne->setObservations($_POST['observations']);
			$personne->ajouter_personne($personne->getNom(),$personne->getPrenom(),$personne->getDate_naissance(),$personne->getSexe(),$personne->getGroupe_sanguin(),$personne->getPoids(),$personne->getTaille(),$personne->getObservations(),$personne->getPhoto());
			mysql_close();
			header('Location: indexe.php'); // aprés l'ajout on reste sur la page 
			exit();
 
        }
		?>
	</head>

	
	<body class="container">
        <center>
			<section id="bodySection">
				<div class="span9" style="width:70%">
					<form action="indexe.php" method="POST" enctype="multipart/form-data"  >
						<fieldset class="scheduler-border" style="width:850px; height:700px;display:inline;">		
							<div class="row-12">
								<div class="col-8">
									<fieldset class="scheduler-border" style="width:350px; height:250px;display:inline;float:left;margin-right:20px;">
									
									<legend  class="btn btn-primary the-legend" > Etat civil</legend>
										<?php 
											/* selection de l'image */
											$idcon=@mysql_connect("localhost","root","");
											mysql_select_db("etat_civile",$idcon);
											$req="select photo from personne";
											$res=mysql_query($req) or die("errure de select");
										?>
										<table width="100" style="margin-top:20px;">
											<tr>
												<td>Nom</td>
												<td>
													<input type="text" name="nom" placeholder="Nom" required>
												</td>
											</tr>
											<tr>
												<td>Prenom</td>
												<td>
													<input type="text" name="prenom" placeholder="Prenom" required>
												</td>
											</tr>
											<tr>
												<td>Date Naissance</td>
												<td>
													<input type="date" name="date_naissance" required placeholder="Date de Naissance" max="1998-12-31">
												</td>
											</tr>
											<tr>
												<td>Sexe</td>
												<td>
													<select name="sexe" style="width:90px; float:right; margin-right:40px;">
														<option>Femme</option>
														<option>Homme</option>
													</select>
												</td>
											</tr>
										</table>
									</fieldset>	
								</div>
								<div class="col-4">
									<?php	
										/*on récupére l'image*/
										while ($ligne = mysql_fetch_array($res)){ 
									?> 
										<img src="photos/<?php echo $ligne['photo'];?>" width="150" height="150" >
										<?php } ?>
								</div>
							<fieldset class="scheduler-border" style="width:500px; height:300px;display:inline;float:left; margin-right:10px;">
							<legend  class="btn btn-primary the-legend"> Consultation</legend>
								
									<table width="100" style="margin-top:20px;">
									<tr>
										<td>Groupe sanguin</td>
										<td>
											<select name="groupe_sanguin" style="width:90px;">
												<option>O+</option>
												<option>O-</option>
												<option>A+</option>
												<option>A-</option>
												<option>B+</option>
												<option>B-</option>
												<option>AB+</option>
												<option>AB-</option>
											</select>
										</td>
									</tr>
									<tr>
										<td>Poids</td>
										<td>
											<input type="text" name="poids" style="height:20px;width:90px;"> <b>Kg</b>
										</td>
									</tr>
									<tr>
										<td>Taille</td>
										<td>
											<input type="text" name="taille" style="height:20px;width:90px;"> <b>cm</b>
										</td>
									</tr>
									<tr>
										<td>Observations</td>
										<td>
											<textarea class="md-textarea form-control" name="observations" ></textarea>
										</td>
									</tr>
									<tr>
										<td>Photo</td>
										<td>
											<input type="file" name="photo" required>
										</td>
									</tr>
									<br>
								
									<tr>
										<td></td>
										<td>
											<center><button type="submit" name="ajouter" value="Submit" class="btn btn-primary" style="width:120px;height:40px; float:right;"> Submit</button></center> 
										</td>   
									</tr>
								</table>
							</fieldset>
						</form>
					</div>
				</section>
			<center>
		<!-- Javascript ================================================== -->
		<script src="js/jquery-1.8.3.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/bootstrap-tooltip.js"></script>
		<script src="js/bootstrap-popover.js"></script>
	</body>

</html>        
