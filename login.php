<?php
require('db.php');
session_start();

// Verifică dacă formularul de login a fost trimis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = stripslashes($_POST['username']);
    $username = mysqli_real_escape_string($con, $username);
    $password = stripslashes($_POST['password']);
    $password = mysqli_real_escape_string($con, $password);

    $query = "SELECT * FROM `users` WHERE username='$username' AND password='" . md5($password) . "'";
    $result = mysqli_query($con, $query) or die(mysql_error());
    $rows = mysqli_num_rows($result);

    if ($rows == 1) {
        // Autentificare reușită, obținem toate informațiile despre utilizator
        $user_data_query = "SELECT * FROM `users` WHERE username='$username'";
        $user_data_result = mysqli_query($con, $user_data_query);
        $user_data = mysqli_fetch_assoc($user_data_result);

        // Stocăm toate informațiile despre utilizator în sesiune
        $_SESSION['user_id'] = $user_data['id'];

        $_SESSION['username'] = $user_data['username'];
        $_SESSION['email'] = $user_data['email'];
        $_SESSION['dob'] = $user_data['dob'];
        $_SESSION['country'] = $user_data['country'];
        $_SESSION['authenticated'] = true; // Adăugați această linie pentru a marca autentificarea

        // Decideți unde să redirecționați utilizatorul în funcție de statutul de autentificare
        if (isset($_SESSION['authenticated'])) {
            header("Location: index_autentificat.php");
        } else {
            header("Location: index.php");
        }

        exit();
    } else {
        // Autentificare eșuată
        echo "<div class='form'>
              <h3>Incorrect Username/password.</h3><br/>
              <h7 class='link'>Click here to <a href='login.php'>Login</a> again.</h7>
              </div>";
    }
} else {
    // Dacă nu a fost trimis un formular POST, afișăm formularul de login
    ?>
    <form class="form" method="post" name="login">
        <h1 class="login-title">Logheaza-te</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" autofocus="true"/>
        <input type="password" class="login-input" name="password" placeholder="Password"/>
        <input type="submit" value="Login" name="submit" class="login-button"/>
        <p class="link"><a href="registration.php">Inregistreaza-te</a></p>
    </form>
    <?php
}

?>


<!-- Core Style CSS -->
<link rel="stylesheet" href="css/core-style.css">
<link rel="stylesheet" href="stylePagini.css">


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <link rel="icon" href="img/core-img/logoComputerGarage.png">
    <link rel="stylesheet" href="style1.css"/>
    

    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS -->
    <link rel="stylesheet" href="css/core-style.css">

</head>
<body>




<!-- HEADER -->

<body>
    <div class="header">
    <div class="container">
        <div class="navbar">
            <header class="header_area">
        <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">
            <!-- Classy Menu -->
            <nav class="classy-navbar" id="essenceNav">
                <!-- Logo -->
                <a class="nav-brand" href="index.php"><img src="img/core-img/logoComputerGarage.png" width="200px"></a>
                <!-- Navbar Toggler -->
                <div class="classy-navbar-toggler">
                    <span class="navbarToggler"><span></span><span></span><span></span></span>
                </div>
                <!-- Menu -->
                <div class="classy-menu">
                    <!-- close btn -->
                    <div class="classycloseIcon">
                        <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                    </div>
                    <!-- Nav Start -->
                    <div class="classynav">
                        <ul>
                                                <!-- Nav Start -->
                    <div class="classynav">
                        <ul>
                        <li><a href="index.php">Acasa</a>
                        </li>
                            <li><a href="contact.php">Contacteaza-ne</a></li>
                        </ul>
                    </div>
                    <!-- Nav End -->
                </div>
</div>
</nav>
</div>
</header>
    </div>
    </div>

</div>
</body>
</html>