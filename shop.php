<?php
session_start();
include 'db.php';

// Verifică dacă utilizatorul este autentificat
if (isset($_SESSION['user_id'])) {
    // Accesează user ID-ul
    $user_id = $_SESSION['user_id'];
    
}


// Verificați dacă s-a făcut clic pe o subcategorie și obțineți produsele corespunzătoare
if (isset($_POST['subcategory'])) {
    $subcategory = $_POST['subcategory'];
    $products = getProductsBySubcategory($con, $subcategory);
    echo json_encode($products);
    exit;
}

// Definiți funcția pentru a obține produsele în funcție de subcategorie
function getProductsBySubcategory($con, $subcategory) {
    $query = "SELECT * FROM products WHERE subcategorie = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $subcategory);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}
//verifica daca este logat in momentul in care ajunge pe pagina magazinului, iar daca acesta nu este logat il redirectioneaza catre pagina de login/register
//doar asa poate vedea utilizatorul produsele.

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
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
    <title>Magazin COMPUTECH</title>

    <!-- Favicon  -->
    <link rel="icon" href="img/core-img/logoComputerGarage.png">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="css/core-style.css">
    <link rel="stylesheet" href="stylePagini.css">

    <style>
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
                <a class="nav-brand" href="<?php echo isset($_SESSION['user_id']) && isset($_SESSION['authenticated']) ? 'index_autentificat.php' : 'index.php'; ?>"><img src="img/core-img/logoComputerGarage.png" width="200px"></a>
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

                                <div class="single-mega cn-col-4">
                                    <img src="img/bg-img/img1.jpg" alt="">
                                </div>
                            </div>
                        </li>

                            <li><a href="#">Pagini</a>
                                <ul class="dropdown">
                                    <li><a href="<?php echo isset($_SESSION['user_id']) && isset($_SESSION['authenticated']) ? 'index_autentificat.php' : 'index.php'; ?>">Acasa</a></li>
                                    <li><a href="shop.php">Magazin</a></li>
                                    <li><a href="contact.php">Contacteaza-ne</a></li>
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





<!-- ##### Breadcumb Area Start ##### -->
<div class="breadcumb_area bg-img" style="background-image: url(img/bg-img/img1.jpg);">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <!-- Adăugați un ID pentru elementul titlului -->
                <div id="categoryTitle" class="page-title text-center">
                    <!-- H2 este folosit pentru a afișa numele categoriei curente -->
                    <h2 id="dynamicCategoryTitle" style="font-size: 36px; text-transform: uppercase; color: #333; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5); position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); margin: 0; letter-spacing: 2px;"></h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Breadcumb Area End ##### -->




<!-- Adăugați un element script pentru codul JavaScript -->
<script>
    // Așteaptă ca documentul să fie complet încărcat
    document.addEventListener("DOMContentLoaded", function () {
        // Obțineți elementele de meniu și titlu
        var menuContent = document.getElementById("menu-content2");
        var categoryTitle = document.getElementById("dynamicCategoryTitle");

        // Variabile pentru a stoca categoria curentă și subcategoria curentă
        var currentCategory = "Products"; // Setați categoria implicită
        var currentSubcategory = ""; // Inițializare subcategorie curentă

        // Adăugați un ascultător de evenimente pentru clic pe orice element de ancorare din meniu
        menuContent.addEventListener("click", function (event) {
            // Verificați dacă clicul a fost pe un element de ancorare
            if (event.target.tagName === "A") {
                // Dacă este o subcategorie, actualizați subcategoria curentă
                if (event.target.closest(".sub-menu")) {
                    currentSubcategory = event.target.innerText;
                } else {
                    // Dacă este o categorie principală, actualizați categoria curentă și resetați subcategoria
                    currentCategory = event.target.innerText;
                    currentSubcategory = "";
                }

                // Apelați funcția pentru a actualiza titlul
                updateCategoryTitle();
            }
        });



        // Adăugați un ascultător de evenimente pentru clic pe subcategorii
        menuContent.addEventListener("click", function (event) {
            // Verificați dacă clicul a fost pe un element de ancorare în submeniu
            if (event.target.tagName === "A" && event.target.closest(".sub-menu")) {
                // Actualizați subcategoria curentă la textul elementului de ancorare pe care s-a făcut clic
                currentSubcategory = event.target.innerText;
                // Apelați funcția pentru a actualiza titlul
                updateCategoryTitle();
            }
        });

        // Funcție pentru actualizarea titlului categoriei
        function updateCategoryTitle() {
            // Setează textul pentru categoria curentă și subcategoria curentă (dacă există)
            categoryTitle.innerText = currentSubcategory !== "" ? currentSubcategory : currentCategory;
        }

        // Inițializați titlul categoriei
        updateCategoryTitle();
    });
</script>

    <!-- ##### Shop Grid Area Start ##### -->
    <section class="shop_grid_area section-padding-80">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-3">

                <div class="shop_sidebar_area">
                    <!-- ##### Single Widget ##### -->
                    <div class="widget catagory mb-50">
                        <h6 class="widget-title mb-30">Categorii</h6>
                        <div class="catagories-menu">
                            <!-- Meniu pentru categorii principale -->
                            <ul id="menu-content1" class="menu-content collapse show">
                                <li>
                                    <a href="#" data-toggle="collapse" data-target="#pcCategory">PC Gaming & Laptop</a>
                                    <ul class="sub-menu collapse" id="pcCategory">
                                    <li><a href="?subcategory=all_sislaptop">Toate</a></li>
                                    <li><a href="shop.php?subcategory=sistemgaming">Sisteme Gaming</a></li>
                                    <li><a href="shop.php?subcategory=laptop">Laptop</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#" data-toggle="collapse" data-target="#consoleCategory">Console</a>
                                    <ul class="sub-menu collapse" id="consoleCategory">
                                    <li><a href="?subcategory=all_console">Toate</a></li>
                                    <li><a href="shop.php?subcategory=playstation">PlayStation</a></li>
                                    <li><a href="shop.php?subcategory=xbox">Xbox</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#" data-toggle="collapse" data-target="#scauneCategory">Scaune</a>
                                    <ul class="sub-menu collapse" id="scauneCategory">
                                    <li><a href="?subcategory=all_scaune">Toate</a></li>
                                    <li><a href="shop.php?subcategory=scaunBirou">Scaun birou</a></li>
                                    <li><a href="shop.php?subcategory=scaunGaming">Scaun gaming</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#" data-toggle="collapse" data-target="#monitoarePerifericeCategory">Monitoare & Periferice PC</a>
                                    <ul class="sub-menu collapse" id="monitoarePerifericeCategory">
                                    <li><a href="?subcategory=all_monper">Toate</a></li>
                                    <li><a href="shop.php?subcategory=monitor">Monitoare Gaming</a></li>
                                    <li><a href="shop.php?subcategory=kit">Kit gaming</a></li>
                                    <li><a href="shop.php?subcategory=mouse">Mouse</a></li>
                                    <li><a href="shop.php?subcategory=tastatura">Tastatura</a></li>
                                    <li><a href="shop.php?subcategory=mousePad">Mouse Pad</a></li>
                                    <li><a href="shop.php?subcategory=casti">Casti</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#" data-toggle="collapse" data-target="#componenteCategory">Componente PC</a>
                                    <ul class="sub-menu collapse" id="componenteCategory">
                                    <li><a href="?subcategory=all_componente">Toate</a></li>
                                    <li><a href="shop.php?subcategory=procesor">Procesoare</a></li>
                                    <li><a href="shop.php?subcategory=placaVideo">Placi video</a></li>
                                    <li><a href="shop.php?subcategory=placaBaza">Placi de baza</a></li>
                                    <li><a href="shop.php?subcategory=memorie">Memorie</a></li>
                                    <li><a href="shop.php?subcategory=carcasa">Carcase</a></li>
                                    <li><a href="shop.php?subcategory=router">Router</a></li>
                                </li>


                            </ul>
                        </div>
                    </div>
                     <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
                     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.hoverintent/1.10.2/jquery.hoverIntent.min.js"></script>
                        <!-- ##### Single Widget ##### -->    
                    </div>
                </div>
                <div class="col-12 col-md-8 col-lg-9">
                <div class="shop_grid_product_area">
                        <div class="row">
                            <div class="col-12">
                                <div class="product-topbar d-flex align-items-center justify-content-between">
                                    <!-- Total Products -->
                                    <div class="total-products">
                                        <?php
                                        // Citește subcategoria din URL
                                        $subcategorie = isset($_GET['subcategory']) ? $_GET['subcategory'] : '';

                                        // Escapare și pregătirea subcategoriei pentru a evita SQL injection
                                        $subcategorie = mysqli_real_escape_string($con, $subcategorie);

                                        // Construiește interogarea SQL
                                        $count_query = '';

                                        if (strcasecmp($subcategorie, 'all_sislaptop') === 0) {
                                            $count_query = "SELECT COUNT(*) AS total FROM products WHERE categorie = 'PC Gaming & Laptop'";
                                        } elseif (strcasecmp($subcategorie, 'all_console') === 0) {
                                            $count_query = "SELECT COUNT(*) AS total FROM products WHERE categorie = 'Console'";
                                        } elseif (strcasecmp($subcategorie, 'all_scaune') === 0) {
                                            $count_query = "SELECT COUNT(*) AS total FROM products WHERE categorie = 'Scaune'";
                                        } elseif (strcasecmp($subcategorie, 'all_monper') === 0) {
                                            $count_query = "SELECT COUNT(*) AS total FROM products WHERE categorie = 'Monitoare & Periferice PC'";
                                        } elseif (strcasecmp($subcategorie, 'all_componente') === 0) {
                                            $count_query = "SELECT COUNT(*) AS total FROM products WHERE categorie = 'Componente PC'";
                                        } elseif (!empty($subcategorie)) {
                                            $count_query = "SELECT COUNT(*) AS total FROM products WHERE subcategorie = '$subcategorie'";
                                        } else {
                                            $count_query = "SELECT COUNT(*) AS total FROM products";
                                        }

                                        // Rulează interogarea SQL pentru a obține numărul total de produse
                                        $count_result = $con->query($count_query);
                                        $row = $count_result->fetch_assoc();
                                        $total_products = $row['total'];

                                        echo "<p><span>$total_products</span> products found</p>";
                                        ?>
                                    </div>

                                    <!-- Sorting -->
<!-- Sorting -->
<div class="product-sorting d-flex">
    <p>Sort by:</p>
    <form action="#" method="get" id="sortingForm">
        <!-- Adăugați input pentru subcategorie -->
        <input type="hidden" name="subcategory" value="<?php echo $subcategorie; ?>">

        <?php
        // Asigurați-vă că $sort și $subcategorie sunt definite
        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'default';
        ?>
        
        <select name="sort" id="sortByselect" onchange="updateSortingOption()">
            <option value="highest_rated" <?php echo ($sort === 'highest_rated') ? 'selected' : ''; ?>>Highest Rated</option>
            <option value="price_asc" <?php echo ($sort === 'price_asc') ? 'selected' : ''; ?>>Price: Low to High</option>
            <option value="price_desc" <?php echo ($sort === 'price_desc') ? 'selected' : ''; ?>>Price: High to Low</option>
        </select>
    </form>
</div>

<script>
    // Funcția pentru actualizarea opțiunii selectate în formular
    // Funcția pentru actualizarea opțiunii selectate în formular
// Funcția pentru actualizarea opțiunii selectate în formular
function updateSortingOption() {
    var sortingSelect = document.getElementById("sortByselect");
    var selectedOption = sortingSelect.options[sortingSelect.selectedIndex].value;

    // Actualizare vizuală a opțiunii selectate
    for (var i = 0; i < sortingSelect.options.length; i++) {
        sortingSelect.options[i].removeAttribute('selected');
    }
    sortingSelect.querySelector('option[value="' + selectedOption + '"]').setAttribute('selected', 'selected');

    // Actualizați input-ul ascuns pentru subcategorie
    var subcategorieInput = document.querySelector('input[name="subcategory"]');
    subcategorieInput.value = "<?php echo $subcategorie; ?>";

    // Trimiteți formularul
    document.getElementById("sortingForm").submit();
}


</script>

        </div>
    </div>
</div>

    

<!-- Adăugați un container pentru produse -->
<div class="row" id="products-container">

<?php
$produse_pe_pagina = 9;
$pagina_curenta = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$subcategorie = isset($_GET['subcategory']) ? mysqli_real_escape_string($con, $_GET['subcategory']) : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'default';

$order_by_clause = 'ORDER BY pret DESC';

switch ($sort) {
    case 'highest_rated':
        // Adăugați sortarea după rating când implementați ratingul
        break;
    case 'price_asc':
        $order_by_clause = 'ORDER BY pret ASC'; // Sortare după preț crescător
        break;
    case 'price_desc':
        $order_by_clause = 'ORDER BY pret DESC'; // Sortare după preț descrescător
        break;
    default:
        // Sortare implicită
        $order_by_clause = 'ORDER BY pret DESC'; // Sortare după preț descrescător
        break;
}

// Calcularea offset-ului pentru interogare
$offset = ($pagina_curenta - 1) * $produse_pe_pagina;

$sql = '';

if (strcasecmp($subcategorie, 'all_sislaptop') === 0) {
    $sql = "SELECT * FROM products WHERE categorie = 'PC Gaming & Laptop' $order_by_clause LIMIT $offset, $produse_pe_pagina";
} elseif (strcasecmp($subcategorie, 'all_console') === 0) {
    $sql = "SELECT * FROM products WHERE categorie = 'Console' $order_by_clause LIMIT $offset, $produse_pe_pagina";
} elseif (strcasecmp($subcategorie, 'all_scaune') === 0) {
    $sql = "SELECT * FROM products WHERE categorie = 'Scaune' $order_by_clause LIMIT $offset, $produse_pe_pagina";
} elseif (strcasecmp($subcategorie, 'all_monper') === 0) {
    $sql = "SELECT * FROM products WHERE categorie = 'Monitoare & Periferice PC' $order_by_clause LIMIT $offset, $produse_pe_pagina";
} elseif (strcasecmp($subcategorie, 'all_componente') === 0) {
    $sql = "SELECT * FROM products WHERE categorie = 'Componente PC' $order_by_clause LIMIT $offset, $produse_pe_pagina";
} elseif (!empty($subcategorie)) {
    $sql = "SELECT * FROM products WHERE subcategorie = '$subcategorie' $order_by_clause LIMIT $offset, $produse_pe_pagina";
} else {
    $sql = "SELECT * FROM products $order_by_clause LIMIT $offset, $produse_pe_pagina";
}

$result = $con->query($sql);


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Afiseaza produsele
        ?>
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="single-product-wrapper">
                <!-- Adăugați un link către pagina de detalii a produsului -->
                <a href="single-product-details.php?id=<?php echo $row['id']; ?>">
                    <div class="product-img">
                        <img src="<?php echo $row['imagine_cale']; ?>" width="200px">
                        <!-- Alte elemente HTML aici, cum ar fi imaginea pentru hover, badge-uri, etc. -->
                    </div>
                </a>

                <div class="product-description">
                    <h6><?php echo $row['nume']; ?></h6>
                    <p class="product-price"><?php echo $row['pret']; ?> RON</p>

                    <div class="hover-content">
                    <div class="add-to-cart-btn">
                    <button onclick=addToCart(this)
                                    data-product-id="<?php echo $row['id']; ?>"
                                    data-product-name="<?php echo $row['nume']; ?>"
                                    data-product-price="<?php echo $row['pret']; ?>"
                                    data-product-image="<?php echo $row['imagine_cale']; ?>"
                                    data-product-stock="<?php echo $row['stoc']; ?>">>
                                    Adauga in cos
                            </button>


                    </div>


                    </div>
                </div>
            </div>
        </div>
        <?php
    }
} else {
    echo "Nu există produse în baza de date pentru categoria selectată.";
}

