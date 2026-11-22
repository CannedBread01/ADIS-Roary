<?php
require_once __DIR__ . '/../Models/Roar.php';

class RoarController {
    public static function postRoar(){
        $username = $_SESSION['username'] ?? null;
        if(!isset($username)){
            http_response_code(401);
            echo json_encode(['success' => false, 'error' => '://NOT-LOGGED-IN']);
            exit;
        }
        $message = trim($_POST['message'] ?? '');
        if(strlen($message) < 1){
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => '://INVALID-INPUT']);
            exit;
        }

        try{
            Roar::createRoar($username, $message);
            http_response_code(200);
            echo json_encode(['success' => true]);
        } catch (Exception $e){
            error_log("Error posting roar: " . $e->getMessage());
            http_response_code(500);
            echo json_encode(['success' => false, 'error' => '://INTERNAL-SERVER-ERROR']);
            exit;
        }
    }

    public static function getAllRoars(){
        return Roar::getAllRoars();
    }
}
?>