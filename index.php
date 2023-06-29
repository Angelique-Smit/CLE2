<?php
//start de session
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Reserveringsysteem</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
<nav>
    <section class="phoneContainer">
        <div class="navBox1">
            /*logo here*/
        </div>

        <div class="navBox2">
            <a href="index.html"> Praktijkinformatie </a>
        </div>

        <div class="navBox3">
            <a href="reservation.php"> Afspraak maken </a>
        </div>

        <div class="navBox4">
            <div class="dropdown" style="float:right; font-size: 30px;">
                <button class="dropbtn">...</button>
                <div class="dropdown-content">
                    <a href="login.php">Log in</a>
                    <a href="accountMaker.php">Maak een account</a>
                    <a href="logout.php">Log Uit</a>
                </div>
            </div>
        </div>
    </section>
</nav>

<header>
    <div class="headerPicBox">
        <img class="headerPic" src=".photo/GettyImages-1057500046-f7e673d3a91546b0bd419c5d8336b2e0.jpg" alt="People talking Stock Image">
    </div>
</header>
<main>
    <section class="headerText">
        <h1> CoachingPraktijk Overduin</h1>
        <h2 class="h2"> /* Slogan */</h2>
    </section>

    <section class="mainContainer1">
        <img src=".photo/People-Talking.jpg" alt="People talking Stock Image" class="pic1">
        <h2> /* Coole informatie */</h2>
        <p> Nog coolere informatie Nog coolere informatie Nog coolere informatie Nog coolere informatie Nog coolere informatie Nog coolere informatie
            Nog coolere informatie Nog coolere informatie Nog coolere informatie Nog coolere informatie Nog coolere informatie Nog coolere informatie </p>
    </section>

    <section class="mainContainer2">
        <img src=".photo/People-Talking.jpg" alt="People talking Stock Image" class="pic1">
        <h2> /* Coole informatie */</h2>
        <p> Nog coolere informatie Nog coolere informatie Nog coolere informatie Nog coolere informatie Nog coolere informatie Nog coolere informatie
            Nog coolere informatie Nog coolere informatie Nog coolere informatie Nog coolere informatie Nog coolere informatie Nog coolere informatie </p>
    </section>
</main>
<footer>
    <div class="footerLogo">/*Logo here*/</div>

    <section class="footerContainer">
        <div class="footerBox2 footerText"> <a href="summery.php"> Contact </a> </div>
        <div class="footerBox3 footerText"> <a href=""> Meld een bug </a> </div>
        <div class="footerBox4 footerText"> <a href="https://angelique-smit.github.io/Portfolio/">Gemaakt door</a> </div>
        <div class="footerBox5 footerText"> /*addressgegevens*/ </div>
        <div class="footerBox6 footerText"> /*Google maps link*/ </div>
    </section>
</footer>
</body>
</html>
