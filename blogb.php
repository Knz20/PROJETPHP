







<?php


    ini_set('display_errors', 1);
    error_reporting(E_ALL);

  // Connexion à la base de données
$user =  'root';
$pass = 'root';
$database = 'blog';
$host = 'localhost';


$db = new PDO ('mysql:host=localhost;dbname=siteprojet',$user,$pass);



// récupérer les valeurs 

    $categories = htmlspecialchars($_POST["categories"]); 
    $users = htmlspecialchars($_POST["users"]);
    $txt = htmlspecialchars($_POST["txt"]);

    
    //préparer la requête d'insertion SQL
    $statement = $db->prepare("INSERT INTO blog (id, categories, users, txt) VALUES(:categories, :users, :txt)"); 
    //Associer les valeurs et exécuter la requête d'insertion
    $statement->bindParam(":categories", $categories);
    $statement->bindParam(":users", $users);
    $statement->bindParam(":txt", $txt);
    $statement->execute();

  // Redirection du visiteur vers la page du blog
header('Location: blog.php?categories='.$_POST['categories']);
 
?>
  


