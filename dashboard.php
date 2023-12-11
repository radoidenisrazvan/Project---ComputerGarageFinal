<?php
session_start();
include 'db.php';

// Procesarea formularului de adăugare a produsului
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validare și procesare date
    $nume = $_POST['nume'];
    $descriere = $_POST['descriere'];
    $pret = $_POST['pret'];
    $stoc = $_POST['stoc'];
    $categorie = $_POST['categorie'];
    $subcategorie = $_POST['subcategorie'];

    // Verifică dacă un fișier a fost încărcat
    if (isset($_FILES['imagine_cale']) && $_FILES['imagine_cale']['error'] === UPLOAD_ERR_OK) {
        // Calea temporară a fișierului încărcat
        $tmpFilePath = $_FILES['imagine_cale']['tmp_name'];

        // Verifică dacă există un director pentru imagini și, dacă nu, creează-l
        $uploadDirectory = 'images/';
        if (!file_exists($uploadDirectory)) {
            mkdir($uploadDirectory, 0777, true);
        }

        // Construiește calea finală pentru a salva imaginea pe server
        $finalFilePath = $uploadDirectory . basename($_FILES['imagine_cale']['name']);

        // Mutați fișierul încărcat în directorul final
        if (move_uploaded_file($tmpFilePath, $finalFilePath)) {
            // Imaginea a fost încărcată cu succes, poți salva calea în baza de date

            // Utilizează instrucțiune pregătită pentru a preveni SQL injection
            $query = "INSERT INTO products (nume, descriere, pret, stoc, categorie, subcategorie, imagine_cale) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $con->prepare($query);
            $stmt->bind_param("ssdisss", $nume, $descriere, $pret, $stoc, $categorie, $subcategorie, $finalFilePath);

            // Execută instrucțiunea pregătită
            if ($stmt->execute()) {
                echo "Produsul a fost adăugat cu succes.";
            } else {
                echo "Eroare la adăugarea produsului în baza de date.";
            }

            // Închide instrucțiunea pregătită
            $stmt->close();
        } else {
            // Eroare la mutarea fișierului încărcat
            echo "A apărut o eroare la încărcarea fișierului.";
        }
    } else {
        // Eroare la încărcarea fișierului
        echo "A apărut o eroare la încărcarea fișierului.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="icon" href="img/core-img/logoComputerGarage.png">


    <link rel="icon" href="img/core-img/logoComputerGarage.png">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="css/core-style.css">
    <link rel="stylesheet" href="style2.css">


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


    <style>
    /* ... alte stiluri ... */

    .dashboard-container {
        display: flex;
        flex-direction: column; /* Setează direcția flexbox la coloană */
        max-width: 600px; /* Setează lățimea maximă */
        margin: auto;
        align-items: center; /* Centrează pe axa orizontală */
        padding-top: 20px; /* Adaugă spațiu între antet și container */
    }
    .product-info-container img {
        width: 30%; /* Asigură ca imaginea să aibă 100% lățime a containerului părinte */
        height: auto; /* Menține proporțiile originale ale imaginii */
        max-height: 1000px; /* Setează înălțimea maximă dorită pentru imagini */
        object-fit: cover; /* Ajustează imaginea pentru a umple complet containerul, păstrând proporțiile */
        border-radius: 8px; /* Adaugă o mică bordură rotunjită la imagine */
    }
    .form-container,
    .product-container {
        width: 100%; /* Ocupă lățimea maximă a containerului principall */
        background-color: #fff;
        padding: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
        margin-bottom: 20px; /* Adaugă spațiu între cele două paragrafe */
    }

    .form-container {
        margin-bottom: 0; /* Elimină spațiul de sub form-container */
    }

    /* Stiluri pentru butonul de ștergere */
    .delete-button {
        background-color: #8a2be2; /* Modificare culoare buton Sterge */
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 10px;
        cursor: pointer;
        margin-top: 10px;
    }

    .delete-button:hover {
        background-color: #6a1e99; /* Culoare de hover pentru butonul Sterge */
    }



    body {
        margin: 0;
        padding: 0;
        font-family: 'Arial', sans-serif;
        background-color: #f9f9f9;
    }

    header {
        background-color: #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);

    }

.dashboard-container {
    display: flex;
    max-width: 1200px;
    margin: auto;
    align-items: stretch; /* Asigură înălțimi egale pentru copiii flexbox */
}
.centered-button {
        background-color: #8a2be2; /* Culoarea mov */
        color: #fff; /* Culoarea textului alb */
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
        transition: background-color 0.3s; /* Efect de tranziție pentru schimbarea culorii de fundal */
    }

    .centered-button:hover {
        background-color: #6a1b9a; /* Culoare mov mai închisă la hover */
    }
.form-container,
.product-container {
    flex: 1;
    background-color: #fff;
    padding: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    overflow: hidden;
}

    .form-container {
        margin-right: 10px;
    }

    .product-list-container {
        overflow-y: auto; /* Adaugă un scrollbar vertical dacă depășește înălțimea maximă */
        max-height: 100px; /* Ajustează înălțimea maximă a containerului pentru a afișa scrollbarul când este necesar */
    }

    .product-list-container p {
        margin-bottom: 10px;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 8px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }



    .product-info {
        margin-bottom: 20px;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
    }

    .product-info p {
        margin: 8px 0;
    }


</style>

<script>
    // Așteaptă ca documentul să se încarce complet
    document.addEventListener("DOMContentLoaded", function () {
        // Obține înălțimea form-container
        var formContainerHeight = document.querySelector('.form-container').clientHeight;

        // Setează max-height pentru product-list-container la aceeași valoare ca înălțimea form-container
        document.querySelector('.product-list-container').style.maxHeight = formContainerHeight + 'px';
    });
</script>





<script>
        // Functie apelata cand se schimba valoarea din dropdown-ul Categorie
        function updateSubcategories() {
            var categoryDropdown = document.getElementById('categorie');
            var subcategoryDropdown = document.getElementById('subcategorie');

            // Stergem toate optiunile existente din dropdown-ul Subcategorie
            subcategoryDropdown.innerHTML = '';

            // Verificam valoarea aleasa in dropdown-ul Categorie
            if (categoryDropdown.value === 'PC Gaming & Laptop') {
                // Daca este selectata categorie Women, adaugam optiunile corespunzatoare
                addOption(subcategoryDropdown, 'Sisteme Gaming', 'sistemgaming');
                addOption(subcategoryDropdown, 'Laptop', 'laptop');
            } else if (categoryDropdown.value === 'Console') {
                // Daca este selectata categorie Men, adaugam optiunile corespunzatoare
                addOption(subcategoryDropdown, 'Playstation', 'playstation');
                addOption(subcategoryDropdown, 'Xbox', 'xbox');
            } else if (categoryDropdown.value === 'Scaune') {
                // Daca este selectata categorie Men, adaugam optiunile corespunzatoare
                addOption(subcategoryDropdown, 'Scaun birou', 'scaunBirou');
                addOption(subcategoryDropdown, 'Scaun gaming', 'scaunGaming');
            } else if (categoryDropdown.value === 'Monitoare & Periferice PC') {
                // Daca este selectata categorie Men, adaugam optiunile corespunzatoare
                addOption(subcategoryDropdown, 'Monitoare Gaming', 'monitor');
                addOption(subcategoryDropdown, 'Kit gaming', 'kit');
                addOption(subcategoryDropdown, 'Mouse', 'mouse');
                addOption(subcategoryDropdown, 'Tastatura', 'tastatura');
                addOption(subcategoryDropdown, 'Mouse Pad', 'mousePad');
                addOption(subcategoryDropdown, 'Casti', 'casti');
            } else if (categoryDropdown.value === 'Componente PC') {
                // Daca este selectata categorie Men, adaugam optiunile corespunzatoare
                addOption(subcategoryDropdown, 'Procesoare', 'procesor');
                addOption(subcategoryDropdown, 'Placi video', 'placaVideo');
                addOption(subcategoryDropdown, 'Placi de baza', 'placaBaza');
                addOption(subcategoryDropdown, 'Memorie', 'memorie');
                addOption(subcategoryDropdown, 'Carcase', 'carcasa');
                addOption(subcategoryDropdown, 'Router', 'router');
            }
            
        }

        // Functie pentru adaugarea unei optiuni intr-un dropdown
        function addOption(dropdown, text, value) {
            var option = document.createElement('option');
            option.text = text;
            option.value = value;
            dropdown.add(option);
        }
    </script>




</head>
<body>


<header class="header_area">
    <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">
        <!-- Classy Menu -->
        <nav class="classy-navbar" id="essenceNav">
            <!-- Logo -->
            <a class="nav-brand" href="index.php"><img src="img/core-img/logoComputerGarage.png"width="200px"></a>
        </nav>
    </div>
</header>

<!-- Container principal -->
<div class="dashboard-container">

<!-- Add Product Form -->
<div class="form-container">
    <div class="add-product-container">
        <h2>Adauga produs</h2>
        <form method="post" action="" enctype="multipart/form-data">
            <label for="nume">Nume produs:</label>
            <input type="text" name="nume" required>
            <br>
            <label for="descriere">Descriere:</label>
            <textarea name="descriere" required></textarea>
            <br>
            <label for="pret">Pret:</label>
            <input type="text" name="pret" required>
            <br>
            <label for="stoc">Stoc:</label>
            <input type="text" name="stoc" required>
            <br>
            <label for="categorie">Categorie:</label>
            <select name="categorie" id="categorie" onchange="updateSubcategories()" required>
                <option value="" disabled selected>Selecteaza Categorie</option>
                <option value="PC Gaming & Laptop">PC Gaming & Laptop</option>
                <option value="Console">Console</option>
                <option value="Scaune">Scaune</option>
                <option value="Monitoare & Periferice PC">Monitoare & Periferice PC</option>
                <option value="Componente PC">Componente PC</option>
                
            </select>
            <br>
            <label for="subcategorie">Subcategorie:</label>
            <select name="subcategorie" id="subcategorie" required>
                <!-- Options for Subcategory will be updated based on the chosen Category -->
            </select>
            <br>
            <label for="imagine_cale">Imagine produs:</label>
            <input type="file" name="imagine_cale" required>
            <br>
            <div class="centered-button-container">
                <input type="submit" class="centered-button" value="Submit">
            </div>

        </form>
    </div>
</div>


<!-- Afișarea produselor existente -->
<div class="product-container">
    <div class="product-list-container">
        <h2>Lista produselor</h2>
        <?php
        $query = "SELECT * FROM products";
        $result = $con->query($query);

        while ($row = $result->fetch_assoc()) {
            echo "<div class='product-info-container'>";
            echo "<img src='{$row['imagine_cale']}' alt='{$row['nume']}' />";
            echo "<div class='product-info'>";
            echo "<h7><strong>Nume produs:</strong> {$row['nume']}</h7> <br>";
            echo "<h7><strong>Pret:</strong> {$row['pret']} RON </h7> <br>";
            echo "<h7><strong>Stoc:</strong> {$row['stoc']}</h7> <br>";
            echo "<h7><strong>Categorie:</strong> {$row['categorie']}</h7> <br>";
            echo "<h7><strong>Subcategorie:</strong> {$row['subcategorie']}</h7> <br>";
            echo "</div>"; // Închide product-info
            echo "<button class='delete-button' onclick=\"deleteProduct({$row['id']})\">Sterge</button>";
            echo "</div>"; // Închide product-info-container
        }
        ?>
    </div>
</div>





    <script>
    function deleteProduct(productId) {
        // Aici poți adăuga codul JavaScript sau să faci o cerere către server pentru ștergerea produsului din baza de date
        // Poți utiliza AJAX sau Fetch API pentru aceasta
        // De exemplu, folosind AJAX cu jQuery:
        $.ajax({
            type: "POST",
            url: "delete_product.php", // Aici specifici calea către scriptul care va trata ștergerea
            data: { id: productId },
            success: function (response) {
                // Poți face ceva după ștergere, cum ar fi reîncărcarea listei de produse
                alert("Product deleted successfully");
                location.reload();
            },
            error: function (error) {
                alert("Error deleting product");
            }
        });
    }
</script>

</div>

</body>
</html>

