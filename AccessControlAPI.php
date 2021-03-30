<?php

//requiring files
require_once "src/config/config.inc.php";
require_once "src/accessControl/entities/User.class.php";
require_once "src/accessControl/entities/UserAccess.class.php";
require_once "src/general/utilities/PDOService.class.php";
require_once "src/accessControl/utilities/UserDAO.class.php";
require_once "src/accessControl/utilities/UserAccessDAO.class.php";
require_once "src/accessControl/utilities/UserAccessHandler.class.php";
require_once "src/accessControl/utilities/UserAccessConverter.class.php";
require_once "src/accessControl/utilities/AuthRegister.class.php";
require_once "src/general/utilities/MessagesHandler.class.php";
require_once "src/general/utilities/Validation.class.php";

//getting contents from the request
$requestData = json_decode(file_get_contents('php://input'));

//initializing DAOs
UserDAO::initialize();
UserAccessDAO::initialize();

//checking requests
switch ($_SERVER["REQUEST_METHOD"]) {

    case "POST":
        //Including header for JSON and CORS ate the very beginning of the document
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");
        $stdClassResponse = new stdClass();
        $response = array();
        //Check if it is a login request
        if(Validation::validateLoginRequest($requestData)){
            $userData = AuthRegister::checkCredentials($requestData->credentials);
            if (!empty($userData)) {
                $userAccess = UserAccessHandler::setAccessData($userData->getUserId());
                if(!empty($userAccess)){
                    $stdClassResponse = UserAccessConverter::convertToStdClass($userAccess);
                    $stdClassResponse->role = $userData->getRole();
                    $response['accessdata'] = $stdClassResponse;
                }
            }
        //Check if it is a registration request
        } elseif (Validation::validateRegistrationRequest($requestData)) {
            AuthRegister::registerUser($requestData->userData);
        }

        $response['message'] = MessagesHandler::$message;
        header('Content-Type: application/json');
        echo json_encode($response);
        break;

    default:
        echo 'You are not using an allowed request method!';
        break;
}
