<?php
require 'config.php';
require 'dbmanage.php';
session_start();
if(isset($_SESSION["username"]))
{
  echo '<html>
        <head>
          <title>MyMoviBook Profile</title>
          <meta charset="utf-8">
          <link href="../layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
          <script src="../layout/scripts/jquery.main.js"></script>
          <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
          <script type="text/javascript">
          // Load google charts
          google.charts.load("current", {"packages":["corechart"]});
          google.charts.setOnLoadCallback(drawChart);
          // Draw the chart and set the chart values
          function drawChart() {
            var data = google.visualization.arrayToDataTable([
              ["Genre", "Broj"],';
              /*$graf = izrada_grafa();
              $rezultati_g = $link->query($graf);
              while ($red_g = mysqli_fetch_array($rezultati_g)) {
                echo '["' . $red_g["Genre"] . '", ' . $red_g["number"] . '],';
              }*/
              $graf = izrada_grafad();
              $rezultati_g = $link->query($graf);
              while ($red_g = mysqli_fetch_array($rezultati_g)) {
                $polje = explode(', ', $red_g["Genre"]);
                $z = count($polje);
                foreach ($polje as $bla) {
                  $zanrovi_sve[] = $bla;
                }
              }
              sort($zanrovi_sve);
              for($i = 0; $i < count($zanrovi_sve); $i++){
                $flag = 0;
                if($i==0){
                  $zanrovi_sort[0][0] = $zanrovi_sve[$i];
                  $zanrovi_sort[0][1] = 1;

                }
                elseif($flag==0){
                  $k = count($zanrovi_sort);
                  for ($j=0; $j < $k ; $j++) {
                    if($zanrovi_sort[$j][0] == $zanrovi_sve[$i]){
                      $zanrovi_sort[$j][1]++;
                      $flag=1;
                    }
                  }
                  if ($flag==0) {
                      $zanrovi_sort[$k][0] = $zanrovi_sve[$i];
                      $zanrovi_sort[$k][1] = 1;
                    }
                }  
              }
              foreach ($zanrovi_sort as $key) {
                echo '["' . $key[0] . '", ' . $key[1] . '],';
              }

          echo ']);
            // Optional; add a title and set the width and height of the chart
            var options = {"title":"Žanrovi filmova", "width":1000, "height":900};
            // Display the chart inside the <div> element with id="piechart"
            var chart = new google.visualization.PieChart(document.getElementById("piechart"));
            chart.draw(data, options);
          }
          </script>
          <style type="text/css">
            .boja {
              color: green;
            }
          </style>
        </head>
        </html>
        <body id="top">
        <div class="wrapper row0">
          <div id="topbar" class="hoc clear">
            <div class="fl_left">
              <ul>
                <li><i class="fa fa-envelope-o"></i> fbozicev@riteh.hr</li>
              </ul>
            </div>
            <div class="fl_right">
              <ul>
                <li><a href="logout.php">Logout</a></li>
                <li>' . $_SESSION["username"] . '</li>
              </ul>
            </div>
          </div>
        </div>
        </body>
        <div class="wrapper row1">
          <header id="header" class="hoc clear">
            <div id="logo"> 
              <h1><a href="../index.php">My movie book</a></h1>
            </div>
            <nav id="mainav" class="clear"> 
              <ul class="clear">
                <li><a href="main.php">Main</a></li>
                <li><a href="watched.php">Watched list</a></li>
                <li><a href="wishlist.php">Wishlist</a></li>
                <li><a href="newsfeed.php">Newsfeed</a></li>
                <li><a href="profile.php">Profile</a></li>';
                $sql = r_admin();
                $result = $link->query($sql);
                $red = $result->fetch_assoc();
                if($red["admin"] == '1'){
                  echo '<li><a href="admin.php">Admin</a></li>';
                }
          echo '
              </ul>
            </nav>
          </header>
        </div>
        <div class="wrapper row2">
          <div id="breadcrumb" class="hoc clear">
          <ul>
              <li><a href="../index.php">Home</a></li>
              <li><a href="profile.php">Profile</a></li>
            </ul>
          </div>
        </div>
        <div class="wrapper row3">
          <main class="hoc container clear">
            <h1><b>Profil</b></h1>
            <div class="content">
              <h5>
              Korisnik-> <span class="boja">'. $_SESSION["username"] .'</span> <br>
              Račun je napravljen dana-> '; 
              $izrada = izrada_racuna();
              $rezultati = $link->query($izrada);
              $red = $rezultati->fetch_assoc();
              $datum = date_parse($red["created_at"]);
              echo '<span class="boja">' . $datum['day'] . '-' . $datum['month'] . '-' . $datum['year'] . '</span><br>';

              $citanje_p = r_watch();
              $rezultati_p = $link->query($citanje_p);
              $vrijeme_p=0;
              if ($rezultati_p->num_rows > 0) {
                while($row_p = $rezultati_p->fetch_assoc()) {
                    $vrijeme_p += $row_p["Runtime"];
                }
              }
              $citanje_z = r_wish();
              $rezultati_z = $link->query($citanje_z);
              if ($rezultati_z->num_rows > 0) {
                while($row_z = $rezultati_z->fetch_assoc()) {
                    $vrijeme_z += $row_z["Runtime"];
                }
              }
              echo 'Broj pogledanih filmova-> <span class="boja">' . $rezultati_p->num_rows . '</span> Vrijeme uloženo-> <span class="boja">' . round($vrijeme_p/60, 2) .'h</span><br> Broj filmova za pogledati-> <span class="boja">' .  $rezultati_z->num_rows . '</span> Vrijeme potrebno-> <span class="boja">' . round($vrijeme_z/60, 2) . 'h</span><br>';
              
              $link->close();
          echo '</h5></div>
          <div id="piechart"></div>
          </main>
          <div class="clear"></div>
        </div>
        <a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
        <script src="../layout/scripts/jquery.backtotop.js"></script>
        <script src="../layout/scripts/jquery.min.js"></script>
        <script src="../layout/scripts/jquery.mobilemenu.js"></script>';
} 
else 
{
  echo 'Please log in first.<br>
        <a href="../index.php">Home</a>\n';
}

?>
