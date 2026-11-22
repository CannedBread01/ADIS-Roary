<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <title>404 - Page Not Found</title>
    <link rel="icon" href="icons/logo.png" type="image/gif" sizes="16x16">
</head>
<body>
    <div class="container">
        <?php require 'Components/header.php'; ?>

        <div class="main-content">
            <div class="centered">
                <div class="plus br"></div>
                <div class="plus bl"></div>
                <div class="plus tr"></div>
                <div class="plus tl"></div>

                <h1 class="title">404 - PAGE NOT FOUND</h1>
                <div class="flex-container panel">
                    <div>
                        <p>The specified page does not exist.</p>
                        <p class="decor-font">()()(()()()()()((()()(())(()(()((()()(</p>
                        <br>
                        <a class="btn" href="index.php">RETURN TO HOMEPAGE</a>
                    </div>
                    <div class="vertical message-decor">
                        btrt
                    </div>
                </div>
            </div>
        </div>

        <?php require 'Components/footer.php'; ?>
    </div>
    <script src="src/utils.js"></script>
</body>
</html>
