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
  
  <link rel="stylesheet" href="vieraskirja.css">
  <link rel="stylesheet" href="global.css">
  
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
  /*   */   
    ?>
  <nav class="navbar navbar-expand-sm navbar-dark" style="background-color: #9cda71; padding: 0.75em; font-size: 1.2em;">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="">Etusivu</a></li>
        <li class="nav-item">
          <a class="nav-link" href="">Galleria</a></li>
        <li class="nav-item">
          <a class="nav-link" href="">Vieraskirja</a></li>
        <li class="nav-item">
          <a class="nav-link" href="">Yhteystiedot</a></li>
      </ul>
    </div>
</nav>
  

 
        <!--kuva  
        <img class="image" src="vieraskirjantausta.png" class="img-fluid" alt="Image not found" width="100%" height="100%">
       --> 
        <!-- tekstikentät-->
        <div class="container-fluid" id="mainContainer" style="background-image: url('vieraskirjantausta.png'); background-position: center;
        background-repeat: no-repeat; background-size: cover; position: relative;">
            <h1 class="h1">Vieraskirja</h1><br>
            <table class="table table-light table-borderless" id="table" style="border-radius: 5px; opacity: 0.7;">
              <thead>
                <th>Nimi</th>
                <th>Palaute</th>
                <th>Aika</th>
                <th>Arvio</th>
              </thead>
              <tbody>
              <?php foreach ($messages as $message): ?>
                <tr>
                  <td> -----------------</td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                    <td><b> <?php echo $message['nimi']; ?> </b></td>
                    <td><i>"<?php echo $message['viesti'] ?>"</i> </td>
                    <td><b> <?php echo $message['aika']; ?></b> </td>
                    <td> <?php for ($i = 1; $i <= $message['arvio']; $i++){
                    echo '<img src="paaryna.png" width="30px" height="30px">';
                    }?></td>
                </tr>
                <?php endforeach; ?>
                
              
              </tbody>
              
            </table>
            <h4 class="text-white" >Kirjoita vieraskirjaan kokemuksestasi hotellissamme täyttämällä alla oleva lomake. Voit arvioida kokemuksesi päärynöillä.</h4>
               <!-- form   -->
                <form id="lomake" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      
                   <div class="row mt-3 text-center" id="input">
                        <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mb-4"><input class="form-control form-control-lg" id="nimikentta" type="text" placeholder="Kirjoita tähän nimesi.." name="name"></div>
                        <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mb-4"><input class="form-control form-control-lg"  id="tekstikentta" type="text" placeholder="Kirjoita tähän viesti..." name="message"></div>
                        <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mb-4" >
                        <button type="button" class="btn paarynat " onclick="rating(1);" id="paaryna1"><img  src="paaryna.png" width="30px" height="30px" alt="Image not found" id="p1"></button>
                        <button type="button" class="btn paarynat" onclick="rating(2);" id="paaryna2"><img  src="paaryna.png" width="30px" height="30px" alt="Image not found" id="p2"></button>
                        <button type="button" class="btn paarynat" onclick="rating(3);" id="paaryna3"><img  src="paaryna.png" width="30px" height="30px" alt="Image not found" id="p3"></button>
                        <button type="button" class="btn paarynat" onclick="rating(4);" id="paaryna4"><img  src="paaryna.png" width="30px" height="30px" alt="Image not found" id="p4"></button>
                        <button type="button" class="btn paarynat" onclick="rating(5);" id="paaryna5"><img  src="paaryna.png" width="30px" height="30px" alt="Image not found" id="p5"></button>
                        <input type="hidden"  name="arvio" id="arvio" ></div>
                        <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mb-4"><input class="form-control form-control-lg" type="submit" name="submit"></div>
                    </div>
                  </form>
        </div>

        <!-- Maps -->
        <!--<div class="container" style="text-align: center;">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3372.381422151354!2d25.51096114198672!3d64.9996731497764!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4681cd4546b29057%3A0x2a9ad59238666eb7!2sOSAO%2C%20Kaukovainio%2C%20Technical%20unit!5e0!3m2!1sen!2sfi!4v1696400885824!5m2!1sen!2sfi"
            width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>-->
        


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
