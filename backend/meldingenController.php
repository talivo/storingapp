<?php

$action = $_POST['action'];

if($action == "create"){
    $attractie = $_POST['attractie'];
    if(empty($attractie)) {
        $errors[] = "Vul de attractie-naam in.";
    }
    $group = $_POST['group'];
    $capaciteit = $_POST['capaciteit']; 
    if(!is_numeric($capaciteit)) {
        $errors[] = "Vul voor capaciteit een geldig getal in.";
    }
    if (isset($_POST['prioriteit'])) {
        $prioriteit = 1;;
    } else {
        $prioriteit = 0;
    }
    $melder = $_POST['melder'];
    if(empty($melder)) {
        $errors[] = "Vul de melder-naam in.";
    }
    $overig = $_POST['overig'];

    if(isset($errors)) {
        var_dump($errors);
        die();
    }

    require_once 'conn.php';
    $query = "INSERT INTO meldingen (attractie, type, capaciteit, prioriteit, melder, overige_info) 
    VALUES(:attractie, :group, :capaciteit, :prioriteit, :melder, :overig)";
    $statement = $conn->prepare($query);
    $statement->execute([
        ':attractie'=> $attractie,
        ':group'=> $group,
        ':capaciteit'=> $capaciteit,
        ':prioriteit'=> $prioriteit,
        ':melder'=> $melder,
        ':overig'=> $overig,
    ]);

    header('Location: ../meldingen/index.php?msg=Melding opgeslagen');
}

if($action == "update"){
    $id = $_POST['id'];
    $capaciteit = $_POST['capaciteit']; 
    if(!is_numeric($capaciteit)) {
        $errors[] = "Vul voor capaciteit een geldig getal in.";
    }
    if (isset($_POST['prioriteit'])) {
        $prioriteit = true;
    } else {
        $prioriteit = false;
    }
    $melder = $_POST['melder'];
    if(empty($melder)) {
        $errors[] = "Vul de melder-naam in.";
    }
    $overig = $_POST['overig'];

    if(isset($errors)) {
        var_dump($errors);
        die();
    }

    require_once 'conn.php';
    $query = "UPDATE meldingen SET capaciteit = :capaciteit, prioriteit = :prioriteit, melder = :melder, overige_info = :overig WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->execute([
        ':capaciteit' => $capaciteit,
        ':prioriteit' => $prioriteit,
        ':melder' => $melder,
        ':overig' => $overig,
        ':id' => $id
    ]);

    header('Location: ../meldingen/index.php?msg=Melding is aangepast');
}

if($action == "delete"){
    $id = $_POST['id'];
    require_once '../backend/conn.php';
    $query = "DELETE FROM meldingen WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->execute([
        'id' => $id
    ]);
    $meldingen = $statement->fetchAll(PDO::FETCH_ASSOC); 

    header('Location: ../meldingen/index.php?msg=Melding verwijderd');
}