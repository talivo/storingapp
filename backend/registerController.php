<?php
session_start();
$username = $_POST['username'];
$password = $_POST['password'];
$passwordConfirm = $_POST['password-confirm'];

require_once 'conn.php';
$query = "SELECT * FROM users WHERE username = :username";
$statement = $conn->prepare($query);
$statement->execute([':username' => $username]);
$existingUser = $statement->fetch(PDO::FETCH_ASSOC);

if(empty($username)) {
    $msg = urlencode("Voer een gebruikersnaam in");
    header("Location: ../register.php?msg=".$msg);
    die;
} else if(empty($password) or empty($passwordConfirm)) {
    $msg = urlencode("Voer je wachtwoord in");
    header("Location: ../register.php?msg=".$msg);
    die;
} else if ($password != $passwordConfirm) {
    $msg = urlencode("Wachtwoorden komen niet overeen");
    header("Location: ../register.php?msg=".$msg);
    die;
} else if ($existingUser) {
    $msg = urlencode("Gebruiker bestaat al");
    header("Location: ../register.php?msg=".$msg);
    die;
}

$password = password_hash($password, PASSWORD_DEFAULT);
$query = "INSERT INTO users (username, password) 
VALUES(:username, :password)";
$statement = $conn->prepare($query);
$statement->execute([
    ':username'=> $username,
    ':password'=> $password
]);

$msg = ($password);
header('Location: ../index.php?msg='.$msg);