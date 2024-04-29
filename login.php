<?php
    session_start();
    if(isset($_SESSION['user_id'])) {
        $msg = "Je bent al ingelogd";
        header("Location: index.php?msg=".$msg);
        die;
}
?>

<!doctype html>
<html lang="nl">
<head>
    <title>StoringApp</title>
    <?php require_once 'head.php'; ?>
</head>
<body>
    <?php require_once 'header.php'; ?>
    <div class="container home">
        <?php if(isset($_GET['msg'])){ echo $_GET['msg']; }?>
        <form action="backend/loginController.php" method="POST">
            <div class="form-group">
                <label for="username">Gebruikersnaam: </label>
                <input type="text" name="username" id="username">
            </div>
            <div class="form-group">
                <label for="password">Wachtwoord: </label>
                <input type="password" name="password" id="password">
            </div>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>