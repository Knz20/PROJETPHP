<?php  
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=job_done', 'root' ,'');

if (isset($_POST['connexion'])){
	$pseudo_connect= htmlspecialchars($_POST['pseudoconnect']);
	$mdp_connect= sha1($_POST['mdpconnect']);
	if(!empty($pseudo_connect) and !empty($mdp_connect)){
		$requser = $bdd->prepare("SELECT * FROM membre WHERE pseudo=? and motdepasse=?");	
		$requser->execute(array($pseudo_connect, $mdp_connect));	
		$userexist = $requser->rowCount();
		if($userexist==1){
			$userinfo=$requser->fetch();
			$_SESSION['id']=$userinfo['idmembre'];
			$_SESSION['pseudo']=$userinfo['pseudo'];
			$_SESSION['email']=$userinfo['email'];
			header("Location: profil.php?id=".$_SESSION['id']); 


		}	

		else{
			$erreur="mauvais pseudo ou mot de passe";
		}
	}
 	else{
 		$erreur="tous les champs doivent etre complétés";

 	}
}
?>



<!DOCTYPE html>
<html>
<head>
	<title>ACCUEIL</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    	
	
</head>
<meta name=<meta charset="utf-8"> 
<body>

	<header>
		<H1>JOB DONE</H1>
		<nav>
		
			
				
			<div class="container">
				<ul>
					
						<li><a href="/acceuil.php">ACCUEIL</a></li>	
						<?php  if(isset($_SESSION['id'])){?>
					
					<li><a href="/profil.php?id=<?php echo $_SESSION['id'] ;?>">PROFILE</a></li><?php } 
					else { ?>
						<li><a href="/acceuil.php">PROFILE</a></li><?php } ?>
					<li><a href="/anonces.php">ANONCES</a></li>
					<li><a href="/deconnexion.php"	>DECONNEXION</a></li>
				</ul>
			</div>
		</nav>
	</header>


<div class='main'>
	<div class="acceuilg"> <h3 class="titre">Laissez votre passion vous mener à votre profession </h3>	
	<img class="acceuil" src="photo.jpg" alt="">
	</div>
	<div class="acceuild">
	 	
	 	
									 
		<?php  if(isset($_SESSION['id'])){

		}
	else{ ?>
		<h3 class="titreconnexion">Connectez-vous et partagez votre offre</h3>
		<table class="connexion">
			<form action="" method="POST" accept-charset="utf-8">
				
			
				<tr>
					<td class="label"><label>Pseudo</label></td><td><input class="connexion_input" type="text" name="pseudoconnect" value="" placeholder="Introduisez le pseudo"></td>
				</tr>
				<tr>
					<td class="label"><label>Pasword</label></td><td><input class="connexion_input" type="password" name="mdpconnect" value="" placeholder="Introduisez le password"></td>
			    </tr>
			    <tr><td colspan="2"><input class="submit_connexion" type="submit" name="connexion" value="Connexion"></td>
			    </tr>
				<tr><td colspan="2"><a  href="/inscription.php"	>Je m'inscris</a></td></tr>
			</form>

		</table><?php } ?>			
		<?php if(isset($erreur)){
			echo '<p class="erreur_connexion">'.$erreur.'</p>';}
		 ?>
	
	</div>	
</div>
<footer>
	<div class="container">
		<p>&copy; Tous droits réservés ...</p>
	</div>
</footer>
</body>
</html>

