<?php


namespace app\model;


use base\model\Model;

class User extends Model
{
    public $id;
    public $email;
    public $password;
    public $salt;
    public $name;
    public $surname;
    public $fathername;
    public $status_id;
    public $auth_token;

    /**
     * User constructor.
     * @param $email
     * @param $password
     * @param $salt
     * @param $name
     * @param $surname
     * @param $fathername
     * @param $status_id
     * @param $auth_token
     */
    public function __construct($email, $password, $salt, $name, $surname, $fathername, $status_id, $auth_token)
    {
        $this->email = $email;
        $this->password = $password;
        $this->salt = $salt;
        $this->name = $name;
        $this->surname = $surname;
        $this->fathername = $fathername;
        $this->status_id = $status_id;
        $this->auth_token = $auth_token;

        $this->auto_increment = ['id'];
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }
}