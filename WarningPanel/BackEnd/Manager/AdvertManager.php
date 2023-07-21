<?php
/**
 * Copyright (c) iFive 2020.
 * Developed by Mus (Jun#666) for iFive.
 *  U are not allowed to use / edit php file without my permission.
 */

namespace App\Manager;
use App\Object\Advert;
use App\Tool\Tools;
use App\Manager\BanListManager;
use \PDO;

/**
 * Class AdvertManager
 * @package App\Manager
 */


class AdvertManager extends Model
{


    /**
     * @param $player
     * @param $number
     * @param $reason
     * @param $staff
     * @param $date_s
     * @param $date_e
     * @return bool
     */
    public function AddAdvert($player, $number, $reason, $staff, $date_s, $date_e){

        $hasAdvert = $this->HasAdvert($player);
        if($hasAdvert == 3) {

            $p_advert = new PlayersAdvertManager();

            $p_advert->DeletePlayers($player);
            $this->DeleteTotalAdvertForOnePlayer($player);

            $p_advert->CreatePlayerAdvert($player);



        }

            $bdd = $this->getBdd();
            $request = $bdd->prepare('INSERT INTO averto (player, number, reason, staff, date_s, date_e) VALUES (?, ?, ?, ?, ?, ?)');
            $request->execute(array($player, $number, $reason, $staff, $date_s, $date_e));
            $request->closeCursor();
            $request = NULL;

            return true;



    }

    /**
     * @param $player
     * @return bool
     */
    public function DeleteTotalAdvertForOnePlayer($player){

        try {
            if ($this->HasAdvert($player)) {

                $bdd = $this->getBdd();
                $request = $bdd->prepare('DELETE FROM averto WHERE player = ?');
                $request->execute(array($player));
                $request->closeCursor();
                $request = NULL;

                // Tools::Log($_SESSION['AVERTO_USER'] . ' has deleted all warnings of ' . $player);

                return true;

            } else {
                return false;
            }
        } catch (\Throwable $e){ $e->getMessage(); return false;}
    }

    /**
     * @param $player
     * @param $advert
     * @return bool
     */
    public function DeleteOneAdvertForOnePlayer($player, $advert){


        try {
            if ($this->HasAdvert($player)) {

                $bdd = $this->getBdd();
                $request = $bdd->prepare('DELETE FROM averto WHERE player = ? AND number = ?');
                $request->execute(array($player, $advert));
                $request->closeCursor();
                $request = NULL;

                // Tools::Log($_SESSION['AVERTO_USER'] . ' has deleted 1 warnings of ' . $player);


                return true;

            } else {
                return false;
            }
        } catch (\Throwable $e){ $e->getMessage(); return false;}


    }

    /**
     * @return int
     */
    public function GetTotalOfPlayerWithAdvert(){

        $bdd = $this->getBdd();
        $request = $bdd->prepare('SELECT count(*) as total from averto');
        $request->execute();
        $data = $request->fetch(PDO::FETCH_ASSOC);
        $request->closeCursor();
        $request = NULL;

        return $data['total'] == 0 ? 0 : $data['total'];

    }

    /**
     * @param $player
     * @return bool
     */
    private function HasAdvert($player){

        $bdd = $this->getBdd();
        $request = $bdd->prepare('SELECT count(*) as total from averto WHERE player = ?');
        $request->execute(array($player));
        $data = $request->fetch(PDO::FETCH_ASSOC);
        $request->closeCursor();
        $request = NULL;

        return $data['total'] == 0 ? false : $data['total'];


    }


    /**
     * @param $player
     * @return array|bool
     */
    public function SelectAllAdvert($player){

        if($this->HasAdvert($player)) {
            $bdd = $this->getBdd();
            $var = [];
            $request = $bdd->prepare('SELECT * FROM averto WHERE player = ?');
            $request->execute(array($player));
            while ($data = $request->fetch(PDO::FETCH_ASSOC)) {

                $var[] = new Advert($data);

            }
            $request->closeCursor();
            $request = NULL;


            return $var ? $var : false;
        } else {
            return false;
        }

    }

    /**
     * @param $player
     * @param $number
     * @return array|bool
     */
    public function SelectInfoFromSpecificAdvert($player, $number){

        if($this->HasAdvert($player)){

            $bdd = $this->getBdd();
            $var = [];
            $request = $bdd->prepare('SELECT * FROM averto WHERE player = ? AND number = ?');
            $request->execute(array($player, $number));
            while($data = $request->fetch(PDO::FETCH_ASSOC)){
                $var[] = new Advert($data);
            }


            $request->closeCursor();
            $request = NULL;
            return $var;

        } else {
            return false;
        }

    }

    /**
     * @param $player
     * @param $number
     * @param $reason
     * @param $staff
     * @return bool
     */
    public function UpdateAdvert($player, $actualNumber, $number, $reason, $staff, $date_s, $date_e){

        $has_advert = $this->HasAdvert($player);

        if($has_advert){
            $h_advert = $this->SelectInfoFromSpecificAdvert($player, $actualNumber);

            if($number == NULL) $number = $h_advert[0]->getNumber();
            if($reason == NULL) $reason = $h_advert[0]->getReason();
            if($staff == NULL) $staff = $h_advert[0]->getStaff();
            if($date_s == NULL) $date_s = $h_advert[0]->getDate_s();
            if($date_e == NULL) $date_e = $h_advert[0]->getDate_e();

            $bdd = $this->getBdd();
            $request = $bdd->prepare('UPDATE averto SET number = ?, reason = ?, staff = ?, date_s = ?, date_e = ? WHERE player = ? AND number = ?');
            $request->execute(array($number, $reason, $staff, $date_s, $date_e, $player, $h_advert[0]->getNumber()));
            $request->closeCursor();
            $request = NULL;

            return true;

        }
            return false;
    }

    /**
     * @param $id
     * @return array|bool
     */
    public function GetInfoById($id){
        try {
            $bdd = $this->getBdd();
            $var = [];
            $request = $bdd->prepare("SELECT * FROM averto WHERE id = ?");
            $request->execute(array($id));
            while ($data = $request->fetch(PDO::FETCH_ASSOC)) {
                $var[] = new Advert($data);
            }
            $request->closeCursor();
            $request = NULL;
            if ($var) {
                return $var;
            } else {
                return false;
            }
        } catch (\Throwable $e){
            $e->getMessage();
            return false;
        }

    }

    /**
     * @param $player
     * @param $id
     * @return bool
     */
    public function DeleteWarningById($player , $id){

        try {
            if ($this->HasAdvert($player)) {

                $_to_return = $this->GetInfoById($id);

                $bdd = $this->getBdd();
                $request = $bdd->prepare('DELETE FROM averto WHERE player = ? AND id = ?');
                $request->execute(array($player, $id));
                $request->closeCursor();
                $request = NULL;

                // Tools::Log($_SESSION['AVERTO_USER'] . ' has deleted one warnings of ' . $player);


                return $_to_return;

            } else {
                return false;
            }
        } catch (\Throwable $e){ $e->getMessage(); return false;}


    }



}