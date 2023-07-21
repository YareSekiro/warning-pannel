<?php
require('bdd.php');
require('function.php');
if(isset($_POST['user']) && isset($_POST['reason']) && !empty($_POST['reason']) && !empty($_POST['user']))
{
$user = $_POST['user'];
$reason = $_POST['reason'];
$staff = $_POST['staff'];
$number = '1';
$date_s = date('j-n-Y \a H:i:s');
echo $date_s;
$date_e = date('j-n-Y \a H:i:s', strtotime("+7 day"));
echo $date_e;


$sql_rqst = 'INSERT INTO players_avert (player,totalaverto) VALUES ("'.str_replace(" ","_",$user).'",1)';
$sql_result = mysqli_query($connexion , $sql_rqst) or die('Erreur SQL !<br />'.mysqli_error($connexion));

$sql_rqst = 'INSERT INTO averto (player,number,reason,staff,date_s,date_e) VALUES ("'.str_replace(" ","_",$user).'",1,"'.str_replace(" ","_",$reason).'","'.str_replace(" ","_",$staff).'","'.str_replace(" ","_",$date_s).'","'.str_replace(" ","_",$date_e).'")';
$sql_result = mysqli_query($connexion , $sql_rqst) or die('Erreur SQL !<br />'.mysqli_error($connexion));
//$data = mysqli_fetch_array($sql_result , MYSQLI_ASSOC);//Met le résultat de la requête sous tableau*/
mysqli_close($connexion);
header('location:panel.php?add=good');
}
else
{
  header('location:panel.php');
}
?>


