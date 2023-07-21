<?php
/**
 * Copyright (c) iFive 2020.
 * Developed by Mus (Jun#666) for iFive.
 *  U are not allowed to use / edit php file without my permission.
 */

require '../../../Extra/vendor/autoload.php';

session_start();

use App\Manager\BanListManager;
use App\Tool\Tools;
use App\Tool\FrontTools;
use App\Manager\PlayersAdvertManager;
use App\Manager\AdvertManager;
/*
 * Check is the user is connected
 */
if(isset($_SESSION['AVERTO_USER']) && !empty($_SESSION['AVERTO_USER'])) {
    if (isset($_GET['player']) && isset($_POST['reason']) && !empty($_POST['reason']) && !empty($_GET['player']) || isset($_POST['player']) && isset($_POST['reason']) && !empty($_POST['reason']) && !empty($_POST['player'])) {

        /*
         * Get the form data
         */
        $user = Tools::html($_GET['player']) ? str_replace(" ", "_", Tools::html($_GET['player'])) : str_replace(" ", "_", Tools::html($_POST['player']));
        $reason = str_replace(" ", "_", Tools::html($_POST['reason']));
        $staff = Tools::html($_SESSION['AVERTO_USER']);
        $number = 1;

        /*
         * Make the start & end date
         */
        $date_s = date('j-n-Y \a H:i:s');

        $date_e = date('j-n-Y \a H:i:s', strtotime("+7 day"));

        /*
         * The two manager
         */
        $_Player_Advert_Manager = new PlayersAdvertManager();
        $_Advert_Manager = new AdvertManager();

        /*
         * Check how much the player has advert
         */
        $_NumberAdvert = $_Player_Advert_Manager->CheckNumberAdvert($user);

        /*
         * If the player has one advert
         */
        if ($_NumberAdvert) {
            /*
             * If the number is equal to 1
             */
            if ($_NumberAdvert == 1) {

                /*
                 * Make the new date
                 */
                $date_e_1 = date('j-n-Y \a H:i:s', strtotime("+14 day"));
                $_g_date = str_replace(" ", "_", $date_e_1);
                $number = 2;

                /*
                 * Update the players advert database
                 */
                $_Player_Advert_Manager->UpdatePlayerAdvert($user, 2);
                /*
                 * Update the advert database with the new value
                 */
                $_Advert_Manager->UpdateAdvert($user, 1, NULL, NULL, NULL, NULL, $_g_date);


            } elseif ($_NumberAdvert == 2) {
                /*
                 * If the number is equal to 2
                 */
                /*
                 * Make the new date
                 */
                $date_e_2 = date('j-n-Y \a H:i:s', strtotime("+21 day"));
                $_g_date_2 = str_replace(" ", "_ ", $date_e_2);
                $date_e_3 = date('j-n-Y \a H:i:s', strtotime("+14 day"));
                $_g_date_3 = str_replace(" ", "_ ", $date_e_3);
                $number = 3;


                /*
                 * Update the advert database
                 * Update the advert database
                 * Update the players advert database
                 * Add player to banlist
                 */
                $_Advert_Manager->UpdateAdvert(str_replace(" ", "_", $user), 1, NULL, NULL, NULL, NULL, $_g_date_2);
                $_Advert_Manager->UpdateAdvert(str_replace(" ", "_", $user), 2, NULL, NULL, NULL, NULL, $_g_date_3);
                $_Player_Advert_Manager->UpdatePlayerAdvert($user, 3);
                $ban = new BanListManager();
                $ban->AddToBanlist($user, $staff);
                $ban = NULL;


            }
        } else {
            /*
             * If not, we create the user in the players advert database
             */
            $_Player_Advert_Manager->CreatePlayerAdvert($user);

        }

        /*
         * Add the new advert for the player
         */
        $_Advert_Manager->AddAdvert($user, $number, $reason, $staff, str_replace(" ", "_", $date_s), str_replace(" ", "_", $date_e));
        FrontTools::Webhook(
            str_replace("é", "e", $user), 
            $number,
            str_replace("é","e",
                str_replace("_", " " ,
                Tools::html($_POST['reason'])
                )
            )
            , $staff
        );

        /*
         * Redirect to the page
         */
        header('location:../../FrontEnd/index.php?redirect=warning&player=' . str_replace(" ", "_", $user) . '');

        /*
         * return true
         */
        return true;


    } else {
        /*
         * if not, redirect to the index page
         */
        header('location:../../FrontEnd/index.php?redirect=panel');
        return;

    }
} else {
    /*
     * if not, redirect to login page
     */
    header('location:../../FrontEnd/index.php');
    return;
}