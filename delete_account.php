<?php
session_start();
require('db.php');

// Verifică dacă utilizatorul este autentificat
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    // Șterge datele utilizatorului din baza de date
    $sqlDeleteUser = "DELETE FROM users WHERE id = $userId";
    $resultDeleteUser = mysqli_query($con, $sqlDeleteUser);

    if ($resultDeleteUser) {
        // Șterge sesiunea și redirecționează către pagina de autentificare
        session_destroy();
        header("Location: login.php");
        exit();
    } else {
        echo "Error deleting account: " . mysqli_error($con);
    }
} else {
    echo "User not authenticated.";
}
?>
