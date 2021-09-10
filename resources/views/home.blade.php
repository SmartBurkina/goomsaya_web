@extends('inc.template')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if($result = session('result'))
        <div class="alert alert-success">{{ $result }}</div>
    @endif

    <script>initFreighCostView()</script>
    <div class="ftco-blocks-cover-1">

        <div class="ftco-cover-1 overlay" style="background-image: url('images/logo/logo-big.jpg')">
            <div class="container">
                @if(isset($error))
                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                    </div>
                @endif
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <h1>Bienvenu à <br><span class="text-primary">Goomsaya Transport</span></h1>
                        <p class="mb-5">Le fret autrement! <br> Offrez vous un service incomparable nulle part ailleurs!</p>
                        <form action="{{route('suivi')}}" method="post" id="conteneur">
                            @csrf
                            <div class="form-group d-flex">
                                <input name="numeroConteneur" id="numeroConteneur" value="{{isset($numeroConteneur) ? $numeroConteneur : ""}}" type="text" class="form-control" required placeholder="Entrez le numéro du conteneur">
                                <input type="submit" class="btn btn-primary text-white px-4" value="Suivre mon colis">
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-12">
                        <div class="d-flex">
                            <div class="mr-2">
                                <div class="pt-3 pb-3">
                                    <p style="font-size:1.5vw;">Frais d'envoi par bateau</p>
                                    <hr style="height:2px;border-width:0;color:gray;background-color:#2d3748">
                                    <div style="font-size:1.5vw;" class="d-flex">
                                        <a style="font-size:1.5vw;" href="#freighCostFrBf" class="btn text-white btn-dark pt-3 pb-3" onclick="showOrHide('FrBf')"> <span style="font-size:1.5vw;">France vers Burkina Faso</span>
                                        </a>
                                        <a style="font-size:1.5vw;" href="#freighCostCnBf" class="btn text-white btn-dark pt-3 pb-3 ml-4" onclick="showOrHide('CnBf')"> <span style="font-size:1.5vw;">Chine vers Burkina Faso</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="ml-5">
                                <div class="pt-3 pb-3">
                                    <p style="font-size:1.5vw;">Frais d'envoi par avion</p>
                                    <hr style="height:2px;border-width:0;color:gray;background-color:#2d3748">
                                    <div style="font-size:1.5vw;" class="d-flex">
                                        <a style="font-size:1.5vw;" data-toggle="modal" data-target="#modal-left" class="btn text-white btn-dark pt-3 pb-3" ><span style="font-size:1.5vw;">France vers Burkina Faso</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(isset($conteneurData))
                        <div class="container">
                            <article class="card">
                                <header class="card-header"> Suivi de mon colis</header>
                                <div class="card-body">
                                    <h6>Conteneur numéro:  {{$numeroConteneur}}</h6>
                                    <article class="card">
                                        <div class="card-body row">
                                            <div class="col"> <strong>Date d'arrivé estimée: <br>{{($conteneurData['partie_sept']['statut'] == 'terminer') ? 'Conteneur arrivé à destination' : $dateEstime}}</strong></div>
                                            <div class="col"> <strong>Livré par:</strong> <br> Goomsaya | <i class="fa fa-phone"></i> +33754141480 </div>
                                            <div class="col"> <strong>Status:</strong> <br> {{$positionActu}} </div>
                                            <div class="col"> <strong>Numéro conteneur:</strong> <br> {{$numeroConteneur}} </div>
                                        </div>
                                    </article>
                                    <div class="track">
                                        <div class="step active"> <span class="icon"> <i class="fa flaticon-warehouse"></i> </span> <span class="text">Box de Goomsaya</span> </div>
                                        <div class="step {{($conteneurData['partie_deux']['statut'] == 'terminer') ? 'active' : ''}}"> <span class="icon"> <i class="fa flaticon-ferry"></i> </span> <span class="text"> Port (Havre) <br> {{isset($conteneurData['partie_deux']['date']) ? $conteneurData['partie_deux']['date'] : ''}}</span> </div>
                                        <div class="step {{($conteneurData['partie_trois']['statut'] == 'terminer') ? 'active' : ''}}"> <span class="icon"> <i class="fa flaticon-ferry"></i> </span> <span class="text"> Dans le bateau <br> {{isset($conteneurData['partie_trois']['date']) ? $conteneurData['partie_trois']['date'] : ''}}</span> </div>
                                        <div class="step {{($conteneurData['partie_quatre']['statut'] == 'terminer') ? 'active' : ''}}"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Port de Lome <br> {{isset($conteneurData['partie_quatre']['date']) ? $conteneurData['partie_quatre']['date'] : ''}}</span></div>
                                        <div class="step {{($conteneurData['partie_cinq']['statut'] == 'terminer') ? 'active' : ''}}"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">En route pour douane de Ouagadougou <br> {{isset($conteneurData['partie_cinq']['date']) ? $conteneurData['partie_cinq']['date'] : ''}}</span> </div>
                                        <div class="step {{($conteneurData['partie_six']['statut'] == 'terminer') ? 'active' : ''}}"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Douane de Ouagadougou <br> {{isset($conteneurData['partie_six']['date']) ? $conteneurData['partie_six']['date'] : ''}}</span> </div>
                                        <div class="step {{($conteneurData['partie_sept']['statut'] == 'terminer') ? 'active' : ''}}"> <span class="icon"> <i class="flaticon-lorry"></i> </span> <span class="text">Mise à disposition et livraison <br> {{isset($conteneurData['partie_sept']['date']) ? $conteneurData['partie_sept']['date'] : ''}}</span> </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="page-content page-container" id="page-content">
            <div class="padding">
                <div class="row container d-flex justify-content-center">
                    <div class="col-sm-6">
                        <div id="modal-left" class="modal fade" data-backdrop="true">
                            <div class="modal-dialog modal-left w-xl">
                                <div class="modal-content h-100 no-radius">
                                    <div class="modal-header">
                                        <div class="modal-title text-md">Estimation Frais Aérien France vers Burkina Faso</div> <button class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="p-4 text-center">
                                            <p>Entrez le poids total de votre colis</p>

                                            <form class="mt-2">
                                                @csrf
                                                <div class="form-group d-flex">
                                                    <input name="poids" id="poids" type="number" min="0" class="form-control" required placeholder="Poids (Kg)">
                                                </div>
                                            </form>

                                            <div class="btn btn-primary text-white px-4 ml-3 mt-3" onclick="calculateAirFreightCost()">Calculer</div>

                                            <p class="mt-3">Frais de transport hors douane :</p>
                                            <div class="block-heading-1" data-aos="fade-up" data-aos-delay="">
                                                <h2 id="costAir"></h2>
                                            </div>

                                            <p class="pt-3"><strong>NB: les frais de douanes s'élèvent à :</strong><br>* 2.500 F CFA le kilogramme pour les colis sans valeur (effets personnels)<br>
                                                * Entre 15% et 20% pour les autres type de colis , nous contacter pour plus de précisions au <strong>+33 7 54 14 14 80</strong>.</p>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary text-white" data-dismiss="modal">Fermer</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END .ftco-cover-1 -->
        <div class="ftco-service-image-1 pb-5 mt-10">
            <div class="container">
                <div class="owl-carousel owl-all">
                    <div class="service text-center">
                        <a href="#"><img src="images/services/fret_aerien.jpg" alt="Image" class="img-fluid"></a>
                        <div class="px-md-3">
                            <h3><a href="#">Fret Aérien</a></h3>
                            <p>Goomsaya Transport vous donne la possibilité d'envoyer vos colis via le fret aérien, ce qui garantira l'arrivé de vos colis en un temps record, et en toute sécurité!</p>
                        </div>
                    </div>
                    <div class="service text-center">
                        <a href="#"><img src="images/services/cargo-ship.jpeg" alt="Image" class="img-fluid"></a>
                        <div class="px-md-3">
                            <h3><a href="#">Fret Maritime</a></h3>
                            <p>Vous n'êtes pas pressé? et vous voulez économiser dans l'envoie de vos colis, choisissez le fret maritime, qui vous garantira aussi la sécurité de vos colis!</p>
                        </div>
                    </div>
                    <div class="service text-center">
                        <a href="#"><img src="images/services/achats_en_ligne.jpg" alt="Image" class="img-fluid"></a>
                        <div class="px-md-3">
                            <h3><a href="#">Achats en ligne</a></h3>
                            <p>Vous pouvez désormais acheter en ligne sur les boutique comme Amazon, Cdiscount, fnac et bien d'autres, et vous faire livrer à des frais abordables!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="site-section bg-light" id="services-section">
        <div class="container">
            <div class="row mb-5 justify-content-center">
                <div class="col-md-7 text-center">
                    <div class="block-heading-1">
                        <h2>Nos services</h2>
                        <p>Nous vous offrons des services qui vous faciliteront la vie <br> De l'enlèvement de votre colis à l'envoie à la destination de votre choix, nous vous proposons d'autres services intrinsèquement liés!</p>
                    </div>
                </div>
            </div>
            <div class="owl-carousel owl-all">
                <div class="block__35630 text-center">
                    <div class="icon mb-0">
                        <span class="flaticon-ferry"></span>
                    </div>
                    <h3 class="mb-3">Fret Maritime</h3>
                    <p>Pour tous vos colis que vous voulez envoyer par le fret maritime, notement les colis lourd ou volumineux tels que les congel, les canapés, les meubles et autres!</p>
                </div>

                <div class="block__35630 text-center">
                    <div class="icon mb-0">
                        <span class="flaticon-airplane"></span>
                    </div>
                    <h3 class="mb-3">Fret Aérien</h3>
                    <p>Pour tous vos colis légers ou non encombrants tel que les téléphones portables, les tablettes les appareils ou tout autres colis fragile, nous avons pour vous le Fret Aérien! </p>
                </div>

                <div class="block__35630 text-center">
                    <div class="icon mb-0">
                        <span class="flaticon-box"></span>
                    </div>
                    <h3 class="mb-3">Enlèvement de colis</h3>
                    <p>Nous vous laissons le choix de planifier un crénaud de temps auquel nous passeront récupérer vos colis chez vous ou tout autres adresse que vous aurez indiquez!</p>
                </div>

                <div class="block__35630 text-center">
                    <div class="icon mb-0">
                        <span class="flaticon-lorry"></span>
                    </div>
                    <h3 class="mb-3">Vente de futs, cartons et sacs</h3>
                    <p>Pour le transport facile de vos affaires, nous mettons à votre disposition des futs, des sacs et des cartons de plusieurs tailles et couleurs à des prix imbattables!</p>
                </div>

                <div class="block__35630 text-center">
                    <div class="parent-icon-center">
                        <div class="icon-service">
                            <img width="20" src="images/icons/taxi.png" alt="">
                        </div>
                    </div>
                    <h3 class="mb-3 mt-4">Réservation de Taxi</h3>
                    <p>Vous voyagez ou vous souhaitez vous déplacer et vous avez besoin d'un taxi, réservez en un directement via notre application avec la date et l'heure de votre choix!</p>
                </div>

                <div class="block__35630 text-center">
                    <div class="parent-icon-center">
                        <div class="icon-service">
                            <img width="20" src="images/icons/transfert-argent.png" alt="">
                        </div>
                    </div>
                    <h3 class="mb-3 mt-4">Transfert d'argent</h3>
                    <p>Vous souhaitez transférer de l'argent à un proche au burkina Faso, pas de panique Goomsaya Transport vous aide à disponibiliser la somme voulue immédiatement au Burkina Faso!</p>
                </div>

            </div>
        </div>
    </div>

    <div class="site-section" id="about-section">

        <div class="container">
            <div class="row mb-5 justify-content-center">
                <div class="col-md-7 text-center">
                    <div class="block-heading-1" data-aos="fade-up" data-aos-delay="">
                        <h2>A propos de nous</h2>
                        <p>Nous somme une entreprise de fret maritime et aérien. Laissez nous nous occuper des enlèvements et des livraisons de vos colis de la France vers le Burkina Faso, le Niger, la Côte d'Ivoire et bien d'autres pays!</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-6 col-md-6 mb-4 col-lg-0 col-lg-3" data-aos="fade-up" data-aos-delay="">
                        <div class="block-counter-1">
                            <span class="number"><span data-number="10">0</span>+</span>
                            <span class="caption">Années d'expériences</span>
                        </div>
                    </div>
                    <div class="col-6 col-md-6 mb-4 col-lg-0 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                        <div class="block-counter-1">
                            <span class="number"><span data-number="2500">0</span>+</span>
                            <span class="caption">Nombre de clients</span>
                        </div>
                    </div>
                    <div class="col-6 col-md-6 mb-4 col-lg-0 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                        <div class="block-counter-1">
                            <span class="number"><span data-number="3">0</span>+</span>
                            <span class="caption">Pays couverts</span>
                        </div>
                    </div>
                    <div class="col-6 col-md-6 mb-4 col-lg-0 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                        <div class="block-counter-1">
                            <span class="number"><span data-number="8000">0</span>+</span>
                            <span class="caption">Colis enregistrés</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>



    <div class="site-section bg-light" id="about-section">
        <div class="container">
            <!-- <div class="row justify-content-center mb-4 block-img-video-1-wrap">
                <div class="col-md-12 mb-5">
                    <figure class="block-img-video-1" data-aos="fade">
                        <a href="https://www.youtube.com/watch?v=bsa82nYaezY" data-fancybox data-ratio="2">
                            <span class="icon"><span class="icon-play"></span></span>
                            <img src="images/logo/logo-big.png" alt="Image" class="img-fluid">
                        </a>
                    </figure>
                </div>
            </div> -->
        </div>
    </div>

    <!-- <div class="site-section" id="team-section">
        <div class="container">
            <div class="row mb-5 justify-content-center">
                <div class="col-md-7 text-center">
                    <div class="block-heading-1" data-aos="fade-up" data-aos-delay="">
                        <h2>Notre équipe</h2>
                        <p>Goomsaya Transport est composé d'une équipe qualifiée et dynamique toujours là pour vous afin de vous fournir un service impéccable!</p>
                    </div>
                </div>
            </div>

            <div class="owl-carousel owl-all">
                <div class="block-team-member-1 text-center rounded h-100">
                    <figure>
                        <img src="images/person_1.jpg" alt="Image" class="img-fluid rounded-circle">
                    </figure>
                    <h3 class="font-size-20 text-black">Ouedraogo R. Aziz</h3>
                    <span class="d-block font-gray-5 letter-spacing-1 text-uppercase font-size-12 mb-3">PDG de Goomsaya</span>
                    <p class="mb-4"></p>
                    <div class="block-social-1">
                        <span class="icon-facebook btn border-w-2 rounded primary-primary-outline--hover"></span>
                        <span class="icon-twitter btn border-w-2 rounded primary-primary-outline--hover"></span>
                        <span class="icon-instagram btn border-w-2 rounded primary-primary-outline--hover"></span>
                    </div>
                </div>

                <div class="block-team-member-1 text-center rounded h-100">
                    <figure>
                        <img src="images/person_1.jpg" alt="Image" class="img-fluid rounded-circle">
                    </figure>
                    <h3 class="font-size-20 text-black">Ouedraogo R. Aziz</h3>
                    <span class="d-block font-gray-5 letter-spacing-1 text-uppercase font-size-12 mb-3">PDG de Goomsaya</span>
                    <p class="mb-4"></p>
                    <div class="block-social-1">
                        <span class="icon-facebook btn border-w-2 rounded primary-primary-outline--hover"></span>
                        <span class="icon-twitter btn border-w-2 rounded primary-primary-outline--hover"></span>
                        <span class="icon-instagram btn border-w-2 rounded primary-primary-outline--hover"></span>
                    </div>
                </div>

                <div class="block-team-member-1 text-center rounded h-100">
                    <figure>
                        <img src="images/person_1.jpg" alt="Image" class="img-fluid rounded-circle">
                    </figure>
                    <h3 class="font-size-20 text-black">Ouedraogo R. Aziz</h3>
                    <span class="d-block font-gray-5 letter-spacing-1 text-uppercase font-size-12 mb-3">PDG de Goomsaya</span>
                    <p class="mb-4"></p>
                    <div class="block-social-1">
                        <span class="icon-facebook btn border-w-2 rounded primary-primary-outline--hover"></span>
                        <span class="icon-twitter btn border-w-2 rounded primary-primary-outline--hover"></span>
                        <span class="icon-instagram btn border-w-2 rounded primary-primary-outline--hover"></span>
                    </div>
                </div>
            </div>



        </div>
    </div> -->

    <div class="site-section bg-light" id="pricing-section">
        <div class="container">
            <div class="row mb-5 justify-content-center text-center">
                <div class="col-md-7">
                    <div class="block-heading-1" data-aos="fade-up" data-aos-delay="">
                        <h2>Nos tarifs</h2>
                        <p>Goomsaya Transport vous propose ses services à des tarifs compétitifs sur le marchés, voyez par vous même! </p>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-6 mb-4 mb-lg-0 col-lg-4" data-aos="fade-up" data-aos-delay="">
                    <div class="pricing">
                        <h3 class="text-center text-black">Fret Aérien</h3>
                        <div class="price text-center">
                            <span><span>10 €</span> / Kg</span>
                        </div>
                        <div class="text-center mb-4">
                            <strong>(Hors douane)</strong>
                        </div>

                        <ul class="list-unstyled ul-check success mb-1">

                            <li>Ordinateurs, Smartphones ...</li>
                            <li>Coliers, chaînes, Bijoux ...</li>
                            <li class="remove">Bagages personels</li>
                            <li class="remove">Tout ce qui est colis légé, non encombrant</li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-6 mb-4 mb-lg-0 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="pricing-litle">
                        <h3 class="text-center text-black texte-size-10 mt-1">Fret Maritime / Colis Simple</h3>
                        <div class="price text-center mb-4 mt-4">
                            <span><span>Prix variable </span> / Kg</span>
                        </div>
                        <ul class="list-unstyled ul-check success mb-5 mt-1">

                            <li>01Kg - 50Kg : <b> 3 € / Kg</b></li>
                            <li>51Kg - 100Kg : <b>2,5 € / Kg</b> </li>
                            <li>101Kg et plus : <b> 2 € / Kg</b></li>
                            <br>
                            <br>
                            <br>
                        </ul>
                    </div>
                </div>

                <div class="col-md-6 mb-4 mb-lg-0 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="pricing-litle">
                        <h3 class="text-center text-black texte-size-10 mt-1">Fret Maritime / Fut</h3>
                        <div class="price text-center mb-4 mt-4">
                            <span><span>Prix variable </span> / Type de Fut</span>
                        </div>
                        <ul class="list-unstyled ul-check success mb-1 mt-4">

                            <li>Fut Grand Noir 85Kg : <b>150 €</b> </li>
                            <li>Fut Grand Bleu 85Kg : <b>150 €</b> </li>
                            <li>Fut Moyen Bleu 65Kg : <b>120 €</b> </li>
                            <li>Fut Petit Bleu 55Kg : <b>100 €</b> </li>
                            <li>Fut Bébé Bleu 30Kg : <b>70 €</b> </li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-6 mb-4 mb-lg-0 col-lg-4 mt-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="pricing-litle">
                        <h3 class="text-center text-black texte-size-10 mt-1">Fret Maritime / Frigo & Congel</h3>
                        <div class="price text-center mb-4 mt-4">
                            <span><span>Prix variable </span> / Type de Frigo</span>
                        </div>
                        <ul class="list-unstyled ul-check success mb-1 mt-4">

                            <li>Frigo Américain : <b>entre 400 € et 500 €</b></li>
                            <li>Frigo Grand Vide : <b>180 €</b><br> Chargé : <b>250 €</b></li>
                            <li>Frigo Moyen Vide : <b>140 €</b><br> Chargé : <b>200 €</b></li>
                            <li>Frigo Petit Vide : <b>90 €</b><br> Chargé : <b>150 €</b></li>
                            <li>Congel Grand Vide : <b>220 €</b><br> Chargé : <b>350 €</b></li>
                            <li>Congel Moyen Vide : <b>190 €</b><br> Chargé : <b>250 €</b></li>
                            <li>Congel Petit Vide : <b>120 €</b><br> Chargé : <b>200 €</b></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-6 mb-4 mb-lg-0 col-lg-4 mt-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="pricing-litle">
                        <h3 class="text-center text-black texte-size-10 mt-1">Transfert d'argent</h3>
                        <div class="price text-center mb-4 mt-4">
                            <span><span>Frais variables </span> / tranche</span>
                        </div>
                        <ul class="list-unstyled ul-check success mb-1 mt-4">

                            <li>1€ - 100€ :  frais = <b>4 €</b></li>
                            <li>101€ - 200€ :  frais = <b>5 €</b></li>
                            <li>201€ - 300€ :  frais = <b>12 €</b></li>
                            <li>301€ - 400€ :  frais = <b>15 €</b></li>
                            <li>401€ - 500€ :  frais = <b>20 €</b></li>
                            <li>501€ - 1000€ :  frais = <b>26 €</b></li>
                            <li>1001€ - 2000€ :  frais = <b>35 €</b></li>
                            <li>2001€ - 8000€ :  frais = <b>1,5% du montant</b></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-6 mb-4 mb-lg-0 col-lg-4 mt-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="pricing-litle">
                        <h3 class="text-center text-black texte-size-10 mt-1">Divers</h3>
                        <div class="price text-center mb-4 mt-4">
                            <span><span>Prix variable </span> / Type de Colis</span>
                        </div>
                        <ul class="list-unstyled ul-check success mb-1 mt-4">

                            <li>Téléviseur : <b>2,5 € / pouce</b></li>
                            <li>Pour les colis encombrants tels que les meubles non démontés, les vélos, les tables et chaises, les canapés le tarifs est de : <b>3,5 € / Kg</b></li>
                            <li>Sommiers & matelas: <b>75 € / place</b></li>
                        </ul>
                    </div>
                </div>

            </div>

            <div id="freighCostFrBf">
                <div class="block-heading-1" data-aos="fade-up" data-aos-delay="">
                    <h2>Calculez les frais d'envoie par bateau de votre colis <br>De la France vers le Burkina Faso</h2>
                    <p>Veuillez entrer les informations de votre colis (la longeur, la largeur et la hauteur tous en cm) afin que nous puissions calculer les frais d'envoie par bateau de votre colis</p>
                </div>
                <form class="mt-3">
                    @csrf
                    <div class="form-group d-flex">
                        <input name="longeurFr" id="longeurFr" type="number" class="form-control" required placeholder="Longeur (cm)">
                        <input name="largeurFr" id="largeurFr" type="number" class="form-control ml-3" required placeholder="Largeur (cm)">
                        <input name="hauteurFr" id="hauteurFr" type="number" class="form-control ml-3" required placeholder="Hauteur (cm)">
                        <div class="btn btn-primary text-white px-4 ml-3" onclick="calculateFrBf()">Calculer</div>
                    </div>
                </form>
                <p class="pt-3"><strong>NB:</strong> La somme estimée <strong>peut ne pas prendre pas en charge les frais de douanes</strong>. Par exemple, quelqu'un qui veut faire transporter des palettes de vin, se verra demander de payer des frais de douanes, pour connaitre ces frais, veuillez nous appeler directement au <strong>+33 7 54 14 14 80</strong>.</p>
                <p>En revanche, pour quelqu'un qui voyage de la France vers le Burkina Faso, il ne payera pas des frais de douanes sur ses affaires personnels à transporter.</p>
                <div class="block-heading-1" data-aos="fade-up" data-aos-delay="">
                    <h2 id="costFr"></h2>
                </div>
            </div>

            <div id="freighCostCnBf">
                <div class="block-heading-1" data-aos="fade-up" data-aos-delay="">
                    <h2>Calculez les frais d'envoie par bateau de votre colis <br>De la Chine vers le Burkina Faso</h2>
                    <p>Veuillez entrer les informations de votre colis (la longeur, la largeur et la hauteur tous en cm) afin que nous puissions calculer les frais d'envoie par bateau de votre colis</p>
                </div>
                <form class="mt-3">
                    @csrf
                    <div class="form-group d-flex">
                        <input name="longeurCn" id="longeurCn" type="number" class="form-control" required placeholder="Longeur (cm)">
                        <input name="largeurCn" id="largeurCn" type="number" class="form-control ml-3" required placeholder="Largeur (cm)">
                        <input name="hauteurCn" id="hauteurCn" type="number" class="form-control ml-3" required placeholder="Hauteur (cm)">
                        <div class="btn btn-primary text-white px-4 ml-3" onclick="calculateCnBf()">Calculer</div>
                    </div>
                </form>
                <p class="pt-3"><strong>NB:</strong> La somme estimée <strong>peut ne pas prendre pas en charge les frais de douanes</strong>. Par exemple, quelqu'un qui veut faire transporter des palettes de vin, se verra demander de payer des frais de douanes, pour connaitre ces frais, veuillez nous appeler directement au <strong>+33 7 54 14 14 80</strong>.</p>
                <p>En revanche, pour quelqu'un qui voyage de la France vers le Burkina Faso, il ne payera pas des frais de douanes sur ses affaires personnels à transporter.</p>
                <div class="block-heading-1" data-aos="fade-up" data-aos-delay="">
                    <h2 id="costCn"></h2>
                </div>
            </div>

        </div>
    </div>


    <div class="site-section" id="faq-section">
        <div class="container">
            <div class="row mb-5">
                <div class="block-heading-1 col-12 text-center">
                    <h2>FAQ</h2>
                    <p>Les questions fréquemments posées par les clients!</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">

                    <div class="mb-5" data-aos="fade-up" data-aos-delay="100">
                        <h3 class="text-black h4 mb-4"><span class="icon-question_answer text-primary mr-2"></span>Quels sont vos tarifs?</h3>
                        <p class="ml-4">Vous pouvez trouver nos tarifs dans la section <i><a href="#pricing-section">Tarifs</a></i> Plus haut! </p>
                    </div>

                    <div class="mb-5" data-aos="fade-up" data-aos-delay="100">
                        <h3 class="text-black h4 mb-4"><span class="icon-question_answer text-primary mr-2"></span>Quel sont les délais d'acheminements des colis?</h3>
                        <ul class="list-unstyled ul-check success mb-1 mt-4 ml-4">
                            <li>Pour le fret aérien, nous garentissons un délais de <b>14 jours</b> maximum</li>
                            <li>Et pour le fret maritime, nous vous assurons un délais de <b>60 jours</b> maximum</li>
                        </ul>
                    </div>

                </div>
                <div class="col-lg-6">

                    <div class="mb-5" data-aos="fade-up" data-aos-delay="100">
                        <h3 class="text-black h4 mb-4"><span class="icon-question_answer text-primary mr-2"></span>Les tarifs prennent-ils la douane en compte?</h3>
                        <ul class="list-unstyled ul-check success mb-1 mt-4 ml-4">
                            <li>Les tarifs prennent en compte les frais de douanes.</li>
                        </ul>
                    </div>

                    <div class="mb-5" data-aos="fade-up" data-aos-delay="100">
                        <h3 class="text-black h4 mb-4"><span class="icon-question_answer text-primary mr-2"></span>A l'arrivé, Où récupérer le colis?</h3>
                        <p class="ml-4">Une fois votre colis arrivé, l'on vous le notifiera et vous pourrez alors passer le récupérer à
                            <a href="https://www.google.com/maps/place/Smart+burkina+sarl/@12.3924355,-1.5146511,15z/data=!4m5!3m4!1s0x0:0xddb75a283ef98010!8m2!3d12.3924355!4d-1.5146511">cette adresse</a>! </p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="block__73694 site-section border-top" id="why-us-section">
        <div class="container">
            <div class="row d-flex no-gutters align-items-stretch">

                <div class="col-12 col-lg-6 block__73422 order-lg-2" style="background-image: url('images/other/excellence-image.png');" data-aos="fade-left" data-aos-delay="">
                </div>



                <div class="col-lg-5 mr-auto p-lg-5 mt-4 mt-lg-0 order-lg-1" data-aos="fade-right" data-aos-delay="">
                    <h2 class="mb-4 text-black">Pourquoi nous choisir?</h2>
                    <h4 class="text-primary">NOUS TRAVAILLONS RAPIDEMENT ET EFFICACEMENT!</h4>
                    <p>A  Goomsaya Transport, nous nous préoccupons de l'arrivé de vos colis dans de brefs délais, qui vous conviennent toujours! Nous nous occupons de vos colis comme s'ils étaient les notres!</p>

                    <ul class="ul-check primary list-unstyled mt-5">
                        <li>Rapidité</li>
                        <li>Service sécurisé</li>
                        <li>Entrepot sécurisé</li>
                        <li>Fiabilité</li>
                        <li>Moins chère</li>
                    </ul>

                    <p>Choisir <b>Goomsaya Transport</b>,<br> c'est choisir l'excellence!</p>

                </div>

            </div>
        </div>
    </div>


    <div class="site-section bg-light block-13" id="testimonials-section" data-aos="fade">
        <div class="container">

            <div class="text-center mb-5">
                <div class="block-heading-1">
                    <h2>Des Clients Satisfait</h2>
                </div>
            </div>

            <div class="owl-carousel nonloop-block-13">
                <div>
                    <div class="block-testimony-1 text-center">

                        <blockquote class="mb-4">
                            <p>&ldquo;Avec Goomsaya Transport, j'ai plus de soucis avec les colis que je veux envoyer à mes proches au Burkina Faso, Ils reçoivent les colis dans un délais raisonnable!&rdquo;</p>
                        </blockquote>

                        <figure>
                            <img src="images/person_4.jpg" alt="Image" class="img-fluid rounded-circle mx-auto">
                        </figure>
                        <h3 class="font-size-20 text-black">A. T. Fulbert</h3>
                    </div>
                </div>

                <div>
                    <div class="block-testimony-1 text-center">
                        <blockquote class="mb-4">
                            <p>&ldquo;La question ne se pose plus, je choisis Goomsaya Transport car leurs tarifs de transfert sont très souples et abordables, ainsi j'envoie mes colis à mes parents qui sont au Burkina Faso!&rdquo;</p>
                        </blockquote>
                        <figure>
                            <img src="images/person_2.jpg" alt="Image" class="img-fluid rounded-circle mx-auto">
                        </figure>
                        <h3 class="font-size-20 mb-4 text-black">K. Elizabet</h3>

                    </div>
                </div>

                <div>
                    <div class="block-testimony-1 text-center">


                        <blockquote class="mb-4">
                            <p>&ldquo;Le service qui me plait le plus avec Goomsaya Transport est l'enlèvement des colis. Etant une personne très occupée, je n'ai pas le temps de déposer mes colis au Box, donc avoir la possibilité de me les faire récupérer à un crénaud que je défini, c'est tout simplement magnifique!&rdquo;</p>
                        </blockquote>

                        <figure>
                            <img src="images/person_1.jpg" alt="Image" class="img-fluid rounded-circle mx-auto">
                        </figure>
                        <h3 class="font-size-20 text-black">B. Aziz</h3>


                    </div>
                </div>

                <div>
                    <div class="block-testimony-1 text-center">
                        <blockquote class="mb-4">
                            <p>&ldquo;Goomsaya Transport me facilite la tâche dans la recherche de carton ou de fut, lorsque je désire regrouper mes petits colis pour en former un.&rdquo;</p>
                        </blockquote>

                        <figure>
                            <img src="images/person_3.jpg" alt="Image" class="img-fluid rounded-circle mx-auto">
                        </figure>
                        <h3 class="font-size-20 mb-4 text-black">O. Alfred</h3>

                    </div>
                </div>

                <div>
                    <div class="block-testimony-1 text-center">
                        <blockquote class="mb-4">
                            <p>&ldquo;Avec Goomsaya Transport je n'ai plus de difficulté à obtenir un taxi pour mes déplacements, que ce soit pour mes petites courses ou pour aller à l'aéreport par exemple!.&rdquo;</p>
                        </blockquote>

                        <figure>
                            <img src="images/person_3.jpg" alt="Image" class="img-fluid rounded-circle mx-auto">
                        </figure>
                        <h3 class="font-size-20 mb-4 text-black">D. Anne</h3>

                    </div>
                </div>


            </div>

        </div>
    </div>

    <!--
    <div class="site-section py-5" id="blog-section">
        <div class="container">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <div class="block-heading-1" data-aos="fade-right" data-aos-delay="">
                        <h2>Articles</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-5 d-flex blog-entry" data-aos="fade-right" data-aos-delay="">
                        <a href="#" class="blog-thumbnail"><img src="images/cargo_sea_small.jpg" alt="Free website template by Free-Template.co" class="img-fluid"></a>
                        <div class="blog-excerpt">
                            <span class="d-block text-muted">Apr 19, 2019</span>
                            <h2 class="h4  mb-3"><a href="press-single.html">Knowing the Difference Is Key to Effective Logistics</a></h2>

                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts</p>
                            <p><a href="single.html" class="text-primary">Read More</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-5 d-flex blog-entry" data-aos="fade-right" data-aos-delay="">
                        <a href="#" class="blog-thumbnail"><img src="images/cargo_air_small.jpg" alt="Free website template by Free-Template.co" class="img-fluid"></a>
                        <div class="blog-excerpt">
                            <span class="d-block text-muted">Apr 19, 2019</span>
                            <h2 class="h4  mb-3"><a href="press-single.html">Knowing the Difference Is Key to Effective Logistics</a></h2>

                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts</p>
                            <p><a href="single.html" class="text-primary">Read More</a></p>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div> -->

    <div class="site-section bg-light" id="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5" data-aos="fade-up" data-aos-delay="">
                    <div class="block-heading-1">
                        <h2>Nous contacter</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 mb-5" data-aos="fade-up" data-aos-delay="100">
                    <form action="{{ route('envoyer_message') }}" method="post">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-6 mb-4 mb-lg-0">
                                <input id="nom" name="nom" type="text" required class="form-control" placeholder="Nom">
                            </div>
                            <div class="col-md-6">
                                <input id="prenom" name="prenom" required type="text" class="form-control" placeholder="Prénom(s)">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="email" name="email" required type="text" class="form-control" placeholder="Adresse Email">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="numero" name="numero" required type="text" class="form-control" placeholder="Votre numéro de téléphone">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <textarea name="message" id="message" required class="form-control" placeholder="Ecrivez votre message." cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 mr-auto">
                                <input type="submit" class="btn btn-block btn-primary text-white py-3 px-5" value="Envoyer le message">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4 ml-auto" data-aos="fade-up" data-aos-delay="200">
                    <div class="bg-white p-3 p-md-5">
                        <h3 class="text-black mb-4">Contact</h3>
                        <ul class="list-unstyled footer-link">
                            <li class="d-block mb-3">
                                <span class="d-block text-black">Adresse:</span>
                                <span><a
                                        href="https://www.google.com/maps/place/Goomsaya+transport/@48.8511155,2.5018597,17z/data=!3m1!4b1!4m8!1m2!2m1!1sMr.+Aziz+Ouedraogo+France+Goomsaya!3m4!1s0x47e60dc0cd0f408b:0x78b01e3f34633ae9!8m2!3d48.8511155!4d2.5040484?hl=fr">117 Boulevard d'Alsace Lorraine, 93110 Rosny-sous-Bois, France</a></span></li>
                            <li class="d-block mb-3"><span class="d-block text-black">Téléphone:</span><span>+33 7 54 14 14 80</span></li>
                            <li class="d-block mb-3"><span class="d-block text-black">Email:</span><span>goomsaya.transport@gmail.com</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

