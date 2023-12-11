<?php
session_start();


include 'db.php';

// Verifică dacă utilizatorul nu este autentificat
if (!isset($_SESSION['user_id']) || !isset($_SESSION['authenticated'])) {
    // Dacă nu este autentificat, redirecționează către pagina pentru utilizatori neautentificați
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];


if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
}

$query = "SELECT * FROM users WHERE username = '$username'";
$result = $con->query($query);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $is_admin = $user['is_admin'];
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
    <title>Computer Garage</title>

    <!-- Favicon  -->
    <link rel="icon" href="img/core-img/logoComputerGarage.png">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="css/core-style.css">
    <link rel="stylesheet" href="stylePagini.css">


</head>

<body>
    <!-- ##### Header Area Start ##### -->
    <body>
    <div class="header">
    <div class="container">
        <div class="navbar">
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
                                                <!-- Nav Start -->
                    <div class="classynav">
                        <ul>
                        <li><a href="#">Magazin</a>
                            <div class="megamenu">
                                <ul class="single-mega cn-col-4">
                                    <li class="title">PC Gaming & Laptop</li>
                                    <li><a href="shop.php?subcategory=sistemgaming">Sisteme Gaming</a></li>
                                    <li><a href="shop.php?subcategory=laptop">Laptop</a></li>
                                </ul>
                                <ul class="single-mega cn-col-4">
                                    <li class="title">Componente PC</li>
                                    <li><a href="shop.php?subcategory=procesor">Procesoare</a></li>
                                    <li><a href="shop.php?subcategory=placaVideo">Placi video</a></li>
                                    <li><a href="shop.php?subcategory=placaBaza">Placi de baza</a></li>
                                    <li><a href="shop.php?subcategory=memorie">Memorie</a></li>
                                    <li><a href="shop.php?subcategory=carcasa">Carcase</a></li>
                                    <li><a href="shop.php?subcategory=router">Router</a></li>
                                </ul>
                                <ul class="single-mega cn-col-4">
                                    <li class="title">Console</li>
                                    <li><a href="shop.php?subcategory=playstation">PlayStation</a></li>
                                    <li><a href="shop.php?subcategory=xbox">Xbox</a></li>
                                </ul>
                                <ul class="single-mega cn-col-4">
                                    <li class="title">Scaune</li>
                                    <li><a href="shop.php?subcategory=scaunBirou">Scaun birou</a></li>
                                    <li><a href="shop.php?subcategory=scaunGaming">Scaun gaming</a></li>
                                </ul>
                                <ul class="single-mega cn-col-4">
                                    <li class="title">Monitoare & Periferice PC</li>
                                    <li><a href="shop.php?subcategory=monitor">Monitoare Gaming</a></li>
                                    <li><a href="shop.php?subcategory=kit">Kit gaming</a></li>
                                    <li><a href="shop.php?subcategory=mouse">Mouse</a></li>
                                    <li><a href="shop.php?subcategory=tastatura">Tastatura</a></li>
                                    <li><a href="shop.php?subcategory=mousePad">Mouse Pad</a></li>
                                    <li><a href="shop.php?subcategory=casti">Casti</a></li>

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
                            <?php if (isset($username)): ?>
                                <span style="border-left: 1px solid #ccc; height: 20px; margin: 0 10px;"></span> <!-- Separator vertical -->
                                <li>
                                    <a href="#"><?php echo "Salut, $username!"; ?></a>
                                    <ul class="dropdown">
                                        <li><a href="settings.php">Setari</a></li>
                                        <li><a href="my_orders.php">Comenzile mele</a></li>
                                        <button class="logout-button" style="width: 100%; padding: 15px; background-color: #8a2be2; color: #fff; border: none; border-radius: 8px; cursor: pointer; font-weight: bold; margin-top: 20px;" onclick="location.href='logout.php'">Deconecteaza-te</button>
                                    </ul>
                                </li>
                                <?php if ($is_admin): ?>
                                    <span style="border-left: 1px solid #ccc; height: 20px; margin: 0 10px;"></span> <!-- Separator vertical -->
                                    <li><a href="dashboard.php">Dashboard</a></li>
                                <?php endif; ?>


                            <?php endif; ?>

                        </ul>
                    </div>
                    <!-- Nav End -->
                </div>
                                </div></nav>

            <!-- Header Meta Data -->
            <div class="header-meta d-flex clearfix justify-content-end">
                <!-- Search Area -->
                
               
                <!-- Cart Area -->
                <div class="cart-area">
                    <a href="#" id="essenceCartBtn"><img src="img/core-img/bag.svg" alt=""> </a>
                </div>
            </div>

        </div>
                                </header>
                                </div>
                                </div>
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
        <a href="checkout.php" class="btn essence-btn">Cumpara acum</a>
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

    <!-- ##### Welcome Area Start ##### -->
    <div class="container h-100">
        
        <div class="row h-100 align-items-center">
            <div class="col-2">
                <div class="hero-content">
                <h1>Explorează Computer Garage - COMPUTECH!</h1>
                <h7>Descoperă o gamă variată de componente de înaltă calitate.<br>Avem tot ce îți trebuie pentru a-ți construi sau îmbunătăți sistemul la standarde moderne.</h7>
                    <a href="shop.php" class="btn essence-btn">Exploreaza acum</a>
                </div>
                <img src="img/core-img/home-Wallpaper.png" >

            </div>
        </div>
    </div>

    <!-- ##### Welcome Area End ##### -->


    
    <!-- ##### Top Catagory Area Start ##### -->
    <div class="container h-100">
    <div class="row h-100 align-items-center">
            <div class="col-2">
              <h3 class="title">Produsele noastre</h3>
            </div>
            <div class="small-container">
              <div class="row">
                    <!-- Single Catagory -->
                    <div class="col-12 col-sm-6 col-md-4"> 
                        <div class="catagory-content">
                            <div class="col-6">
                            <a href="shop.php?subcategory=all_sislaptop">
                            <img src="img/bg-img/sistemGaming2.png">
                            <br>
                                    <a href="#" data-toggle="collapse" data-target="#pcCategory">PC Gaming & Laptop</a>
                                    <ul class="sub-menu collapse" id="pcCategory">
                                    <li><a href="shop.php?subcategory=sistemgaming">Sisteme Gaming</a></li>
                                    <li><a href="shop.php?subcategory=laptop">Laptop</a></li>
                                    </ul>
                            </div>
                            </a>
                        </div>
                   </div>
                   <!-- Single Catagory -->
                   <div class="col-12 col-sm-6 col-md-4"> 
                        <div class="catagory-content">
                                <div class="col-6">
                                    <a href="shop.php?subcategory=all_console">
                                    <img src="img/bg-img/ps5Background.png">
                                    <br>
                                        <a href="#" data-toggle="collapse" data-target="#consoleCategory">Console</a>
                                        <ul class="sub-menu collapse" id="consoleCategory">
                                        <li><a href="shop.php?subcategory=playstation">PlayStation</a></li>
                                        <li><a href="shop.php?subcategory=xbox">Xbox</a></li>
                                        </ul>
                                    </a>
                                </div>
                        </div>
                   </div>
                   <!-- Single Catagory -->
                   <div class="col-12 col-sm-6 col-md-4"> 
                        <div class="catagory-content">
                                <div class="col-6">
                                    <a href="shop.php?subcategory=all_scaune">
                                    <img src="img/bg-img/scaunGaming.png">
                                    <br>
                                    </a>
                                    <a href="#" data-toggle="collapse" data-target="#scauneCategory">Scaune</a>
                                    <ul class="sub-menu collapse" id="scauneCategory">
                                    <li><a href="shop.php?subcategory=scaunBirou">Scaun birou</a></li>
                                    <li><a href="shop.php?subcategory=scaunGaming">Scaun gaming</a></li>
                                    </ul>

                                </div>
                        </div>
                   </div>
                   <!-- Single Catagory -->
                   <div class="col-12 col-sm-6 col-md-4"> 
                        <div class="catagory-content">
                                <div class="col-6">
                                    <a href="shop.php?subcategory=monitor">
                                    <img src="img/bg-img/monitor2.png">
                                    <br>
                                    </a>
                                    <a href="#" data-toggle="collapse" data-target="#monitoarePerifericeCategory">Monitoare</a>
                                    <ul class="sub-menu collapse" id="monitoarePerifericeCategory">
                                    <li><a href="shop.php?subcategory=monitor">Monitoare Gaming</a></li>
                                    </ul>
                                </div>
                        </div>
                   </div>
                   <!-- Single Catagory -->
                   <div class="col-12 col-sm-6 col-md-4"> 
                        <div class="catagory-content">
                                <div class="col-6">
                                    <a href="shop.php?subcategory=all_componente">
                                    <img src="img/bg-img/componenteBune.png">
                                    <br>
                                    </a>
                                    <a href="#" data-toggle="collapse" data-target="#componenteCategory">Componente PC</a>
                                    <ul class="sub-menu collapse" id="componenteCategory">
                                    <li><a href="shop.php?subcategory=procesor">Procesoare</a></li>
                                    <li><a href="shop.php?subcategory=placaVideo">Placi video</a></li>
                                    <li><a href="shop.php?subcategory=placaBaza">Placi de baza</a></li>
                                    <li><a href="shop.php?subcategory=memorie">Memorie</a></li>
                                    <li><a href="shop.php?subcategory=carcasa">Carcase</a></li>
                                    <li><a href="shop.php?subcategory=router">Router</a></li>
                                </div>
                        </div>
                   </div>
                   <!-- Single Catagory -->
                   <div class="col-12 col-sm-6 col-md-4"> 
                        <div class="catagory-content">
                                <div class="col-6">
                                    <a href="shop.php?subcategory=all_monper">
                                    <img src="img/bg-img/perifericePC.png">
                                    <br>
                                    </a>
                                    <a href="#" data-toggle="collapse" data-target="#PerifericeCategory">Periferice PC</a>
                                    <ul class="sub-menu collapse" id="PerifericeCategory">
                                    <li><a href="shop.php?subcategory=kit">Kit gaming</a></li>
                                    <li><a href="shop.php?subcategory=mouse">Mouse</a></li>
                                    <li><a href="shop.php?subcategory=tastatura">Tastatura</a></li>
                                    <li><a href="shop.php?subcategory=mousePad">Mouse Pad</a></li>
                                    <li><a href="shop.php?subcategory=casti">Casti</a></li>
                                    </ul>
                                </div>
                        </div>
                   </div>

          </div>     
        </div>
