<?php
session_start();

include 'db.php';


// Adaugă produs în coș
if (isset($_POST['addtocart'])) {
    $product_id = mysqli_real_escape_string($con, $_POST['addtocart']);

    // Verifică dacă produsul există deja în coș
    if (!isset($_SESSION['cart'][$product_id])) {
        // Adaugă produsul în coș cu o cantitate inițială de 1
        $_SESSION['cart'][$product_id] = 1;
    } else {
        // Dacă produsul există deja în coș, incrementează cantitatea
        $_SESSION['cart'][$product_id]++;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Product Details ES</title>

    <!-- Favicon  -->
    <link rel="icon" href="img/core-img/favicon1.ico">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="css/core-style.css">
    <link rel="stylesheet" href="stylePagini.css">


    <style>
        /* text pret sa fie mov */
        .single_product_details_area .single_product_desc .product-price {
        margin-bottom: 0;
        font-family: "Ubuntu", sans-serif;
        font-size: 24px;
        color: #8a2be2;
        font-weight: 700; }
        /* text pret sa fie mov
    /* produs imagine sa fie mai aproape de text: */
.single_product_details_area {
  position: relative;
  z-index: 100;
  -ms-flex-wrap: wrap;
  flex-wrap: wrap;
}

.single_product_details_area .single_product_thumb {
  -webkit-box-flex: 0;
  -ms-flex: 0 0 50%;
  flex: 0 0 50%;
  max-width: 50%;
  width: 50%;
  position: relative;
  z-index: 1;
  text-align: right; /* Modificare: Ajustare aliniere text la dreapta */
}

.single_product_details_area .single_product_thumb img {
  width: 50%; /* Modificare: Imaginea ocupă 50% din lățime */
  height: auto; /* Modificare: Înălțimea se ajustează automat */
}

.single_product_details_area .single_product_desc {
  -webkit-box-flex: 0;
  -ms-flex: 0 0 50%;
  flex: 0 0 50%;
  max-width: 50%;
  width: 50%;
  position: relative;
  z-index: 1;
  padding: 50px 5%;
}

@media only screen and (max-width: 767px) {
  .single_product_details_area .single_product_thumb,
  .single_product_details_area .single_product_desc {
    -webkit-box-flex: 0;
    -ms-flex: 0 0 100%;
    flex: 0 0 100%;
    max-width: 100%;
    width: 100%;
    text-align: left; /* Modificare: Ajustare aliniere text la stânga la dimensiuni mai mici */
  }
}

 /* incheie produs imagine sa fie mai aproape de text: */

    /* buton culoare mov */

    .add-to-cart-btn {
        text-align: center;
    }

    .add-to-cart-btn button {
        background-color: #8a2be2;
        color: #fff;
        border: none;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        transition-duration: 0.4s;
        cursor: pointer;
        border-radius: 5px;
    }

    .add-to-cart-btn button:hover {
        background-color: #fff;
        color: #8a2be2;
        border: 1px solid #8a2be2;
    }

    /* incheie buton culoare mov */
</style>

</head>

<body>
    <!-- ##### Header Area Start ##### -->
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
                        <li><a href="#">Magazin</a>
                            <div class="megamenu">
                                <ul class="single-mega cn-col-4">
                                    <li class="title">PC Gaming & Laptop</li>
                                    <li><a href="shop.php?subcategory=sistemgaming">Sisteme Gaming</a></li>
                                    <li><a href="shop.php?subcategory=tops_blouses">Laptop</a></li>
                                </ul>
                                <ul class="single-mega cn-col-4">
                                    <li class="title">Componente PC</li>
                                    <li><a href="shop.php?subcategory=t-shirts">Procesoare</a></li>
                                    <li><a href="shop.php?subcategory=hoodies">Placi video</a></li>
                                    <li><a href="shop.php?subcategory=hoodies">Placi de baza</a></li>
                                    <li><a href="shop.php?subcategory=pants">Memorie</a></li>
                                    <li><a href="shop.php?subcategory=pants">Carcase</a></li>
                                    <li><a href="shop.php?subcategory=hoodies">Router</a></li>
                                </ul>
                                <ul class="single-mega cn-col-4">
                                    <li class="title">Console</li>
                                    <li><a href="shop.php?subcategory=t-shirts">PlayStation</a></li>
                                    <li><a href="shop.php?subcategory=hoodies">Xbox</a></li>
                                </ul>
                                <ul class="single-mega cn-col-4">
                                    <li class="title">Scaune</li>
                                    <li><a href="shop.php?subcategory=t-shirts">Scaun birou</a></li>
                                    <li><a href="shop.php?subcategory=hoodies">Scaun gaming</a></li>
                                </ul>
                                <ul class="single-mega cn-col-4">
                                    <li class="title">Monitoare & Periferice PC</li>
                                    <li><a href="shop.php?subcategory=t-shirts">Monitoare Gaming</a></li>
                                    <li><a href="shop.php?subcategory=hoodies">Kit gaming</a></li>
                                    <li><a href="shop.php?subcategory=pants">Mouse</a></li>
                                    <li><a href="shop.php?subcategory=pants">Tastatura</a></li>
                                    <li><a href="shop.php?subcategory=pants">Mouse Pad</a></li>
                                    <li><a href="shop.php?subcategory=pants">Casti</a></li>

                                </ul>
                                <div class="single-mega cn-col-4">
                                    <img src="img/core-img/img1.jpg" alt="">
                                </div>
                            </div>
                        </li>
                            <li><a href="#">Pagini</a>
                                <ul class="dropdown">
                                    <li><a href="index.php">Acasa</a></li>
                                    <li><a href="shop.php">Magazin</a></li>
                                </ul>
                            </li>
                            <li><a href="contact.php">Contacteaza-ne</a></li>
                        </ul>
                    </div>
                    <!-- Nav End -->
                </div>
            </nav>

            <!-- Header Meta Data -->
            <div class="header-meta d-flex clearfix justify-content-end">
               
                <!-- Cart Area -->
                <div class="cart-area">
                    <a href="#" id="essenceCartBtn"><img src="img/core-img/bag.svg" alt=""></a>
                </div>
            </div>

        </div>
    </header>
    <!-- ##### Header Area End ##### -->

<!-- ##### Right Side Cart Area ##### -->
<div class="cart-bg-overlay"></div>

<div class="right-side-cart-area">

    <!-- Cart Button -->
    <div class="cart-button">
        <a href="#" id="rightSideCart"><img src="img/core-img/bag.svg" alt=""></a>
    </div>

    <div class="cart-content d-flex">

        <!-- Cart List Area -->
        <div class="cart-list">
            <?php
            // Înlocuiți acest cod cu interogarea reală pentru a obține produsele din tabela shopping_cart
            if (isset($_SESSION['user_id'])) {
                $userId = $_SESSION['user_id'];
                $query = "SELECT * FROM shopping_cart WHERE user_id = $userId";
            } else {
                // Poți gestiona altfel situația în care nu ești sigur că utilizatorul este autentificat
                // De exemplu, poți redirecționa utilizatorul la pagina de autentificare sau afișa un mesaj
                echo "User not authenticated.";
                exit(); // Ieși din script pentru a evita afișarea coșului pentru un utilizator neautentificat
            }
                        $result = $con->query($query);

            $totalPrice = 0;

            // Afișare produse în coșul de cumpărături și calculul sumei totale
            while ($row = $result->fetch_assoc()) {
                echo '<div class="single-cart-item" id="cart-item-' . $row["id"] . '">';
                echo '<a href="#" class="product-image">';
                // Afișează imaginea produsului
                echo '<img src="' . $row["imagine"] . '" class="cart-thumb" alt="">';
                echo '<div class="cart-item-desc">';
                echo '<span class="product-remove" onclick="removeCartItem(' . $row["id"] . ')"><i class="fa fa-close" aria-hidden="true"></i></span>';
                echo '<h6>' . $row["product_name"] . '</h6>';
                echo '<p class="price">' . $row["product_price"] . ' RON</p>';
                echo '</div></a></div>';
            
                // Adaugă prețul produsului la suma totală
                $totalPrice += $row["product_price"];
            }
            ?>
        </div>

<!-- Cart Summary -->
<div class="cart-amount-summary">
    <h2>Summary</h2>
    <ul class="summary-table">
        <li><span>subtotal:</span> <span><?php echo number_format($totalPrice, 2); ?> RON</span></li>
        <li><span>delivery:</span> <span>Gratuit</span></li>
        <li><span>total:</span> <span><?php echo number_format($totalPrice, 2); ?> RON</span></li>
    </ul>
    <div class="checkout-btn mt-100">
        <a href="checkout.php" class="btn essence-btn">Comanda acum</a>
    </div>
</div>

    </div>
</div>
<!-- ##### Right Side Cart End ##### -->


<script>
function removeCartItem(productId) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                // Răspunsul de la server
                console.log(xhr.responseText);

                // Elimină elementul din DOM
                var cartItem = document.getElementById('cart-item-' + productId);
                cartItem.parentNode.removeChild(cartItem);
            } else {
                console.error('Eroare la comunicarea cu serverul.');
            }
        }
    };

    // Definiți metoda și URL-ul pentru cerere (înlocuiți 'remove_from_cart.php' cu numele real al scriptului PHP)
    xhr.open('POST', 'remove_from_cart.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    // Trimiteți datele către server
    xhr.send('product_id=' + encodeURIComponent(productId));
}
</script>


    <?php
