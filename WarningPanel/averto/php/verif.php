<?php

require('bdd.php');
require('../../lib/password.php');
require('function.php');


if(isset($_POST['user']) && isset($_POST['pswd']) && !empty($_POST['user']) && !empty($_POST['pswd']))
{
    $user = $_POST['user'];
    $mdp = $_POST['pswd'];

    $sql_rqst = 'SELECT password,perm FROM users WHERE login="'.$user.'"';
    $sql_result = mysqli_query($connexion , $sql_rqst) or die('Erreur SQL !<br />'.mysqli_error($connexion));
    $hashed_pswd = mysqli_fetch_array($sql_result , MYSQLI_ASSOC);
    $verif = hashCheck($mdp , $hashed_pswd['password']);
    mysqli_close($connexion);

  

    if($verif)
    {
        session_start();
        $_SESSION['user'] = $user;
        $_SESSION['mdp'] = $mdp;
        $_SESSION['perm'] = $hashed_pswd['perm'];
       

  
                 header('location:check.php');


    }
    else{
        
       
        header('location:../index.html');
     
  
    }


}
else
{
    header('location:../index.html');
}

?>
