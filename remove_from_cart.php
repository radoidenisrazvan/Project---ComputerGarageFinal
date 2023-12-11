<?php
session_start();
include 'db.php';

if (isset($_SESSION['user_id']) && isset($_POST['product_id'])) {
    $userId = $_SESSION['user_id'];
    $productId = $_POST['product_id'];

    // Executează interogarea pentru ștergerea produsului din coș
    $deleteQuery = "DELETE FROM shopping_cart WHERE user_id = $userId AND id = $productId";
    $deleteResult = $con->query($deleteQuery);

    if ($deleteResult) {
        echo 'Product removed successfully!';
    } else {
        echo 'Error removing product: ' . $con->error;
    }
} else {
    echo 'Invalid request!';
}

// Închide conexiunea la baza de date
if (isset($con) && $con) {
    $con->close();
}
?>
