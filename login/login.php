<?php
session_start();
$pdo = require '../db.php';
        
        $username = trim($_POST['name'] ?? '');
        $password = $_POST['pwd_original'] ?? '';
        if ($username === '' || $password === '') {
            http_response_code(401);
            echo json_encode(['success' => false, 'error' => '://MISSING-CREDENTIALS']);
            exit;
        }
    $stmt = $pdo->prepare("SELECT * FROM userProfiles WHERE username = :username");
	$stmt->execute([':username' => $username]); 
	$user = $stmt->fetch(PDO::FETCH_ASSOC);

	$pwd = $user['password'];
	if(password_verify($password, $pwd)){
		$_SESSION['username'] = $username;
		echo json_encode(['success' => true, 'redirect' => '../index.php']);
	}
	else{
        http_response_code(401);
        echo json_encode(['success' => false, 'error' => '://INVALID-CREDENTIALS']);
		
	}
?>
