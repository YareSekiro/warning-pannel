<?php
session_start();
if(isset($_SESSION['user']) && isset($_SESSION['mdp']) && !empty($_SESSION['user']) && !empty($_SESSION['mdp']))
{

}
else
{
  header('location:logout.php');
}

require('bdd.php');

if(isset($_POST['vname']) && !empty($_POST['vname']))
{
$carname = $_POST['vname'];
}
elseif(isset($_GET['vehicles']) && !empty($_GET['vehicles']))
{
  $carname = $_GET['vehicles'];
}

$sql_request = 'SELECT price , category FROM vehicles WHERE name = "'.$carname.'"';//On prépare la commande
$sql_result = mysqli_query($connexion , $sql_request);//On exécute la commande qui va récupéré le prix et la catégorie du véhicule selectionné
$result = mysqli_fetch_array($sql_result , MYSQLI_ASSOC);//On met sous forme d'un tableau

$price = $result['price'];//Prix
$benef = $price * 0.3;//Argent touché par l'entreprise
$categorie = $result['category'];//Catégorie

$seller = $_SESSION['user']; //Nom du vendeur

$date = date('j-n-Y \a H:i:s');//Heure et date de la vente


$sql_request_second = 'INSERT INTO vente (seller , date, car,category,benef) VALUES ("'.$seller.'","'.$date.'","'.$carname.'","'.$categorie.'","'.$benef.'")';
$sql_exec = mysqli_query($connexion , $sql_request_second);
$sql_request_second = 'INSERT INTO totalsell (seller , date, car,category,benef) VALUES ("'.$seller.'","'.$date.'","'.$carname.'","'.$categorie.'","'.$benef.'")';
$sql_exec = mysqli_query($connexion , $sql_request_second);
mysqli_close($connexion);
header('location:sale.php?vente=good');

?>