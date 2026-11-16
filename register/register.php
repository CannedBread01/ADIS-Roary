<?php
session_start();
$pdo = require '../db.php';

function isRegistrationFormValid($username, $pwd_original, $pwd_copy, $pdo){
	if(!isset($username, $pwd_original, $pwd_copy)) return "Not all fields are filled";
	
	//check if username is only alphanumeric
	if (!ctype_alnum($username)) return "://USR-ONLY-ALPHANUMERIC";
	
	//check if passwords are the same
	if($pwd_original != $pwd_copy) return "://PWD-NOT-MATCH";
	
	//check if password is at least 12 characters long
	if(strlen($pwd_original) < 12) return "://PWD-TOO-SHORT";
	
	//check if usename already exists 
	$stmt = $pdo->prepare("SELECT EXISTS (
		SELECT 1 
		FROM userProfiles 
		WHERE username = :username
		)");
	$stmt->execute([':username' => $username]); 
	$doesUserExist = $stmt->fetchColumn();
	
	if($doesUserExist) return "://USR-NAME-TAKEN";
	return "";
}


	$username = trim($_POST['name'] ?? '');
	$pwd_original = $_POST['pwd_original'] ?? '';
	$pwd_copy = $_POST['pwd_confirm'] ?? '';
	error_log($username);
	error_log($pwd_original);
	error_log($pwd_copy);
	$error = isRegistrationFormValid($username, $pwd_original, $pwd_copy, $pdo);
	if ($error != '') {
		error_log($error);
		http_response_code(401);
	    echo json_encode(['success' => false, 'error' => $error]);
	    exit;
	}
	$stmt = $pdo->prepare("INSERT INTO userProfiles (username, password)
		VALUES (:username, :password)");
	$stmt->execute([
		':username' => $username,
		':password' => password_hash($pwd_original, PASSWORD_DEFAULT)
		]);
	error_log("made it to the end");
	$_SESSION['username'] = $username;
	echo json_encode(['success' => true, 'redirect' => '../index.php']);
?>
