<?php
/**
 * Copyright (c) iFive 2020.
 * Developed by Mus (Jun#666) for iFive.
 *  U are not allowed to use / edit php file without my permission.
 */

//namespace iFive\Ems;
namespace App\Object;


/**
 * Class Users
 * @package App\Object
 */
class Users
{
    /**
     * @var
     */
    private $_id;
    /**
     * @var
     */
    private $_login;
    /**
     * @var
     */
    private $_password;
    /**
     * @var
     */
    private $_img;
    /**
     * @var
     */
    private $_perm;


    //CONSTRUCTOR

    /**
     * Users constructor.
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
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }//END OF IF
        }//END OF FOREACH
    }//END OF HYDRATE

    //ACCESSEURS

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
    public function getLogin()
    {
        return $this->_login;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->_password;
    }


    /**
     * @return mixed
     */
    public function getImg()
    {
        return $this->_img;
    }

    /**
     * @return mixed
     */
    public function getPerm()
    {
        return $this->_perm;
    }




    //MUTATEURS

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $id = (int)$id;
        if ($id > 0) {
            $this->_id = $id;
        }
    }


    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->_login = $login;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->_password = $password;
    }


    /**
     * @param mixed $img
     */
    public function setImg($img)
    {
        $this->_img = $img;
    }

    /**
     * @param mixed $perm
     */
    public function setPerm($perm)
    {
        $this->_perm = $perm;
    }
}//END OF CLASS

//END OF FILE
?>