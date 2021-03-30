<?php

//entity class that set access control properties of users
class UserAccess{

    private int $accessId = 0;
    private $timeAccess;
    private string $hashAccess = "";
    private bool $isLocked = false;
    private int $userId = 0;
    
    //Property not in the database. Value modified on the user handler
    private bool $allowAccess = false; 

    //DO NOT OVERWRITE DEFAULT CONSTRUCTOR. PDOService uses default constructor to build the object.

    /**
     * Get the value of accessId
     */ 
    public function getAccessId()
    {
        return $this->accessId;
    }

    /**
     * Set the value of accessId
     *
     * @return  self
     */ 
    public function setAccessId($accessId)
    {
        $this->accessId = $accessId;

        return $this;
    }

    /**
     * Get the value of timeAccess
     */ 
    public function getTimeAccess()
    {
        return $this->timeAccess;
    }

    /**
     * Set the value of timeAccess
     *
     * @return  self
     */ 
    public function setTimeAccess($timeAccess)
    {
        $this->timeAccess = $timeAccess;

        return $this;
    }

    /**
     * Get the value of hashAccess
     */ 
    public function getHashAccess()
    {
        return $this->hashAccess;
    }

    /**
     * Set the value of hashAccess
     *
     * @return  self
     */ 
    public function setHashAccess($hashAccess)
    {
        $this->hashAccess = $hashAccess;

        return $this;
    }

    /**
     * Get the value of isLocked
     */ 
    public function getIsLocked()
    {
        return $this->isLocked;
    }

    /**
     * Set the value of isLocked
     *
     * @return  self
     */ 
    public function setIsLocked($isLocked)
    {
        $this->isLocked = $isLocked;

        return $this;
    }

    /**
     * Get the value of userId
     */ 
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set the value of userId
     *
     * @return  self
     */ 
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get the value of allowAccess
     */ 
    public function getAllowAccess()
    {
        return $this->allowAccess;
    }

    /**
     * Set the value of allowAccess
     *
     * @return  self
     */ 
    public function setAllowAccess($allowAccess)
    {
        $this->allowAccess = $allowAccess;

        return $this;
    }
}