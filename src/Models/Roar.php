<?php
$pdo = require __DIR__ . '/../db.php';
Roar::setPDO($pdo);

class Roar{
    private static $pdo;
    public static function setPDO($pdo){
        self::$pdo = $pdo;
    }

    public static function createRoar($username, $message){

        if (self::$pdo == null) {
            error_log('Database connection is null');
            throw new Exception("Database connection is null", 0);
        }

        try {
            self::$pdo->beginTransaction();

            $stmt = self::$pdo->prepare("SELECT user_id FROM userProfiles WHERE username = :username");
            $stmt->execute([':username' => $_SESSION['username']]);
            $userId = $stmt->fetchColumn();

            if ($userId === false) {
                self::$pdo->rollBack();
                http_response_code(401);
                echo json_encode(['success' => false, 'error' => '::UNKNOWN-USER::']);
                exit;
            }

            $stmt = self::$pdo->prepare("INSERT INTO roars (roar_content) VALUES (:content) RETURNING roar_id");
            $stmt->execute([':content' => $message]);
            $roarId = $stmt->fetchColumn();

            $stmt = self::$pdo->prepare("INSERT INTO posted (user_id, roar_id) VALUES (:user_id, :roar_id)");
            $stmt->execute([':user_id' => $userId, ':roar_id' => $roarId]);

            self::$pdo->commit();
        } catch (PDOException $e) {
            if (self::$pdo->inTransaction()) {
                self::$pdo->rollBack();
            }
            error_log('Posting roar failed: ' . $e->getMessage());
            throw new Exception("Posting roar failed: " . $e->getMessage(), 0);
        }
    }

    public static function getAllRoars(){
    	$roars = [];
    	if (self::$pdo == null) return $roars;
        $roars = self::$pdo->query(
            "SELECT u.username, r.roar_content, r.created_at
             FROM roars r
             JOIN posted p       ON p.roar_id = r.roar_id
             JOIN userProfiles u ON u.user_id = p.user_id
             ORDER BY r.created_at ASC, r.roar_id ASC"
        )->fetchAll(PDO::FETCH_ASSOC);

        return $roars;
    }
}
?>