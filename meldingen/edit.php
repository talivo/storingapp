<?php
    session_start();
    if(!isset($_SESSION['user_id'])) {
        $msg = "Je moet eerst inloggen";
        header("Location: ../login.php?msg=".$msg);
        die;
} 
?>

<!doctype html>
<html lang="nl">
<head>
    <title>StoringApp / Meldingen / Aanpassen</title>
    <?php require_once '../head.php'; ?>
</head>
<body>
    <?php require_once '../header.php'; ?>
    <div class="container">
        <h1>Melding aanpassen</h1>
        
        <?php
        require_once '../backend/conn.php';
        $id = $_GET['id'];
        $query = "SELECT * FROM meldingen WHERE id = :id";
        $statement = $conn->prepare($query);
        $statement->execute([":id" => $id]);
        $melding = $statement->fetch(PDO::FETCH_ASSOC);
        ?>

        <form action="../backend/meldingenController.php" method="POST">
            <div class="form-group">
                <label for="attractie">Naam attractie:</label>
                <?php echo $melding['attractie']; ?>
            </div>
            <div class="form-group">
                <label>Type: </label>
                <?php echo $melding['type']; ?>
            </div>
            <div class="form-group">
                <label for="capaciteit">Capaciteit p/uur:</label>
                <input type="number" min="0" name="capaciteit" id="capaciteit" class="form-input" value="<?php echo $melding['capaciteit']; ?>">
            </div>
            <div class="form-group">
                <label for="prioriteit">Prio: </label>
                <input type="checkbox" name="prioriteit" id="prioriteit" class="form-input-prio"
                <?php if($melding['prioriteit']) echo 'checked'; ?>
                >
                <label for="prioriteit">Melding met prioriteit</label>
            </div>
            <div class="form-group">
                <label for="melder">Naam melder:</label>
                <input type="text" name="melder" id="melder" class="form-input" value="<?php echo $melding['melder']; ?>">
            </div>
            <div class="form-group">
                <label for="overig">Overige info:</label>
                <textarea name="overig" id="overig" class="form-input" rows="4"><?php echo $melding['overige_info']; ?></textarea>
            </div>
            <input type="submit" value="Melding opslaan">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="action" value="update">
        </form>
        <hr>
        <form action="../backend/meldingenController.php" method="POST">
            <div class="form-group">
                <input type="submit" value="Verwijderen">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="action" value="delete">
            </div>
        </form>
    </div>
</body>
</html>
