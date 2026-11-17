<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: /login');
    exit;
}

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => '::METHOD-NOT-ALLOWED::']);
    exit;
}

$message = trim($_POST['message'] ?? '');
// Todo: error handling maybe?

$pdo = require '../db.php';

if ($pdo === null) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => '::DB-ERROR::']);
    exit;
}

try {
    $pdo->beginTransaction();

    $stmt = $pdo->prepare("SELECT user_id FROM userProfiles WHERE username = :username");
    $stmt->execute([':username' => $_SESSION['username']]);
    $userId = $stmt->fetchColumn();

    if ($userId === false) {
        $pdo->rollBack();
        http_response_code(401);
        echo json_encode(['success' => false, 'error' => '::UNKNOWN-USER::']);
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO roars (roar_content) VALUES (:content) RETURNING roar_id");
    $stmt->execute([':content' => $message]);
    $roarId = $stmt->fetchColumn();

    $stmt = $pdo->prepare("INSERT INTO posted (user_id, roar_id) VALUES (:user_id, :roar_id)");
    $stmt->execute([':user_id' => $userId, ':roar_id' => $roarId]);

    $pdo->commit();
} catch (PDOException $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    error_log('Posting roar failed: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => '::BROADCAST-FAILED::']);
    exit;
}

echo json_encode(['success' => true]);
