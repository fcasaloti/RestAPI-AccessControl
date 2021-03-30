<?php

//DAO class for User
class UserDAO
{

    // $userId
    // $name
    // $email
    // $username
    // $password
    // $role

    //instance of pdo service
    private static $_db;

    //initialize pdo
    public static function initialize()
    {
        self::$_db = new PDOService('User');
        return true;
    }

    public static function findUser($username)
    {

        $sql = "SELECT user.userId, user.name, user.email, user.username, user.password,
        user.role  FROM user WHERE username = :username;";

        //query
        self::$_db->query($sql);

        //bind
        self::$_db->bind(":username", $username);

        //execute:
        self::$_db->execute();

        //return
        return self::$_db->singleResult();
    }

    public static function insertUser(User $newUser)
    {

        $sql = "INSERT INTO user (name,email, username,password,role) VALUES (:name,:email, :username,:password,:role)";
        //query
        self::$_db->query($sql);

        //bind
        self::$_db->bind(":name", $newUser->getName());
        self::$_db->bind(":email", $newUser->getEmail());
        self::$_db->bind(":username", $newUser->getUsername());
        self::$_db->bind(":password", $newUser->getPassword());
        self::$_db->bind(":role", $newUser->getRole());

        //execute:
        self::$_db->execute();

        //return

        return self::$_db->lastInsertId();
    }

}
