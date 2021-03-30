<?php

//class to check user credentials and register new users of the platform
class AuthRegister
{

    //Checking if user credentials matches database data
    public static function checkCredentials($loginData)
    {

        //Initializing UsersDAO and sending username to database to check if it exists
        UserDAO::initialize();
        $checkUser = UserDAO::findUser($loginData->username);

        //Check if user has been found and returning data regarding user and time
        if (!empty($checkUser)) {
            if (password_verify($loginData->password, $checkUser->getPassword())) {
                return $checkUser;
            } else {
                MessagesHandler::$message = 'Username\password doesnt match';
            }
        } else {
            MessagesHandler::$message = 'User does not found';
        }
    }

    //registering a new user
    public static function registerUser($userData)
    {

        $userId = 0;
        $newUser = new User();

        //Check if there are some user with the same email address
        $checkUser = UserDAO::findUser($userData->email);
        if (!empty($checkUser)) {

            MessagesHandler::$message = 'Username already registered!';

        } else {

            $newUser->setName($userData->name);
            $newUser->setEmail($userData->email);
            $newUser->setUsername($userData->email);
            $newUser->setPassword(password_hash($userData->password, PASSWORD_DEFAULT));

            $newUser->setRole('user');
            $userId = UserDAO::insertUser($newUser);
            $newUser->setUserId($userId);

            if (!empty($userId)) {
                MessagesHandler::$message = 'User created successfully!';
            }

            return $newUser;

        }

    }
}
