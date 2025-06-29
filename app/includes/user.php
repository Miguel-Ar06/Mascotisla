<?php 

class user
{
    private $name;
    private $address;
    private $id;
    private $email;
    private $password;
    private $isAdmin; //por los momentos en una sola clase, que ladilla meter herencia ahorita

    public function __construct($name, $address, $id, $email, $password, $isAdmin)
    {
        $this->name = $name;
        $this->address = $address;
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->isAdmin = $isAdmin;
    }

    #region Getters y Setters
    public function setName($name)
    {
        $this->name = $name;
    }
    public function getName()
    {
        return $this->name;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }
    public function getAddress()
    {
        return $this->address;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function getEmail()
    {
        return $this->email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function getPassword()
    {
        return $this->password;
    }

    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;
    }
    public function isAdmin()
    {
        return $this->isAdmin;
    }
    #endregion
}