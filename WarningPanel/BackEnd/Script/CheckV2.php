<?php
/**
 * Copyright (c) iFive 2020.
 * Developed by Mus (Jun#666) for iFive.
 *  U are not allowed to use / edit php file without my permission.
 */

require "../../../Extra/vendor/autoload.php";

session_start();
ini_set('display_errors','on');
date_default_timezone_set('Europe/Paris');
/*
 * If session variables are defined
 */
    if(isset($_SESSION['AVERTO_USER']) && isset($_SESSION['AVERTO_PSWD']) && !empty($_SESSION['AVERTO_USER']) && !empty($_SESSION['AVERTO_PSWD']))
    {

        /*
         * PlayersAdvertManager
         */
    $_PM = new \App\Manager\PlayersAdvertManager();

    /*
     * AdvertManager
     */
    $_AM = new \App\Manager\AdvertManager();

    /*
     * NumberOfPlayerWhichHaveAdvert
     */
    $_numberAdvert = $_PM->SelectNumberAverto();

    /*
     * Select All (id, player,total advert) from players_advert database
     */
    $_DT = $_PM->SelectAllFromPlayersAdvert();

    /*
     *  For each player
     */
    for($i = 0; $i < $_numberAdvert; $i++){

        /*
         * Select all infos (player,number,date start,date end etc..) from averto database
         * We just need the two date here
         */
        $_data = $_AM->SelectInfoFromSpecificAdvert($_DT[$i]->getPlayer(), $_DT[$i]->getTotal());

        /*
         * Get the first date
         */
        // echo $_data[0]->getPlayer() . ' | ' . $_data[0]->getDate_s() . '</br></br>';
        $_First_date = $_data[0]->getDate_s();
        

        /*
         * Get the last date (the date when the advert is expired)
         */
        $_Last_date = $_data[0]->getDate_e();

        /*
         * Replace for adapt to php date function
         */
        $_Last_date_WS = str_replace("_"," ",$_Last_date);

        /*
         * Use date function for use php strtotime function
         */
        $DATE_NOW = date('j-n-Y \a H:i:s');//Heure et date de la vente

        /*
         * Use strtotime function to compare two date
         */
        $DATE_NOW_MILLI = strtotime($DATE_NOW);
        $DATE_E_MILLI = strtotime($_Last_date_WS);

        /*
         * If the actual date is equal or upper than the last date
         */
        if($DATE_NOW_MILLI >= $DATE_E_MILLI)
        {

            /*
             * We delete the advert for the player
             */
            $_AM->DeleteOneAdvertForOnePlayer($_DT[$i]->getPlayer(), $_DT[$i]->getTotal());
            /*
             * We remove one of the total number
             */
            $_NewTotalAdvert = $_DT[$i]->getTotal() - 1;

            /*
             * if the new total is lower or equal to 0
             */
            if($_NewTotalAdvert <= 0){

                /*
                 * We remove the player from the players_advert database
                 */
                $_PM->DeletePlayers($_DT[$i]->getPlayer());


            } else {

                /*
                 * If not, we update the averto database
                 */
                $_PM->UpdatePlayerAdvert($_DT[$i]->getPlayer(), $_NewTotalAdvert);

            }


        }




        }










        header('location:../../FrontEnd/index.php?redirect=panel');
        return true;




}
else
{
    /*
     * if the session variable are not defined
     * We just use the disconnect function from the Users Manager
     */
    $user = new \App\Manager\UsersManager();
    $user->Logout();
    $user = NULL;
    return false;
}