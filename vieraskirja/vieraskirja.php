<!DOCTYPE html>
<html lang="en">

<head>
  <title>Päärynä hotellit</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Quicksand">
  <link rel="stylesheet" href="vieraskirja.css">

</head>

<body>
  <button onclick="toTheTop();" id="topbtn" title="Go to top"><i class="fa-solid fa-arrow-up"></i></button>

  <?php

  //Create connection
  include_once("../php/db-cred.php");

  $conn = new mysqli(SERVER, USERNAME, PASSWORD, DB);
  $result = mysqli_query($conn, "SELECT * FROM messages ORDER BY id DESC limit 5");
  $messages = mysqli_fetch_all($result, MYSQLI_ASSOC);


  if (isset($_POST["submit"])) {
    $nimi = $_POST["name"];
    $viesti = $_POST["message"];
    $aika = date("Y-m-d");
    $arvio = $_POST["arvio"];

    $sql = "INSERT INTO messages (nimi, viesti, aika, arvio) VALUES ('$nimi', '$viesti', '$aika', '$arvio')";
    if ($conn->query($sql) === TRUE) {
      $result = mysqli_query($conn, "SELECT * FROM messages ORDER BY id DESC limit 5");
      $messages = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
      echo "virhe";
    }
  }


  $conn->close();
  ?>

  <!--Nav-->
  <nav class="navbar navbar-expand-sm navbar-dark" style="background-color: #9cda71; padding: 0.75em; font-size: 1.2em;">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <!--Large/Desktop-->
      <ul class="navbar-nav d-none d-sm-flex" style="display:flex; justify-content: space-between; flex-direction: row; width: 100%;">
        <div style="display:flex; flex-direction: row;">
          <li class="nav-item topimg hidden-xs hidden-sm">
            <a class="nav-link" aria-current="page" href="../index.php"><img src="../media/logo2.png" style="width: 450px; height: 50px;" alt="Image not found"></a>
          </li>
        </div>
        <div class="" style="display:flex; flex-direction: row; align-items: center;">
          <li class="nav-item ">
            <a class="nav-link" aria-current="page" href="../index.php">Etusivu</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="../galleria/gallery.html">Galleria</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link active" href="../vieraskirja/vieraskirja.php">Vieraskirja</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link " href="../yhteys/yhteystiedot.html">Yhteystiedot</a>
          </li>
          <li class="nav-item hidden-xs hidden-sm">
            <a class="nav-link " href="../varaus/varaus.html"><input class="form-control form-control-lg" value="Varaa tästä" type="submit" name="submit"></a>
          </li>
        </div>
      </ul>
      <!--Small/Mobile-->
      <ul class="navbar-nav d-block d-sm-none">
        <li class="nav-item topimg hidden-xs hidden-sm">
          <a class="nav-link" aria-current="page" href="../index.php"><img src="../media/logo2.png" style="width: 450px; height: 50px;" alt="Image not found"></a>
        </li>
        <li class="nav-item ">
          <a class="nav-link " aria-current="page" href="../index.php">Etusivu</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="../galleria/gallery.html">Galleria</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link active" href="../vieraskirja/vieraskirja.php">Vieraskirja</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link " href="../yhteys/yhteystiedot.html">Yhteystiedot</a>
        </li>
        <li class="nav-item hidden-xs hidden-sm">
          <a class="nav-link " href="../varaus/varaus.html"><input class="form-control form-control-lg" value="Varaa tästä" type="submit" name="submit"></a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container-fluid" id="mainContainer" style="background-image: url(../media/vieraskirjantausta.png); background-position: center;
        background-repeat: no-repeat; background-size: cover; position: relative;">
    <h1 class="h1 pt-5 mx-auto text-center" style="font-size: min(8svh, 8svw); color: #ffffff;text-shadow:1px 1px 2px black, 0 0 25px #b8afae, 0 0 5px; margin-bottom:15px;">Vieraskirja</h1>

    <div class="msgcontainer container mt-5 pb-5 pt-5 rounded-2" style="background-color: white; border-radius: 5px; opacity: 0.8"><?php foreach ($messages as $message) : ?>
        <div class="msgarea row mb-4" style="">
          <div class="time col-6 col-sm-6 col-lg-3 col-md-3">
            <p><b><?php echo $message['aika']; ?></b></p>
          </div>
          <div class="name col-6 col-sm-6 col-lg-3 col-md-3">
            <p><b><?php echo $message['nimi']; ?></b></p>
          </div>
          <div class="message col-12 col-xs-6 col-sm-6 col-lg-4 col-md-3">
            <p><i>"<?php echo $message['viesti'] ?>"</i></p>
          </div>
          <div class="pears col-12 col-xs-6 col-sm-6 col-lg-2 col-md-3">
            <p><?php for ($i = 1; $i <= $message['arvio']; $i++) {
                                                                                                                                        echo '<img src="../media/paaryna.png" width="30px" height="30px">';
                                                                                                                                      } ?></p>
          </div>
        </div><?php endforeach; ?>
    </div>

    <div class="row" style="height: 7svh;"></div> <!-- spacer -->
    <div class="form container">
      <h4 class="h4 text-white mb-4" style="text-shadow: 1px 1px 2px black, 0 0 25px #b8afae, 0 0 5px;">Kirjoita vieraskirjaan kokemuksestasi hotellissamme täyttämällä alla oleva lomake. Voit arvioida kokemuksesi päärynöillä.</h4>
      <!-- form   -->
      <form id="lomake" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

        <div class="row mt-3 text-center" id="input">
          <div class="col-md-6 col-lg-3 col-xl-3 mx-auto mb-4"><input class="form-control form-control-lg" id="nimikentta" type="text" placeholder="Kirjoita tähän nimesi.." name="name">
          </div>
          <div class="col-md-6 col-lg-3 col-xl-3 mx-auto mb-4"><input class="form-control form-control-lg" id="tekstikentta" type="text" placeholder="Kirjoita tähän viesti..." name="message">
          </div>
          <div class="col-md-6 col-lg-4 col-xl-4 mx-auto mb-4 rating">
            <button type="button" class="btn paarynat " onclick="rating(1);" id="paaryna1"><img src="../media/paaryna.png" width="30px" height="30px" alt="Image not found" id="p1"></button>
            <button type="button" class="btn paarynat" onclick="rating(2);" id="paaryna2"><img src="../media/paaryna.png" width="30px" height="30px" alt="Image not found" id="p2"></button>
            <button type="button" class="btn paarynat" onclick="rating(3);" id="paaryna3"><img src="../media/paaryna.png" width="30px" height="30px" alt="Image not found" id="p3"></button>
            <button type="button" class="btn paarynat" onclick="rating(4);" id="paaryna4"><img src="../media/paaryna.png" width="30px" height="30px" alt="Image not found" id="p4"></button>
            <button type="button" class="btn paarynat" onclick="rating(5);" id="paaryna5"><img src="../media/paaryna.png" width="30px" height="30px" alt="Image not found" id="p5"></button>
            <input type="hidden" name="arvio" id="arvio">
          </div>
          <div class="col-md-6 col-lg-2 col-xl-2 mx-auto mb-4"><input id="sendMsg" class="form-control form-control-lg" type="submit" name="submit"></div>
        </div>
      </form>


    </div>
    <div class="row" style="height: 5svh;"></div> <!-- spacer -->
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
  <script src="vieraskirja.js"></script>
</body>

</html>