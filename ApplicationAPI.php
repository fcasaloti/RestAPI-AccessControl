<?php

//requiring files
require_once "src/config/config.inc.php";
require_once "src/accessControl/entities/UserAccess.class.php";
require_once "src/general/utilities/PDOService.class.php";
require_once "src/accessControl/utilities/UserAccessDAO.class.php";
require_once "src/accessControl/utilities/UserAccessHandler.class.php";
require_once "src/accessControl/utilities/UserAccessConverter.class.php";
require_once "src/general/utilities/MessagesHandler.class.php";
require_once "src/general/utilities/Validation.class.php";

//getting contents from the request
$requestData = json_decode(file_get_contents('php://input'));

//initializing DAOs
UserAccessDAO::initialize();

//checking requests
switch ($_SERVER["REQUEST_METHOD"]) {

    case "POST":
        //Including header for JSON and CORS ate the very beginning of the document
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");

        //creating new std class object to be used as a stdClassResponse
        $stdClassResponse = new stdClass();
        $response = array();

        //check if the request is valid and renew access data
        if (Validation::validateUserAccessRequest($requestData)) {
            $convertedToUserAccess = UserAccessConverter::convertToUserAccessClass($requestData->accessData);
            if(!empty($convertedToUserAccess)){
                $isValidAccess = UserAccessHandler::trackSession($convertedToUserAccess);
                if ($isValidAccess) {
                    $updatedUserAccess = UserAccessHandler::setaccessData($convertedToUserAccess->getUserId());
                    $stdClassResponse = UserAccessConverter::convertToStdClass($updatedUserAccess);
                    $stdClassResponse->role = $requestData->accessData->role;
                    $response['accessData'] = $stdClassResponse;
                }
            }
        }

        //if the request is valid, then do whatever is been requested
        if(isset($stdClassResponse->allowAccess) && $stdClassResponse->allowAccess == true){
           //INSERT HERE YOUR API REQUEST FOR DATA REQUEST

           $response['data'] = 'INPUT HERE YOUR DATA';

        }

        //SENDING BACK DATA
        $response['message'] = MessagesHandler::$message;
        header('Content-Type: application/json');
        echo json_encode($response);
        break;

    default:
        echo 'You are not using an allowed request method!';
        break;
}
