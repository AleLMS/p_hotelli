<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Päärynä hotellit</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="vieraskirja.css">
        <link rel="stylesheet" href="main.css">
        <script src="https://kit.fontawesome.com/541d399fb7.js" crossorigin="anonymous"></script>
        <style>
            
        </style>
      </head>
      <body>
        /*
        <?php

        //Create connection
         
            require 'settings.php';
            $conn = new mysqli($servername, $username, $password, $dbname);
            
            $result = mysqli_query($conn, "SELECT * FROM messages ORDER BY id DESC limit 1");
                   $messages = mysqli_fetch_all($result, MYSQLI_ASSOC);
                $result2 = mysqli_query($conn, "SELECT * FROM messages where id ='234'");
                   $messagess = mysqli_fetch_all($result2, MYSQLI_ASSOC);
                   $result3 = mysqli_query($conn, "SELECT * FROM messages where id ='245'");
                   $messaged = mysqli_fetch_all($result3, MYSQLI_ASSOC);
        
                $conn->close();  
            ?>
      /*
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

      <!--Banner kuva-->
   
   <div><!--  display: grid;
    grid-template-columns: 1fr 2fr;  padding: 20px;  -->
    <div class="container-fluid" style="    position: relative;
            width: 100%;
            height: 100%;
            background-image: url('vieraskirjantausta.png');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            margin: 0;
            ">
      <!---  <img src="vieraskirjantausta.png" 
        class="img-fluid"
        alt="Image not found"
        width="100%"
        height="100%">-->
        <div style="position: relative;
        padding: 300px;
        align-items: center;
       

        ">
            <div style=" font-size: 7em;
            line-height: 1em;
            font-weight: 700;
            color:white;
            font-variant-caps: all-petite-caps;
            ">
                <h1>Tervetuloa rentoutumaan</h1>
                <h3>Viihtyisät ja mukavat hotellimme palvelevat teitä 4 paikkakunnalla.
                    Meille tärkeää on viihtyvyys ja haluamme tarjota parasta palvelua ja arjen luksusta, 
                    kuitenkin kohtuulliseen hintaan.
                </h3>
            </div>
        </div>
    </div>
   </div>
    

    
<br>
<div style="height:15svw;margin:auto">
<h1>tähän tulee varauslomake</h1>
</div>
<!--Hyvä tietää-->
<div class="container-fluid" id="mainContainer" style="text-align: center; text-decoration: none;">
  <p class="h3" style="">Hyvä tietää</p><br>
  <p></p>
  <div class="row mt-3 text-center">
    <div class="col-md-4"> 
        <p><img src="hotellroom.png" 
            class="img-fluid"
            alt="Image not found"
            width="400px"
            height="400px" style="border-radius: 50%;"
            ></p>
    </div>
    <div class="col-md-8">
        <div class="row mt-5 text-center">
            <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mb-4">
                <span><i class="fa-solid fa-clock"></i></span>
                <span>Check-in & Check out</span>
                <p>Sisäänkirjautuminen klo 15 alkaen. <br> Uloskirjautuminen viimeistään klo 13.</p>
            </div>
            <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mb-4">
                <span><i class="fa-solid fa-square-parking"></i></span>
                <span>Pysäköinti</span>
                <p>Hotellimme tarjoaa maksuttoman <br> ulkopysäköintialueen vierailleen.</p>
            </div>
        </div>
        <div class="row mt-5 text-center">
     
            <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mb-4">
                <span><i class="fa-solid fa-mug-saucer"></i></span>
                <span>Aamiainen</span>
                <p>Kattaus ma-pe klo 6:30 - 10, <br> viikonloppuisin klo 7 - 11.</p>
            </div>
            <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mb-4">
                <span><i class="fa-solid fa-heart"></i></span>
                <span>Sauna ja kuntoilu</span>
                <p>Tarjoamme asiakkaillemme viihtyisät saunatilat ja ilmaisen kuntosalin.</p>
            </div>
        </div>
      </div>
      
    
  </div>
  <div style="height:5svw;">

  </div>
<hr>
<!--Asiakasarviot-->

    <div class="col-12 col-md-12 m-0 p-5 pt-4 pb-4 bg-white"
    style="margin-right: 1em; display:flex; flex-direction: column;">
    <p class="h3" style="">Asiakasarviot</p><br>
    <div class=" review-box row shadow">
        <div class="col-md-3">
            <p><img src="paaryna.png" 
                class="img-fluid"
                alt="Image not found"
                width="200px"
                height="200px"
                ></p>
        </div>
        <div class="review col-md-6">
                <!-- Slideshow container -->
                <div class="slideshow-container">
                        <div class="mySlides">
                            
                            <table class="table table-borderless">
                            <?php foreach ($messages as $message): ?>
                                <tr>
                                    <td></td>
                                    <td><i>"<?php echo $message['viesti'] ?>"</i> </td>
                                    <td></td>
                                    
                                </tr>
                                <tr>
                                    <td><a class="prev" onclick="plusSlides(-1)">&#10094;</a></td>
                                    <td><b>- <?php echo $message['nimi']; ?>dd </b></td>
                                    <td><a class="next" onclick="plusSlides(1)">&#10095;</a></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><?php for ($i = 1; $i <= $message['arvio']; $i++){
                                        echo '<img src="paaryna.png" width="30px" height="30px">';
                                        }?></td>
                                </tr>
                            
                                <?php endforeach; ?>
                                
                    
                            </table>
                            
                        </div>
                                            
                        <div class="mySlides">
                            <table class="table table-borderless">
                            <?php foreach ($messagess as $messag): ?>
                                <tr>
                                    <td></td>
                                    <td><i>"<?php echo $messag['viesti'] ?>"</i> </td>
                                    <td></td>
                                    
                                </tr>
                                <tr>
                                    <td><a class="prev" onclick="plusSlides(-1)">&#10094;</a></td>
                                    <td><b>- <?php echo $messag['nimi']; ?> </b></td>
                                    <td><a class="next" onclick="plusSlides(1)">&#10095;</a></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><?php for ($i = 1; $i <= $messag['arvio']; $i++){
                                        echo '<img src="paaryna.png" width="30px" height="30px">';
                                        }?></td>
                                </tr>
                            
                                <?php endforeach; ?>
                                
                    
                            </table>
                        </div>

                        <div class="mySlides">
                            <table class="table table-borderless">
                            <?php foreach ($messaged as $messagesss): ?>
                                <tr>
                                    <td></td>
                                    <td><i>"<?php echo $messagesss['viesti'] ?>"</i> </td>
                                    <td></td>
                                    
                                </tr>
                                <tr>
                                    <td><a class="prev" onclick="plusSlides(-1)">&#10094;</a></td>
                                    <td><b>- <?php echo $messagesss['nimi']; ?> sss</b></td>
                                    <td><a class="next" onclick="plusSlides(1)">&#10095;</a></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><?php for ($i = 1; $i <= $messagesss['arvio']; $i++){
                                        echo '<img src="paaryna.png" width="30px" height="30px">';
                                        }?></td>
                                </tr>
                            
                                
                             
                                <?php endforeach; ?>
                            </table>
                        </div>

                           
                    
                </div> 
    
        </div>
                            
        <div class="review-submit col-md-2">
        <a href="vieraskirja.php"><input class="form-control form-control-lg" value="Anna palautetta" type="submit" name="submit"></a>
        </div>
    </div>
</div>

</div>
<div></div>

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
  <script>
    let slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
    showSlides(slideIndex += n);
    }

    function currentSlide(n) {
    showSlides(slideIndex = n);
    }

    function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    //let dots = document.getElementsByClassName("dot");
    if (n > slides.length) {
        slideIndex = 1
    }    
    if (n < 1) {
        slideIndex = slides.length
    }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";  
    }
  /*
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }*/
  slides[slideIndex-1].style.display = "block";  
 // dots[slideIndex-1].className += " active";
}

</script>
  </body>



</html>