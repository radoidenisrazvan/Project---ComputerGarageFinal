<?php
session_start();
include_once 'db.php'; // Asigură-te că ai un fișier cu configurația bazei de date

require('PHPMailer.php');
require('Exception.php');
require('SMTP.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Verifică dacă s-au primit datele prin metoda POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Preia datele din formular
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $country = $_POST['country'];
    $street_address = $_POST['street_address'];
    $postcode = $_POST['postcode'];
    $county = $_POST['county'];
    $city = $_POST['city'];
    $phone_number = $_POST['phone_number'];
    $email_address = $_POST['email_address'];

    // Verifică dacă utilizatorul este autentificat
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php"); // Redirecționează către pagina de autentificare dacă utilizatorul nu este autentificat
        exit();
    }

    // Obține ID-ul utilizatorului autentificat
    $userId = $_SESSION['user_id'];

    // Începe o tranzacție
    $con->begin_transaction();

    try {
            $insertOrderQuery = "INSERT INTO orders (user_id, first_name, last_name, country, street_address, postcode, county, city, phone_number, email_address, total_price, order_status)
            VALUES ('$userId', '$first_name', '$last_name', '$country', '$street_address', '$postcode', '$county', '$city', '$phone_number', '$email_address', 0, 'Placed')";

            if ($con->query($insertOrderQuery) === FALSE) {
            throw new Exception("Error inserting order: " . $con->error);
            }

            // Obține order_id-ul generat pentru comanda curentă
            $orderId = $con->insert_id;


            // Obține order_id-ul generat pentru comanda curentă
            $orderId = $con->insert_id;

        // Obține produsele din coșul de cumpărături ale utilizatorului
        $cartQuery = "SELECT * FROM shopping_cart WHERE user_id = '$userId'";
        $cartResult = $con->query($cartQuery);

        // Actualizează stocul pentru fiecare produs în coș și adaugă în tabela order_items
        while ($cartItem = $cartResult->fetch_assoc()) {
            $productId = $cartItem['product_id'];

            // Actualizează stocul în baza de date
            $updateStockQuery = "UPDATE products SET stoc = stoc - 1 WHERE id = ?";
            $stmt = $con->prepare($updateStockQuery);
            $stmt->bind_param("i", $productId);
            $stmt->execute();

            // Adaugă în tabela order_items
            $insertOrderItemsQuery = "INSERT INTO order_items (order_id, product_id, product_name, product_price)
                                     VALUES ('$orderId', '$productId', '" . $cartItem['product_name'] . "', '" . $cartItem['product_price'] . "')";
            if ($con->query($insertOrderItemsQuery) === FALSE) {
                throw new Exception("Error inserting order items: " . $con->error);
            }
        }

        // Calculează totalul comenzii
        $calculateTotalQuery = "SELECT SUM(product_price) AS total_price FROM order_items WHERE order_id = '$orderId'";
        $totalResult = $con->query($calculateTotalQuery);
        $totalRow = $totalResult->fetch_assoc();
        $totalPrice = $totalRow['total_price'];

        // Actualizează totalul comenzii în tabela orders
        $updateTotalQuery = "UPDATE orders SET total_price = '$totalPrice' WHERE order_id = '$orderId'";
        if ($con->query($updateTotalQuery) === FALSE) {
            throw new Exception("Error updating total price: " . $con->error);
        }

        // Commit tranzacția
        $con->commit();

        // Send email confirmation
        $mail = new PHPMailer(true);
        $mail->CharSet = "UFT-8";

        // Configurări server SMTP
        $mail->SMTPDebug = 0; // Setează la 2 pentru debugging
        $mail->isSMTP();
        $mail->Host = 'smtp-relay.brevo.com'; // Serverul tău SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'star_tun1ng@yahoo.com'; // Username-ul tău SMTP
        $mail->Password = ''; // Parola ta SMTP
        $mail->SMTPSecure = 'tls'; // Activează criptarea TLS, acceptă și 'ssl'
        $mail->Port = 587; // Portul TCP pentru conexiune

        // Destinatari
        $mail->setFrom('star_tun1ng@yahoo.com', 'Computer Garage'); // Adresa și numele expeditorului
        $mail->addAddress($email_address, $first_name); // Adresa destinatarului

        // Conținut
        $mail->isHTML(true);
        $mail->Subject = 'Order Placed Successfully';
        
        // Construiește corpul email-ului
        $mailBody = '<p>Thank you for placing an order. Your order has been received successfully.</p>';
        
        // Get products from the user's shopping cart
        $cartQuery = "SELECT * FROM shopping_cart WHERE user_id = '$userId'";
        $cartResult = $con->query($cartQuery);
        
        // Inițializează variabile pentru lista de produse și totalul comenzii
        $productList = '';
        $totalPrice = 0;
        
        // Iterează prin produsele din coș
        while ($cartItem = $cartResult->fetch_assoc()) {
            $productName = $cartItem['product_name'];
            $productPrice = $cartItem['product_price'];
        
            // Adaugă detalii despre produs în corpul email-ului
            $productList .= '<p>' . $productName . ': ' . $productPrice . ' €' . '</p>';
        
            // Adaugă prețul produsului la total
            $totalPrice += $productPrice;
        }
        
        // Adaugă lista de produse și totalul în corpul email-ului
        $mailBody .= '<p><strong>Product List:</strong></p>' . $productList;
        $mailBody .= '<p><strong>Total Price:</strong> ' . number_format($totalPrice, 2) . ' RON' . '</p>';
        $mailBody .= '<p><strong>Payment Method:</strong> Cash on Delivery (COD)</p>';
        
        $mail->Body = $mailBody;
        
        // Trimite email-ul
        $mail->send();

        // Șterge produsele din coșul de cumpărături după ce comanda a fost plasată
        $deleteCartQuery = "DELETE FROM shopping_cart WHERE user_id = '$userId'";
        $con->query($deleteCartQuery);

        // Redirectează către o pagină de succes sau afișează un mesaj de succes
        header("Location: index_autentificat.php");
        exit();
    } catch (Exception $e) {
        // Anulează tranzacția în caz de eroare
        $con->rollback();
        echo "Error: " . $e->getMessage();
    } finally {
        // Închide conexiunea la baza de date
        $con->close();
    }
} else {
    // Redirectează către o pagină de eroare (de exemplu, în cazul accesului direct la script)
    header("Location: error.php");
    exit();
}
?>