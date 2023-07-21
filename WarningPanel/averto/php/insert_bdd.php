<?php
require('bdd.php');
require('function.php');
require('../../lib/password.php');
if(isset($_POST['user']) && isset($_POST['pswd']) && !empty($_POST['user']) && !empty($_POST['pswd']))
{
$user = $_POST['user'];
$mdp = $_POST['pswd'];
$perm = $_POST['perm'];
$img = $_POST['img'];
$hashed_mdp = hashMake($mdp);

$sql_rqst = 'INSERT INTO users (login,password,perm,img) VALUES ("'.$user.'","'.$hashed_mdp.'","'.$perm.'","'.$img.'")';
$sql_result = mysqli_query($connexion , $sql_rqst) or die('Erreur SQL !<br />'.mysqli_error($connexion));
//$data = mysqli_fetch_array($sql_result , MYSQLI_ASSOC);//Met le résultat de la requête sous tableau*/
mysqli_close($connexion);
header('location:user.php?f=add');
}
else
{
  header('location:user.php?f=add&vente=add_good');
}
?>