</div>
</div>
</div>
    <!-- ##### Top Catagory Area End ##### -->


<!-- ##### New Arrivals Area Start ##### -->
<section class="new_arrivals_area section-padding-80 clearfix">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading text-center">
                    <h3 class="title">Produse populare</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="popular-products-slides owl-carousel">

                    <?php
                    // Loop pentru a obține produsele din baza de date și a le afișa
                    $sql = "SELECT * FROM products ORDER BY RAND() LIMIT 4"; // Modificați această interogare pentru a se potrivi cu structura dvs. de baza de date

                    $result = $con->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            // Afiseaza produsele
                            ?>
                            <div class="single-product-wrapper">
                                <a href="single-product-details.php?id=<?php echo $row['id']; ?>">
                                <div class="product-img">
                                    <img src="<?php echo $row['imagine_cale']; ?>" alt="">
                                </div>
                                    <div class="product-description">
                                        <h6><?php echo $row['nume']; ?></h6>
                                    </a>
                                    <p class="product-price"><?php echo $row['pret']; ?> RON</p>
                                    
                                    </a>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo "Nu există produse în baza de date.";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### New Arrivals Area End ##### -->


    <!-- ##### Brands Area Start ##### -->
    <div class="brands-area d-flex align-items-center justify-content-between">
        <!-- Brand Logo -->
        <div class="single-brands-logo">
            <img src="img/core-img/nvidia.png" alt="">
        </div>
        <!-- Brand Logo -->
        <div class="single-brands-logo">
            <img src="img/core-img/amd.png" alt="">
        </div>
        <!-- Brand Logo -->
        <div class="single-brands-logo">
            <img src="img/core-img/intel.png" alt="">
        </div>
        <!-- Brand Logo -->
        <div class="single-brands-logo">
            <img src="img/core-img/logitech.png" alt="">
        </div>
        <!-- Brand Logo -->
        <div class="single-brands-logo">
            <img src="img/core-img/samsung.png" alt="">
        </div>
        <!-- Brand Logo -->
        <div class="single-brands-logo">
            <img src="img/core-img/lenovo.png" alt="">
        </div>
    </div>
    <!-- ##### Brands Area End ##### -->

    <!-- ##### Footer Area Start ##### -->
    <footer class="footer_area clearfix">
        <div class="container">
            <div class="row">
                <!-- Single Widget Area -->
                <div class="col-12 col-md-6">
                    <div class="single_widget_area d-flex mb-30">
                        <!-- Logo -->
                        <div class="footer-logo mr-50">
                            <a href="#"><img src="img/core-img/logo_negru.png" alt=""></a>
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
                            <a href="https://twitter.com/home" data-toggle="tooltip" data-placement="top" title="Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
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
                </div>
</body>

</html>