// Verificați dacă a fost furnizat un ID valid în parametrul URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Includeți fișierul de conectare la baza de date
    // Înlocuiți "db_connection.php" cu numele real al fișierului
    require_once('db.php');

    // Evitați injecția SQL folosind prepared statements
    $product_id = mysqli_real_escape_string($con, $_GET['id']);
    $sql = "SELECT * FROM products WHERE id = $product_id";
    $result = $con->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Afișați detaliile produsului
            $product_name = $row['nume'];
            $product_description = $row['descriere'];
            $product_price = $row['pret'];
            $product_stock = $row['stoc'];
            $product_image = $row['imagine_cale'];
        } else {
            // Produsul nu a fost găsit în baza de date
            echo "Produsul nu a fost găsit.";
            exit;
        }
    } else {
        // Eroare la interogare
        echo "Eroare la interogare: " . $con->error;
        exit;
    }
} else {
    // ID invalid sau lipsă în parametrul URL
    echo "ID produs lipsă sau invalid.";
    exit;
}
?>

<!-- ##### Single Product Details Area Start ##### -->
<section class="single_product_details_area d-flex align-items-center">
        <!-- Single Product Thumb -->
        <div class="single_product_thumb clearfix">
        <!-- Verificați dacă variabila $product_image conține o valoare validă -->
        <?php if (!empty($product_image)): ?>
            <img src="<?php echo $product_image; ?>" alt="Product Image" style="max-width: 1920px; max-height: 1080px;">
        <?php else: ?>
            <!-- Imaginea nu este disponibilă -->
            <p>Imagine indisponibilă</p>
        <?php endif; ?>
    </div>

    <!-- Single Product Description -->
    <div class="single_product_desc clearfix">
        <span><?php echo $product_name; ?></span>
        <h2><?php echo $product_name; ?></h2>
        <p class="product-price"><?php echo $product_price; ?> RON</p>
        <p class="product-desc"><?php echo nl2br($product_description); ?></p>

        <?php
        // Afișați dacă produsul este sau nu în stoc
        if ($product_stock > 0) {
            echo "<h7 class='product-stock'>Disponibil in stoc</h7>";
        } else {
            echo "<h7 class='product-stock out-of-stock'></h7>";
        }
        ?>

