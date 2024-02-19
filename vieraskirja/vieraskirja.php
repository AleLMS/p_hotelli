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
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Quicksand Medium">
  <link rel="stylesheet" href="vieraskirja.css">
  
</head>
<body>

    <?php

    //Create connection
    require 'settings.php';
    $conn = new mysqli($servername, $username, $password, $dbname);
    $result = mysqli_query($conn, "SELECT * FROM messages ORDER BY id DESC limit 5");
           $messages = mysqli_fetch_all($result, MYSQLI_ASSOC);   


    if(isset($_POST["submit"])){
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
  <nav class="navbar navbar-expand-sm navbar-dark" style="background-color: #9cda71; padding: 0.75em; font-size: 1.2em;">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
      <li class="nav-item topimg hidden-xs hidden-sm">
                  <a class="nav-link" aria-current="page" href=""><img src="../media/paaryna.png" style="width: 60px; height: 60px;" alt="">
                  <img src="../media/paarynalogo.png" style="width: 220px; height: 50px" alt=""></a></li>
      <ul class="navbar-nav nav justify-content-center"></ul>
        <li class="nav-item mt-2">
          <a class="nav-link active" aria-current="page" href="mainpage.php">Etusivu</a></li>
        <li class="nav-item mt-2">
          <a class="nav-link" href="gallery.html">Galleria</a></li>
        <li class="nav-item mt-2">
          <a class="nav-link" href="#">Vieraskirja</a></li>
        <li class="nav-item mt-2">
          <a class="nav-link" href="yhteystiedot.html">Yhteystiedot</a></li>
      </ul>
    </div>
</nav>
  

 
        <!--kuva  
        <img class="image" src="vieraskirjantausta.png" class="img-fluid" alt="Image not found" width="100%" height="100%">
       --> 
        <!-- tekstikentät-->
        <div class="container-fluid" id="mainContainer" style="background-image: url(../media/vieraskirjantausta.png); background-position: center;
        background-repeat: no-repeat; background-size: cover; position: relative;">
            <h1 class="h1 pt-5 mx-auto" style="font-size: min(8svh, 8svw); color: #ffffff; margin-bottom:15px;">Vieraskirja</h1>
            
    <div class="msgcontainer container mt-5 rounded-2" style=" min-height: 250px; background-color: white; border-radius: 5px; opacity: 0.7"><?php foreach ($messages as $message): ?>
    <div class="msgarea row pt-4 pb-5" style="height:5em; ">
              <div class="col-6 col-sm-6 col-lg-3 col-md-3">
                <p><b><?php echo $message['aika']; ?></b></p>
              </div>
              <div class="col-6 col-sm-6 col-lg-3 col-md-3">
                <p><b><?php echo $message['nimi']; ?></b></p>
              </div>
              <div class="col-6 col-xs-6 col-sm-6 col-lg-4 col-md-3">
                <p><b><i>"<?php echo $message['viesti'] ?>"</i></b> </p>
              </div>
              <div class="col-6 col-xs-6 col-sm-6 col-lg-2 col-md-3">
                <p><?php for ($i = 1; $i <= $message['arvio']; $i++){
                      echo '<img src="../media/paaryna.png" width="30px" height="30px">';
                      }?></p>
              </div>
            </div><?php endforeach; ?>
    </div>
         
            <div class="row" style="height: 7svh;"></div> <!-- spacer -->
            <div class="form container">
            <h4 class="h4 text-white mb-4" style="text-shadow: 1px 1px 2px black, 0 0 25px #b8afae, 0 0 5px;">Kirjoita vieraskirjaan kokemuksestasi hotellissamme täyttämällä alla oleva lomake. Voit arvioida kokemuksesi päärynöillä.</h4>
               <!-- form   -->
                <form id="lomake" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      
                   <div class="row mt-3 text-center" id="input">
                        <div class="col-md-6 col-lg-3 col-xl-3 mx-auto mb-4"><input class="form-control form-control-lg" id="nimikentta" type="text" placeholder="Kirjoita tähän nimesi.." name="name"></div>
                        <div class="col-md-6 col-lg-3 col-xl-3 mx-auto mb-4"><input class="form-control form-control-lg"  id="tekstikentta" type="text" placeholder="Kirjoita tähän viesti..." name="message"></div>
                        <div class="col-md-6 col-lg-4 col-xl-4 mx-auto mb-4 rating">
                          <button type="button" class="btn paarynat " onclick="rating(1);" id="paaryna1"><img  src="../media/paaryna.png" width="30px" height="30px" alt="Image not found" id="p1"></button>
                          <button type="button" class="btn paarynat" onclick="rating(2);" id="paaryna2"><img  src="../media/paaryna.png" width="30px" height="30px" alt="Image not found" id="p2"></button>
                          <button type="button" class="btn paarynat" onclick="rating(3);" id="paaryna3"><img  src="../media/paaryna.png" width="30px" height="30px" alt="Image not found" id="p3"></button>
                          <button type="button" class="btn paarynat" onclick="rating(4);" id="paaryna4"><img  src="../media/paaryna.png" width="30px" height="30px" alt="Image not found" id="p4"></button>
                          <button type="button" class="btn paarynat" onclick="rating(5);" id="paaryna5"><img  src="../media/paaryna.png" width="30px" height="30px" alt="Image not found" id="p5"></button>
                          <input type="hidden"  name="arvio" id="arvio">
                        </div>
                        <div class="col-md-6 col-lg-2 col-xl-2 mx-auto mb-4"><input class="form-control form-control-lg" type="submit" name="submit"></div>
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
