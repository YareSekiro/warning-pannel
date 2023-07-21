<?php
/**
 * Copyright (c) iFive 2020.
 * Developed by Mus (Jun#666) for iFive.
 *  U are not allowed to use / edit php file without my permission.
 */

namespace App\Manager;
use App\Object\BanList;
use App\Tool\Tools;
use \PDO;
//use App\Tools\Tools;

/**
 * Class BanListManager
 * @package App\Manager
 */


class BanListManager extends Model
{

    /**
     * @param $player
     * @param $_author
     * @return bool
     */
    public function AddToBanlist($player, $_author){

        if($this->CheckBanList($player)){

            $this->UpdateBanList($player, $_author);
            return true;

        } else {

            $bdd = $this->getBdd();
            $request = $bdd->prepare('INSERT INTO banlist (player, bannumber) VALUES (?, ?)');
            $request->execute(array($player, 1));
            $request->closeCursor();
            $request = NULL;

            Tools::SendWebhook($_author, $player, 1);
            return true;
        }
    }

    /**
     * @param $player
     * @return bool
     */
    private function SelectBanNumberFromBanListForSpecificPlayer($player){

        $data = $this->CheckBanList($player);
        if($data){

            $bdd = $this->getBdd();
            $request = $bdd->prepare('SELECT bannumber FROM banlist WHERE player = ?');
            $request->execute(array($player));
            $data = $request->fetch(PDO::FETCH_ASSOC);
            $request->closeCursor();
            $request = NULL;

            return $data['bannumber'];


        } else {
            return false;
        }

    }

    /**
     * @param $player
     * @return bool
     */
    public function SelectAllFromBanListForSpecificPlayer($player){

        $data = $this->CheckBanList($player);
        if($data){

            $bdd = $this->getBdd();
            $request = $bdd->prepare('SELECT * FROM banlist WHERE player = ?');
            $request->execute(array($player));
            $data = $request->fetch(PDO::FETCH_ASSOC);
            $request->closeCursor();
            $request = NULL;

            return $data;


        } else {
            return false;
        }

    }

    /**
     * @param $player
     * @return bool
     */
    public function DeleteFromBanList($player){

        if($this->CheckBanList($player)){

            $bdd = $this->getBdd();
            $request = $bdd->prepare('DELETE FROM banlist WHERE player = ?');
            $request->execute(array($player));
            $request->closeCursor();
            $request = NULL;

            return true;

        } else{
            return false;
        }

    }

    /**
     * @param $player
     * @return bool
     */
    private function UpdateBanList($player, $_author){

        if($this->CheckBanList($player)){
            try{
                $new = $this->SelectBanNumberFromBanListForSpecificPlayer($player) + 1;
                $bdd = $this->getBdd();
                print($player . ' | ' . $new);
                $request = $bdd->prepare('UPDATE banlist SET bannumber = ? WHERE player = ?');
                $request->execute(array($new, $player));
                //$request->execute(array("John" , 2));
                $request->closeCursor();
                $request = NULL;

                Tools::SendWebhook($_author, $player, $new);



                return true;
            } catch (\Throwable $e) { $e->getMessage();}

        } else {
            die('nope');
            return false;
        }

    }
    /**
     * @param $player
     * @return bool
     */
    public function CheckBanList($player){

        $bdd = $this->getBdd();
        $request = $bdd->prepare('SELECT bannumber FROM banlist WHERE player = ?');
        $request->execute(array($player));
        $data = $request->fetch(PDO::FETCH_ASSOC);
        $request->closeCursor();
        $request = NULL;

        return $data ? true : false;

    }

    /**
     * @return int
     */
    public function GetTotalBannedPlayers(){

        $bdd = $this->getBdd();
        $request = $bdd->prepare('SELECT count(*) as total from banlist');
        $request->execute();
        $data = $request->fetch(PDO::FETCH_ASSOC);
        $request->closeCursor();
        $request = NULL;

        return $data['total'] == 0 ? 0 : $data['total'];
    }

    /**
     * @return array
     */
    public function SelectAllFromBanList(){


            $bdd = $this->getBdd();
            $var = [];
            $request = $bdd->prepare('SELECT * FROM banlist');
            $request->execute(array());
            while($data = $request->fetch(PDO::FETCH_ASSOC)){

                $var[] = new BanList($data);

            }
            $request->closeCursor();
            $request = NULL;

            return $var;




    }

}