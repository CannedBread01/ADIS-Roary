<?php
$pdo = require __DIR__ . '/../db.php';
User::setPDO($pdo);

class User {
    private static $pdo;
    public static function setPDO($pdo){
        self::$pdo = $pdo;
    }
    private static function isUsernameTaken($username) {
        $stmt = self::$pdo->prepare("SELECT EXISTS (
            SELECT 1
            FROM userProfiles
            WHERE username = :username
            )");
        $stmt->execute([':username' => $username]);
        $doesUserExist = $stmt->fetchColumn();
        return $doesUserExist;
    }


    public static function createUser($username, $password, $password_repeat) {

        // check if input is valid
        if(!isset($username, $password, $password_repeat)) throw new Exception("Not all fields are filled", 1);
        if(!ctype_alnum($username)) throw new Exception("Username must be alphanumeric", 2);
        if($password != $password_repeat) throw new Exception("Passwords do not match", 3);
        if(strlen($password) < 12) throw new Exception("Password must be at least 12 characters long", 4);
        if(User::isUsernameTaken($username)) throw new Exception("Username is already taken", 5);

        // create user entry in database
        try{
            $stmt = self::$pdo->prepare("INSERT INTO userProfiles (username, password)
                    VALUES (:username, :password)");
                $stmt->execute([
                    ':username' => $username,
                    ':password' => password_hash($password, PASSWORD_DEFAULT)
                    ]);
        }
        catch (PDOException $e) {
            error_log("Error creating user: " . $e->getMessage());
            throw new Exception("Error creating user: " . $e->getMessage(), 0);
        }
    }

    public static function loginUser($username, $password) {

        //check if input is valid
        if(!isset($username, $password)) throw new Exception("Not all fields are filled", 1);
        //check if username exists
        if(!User::isUsernameTaken($username)) throw new Exception("Invalid Credentials", 6);

        // check if password is correct
        try{
            $stmt = self::$pdo->prepare("SELECT password FROM userProfiles WHERE username = :username");
                $stmt->execute([':username' => $username]);
                $hashed_password = $stmt->fetchColumn();
                if(!password_verify($password, $hashed_password)) throw new Exception("Invalid Credentials", 6);
        }
        catch(PDOException $e) {
            error_log("Error logging in user: " . $e->getMessage());
            throw new Exception("Error logging in user: " . $e->getMessage(), 0);
        }
    }

}
?>