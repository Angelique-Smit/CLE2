<?php
//start de session
session_start();
/** @var $db */
require_once "includes/database.php";

if (!isset($_GET['id']) || $_GET['id'] === '') {
    header('Location: index.php');
    exit;
}

$reserveringID = $_GET['id'];

$query = "SELECT * FROM reserveringsysteem.reserveringen2 WHERE id = " . $reserveringID;
$result = mysqli_query($db, $query);

if (mysqli_num_rows($result) == 0) {
    header('Location: index.php');
    exit;
}

$reserveringen = [];

while ($row = mysqli_fetch_assoc($result)) {
    $reservation[] = $row;
}

if (isset($_POST['submitDelete'])) {
    $query = "DELETE FROM reserveringsysteem.reserveringen2 WHERE id = " . $reserveringID;
    $result = mysqli_query($db, $query)
    or die ('Error: ' . $query );

    header('Location: summery.php');
    exit;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<div class="summeryContainer">
    <section class="summeryList">
        <table style="width: 100vw; justify-content: space-evenly;">
            <thead>
            <tr>
                <th style="padding-right: 5vw">#</th>
                <th>Naam</th>
                <th>Email</th>
                <th>Telefoonnummer</th>
                <th>Datum</th>
                <th>Tijd</th>
                <th>id</th>
            </tr>
            </thead>

            <?php foreach ($reservation as $index => $reserveringen) { ?>
                <tr>
                    <td style="padding-right:5vw;"><?= $index + 1 ?></td>
                    <td><?= $reserveringen['name'] ?></td>
                    <td><?= $reserveringen['email'] ?></td>
                    <td><?= $reserveringen['phoneNumber'] ?></td>
                    <td><?= $reserveringen['date'] ?></td>
                    <td><?= $reserveringen['time'] ?></td>
                    <td><?= $reserveringen['id'] ?></td>
                </tr>
            <?php } ?>
        </table>

        <form method="post" action="edit.php?id=<?= $reserveringen['id']?>">
            <button name="submitChange" id="submitChange"> Afspraak aanpassen </button>
        </form>

        <form method="post">
            <button name="submitDelete" id="submitDelete"> Afspraak verwijderen </button>
        </form>

    </section>
    <div>
        <a class="button" href="index.php">Terug naar de hoofdpagina </a>
    </div>
</div>
</body>
</html>