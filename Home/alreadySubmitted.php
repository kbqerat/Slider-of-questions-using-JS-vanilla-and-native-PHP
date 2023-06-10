<?php
include("../Connection/connection.php");
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect the user to the login page
    header('Location: ../Connection/log-in.php');
    exit;
}

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- adding css files -->
    <link rel="stylesheet" href="../css/global-rules.css">
    <link rel="stylesheet" href="../css/home.css">
    <!-- adding google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300&display=swap"
        rel="stylesheet">
    <!-- adding fonts-awesome library -->
    <script src="https://kit.fontawesome.com/687c4d88d6.js" crossorigin="anonymous"></script>
    <title>Formulaire rempli</title>
</head>

<body>
    <div class="container">
        <div class="formDiv submitted" style="margin-top: 30px;">

            <div class="left-text">
                <h1 class="success-message">Votre formulaire est déjà rempli !</h1>
            </div>

            <span class="log-out">
                <i class="fa-solid fa-right-from-bracket"></i>
            </span>

            <div class="right-text">
                <span class="txt">Nous vous remercions sincèrement d'avoir pris le temps de remplir notre formulaire et
                    de répondre à nos questions.</br>
                    Vous pouvez vous déconnecter en cliquant sur le bouton</br> ci-dessous.
                </span>
                <span class="line-breaker"></span>
            </div>

        </div>
    </div>
    <script>
        let logoutButton = document.querySelector(".formDiv.submitted .log-out");
        logoutButton.addEventListener("click", () => {
            window.open("../Connection/log-in.php", "_self");
            // Make an AJAX request to the server-side script
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../Connection/log-out.php", true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) { }
            };
            xhr.send();
        });
    </script>
</body>

</html>