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
    
    <title>Conflictos</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- map -->
    <link href="css/map.css" rel="stylesheet">


    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/grayscale2.min.css" rel="stylesheet">

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCHWf9l3eJTqw-BdHphaypiM3goFikqQTo"></script>

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
              <a class="nav-link js-scroll-trigger" href="index.php">About</a>
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
    <?php 
            //Consulta rating
             
    $data2 = sparql_get( "http://localhost:8890/sparql",
        "PREFIX dbo: <http://dbpedia.org/ontology/>
  PREFIX geo: <http://www.w3.org/2003/01/geo/wgs84_pos#>
  select ?ataque ?gov ?nombregov ?lat ?long ?fechaataque ?nombreiniciador ?nombreobjetivo ?nombrereporte {
  ?ataque <http://www.w3.org/1999/02/22-rdf-syntax-ns#type> <http://conflictosiria.com/schema/Assault> .
  ?ataque <http://conflictosiria.com/schema/befallAttack> ?gov .
  ?gov dbo:province ?nombregov.
  ?gov geo:lat ?lat .
  ?gov geo:long ?long .
  ?ataque <http://conflictosiria.com/schema/attackDate> ?fechaataque .
  ?ataque <http://conflictosiria.com/schema/startedBy> ?iniciador .
  ?iniciador <http://xmlns.com/foaf/0.1/name> ?nombreiniciador .
  ?ataque <http://conflictosiria.com/schema/target> ?objetivo .
  ?objetivo <http://xmlns.com/foaf/0.1/name> ?nombreobjetivo .
  ?ataque <http://conflictosiria.com/schema/reportedBy> ?reporte .
  ?reporte <http://www.w3.org/1999/02/22-rdf-syntax-ns#type> ?tiporeporte .
  ?tiporeporte <http://xmlns.com/foaf/0.1/name> ?nombrereporte .
  }" );
    $marker_pintar = "";
      foreach( $data2 as $row )
      {                       
        $marker_pintar .= "['".$row["ataque"]."','".$row["gov"]."','".$row["nombregov"]."',
          '".$row["lat"]."','".$row["long"]."','".$row["fechaataque"]."','".$row["nombreiniciador"]."',
          '".$row["nombreobjetivo"]."','".$row["nombrereporte"]."'],";
      }                       
      ?>
      </header>

      <script>
              var locations = [ <?php echo $marker_pintar; ?>];
              function initialize() {
          var myLatlng = new google.maps.LatLng(34.8333806, 36.4059766);
          var mapOptions = {
            zoom: 7,
            center: myLatlng
          };

          var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
            setMarkers(map,locations)
        }

                google.maps.event.addDomListener(window, 'load', initialize);


                function setMarkers(map,locations){

          var marker, i

          for (i = 0; i < locations.length; i++)
           {  
               a= Math.floor((Math.random() * locations.length) + i);
               b= Math.floor((Math.random() * locations.length) + i);
               var ataque1 = locations[i][0]
               var nombregov = locations[i][2]
               var lat = locations[i][3] + a*2000
               var longt = locations[i][4] + b*1000
               var date =  locations[i][5]
               var start =  locations[i][6]
               var target1 =  locations[i][7]
               var fuente =  locations[i][8]

            
               latlngset = new google.maps.LatLng(lat, longt);

                var marker = new google.maps.Marker({  
                    map: map, title: nombregov , position: latlngset  
                });
                map.setCenter(marker.getPosition())
                var content = '<h5>'+"Ataque: " + date +  '</h5>'  +"<br>"+'Gobernacion: '+nombregov+"<br>"+
                'Iniciado por: '+start+"<br>"+ "Objetivo: " + target1+"<br>"+  "Fuente: " + fuente

                var infowindow = new google.maps.InfoWindow()

                google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){ 
                    return function() {
                        infowindow.setContent(content); 
                         infowindow.open(map,marker);
                    };
                })(marker,content,infowindow)); 

           }
      }

        </script>

       

</div>


    

    <!-- Signup Section -->
    <section id="signup" class="signup-section">
      <div class="container">
    <div class="row align-items-center no-gutters mb-12 mb-lg-12">
          <div class="featured-text text-center text-lg-left">
            <h4>ATAQUES Y ZONAS CONTROLADAS</h4>
            <p class="text-black-50 mb-0">Se ha denominado a la guerra civil de Siria como un conflicto entre su gobierno de larga duración y aquellos que buscan destituirlos del cargo. Tuvo sus inicios en 2011 no obstante ha evolucionado hasta convertirse en una serie de alianzas con poderes externos cada vez más entrelazados. Estas alianzas respaldan a los lados opuestos, pero también han surgido aliados nominales que a menudo se entrelazan. Se calcula que ha matado a cientos de miles de personas y ha desplazado a otros 11 millones de los 23 que habían antes del conflicto. Este proyecto pretende mostrar los causantes, victimas, lugares que forman parte del conflicto de Siria mediante la visualización de datos enlazados.</p><br><br>
        </div>
      </div>  
      <div class="container">

        <div class="row">
          <div class="col-md-12 col-lg-12 mx-auto text-center">



             <section id="map-canvas"></section>

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

    <!-- Banner-Slider-JavaScript -->
    <script src="js/responsiveslides.min.js"></script>
    <script>
      $(function () {
        $("#slider1").responsiveSlides({
          auto: true,
          nav: true,
          speed: 1000,
          namespace: "callbacks",
          pager: true,
        });
      });
    </script>

    <!-- Custom scripts for this template -->
    <script src="js/grayscale.min.js"></script>

  </body>

</html>
