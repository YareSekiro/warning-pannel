<?php


//require('../Extra/vendor/autoload.php');
require '../../Extra/vendor/autoload.php';

use App\Manager\UsersManager;
use App\Manager\PlayersAdvertManager;
use App\Manager\AdvertManager;
use App\Manager\BanListManager;
use App\Tool\Tools;
ini_set('display_errors', 'On');
session_start();
/*
 * If a page is specified
 */
if(isset($_GET['redirect'])){

    /*
     * Secure the url data
     */
    $_secure = Tools::html($_GET['redirect']);
    /*
     * Defined the page link
     */
    $data = "view/{$_secure}View.php";

    /*
     * If the user isn't connected, redirect to the login page
     */
    if(!isset($_SESSION['AVERTO_USER'])){
        header('location:index.php');
        return;
    }

    /*
     * If the file exist
     */
    if(file_exists($data)) {

        if($data == "view/loginView.php") {header('location:index.php'); return;}
        /*
         * Start to get the data
         */
        ob_start();
        /*
         * include the data
         */
        require "view/{$_secure}View.php";
        /*
         * get the data and clear
         */
        $_get = ob_get_clean();

    } else {
        /*
         * if not redirect to login page
         */
        header('location:index.php');
        return;

    }


} else {
    /*
     * if not
     */
    /*
     * if the user is already connected, redirect to panel page
     */
    if (isset($_SESSION['AVERTO_USER'], $_SESSION['AVERTO_PSWD'])) {

        header('location:index.php?redirect=panel');

        return;

    } else {
        /*
         * if not, display the form login page
         */
        //ob_start();

        require "view/loginView.php";

        //$_get = ob_get_clean();

        return;

    }


}
/*
 * require the page template
 */
require "template/layout.php";