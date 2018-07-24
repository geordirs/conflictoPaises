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
    
    </header>

    <!-- About Section -->
    <section id="about" class="about-section text-center">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 mx-auto">
            <h2 class="text-white mb-4">Reports about Siria</h2>
            <p class="text-white-50">Reportes de la guerra civil de <a href="https://www.unicef.es/causas/emergencias/conflicto-en-siria">Siria</a></p>
          </div>
        </div>
      </div>
    </section>

  <!-- Reports Section -->
  <section id="report">
    <div class="container">
      <div class="row">
        <h5>Seleccione Reporte</h5>
        <form method="POST">
          <select class="form-control" action="action" name="txtType" class="select" method="POST" onchange="this.form.submit();" style="width:150px">
            
            <option selected="">Seleccione</option>
            <option value="fa">Fallecidos</option>
            <option value="det">Detenidos</option>
            <option value="des">Desaparecidos</option>
          </select>
        </form>
        <h5>Genero</h5>
        <form method="POST">
          <select class="form-control" action="action" name="txtType" class="select" method="POST" onchange="this.form.submit();" style="width:150px">
            <option selected="">Seleccione</option>
            <option value="men">Hombre</option>
            <option value="wom">Mujer</option>
          </select>
        </form>
        <h5>Gobernación</h5>
        <form method="POST">
          <select class="form-control" action="action" name="txtType" class="select" method="POST" onchange="this.form.submit();" style="width:150px">
            <option selected="">Seleccione</option>
            <option value="g1">Damasco Rural</option>
            <option value="g2">Aleppo</option>
            <option value="g3">Deir Ezzor</option>
            <option value="g4">Hama</option>
            <option value="g5">Raqqa</option>
            <option value="g6">Hasakeh</option>
            <option value="g7">Damasco</option>
            <option value="g8">Idlib</option>
            <option value="g9">Quneitra</option>
            <option value="g10">Sweida</option>
            <option value="g11">Tartous</option>
            <option value="g12">Lattakia</option>
            <option value="g13">Homs</option>
            <option value="g15">Daraa</option>


          </select>
        </form>
      </div>
    </div>
        <div class="col-lg-12 mx-auto">
          <div class="panel-body">
             <div class="col-lg-12 mx-auto">
               <?php

                if (isset($_POST['txtType'])) {
                  if ( $_POST['txtType'] == 'fa' ){
                          $dataFal = sparql_get( 
                        "http://localhost:8890/sparql","
                        PREFIX dbo: <http://dbpedia.org/ontology/>

                          select ?n ?g ?l ?c ?f ?d where{
                          ?s <http://xmlns.com/foaf/0.1/name> ?n.
                          ?s <http://xmlns.com/foaf/0.1/gender> ?g.
                          ?s <http://conflictosiria.com/schema/livedIn> ?p.
                          ?p dbo:province ?l.
                          ?s <http://conflictosiria.com/schema/registeredIn> ?r.
                          ?r <http://www.w3.org/1999/02/22-rdf-syntax-ns#type>  <http://conflictosiria.com/schema/Decease>.
                          ?r <http://conflictosiria.com/schema/citizenType> ?c.
                          ?r <http://dbpedia.org/ontology/deathDate> ?f.
                          ?r <http://conflictosiria.com/schema/deathCause> ?d.
                          }
                        " );
                          echo "<h4>FALLECIMIENTOS</h4>";
                                            
                          echo  "<table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered' id='example'>";
                          echo  "<thead class='thead-default'>";
                          echo  "<tr>";                              
                          echo  "<th>Nombre</th>";
                          echo  "<th>Genero</th>";
                          echo  "<th>Gobernacion</th>";
                          echo  "<th>Estado</th>";
                          echo  "<th>Fecha Muerte</th>";
                          echo  "<th>Causa</th>";
                                                              
                          echo  "</tr>";
                          echo  "</thead>";
                          echo "<tbody>";
                                              
                    foreach( $dataFal as $row )
                    {
                      echo  "<tr>";
                      foreach( $dataFal->fields() as $field )
                      {
                                                 
                        echo  "<td>$row[$field]</td>";    
                      }
                        echo  "</tr>";
                    }
                    
                    echo "</tbody>";
                    echo  "</table>";   
                                                

                    }elseif ( $_POST['txtType'] == 'wom' ){
                          $dataFal = sparql_get( 
                        "http://localhost:8890/sparql","
                        PREFIX dbo: <http://dbpedia.org/ontology/>

                          select ?n ?g ?l ?c ?f ?d where{
                          ?s <http://xmlns.com/foaf/0.1/name> ?n.
                          ?s <http://xmlns.com/foaf/0.1/gender> ?g.
                          ?s <http://conflictosiria.com/schema/livedIn> ?p.
                          ?p dbo:province ?l.
                          ?s <http://conflictosiria.com/schema/registeredIn> ?r.
                          ?r <http://www.w3.org/1999/02/22-rdf-syntax-ns#type>  ?e.
                          ?r <http://conflictosiria.com/schema/citizenType> ?c.
                          ?r <http://dbpedia.org/ontology/deathDate> ?f.
                          ?r <http://conflictosiria.com/schema/deathCause> ?d.
                          FILTER(regex(?g,'Mujer')) .
                          }
                        " );
                          echo "<h4>FALLECIMIENTOS</h4>";
                                            
                          echo  "<table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered' id='example'>";
                          echo  "<thead class='thead-default'>";
                          echo  "<tr>";                              
                          echo  "<th>Nombre</th>";
                          echo  "<th>Genero</th>";
                          echo  "<th>Gobernacion</th>";
                          echo  "<th>Estado</th>";
                          echo  "<th>Fecha Muerte</th>";
                          echo  "<th>Causa</th>";
                                                              
                          echo  "</tr>";
                          echo  "</thead>";
                          echo "<tbody>";
                                              
                    foreach( $dataFal as $row )
                    {
                      echo  "<tr>";
                      foreach( $dataFal->fields() as $field )
                      {
                                                 
                        echo  "<td>$row[$field]</td>";    
                      }
                        echo  "</tr>";
                    }
                    
                    echo "</tbody>";
                    echo  "</table>";   

                    }
                    elseif ( $_POST['txtType'] == 'men' ){
                          $dataFal = sparql_get( 
                        "http://localhost:8890/sparql","
                        PREFIX dbo: <http://dbpedia.org/ontology/>

                          select ?n ?g ?l ?c ?f ?d where{
                          ?s <http://xmlns.com/foaf/0.1/name> ?n.
                          ?s <http://xmlns.com/foaf/0.1/gender> ?g.
                          ?s <http://conflictosiria.com/schema/livedIn> ?p.
                          ?p dbo:province ?l.
                          ?s <http://conflictosiria.com/schema/registeredIn> ?r.
                          ?r <http://www.w3.org/1999/02/22-rdf-syntax-ns#type>  ?e.
                          ?r <http://conflictosiria.com/schema/citizenType> ?c.
                          ?r <http://dbpedia.org/ontology/deathDate> ?f.
                          ?r <http://conflictosiria.com/schema/deathCause> ?d.
                          FILTER(regex(?g,'Hombre')) .
                          }
                        " );
                          echo "<h4>FALLECIMIENTOS</h4>";
                                            
                          echo  "<table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered' id='example'>";
                          echo  "<thead class='thead-default'>";
                          echo  "<tr>";                              
                          echo  "<th>Nombre</th>";
                          echo  "<th>Genero</th>";
                          echo  "<th>Gobernacion</th>";
                          echo  "<th>Estado</th>";
                          echo  "<th>Fecha Muerte</th>";
                          echo  "<th>Causa</th>";
                                                              
                          echo  "</tr>";
                          echo  "</thead>";
                          echo "<tbody>";
                                              
                    foreach( $dataFal as $row )
                    {
                      echo  "<tr>";
                      foreach( $dataFal->fields() as $field )
                      {
                                                 
                        echo  "<td>$row[$field]</td>";    
                      }
                        echo  "</tr>";
                    }
                    
                    echo "</tbody>";
                    echo  "</table>";   

                    }elseif ( $_POST['txtType'] == 'g1' ){
                          $dataFal = sparql_get( 
                        "http://localhost:8890/sparql","
                        PREFIX dbo: <http://dbpedia.org/ontology/>

                          select ?n ?g ?l ?c ?f ?d where{
                          ?s <http://xmlns.com/foaf/0.1/name> ?n.
                          ?s <http://xmlns.com/foaf/0.1/gender> ?g.
                          ?s <http://conflictosiria.com/schema/livedIn> ?p.
                          ?p dbo:province ?l.
                          ?s <http://conflictosiria.com/schema/registeredIn> ?r.
                          ?r <http://www.w3.org/1999/02/22-rdf-syntax-ns#type>  ?e.
                          ?r <http://conflictosiria.com/schema/citizenType> ?c.
                          ?r <http://dbpedia.org/ontology/deathDate> ?f.
                          ?r <http://conflictosiria.com/schema/deathCause> ?d.
                          FILTER(regex(?l,'Damasco Rural')) .
                          }
                        " );
                          echo "<h4>FALLECIMIENTOS</h4>";
                                            
                          echo  "<table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered' id='example'>";
                          echo  "<thead class='thead-default'>";
                          echo  "<tr>";                              
                          echo  "<th>Nombre</th>";
                          echo  "<th>Genero</th>";
                          echo  "<th>Gobernacion</th>";
                          echo  "<th>Estado</th>";
                          echo  "<th>Fecha Muerte</th>";
                          echo  "<th>Causa</th>";
                                                              
                          echo  "</tr>";
                          echo  "</thead>";
                          echo "<tbody>";
                                              
                    foreach( $dataFal as $row )
                    {
                      echo  "<tr>";
                      foreach( $dataFal->fields() as $field )
                      {
                                                 
                        echo  "<td>$row[$field]</td>";    
                      }
                        echo  "</tr>";
                    }
                    
                    echo "</tbody>";
                    echo  "</table>";   

                    }
                    elseif ( $_POST['txtType'] == 'g2' ){
                          $dataFal = sparql_get( 
                        "http://localhost:8890/sparql","
                        PREFIX dbo: <http://dbpedia.org/ontology/>

                          select ?n ?g ?l ?c ?f ?d where{
                          ?s <http://xmlns.com/foaf/0.1/name> ?n.
                          ?s <http://xmlns.com/foaf/0.1/gender> ?g.
                          ?s <http://conflictosiria.com/schema/livedIn> ?p.
                          ?p dbo:province ?l.
                          ?s <http://conflictosiria.com/schema/registeredIn> ?r.
                          ?r <http://www.w3.org/1999/02/22-rdf-syntax-ns#type>  ?e.
                          ?r <http://conflictosiria.com/schema/citizenType> ?c.
                          ?r <http://dbpedia.org/ontology/deathDate> ?f.
                          ?r <http://conflictosiria.com/schema/deathCause> ?d.
                          FILTER(regex(?l,'Aleppo')) .
                          }
                        " );
                          echo "<h4>FALLECIMIENTOS</h4>";
                                            
                          echo  "<table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered' id='example'>";
                          echo  "<thead class='thead-default'>";
                          echo  "<tr>";                              
                          echo  "<th>Nombre</th>";
                          echo  "<th>Genero</th>";
                          echo  "<th>Gobernacion</th>";
                          echo  "<th>Estado</th>";
                          echo  "<th>Fecha Muerte</th>";
                          echo  "<th>Causa</th>";
                                                              
                          echo  "</tr>";
                          echo  "</thead>";
                          echo "<tbody>";
                                              
                    foreach( $dataFal as $row )
                    {
                      echo  "<tr>";
                      foreach( $dataFal->fields() as $field )
                      {
                                                 
                        echo  "<td>$row[$field]</td>";    
                      }
                        echo  "</tr>";
                    }
                    
                    echo "</tbody>";
                    echo  "</table>";   

                    }
                    elseif ( $_POST['txtType'] == 'g3' ){
                          $dataFal = sparql_get( 
                        "http://localhost:8890/sparql","
                        PREFIX dbo: <http://dbpedia.org/ontology/>

                          select ?n ?g ?l ?c ?f ?d where{
                          ?s <http://xmlns.com/foaf/0.1/name> ?n.
                          ?s <http://xmlns.com/foaf/0.1/gender> ?g.
                          ?s <http://conflictosiria.com/schema/livedIn> ?p.
                          ?p dbo:province ?l.
                          ?s <http://conflictosiria.com/schema/registeredIn> ?r.
                          ?r <http://www.w3.org/1999/02/22-rdf-syntax-ns#type>  ?e.
                          ?r <http://conflictosiria.com/schema/citizenType> ?c.
                          ?r <http://dbpedia.org/ontology/deathDate> ?f.
                          ?r <http://conflictosiria.com/schema/deathCause> ?d.
                          FILTER(regex(?l,'Deir Ezzor')) .
                          }
                        " );
                          echo "<h4>FALLECIMIENTOS</h4>";
                                            
                          echo  "<table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered' id='example'>";
                          echo  "<thead class='thead-default'>";
                          echo  "<tr>";                              
                          echo  "<th>Nombre</th>";
                          echo  "<th>Genero</th>";
                          echo  "<th>Gobernacion</th>";
                          echo  "<th>Estado</th>";
                          echo  "<th>Fecha Muerte</th>";
                          echo  "<th>Causa</th>";
                                                              
                          echo  "</tr>";
                          echo  "</thead>";
                          echo "<tbody>";
                                              
                    foreach( $dataFal as $row )
                    {
                      echo  "<tr>";
                      foreach( $dataFal->fields() as $field )
                      {
                                                 
                        echo  "<td>$row[$field]</td>";    
                      }
                        echo  "</tr>";
                    }
                    
                    echo "</tbody>";
                    echo  "</table>";   

                    }
                    elseif ( $_POST['txtType'] == 'g4' ){
                          $dataFal = sparql_get( 
                        "http://localhost:8890/sparql","
                        PREFIX dbo: <http://dbpedia.org/ontology/>

                          select ?n ?g ?l ?c ?f ?d where{
                          ?s <http://xmlns.com/foaf/0.1/name> ?n.
                          ?s <http://xmlns.com/foaf/0.1/gender> ?g.
                          ?s <http://conflictosiria.com/schema/livedIn> ?p.
                          ?p dbo:province ?l.
                          ?s <http://conflictosiria.com/schema/registeredIn> ?r.
                          ?r <http://www.w3.org/1999/02/22-rdf-syntax-ns#type>  ?e.
                          ?r <http://conflictosiria.com/schema/citizenType> ?c.
                          ?r <http://dbpedia.org/ontology/deathDate> ?f.
                          ?r <http://conflictosiria.com/schema/deathCause> ?d.
                          FILTER(regex(?l,'Hama')) .
                          }
                        " );
                          echo "<h4>FALLECIMIENTOS</h4>";
                                            
                          echo  "<table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered' id='example'>";
                          echo  "<thead class='thead-default'>";
                          echo  "<tr>";                              
                          echo  "<th>Nombre</th>";
                          echo  "<th>Genero</th>";
                          echo  "<th>Gobernacion</th>";
                          echo  "<th>Estado</th>";
                          echo  "<th>Fecha Muerte</th>";
                          echo  "<th>Causa</th>";
                                                              
                          echo  "</tr>";
                          echo  "</thead>";
                          echo "<tbody>";
                                              
                    foreach( $dataFal as $row )
                    {
                      echo  "<tr>";
                      foreach( $dataFal->fields() as $field )
                      {
                                                 
                        echo  "<td>$row[$field]</td>";    
                      }
                        echo  "</tr>";
                    }
                    
                    echo "</tbody>";
                    echo  "</table>";   

                    }
                    elseif ( $_POST['txtType'] == 'g5' ){
                          $dataFal = sparql_get( 
                        "http://localhost:8890/sparql","
                        PREFIX dbo: <http://dbpedia.org/ontology/>

                          select ?n ?g ?l ?c ?f ?d where{
                          ?s <http://xmlns.com/foaf/0.1/name> ?n.
                          ?s <http://xmlns.com/foaf/0.1/gender> ?g.
                          ?s <http://conflictosiria.com/schema/livedIn> ?p.
                          ?p dbo:province ?l.
                          ?s <http://conflictosiria.com/schema/registeredIn> ?r.
                          ?r <http://www.w3.org/1999/02/22-rdf-syntax-ns#type>  ?e.
                          ?r <http://conflictosiria.com/schema/citizenType> ?c.
                          ?r <http://dbpedia.org/ontology/deathDate> ?f.
                          ?r <http://conflictosiria.com/schema/deathCause> ?d.
                          FILTER(regex(?l,'Raqqa')) .
                          }
                        " );
                          echo "<h4>FALLECIMIENTOS</h4>";
                                            
                          echo  "<table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered' id='example'>";
                          echo  "<thead class='thead-default'>";
                          echo  "<tr>";                              
                          echo  "<th>Nombre</th>";
                          echo  "<th>Genero</th>";
                          echo  "<th>Gobernacion</th>";
                          echo  "<th>Estado</th>";
                          echo  "<th>Fecha Muerte</th>";
                          echo  "<th>Causa</th>";
                                                              
                          echo  "</tr>";
                          echo  "</thead>";
                          echo "<tbody>";
                                              
                    foreach( $dataFal as $row )
                    {
                      echo  "<tr>";
                      foreach( $dataFal->fields() as $field )
                      {
                                                 
                        echo  "<td>$row[$field]</td>";    
                      }
                        echo  "</tr>";
                    }
                    
                    echo "</tbody>";
                    echo  "</table>";   

                    }
                    elseif ( $_POST['txtType'] == 'g6' ){
                          $dataFal = sparql_get( 
                        "http://localhost:8890/sparql","
                        PREFIX dbo: <http://dbpedia.org/ontology/>

                          select ?n ?g ?l ?c ?f ?d where{
                          ?s <http://xmlns.com/foaf/0.1/name> ?n.
                          ?s <http://xmlns.com/foaf/0.1/gender> ?g.
                          ?s <http://conflictosiria.com/schema/livedIn> ?p.
                          ?p dbo:province ?l.
                          ?s <http://conflictosiria.com/schema/registeredIn> ?r.
                          ?r <http://www.w3.org/1999/02/22-rdf-syntax-ns#type>  ?e.
                          ?r <http://conflictosiria.com/schema/citizenType> ?c.
                          ?r <http://dbpedia.org/ontology/deathDate> ?f.
                          ?r <http://conflictosiria.com/schema/deathCause> ?d.
                          FILTER(regex(?l,'Hasakeh')) .
                          }
                        " );
                          echo "<h4>FALLECIMIENTOS</h4>";
                                            
                          echo  "<table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered' id='example'>";
                          echo  "<thead class='thead-default'>";
                          echo  "<tr>";                              
                          echo  "<th>Nombre</th>";
                          echo  "<th>Genero</th>";
                          echo  "<th>Gobernacion</th>";
                          echo  "<th>Estado</th>";
                          echo  "<th>Fecha Muerte</th>";
                          echo  "<th>Causa</th>";
                                                              
                          echo  "</tr>";
                          echo  "</thead>";
                          echo "<tbody>";
                                              
                    foreach( $dataFal as $row )
                    {
                      echo  "<tr>";
                      foreach( $dataFal->fields() as $field )
                      {
                                                 
                        echo  "<td>$row[$field]</td>";    
                      }
                        echo  "</tr>";
                    }
                    
                    echo "</tbody>";
                    echo  "</table>";   

                    }
                    elseif ( $_POST['txtType'] == 'g7' ){
                          $dataFal = sparql_get( 
                        "http://localhost:8890/sparql","
                        PREFIX dbo: <http://dbpedia.org/ontology/>

                          select ?n ?g ?l ?c ?f ?d where{
                          ?s <http://xmlns.com/foaf/0.1/name> ?n.
                          ?s <http://xmlns.com/foaf/0.1/gender> ?g.
                          ?s <http://conflictosiria.com/schema/livedIn> ?p.
                          ?p dbo:province ?l.
                          ?s <http://conflictosiria.com/schema/registeredIn> ?r.
                          ?r <http://www.w3.org/1999/02/22-rdf-syntax-ns#type>  ?e.
                          ?r <http://conflictosiria.com/schema/citizenType> ?c.
                          ?r <http://dbpedia.org/ontology/deathDate> ?f.
                          ?r <http://conflictosiria.com/schema/deathCause> ?d.
                          FILTER(regex(?l,'Damasco')) .
                          }
                        " );
                          echo "<h4>FALLECIMIENTOS</h4>";
                                            
                          echo  "<table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered' id='example'>";
                          echo  "<thead class='thead-default'>";
                          echo  "<tr>";                              
                          echo  "<th>Nombre</th>";
                          echo  "<th>Genero</th>";
                          echo  "<th>Gobernacion</th>";
                          echo  "<th>Estado</th>";
                          echo  "<th>Fecha Muerte</th>";
                          echo  "<th>Causa</th>";
                                                              
                          echo  "</tr>";
                          echo  "</thead>";
                          echo "<tbody>";
                                              
                    foreach( $dataFal as $row )
                    {
                      echo  "<tr>";
                      foreach( $dataFal->fields() as $field )
                      {
                                                 
                        echo  "<td>$row[$field]</td>";    
                      }
                        echo  "</tr>";
                    }
                    
                    echo "</tbody>";
                    echo  "</table>";   

                    }
                    elseif ( $_POST['txtType'] == 'g8' ){
                          $dataFal = sparql_get( 
                        "http://localhost:8890/sparql","
                        PREFIX dbo: <http://dbpedia.org/ontology/>

                          select ?n ?g ?l ?c ?f ?d where{
                          ?s <http://xmlns.com/foaf/0.1/name> ?n.
                          ?s <http://xmlns.com/foaf/0.1/gender> ?g.
                          ?s <http://conflictosiria.com/schema/livedIn> ?p.
                          ?p dbo:province ?l.
                          ?s <http://conflictosiria.com/schema/registeredIn> ?r.
                          ?r <http://www.w3.org/1999/02/22-rdf-syntax-ns#type>  ?e.
                          ?r <http://conflictosiria.com/schema/citizenType> ?c.
                          ?r <http://dbpedia.org/ontology/deathDate> ?f.
                          ?r <http://conflictosiria.com/schema/deathCause> ?d.
                          FILTER(regex(?l,'Idlib')) .
                          }
                        " );
                          echo "<h4>FALLECIMIENTOS</h4>";
                                            
                          echo  "<table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered' id='example'>";
                          echo  "<thead class='thead-default'>";
                          echo  "<tr>";                              
                          echo  "<th>Nombre</th>";
                          echo  "<th>Genero</th>";
                          echo  "<th>Gobernacion</th>";
                          echo  "<th>Estado</th>";
                          echo  "<th>Fecha Muerte</th>";
                          echo  "<th>Causa</th>";
                                                              
                          echo  "</tr>";
                          echo  "</thead>";
                          echo "<tbody>";
                                              
                    foreach( $dataFal as $row )
                    {
                      echo  "<tr>";
                      foreach( $dataFal->fields() as $field )
                      {
                                                 
                        echo  "<td>$row[$field]</td>";    
                      }
                        echo  "</tr>";
                    }
                    
                    echo "</tbody>";
                    echo  "</table>";   

                    }
                    elseif ( $_POST['txtType'] == 'g9' ){
                          $dataFal = sparql_get( 
                        "http://localhost:8890/sparql","
                        PREFIX dbo: <http://dbpedia.org/ontology/>

                          select ?n ?g ?l ?c ?f ?d where{
                          ?s <http://xmlns.com/foaf/0.1/name> ?n.
                          ?s <http://xmlns.com/foaf/0.1/gender> ?g.
                          ?s <http://conflictosiria.com/schema/livedIn> ?p.
                          ?p dbo:province ?l.
                          ?s <http://conflictosiria.com/schema/registeredIn> ?r.
                          ?r <http://www.w3.org/1999/02/22-rdf-syntax-ns#type>  ?e.
                          ?r <http://conflictosiria.com/schema/citizenType> ?c.
                          ?r <http://dbpedia.org/ontology/deathDate> ?f.
                          ?r <http://conflictosiria.com/schema/deathCause> ?d.
                          FILTER(regex(?l,'Quneitra')) .
                          }
                        " );
                          echo "<h4>FALLECIMIENTOS</h4>";
                                            
                          echo  "<table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered' id='example'>";
                          echo  "<thead class='thead-default'>";
                          echo  "<tr>";                              
                          echo  "<th>Nombre</th>";
                          echo  "<th>Genero</th>";
                          echo  "<th>Gobernacion</th>";
                          echo  "<th>Estado</th>";
                          echo  "<th>Fecha Muerte</th>";
                          echo  "<th>Causa</th>";
                                                              
                          echo  "</tr>";
                          echo  "</thead>";
                          echo "<tbody>";
                                              
                    foreach( $dataFal as $row )
                    {
                      echo  "<tr>";
                      foreach( $dataFal->fields() as $field )
                      {
                                                 
                        echo  "<td>$row[$field]</td>";    
                      }
                        echo  "</tr>";
                    }
                    
                    echo "</tbody>";
                    echo  "</table>";   

                    }
                    elseif ( $_POST['txtType'] == 'g10' ){
                          $dataFal = sparql_get( 
                        "http://localhost:8890/sparql","
                        PREFIX dbo: <http://dbpedia.org/ontology/>

                          select ?n ?g ?l ?c ?f ?d where{
                          ?s <http://xmlns.com/foaf/0.1/name> ?n.
                          ?s <http://xmlns.com/foaf/0.1/gender> ?g.
                          ?s <http://conflictosiria.com/schema/livedIn> ?p.
                          ?p dbo:province ?l.
                          ?s <http://conflictosiria.com/schema/registeredIn> ?r.
                          ?r <http://www.w3.org/1999/02/22-rdf-syntax-ns#type>  ?e.
                          ?r <http://conflictosiria.com/schema/citizenType> ?c.
                          ?r <http://dbpedia.org/ontology/deathDate> ?f.
                          ?r <http://conflictosiria.com/schema/deathCause> ?d.
                          FILTER(regex(?l,'Sweida')) .
                          }
                        " );
                          echo "<h4>FALLECIMIENTOS</h4>";
                                            
                          echo  "<table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered' id='example'>";
                          echo  "<thead class='thead-default'>";
                          echo  "<tr>";                              
                          echo  "<th>Nombre</th>";
                          echo  "<th>Genero</th>";
                          echo  "<th>Gobernacion</th>";
                          echo  "<th>Estado</th>";
                          echo  "<th>Fecha Muerte</th>";
                          echo  "<th>Causa</th>";
                                                              
                          echo  "</tr>";
                          echo  "</thead>";
                          echo "<tbody>";
                                              
                    foreach( $dataFal as $row )
                    {
                      echo  "<tr>";
                      foreach( $dataFal->fields() as $field )
                      {
                                                 
                        echo  "<td>$row[$field]</td>";    
                      }
                        echo  "</tr>";
                    }
                    
                    echo "</tbody>";
                    echo  "</table>";   

                    }
                    elseif ( $_POST['txtType'] == 'g11' ){
                          $dataFal = sparql_get( 
                        "http://localhost:8890/sparql","
                        PREFIX dbo: <http://dbpedia.org/ontology/>

                          select ?n ?g ?l ?c ?f ?d where{
                          ?s <http://xmlns.com/foaf/0.1/name> ?n.
                          ?s <http://xmlns.com/foaf/0.1/gender> ?g.
                          ?s <http://conflictosiria.com/schema/livedIn> ?p.
                          ?p dbo:province ?l.
                          ?s <http://conflictosiria.com/schema/registeredIn> ?r.
                          ?r <http://www.w3.org/1999/02/22-rdf-syntax-ns#type>  ?e.
                          ?r <http://conflictosiria.com/schema/citizenType> ?c.
                          ?r <http://dbpedia.org/ontology/deathDate> ?f.
                          ?r <http://conflictosiria.com/schema/deathCause> ?d.
                          FILTER(regex(?l,'Tartous')) .
                          }
                        " );
                          echo "<h4>FALLECIMIENTOS</h4>";
                                            
                          echo  "<table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered' id='example'>";
                          echo  "<thead class='thead-default'>";
                          echo  "<tr>";                              
                          echo  "<th>Nombre</th>";
                          echo  "<th>Genero</th>";
                          echo  "<th>Gobernacion</th>";
                          echo  "<th>Estado</th>";
                          echo  "<th>Fecha Muerte</th>";
                          echo  "<th>Causa</th>";
                                                              
                          echo  "</tr>";
                          echo  "</thead>";
                          echo "<tbody>";
                                              
                    foreach( $dataFal as $row )
                    {
                      echo  "<tr>";
                      foreach( $dataFal->fields() as $field )
                      {
                                                 
                        echo  "<td>$row[$field]</td>";    
                      }
                        echo  "</tr>";
                    }
                    
                    echo "</tbody>";
                    echo  "</table>"; 
                    }
                    elseif ( $_POST['txtType'] == 'g12' ){
                          $dataFal = sparql_get( 
                        "http://localhost:8890/sparql","
                        PREFIX dbo: <http://dbpedia.org/ontology/>

                          select ?n ?g ?l ?c ?f ?d where{
                          ?s <http://xmlns.com/foaf/0.1/name> ?n.
                          ?s <http://xmlns.com/foaf/0.1/gender> ?g.
                          ?s <http://conflictosiria.com/schema/livedIn> ?p.
                          ?p dbo:province ?l.
                          ?s <http://conflictosiria.com/schema/registeredIn> ?r.
                          ?r <http://www.w3.org/1999/02/22-rdf-syntax-ns#type>  ?e.
                          ?r <http://conflictosiria.com/schema/citizenType> ?c.
                          ?r <http://dbpedia.org/ontology/deathDate> ?f.
                          ?r <http://conflictosiria.com/schema/deathCause> ?d.
                          FILTER(regex(?l,'Lattakia')) .
                          }
                        " );
                          echo "<h4>FALLECIMIENTOS</h4>";
                                            
                          echo  "<table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered' id='example'>";
                          echo  "<thead class='thead-default'>";
                          echo  "<tr>";                              
                          echo  "<th>Nombre</th>";
                          echo  "<th>Genero</th>";
                          echo  "<th>Gobernacion</th>";
                          echo  "<th>Estado</th>";
                          echo  "<th>Fecha Muerte</th>";
                          echo  "<th>Causa</th>";
                                                              
                          echo  "</tr>";
                          echo  "</thead>";
                          echo "<tbody>";
                                              
                    foreach( $dataFal as $row )
                    {
                      echo  "<tr>";
                      foreach( $dataFal->fields() as $field )
                      {
                                                 
                        echo  "<td>$row[$field]</td>";    
                      }
                        echo  "</tr>";
                    }
                    
                    echo "</tbody>";
                    echo  "</table>";   

                    }
                    elseif ( $_POST['txtType'] == 'g13' ){
                          $dataFal = sparql_get( 
                        "http://localhost:8890/sparql","
                        PREFIX dbo: <http://dbpedia.org/ontology/>

                          select ?n ?g ?l ?c ?f ?d where{
                          ?s <http://xmlns.com/foaf/0.1/name> ?n.
                          ?s <http://xmlns.com/foaf/0.1/gender> ?g.
                          ?s <http://conflictosiria.com/schema/livedIn> ?p.
                          ?p dbo:province ?l.
                          ?s <http://conflictosiria.com/schema/registeredIn> ?r.
                          ?r <http://www.w3.org/1999/02/22-rdf-syntax-ns#type>  ?e.
                          ?r <http://conflictosiria.com/schema/citizenType> ?c.
                          ?r <http://dbpedia.org/ontology/deathDate> ?f.
                          ?r <http://conflictosiria.com/schema/deathCause> ?d.
                          FILTER(regex(?l,'Homs')) .
                          }
                        " );
                          echo "<h4>FALLECIMIENTOS</h4>";
                                            
                          echo  "<table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered' id='example'>";
                          echo  "<thead class='thead-default'>";
                          echo  "<tr>";                              
                          echo  "<th>Nombre</th>";
                          echo  "<th>Genero</th>";
                          echo  "<th>Gobernacion</th>";
                          echo  "<th>Estado</th>";
                          echo  "<th>Fecha Muerte</th>";
                          echo  "<th>Causa</th>";
                                                              
                          echo  "</tr>";
                          echo  "</thead>";
                          echo "<tbody>";
                                              
                    foreach( $dataFal as $row )
                    {
                      echo  "<tr>";
                      foreach( $dataFal->fields() as $field )
                      {
                                                 
                        echo  "<td>$row[$field]</td>";    
                      }
                        echo  "</tr>";
                    }
                    
                    echo "</tbody>";
                    echo  "</table>";   

                    }
                    elseif ( $_POST['txtType'] == 'g14' ){
                          $dataFal = sparql_get( 
                        "http://localhost:8890/sparql","
                        PREFIX dbo: <http://dbpedia.org/ontology/>

                          select ?n ?g ?l ?c ?f ?d where{
                          ?s <http://xmlns.com/foaf/0.1/name> ?n.
                          ?s <http://xmlns.com/foaf/0.1/gender> ?g.
                          ?s <http://conflictosiria.com/schema/livedIn> ?p.
                          ?p dbo:province ?l.
                          ?s <http://conflictosiria.com/schema/registeredIn> ?r.
                          ?r <http://www.w3.org/1999/02/22-rdf-syntax-ns#type>  ?e.
                          ?r <http://conflictosiria.com/schema/citizenType> ?c.
                          ?r <http://dbpedia.org/ontology/deathDate> ?f.
                          ?r <http://conflictosiria.com/schema/deathCause> ?d.
                          FILTER(regex(?l,'Daraa')) .
                          }
                        " );
                          echo "<h4>FALLECIMIENTOS</h4>";
                                            
                          echo  "<table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered' id='example'>";
                          echo  "<thead class='thead-default'>";
                          echo  "<tr>";                              
                          echo  "<th>Nombre</th>";
                          echo  "<th>Genero</th>";
                          echo  "<th>Gobernacion</th>";
                          echo  "<th>Estado</th>";
                          echo  "<th>Fecha Muerte</th>";
                          echo  "<th>Causa</th>";
                                                              
                          echo  "</tr>";
                          echo  "</thead>";
                          echo "<tbody>";
                                              
                    foreach( $dataFal as $row )
                    {
                      echo  "<tr>";
                      foreach( $dataFal->fields() as $field )
                      {
                                                 
                        echo  "<td>$row[$field]</td>";    
                      }
                        echo  "</tr>";
                    }
                    
                    echo "</tbody>";
                    echo  "</table>";   

                    }
                    elseif ( $_POST['txtType'] == 'det' ){
                      $dataDet = sparql_get( 
                        "http://localhost:8890/sparql","
                        PREFIX dbo: <http://dbpedia.org/ontology/>
                    select ?n ?g ?f ?l ?c where{
                    ?s <http://xmlns.com/foaf/0.1/name> ?n.
                    ?s <http://xmlns.com/foaf/0.1/gender> ?g.
                    ?s <http://conflictosiria.com/schema/livedIn> ?p.
                    ?p dbo:province ?l.
                    ?s <http://conflictosiria.com/schema/registeredIn> ?r.
                    ?r <http://www.w3.org/1999/02/22-rdf-syntax-ns#type> <http://conflictosiria.com/schema/Detention>.
                    ?r <http://dbpedia.org/ontology/arrestDate> ?f.
                    ?r <http://conflictosiria.com/schema/criminalRecord> ?c.
                    }
                        " );
                      echo "<h4>DETENCIONES</h4>";
                                                
                      echo  "<table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered' id='example'>";
                      echo  "<thead class='thead-default'>";
                      echo  "<tr>";                              
                      echo  "<th>Nombre</th>";
                      echo  "<th>Genero</th>";
                      echo  "<th>Fecha Detencion</th>";
                      echo  "<th>Governacion</th>";
                      echo  "<th>Antecedentes</th>";                                
                      echo  "</tr>";
                      echo  "</thead>";
                      echo "<tbody>";
                                              
                        foreach( $dataDet as $row )
                        {
                          echo  "<tr>";
                          foreach( $dataDet-> fields() as $field )
                          {                            
                            echo  "<td>".$row[utf8_encode($field)]."</td>";    
                          }
                            echo  "</tr>";
                        }
                          echo "</tbody>";
                          echo  "</table>";

                  } elseif ( $_POST['txtType'] == 'des' ){
                        
                    $dataDes = sparql_get( 
                      "http://localhost:8890/sparql","
                      PREFIX dbo: <http://dbpedia.org/ontology/> 
                  select ?n ?g ?f ?e ?l where{
                  ?s <http://xmlns.com/foaf/0.1/name> ?n.
                  ?s <http://conflictosiria.com/schema/registeredIn> ?r.
                  ?s <http://xmlns.com/foaf/0.1/gender> ?g.
                  ?s <http://conflictosiria.com/schema/livedIn> ?p.
                  ?p dbo:province ?l.
                  ?r <http://www.w3.org/1999/02/22-rdf-syntax-ns#type> <http://conflictosiria.com/schema/Disapperance>.
                  ?r <http://conflictosiria.com/schema/disapperanceDate> ?f.
                  ?r <http://conflictosiria.com/schema/foundDate> ?e.
                  }
                      " );
                    echo "<h4>DESAPARICIONES</h4>";
                     
                    echo  "<table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered' id='example'>";

                    echo  "<thead class='thead-default'>";
                    echo  "<tr>";                              
                    echo  "<th>Nombre</th>";
                    echo  "<th>Genero</th>";
                    echo  "<th>Fecha Desaparecido</th>";
                    echo  "<th>Fecha Encontrado</th>";
                    echo  "<th>Gobernacion</th>";
                                                      
                    echo  "</tr>";
                    echo  "</thead>";
                    echo "<tbody>";
                                            
                    foreach( $dataDes as $row )
                    {
                      echo  "<tr>";
                      foreach( $dataDes->fields() as $field )
                      {
                                               
                          echo  "<td>$row[$field]</td>";    
                      }
                        echo  "</tr>";
                    }
                      echo "</tbody>";
                      echo  "</table>";

                 }
                }

              ?>

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
  <script >

  $(document).ready(function() {
        $('#example').DataTable( {
        } );
    } );
  </script>


    <!-- Footer -->
    <footer class="bg-black small text-center text-white-50">
      <div class="container">
        Copyright &copy; Conflicto entre países
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

    <script src="js/table.js"></script>
    <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>

    <script src="vendor/datatables/dataTables.bootstrap.js"></script>
    <link href="vendor/datatables/dataTables.bootstrap.css" rel="stylesheet" media="screen">

  </body>

</html>
