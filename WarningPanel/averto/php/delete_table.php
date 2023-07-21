<?php
session_start();
require('bdd.php');
if(isset($_SESSION['user']) && isset($_SESSION['mdp']) && !empty($_SESSION['user']) && !empty($_SESSION['mdp']))
{
    $sql_rqst = 'DELETE FROM vente';
    $sql_result = mysqli_query($connexion , $sql_rqst) or die('Erreur SQL !<br />'.mysqli_error($connexion));
    mysqli_close($connexion);
    header('location:panel.php?s=good');
}
else
{
    header('location:../index.html');
}


?>