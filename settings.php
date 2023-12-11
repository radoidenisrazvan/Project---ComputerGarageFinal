<?php
session_start();
require('db.php');

// Inițializează variabilele de sesiune, dacă nu sunt setate
$_SESSION['username'] = isset($_SESSION['username']) ? $_SESSION['username'] : '';
$_SESSION['email'] = isset($_SESSION['email']) ? $_SESSION['email'] : '';
$_SESSION['dob'] = isset($_SESSION['dob']) ? $_SESSION['dob'] : '';
$_SESSION['country'] = isset($_SESSION['country']) ? $_SESSION['country'] : '';

// Copiază valorile în variabile locale pentru a le utiliza în HTML
$current_username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
$current_email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
$current_dob = isset($_SESSION['dob']) ? $_SESSION['dob'] : '';
$current_country = isset($_SESSION['country']) ? $_SESSION['country'] : '';

// Verifică dacă formularul a fost trimis
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    // Procesează datele primite din formular și actualizează baza de date
    $currentPassword = mysqli_real_escape_string($con, $_POST['current_password']);
    $newUsername = mysqli_real_escape_string($con, $_POST['username']);
    $newEmail = mysqli_real_escape_string($con, $_POST['email']);
    $newPassword = mysqli_real_escape_string($con, $_POST['password']);
    $newCountry = mysqli_real_escape_string($con, $_POST['country']);

    // Verifică parola actuală
    $sqlCheckPassword = "SELECT * FROM users WHERE id = " . $_SESSION['user_id'] . " AND password = '" . md5($currentPassword) . "'";
    $resultCheckPassword = mysqli_query($con, $sqlCheckPassword);

    if ($resultCheckPassword && mysqli_num_rows($resultCheckPassword) == 1) {
        // Verifică dacă există deja un utilizator cu noul nume de utilizator sau cu noua adresă de email
        $sqlCheckDuplicate = "SELECT * FROM users WHERE (username = '$newUsername' OR email = '$newEmail') AND id != " . $_SESSION['user_id'];
        $resultCheckDuplicate = mysqli_query($con, $sqlCheckDuplicate);

        if ($resultCheckDuplicate && mysqli_num_rows($resultCheckDuplicate) > 0) {
            // Afisează un mesaj de eroare personalizat dacă există deja un utilizator cu noul nume de utilizator sau cu noua adresă de email
            echo "<p style='color: #e74c3c; background-color: #ecf0f1; padding: 10px; border-radius: 5px;'>The username or email address is already in use.</p>";
        } else {
            // Continuă cu restul logicii de actualizare
            $sql = "UPDATE users SET ";
            $sql .= "username = '$newUsername', ";
            $sql .= "email = '$newEmail', ";
            $sql .= "country = '$newCountry' ";

            // Adaugă parola doar dacă a fost furnizată în formular
            if (!empty($newPassword)) {
                $hashedPassword = md5($newPassword);
                $sql .= ", password = '$hashedPassword'";
            }

            $sql .= " WHERE id = " . $_SESSION['user_id'];

            $result = mysqli_query($con, $sql);

            if ($result) {
                // Afișează un mesaj de succes
                echo "<h2 style='color: #2ecc71; background-color: #ecf0f1; padding: 10px; border-radius: 5px;'>Setarile au fost modificate cu succes!</h2>";
                // Actualizează variabilele de sesiune cu noile valori (dacă este cazul)
                $_SESSION['username'] = $newUsername;
                $_SESSION['email'] = $newEmail;
                $_SESSION['country'] = $newCountry;
            } else {
                // Afișează o eroare în cazul în care interogarea a eșuat
                echo "SQL Error: " . mysqli_error($con);
            }
        }
    } else {
        // Afișează un mesaj de eroare dacă parola actuală nu este corectă
        echo "<h2 style='color: #e74c3c; background-color: #ecf0f1; padding: 10px; border-radius: 5px;'>Parola este incorecta</h2>";
    }

    $current_username = $newUsername;
    $current_email = $newEmail;
    $current_country = $newCountry;
}
?>