// to do
// Calcularea numărului total de produse din subcategorie
if (strcasecmp($subcategorie, 'all_women') === 0) {
    $sql_total = "SELECT COUNT(*) as total FROM products WHERE categorie = 'Women'";
} elseif (strcasecmp($subcategorie, 'all_men') === 0) {
    $sql_total = "SELECT COUNT(*) as total FROM products WHERE categorie = 'Men'";
} elseif (!empty($subcategorie)) {
    $sql_total = "SELECT COUNT(*) as total FROM products WHERE subcategorie = '$subcategorie'";
} else {
    $sql_total = "SELECT COUNT(*) as total FROM products WHERE categorie IN ('Women', 'Men')";
}

$result_total = $con->query($sql_total);
$row_total = $result_total->fetch_assoc();
$total_produse_subcategorie = $row_total['total'];

// Calcularea numărului total de pagini
$total_pagini = ceil($total_produse_subcategorie / $produse_pe_pagina);

// Afișarea paginării doar dacă există mai mult de o pagină
if ($total_pagini > 1) {
    // Afișarea codului de paginare
    ?>
    <!-- Pagination -->
    <nav aria-label="navigation">
        <ul class="pagination mt-50 mb-70">
            <li class="page-item <?php echo ($pagina_curenta == 1 ? 'disabled' : ''); ?>">
                <a class="page-link pagina-alba" href="?pagina=<?php echo ($pagina_curenta - 1) . "&subcategory=$subcategorie&sort=$sort"; ?>" aria-label="Previous">
                    <span aria-hidden="true">&lt;</span>
                </a>
            </li>

            <?php
            // Afișarea link-urilor pentru pagini
            for ($i = 1; $i <= $total_pagini; $i++) {
                echo "<li class='page-item " . ($pagina_curenta == $i ? 'active' : 'pagina-alba') . "'><a class='page-link pagina-alba' href='?pagina=$i&subcategory=$subcategorie&sort=$sort'>$i</a></li>";
            }
            ?>

            <li class="page-item <?php echo ($pagina_curenta == $total_pagini ? 'disabled' : ''); ?>">
                <a class="page-link pagina-alba" href="?pagina=<?php echo ($pagina_curenta + 1) . "&subcategory=$subcategorie&sort=$sort"; ?>" aria-label="Next">
                    <span aria-hidden="true">&gt;</span>
                </a>
            </li>
        </ul>
    </nav>
    <?php
}
?>


<script>
    function addToCart(button) {
        var productId = button.getAttribute('data-product-id');
        var productName = button.getAttribute('data-product-name');
        var productPrice = button.getAttribute('data-product-price');
        var productImage = button.getAttribute('data-product-image');
        var productStock = button.getAttribute('data-product-stock');

        // Verifică dacă produsul este în stoc
        if (productStock <= 0) {
            alert('Produsul "' + productName + '" nu este în stoc.');
            return; // Nu continua dacă produsul nu este în stoc
        }

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





                            <style>
                                .page-item.active .page-link {
                                    z-index: 1;
                                    color: black;
                                    background-color: #F5F5F5;
                                    border-color #F5F5F5: 
                                }
                            </style>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Shop Grid Area End ##### -->

    <!-- ##### Footer Area Start ##### -->
    <footer class="footer_area clearfix">
        <div class="container">
            <div class="row">
                <!-- Single Widget Area -->
                <div class="col-12 col-md-6">
                    <div class="single_widget_area d-flex mb-30">
                        <!-- Logo -->
                        <div class="footer-logo mr-50">
                            <!--<a href="#"><img src="img/core-img/logo_negru.png" alt=""></a> -->
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






</body>

</html>