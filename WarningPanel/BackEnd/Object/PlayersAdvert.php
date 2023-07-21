<?php
/**
 * Copyright (c) iFive 2020.
 * Developed by Mus (Jun#666) for iFive.
 *  U are not allowed to use / edit php file without my permission.
 */

namespace App\Object;

/**
 * Class PlayersAdvert
 * @package App\Object
 */
class PlayersAdvert
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
    private $total;

    /**
     * PlayersAdvert constructor.
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
    }//END O

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
    public function getTotal()
    {
        return $this->total;
    }


    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $player
     */
    public function setPlayer($player)
    {
        $this->player = $player;
    }

    /**
     * @param mixed $total
     */
    public function setTotalaverto($total)
    {
        $this->total = $total;
    }

}