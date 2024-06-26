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
    <title>StoringApp / Meldingen</title>
    <?php require_once '../head.php'; ?>
</head>

<body>

    <?php require_once '../header.php'; ?>
    
    <div class="container">
        <h1>Meldingen</h1>
        <a href="create.php">Nieuwe melding &gt;</a>

        <?php if(isset($_GET['msg']))
        {
            echo "<div class='msg'>" . $_GET['msg'] . "</div>";
        } ?>

        <?php
            require_once '../backend/conn.php';
            $query = "SELECT * FROM meldingen";
            $statement = $conn->prepare($query);
            $statement->execute();
            $meldingen = $statement->fetchAll(PDO::FETCH_ASSOC); 
        ?>

        <div class="meldingen-en-filter">
            <p>Aantal meldingen: <strong><?php echo count($meldingen); ?></strong></p>
            <form action="" method="GET">
                <select name="status">
                    <option value="">- kies een type -</option>
                    <option value="todo">Todo</option>
                    <option value="doing">Doing</option>
                    <option value="done">Done</option>
                </select>
                <input type="submit" value="filter">
            </form>
        </div>


        <table>
            <tr>
                <th>Achtbaan</th>
                <th>Type</th>
                <th>Capaciteit</th>
                <th>Melder</th>
                <th>Overige info</th>
                <th>Aanpassen</th>
            </tr>
            <?php foreach ($meldingen as $melding): ?>
                <tr>
                    <td><?php echo $melding['attractie']; ?></td>
                    <td><?php echo $melding['type']; ?></td>
                    <td><?php echo $melding['capaciteit']; ?></td>
                    <td><?php echo $melding['melder']; ?></td>
                    <td><?php echo $melding['overige_info']; ?></td>
                    <td><a href="edit.php?id=<?php echo $melding['id']; ?>">aanpassen</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
