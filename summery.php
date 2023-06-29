<?php
//start de session
session_start();
/** @var mysqli $db */
    require_once "includes/database.php";

    $accountId = $_SESSION['loggedInUser']['accountId'];

    if ($accountId === '') {
        header('Location: index.php');
        exit;
    }

    $query = "SELECT * FROM reserveringen2 WHERE accountId = '$accountId'";

    $result = mysqli_query($db, $query)
        or die ('Error: ' . $query );

    $reserveringen = [];
    $reservation = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $reservation[] = $row;
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
                    <td><a href="details.php?id=<?= $reserveringen['id'] ?>">Details</a></td>
                </tr>
                <?php } ?>
            </table>
        </section>
        <div>
            <a class="button" href="index.php">Terug naar de hoofdpagina </a>
            <br>
            <a class="button" href="reservation.php">Maak een afspraak </a>
        </div>
    </div>
</body>
</html>