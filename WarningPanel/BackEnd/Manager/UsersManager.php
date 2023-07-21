<?php
/**
 * Copyright (c) iFive 2020.
 * Developed by Mus (Jun#666) for iFive.
 *  U are not allowed to use / edit php file without my permission.
 */

namespace App\Manager;

use App\Manager\Model;
use App\Object\Users;
use App\Tool\Tools;
use \PDO;
//require_once('Model.php');
//require_once('../Object/Users.php');
//require_once('../Tool/Tools.php');

/**
 * Class UsersManager
 * @package App\Manager
 */

/**
 * 1./ CHECK FUNCTION -> Validate an user connexion
 * 2./ User exist function -> Return true if user exist , false if not
 * 3./ Create user function -> Insert new users in database
 * 4./ Is_admin function -> Return true if user is an admin, false if not
 * 5./ Delete users function -> Delete user in database
 * 6./ Logout function -> Disconnect an user of his session
 * 7./ Update users -> Update an users infos in database
 * 8./ Return users infos -> Return the wanted infos of an users
 */

class UsersManager extends Model
{

    /**
     * @param $log
     * @param $password
     * @return bool
     */
    public function Check($log, $password)
    {
        if (isset($log, $password) && !empty($log) && !empty($password)) {
            if ($this->CheckIfUserExist($log)) {
                $var = [];
                $bdd = $this->getBdd();
                $users_infos = $bdd->prepare('SELECT * FROM users WHERE login=:log');
                $users_infos->bindParam(':log', $log);
                $users_infos->execute();
                while ($data = $users_infos->fetch(PDO::FETCH_ASSOC)) {
                    $var[] = new Users($data);
                }

                $users_infos->closeCursor();
                $users_infos = NULL;
                $user_login = $var[0]->getLogin();
                $user_password = $var[0]->getPassword();
                $verification = Tools::hashCheck($password, $user_password);

                if ($verification) {
                    session_start();
                    $_SESSION['AVERTO_USER'] = $user_login;
                    $_SESSION['AVERTO_PSWD'] = $user_password;
                    $var[0] = NULL;


                    return true;

                } else {
                    return false;
                }

            } else {
                return false;
            }

        } else {
            return false;
        }

    }


    /**
     * @param $log
     * @return bool
     */
    private function CheckIfUserExist($log)
    {

        if (isset($log) && !empty($log)) {

            $bdd = $this->getBdd();

            $user_i = $bdd->prepare('SELECT * FROM users WHERE login = ?');

            $user_i->execute(array($log));

            
            $data = $user_i->fetch(PDO::FETCH_ASSOC);
            $user_i->closeCursor();
            $user_i = NULL;

            return $data ? true : false;


        } else {
            return false;
        }

    }

    /**
     * @param $log
     * @param $mdp
     * @param $is_admin
     * @param $img
     * @return bool
     */
    public function CreateUsers($log, $mdp, $is_admin, $img)
    {

        if ($this->CheckIfUserExist($log)) {

            return false;

        } else {


            try {
                $bdd = $this->getBdd();
                $hachedmdp = Tools::hashMake($mdp);

                $request = $bdd->prepare('INSERT INTO users (login, password, perm, img) VALUES (?, ?, ?, ?)');

                $request->execute(array($log, $hachedmdp, $is_admin, $img));

                
                $request->closeCursor();
                $request = NULL;
                return true;
            } catch (\Throwable $e) {
                die('Erreur ' . $e->getMessage());
            }


        }

    }


    /**
     * @param $log
     * @param $password
     * @return bool|string
     */
    public function Is_admin($log)
    {

        $_exist = $this->CheckIfUserExist($log);
        if ($_exist) {

            $bdd = $this->getBdd();
            $request = $bdd->prepare('SELECT perm FROM users WHERE login = ?');
            $request->execute(array($log));
            $data = $request->fetch(PDO::FETCH_ASSOC);
            $request = NULL;
            if($data['perm'] == 1){
                return true;
            } else {
                return false;
            }

        } else {

            return "User didn't exist";

        }


    }

    /**
     * @param $log
     * @param $mdp
     * @param $loginOfUser
     * @return bool|string
     */
    public function DeleteUsers($log, $idToDelete)
    {

        $_admin = $this->Is_admin($log);
        //CHECK IF USER IS AN ADMIN
        if ($_admin){

                $bdd = $this->getBdd();
                $request = $bdd->prepare('DELETE FROM users WHERE id = ?');
                $request->execute(array($idToDelete));
                $request->closeCursor();
                $request = NULL;




        } else {
            return "You may not have the permissions";
        }


    }

    /**
     * @return bool
     */
    public function Logout()
    {

        session_start();

        if ($_SESSION) {


            session_unset();


            session_destroy();

            header('location:../../FrontEnd/index.php');

            return true;

        } else {
            return false;
        }


    }


    /**
     * @param $login
     * @param $password
     * @param $infoWanted
     * @param $new
     * @return bool
     */
    public function UpdateUser($login, $password, $infoWanted, $new){

        if($this->Check($login, $password)) {
            $infos = $this->ReturnOneUserInfo($login, $infoWanted);
            if ($infos) {

                $bdd = $this->getBdd();
                if ($infos == "login") {
                    $r = "UPDATE users SET login = ? WHERE login = ?";
                } elseif ($infos == "password") {
                    $r = "UPDATE users SET password = ? WHERE login = ?";
                } elseif ($infos == "perm") {
                    $r = "UPDATE users SET perm = ? WHERE login = ?";
                } elseif ($infos == "img") {
                    $r = "UPDATE users SET img = ? WHERE login = ?";
                }

                $request = $bdd->prepare($r);
                $request->execute(array($new, $login));
                $request->closeCursor();
                $request = NULL;

                return true;

            } else {
                return false;
            }

        }else{
            return false;
        }
    }

    /**
     * @param $player
     * @param $infoWanted
     * @return bool
     */
    public function ReturnOneUserInfo($player, $infoWanted){

        if($this->CheckIfUserExist($player)){

            
                $bdd = $this->getBdd();
                $request = $bdd->prepare('SELECT * FROM users WHERE login = ?');
                $request->execute(array($player));
                $data = $request->fetch(PDO::FETCH_ASSOC);

                return $data ? $data[$infoWanted] : false;


        } else{
            return false;
        }

    }

    /**
     * @return array|bool
     */
    public function SelectAllUsers(){

        $bdd = $this->getBdd();
        $var = [];
        $request = $bdd->prepare('SELECT * FROM users');
        $request->execute();
        while($data = $request->fetch(PDO::FETCH_ASSOC)){

            $var[] = new Users($data);


        }

        $request->closeCursor();
        $request = NULL;

        return $var ? $var : false;

    }














}