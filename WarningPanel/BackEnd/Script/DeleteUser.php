<?php
/**
 * Copyright (c) iFive 2020.
 * Developed by Mus (Jun#666) for iFive.
 *  U are not allowed to use / edit php file without my permission.
 */

require "../../../Extra/vendor/autoload.php";
use App\Tool\Tools;
use App\Manager\UsersManager;

session_start();
//ini_set('display_errors','on');
date_default_timezone_set('Europe/Paris');
/*
 * If session variables are defined
 */
if(isset($_SESSION['AVERTO_USER']) && isset($_SESSION['AVERTO_PSWD']) && !empty($_SESSION['AVERTO_USER']) && !empty($_SESSION['AVERTO_PSWD']))
{
    /*
     * Manager
     * And check if user is admin
     */
    $_User_Manager = new UsersManager();
    $_is_admin = $_User_Manager->Is_admin($_SESSION['AVERTO_USER']);
    /*
     * If the user is admin
     */
    if ($_is_admin) {
        /*
         * If variables are defined
         */

        if(isset($_GET['id']) && !empty($_GET['id']))
        {
            /*
             * Secure the $_GET
             */
            $_id = Tools::html($_GET['id']);

            /*
             * Delete the user from the table
             */
            $_User_Manager->DeleteUsers($_SESSION['AVERTO_USER'], $_id);

            /*
             * Redirect to user page
             */
            header('location:../../FrontEnd/index.php?redirect=user&result=success');

            return;



        }
        else {

            /*
             * If variables are not defined
             * return to user page
             */

            header('location:../../FrontEnd/index.php?redirect=user');
            return;

        }



    } else {
        /*
         * If user is not admin, redirect to the user page
         */
        header('location:../../FrontEnd/index.php?redirect=panel');
        return;
    }


} else {

    /*
     * if not
     */

    /*
     * User manager
     */

    $user = new \App\Manager\UsersManager();

    /*
     * Disconnect the user
     */
    $user->Logout();
    $user = NULL;
    return false;
}
