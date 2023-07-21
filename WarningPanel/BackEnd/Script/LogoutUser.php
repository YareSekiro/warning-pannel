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
if(isset($_SESSION['AVERTO_USER']) && !empty($_SESSION['AVERTO_USER'])) {
    $_UM = new UsersManager();
    $_UM->Logout();
    $_UM = NULL;
    return;

} else {

    header('location:../../FrontEnd/index.php');
    return;


}