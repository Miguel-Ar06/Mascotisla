<?php 

class User
{
    private $name;
    private $address;
    private $id;
    private $email;
    private $password;
    private $isMember;
    private $isAdmin; //por los momentos en una sola clase, que ladilla meter herencia ahorita

    public function __construct($name, $address, $id, $email, $password, $isMember, $isAdmin)
    {
        $this->name = $name;
        $this->address = $address;
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->isMember = $isMember;
        $this->isAdmin = $isAdmin;
    }

    #region Getters & Setters
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
    
    public function setIsMember($isMember)
    {
        $this->isMember = $isMember;
    }
    public function isMember()
    {
        return $this->isMember;
    }

    public function setIsAdmin($isAdmin)
    {
        if ($this->isMember == false)
        {
            $this->isAdmin = false;
        }
        else
        {
            $this->isAdmin = $isAdmin;
        }
    }
    public function isAdmin()
    {
        return $this->isAdmin;
    }
    #endregion
}