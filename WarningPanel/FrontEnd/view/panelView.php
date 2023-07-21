<?php
/**
 * Copyright (c) iFive 2020.
 * Developed by Mus (Jun#666) for iFive.
 *  U are not allowed to use / edit php file without my permission.
 */

use App\Manager\AdvertManager;
use App\Manager\PlayersAdvertManager;
use App\Manager\BanListManager;
use App\Tool\FrontTools;
if(isset($_GET['redirect']) && $_GET['redirect'] == "panel") {
    if(isset($_SESSION)) {

        /*
         * Create the three needed managers
         */
        $_Advert_Manager = new AdvertManager();
        $_Players_Manager = new PlayersAdvertManager();
        $_BanList_Manager = new BanListManager();


        /*
         * Return how much player has warning
         */
        $_card_data = $_Players_Manager->SelectNumberAverto();


        /*
         * Return the total of warnings in progress
         */
        $_second_card_data = $_Advert_Manager->GetTotalOfPlayerWithAdvert();

        /*
         * Return the total of players get banned
         */
        $_third_card_data = $_BanList_Manager->GetTotalBannedPlayers();


        /*
         * Create the header title of the page
         */
        //echo '<div class = "container-fluid">';
        FrontTools::CreateHeaderTitle("Home");
        //echo '<div class = "row">';

        echo '<div class="row">';
        /*
         * Create the card that print the total of players with advert
         */
        FrontTools::CreateCard('border-left-primary', "Player with warnings", $_card_data);

        /*
         * Create the card that print the total of warnings in progress
         */
        FrontTools::CreateCard('border-left-success', "Warnings in progress", $_second_card_data);

        /*
         * Create the card that print how much players get banned for too much warning
         */
        FrontTools::CreateCard('border-left-warning' , "Banned For Too much warning" , $_third_card_data);

        echo '</div>';
        /*
         * Return the player list in player_advert database
         */
        $_player_list = $_Players_Manager->SelectAllFromPlayersAdvert();

        /*
         * Return all players in banlist database
         */
        $_ban_list = $_BanList_Manager->SelectAllFromBanList();

        $_tab_date_s = [];
        $_tab_date_e = [];

        /*
         * Get the date
         */
        if($_player_list) {
            for ($i = 0; $i < sizeof($_player_list); $i++) {


//                echo $_player_list[$i]->getPlayer() . " | " . $_player_list[$i]->getTotal() . " |";
                $_get_date = $_Advert_Manager->SelectInfoFromSpecificAdvert($_player_list[$i]->getPlayer(), $_player_list[$i]->getTotal());

                $_tab_date_s[] = $_get_date[0]->getDate_s();
                $_tab_date_e[] = $_get_date[0]->getDate_e();

            }
        }

        /*
         * Push all value in one array for CreateTable function
         */
        $_final = array(
          "value"=> $_player_list,
          "date_s"=> $_tab_date_s,
          "date_e"=> $_tab_date_e
        );

        /*
         * Push all value like id / name / and the placeholder message in one array for CreateFrom function
         */
        $_id_name_placeholder = array(

            "id" => ["player", "reason"],
            "name" => ["player", "reason"],
            "msg" => ["Player name", "Warning reason"]


        );

        /*
         * Create the search button
         */
        echo '<div class = "row">';
        echo '<div class = "container-fluid">';
//        FrontTools::CreateButton("button", "search", "search", "btn btn-outline-success btn-user btn-block", "search_modal", "Search players");
//        /*
//         * Create the add button
//         */
//        FrontTools::CreateButton("button", "add", "add", "btn btn-outline-success btn-user btn-block", false, "Add players");

        /*
         * Create the table with all players that have warnings
         */
        FrontTools::CreateTable("Warning players" , "see_panel","panel_body","panel", $_final, "panel", true);

        /*
         * Create the form for add a new players
         */
        FrontTools::CreateForm("add_user","none" , "img/add.gif", "Add players" , "form_user" , "user" , "../BackEnd/Script/AddNewAdvertToUser.php" , 2, $_id_name_placeholder, "Add the players.");

        /*
         * Create the table with all players that get banned
         */
        FrontTools::CreateTable("BanList" , "see_ban","ban_body","banlist", $_ban_list, "panel", false);
//        FrontTools::CreateTable("Warning players |" , "panel", $_final, "panel");

        /*
         * Create the modal when a player has been successfully added
         */
        FrontTools::CreateModal("Player added" , "player_added" , false);
        /*
         * Create the modal when u want to logout
         */
        FrontTools::CreateModal("Logout?" , "logoutModal" , true);

        FrontTools::CreateAdvancedModal("search_modal" , $_player_list);




    } else {
        header('location:index.php');
    }
} else {
    header('location:index.php');
}