<!-- Form -->
<form class="cart-form clearfix" method="post">
    <!-- Cart & Favourite Box -->
    <div class="cart-fav-box d-flex align-items-center">
        <?php if ($product_stock > 0) : ?>
            <!-- Cart -->
            <div class="add-to-cart-btn">
                <button onclick="addToCart(this)"
                        data-product-id="<?php echo $row['id']; ?>"
                        data-product-name="<?php echo $row['nume']; ?>"
                        data-product-price="<?php echo $row['pret']; ?>"
                        data-product-image="<?php echo $row['imagine_cale']; ?>">
                        Adauga in cos
                </button>
            </div>
        <?php else : ?>
            <!-- Not in Stock -->
            <p class="product-stock out-of-stock">Not available in stock</p>
        <?php endif; ?>

        <!-- Favourite -->
        
    </div>
</form>

    </div>
</section>



<script>
function addToCart(button) {
    var productId = button.getAttribute('data-product-id');
    var productName = button.getAttribute('data-product-name');
    var productPrice = button.getAttribute('data-product-price');
    var productImage = button.getAttribute('data-product-image');

    // Trimite datele la server utilizând AJAX
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                // Răspunsul de la server
                console.log(xhr.responseText);

                // Actualizează conținutul coșului sau alte elemente pe care dorești să le actualizezi
                // Poți implementa această parte în funcție de cum sunt gestionate datele în coș și în pagină

                // Reîncarcă pagina după adăugarea produsului în coș
                window.location.reload();
            } else {
                console.error('Eroare la comunicarea cu serverul.');
            }
        }
    };

    // Definiți metoda și URL-ul pentru cerere
    xhr.open('POST', 'add_to_cart.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    // Trimite datele către server
    xhr.send('product_id=' + encodeURIComponent(productId) +
             '&product_name=' + encodeURIComponent(productName) +
             '&product_price=' + encodeURIComponent(productPrice) +
             '&product_image=' + encodeURIComponent(productImage));
}


