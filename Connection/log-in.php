<?php

session_start();

include("connection.php");


// checking a user account
if (isset($_GET['connect'])) {
  // check if username and password are correct 
  $username = $_GET['username'];
  $password = $_GET['password'];

  // getting the user id
  $sqlId = "SELECT Id FROM users WHERE Username='$username'";
  $resultId = $con->query($sqlId);
  if ($resultId->num_rows == 1) {
    $row = $resultId->fetch_assoc();
    $userId = $row["Id"];
  }


  // checking for a matching user
  $sql = "SELECT * FROM users WHERE Username='$username' AND Password='$password'";
  $result = $con->query($sql);

  // If a matching user is found, log them in
  if ($result->num_rows == 1) {
    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['userId'] = $userId;

    $row = $result->fetch_assoc();
    $userRole = $row["Role"];

    // Store user role in session
    $_SESSION['userRole'] = $userRole;

    // Redirect based on user role
    if ($userRole === 'admin') {
      header('Location: ../Home/adminPage.php');
    } elseif ($userRole === 'user') {
      header('Location: ../Home/home.php');
    }
    exit;
  } else {
    // If no matching user is found, display an error message
    $error = "Nom d'utilisateur ou mot de passe incorrect";
  }

  // Close the database connection
  $con->close();
}





// checking users info and creating a new account
if (isset($_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['phone'], $_POST['signupUsername'], $_POST['signupPassword'])) {

  function userExists($username)
  {
    include("connection.php");

    $stmt = $con->prepare("SELECT `Username` FROM `users` WHERE `Username` = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    // Get the result of the query
    $result = $stmt->get_result();

    // Check if the username exists
    if ($result->num_rows > 0) {
      $stmt->close();
      $con->close();
      return true;
    } else {
      $stmt->close();
      $con->close();
      return false;
    }
  }


  function emailExists($email)
  {
    include("connection.php");

    $stmt = $con->prepare("SELECT `Email` FROM `users` WHERE `Email` = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    // Get the result of the query
    $result = $stmt->get_result();

    // Check if the email exists
    if ($result->num_rows > 0) {
      $stmt->close();
      $con->close();
      return true;
    } else {
      $stmt->close();
      $con->close();
      return false;
    }
  }

  // retrievung inputs fields values
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $signupUsername = $_POST['signupUsername'];
  $signupPassword = $_POST['signupPassword'];

  // calling the fucntion responsible for email existence checking
  if (emailExists($email)) {
    $response = ['success' => false, 'message' => 'Cette adresse e-mail est déjà utilisée!'];
  } else if (userExists($signupUsername)) {
    $response = ['success' => false, 'message' => 'Ce nom d\'utilisateur existe déjà'];
  } else {
    // prepare the sql statement
    $stmt = $con->prepare("INSERT INTO `users`(`First_name`, `Last_name`, `Email`, `Mobile`, `Username`, `Password`) VALUES (?, ?, ?, ?, ?, ?)");

    // Bind the parameters in order to insert into the database
    $stmt->bind_param("ssssss", $firstName, $lastName, $email, $phone, $signupUsername, $signupPassword);

    // Execute the statement
    if ($stmt->execute()) {
      $response = ['success' => true];
    } else {
      $response = ['success' => false, 'message' => 'Un problème est survenu lors de la création de votre compte'];
    }

    // Close the statement and connection
    $stmt->close();
    $con->close();
  }

  // Return the JSON response
  echo json_encode($response);
  exit();
}








?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- adding css files -->
  <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/global-rules.css">
  <link rel="stylesheet" href="../css/log-in.css" />
  <!-- adding inline styles -->
  <style>
    body {
      background-color: var(--dark-purple);
    }
  </style>
  <!-- adding google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300&display=swap"
    rel="stylesheet">
  <!-- adding fonts-awesome library -->
  <script src="https://kit.fontawesome.com/687c4d88d6.js" crossorigin="anonymous"></script>
  <title>Se connecter</title>
</head>

<body>
  <!-- starting the log-in page -->
  <div class="log-in">
    <div class="container">
      <div class="left">
        <h2>Bienvenue</h2>
        <p>Veuillez saisir vos informations d'authentification</p>
        <form method="GET" class="sign-in">
          <?php if (isset($error)) { ?>
            <p style="color:#ff0033;font-weight:bold">
              <?php echo $error; ?>
            </p>
          <?php } ?>
          <label for="">Nom d'utilisateur :</label>
          <input type="text" name="username">
          <label for="">Mot de passe :</label>
          <input type="password" name="password">
          <button class="submit" name="connect">Se connecter</button>
        </form>
        <p class="passForgetten">Mot de passe oublié?</p>
        <p>Vous n'avez pas de compte? <span class="logup-link">inscrivez-vous</span></p>
      </div>
      <div class="right">
        <div class="image">
          <img src="../images/Medicine-bro.svg" alt="log-in image">
        </div>
      </div>
    </div>
  </div>

  <!-- starting the log-up page(div) -->
  <div class="log-up">
    <div class="container">
      <div class="text">
        <h2>Créer un nouveau compte!</h2>
      </div>
      <div class="form">
        <form method="POST" id="signup-form">
          <div class="name">
            <input type="text" name="firstName" id="first-name" placeholder="Veuillez entrez votre prénom" required>
            <input type="text" name="lastName" id="last-name" placeholder="Veuillez entrez votre nom" required>
          </div>
          <div class="contact">
            <input type="email" name="email" id="email" placeholder="Veuillez entrez votre email" required>
            <input type="tel" name="phone" id="phone" pattern="^\+212[67]\d{8}$"
              placeholder="Veuillez entrez votre téléphone" required>
          </div>
          <input type="text" name="signupUsername" id="signup-username" id="userName"
            placeholder="Veuillez entrez votre nom d'utilisateur" required>
          <input type="password" name="signupPassword" id="signup-password" name="Password"
            placeholder="Veuillez entrez votre mot de passe" required>
      </div>
      <div class="buttons">
        <button id="signupBtn" name="sign-up">Créer compte</button>
      </div>
      </form>
      <button id="signupCancel">Annuler</button>
    </div>
  </div>

  <!-- the success/failed message after submiting the log-up form -->
  <div class="success">
    <i class="fa-solid fa-check"></i>
    Votre compte a été créé avec succès
  </div>

  <div class="failed">
    <i class="fa-sharp fa-solid fa-xmark"></i>
  </div>

  <!-- calling the log-in script -->
  <script src="../js/log-in.js"></script>

</body>

</html>