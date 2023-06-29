<?php
session_start();
/** @var mysqli $db */
$login = false;

// Login check?
if (isset($_SESSION['loggedInUser'])) {
    $login = true;
}

if (isset($_POST['submit'])) {
    require_once "includes/database.php";

    // Ophalen form data
    $email = mysqli_escape_string($db, $_POST['email']);
    $password = mysqli_escape_string($db, $_POST['password']);

    // Server-side validation
    $errorMessage = [];
    if ($email == '' || $password == '') {
        $errorMessage = 'Dit veld mag niet leeg zijn.';
    }

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //This email is valid
    } else {
        $errorMessage = 'Dit email address bestaat niet.';
    }

    // Data vergelijken met de database data
    if (empty($errors)) {
        // Selecteer de email uit de database
        $query = "SELECT * FROM reserveringsysteem.accountinfo WHERE email='$email'";
        $result = mysqli_query($db, $query);

        // Check of de user bestaat
        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);

            // Check of de wachtwoorden kloppen
            if (password_verify($password, $user['password'])) {
                $login = true;

                // Store the user in the session
                $_SESSION['loggedInUser'] = [
                    'accountId'    => $user['accountId'],
                    'name'  => $user['name'],
                    'email' => $user['email'],
                ];

                // Redirect to secure page
                header('Location: summery.php');
                exit;
            } else {
                //error incorrect log in
                $errorMessage = 'De opgegeven email en wachtwoord is onjuist';
            }
        } else {
            //Error code, verkeerde inlog
            $errorMessage = 'De opgegeven email en wachtwoord is onjuist';
        }
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
        <h2> Log hieronder in </h2>
        <form method="post">
            <div class="formfield">
                <label for="email"> Email </label>
                <input type="email" name="email" id="email" placeholder="Vul hier uw email in">
                <?php echo $errorMessage ?? '' ?>
            </div>

            <div class="formfield">
                <label for="password"> Wachtwoord </label>
                <input type="password" name="password" id="password" placeholder="Vul hier uw wachtwoord in">
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
