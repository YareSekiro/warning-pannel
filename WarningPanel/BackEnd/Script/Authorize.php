<?php
/**
 * Copyright (c) iFive 2020.
 * Developed by Mus (Jun#666) for iFive.
 *  U are not allowed to use / edit php file without my permission.
 */

require '../../../Extra/vendor/autoload.php';


use App\Tool\Tools;
use App\Manager\UsersManager;

    /*
     * If the form variables are defined
     */
    if(isset($_POST['user']) && isset($_POST['pswd']) && !empty($_POST['user']) && !empty($_POST['pswd']))
    {
        /*
         * Replace the space with _
         */
        $user = str_replace(" ", "_" ,Tools::html($_POST['user']));
        $password = str_replace(" " , "_", Tools::html($_POST['pswd']));

        /*
         * User manager
         */
        $_User_Manager = new UsersManager();
        /*
         * Check if the user is authorize (return true if yes, false if not)
         */
        $data = $_User_Manager->Check($user, $password);
        /*
         * If true
         */
        if($data){

            /*
             * Redirect to the panel page
             */
            $perm = $_User_Manager->ReturnOneUserInfo($user, "perm");
            $img = $_User_Manager->ReturnOneUserInfo($user, "img");
            $_SESSION['AVERTO_USER'] = $user;
            $_SESSION['AVERTO_PSWD'] = $password;
            $_SESSION['AVERTO_PERM'] = $perm;
            $_SESSION['AVERTO_IMG'] = $img;
            header('location:CheckV2.php');

            /*
             * return true
             */
            return true;
        } else {

            /*
             * if not return false
             */
            header('location:../../FrontEnd/index.php');
            return false;
        }


    } else {
        /*
         * If post variables are not defined
         * Redirect to the login page
         * Return false
         */
        header('location:../../FrontEnd/index.php');
        echo 'off2';
        return false;
    }
