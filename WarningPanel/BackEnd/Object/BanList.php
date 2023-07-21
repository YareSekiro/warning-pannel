<?php
/**
 * Copyright (c) iFive 2020.
 * Developed by Mus (Jun#666) for iFive.
 *  U are not allowed to use / edit php file without my permission.
 */

namespace App\Object;


/**
 * Class BanList
 * @package App\Object
 */
class BanList
{

    /**
     * @var
     */
    private $_id;
    /**
     * @var
     */
    private $_player;
    /**
     * @var
     */
    private $_bannumber;


    /**
     * BanList constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->hydrate($data);
    }//END OF CONSTRUCT

    /**
     * @param array $data
     */
    public function hydrate(array $data)
    {
        foreach($data as $key => $value)
        {
            $method = 'set'.ucfirst($key);
            if(method_exists($this , $method))
            {
                $this->$method($value);
            }//END OF IF
        }//END OF FOREACH
    }//END OF HYDRATE


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @return mixed
     */
    public function getPlayer()
    {
        return $this->_player;
    }

    /**
     * @return mixed
     */
    public function getBannumber()
    {
        return $this->_bannumber;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * @param mixed $player
     */
    public function setPlayer($player)
    {
        $this->_player = $player;
    }

    /**
     * @param mixed $bannumber
     */
    public function setBannumber($bannumber)
    {
        $this->_bannumber = $bannumber;
    }


}