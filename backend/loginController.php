<?php
session_start();
$username = $_POST['username'];
$password = $_POST['password'];

require_once 'conn.php';
$query = "SELECT * FROM users WHERE username = :username";
$statement = $conn->prepare($query);
$statement->execute([":username" => $username]);
$user = $statement->fetch(PDO::FETCH_ASSOC);

if($statement->rowCount() < 1) {
    $msg = urlencode("User doesn't exist");
    header("Location: ../login.php?msg=".$msg);
    die;
}

if(!password_verify($password, $user['password'])) {
    $msg = urlencode("Password incorrect");
    header("Location: ../login.php?msg=".$msg);
    die;
}

$_SESSION['user_id'] = $user['id'];
$msg = urlencode("U bent ingelogd");
header("Location: ../index.php?msg=".$msg);