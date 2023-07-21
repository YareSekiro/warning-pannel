<?php
/**
 * Copyright (c) iFive 2020.
 * Developed by Mus (Jun#666) for iFive.
 *  U are not allowed to use / edit php file without my permission.
 */

require '../../../Extra/vendor/autoload.php';

use App\Tool\Tools;
use App\Manager\PlayersAdvertManager;
use App\Manager\AdvertManager;
// ini_set('display_errors' , 'On');
session_start();
/*
 * Check if user is connected
 */
if(isset($_SESSION['AVERTO_USER']) && !empty($_SESSION['AVERTO_USER'])) {

    /*
     * Check if the id is defined
     */
    if(isset($_GET['id'])){

        /*
         * Managers
         */
        $_player_manager = new PlayersAdvertManager();
        $_Warning_manager= new AdvertManager();
        /*
         * Secure the $_GET value
         */
        $id = Tools::html($_GET['id']);
        /*
         * Get player info
         */
        $_player_data = $_Warning_manager->GetInfoById($id);

        /*
         * If we have info
         */
        if($_player_data){

            /*
             * Define player name
             */
            $_player_Name = $_player_data[0]->getPlayer();

            /*
             * Delete the warning for the player
             */
            $_cache = $_Warning_manager->DeleteWarningById($_player_Name, $id);

            //Tools::Log("Deleted");

            
            

            /*
             * Check the number of warnings in progress of the player
             * For be able to update the players_avert database
             */
            $_player_infos = $_player_manager->CheckNumberAdvert($_player_Name);

            if($_player_infos == 1){

                    $_player_manager->DeletePlayers($_player_Name);

            } else {

                /*
                * Update the players_avert database
                */
                $_player_manager->UpdatePlayerAdvert($_player_Name, $_player_infos - 1);

                if($_player_infos != $_cache[0]->getNumber()){
                    if($_player_infos == 3){
                        if($_cache[0]->getNumber() == 2){
                            /*
                            * Warning 3 : Became warning 2
                            */
                            $_Warning_manager->UpdateAdvert($_player_Name, $_player_infos, $_cache[0]->getNumber());
                        } else {
                            /*
                            * Warning 2 : Became warning 1
                            * Warning 3 : Became warning 2
                            */
                            $_Warning_manager->UpdateAdvert($_player_Name, $_player_infos - 1, $_cache[0]->getNumber());
                            $_Warning_manager->UpdateAdvert($_player_Name, $_player_infos, $_cache[0]->getNumber() + 1); 
                        }
                    } else {
                        /*
                        * Value is INEVITABLY 2
                        * So we just have to change number from 2 to 1
                        */
                        $_Warning_manager->UpdateAdvert($_player_Name, $_player_infos, $_cache[0]->getNumber());
                    }
                }

            }



            /*
             * Redirect to the warning page
             */
            header('location:../../FrontEnd/index.php?redirect=warning&player=' . $_player_Name);

            /*
             * return true;
             */
            return true;


        } else {
            header('location../../FrontEnd/index.php?redirect=panel');
            return;
        }



    } else {
        header('location:../../FrontEnd/index.php?redirect=panel');
    }


} else {
    header('location:../../FrontEnd/index.php');
    return;
}