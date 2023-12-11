<?php
session_start();
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
    <title>Contacteaza COMPUTECH</title>

    <!-- Favicon  -->
    <link rel="icon" href="img/core-img/logoComputerGarage.png">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="css/core-style.css">
    <link rel="stylesheet" href="style.css">

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
        </div>
    </header>
    <!-- ##### Header Area End ##### -->

    <style>
       .contact-area {
        justify-content: center;
}


.contact-content {
    margin-right: 20px; /* Spatiu intre text si imagine */
}

.contact-image img {
    max-width: 100%; /* Asigura ca imaginea nu depaseste latimea containerului */
    height: auto; /* Permite imaginii sa se redimensioneze proportional */
} 
    </style>


<div class="contact-area d-flex align-items-center">
    <div class="contact-info">
        <div class="contact-content">
            <h3 class="title">Cum să ne contactați?</h3>
            <p>Pentru a ne contacta, ne puteți găsi la numărul de telefon și la adresa de mai jos!</p>
            
            <div class="contact-address mt-50">
                <p><span>address:</span> Timișoara, FC.Ripensia 27</p>
                <p><span>telephone:</span> +40 773 345 356</p>
                <p><span>email:</span><a href="mailto:star_tun1ng@yahoo.ro">denis.radoi03@e-uvt.ro</a></p>
                <img src="img/bg-img/img3.png" alt="Imagine de contact">
            </div>
        </div>
    </div>
    
    <div class="google-map">
        <div id="googleMap"></div>
    </div>
</div>

    </div>

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
    <!-- Google Maps -->



</body>

</html>