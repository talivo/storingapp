<?php

$action = $_POST['action'];

if($action == "create"){

    //Variabelen vullen
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
}

if($action == "update"){
    //Variabelen vullen
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

    //1. Verbinding
    require_once 'conn.php';

    //2. Query
    $query = "INSERT INTO meldingen (capaciteit, prioriteit, melder, overige_info) 
    VALUES(:capaciteit, :prioriteit, :melder, :overig)";

    //3. Prepare
    $statement = $conn->prepare($query);

    //4. Execute
    $statement->execute([
        ':capaciteit'=> $capaciteit,
        ':prioriteit'=> $prioriteit,
        ':melder'=> $melder,
        ':overig'=> $overig,
    ]);

    // Redirect naar index
    header('Location: ../meldingen/index.php?msg=Melding opgeslagen');
}

if($action == "delete"){

}