<style>
    body {
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        background-color: #f8f9fa;
    }

    .container {
        display: flex;
        justify-content: space-between;
        margin: 20px;
    }

    .content-container {
        display: flex;
        width: 60%;
    }

    .left-box,
    .form-box {
        background-color: #fff;
        padding: 20px;
        margin: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .info-box {
        text-align: center;
    }

    .form-box {
        flex-grow: 1;
    }

    label {
        display: block;
        margin-top: 10px;
        font-weight: bold;
    }

    input,
    select {
        width: 100%;
        padding: 12px;
        margin-bottom: 16px;
        border: 1px solid #bdc3c7;
        border-radius: 8px;
        background-color: #ffffff;
        box-sizing: border-box;
    }

    button {
        width: 100%;
        padding: 15px;
        background-color: #8a2be2;
        color: #fff;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: bold;
        margin-top: 20px;
    }

    .delete-button {
        background-color: #e74c3c;
    }

    .delete-button:hover,
    button:hover {
        background-color: #6c1c18;
    }

    .success-message {
        color: #2ecc71;
        background-color: #ecf0f1;
        padding: 10px;
        border-radius: 5px;
        margin-top: 20px;
    }

    .error-message {
        color: #e74c3c;
        background-color: #ecf0f1;
        padding: 10px;
        border-radius: 5px;
        margin-top: 20px;
    }
    .logout-button {
    width: 100%;
    padding: 15px;
    background-color: #8a2be2;
    color: #fff;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: bold;
    margin-top: 20px;
}

.logout-button:hover {
    background-color: #8a2be2;
}
</style>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setări cont</title>

    <link rel="icon" href="img/core-img/logoComputerGarage.png">


    <link rel="stylesheet" href="css/core-style.css">



</head>
<body>

    <div class="container">
        <div class="content-container">

            <div class="left-box">
                <div class="info-box">
                    <br>
                    <h3>Detalii cont</h3><br><br><br>
                    <!-- Afișează numele de utilizator, adresa de email, data de naștere și țara -->
                    <h6>Nume: <?php echo $current_username; ?></h6>
                    <h6>Email: <?php echo $current_email; ?></h6>
                    <h6>Data nasterii:<br><?php echo $current_dob; ?></h6>
                    <h6>Tara: <?php echo $current_country; ?></h6> <br>
                    <button class="delete-button" style="width: 100%; padding: 15px; background-color: #8a2be2; color: #fff; border: none; border-radius: 8px; cursor: pointer; font-weight: bold; margin-top: 20px;" onclick="confirmDelete()">Sterge cont</button>

                    <script>
                    function confirmDelete() {
                        var confirmDelete = confirm("Are you sure you want to delete your account? This action cannot be undone.");

                        if (confirmDelete) {
                            // Redirectează sau trimite o cerere către server pentru a șterge contul
                            window.location.href = 'delete_account.php'; // Poți utiliza un fișier PHP separat pentru ștergerea contului
                        }
                    }
                    </script>



                </div>

        
            </div>

            <!-- Adaugă aici formularul pentru setările contului -->
            <div class="form-box">
                <h3>Modifica setari cont</h3>
                <form action="settings.php" method="post">
                    <!-- Câmpurile formularului (nume, email, parolă, dată naștere, țară) -->

                    <label for="username">Nume:</label>
                    <input type="text" id="username" name="username" value="<?php echo $current_username; ?>" required>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo $current_email; ?>" required>

                    <label for="current_password">Parola curenta:</label>
                    <input type="password" id="current_password" name="current_password" required>

                    <label for="password">Parola noua:</label>
                    <input type="password" id="password" name="password">

                    <label for="country">Tara:</label>
                    <select id="country" name="country" style="width: 100%; padding: 12px; margin-bottom: 16px; border: 1px solid #bdc3c7; border-radius: 8px; background-color: #ffffff; box-sizing: border-box;" required>
                        <?php
                        if (isset($current_country)) {
                            echo "<option value='$current_country' selected>$current_country</option>";
                        } else {
                            echo "<option value='' disabled selected>Select a country</option>";
                        }
                        ?>
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

                    <button type="submit" name="update" style="width: 100%; padding: 15px; background-color: #8a2be2; color: #fff; border: none; border-radius: 8px; cursor: pointer; font-weight: bold; margin-top: 20px;">Modifica setarile contului!</button>
                </form>
            </div>
        </div>
    </div>

    <!-- HEADER -->
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
                            <li><a href="index.php">Acasa</a></li>

                            <li><a href="contact.php">Contacteaza-ne</a></li>
                        </ul>
                    </div>
                    <!-- Nav End -->
                </div>
            </nav>
        </div>
    </header>

</body>
</html>

