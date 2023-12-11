<?php
// Include fișierul de configurare a bazei de date (db.php)

session_start();

include 'db.php';

// Verifică dacă utilizatorul este autentificat
if (isset($_SESSION['user_id'])) {
    $userId = $con->real_escape_string($_SESSION['user_id']);

    // Interogare pentru a obține produsele din coșul de cumpărături ale utilizatorului
    $cartQuery = "SELECT * FROM shopping_cart WHERE user_id = '$userId'";
    $cartResult = $con->query($cartQuery);

    if ($cartResult && $cartResult->num_rows > 0) {
        // Returnează datele sub formă de JSON
        $cartData = $cartResult->fetch_all(MYSQLI_ASSOC);

        // Adaugă calea spre imagine la fiecare element din coș
        foreach ($cartData as &$item) {
            $productId = $item['product_id'];
            $imageQuery = "SELECT imagine FROM products WHERE id = $productId";
            $imageResult = $con->query($imageQuery);

            if ($imageResult && $imageResult->num_rows > 0) {
                $imageData = $imageResult->fetch_assoc();
                $item['imagine'] = $imageData['imagine'];
            }
        }

        echo json_encode($cartData);
    } else {
        // Returnează un array gol dacă coșul de cumpărături este gol
        echo json_encode([]);
    }
} else {
    // Returnează un array gol dacă utilizatorul nu este autentificat
    echo json_encode([]);
}

// Închide conexiunea la baza de date
if (isset($con) && $con) {
    $con->close();
}


?>
