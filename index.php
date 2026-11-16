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
        <?php require 'components/header.php'; ?>

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
