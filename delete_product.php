<?php
session_start();
include 'db.php';

// Verificăm dacă am primit un id valid pentru ștergere
if (isset($_POST['id']) && is_numeric($_POST['id'])) {
    $productId = $_POST['id'];

    // Folosim instrucțiunea pregătită pentru a preveni SQL injection
    $query = "DELETE FROM products WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $productId);

    // Executăm instrucțiunea pregătită
    if ($stmt->execute()) {
        echo "Product deleted successfully.";
    } else {
        echo "Error deleting product.";
    }

    // Închidem instrucțiunea pregătită
    $stmt->close();
} else {
    echo "Invalid product id.";
}

// Închidem conexiunea la baza de date
$con->close();
?>
