<?php 

$host = "127.0.0.1";
$user = "slayzeh";
$pass = "hhSOd2F8lu1DRBCk3ZF";
$bdd = "slayzeh";

$connexion = mysqli_connect($host,$user,$pass) or die ("Fail");//Connexion a la bdd
mysqli_select_db($connexion , $bdd) or die ("Fail bdd");//Selection de la database

?>