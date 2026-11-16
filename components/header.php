<header>
        <div style="background-color: var(--color-accent-primary); display:flex">
            <a href="/index.php" class="icon logo"></a>
        </div>

        <span class="title">Roary</span>
        <div>
            <p class="decor-font">102102121</p>
            <p class="dot-font">BROADCAST YOUR ROAR</p>
        </div>
    <?php if(!isset($_SESSION['username'])): ?>
    <div style="margin-left:auto; display:flex; align-items:flex-end; gap: 1rem;">
        <a class="btn" href="/login">LOG IN</a>
        <a class="btn" href="/register">REGISTER</a>
    </div>
    <?php else: ?>
    <div style="margin-left:auto; display:flex; align-items: flex-end;">
        <span style="padding: 0.25rem 1rem; background-color:var(--color-text); color:var(--color-background)"><?= htmlspecialchars($_SESSION['username']) ?></span>
        <form action="/logout/logout.php" method="post" class="empty-form" style="display: flex;">
            <input type="submit" name="logout" class="icon logout" value=""></input>
        </form>
    </div>
    <?php endif; ?>

        <span style="display:flex;" onclick="switchTheme()">
            <span class="moon icon" id="theme_switch"></span>
        </span>

        <div class="plus br"></div>
        <div class="plus bl"></div>
</header>