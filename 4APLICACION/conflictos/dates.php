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



    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/grayscale2.min.css" rel="stylesheet">

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/highcharts-3d.js"></script>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>

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
    
    </header>

    <div class="about" id="about">
    <div class="container">

      <div class="row align-items-center no-gutters mb-4 mb-lg-5">
          <div class="col-xl-8 col-lg-5">
            <div class="featured-text text-center text-lg-left">
              <h4>Datos - Conflicto Siria</h4>
              <p class="text-black-50 mb-0">Se ha denominado a la guerra civil de Siria como un conflicto entre su gobierno de larga duración y aquellos que buscan destituirlos del cargo. Tuvo sus inicios en 2011 no obstante ha evolucionado hasta convertirse en una serie de alianzas con poderes externos cada vez más entrelazados. Estas alianzas respaldan a los lados opuestos, pero también han surgido aliados nominales que a menudo se entrelazan. Se calcula que ha matado a cientos de miles de personas y ha desplazado a otros 11 millones de los 23 que habían antes del conflicto. Este proyecto pretende mostrar los causantes, victimas, lugares que forman parte del conflicto de Siria mediante la visualización de datos enlazados.</p>
            </div>
          </div>
        </div>

      <?php 
            //Consulta rating
            $Victima=array();
            $dataVic = sparql_get( 
                "http://localhost:8890/sparql","
                 select COUNT(*) as ?count where{
        ?count <http://www.w3.org/1999/02/22-rdf-syntax-ns#type> <http://conflictosiria.com/schema/Decease> .
        } 
                " );
              
              foreach( $dataVic as $row )
                {
                  $Victima[]=array("count"=>$row["count"]);
                    
                 }
                 $vic= $row['count'];


                $Detecion=array();
              $dataDeten = sparql_get( 
                "http://localhost:8890/sparql","
                 select COUNT(*) as ?count where{
        ?count <http://www.w3.org/1999/02/22-rdf-syntax-ns#type> <http://conflictosiria.com/schema/Detention> .
        } 
                " );
              
              foreach( $dataDeten as $row )
                {
                  $Detencion[]=array("count"=>$row["count"]);
                    
                 }
                 $det= $row['count'];

                $Desapariciones=array();
              $dataDesap = sparql_get( 
                "http://localhost:8890/sparql","
                 select COUNT(*) as ?count where{
        ?count <http://www.w3.org/1999/02/22-rdf-syntax-ns#type> <http://conflictosiria.com/schema/Disapperance> .
        } 
                " );
              
              foreach( $dataDesap as $row )
                {
                  $Desapariciones[]=array("count"=>$row["count"]);
                    
                 }
                 $desa= $row['count'];

                $Governa=array();
              $dataGob = sparql_get( 
                "http://localhost:8890/sparql","
                PREFIX dbo: <http://dbpedia.org/ontology/>
        select COUNT(*) as ?n ?nombregov where{
        ?n <http://conflictosiria.com/schema/livedIn> ?prov.
        ?prov dbo:province ?nombregov.
        }
                " );
               
              
              foreach( $dataGob as $row )
                {
                 $Governa[]=array("n"=>$row["n"],"nombregov"=>$row["nombregov"]);
                  //echo $row['n']."--". $row['causa']."---";
                  $nume[]=$row['n'];
                  $nomGov[]=$row['nombregov'];

                }

            

                $CausasM=array();
              $dataCau = sparql_get( 
                "http://localhost:8890/sparql","
                select COUNT(*) as ?n ?causa where{
        ?n <http://conflictosiria.com/schema/deathCause> ?causa .
        }
                " );
               
              foreach( $dataCau as $row )
                {
                  $CausasM[]=array("n"=>$row["n"],"causa"=>$row["causa"]);
                  //echo $row['n']."--". $row['causa']."---";
                  $num[]=$row['n'];
                  $cau[]=$row['causa'];   
              
                }
              

          $FallecG=array();
              $dataGen = sparql_get( 
                "http://localhost:8890/sparql","
                PREFIX dbo: <http://dbpedia.org/ontology/>
        select COUNT(*) as ?m ?genero ?nombregov where{
        ?m <http://xmlns.com/foaf/0.1/gender> ?genero.
        ?m <http://conflictosiria.com/schema/livedIn> ?prov.
        ?prov dbo:province ?nombregov.
        }
                " );

              foreach( $dataGen as $row )
                {
                  $FallecG[]=array("m"=>$row["m"],"genero"=>$row["genero"],"nombregov"=>$row["nombregov"]);
                  //echo $row['n']."--". $row['causa']."---";
                  $numer[]= $row['m'];
                  $gen[]=$row['genero'];

                  $gob[]=$row['nombregov'];            
                }

        ?>

          <div class="services" id="services">
            <div class="container">

              <div class="grid_5 grid_5">
                <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                  <ul id="myTab" class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                      <a href="#expeditions" id="expeditions-tab" role="tab" data-toggle="tab" aria-controls="expeditions" aria-expanded="true">Víctimas</a>
                    </li>
                    <li role="presentation">
                      <a href="#tours" role="tab" id="tours-tab" data-toggle="tab" aria-controls="tours">Ataques</a>
                    </li>
                    <li role="presentation">
                      <a href="#tree" role="tab" id="tree-tab" data-toggle="tab" aria-controls="tree">Cifras en causas de muerte</a>
                    </li>
                    <li role="presentation">
                      <a href="#safari" role="tab" id="safari-tab" data-toggle="tab" aria-controls="safari">Fallecimientos por Gobernaciones</a>
                    </li>
                    
                  </ul>
                  <div id="myTabContent" class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="expeditions" aria-labelledby="expeditions-tab">
                      <div class="col-md-12 col-sm-12 tab-image">
                        <div id="containerC" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
                      </div>
                      
                      <div class="featured-text text-center text-lg-left">
                        <p class="text-black-50 mb-0">Seis años de sufrimiento, desesperación y violencia han vivido millones de sirios. La gran guerra que vive Siria desde marzo de 2011, producto de las agresiones terroristas más sangrientas desde la invasión estadounidense a Iraq y Afganistán, ha dejado más de 450.000 muertos, de acuerdo con cifras de la Organización de Naciones Unidas (ONU). Las cifras recolectadas con las fuentes de informacion (VDC syria, Carter Center) y con una exhaustiva limpieza de datos arrojan 1004 fallecimientos, 998 Desaparecidos y 739 Detenidos, sin tener en cuenta las victimas que no posee nombres o nombres en diferentes idiomas.</p>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="tours" aria-labelledby="tours-tab">
                      <div align="center" class="col-md-12 col-sm-12 tab-image">
                        <div id="containerG" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
                      </div>
                      <div class="featured-text text-center text-lg-left">
                        <p class="text-black-50 mb-0"> Armas prohibidas. Atentados contra civiles arrancados de sus hogares. El país árabe sufre una inacabable contienda civil en la que se entrometen las potencias regionales y globales para apuntalar a cada bando. Cada día se asemeja más a una guerra mundial de baja intensidad. En apariencia al menos, en Siria rige desde diciembre del 2011 una tregua en la que las armas no terminan de callar. Cada una de las Gobernaciones pertenecientes al país Sirio han sioo afectadas por un cantidad extraordinaria de ataques. La Gobernación de Damasco Rural ha sido la mas afectada con  514 ataques registrados</p>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="tree" aria-labelledby="tree-tab">
                      <div class="col-md-5 col-sm-5 tab-image">
                        <div id="containerF" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
                      </div>
                      <div class="featured-text text-center text-lg-left">
                        <p class="text-black-50 mb-0"> El conflicto armado de Siria entra en su quinto año y las cifras de sus consecuencias son devastadoras. Este conflicto, como muchos otros, tiene sus orígenes en la corrupción, en la captura política, en la pobreza, en la violación de derechos humanos. Pero también en la desigualdad. Con las fuentes de información (VDC siria y Carter Ceter) se han registrados 1007 muertes, en el siguiente gráfico se especifíca cada una de las causas de muertes encontradas y el numero de fallecidos respectivamente</p>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="safari" aria-labelledby="safari-tab">
                      <div class="col-md-5 col-sm-5 tab-image">
                        <div id="containerH" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>

                      </div>
                      <div class="featured-text text-center text-lg-left">
                        <p class="text-black-50 mb-0">Pero la injusticia y la desigualdad, que fueron las semillas de este conflicto, no han dejado de estar presentes hasta hoy. Mientras que las distintas partes beligerantes se arman, combaten y bombardean, la población civil vive atemorizada y trata de sobrevivir. Cada una de las gobernaciones ha sido afectada por cada uno de los ataques contra Siria desde 5 años atras. Han fallecido hombres, mujeres y niños/as, que han sido clasificados por género Femenino y Masculino, tal como se muestra en la siguiente figura. </p>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="trekking" aria-labelledby="trekking-tab">
                      <div class="col-md-5 col-sm-5 tab-image">
                        <img src="images/tab-5.jpg" alt="Wanderer">
                      </div>
                      <div class="featured-text text-center text-lg-left">
                        <p class="text-black-50 mb-0">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures.</p>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                  </div>
                </div>
              </div>

              
            </div>
          </div>
            </div>
          
          </div>
          

          <!-- Custom-JavaScript-File-Links -->

          <!-- Supportive-JavaScript --> <script type="text/javascript" src="js/jquery.min.js"></script>
          <!-- Necessary-JS-File-For-Bootstrap --> <script type="text/javascript" src="js/bootstrap.min.js"></script>

          <!-- Banner-Slider-JavaScript -->
          <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
          <script type="text/javascript">

          var chart = Highcharts.chart('containerF', {

              
               title: {
                text: 'Víctimas por causa de muerte'
            },


            xAxis: {
            
                categories: ['<?php echo $cau[0];?>', '<?php echo $cau[1];?>', '<?php echo $cau[2];?>', '<?php echo $cau[3];?>', '<?php echo $cau[4];?>', '<?php echo $cau[5];?>', '<?php echo $cau[6];?>', '<?php echo $cau[7];?>', '<?php echo $cau[8];?>', '<?php echo $cau[9];?>', '<?php echo $cau[10];?>', '<?php echo $cau[11];?>','<?php echo $cau[12];?>']
            },

            series: [{
                type: 'column',
                name: 'Fallecimientos',
                colorByPoint: true,
                data: [<?php echo $num[0];?>, <?php echo $num[1];?>, <?php echo $num[2];?>, <?php echo $num[3];?>, <?php echo $num[4];?>, <?php echo $num[5];?>, <?php echo $num[6];?>, <?php echo $num[7];?>, <?php echo $num[8];?>, <?php echo $num[9];?>, <?php echo $num[10];?>, <?php echo $num[11];?>, <?php echo $num[12];?>],
                showInLegend: false
            }]

        });

                 
          </script>

          <script type="text/javascript">
            Highcharts.chart('containerG', {
                chart: {
                type: 'pie',
                options3d: {
                    enabled: true,
                    alpha: 45,
                    beta: 0
                }
            },
            title: {
                text: 'Numero de ataques por Gobernaciones'
            },
            
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    depth: 35,
                    dataLabels: {
                        enabled: true,
                        format: '{point.name}'
                    }
                }
            },
            series: [{
               type: 'pie',
                name: 'Numero de ataques',
                data: [
                    ['<?php echo $nomGov[0];?>', <?php echo $nume[0];?>],
                    ['<?php echo $nomGov[1];?>', <?php echo $nume[1];?>],
                    {
                        name: '<?php echo $nomGov[2];?>',
                        y: <?php  echo $nume[2];?>,
                        sliced: true,
                        selected: true
                    },
                    ['<?php echo $nomGov[3];?>', <?php echo $nume[3];?>],
                    ['<?php echo $nomGov[4];?>', <?php echo $nume[4];?>],
                    ['<?php echo $nomGov[5];?>', <?php echo $nume[5];?>],
                    ['<?php echo $nomGov[6];?>', <?php echo $nume[6];?>],
                    ['<?php echo $nomGov[7];?>', <?php echo $nume[7];?>],
                    ['<?php echo $nomGov[8];?>', <?php echo $nume[8];?>],
                    ['<?php echo $nomGov[9];?>', <?php echo $nume[9];?>],
                    ['<?php echo $nomGov[10];?>', <?php echo $nume[10];?>],
                    ['<?php echo $nomGov[11];?>', <?php echo $nume[11];?>],
                    ['<?php echo $nomGov[12];?>', <?php echo $nume[12];?>],
                    ['<?php echo $nomGov[13];?>', <?php echo $nume[13];?>]  
                ]
            }]
        });
          </script>

          <script>
            Highcharts.chart('containerC', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: 0,
                plotShadow: false
            },
            title: {
                text: 'Victimas',
                align: 'center',
                verticalAlign: 'middle',
                y: 40
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.2f}%</b>'
            },
            plotOptions: {
                pie: {
                    dataLabels: {
                        enabled: true,
                        distance: -50,
                        style: {
                            fontWeight: 'bold',
                            color: 'white'
                        }
                    },
                    startAngle: -90,
                    endAngle: 90,
                    center: ['50%', '75%']
                }
            },

            series: [{
                type: 'pie',
                name: 'Porcenaje',
                innerSize: '40%',
                data: [
                    ['Fallecidos: <?php echo $vic; ?>',   43.01],
                    ['Desaparecidos: <?php echo $det; ?>',  42.75],
                    ['Detenidos <?php echo $desa; ?>', 31.66],
                    {
                        name: '',
                        y: 0,
                        dataLabels: {
                            enabled: false
                        }
                    }
                  ]
             }]
          });

          </script>




          <script type="text/javascript" >
          Highcharts.chart('containerH', {
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Fallecimientos por Gobernacion'
            },
           
            xAxis: {
              
                categories: ['<?php echo $gob[0]; ?>', '<?php echo $gob[2]; ?>', '<?php echo $gob[4]; ?>', '<?php echo $gob[6]; ?>', '<?php echo $gob[8]; ?>','<?php echo $gob[10]; ?>', '<?php echo $gob[12]; ?>', 
                '<?php echo $gob[14]; ?>', '<?php echo $gob[16]; ?>', '<?php echo $gob[18]; ?>', '<?php echo $gob[20]; ?>', '<?php echo $gob[22]; ?>', '<?php echo $gob[24]; ?>', '<?php echo $gob[26]; ?>'],
                title: {
                    text: null
                }
            },
            yAxis: {
                min: 0,
                title: {
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
            },
            tooltip: {
                valueSuffix: ' '
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -40,
                y: 80,
                floating: true,
                borderWidth: 1,
                backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                shadow: true
            },
            credits: {
                enabled: false
            },
            series: [{
                name: 'Femenino',
                data: [<?php echo $numer[1];?>, <?php echo $numer[3];?>, <?php echo $numer[5];?>, <?php echo $numer[7]; ?>, <?php echo $numer[9]; ?>,<?php echo $numer[11]; ?>, <?php echo $numer[13]; ?>, <?php echo $numer[15]; ?>, <?php echo $numer[17]; ?>, <?php echo $numer[19]; ?>, <?php echo $numer[21]; ?>, <?php echo $numer[23]; ?>, <?php echo $numer[25]; ?>, <?php echo $numer[27]; ?>]
                }, {
                name: 'Masculino',
                data: [<?php echo $numer[0]; ?>, <?php echo $numer[2]; ?>, <?php echo $numer[4]; ?>, <?php echo $numer[6]; ?>, <?php echo $numer[8]; ?>,<?php echo $numer[10]; ?>, <?php echo $numer[12]; ?>, <?php echo $numer[14]; ?>, <?php echo $numer[16]; ?>, <?php echo $numer[18]; ?>, <?php echo $numer[20]; ?>, <?php echo $numer[22]; ?>, <?php echo $numer[24]; ?>, <?php echo $numer[26]; ?>] 
            }]
        });
  </script>

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
  <!-- //Banner-Slider-JavaScript -->

  <!-- Popup-Box-JavaScript -->
  <script src="js/modernizr.custom.97074.js"></script>
  <script src="js/jquery.chocolat.js"></script>
  <script type="text/javascript">
    $(function() {
      $('.gallery-grids a').Chocolat();
    });
  </script>
  <!-- //Popup-Box-JavaScript -->

  <!-- Slide-To-Top JavaScript (No-Need-To-Change) -->
  <script type="text/javascript">
    $(document).ready(function() {
      var defaults = {
        containerID: 'toTop', // fading element id
        containerHoverID: 'toTopHover', // fading element hover id
        scrollSpeed: 100,
        easingType: 'linear'
      };
      $().UItoTop({ easingType: 'easeOutQuart' });
    });
  </script>
  <a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 0;"> </span></a>
  <!-- //Slide-To-Top JavaScript -->

  <!-- Smooth-Scrolling-JavaScript -->
  <script type="text/javascript" src="js/move-top.js"></script>
  <script type="text/javascript" src="js/easing.js"></script>
  <script type="text/javascript">
      jQuery(document).ready(function($) {
        $(".scroll, .navbar li a, .footer li a").click(function(event){
          $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
        });
      });
  </script>
  <!-- //Smooth-Scrolling-JavaScript -->
  
  <!-- FlexSlider-JavaScript -->
  <script defer src="js/jquery.flexslider.js"></script>
  <script type="text/javascript">
    $(function(){
      SyntaxHighlighter.all();
    });
    $(window).load(function(){
      $('.flexslider').flexslider({
        animation: "slide",
        start: function(slider){
          $('body').removeClass('loading');
        }
      });
    });
  </script>

    

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
                <h4 class="text-uppercase m-0">Address</h4>
                <hr class="my-4">
                <div class="small text-black-50">4923 Market Street, Orlando FL</div>
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
                  <a href="#">hello@yourdomain.com</a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4 mb-3 mb-md-0">
            <div class="card py-4 h-100">
              <div class="card-body text-center">
                <i class="fas fa-mobile-alt text-primary mb-2"></i>
                <h4 class="text-uppercase m-0">Phone</h4>
                <hr class="my-4">
                <div class="small text-black-50">+1 (555) 902-8832</div>
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
