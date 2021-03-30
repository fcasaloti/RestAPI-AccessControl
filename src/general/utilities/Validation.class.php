<?php

class Validation {

    public static function validateLoginRequest($requestData){

        //Check if it is a login request
        if (isset($requestData->credentials) &&
            isset($requestData->credentials->username) &&
            isset($requestData->credentials->password) &&
            !empty($requestData->credentials->username) &&
            !empty($requestData->credentials->password)
        ) {
            return true;
        } else {
            MessagesHandler::$message = "Dados nao atendem aos requisitos";
            return false;
        }
    }

    public static function validateRegistrationRequest($requestData){

                //check if it is an user registration request
                if (
                    isset($requestData->userData) &&
                    isset($requestData->userData->name) &&
                    isset($requestData->userData->email) &&
                    isset($requestData->userData->password) &&
                    !empty($requestData->userData->name) &&
                    !empty($requestData->userData->email) &&
                    !empty($requestData->userData->password) 
                ) {
                    return true;
                } else {
                    MessagesHandler::$message = "Dados nao atendem aos requisitos";
                    return false;
                }
    }

    public static function validateUserAccessRequest($requestData){

        if(
            isset($requestData->accessData) &&
            isset($requestData->accessData->timeAccess) &&
            isset($requestData->accessData->hashAccess) &&
            isset($requestData->accessData->isLocked) &&
            isset($requestData->accessData->userId) &&
            isset($requestData->accessData->allowAccess) &&
            isset($requestData->accessData->role) &&
            !empty($requestData->accessData->timeAccess) &&
            !empty($requestData->accessData->hashAccess) &&
            !empty($requestData->accessData->userId) &&
            !empty($requestData->accessData->role)
        ){
            return true;
        } else {
            MessagesHandler::$message = "Dados nao atendem aos requisitos";
            return false;
        }
    }

}