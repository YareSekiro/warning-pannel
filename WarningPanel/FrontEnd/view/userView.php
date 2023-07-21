<?php
/**
 * Copyright (c) iFive 2020.
 * Developed by Mus (Jun#666) for iFive.
 *  U are not allowed to use / edit php file without my permission.
 */

/*
 * Use
 */
use App\Manager\AdvertManager;
use App\Manager\PlayersAdvertManager;
use App\Tool\FrontTools;
use App\Tool\Tools;
use App\Manager\UsersManager;

/*
 * Check if $_GET is define
 */
if(isset($_GET['redirect']) && $_GET['redirect'] == "user") {

    /*
     * Check if user is connected
     */
    if (isset($_SESSION['AVERTO_USER'])) {

        /*
         * Manager
         */
        $_Advert_Manager = new AdvertManager();
        $_Players_Manager = new PlayersAdvertManager();
        $_User_Manager = new UsersManager();

        /*
         * Check if user is admin
         */
        $_is_admin = $_User_Manager->Is_admin($_SESSION['AVERTO_USER']);
        echo '<div class = "row">';
        echo '<div class = "container-fluid">';

        /*
         * If user is admin
         */
        if($_is_admin) {

                /*
                 * Get all users
                 */
                $_data = $_User_Manager->SelectAllUsers();

                /*
                 * Create the table
                 */
                FrontTools::CreateTable("Users", "see_users","user_body" , "user" , $_data, "user" , true);

                /*
                 * Define the id, name, and msg display for the form
                 */
                $_id_name_placeholder = array(

                    "id" => ["user" , "pswd" , "perm" , "img"],
                    "name" => ["user" , "pswd" , "perm" , "img"],
                    "msg" => ["Username" , "User password" , "is Admin? (1 or 0)" , "img link"]

                );

                /*
                 * Create the form
                 */
                FrontTools::CreateForm("add_user" , "none","img/add_user.gif" , "Add new user" , "form_user" , "user" , "../BackEnd/Script/CreateNewUser.php" ,4 , $_id_name_placeholder, "Add user");


                /*
                 * Same
                 */
                $_id_name_placeholder = array(

                    "id" => ["user"],
                    "name" => ["user"],
                    "msg" => ["Username"]

                );

                /*
                 * Create the form
                 */
                FrontTools::CreateForm("delete_user" ,"none", "img/delete_user.gif" , "Delete user" , "delete_user" , "user" , "../BackEnd/Script/DeleteUser.php" , 1, $_id_name_placeholder, "Delete user");

                FrontTools::CreateModal("Logout?" , "logoutModal" , true);


            } else {
            /*
             * If player is not admin , redirect to panel
             */
            header('location:index.php?redirect=panel');
            return;
        }



    } else {
        /*
         * If player is not connected redirect to home page
         */
        header('location:index.php');
        return;
    }


} else {

    /*
     * If $_GET is not define redirect to home page
     */
    header('location:index.php');
    return;

}