<?php
require_once __DIR__ . '/../Models/User.php';

class AuthenticationController {

    public static function registerUser() {
        $username = trim($_POST['name'] ?? '');
        $password = $_POST['pwd_original'] ?? '';
        $password_repeat = $_POST['pwd_confirm'] ?? '';

        try{
            User::createUser($username, $password, $password_repeat);
            // successful login
            session_regenerate_id(true);
            $_SESSION['username'] = $username;
            http_response_code(200);
            echo json_encode(['success' => true, 'redirect' => '/homepage']);
        }
        catch(Exception $e){
            switch($e->getCode()){
                case 1:
                    http_response_code(401);
                    echo json_encode(['success' => false, 'error' => '://MISSING-CREDENTIALS']);
                    exit;
                case 2:
                    http_response_code(401);
                    echo json_encode(['success' => false, 'error' => '://USR-ONLY-ALPHANUMERIC']);
                    exit;
                case 3:
                    http_response_code(401);
                    echo json_encode(['success' => false, 'error' => '://PWD-NOT-MATCH']);
                    exit;
                case 4:
                    http_response_code(401);
                    echo json_encode(['success' => false, 'error' => '://PWD-TOO-SHORT']);
                    exit;
                case 5:
                    http_response_code(401);
                    echo json_encode(['success' => false, 'error' => '://USR-NAME-TAKEN']);
                    exit;
                default:
                    http_response_code(500);
                    echo json_encode(['success' => false, 'error' => '://INTERNAL-SERVER-ERROR']);
                    exit;
            }
        }
    }

    public static function loginUser() {
        $username = trim($_POST['name'] ?? '');
        $password = $_POST['pwd_original'] ?? '';

        try{
            User::loginUser($username, $password);
            // successful login
            session_regenerate_id(true);
            $_SESSION['username'] = $username;
            http_response_code(200);
            echo json_encode(['success' => true, 'redirect' => '/homepage']);
        }
        catch(Exception $e){
            // Handle the exception
            switch($e->getCode()){
                case 1:
                    http_response_code(401);
                    echo json_encode(['success' => false, 'error' => '://MISSING-CREDENTIALS']);
                    exit;
                case 6:
                    http_response_code(401);
                    echo json_encode(['success' => false, 'error' => '://INVALID-CREDENTIALS']);
                    exit;
                default:
                    http_response_code(500);
                    echo json_encode(['success' => false, 'error' => '://INTERNAL-SERVER-ERROR']);
                    exit;
            }
        }
    }

    public static function logoutUser() {
        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();

            setcookie(
                session_name(),
                '',
                [
                    'expires' => time() - 42000,
                    'path' => $params['path'],
                    'domain' => $params['domain'],
                    'secure' => $params['secure'],
                    'httponly' => $params['httponly'],
                    'samesite' => $params['samesite'] ?? 'Lax'
                ]
            );
        }

        session_destroy();
        header('Location: /');
        exit;
    }

    public static function displayLoginPage(){
        require __DIR__ . '/../Views/login.php';
    }
    public static function displayRegisterPage(){
        require __DIR__ . '/../Views/register.php';
    }
}
?>