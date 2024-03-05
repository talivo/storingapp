<?php

//Variabelen vullen
$attractie = $_POST['attractie'];
$group = $_POST['group'];
$capaciteit = $_POST['capaciteit']; 
if (isset($_POST['prioriteit'])) {
    $prioriteit = 1;
} else {
    $prioriteit = 0;
}
$melder = $_POST['melder'];
$overig = $_POST['overig'];

//1. Verbinding
require_once 'conn.php';

//2. Query
$query = "INSERT INTO meldingen (attractie, type, capaciteit, prioriteit, melder, overige_info) 
VALUES(:attractie, :group, :capaciteit, :prioriteit, :melder, :overig)";

//3. Prepare
$statement = $conn->prepare($query);

//4. Execute
$statement->execute([
    ':attractie'=> $attractie,
    ':group'=> $group,
    ':capaciteit'=> $capaciteit,
    ':prioriteit'=> $prioriteit,
    ':melder'=> $melder,
    ':overig'=> $overig,
]);

// Redirect naar index
header('Location: ../meldingen/index.php?msg=Melding opgeslagen');