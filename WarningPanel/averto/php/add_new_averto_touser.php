<?php
require('bdd.php');
require('function.php');
if(isset($_GET['player']) && isset($_POST['reason']) && !empty($_POST['reason']) && !empty($_GET['player']))
{
$user = $_GET['player'];
$reason = $_POST['reason'];
$staff = $_POST['staff'];
$number = $_POST['number'];
$date_s = date('j-n-Y \a H:i:s');

$date_e = date('j-n-Y \a H:i:s', strtotime("+7 day"));

$sql_request = 'SELECT number FROM averto WHERE player="'.$_GET['player'].'"';
$sql_exec = mysqli_query($connexion , $sql_request);
foreach($sql_exec as $nb_advert)
{
    $NUMBER_AVERTO[] = $nb_advert['number'];
}

$Nombreaverto = sizeof($NUMBER_AVERTO);
if($Nombreaverto == '1')
{
    $date_e_1 = date('j-n-Y \a H:i:s', strtotime("+14 day"));
    $sql_request = 'UPDATE averto SET date_e ="'.str_replace(" ","_",$date_e_1).'" WHERE number="'.$Nombreaverto.'" AND player="'.$_GET['player'].'"';
    $sql_exec = mysqli_query($connexion , $sql_request);
    $sql_request = 'UPDATE players_avert SET totalaverto="2" WHERE player="'.$_GET['player'].'"';
    $sql_exec = mysqli_query($connexion , $sql_request);
}

if($Nombreaverto == '2')
{
    $date_e_2 = date('j-n-Y \a H:i:s', strtotime("+21 day"));
    $sql_request = 'UPDATE averto SET date_e ="'.str_replace(" ","_",$date_e_2).'" WHERE number="1" AND player="'.$_GET['player'].'"';
    $sql_exec = mysqli_query($connexion , $sql_request);
    $date_e_3 = date('j-n-Y \a H:i:s', strtotime("+14 day"));
    $sql_request = 'UPDATE averto SET date_e="'.str_replace(" ","_",$date_e_3).'" WHERE number="'.$Nombreaverto.'"';
    $sql_exec = mysqli_query($connexion , $sql_request);    

    $sql_request = 'UPDATE players_avert SET totalaverto="3" WHERE player="'.$_GET['player'].'"';
    $sql_exec = mysqli_query($connexion , $sql_request);    
}







$sql_rqst = 'INSERT INTO averto (player,number,reason,staff,date_s,date_e) VALUES ("'.str_replace(" ","_",$user).'","'.str_replace(" ","_",$number).'", "'.str_replace(" ","_",$reason).'","'.str_replace(" ","_",$staff).'","'.str_replace(" ","_",$date_s).'","'.str_replace(" ","_",$date_e).'")';
$sql_result = mysqli_query($connexion , $sql_rqst) or die('Erreur SQL !<br />'.mysqli_error($connexion));
//$data = mysqli_fetch_array($sql_result , MYSQLI_ASSOC);//Met le résultat de la requête sous tableau*/
mysqli_close($connexion);
header('location:averto.php?player='.str_replace(" ","_",$user).'');
}
else
{
  header('location:panel.php');
}
?>


