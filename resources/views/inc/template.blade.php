<!doctype html>
<html lang="en">

<head>
    <title>Goomsaya Transport &mdash; Le fret autrement</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link rel="shortcut icon" href="ftco-32x32.png">

    <link rel="icon" href="images/logo/logo-goomsaya-1.jpg" type="image/icon type">

    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,700|Oswald:400,700" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="css/aos.css">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/tracking.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">

</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

<div id="overlayer"></div>
<div class="loader">
    <div class="spinner-border text-primary" role="status">
        <span class="sr-only">Chargement...</span>
    </div>
</div>

<div class="site-wrap" id="home-section">

    <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close mt-3">
                <span class="icon-close2 js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div>


    <div class="top-bar">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <a href="#" class=""><span class="mr-2  icon-envelope-open-o"></span> <span class="d-none d-md-inline-block">goomsaya.transport@gmail.com</span></a>
                    <span class="mx-md-2 d-inline-block"></span>
                    <a href="#" class=""><span class="mr-2  icon-phone"></span> <span class="d-none d-md-inline-block">+33 7 54 14 14 80</span></a>


                    <div class="float-right">

                        <a href="#" class=""><span class="mr-2  icon-twitter"></span> <span class="d-none d-md-inline-block">Twitter</span></a>
                        <span class="mx-md-2 d-inline-block"></span>
                        <a href="https://web.facebook.com/goomsayatransport" class=""><span class="mr-2  icon-facebook"></span> <span class="d-none d-md-inline-block">Facebook</span></a>

                    </div>

                </div>

            </div>

        </div>
    </div>

    <header class="site-navbar js-sticky-header site-navbar-target" role="banner">

        <div class="container">
            <div class="row align-items-center position-relative">


                <div class="site-logo">
                    <img src="images/logo/logo-goomsaya-1.jpg" alt="" width="80px">
                    <a href="/" class="text-black"><span class="text-primary">Goomsaya </span></a>
                </div>

                <div class="col-12">
                    <nav class="site-navigation text-right ml-auto " role="navigation">

                        <ul class="site-menu main-menu js-clone-nav ml-auto d-none d-lg-block">
                            <li><a href="#home-section" class="nav-link">Accueil</a></li>
                            <li><a href="#services-section" class="nav-link">Nos services</a></li>
                            <li><a href="#pricing-section" class="nav-link">Tarifs</a></li>
                            <li><a href="#why-us-section" class="nav-link">Nos qualités</a></li>
                            <li><a href="#testimonials-section" class="nav-link">Témoignages</a></li>
                            <li><a href="#blog-section" class="nav-link">Boutique</a></li>
                            <li><a href="#contact-section" class="nav-link">Contact</a></li>
                            <li class="has-children">
                                <a href="#about-section" class="nav-link">A propos</a>
                                <ul class="dropdown arrow-top">
                                    <li><a href="{{route('how_it_works')}}" class="nav-link">Comment ça marche</a></li>
                                    <li><a href="#faq-section" class="nav-link">FAQ</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>

                </div>

                <div class="toggle-button d-inline-block d-lg-none"><a href="#" class="site-menu-toggle py-5 js-menu-toggle text-black"><span class="icon-menu h3"></span></a></div>

            </div>
        </div>

    </header>

    @yield('content')

    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-7">
                            <h2 class="footer-heading mb-4">A propos de nous</h2>
                            <p>Nous somme une entreprise de fret maritime et aérien. Laissez nous nous occuper des enlèvements et des livraisons de vos colis de la France vers le Burkina Faso, le Niger, la Côte d'Ivoire et bien d'autres pays!</p>
                        </div>
                        <div class="col-md-5 ml-auto">
                            <h2 class="footer-heading mb-4">Liens rapides</h2>
                            <ul class="list-unstyled">
                                <li><a href="#about-section">A propos de nous</a></li>
                                <li><a href="#testimonials-section">Témoignages</a></li>
                                <li><a href="#">Conditions d'utilisation</a></li>
                                <li><a href="#">Politiques de confidentialités</a></li>
                                <li><a href="#contact-section">Nous contacter</a></li>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="col-md-4 ml-auto">

                    <div class="mb-5">
                        <h2 class="footer-heading mb-4">Souscrire à notre Newsletter</h2>
                        <form action="#" method="post" class="footer-suscribe-form">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control border-secondary text-white bg-transparent" placeholder="Entrez votre email" aria-label="Entrez votre email" aria-describedby="button-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary text-white" type="button" id="button-addon2">Souscrire</button>
                                </div>
                            </div>
                    </div>


                    <h2 class="footer-heading mb-4">Nous suivre</h2>
                    <a href="https://web.facebook.com/goomsayatransport" class="smoothscroll pl-0 pr-3"><span class="icon-facebook"></span></a>
                    <a href="#" class="pl-3 pr-3"><span class="icon-twitter"></span></a>
                    <a href="#" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
                    <a href="#" class="pl-3 pr-3"><span class="icon-linkedin"></span></a>
                    </form>
                </div>
            </div>
            <div class="row pt-5 mt-5 text-center">
                <div class="col-md-12">
                    <div class="border-top pt-5">
                        <p class="copyright">
                            <!-- Link back to Free-Template.co can't be removed. Template is licensed under CC BY 3.0. -->
                            &copy; <script>document.write(new Date().getFullYear());</script> <strong>Goomsaya Transport</strong>. Tous droits réservés. <!--<a href="https://free-template.co/" target="_blank">Free-Template.co</a>-->
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </footer>

</div>

<script src="js/FreightCost.js"></script>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.sticky.js"></script>
<script src="js/jquery.waypoints.min.js"></script>
<script src="js/jquery.animateNumber.min.js"></script>
<script src="js/jquery.fancybox.min.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/aos.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

<script src="js/main.js"></script>


</body>

</html>
