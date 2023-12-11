<?php
require('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $code = $_POST['code'];

    // Check if the email and code match what's in the database
    $checkVerificationQuery = "SELECT * FROM `users` WHERE email = '$email' AND verification_code = '$code'";
    $verificationResult = mysqli_query($con, $checkVerificationQuery);

    if (mysqli_num_rows($verificationResult) > 0) {
        // Mark the user as verified (you may want to update your database schema)
        $markVerifiedQuery = "UPDATE `users` SET verified = 1 WHERE email = '$email'";
        mysqli_query($con, $markVerifiedQuery);

        // Redirect to a success page or login page
        header("Location: login.php");
        exit();
    } else {
        $errorMessage = "Invalid verification code.";
    }
} elseif (isset($_GET['email'])) {
    $email = $_GET['email'];

    // Display the form with email pre-filled
    $emailField = '<input type="hidden" name="email" value="' . htmlspecialchars($email) . '" />';
} else {
    $errorMessage = "Invalid verification link.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Email Verification</title>
    <link rel="icon" href="img/core-img/logo_alb.png">
    <link rel="icon" href="img/core-img/logoComputerGaming.png">

    <link rel="stylesheet" href="style1.css">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSS -->
    <link rel="stylesheet" href="css/core-style.css">
</head>
    <!-- Additional styles for better appearance -->
    <style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
}

body .verification-container .verify-title {
    text-align: center;
    color: #2c3e50;
    font-size: 2.0rem;
    line-height: 1.3;
    font-weight: 700;
    font-family: "Ubuntu", sans-serif;
    
}


.verification-container {
    text-align: center;
    background-color: #ffffff;
    padding: 30px;
    border: 1px solid #ddd;
    border-radius: 15px;
    max-width: 400px;
    width: 100%;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
}

.error-message {
    color: #dc3545;
    font-weight: bold;
}

label {
    display: block;
    margin-bottom: 6px;
    color: #2c3e50;
}

#code {
    width: 100%;
    padding: 12px;
    margin-bottom: 12px;
    box-sizing: border-box;
    border: 1px solid #bdc3c7;
    border-radius: 8px;
    background-color: #ffffff;
}

input[type="submit"] {
    width: 100%;
    padding: 12px;
    background-color: #3498db;
    color: #fff;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: bold;
}

input[type="submit"]:hover {
    background-color: #2980b9;
}
    </style>
</head>
<body>
    <div class="verification-container">
        <?php
        if (isset($errorMessage)) {
            echo '<p class="error-message">' . $errorMessage . '</p>';
        } else {
            echo '<form method="post">
            <label for="code" class="verify-title">Verification Code:</label>
            <input type="text" id="code" name="code" required />
                      ' . $emailField . '
                      <br />
                      <input type="submit" value="Verify" />
                  </form>';
        }
        ?>
    </div>


    <header class="header_area">
    <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">
        <!-- Classy Menu -->
        <nav class="classy-navbar" id="essenceNav">
            <!-- Logo -->
            <a class="nav-brand" href="index.php"><img src="img/core-img/logo_alb.png" alt=""></a>
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
                        <li><a href="index.php">Home</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </div>
                <!-- Nav End -->
            </div>
        </nav>
    </div>
</header>



</body>
</html>
