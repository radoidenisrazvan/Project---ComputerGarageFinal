<?php
session_start();

include 'db.php';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}

// Verifică dacă primiți date prin metoda POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Preiați datele din sesiune și din cerere
    $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    $productId = $_POST['product_id'];
    $productName = $_POST['product_name'];
    $productPrice = $_POST['product_price'];
    $createdAt = date('Y-m-d H:i:s'); // Data și ora curente

    if ($userId) {
        // Verificați dacă produsul există deja în coșul de cumpărături pentru același utilizator și același produs
        $checkQuery = "SELECT * FROM shopping_cart WHERE user_id = $userId AND product_id = $productId";
        $checkResult = $con->query($checkQuery);

        if ($checkResult) {
            if ($checkResult->num_rows > 0) {
                // Produsul există deja în coș, nu este nevoie de acțiuni suplimentare
                echo 'Product already in cart!';
            } else {
                // Produsul nu există în coș, adăugați-l
                // Obțineți calea imaginii pentru produs
                $imageQuery = "SELECT imagine_cale FROM products WHERE id = $productId";
                $imageResult = $con->query($imageQuery);
        
                if ($imageResult && $imageResult->num_rows > 0) {
                    $imageData = $imageResult->fetch_assoc();
                    $productImage = $imageData['imagine_cale'];
        
                    // Adăugați produsul în coșul de cumpărături
                    $insertQuery = "INSERT INTO shopping_cart (user_id, product_id, product_name, product_price, created_at, imagine)
                                    VALUES ($userId, $productId, '$productName', $productPrice, '$createdAt', '$productImage')";
                    $con->query($insertQuery);
        
                    echo 'Product added to cart successfully!';
                } else {
                    echo 'Error getting product image: ' . $con->error;
                }
            }
        } else {
            echo 'Error executing query: ' . $con->error;
        }
        
    } else {
        echo 'User not logged in!';
    }
} else {
    // Răspuns pentru cererile care nu sunt de tip POST
    http_response_code(405);
    echo 'Method Not Allowed';
}

// Închideți conexiunea la baza de date
if (isset($con) && $con) {
    $con->close();
}
?>
