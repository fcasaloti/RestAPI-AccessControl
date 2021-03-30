<?php

//DAO class for User Access
class UserAccessDAO
{
//instance of pdo service
    private static $_db;

    //initialize pdo
    public static function initialize()
    {
        self::$_db = new PDOService('UserAccess');
        return true;
    }

    public static function findUserAccessData($userId)
    {

        $sql = "SELECT accessId, timeAccess,hashAccess,isLocked,userId FROM useraccess 
        WHERE userId = :userId;";

        //query
        self::$_db->query($sql);

        //bind
        self::$_db->bind(":userId", $userId);

        //execute:
        self::$_db->execute();

        //return
        return self::$_db->singleResult();
    }

    public static function updateAccessData(UserAccess $newUserAccess)
    {

        $sql = "UPDATE useraccess SET timeAccess = :timeAccess, hashAccess = :hashAccess, 
        isLocked = :isLocked WHERE userId = :userId";
        
        //query
        self::$_db->query($sql);

        //bind
        self::$_db->bind(":userId", $newUserAccess->getUserId());
        self::$_db->bind(":timeAccess", $newUserAccess->getTimeAccess());
        self::$_db->bind(":hashAccess", $newUserAccess->getHashAccess());
        self::$_db->bind(":isLocked", $newUserAccess->getIsLocked());

        //execute:
        self::$_db->execute();

        //return
        return self::$_db->rowCount();
    }

    public static function insertAccessData(UserAccess $accessData)
    {

        $sql = "INSERT INTO useraccess (timeAccess,hashAccess, isLocked,userId)
        VALUES (:timeAccess,:hashAccess, :isLocked,:userId)";
        //query
        self::$_db->query($sql);

        //bind
        self::$_db->bind(":timeAccess", $accessData->getTimeAccess());
        self::$_db->bind(":hashAccess", $accessData->getHashAccess());
        self::$_db->bind(":isLocked", $accessData->getIsLocked());
        self::$_db->bind(":userId", $accessData->getUserId());
   
        //execute:
        self::$_db->execute();

        //return

        return self::$_db->lastInsertId();
    }

}
