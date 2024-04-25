<?php require_once 'backend/config.php'; ?>

<header>
    <div class="container">
        <nav>
            <img src="<?php echo $base_url; ?>/img/logo-big-v4.png" alt="logo" class="logo">
            <a href="<?php echo $base_url; ?>/index.php">Home</a> |
            <a href="<?php echo $base_url; ?>/meldingen/index.php">Meldingen</a>
        </nav>
        <div>
            <?php if(!isset($_SESSION['user_id'])): ?>
                <p><a href="<?php echo $base_url; ?>/login.php">Inloggen</a></p>
            <?php else: ?>
                <p><a href="<?php echo $base_url; ?>/logout.php">Uitloggen</a></p>
            <?php endif; ?>
        </div>
    </div>
</header>