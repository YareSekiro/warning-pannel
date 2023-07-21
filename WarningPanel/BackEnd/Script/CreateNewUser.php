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
ini_set('display_errors','on');
date_default_timezone_set('Europe/Paris');
/*
 * If session variables are defined
 */
if(isset($_SESSION['AVERTO_USER']) && isset($_SESSION['AVERTO_PSWD']) && !empty($_SESSION['AVERTO_USER']) && !empty($_SESSION['AVERTO_PSWD']))
{
    $_User_Manager = new UsersManager();
    $_is_admin = $_User_Manager->Is_admin($_SESSION['AVERTO_USER']);

    if($_is_admin){
            /*
             * If variables are defined
             */
            if(isset($_POST['user'] , $_POST['pswd'], $_POST['perm'], $_POST['img']) && !empty($_POST['user']) && !empty($_POST['pswd']) && !empty($_POST['img'])) {

                /*
                 * Get the form variables
                 */
                $user = str_replace(" ", "_", Tools::html($_POST['user']));
                $password = str_replace(" ", "_", Tools::html($_POST['pswd']));
                $perm = str_replace(" ", "_", Tools::html($_POST['perm']));
                $img = str_replace(" ", "_", Tools::html($_POST['img']));

                /*
                 * Create the user in the user table
                 */
                $_User_Manager->CreateUsers($user, $password, $perm, $img);

                /*
                 * Defined to null
                 */
                $_User_Manager = NULL;

                /*
                 * Redirect to the user page
                 */
                header('location:../../FrontEnd/index.php?redirect=user&f=list');
                return;

            } else {
                /*
                 * Redirect to the user page
                 */

                header('location:../../FrontEnd/index.php?redirect=user&f=list');
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