</script>



<!-- ##### Single Product Details Area End ##### -->



    <!-- ##### Footer Area Start ##### -->
    <footer class="footer_area clearfix">
        <div class="container">
            <div class="row">
                <!-- Single Widget Area -->
                <div class="col-12 col-md-6">
                    <div class="single_widget_area d-flex mb-30">
                        <!-- Logo -->
                        <div class="footer-logo mr-50">
                            <!-- <a href="#"><img src="img/core-img/logo2.png" alt=""></a> -->
                        </div>
                        <!-- Footer Menu -->
                        <div class="footer_menu">
                            <ul>
                                <li><a href="shop.php">Magazin</a></li>
                                <li><a href="contact.php">Contacteaza COMPUTECH</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Single Widget Area -->
                <div class="col-12 col-md-6">
                    <div class="single_widget_area mb-30">
                        <ul class="footer_widget_menu">
                            <li><a href="#">Order Status</a></li>
                            <li><a href="#">Payment Options</a></li>
                            <li><a href="#">Shipping and Delivery</a></li>
                            <li><a href="#">Terms of Use</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row align-items-end">
                <!-- Single Widget Area -->
                
                <!-- Single Widget Area -->
                <div class="col-12 col-md-6">
                    <div class="single_widget_area">
                        <div class="footer_social_area">
                            <a href="https://www.facebook.com/" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            <a href="https://www.instagram.com/" data-toggle="tooltip" data-placement="top" title="Instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            <a href="https://twitter.com/home" data-toggle="tooltip" data-placement="top" title="X"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            <a href="https://www.pinterest.com/" data-toggle="tooltip" data-placement="top" title="Pinterest"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                            <a href="https://www.youtube.com/" data-toggle="tooltip" data-placement="top" title="Youtube"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>

<div class="row mt-5">
                <div class="col-md-12 text-center">
                    
                </div>
            </div>

        </div>
    </footer>
    <!-- ##### Footer Area End ##### -->

    <!-- jQuery (Necessary for All JavaScript Plugins) -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Plugins js -->
    <script src="js/plugins.js"></script>
    <!-- Classy Nav js -->
    <script src="js/classy-nav.min.js"></script>
    <!-- Active js -->
    <script src="js/active.js"></script>

</body>

</html>