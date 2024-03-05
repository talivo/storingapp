<?php

//Variabelen vullen
$attractie = $_POST['attractie'];
$capaciteit = $_POST['capaciteit']; 
$melder = $_POST['melder'];
$group = $_POST['group'];

if (isset($_POST['prioriteit'])) {
    $prioriteit = 1;
} else {
    $prioriteit = 0;
}

//1. Verbinding
require_once 'conn.php';

//2. Query
$query = "INSERT INTO meldingen (attractie, type, capaciteit, prioriteit, melder) 
VALUES(:attractie, :group, :capaciteit, :prioriteit, :melder)";

//3. Prepare
$statement = $conn->prepare($query);

//4. Execute
$statement->execute([
    ':attractie'=> $attractie,
    ':group'=> $group,
    ':capaciteit'=> $capaciteit,
    ':prioriteit'=> $prioriteit,
    ':melder'=> $melder,
]);

header('Location: ../meldingen/index.php?msg=Melding opgeslagen');