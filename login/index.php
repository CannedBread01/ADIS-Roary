<?php
	if(isset($_GET["name"])){
		error_log("Login submitted: " . print_r($_GET, true));
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../style.css">
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="icon" href="../icons/logo.png" type="image/gif" sizes="16x16">
</head>
<body>
<div class="container">

    <header>
        <div style="background-color: var(--color-accent-primary); display:flex">
            <a href="../index.php" class="icon logo"></a>
        </div>

        <span class="title">Roary</span>
        <div>
            <p class="decor-font">102102121</p>
            <p class="dot-font">BROADCAST YOUR ROAR</p>
        </div>
        <div class="plus br"></div>
        <div class="plus bl"></div>

        <div style="display:flex; margin-left: auto;">
            <span class="moon icon" id="theme_switch" onclick="switchTheme()"></span>
        </div>
    </header>

    <div class="main-content">
        <div class="centered">
            <div class="plus br"></div>
            <div class="plus bl"></div>
            <div class="plus tr"></div>
            <div class="plus tl"></div>

            <h1>LOG IN</h1>
            <div class="flex-container"> <!-- form container -->
                <span class="vertical status-bar-normal" id="status_bar">//:READY</span>

                <form id="form_login" action="/login">
                    <div class="border-panel flex-container input-wrapper username-input">
                        <label for="name">[USR]</label>
                        <input type="text" name="name" id="name" required autocomplete="username">
                    </div>
                    <br>
                    <div class="border-panel flex-container input-wrapper username-input">
                        <label for="name">[PWD]</label>
                        <input type="password" name="pwd_original" id="pwd_original" required autocomplete="current-password">
                    </div>
                    <br>
                    <input type="submit" value="LOG IN">
                    <p class="decor-font">()()(())()((((())()((()()()(()(())((()())(())))()()(</p>
                    <span>Don't have an account?</span> <a href="../register">Create one here</a>
                </form>
            </div>
        </div>

    </div>

    <footer>
        <div class="plus tr"></div>
        <div class="plus tl"></div>
        <p class="decor-font">()(())(( ()(()))) ()(())((</p>
        <p class="dot-font">::ADIS++2026-27++WISE++PROJECT::</p>
        <p class="decor-font">()(())(( ()(()))) ()(())((</p>
    </footer>
</div>
<script src="../src/utils.js"></script>
<script src="../src/script_login.js"></script>

</body>
</html>
