<!DOCTYPE html>
<html lang="en">

<head>
    <title>Päärynä hotellit</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Quicksand">
    <script src="https://kit.fontawesome.com/541d399fb7.js" crossorigin="anonymous"></script>

</head>

<body>
    <button onclick="toTheTop();" id="topbtn" title="Go to top"><i class="fa-solid fa-arrow-up"></i></button>
    <?php

    //Create connection
    include_once("php/db-cred.php");

    $conn = new mysqli(SERVER, USERNAME, PASSWORD, DB);

    $result = mysqli_query($conn, "SELECT * FROM messages ORDER BY id DESC limit 3");
    $messages = mysqli_fetch_all($result, MYSQLI_ASSOC);


    $conn->close();
    ?>
    <!--navbar-->
    <nav class="navbar navbar-expand-sm navbar-dark sticky-top" style="padding: 0,5em;  font-size: 1.4em; position: fixed; width: 100%;" id="nav">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item topimg">
                    <a class="nav-link" aria-current="page" href=""><img class="d-none d-lg-block" src="media/logo2.png" style="width: 450px; height: 50px;" alt="Image not found"></a>
                </li>
            </ul>
        </div>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav" style="text-shadow:1px 1px 2px black, 0 0 25px #b8afae, 0 0 5px;">
                <li class="nav-item mt-2">
                    <a class="nav-link active" aria-current="page" href="#">Etusivu</a>
                </li>
                <li class="nav-item mt-2">
                    <a class="nav-link " href="galleria/gallery.html">Galleria</a>
                </li>
                <li class="nav-item mt-2">
                    <a class="nav-link " href="vieraskirja/vieraskirja.php">Vieraskirja</a>
                </li>
                <li class="nav-item mt-2">
                    <a class="nav-link " href="yhteys/yhteystiedot.html">Yhteystiedot</a>
                </li>
                <a class="nav-link " href="varaus/varaus.html"><input class="form-control form-control-lg" value="Varaa tästä" type="submit" name="submit"></a>
                </li>
            </ul>
        </div>
    </nav>
    <!--img banner-->
    <div class="bgimg container-fluid">

        <div class="banner">
            <div class="col-md-6" style="text-shadow: 1px 1px 2px black, 0 0 25px #b8afae, 0 0 5px;">
                <h1 class="" style="font-style: bold; ">Tervetuloa rentoutumaan</h1>
                <h3 class="mt-4 ">Viihtyisät ja mukavat hotellimme palvelevat teitä 4 paikkakunnalla.
                    Meille tärkeää on viihtyvyys ja haluamme tarjota parasta palvelua ja arjen luksusta,
                    kuitenkin kohtuulliseen hintaan.
                </h3>
            </div>
        </div>
    </div>

    <div id="mainContainer">


        <!-- Huoneiden haku -->
        <div class="p-5 container-fluid container-lg">
            <form id="searchForm" name="searchForm" class=" rounded-2 p-2 pt-md-4 pb-md-4 m-0 row" style=" background-color: #9cda71;" method="get" action="varaus/varaus.html">
                <p class="h3 text-center pt-2 pb-2" style="">Hae majoitusta</p>
                <div class="col-1 d-none d-lg-block" style="">
                </div>
                <div class="col-6 col-md-3 col-lg-2 mb-2 m-md-0" style="min-height: 7.25rem;">
                    <i class=" fa fa-map-marker" style="position:absolute; margin-left: .65em; margin-top: .7em;"></i>
                    <select class="rounded-2" type="text" id="sijainti" name="sijainti" placeholder="Sijainti" style="text-indent: 0.70em;  width:100%; height: 33%;" value="1" required>
                        <option value="1">Helsinki</option>
                        <option value="2">Tampere</option>
                        <option value="3">Oulu</option>
                        <option value="4">Turku</option>
                    </select>
                </div>

                <div class="col-6 col-md-3 col-lg-2 mb-2 m-md-0" style="min-height: 7.25rem;">
                    <i class=" fa fa-user-plus" style="position:absolute; margin-left: .65em; margin-top: .7em;"></i>
                    <input class="rounded-2" type="number" min="1" max="6" id="huoneenKoko" name="huoneenKoko" placeholder="Huoneen koko" style="text-indent: 1.75em;  width:100%; height: 33%;" value="1" required>
                </div>

                <div class="col-6 col-md-3 col-lg-2 mb-2 m-md-0" style="min-height: 7.25rem;">
                    <input class="dateSelector rounded-2" type="date" id="startDate" name="startDate" placeholder="Saapumis päivä" dir="rtl" style="text-indent: 1.75em;  width:100%; height: 33%; direction: rtl; text-align: left;" required>
                </div>

                <div class="col-6 col-md-3 col-lg-2 mb-2 m-md-0" style="min-height: 7.25rem;">
                    <input class="dateSelector rounded-2" type="date" id="endDate" name="endDate" placeholder="Lähtö päivä" dir="rtl" style="text-indent: 1.75em;  width:100%; height: 33%; direction: rtl; text-align: left;" required>
                </div>

                <div class="col-12 col-lg-2 mt-0 mt-md-2 mt-lg-0" style="">
                    <input class="btn btn-outline-primary" type="submit" id="sendSearch" name="sendSearch" value="Hae" style="width: 100%; ">
                </div>

                <div class="col-1 d-none d-lg-block" style="">

                </div>

            </form>
        </div>

        <div class="container-fluid text-white " style="background-color: #314c2e;">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-xl-6 mt-5 mb-5">
                    <div class="pt-5 text-center">
                        <h1 class=" text-center" style="font-style: bold; ">Tervetuloa Päärynähotelliin</h1>
                        <div class="infotext p-5" style="font-size: x-large;">
                            <p class="mt-4">Viihtyisät ja mukavat hotellimme palvelevat teitä 4 paikkakunnalla.
                                Meille tärkeää on viihtyvyys ja haluamme tarjota parasta palvelua ja arjen luksusta,
                                kuitenkin kohtuulliseen hintaan. Huoneemme ovat sisustettu hienostuneesti vaativampaankin makuun. </p>
                            <p class="mt-4">Huoneet ovat varattavissa varauskalenterin kautta 24/7. Olet tervetullut meille nauttimaan olostasi!</p>
                        </div>

                    </div>

                </div>

                <div class="col-md-12 col-lg-12 col-xl-6 mt-5 mb-5  text-center">
                    <img class="img-fluid" src="media/HotelReception.jpg" alt="Image not found" width="600px;" height="400px" ;>
                </div>
            </div>


        </div>

        <!--Hyvä tietää-->
        <div class="container mt-4 p-5" style="text-align: center; text-decoration: none;">
            <p class="h3" style="">Hyvä tietää</p><br>

            <div class="row mt-3 text-center">
                <div class="col-md-4">
                    <img src="media/hotellroom.png" class="img-fluid" alt="Image not found" width="400px" height="400px" style="border-radius: 50%;">
                </div>
                <div class="col-md-8">
                    <div class="row mt-5 text-center">
                        <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mb-4">
                            <span><i class="icon fa-solid fa-clock"></i></span>
                            <span class="icontext">Check-in & Check out</span>
                            <p>Sisäänkirjautuminen klo 15 alkaen. <br> Uloskirjautuminen viimeistään klo 13.</p>
                        </div>
                        <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mb-4">
                            <span><i class="icon fa-solid fa-square-parking"></i></span>
                            <span class="icontext">Pysäköinti</span>
                            <p>Hotellimme tarjoaa maksuttoman <br> ulkopysäköintialueen vierailleen.</p>
                        </div>
                    </div>
                    <div class="row text-center">

                        <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mb-4">
                            <span><i class="icon fa-solid fa-mug-saucer"></i></span>
                            <span class="icontext">Aamiainen</span>
                            <p>Kattaus ma-pe klo 6:30 - 10, <br> viikonloppuisin klo 7 - 11.</p>
                        </div>
                        <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mb-4">
                            <span><i class="icon fa-solid fa-heart"></i></span>
                            <span class="icontext">Sauna ja kuntoilu</span>
                            <p>Tarjoamme asiakkaillemme viihtyisät saunatilat ja ilmaisen kuntosalin.</p>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mb-4">
                            <span><i class="icon fa-solid fa-dog"></i></span>
                            <span class="icontext">Lemmikit</span>
                            <p>Osa huoneistamme on varattu lemmikkien kanssa
                                matkustaville. Lemmikeistä tulee kuitenkin aina ilmoittaa ennakkoon, jotta huoneiden
                                saatavuus voidaan varmistaa.
                            </p>
                        </div>
                        <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mb-4">
                            <span><i class="icon fa-solid fa-hotel"></i></span>
                            <span class="icontext">Vastaanotto</span>
                            <p>Vastaanottomme palvelee teitä ympäri vuorokauden.</p>
                        </div>
                    </div>
                </div>


            </div>


        </div>

        <div style="height:5svw;"></div>

        <!--Asiakasarviot-->

        <div class="col-12 m-0 p-5  pt-4 pb-4" style=" display:flex; flex-direction: column; background-color:#f0ebeb;">
            <div class=" review-box row shadow  mt-4 mb-4 pb-4" style="background-color: white;">
                <p class="h3 text-center mb-4 mt-4" style="">Asiakasarviot</p>
                <div class="col-md-3 col-lg-3 col-xl-3 text-center">
                    <img src="media/paaryna.png" class="pear2 img-fluid" alt="Image not found" width="200px" height="200px">
                </div>
                <div class="col-md-6 col-lg-6 col-xl-6 text-center mt-4">

                    <!-- Carousel -->
                    <div id="slides" class="carousel slide" data-bs-ride="carousel">
                        <!-- Indicators/dots -->
                        <div class="carousel-indicators ">
                            <button style="color: black" type="button" data-bs-target="#slides" data-bs-slide-to="0" class="active bg-success"></button>
                            <button type="button" data-bs-target="#slides" data-bs-slide-to="1" class="bg-success"></button>
                            <button type="button" data-bs-target="#slides" data-bs-slide-to="2" class="bg-success"></button>
                        </div>

                        <!-- The slideshow/carousel -->
                        <div class="carousel-inner">
                            <div class="carousel-item active text-center">
                                <div class="d-block" style="width:100%; height: 35svh;">
                                    <p><b>- <?php echo $messages[0]['nimi']; ?></b></p>
                                    <p><i>"<?php echo $messages[0]['viesti'] ?>"</i></p>
                                    <p><?php for ($i = 1; $i <= $messages[0]['arvio']; $i++) {
                                            echo '<img src="media/paaryna.png" width="30px" height="30px">';
                                        } ?></p>
                                </div>

                            </div>

                            <div class="carousel-item text-center">
                                <div class="d-block" style="width:100%; height: 35svh;">
                                    <p><b>- <?php echo $messages[1]['nimi']; ?></b></p>
                                    <p><i>"<?php echo $messages[1]['viesti'] ?>"</i></p>
                                    <p><?php for ($i = 1; $i <= $messages[1]['arvio']; $i++) {
                                            echo '<img src="media/paaryna.png" width="30px" height="30px">';
                                        } ?></p>
                                </div>
                            </div>
                            <div class="carousel-item text-center">
                                <div class="d-block" style="width:100%; height: 35svh;">
                                    <p><b>- <?php echo $messages[2]['nimi']; ?></b></p>
                                    <p><i>"<?php echo $messages[2]['viesti'] ?>"</i></p>
                                    <p><?php for ($i = 1; $i <= $messages[2]['arvio']; $i++) {
                                            echo '<img src="media/paaryna.png" width="30px" height="30px">';
                                        } ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-6 col-lg-3 col-xl-2 mx-auto mb-4" style="margin-top:75px" ;>
                    <a href="vieraskirja/vieraskirja.php"><input class="form-control form-control-lg" value="Anna palautetta" type="submit" name="submit"></a>
                </div>
            </div>
        </div>

    </div>


    <!-- Footer -->
    <footer class="text-center text-lg-start bg-light text-muted">

        <!-- Section: Social media -->
        <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">

            <!-- Left -->
            <div class="me-5 d-none d-lg-block">
                <span>Löydät meidät myös sosiaalisesta mediasta!</span>
            </div>

            <!-- Right -->
            <div>
                <a href="#" class="me-4 text-reset text-decoration-none">
                    <i class="bi bi-facebook"></i>
                </a>
                <a href="#" class="me-4 text-reset text-decoration-none">
                    <i class="bi bi-twitter"></i>
                </a>
                <a href="#" class="me-4 text-reset text-decoration-none">
                    <i class="bi bi-instagram"></i>
                </a>
                <a href="#" class="me-4 text-reset text-decoration-none">
                    <i class="bi bi-youtube"></i>
                </a>
            </div>
        </section>

        <section class="footer">
            <div class="container text-center text-md-start mt-5">

                <!-- Grid row -->
                <div class="row mt-3">

                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">Päärynähotellit Oy</h6>
                        <p>Päärynähotellit on perustettu vuonna 2023. Se on osakeyhtiö, jonka kotipaikka on Oulu, ja pääasiallinen toimiala hotellit.</p>
                    </div>

                    <!-- Grid column -->
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <div class="col">Osoite:</div>
                        <div class="col">Kotkantie 3, 90100 Oulu</div>
                        <div class="col">Sähköposti:</div>
                        <div class="col">info@paarynahotellit.fi</div>
                    </div>
                    <!-- Grid column -->
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <div class="col">Puhelin numero:</div>
                        <div class="col">044 999 888 99</div>
                        <div class="col">Y-tunnus:</div>
                        <div class="col">1234567-1 1234567-1</div>
                    </div>
                </div>
            </div>
        </section>
    </footer>
    </div>
    <script src='main2.js'></script>
</body>

</html>