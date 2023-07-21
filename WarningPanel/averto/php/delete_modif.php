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

if(isset($_POST['user']) && !empty($_POST['user']))
{
$user_delete = $_POST['user'];

$sql_request = 'DELETE FROM users WHERE login = "'.$user_delete.'"';//On prépare la commande
$sql_result = mysqli_query($connexion , $sql_request);
mysqli_close($connexion);
header('location:user.php?f=suppr&vente=good');
}
else
{
$user_modif = $_POST['user_modif'];
$pourcentage = $_POST['pourcentage'];

$sql_request = 'UPDATE users SET pourcentage="'.$pourcentage.'" WHERE login="'.$user_modif.'"';//On prépare la commande
$sql_result = mysqli_query($connexion , $sql_request);
mysqli_close($connexion);
header('location:user.php?f=suppr&vente=modif_good');   
}





?>