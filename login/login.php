<?php
session_start();
$pdo = require '../db.php';
        
        $username = trim($_POST['name'] ?? '');
        $password = $_POST['pwd_original'] ?? '';
        if ($username === '' || $password === '') {
            header('Location: index.php?error=' . urlencode('Please fill in both fields'));
            exit;
        }
        $stmt = $pdo->prepare("SELECT * FROM userProfiles WHERE username = :username");
	$stmt->execute([':username' => $username]); 
	$user = $stmt->fetch(PDO::FETCH_ASSOC);

	$pwd = $user['password'];
	if(password_verify($password, $pwd)){
		$_SESSION['username'] = $username;
		header('Location: ../index.php');
	}
	else{
		http_response_code(401);
		
	}
?>
