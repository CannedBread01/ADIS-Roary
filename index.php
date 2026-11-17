<?php
	session_start();
	if (!isset($_SESSION['username'])) {
		header('Location: /login');
		exit;
	}
	$pdo = require 'db.php';

	$roars = [];
	if ($pdo !== null) {
		$roars = $pdo->query(
			"SELECT u.username, r.roar_content, r.created_at
			 FROM roars r
			 JOIN posted p       ON p.roar_id = r.roar_id
			 JOIN userProfiles u ON u.user_id = p.user_id
			 ORDER BY r.created_at ASC, r.roar_id ASC"
		)->fetchAll(PDO::FETCH_ASSOC);
	}

	function e($s) { return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <title>Roary</title>
    <link rel="icon" href="icons/logo.png" type="image/gif" sizes="16x16">
</head>

<body class="flex-container">
    <p class="decor-font vertical">To whom it may concern, this line of text is devoid of meaning.</p>
    <div class="container">
        <?php require 'components/header.php'; ?>

        <div class="main-content">
            <div class="message-container" id="roar_container">
                <?php foreach ($roars as $roar): ?>
                <div class="flex-container panel">
                    <div>
                        <p class="username"><?= e($roar['username']) ?><?= (isset($_SESSION['username']) && $roar['username'] === $_SESSION['username']) ? ' (You)' : '' ?></p>
                        <p><?= nl2br(e($roar['roar_content'])) ?></p>
                    </div>
                    <div class="vertical message-decor"></div>
                </div>
                <?php endforeach; ?>
            </div>
            <br>
		<?php if(isset($_SESSION['username'])): ?>
            <div class="form-container flex-container"> <!-- form container -->
                <span class="vertical status-bar-normal" id="status_bar">::BROADCAST-READY::</span>

                <form id="message_form" action="/roar/post.php" method="post">
                    <div class="border-panel flex-container input-wrapper">
                        <label for="message">[MESSAGE]</label>
                        <textarea rows="3" name="message" id="message" required maxlength="280"></textarea>
                    </div>
                    <br>
                    <input type="submit" value="ROAR">
                </form>
            </div>
		<?php endif; ?>
        </div>

        <?php require 'components/footer.php'; ?>
    </div>

    <p class="decor-font vertical">We regret to inform you that the font did not load correctly.</p>

    <script src="src/script_main_page.js"></script>
    <script src="src/utils.js"></script>
</body>
</html>
