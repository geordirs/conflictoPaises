<?php
  extract($_GET);
  require_once("sparqllib.php")
?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Wanderer a Responsive Web Template, Bootstrap Web Templates, Flat Web Templates, Android Compatible Web Template, Smartphone Compatible Web Template, Free Webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <script src="js/d3sparql.js"></script>
    <script src="https://d3js.org/d3.v5.min.js"></script>
    
    <script>
      function executeQuery() {
        var endpoint = d3.select("#endpoint").property("value")
        var sparql = d3.select("#sparql").property("value")
        d3sparql.query(endpoint, sparql, render)
      }
      function render(json) {
        var config = {
          "charge": -500,
          "distance": 150,
          "width": 1350,
          "height": 750,
          "selector": "#result"
        }
        console.log(json);
        d3sparql.forcegraph(json, config)
      }

      function exec_offline() {
        d3.json("cache/dbpedia/proglang_pair.json", render)
      }
      function toggle() {
        d3sparql.toggle()
      }
    </script>

    <title>Conflictos</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/grayscale2.min.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">Conflictos entre Países</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#about">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="dates.php">Dates</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="map.php">Map</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="report.php">Reports</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="search.php">Searchs</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#contact">Contact Us</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Header -->
    <header class="masthead">
    </header>

    <div class="about" id="about">
      <div class="container">
        <br><br><br>
        <h1>CONSULTAS</h1>
        <p class="para">Espacio proporcionado para realizar consultas RDF acerca del conflicto en Siria</p>

        <div id="query" style="margin: 10px">
        
           
            <center>
               <form class="form-inline">
              <label>ENPOINT:</label>
              <div class="input-append">
                <input id="endpoint" class="span5" style="width: 40%" value="http://localhost:8890/sparql" type="text">
                <button class="btn" type="button" onclick="executeQuery()">Query</button>
                <button class="btn" type="button" onclick="toggle()"><i id="button" class="icon-chevron-up"></i>Hide</button>
              </div>
            </form>
            <textarea style="font-family: Consolas" id="sparql" class="span9" cols=100 rows=10>consulta 
            </textarea>
        </center>
            
          </div>
          <div id="result"></div>

      </div>
    </div>

    <!-- About Section -->
    <section id="about" class="about-section text-center">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <h2 class="text-white mb-4">About Us</h2>
            <p class="text-white-50">Se ha denominado a la guerra civil de <a href="https://www.unicef.es/causas/emergencias/conflicto-en-siria">Siria</a>. como un conflicto entre su gobierno de larga duración y aquellos que buscan destituirlos del cargo. Tuvo sus inicios en 2011 no obstante ha evolucionado hasta convertirse en una serie de alianzas con poderes externos cada vez más entrelazados. Estas alianzas respaldan a los lados opuestos, pero también han surgido aliados nominales que a menudo se entrelazan. Se calcula que ha matado a cientos de miles de personas y ha desplazado a otros 11 millones de los 23 que habían antes del conflicto. Este proyecto pretende mostrar los causantes, victimas, lugares que forman parte del conflicto de Siria mediante la visualización de datos enlazados.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Projects Section -->
    <section id="dates" class="projects-section bg-light">
      <div class="container">

        <!-- Featured Project Row -->
        <div class="row align-items-center no-gutters mb-4 mb-lg-5">
          <div class="col-xl-8 col-lg-7">
            <img class="img-fluid mb-3 mb-lg-0" src="img/conflictos/siria1.jpg" alt="">
          </div>
          <div class="col-xl-4 col-lg-5">
            <div class="featured-text text-center text-lg-left">
              <h4>Datos - Conflicto Siria</h4>
              <p class="text-black-50 mb-0">Se ha denominado a la guerra civil de Siria como un conflicto entre su gobierno de larga duración y aquellos que buscan destituirlos del cargo. Tuvo sus inicios en 2011 no obstante ha evolucionado hasta convertirse en una serie de alianzas con poderes externos cada vez más entrelazados. Estas alianzas respaldan a los lados opuestos, pero también han surgido aliados nominales que a menudo se entrelazan. Se calcula que ha matado a cientos de miles de personas y ha desplazado a otros 11 millones de los 23 que habían antes del conflicto. Este proyecto pretende mostrar los causantes, victimas, lugares que forman parte del conflicto de Siria mediante la visualización de datos enlazados.</p>
            </div>
          </div>
        </div>

       
        
        <!-- Project One Row -->
        <div class="row justify-content-center no-gutters mb-5 mb-lg-0">
          <div class="col-lg-6">
            <img class="img-fluid" src="img/demo-image-01.jpg" alt="">
          </div>
          <div class="col-lg-6">
            <div class="bg-black text-center h-100 project">
              <div class="d-flex h-100">
                <div class="project-text w-100 my-auto text-center text-lg-left">
                  <h4 class="text-white">Misty</h4>
                  <p class="mb-0 text-white-50">An example of where you can put an image of a project, or anything else, along with a description.</p>
                  <hr class="d-none d-lg-block mb-0 ml-0">
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Project Two Row -->
        <div class="row justify-content-center no-gutters">
          <div class="col-lg-6">
            <img class="img-fluid" src="img/demo-image-02.jpg" alt="">
          </div>
          <div class="col-lg-6 order-lg-first">
            <div class="bg-black text-center h-100 project">
              <div class="d-flex h-100">
                <div class="project-text w-100 my-auto text-center text-lg-right">
                  <h4 class="text-white">Mountains</h4>
                  <p class="mb-0 text-white-50">Another example of a project with its respective description. These sections work well responsively as well, try this theme on a small screen!</p>
                  <hr class="d-none d-lg-block mb-0 mr-0">
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>



    
    <!-- Signup Section -->
    <section id="signup" class="signup-section">
      <div class="container">
        <div class="row">
          <div class="col-md-10 col-lg-8 mx-auto text-center">

            <i class="far fa-paper-plane fa-2x mb-2 text-white"></i>
            <h2 class="text-white mb-5">Subscribe to receive updates!</h2>

            <form class="form-inline d-flex">
              <input type="email" class="form-control flex-fill mr-0 mr-sm-2 mb-3 mb-sm-0" id="inputEmail" placeholder="Enter email address...">
              <button type="submit" class="btn btn-primary mx-auto">Subscribe</button>
            </form>

          </div>
        </div>
      </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section bg-black">
      <div class="container">

        <div class="row">

          <div class="col-md-4 mb-3 mb-md-0">
            <div class="card py-4 h-100">
              <div class="card-body text-center">
                <i class="fas fa-map-marked-alt text-primary mb-2"></i>
                <h4 class="text-uppercase m-0">Project</h4>
                <hr class="my-4">
                <div class="small text-black-50">Sistemas Basados en Conocimientos</div>
              </div>
            </div>
          </div>

          <div class="col-md-4 mb-3 mb-md-0">
            <div class="card py-4 h-100">
              <div class="card-body text-center">
                <i class="fas fa-envelope text-primary mb-2"></i>
                <h4 class="text-uppercase m-0">Email</h4>
                <hr class="my-4">
                <div class="small text-black-50">
                  <a href="#">geordirs@gmail.com</a>
                  <a href="#">jonathan@gmail.com</a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4 mb-3 mb-md-0">
            <div class="card py-4 h-100">
              <div class="card-body text-center">
                <i class="fas fa-user-alt text-primary mb-2"></i>
                <h4 class="text-uppercase m-0">Integrantes</h4>
                <hr class="my-4">
                <div class="small text-black-50">Jordy R. Sarango</div>
                <div class="small text-black-50">Jonathan Yaguana</div>
              </div>
            </div>
          </div>
        </div>

        <div class="social d-flex justify-content-center">
          <a href="#" class="mx-2">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="#" class="mx-2">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="#" class="mx-2">
            <i class="fab fa-github"></i>
          </a>
        </div>

      </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black small text-center text-white-50">
      <div class="container">
        Copyright &copy; Your Website 2018
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/font-awesome/js/all.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/grayscale.min.js"></script>

  </body>

</html>
