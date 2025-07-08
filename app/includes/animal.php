<?php

class Animal
{
    private $id;
    private $species; // gato, perro, conejo etc
    private $name;
    private $breed; // raza
    private $condition; // sano, enfermo, grave
    private $status; // adopdato, perdido, en adopcion etc
    private $sex; // macho hembra
    private $pictureLinks; // array con los links de las fotos de ese animal
    private $birthDate; // fecha de nacimiento, puede ser aproximada si no se conoce

    public  function __construct($id, $species, $name, $breed, $condition, $status, $sex, $pictureLinks, $birthDate) 
    {
        $this->id = $id;
        $this->species = $species;
        $this->name = $name;
        $this->breed = $breed;
        $this->condition = $condition;
        $this->status = $status;
        $this->sex = $sex;
        $this->pictureLinks = $pictureLinks;
        $this->birthDate = $birthDate;
    }

    #region Getter & Setters
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getSpecies()
    {
        return $this->species;
    }
    public function setSpecies($species)
    {
        $this->species = $species;
    }
    
    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
    }

    public function getBreed()
    {
        return $this->breed;
    }
    public function setBreed($breed)
    {
        $this->breed = $breed;
    }

    public function getCondition()
    {
        return $this->condition;
    }
    public function setCondition($condition)
    {
        $this->condition = $condition;
    }

    public function getStatus()
    {
        return $this->status;
    }
    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getSex()
    {
        return $this->sex;
    }
    public function setSex($sex)
    {
        $this->sex = $sex;
    }

    public function getPictureLinks()
    {
        return $this->pictureLinks;
    }
    public function setPictureLinks($pictureLinks)
    {
        $this->pictureLinks = $pictureLinks;
    }

    public function getBirthDate()
    {
        return $this->birthDate;
    }
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
    }
    #endregion
}