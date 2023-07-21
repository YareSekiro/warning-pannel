<?php
/**
 * Copyright (c) iFive 2020.
 * Developed by Mus (Jun#666) for iFive.
 *  U are not allowed to use / edit php file without my permission.
 */

namespace App\Manager;
use App\Object\PlayersAdvert;
use App\Manager\AdvertManager;
use \PDO;

/**
 * Class PlayersAdvertManager
 * @package App\Manager
 */
class PlayersAdvertManager extends Model
{

    /**
     * @param $player
     * @return bool
     */
    public function CheckNumberAdvert($player){

        if($this->CheckIfUserHasAdvert($player)){

            $bdd = $this->getBdd();
            $request = $bdd->prepare('SELECT totalaverto FROM players_avert WHERE player = ?');
            $request->execute(array($player));
            $data = $request->fetch(PDO::FETCH_ASSOC);
            $request->closeCursor();
            $request = NULL;

            return $data['totalaverto'];


        }else{
            return false;
        }


    }

    /**
     * @param $player
     * @return bool
     */
    private function CheckIfUserHasAdvert($player){

        $bdd = $this->getBdd();
        $request = $bdd->prepare('SELECT * FROM players_avert WHERE player = ?');
        $request->execute(array($player));
        $data = $request->fetch(PDO::FETCH_ASSOC);
        $request->closeCursor();
        $request = NULL;

        return $data ? true : false;

    }


    /**
     * @param $player
     * @return bool
     */
    public function CreatePlayerAdvert($player){

        $hasAdvert = $this->CheckIfUserHasAdvert($player);
        if($hasAdvert) {
            $ad = $this->CheckNumberAdvert($player);
            $this->UpdatePlayerAdvert($player, ($ad + 1));
            return true;
        }else{

            $bdd = $this->getBdd();
            $request = $bdd->prepare('INSERT INTO players_avert (player, totalaverto) VALUES (?, ?)');
            $request->execute(array($player, 1));
            $request->closeCursor();
            $request = NULL;

            return true;

        }




    }


    /**
     * @param $player
     * @param $number
     * @return bool
     */
    public function UpdatePlayerAdvert($player, $number){

        $hasAdvert = $this->CheckIfUserHasAdvert($player);
        if($hasAdvert){

            $bdd = $this->getBdd();
            $request = $bdd->prepare('UPDATE players_avert SET totalaverto = ? WHERE player = ?');
            $request->execute(array($number, $player));
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
    public function DeletePlayers($player){

        $has_advert = $this->CheckIfUserHasAdvert($player);
        if($has_advert){

            $bdd = $this->getBdd();
            $request = $bdd->prepare('DELETE FROM players_avert WHERE player = ?');
            $request->execute(array($player));
            $request->closeCursor();
            $request = NULL;
            return true;

        }

        return false;

    }

    /**
     * @return array|bool
     */
    public function SelectAllFromPlayersAdvert(){
        $var = [];
        $bdd = $this->getBdd();
        $request = $bdd->prepare('SELECT * FROM players_avert');
        $request->execute();
        while($data = $request->fetch(PDO::FETCH_ASSOC)){

            $var[] = new PlayersAdvert($data);

        }

        $request = NULL;
        return $var ? $var : false;

    }

    /**
     * @return int
     */
    public function SelectNumberAverto(){

        $bdd = $this->getBdd();
        $request = $bdd->prepare('SELECT count(*) as total from players_avert');
        $request->execute();
        $data = $request->fetch(PDO::FETCH_ASSOC);
        $request->closeCursor();
        $request = NULL;

        return $data['total'] == 0 ? 0 : $data['total'];
    }










}