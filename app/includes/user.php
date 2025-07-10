<?php 

class User
{
    private $id;
    private $name;
    private $lastName;
    private $address;
    private $identification;
    private $email;
    private $password;
    private $isMember;
    private $isAdmin; //por los momentos en una sola clase, que ladilla meter herencia ahorita

    public function __construct($id, $name, $lastName, $address, $identification , $email, $password, $isMember, $isAdmin)
    {
        $this->id = $id;
        $this->name = $name;
        $this->lastName = $lastName;
        $this->address = $address;
        $this->identification = $identification;
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

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }
    public function getLastName()
    {
        return $this->lastName;
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

    public function setIdentification($identification)
    {
        $this->identification = $identification;
    }
    public function getIdentification()
    {
        return $this->identification;
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