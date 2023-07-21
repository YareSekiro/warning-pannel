<?php
session_start();
ini_set('display_errors','on');
date_default_timezone_set('Europe/Paris');

if(isset($_SESSION['user']) && isset($_SESSION['mdp']) && !empty($_SESSION['user']) && !empty($_SESSION['mdp']))
{

}
else
{
  header('location:logout.php');
}

require('bdd.php');
$sql_rqt = 'SELECT * FROM players_avert';//On récupère la liste des joueurs
$sql_exec = mysqli_query($connexion , $sql_rqt);//On éxcute la commande

foreach($sql_exec as $RESULT)//Pour chaque résultat 
{
    $players[] = $RESULT['player'];//On met les différents joueurs dans un tableau
    $avertonb[] = $RESULT['totalaverto'];//On met leur nb d'averto respectif dans un tableau
}

$NbPlayers = sizeof($players);//On définit la taille du tableau pour bouclé dessus

for($i = 0 ; $i<$NbPlayers ; $i++)//Boucle sur la taille du tableau
{

        $sql_rqt = 'SELECT date_s,date_e FROM averto WHERE player="'.$players[$i].'" AND number="'.$avertonb[$i].'"';//On récup la date de début et de fin
        $sql_exec = mysqli_query($connexion , $sql_rqt);
        
        foreach($sql_exec as $date)
        {
            $DATE_S = $date['date_s'];//Date d'attribution
            $DATE_E = $date['date_e'];//Date de suppression
        }

        
        $DATE_E_WS = str_replace("_"," ",$DATE_E);
        $DATE_NOW = date('j-n-Y \a H:i:s');//Heure et date de la vente
       // $DATE_NOW_NEW[] = explode(" ",$DATE_NOW);
        //$NEW_DATE_NOW = $DATE_NOW_NEW[0].


        $DATE_NOW_MILLI = strtotime($DATE_NOW);
        $DATE_E_MILLI = strtotime($DATE_E_WS);



        if($DATE_NOW_MILLI >= $DATE_E_MILLI)//Si la date actuel est égale ou supérieur à celle de fin de l'averto
        {
            
            $sql_rqt = 'DELETE FROM averto WHERE player="'.$players[$i].'" AND number="'.$avertonb[$i].'"';//On supprime l'averto
            $sql_exec = mysqli_query($connexion , $sql_rqt);
            $new_total_averto = $avertonb[$i] - 1;//On redéfinit le nombre total d'averto
            $sql_rqt = 'UPDATE players_avert SET totalaverto="'.$new_total_averto.'" WHERE player="'.$players[$i].'"';
            $sql_exec = mysqli_query($connexion , $sql_rqt);

            if($new_total_averto <= 0)
            {
                $sql_rqt = 'DELETE FROM players_avert WHERE player="'.$players[$i].'"';
                $sql_exec = mysqli_query($connexion , $sql_rqt);
            }

        }



}
mysqli_close($connexion);
header('location:panel.php');





?>