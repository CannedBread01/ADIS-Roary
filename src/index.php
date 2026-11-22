<?php
session_start();

$request = ['path' => parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), 'method' => $_SERVER['REQUEST_METHOD']];

error_log("Request: " . json_encode($request));

switch($request){
    case ['path' => '/', 'method' => 'GET']:
        require __DIR__ . '/Controllers/GeneralController.php';
        GeneralController::displayHomepage();
        break;
    case ['path' => '/homepage', 'method' => 'GET']:
        require __DIR__ . '/Controllers/GeneralController.php';
        GeneralController::displayHomepage();
        break;
    case ['path' => '/register.php', 'method' => 'GET']:
        require __DIR__ . '/Controllers/AuthenticationController.php';
        AuthenticationController::displayRegisterPage();
        break;
    case ['path' => '/login.php', 'method' => 'GET']:
        require __DIR__ . '/Controllers/AuthenticationController.php';
        AuthenticationController::displayLoginPage();
        break;
    case ['path' => '/loginUser', 'method' => 'POST']:
        require __DIR__ . '/Controllers/AuthenticationController.php';
        AuthenticationController::loginUser();
        break;
    case ['path' => '/registerUser', 'method' => 'POST']:
        require __DIR__ . '/Controllers/AuthenticationController.php';
        AuthenticationController::registerUser();
        break;
    case ['path' => '/logoutUser', 'method' => 'POST']:
        require __DIR__ . '/Controllers/AuthenticationController.php';
        AuthenticationController::logoutUser();
        break;
    case ['path' => '/postRoar', 'method' => 'POST']:
        require __DIR__ . '/Controllers/RoarController.php';
        RoarController::postRoar();
        break;
    case ['path' => '/roars', 'method' => 'GET']:
        require __DIR__ . '/Controllers/RoarController.php';
        RoarController::getAllRoars();
        break;
    default:
        require __DIR__ . '/Controllers/GeneralController.php';
        GeneralController::display404Page();
        break;
}
?>