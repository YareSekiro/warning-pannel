<?php
/**
 * Copyright (c) iFive 2020.
 * Developed by Mus (Jun#666) for iFive.
 *  U are not allowed to use / edit php file without my permission.
 */

use App\Manager\AdvertManager;
use App\Manager\PlayersAdvertManager;
use App\Tool\FrontTools;
use App\Tool\Tools;
use App\Manager\UsersManager;
if(isset($_GET['redirect'], $_GET['player']) && $_GET['redirect'] == "warning") {

    if (isset($_SESSION)) {

        /*
         * Create the two needed managers
         */
        $_Advert_Manager = new AdvertManager();
        $_Players_Manager = new PlayersAdvertManager();
        $_player = Tools::html($_GET['player']);
        // $_User_Manager = new UsersManager();

        // $_is_admin = $_User_Manager->Is_admin($_SESSION['AVERTO_USER'] , $_SESSION['AVERTO_PSWD']);

        // /*
        //  * If the user is admin
        //  */
        // if($_is_admin) {
        //     /*
        //      * Header title
        //      */


            FrontTools::CreateHeaderTitle(str_replace("_" , " " ,$_player));



            /*
             * Get the warning data of the player
             */
            $_data = $_Advert_Manager->SelectAllAdvert($_player);


            /*
             * Push all value like id / name / and the placeholder message in one array for CreateFrom function
            */
            $_id_name_placeholder = array(

                "id" => ["reason", "staff"],
                "name" => ["reason", "staff"],
                "msg" => ["Warning reason", "Staff"]

            );
            echo '<div class = "row">';
            echo '<div class = "container-fluid">';
            /*
             * Create the add button
             */
            //FrontTools::CreateButton("button", "add", "add", "btn btn-outline-success btn-user btn-block", false, "Add warning");

            /*
             * Create the table for display the warnings of the players
             */
            FrontTools::CreateTable("Player warnings", "see_warnings" , "warnings_body" , "warning", $_data, "warning", true);

            /*
             * Create the form for add a new warning
             */
            FrontTools::CreateForm("add_warning", "none", "img/add.gif", "Add warning", "form_user", "user", "../BackEnd/Script/AddNewAdvertToUser.php?player=$_player", 2, $_id_name_placeholder, "Add the warning.");

            /*
             * Modal that display when a warning is added
             */
            FrontTools::CreateModal("Warning added", "warning_added", false);
            /*
             * modal that confirm if u want to logout.
             */
            FrontTools::CreateModal("Logout?" , "logoutModal" , true);


            return true;
        // } else {

        //     /*
        //      * if not , redirect to home page
        //      */
        //     header('location:index.php?redirect=panel');
        //     return false;


        // }









    } else {

        header('location:index.php');
        return;

    }

} else {

    header('location:index.php');
    return;

}