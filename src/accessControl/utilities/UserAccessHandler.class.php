<?php

//Class used to create and update data related to user access.
class UserAccessHandler
{

    //set new access data
    public static function setAccessData($userId)
    {

        if (!empty($userId)) {

            //Get user access data already in DB
            $newUserAccess = UserAccessDAO::findUserAccessData($userId);

            if (!empty($newUserAccess)) {
                //setting new data
                $newUserAccess->setTimeAccess(time());
                $newUserAccess->setHashAccess(bin2hex(random_bytes(16)));
                //$newUserAccess->setIsLocked(false);

                //setting new data in db
                $isUpdated = UserAccessDAO::updateAccessData($newUserAccess);

                //checking if it was succesfully
                if ($isUpdated !== 0) {
                    $newUserAccess->setAllowAccess(true);
                }

            } else {
                $newUserAccess = new UserAccess();
                $newUserAccess->setTimeAccess(time());
                $newUserAccess->setHashAccess(bin2hex(random_bytes(16)));
                //$newUserAccess->setIsLocked(false);
                $newUserAccess->setUserId($userId);
                $accessId = UserAccessDAO::insertAccessData($newUserAccess);
                $newUserAccess->setAccessId($accessId);

                //checking if it was succesfully
                if ($accessId !== 0) {
                    $newUserAccess->setAllowAccess(true);
                }

            }
            if($newUserAccess->getIsLocked() == false){
                MessagesHandler::$message = 'Access granted successfully!';
                return $newUserAccess;
            } else {
                MessagesHandler::$message = 'User locked, please find the administrator!';
            }

        }

    }

    //function used to check whether either user has access or not.
    public static function trackSession($newUserAccessRequest)
    {

        $lastUserAccessData = UserAccessDAO::findUserAccessData($newUserAccessRequest->getUserId());

        if (!empty($lastUserAccessData)) {

            if ($lastUserAccessData->getIsLocked() == false) {

                $timeDiff = time() - $lastUserAccessData->getTimeAccess();

                if (!empty($lastUserAccessData) && ($timeDiff < API_TIMEOUT) && $newUserAccessRequest->getHashAccess() == $lastUserAccessData->getHashAccess()) {
                    MessagesHandler::$message = 'Access granted successfully!';
                    return true;
                }
            } else {
                MessagesHandler::$message = 'User locked, please find the administrator!';
                return false;
            }
        } 

        MessagesHandler::$message = 'User access cannot be evaluated. Please perform login again!';
        return false;

    }

}
