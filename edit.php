<?php
//start de session
session_start();
//Ophalen database
/** @var $db */
require_once "includes/database.php";

//Checkt of de gebruiker is ingelogd
$accountId = $_SESSION['loggedInUser']['accountId'];

if ($accountId === '') {
    header('Location: index.php');
    exit;
}

// ID wordt in een variabel gezet
$reserveringID = mysqli_escape_string($db, $_GET['id']);

//Vraagt de data uit de database op met het gegeven ID nummer en zet dit in de variabele result.
$query = "SELECT * FROM reserveringsysteem.reserveringen2 WHERE id = '$reserveringID'";
$result = mysqli_query($db, $query);

//Als de informatie leeg is/gelijk is aan 0, ga terug naar index pagina.
if (mysqli_num_rows($result) == 0) {
    header('Location: index.php');
    exit;
}

//Variabelen waar de data in wordt gepost worden eerst opgeschreven als een lege string
$date   = "";
$time = "";
$name   = "";
$email = "";
$phoneNumber  = "";

//Variabelen wordt nu de data in gepost.
if (isset($_POST['submit'])) {
        $date = mysqli_escape_string($db, $_POST['date']);
        $time = mysqli_escape_string($db, $_POST['time']);
        $name = mysqli_escape_string($db, $_POST['name']);
        $email = mysqli_escape_string($db, $_POST['email']);
        $phoneNumber = mysqli_escape_string($db, $_POST['phoneNumber']);

    $errorMessage = [];
    if ( $date == '' || $time == '' || $name == '' || $email == '' || $phoneNumber == '') {
        $errorMessage = 'Dit veld mag niet leeg zijn.';
    }
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //This email is valid
    } else {
        $errorMessage = 'Dit email address bestaat niet.';
    }
//Update query
    if ($errorMessage === '') {
        $query = "UPDATE `reserveringsysteem`.reserveringen2 
                  SET `date`= '$date',`time`= '$time' ,`name`= '$name',`email`='$email',`phoneNumber`='$phoneNumber' 
                  WHERE id = '$reserveringID'";

        mysqli_query($db, $query);
        header('Location: summery.php');
        exit;
    }
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
    <section>
        <h2> Vul hieronder de nieuwe informatie in </h2>

        <form method="post">
            <section class="date">
                <label for="date"> </label>
                <input type="date" name="date" id="date" class="date"
            </section>

            <section class="timePicker">
                <label for="time" class="label"> Inquiry </label>
                <select name="time" id="time" class="answer" required>
                    <option value="10:00-12:00"> 10:00 - 12:00 </option>
                    <option value="12:00-14:00"> 12:00 - 14:00 </option>
                    <option value="14:00-16:00"> 14:00 - 16:00 </option>
                    <option value="16:00-18:00"> 16:00 - 18:00 </option>
                    <?php echo $errorMessage ?? '' ?>
                </select>
            </section>

            <section class="nameForm">
                <div class="formfield">
                    <label for="name" class="label">Voor en achternaam</label>
                    <input type="text" name="name" id="name" class="name" placeholder="Vul hier uw volledige naam in" required>
                    <?php echo $errorMessage ?? '' ?>
                </div>

                <div class="formfield">
                    <label for="email" class="label">email</label>
                    <input type="email" name="email" id="email" class="email" placeholder="Vul hier uw email adress in" required>
                    <?php echo $errorMessage ?? '' ?>
                </div class=formfield>

                <div class="formfield">
                    <label for="phoneNumber" class="label">Telefoonnummer</label>
                    <input type="number" name="phoneNumber" id="phoneNumber" class="phoneNumber" placeholder="Vul hier uw telefoonnummer" required>
                    <?php echo $errorMessage ?? '' ?>
                </div>

                <div class="formfield">
                    <input type="hidden" name="id" id="id" value="<?= $reserveringID ?>">
                    <?php echo $errorMessage ?? '' ?>
                </div>

                <section class="submit">
                    <label for="submit"></label>
                    <input type="submit" id="submit" name="submit">
                </section>
        </form>
    </section>
</body>
</html>