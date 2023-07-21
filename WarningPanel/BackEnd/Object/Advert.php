<?php
/**
 * Copyright (c) iFive 2020.
 * Developed by Mus (Jun#666) for iFive.
 *  U are not allowed to use / edit php file without my permission.
 */

namespace App\Object;


/**
 * Class Advert
 * @package App\Object
 */
class Advert
{

    /**
     * @var
     */
    private $id;
    /**
     * @var
     */
    private $player;
    /**
     * @var
     */
    private $number;
    /**
     * @var
     */
    private $reason;
    /**
     * @var
     */
    private $staff;
    /**
     * @var
     */
    private $date_s;
    /**
     * @var
     */
    private $date_e;



    //CONSTRUCTEUR

    /**
     * Advert constructor.
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
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @return mixed
     */
    public function getDate_s()
    {
        return $this->date_s;
    }

    /**
     * @return mixed
     */
    public function getStaff()
    {
        return $this->staff;
    }

    /**
     * @return mixed
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * @return mixed
     */
    public function getDate_e()
    {
        return $this->date_e;
    }


    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $date_e
     */
    public function setDate_e($date_e)
    {
        $this->date_e = $date_e;
    }

    /**
     * @param mixed $date_s
     */
    public function setDate_s($date_s)
    {
        $this->date_s = $date_s;
    }

    /**
     * @param mixed $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @param mixed $player
     */
    public function setPlayer($player)
    {
        $this->player = $player;
    }

    /**
     * @param mixed $reason
     */
    public function setReason($reason)
    {
        $this->reason = $reason;
    }

    /**
     * @param mixed $staff
     */
    public function setStaff($staff)
    {
        $this->staff = $staff;
    }


}