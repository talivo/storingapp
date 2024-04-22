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
                <label for="group"><?php echo $melding['attractie']; ?></label>
            </div>
            <div class="form-group">
                <label for="group">Type: </label>
                <label for="group"><?php echo $melding['type']; ?></label>
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
        </form>
    </div>
</body>
</html>