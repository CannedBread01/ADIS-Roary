<?php
	session_start();
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
        <header>
            <div style="background-color: var(--color-accent-primary); display:flex">
                <a href="index.php" class="icon logo"></a>
            </div>

            <span class="title">Roary</span>
            <div>
                <p class="decor-font">102102121</p>
                <p class="dot-font">BROADCAST YOUR ROAR</p>
            </div>
		<?php if(!isset($_SESSION['username'])): ?>
		<div stlye="display: flex; align-items:end; margin-left: auto; gap: 1rem;">
			<a class="btn" href="/login">LOG IN</a>
			<a class="btn" href="/register">REGISTER</a>
		</div>
		<?php else: ?>
		<div>
			<span><?= htmlspecialchars($_SESSION['username']) ?></span>
			<form action="/logout/logout.php" method="post">
				<input type="submit" name="logout" value="LOGOUT" class="icon logout" />
			</form>
		</div>
		<?php endif; ?>

            <span style="display:flex;" onclick="switchTheme()">
                <span class="moon icon" id="theme_switch"></span>
            </span>

            <div class="plus br"></div>
            <div class="plus bl"></div>
        </header>

        <div class="main-content">
            <div class="message-container" id="roar_container">

                <div class="flex-container panel">
                    <div>
                        <p class="username">Name Here (You)</p>
                        <p>
                            Lorem ipsum dolor sit amet, consetetur sadipscing elitr,
                            sed diam nonumy eirmod tempo
                        </p>
                    </div>
                    <div class="vertical message-decor">
                        btrt
                    </div>
                </div>

            </div>
            <br>
		<?php if(isset($_SESSION['username'])): ?>
            <div class="form-container flex-container"> <!-- form container -->
                <span class="vertical status-bar-normal" id="status_bar">::BROADCAST-READY::</span>

                <form id="message_form" action="#" onsubmit="return submitMessage(this);">
                    <div class="border-panel flex-container input-wrapper username-input">
                        <label for="name">[USER]</label>
                        <input type="text" name="name" id="name">
                    </div>
                    <br>
                    <div class="border-panel flex-container input-wrapper">
                        <label for="message">[MESSAGE]</label>
                        <textarea rows="3" name="message" id="message"></textarea>
                    </div>
                    <br>
                    <input type="submit" value="ROAR">
                </form>

                <div class="panel login-registration-form" id="login_registration_form">
                    <a class="btn" href="/login">LOG IN</a>
                    <div class="flex-container" style="gap: 0.5rem">
                        <p class="decor-font">())())())(()</p>
                        <p>OR</p>
                        <p class="decor-font">())())())(()</p>
                    </div>
                    <a class="btn" href="/register">REGISTER</a>
                    <button onclick="logUserIn(true)"> //DEV-OVERRIDE-LOGIN</button>
                </div>
            </div>
		<?php endif; ?>
        </div>

        <footer>
            <div class="plus tr"></div>
            <div class="plus tl"></div>
            <p class="decor-font">()(())(( ()(()))) ()(())((</p>
            <p class="dot-font">::ADIS++2026-27++WISE++PROJECT::</p>
            <p class="decor-font">()(())(( ()(()))) ()(())((</p>
        </footer>
    </div>

    <p class="decor-font vertical">We regret to inform you that the font did not load correctly.</p>

    <script src="src/script_main_page.js"></script>
    <script src="src/utils.js"></script>
</body>
</html>
