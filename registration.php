<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inregistrare</title>
    <link rel="icon" href="img/core-img/logoComputerGarage.png">
    <link rel="stylesheet" href="style1.css">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSS -->
    <link rel="stylesheet" href="css/core-style.css">
</head>
<body>
<?php
require('db.php');
require('PHPMailer.php');
require('Exception.php');
require('SMTP.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    // Verificare pentru fiecare câmp în parte
    if (empty($_POST['username'])) {
        $errors[] = "Username is required";
    }
    if (empty($_POST['email'])) {
        $errors[] = "Email is required";
    }
    if (empty($_POST['password'])) {
        $errors[] = "Password is required";
    }
    if (empty($_POST['day']) || empty($_POST['month']) || empty($_POST['year'])) {
        $errors[] = "Date of Birth is required";
    }
    if (empty($_POST['country'])) {
        $errors[] = "Country is required";
    }

    if (empty($errors)) {
        $username = stripslashes($_POST['username']);
        $username = mysqli_real_escape_string($con, $username);
        $email = stripslashes($_POST['email']);
        $email = mysqli_real_escape_string($con, $email);
        $password = stripslashes($_POST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $dob = $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'];
        $country = stripslashes($_POST['country']);
        $create_datetime = date("Y-m-d H:i:s");

        $check_user_query = "SELECT * FROM `users` WHERE username='$username' OR email='$email'";
        $check_user_result = mysqli_query($con, $check_user_query);

        if (mysqli_num_rows($check_user_result) > 0) {
            echo "<div class='form'>
              <h3>Username or email already exists.</h3><br/>
              <h7 class='link'>Click <a href='registration.php'>here</a> to try again.</a>.</h7>
              </div>";
        } else {
            $query = "INSERT into `users` (username, password, email, dob, country, create_datetime)
                      VALUES ('$username', '" . md5($password) . "', '$email', '$dob', '$country', '$create_datetime')";
            $result = mysqli_query($con, $query);

            if ($result) {
                echo "<div class='form'>
                      <h3>Registration successful.</h3><br/>
                      <h7 class='link'>Click <a href='login.php' to login>Login.</a>.</h7>
                      </div>";
            } else {
                echo "<div class='form'>
                      <h3>Required fields are missing.</h3><br/>
                      <h7 class='link'>Click <a href='registration.php'>here</a> to try again.</a>.</h7>
                      </div>";
            }
        }
    } else {
        // Afișează erorile
        echo "<div class='form'><h3>Ooops:</h3><ul>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul><br/><h7 class='link'>Click <a href='registration.php'>here</a> to try again.</a>.</h7></div>";
    }
} else {
?>
<!-- Your existing HTML form code remains unchanged -->

<form class="form" action="" method="post" onsubmit="return validateForm();">
    <h1 class="login-title">Registration</h1>
    <input type="text" class="login-input" name="username" placeholder="Username" required/>
    <input type="email" class="login-input" name="email" placeholder="Email Address" required/>
    <input type="password" class="login-input" name="password" placeholder="Password">

    <div class="birthdate-container">
        <select id="day" name="day" required>
            <option value="" disabled selected>Day</option>
            <?php for ($i = 1; $i <= 31; $i++) : ?>
                <option value="<?= $i ?>"><?= $i ?></option>
            <?php endfor; ?>
        </select>

        <select id="month" name="month" required>
            <option value="" disabled selected>Month</option>
            <?php
            $months = [
                1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
                5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
                9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
            ];
            ?>
            <?php foreach ($months as $key => $value) : ?>
                <option value="<?= $key ?>"><?= $value ?></option>
            <?php endforeach; ?>
        </select>

        <select id="year" name="year" required>
            <option value="" disabled selected>Year</option>
            <?php for ($i = 1900; $i <= date('Y'); $i++) : ?>
                <option value="<?= $i ?>"><?= $i ?></option>
            <?php endfor; ?>
        </select>
    </div>

    <label for="country">Country:</label>
<select id="country" name="country" required>
    <!-- Opțiune pentru a alege -->
    <option value="" disabled selected>Select a country</option>
</select>

<script>
// Lista cu țările din Europa
var europeanCountries = [
    "Albania", "Andorra", "Austria", "Belarus", "Belgium", "Bosnia and Herzegovina", "Bulgaria", "Croatia",
    "Cyprus", "Czech Republic", "Denmark", "Estonia", "Finland", "France", "Germany", "Greece", "Hungary",
    "Iceland", "Ireland", "Italy", "Kosovo", "Latvia", "Liechtenstein", "Lithuania", "Luxembourg", "Malta",
    "Moldova", "Monaco", "Montenegro", "Netherlands", "North Macedonia", "Norway", "Poland", "Portugal",
    "Romania", "Russia", "San Marino", "Serbia", "Slovakia", "Slovenia", "Spain", "Sweden", "Switzerland",
    "Ukraine", "United Kingdom", "Vatican City"
];

// Obține elementul select
var countrySelect = document.getElementById("country");

// Adaugă opțiunile în elementul select
for (var i = 0; i < europeanCountries.length; i++) {
                        var option = document.createElement("option");
                        var formattedCountry = europeanCountries[i].toLowerCase().replace(/\b\w/g, function (l) {
                            return l.toUpperCase();
                        });
                        option.value = formattedCountry.replace(/\s+/g, "_"); // Convertește în format lowercase și înlocuiește spațiile cu underscore
                        option.text = formattedCountry;
                        countrySelect.add(option);
                    }
</script>

    <input type="submit" name="submit" value="Register" class="login-button">
    <h3 class="link"><a href="login.php">Click to Login</a></h3>
</form>
<?php
}
?>

<script>
    function validateForm() {
        // Verifică manual dacă câmpurile necesare sunt completate
        var username = document.forms["form"]["username"].value;
        var email = document.forms["form"]["email"].value;
        var password = document.forms["form"]["password"].value;
        var day = document.forms["form"]["day"].value;
        var month = document.forms["form"]["month"].value;
        var year = document.forms["form"]["year"].value;
        var country = document.forms["form"]["country"].value;

        if (username == "" || email == "" || password == "" || day == "" || month == "" || year == "" || country == "") {
            alert("Toate câmpurile sunt obligatorii");
            return false;
        }
    }
</script>

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

</body>
</html>
