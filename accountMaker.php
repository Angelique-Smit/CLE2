<?php
/** @var mysqli $db */
require_once "includes/database.php";
if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];

    $errorMessage = [];
    if ($username == '' || $password == '' || $name == '' || $email == '' || $phoneNumber == '') {
        $errorMessage = 'Dit veld mag niet leeg zijn.';
    }

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //This email is valid
    } else {
        $errorMessage = 'Dit email address bestaat niet.';
    }

    if ($errorMessage == '') {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO `reserveringsysteem`.accountinfo (`username`, `password`, `name`, `email`, `phoneNumber`) 
                  VALUES ('$username','$password','$name','$email','$phoneNumber')";

        $result = mysqli_query($db, $query)
        or die('Error: ' . mysqli_error($db) . ' with query ' . $query);

        if ($result) {
            header('Location: login.php');
            exit;
        }
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
</head>
<body>
    <section>
        <form method="post">
            <div class="formfield">
                <label for="username">Gebruikersnaam</label>
                <input type="text" name="username" id="username" placeholder="Vul hier uw gebruikersnaam in">
                <?php echo $errorMessage ?? '' ?>
            </div>

            <div class="formfield">
                <label for="password">Wachtwoord</label>
                <input type="password" name="password" id="password" placeholder="Vul hier uw wachtwoord in">
                <?php echo $errorMessage ?? '' ?>
            </div>

            <div class="formfield">
                <label for="name">Volledige naam</label>
                <input type="text" name="name" id="name" placeholder="Vul hier uw naam in">
                <?php echo $errorMessage ?? '' ?>
            </div>

            <div class="formfield">
                <label for="email"> Email </label>
                <input type="email" name="email" id="email" placeholder="Vul hier uw email in">
                <?php echo $errorMessage ?? '' ?>
            </div>

            <div class="formfield">
                <label for="phoneNumber"> Telefoonnummer </label>
                <input type="number" name="phoneNumber" id="phoneNumber" placeholder="Vul hier uw email in">
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



