<?php
session_start();

/** @var mysqli $db */
require_once "includes/database.php";
$accountId = '';

$accountId = $_SESSION['loggedInUser']['accountId'];

if (isset($_POST['submit'])) {
    try {
        $date = mysqli_escape_string($db, $_POST['date']);
        $time = mysqli_escape_string($db, $_POST['time']);
        $name = mysqli_escape_string($db, $_POST['name']);
        $email = mysqli_escape_string($db, $_POST['email']);
        $phoneNumber = mysqli_escape_string($db, $_POST['phoneNumber']);
        $accountId = mysqli_escape_string($db, $_POST['accountId']);

    } catch (Exception $errorMessage) {
        header('Location: index.php');
        exit;
    }

    $errorMessage = [];
    if ( $date == '' || $time == '' || $name == '' || $email == '' || $phoneNumber == '') {
        $errorMessage = 'Dit veld mag niet leeg zijn.';
    }

    if ($phoneNumber > 10 || $phoneNumber < 10) {
        $errorMessage = 'Ongeldig telefoonnummer';
    }

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //This email is valid
    } else {
        $errorMessage = 'Dit email address bestaat niet.';
    }

    if ($errorMessage == ''){
        $query = "INSERT INTO reserveringen2 (date, time, name, email, phoneNumber, accountId) 
                  VALUES ('$date','$time','$name','$email','$phoneNumber', '$accountId')";

        $result = mysqli_query($db, $query)
        or die('Error: ' . mysqli_error($db) . ' with query ' . $query);
    }
        mysqli_close($db);

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

    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/reservation.css">
</head>
<body>
    <nav>
        <section class="phoneContainer">
            <div class="navBox1">
                /*logo here*/
            </div>

            <div class="navBox2">
                <a href="index.php"> Praktijkinformatie </a>
            </div>

            <div class="navBox3">
                <a href=""> Afspraak maken </a>
            </div>

            <div class="navBox4">
                <div class="dropdown" style="float:right; font-size: 30px;">
                    <button class="dropbtn">...</button>
                    <div class="dropdown-content">
                        <a href="login.php">Log in</a>
                        <a href="accountMaker.php">Maak een account</a>
                        <a href="logout.php">Log uit</a>
                    </div>
                </div>
            </div>
        </section>
    </nav>
    <main>
            <form method="post">
                <section class="date">
                    <label for="date"> </label>
                    <input type="date" name="date" id="date" class="date" value="<?= isset($date) ? htmlentities($date) : '' ?>">
                    <?php echo $errorMessage ?? '' ?>
                </section>

                <section class="timePicker">
                    <label for="time" class="label"> Inquiry </label>
                    <select name="time" id="time" class="answer">
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
                        <input type="text" name="name" id="name" class="name" value="<?= isset($name) ? htmlentities($name) : '' ?>" placeholder="Vul hier uw volledige naam in">
                        <?php echo $errorMessage ?? '' ?>
                    </div>

                    <div class="formfield">
                        <label for="email" class="label">email</label>
                        <input type="email" name="email" id="email" class="email" value="<?= isset($name) ? htmlentities($email) : '' ?>" placeholder="Vul hier uw email adress in">
                        <?php echo $errorMessage ?? '' ?>
                    </div class=formfield>

                    <div class="formfield">
                        <label for="phoneNumber" class="label">Telefoonnummer</label>
                        <input type="number" name="phoneNumber" id="phoneNumber" class="phoneNumber" value="<?= isset($phoneNumber) ? htmlentities($phoneNumber) : '' ?>" placeholder="Vul hier uw telefoonnummer">
                        <?php echo $errorMessage ?? '' ?>
                    </div>

                    <div class="formfield">
                        <input type="hidden" name="accountId" id="accountId" value="<?= $accountId ?>">
                    </div>

                    <section class="submit">
                        <label for="submit"></label>
                        <input type="submit" id="submit" name="submit">
                    </section>
            </form>
    </main>
    <footer>
        <div class="footerLogo">/*Logo here*/</div>
        <section class="footerContainer">
            <div class="footerBox2 footerText"> <a href=""> Contact </a> </div>
            <div class="footerBox3 footerText"> <a href=""> Meld een bug </a> </div>
            <div class="footerBox4 footerText"> <a href="https://angelique-smit.github.io/Portfolio/">Gemaakt door</a> </div>
            <div class="footerBox5 footerText"> /*adressgegevens*/ </div>
            <div class="footerBox6 footerText"> /*Google maps link*/ </div>
        </section>
    </footer>
</body>
</html>





