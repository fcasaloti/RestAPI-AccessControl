<?php

//class used to convert UserAccess objects in Standard Objects and vice/versa. 
class UserAccessConverter
{

    //This function will conver tot Standard Classes
    public static function convertToStdClass($data)
    {

        $stdObjects = array();

        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $stdUserAccess = new stdClass();
                $stdUserAccess->accessId = $value->getAccessId();
                $stdUserAccess->timeAccess = $value->getTimeAccess();
                $stdUserAccess->hashAccess = $value->getHashAccess();
                $stdUserAccess->isLocked = $value->getIsLocked();
                $stdUserAccess->userId = $value->getUserId();
                $stdUserAccess->allowAccess = $value->getAllowAccess();

                $stdObjects[] = $stdUserAccess;
            }
            return $stdObjects;

        } else {
            $stdUserAccess = new stdClass();
            $stdUserAccess->accessId = $data->getAccessId();
            $stdUserAccess->timeAccess = $data->getTimeAccess();
            $stdUserAccess->hashAccess = $data->getHashAccess();
            $stdUserAccess->isLocked = $data->getIsLocked();
            $stdUserAccess->userId = $data->getUserId();
            $stdUserAccess->allowAccess = $data->getAllowAccess();

            return $stdUserAccess;

        }

    }

    //This function will convert into a Standard class
    public static function convertToUserAccessClass($data)
    {

        $newUserAccesss = array();

        try {
            if ($data == new stdClass()) {
                throw new Exception('There are no data to support access!');
            } else {
                //Check if it is an array
                if (is_array($data)) {

                    foreach ($data as $key => $value) {
                        $newUserAccess = new UserAccess();
                        $newUserAccess->setAccessId($value->accessId);
                        $newUserAccess->setTimeAccess($value->timeAccess);
                        $newUserAccess->setHashAcces($value->hashAccess);
                        $newUserAccess->setIsLocked($value->isLocked);
                        $newUserAccess->setUserId($value->userId);
                        $newUserAccess->setAllowAccess($value->allowAccess);

                        $newUserAccesss[] = $newUserAccess;
                    }

                    return $newUserAccess;

                    //if it is not an array ......
                } else {

                    $newUserAccess = new UserAccess();
                    $newUserAccess->setAccessId($data->accessId);
                    $newUserAccess->setTimeAccess($data->timeAccess);
                    $newUserAccess->setHashAccess($data->hashAccess);
                    $newUserAccess->setIsLocked($data->isLocked);
                    $newUserAccess->setUserId($data->userId);
                    $newUserAccess->setAllowAccess($data->allowAccess);

                    return $newUserAccess;

                }
            }

        } catch (Exception $ex) {
            MessagesHandler::$message = $ex->getMessage();
            date_default_timezone_set('America/Sao_Paulo');
            error_log(date('Y/m/d H:i') . ' ' . $ex->getMessage() . "\n", 3, 'error.log');
        }

    }

}
