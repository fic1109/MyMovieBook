<?php
require 'config.php';
require 'dbmanage.php';
session_start();
$sql = r_admin();
$result = $link->query($sql);
$red = $result->fetch_assoc();
if(isset($_SESSION["username"]) && $red["admin"] == '1')
{
  echo '<html>
        <head>
        <title>MyMoviBook Admin</title>
        <meta charset="utf-8">
        <link href="../layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="../layout/scripts/jquery.main.js"></script>
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
                <li><a href="profile.php">Profile</a></li>
                <li><a href="admin.php">Admin</a></li>
              </ul>
            </nav>
          </header>
        </div>
        <div class="wrapper row2">
          <div id="breadcrumb" class="hoc clear">
          <ul>
              <li><a href="../index.php">Home</a></li>
              <li><a href="admin.php">Admin</a></li>
            </ul>
          </div>
        </div>
        <div class="wrapper row3">
          <main style="padding: 25px 150px;">';
            $sql = r_user();
            $result = $link->query($sql);
            $broj_korisnika=0;
            if ($result->num_rows > 0) {
                echo '<table style=100%>
                            <tr>
                              <th>Id</th>
                              <th>Username</th>
                              <th>Napravljeno</th>
                              <th>Admin</th>
                              <th></th>
                            <tr>';
                while($row = $result->fetch_assoc()) {
                echo '<tr>
                        <td>' . $row["id"] . '</td>
                        <td>' . $row["username"] . '</td>
                        <td>' . $row["created_at"] . '</td>
                        <td>
                          ' . $row["admin"] . '
                          <form id="mijenjanje" method="post">
                          <input type="hidden" name="admin" value="' . $row["admin"] . '" />
                          <input type="hidden" name="id" value="' . $row["id"] . '" />
                          <input type="submit" name="promijeni" value="Promijeni">
                        </form>';
                        if(isset($_POST["promijeni"])){
                          $adm = $_POST['admin'];
                          $idd = $_POST['id'];
                          if($adm == 1){
                            $admin_br = 0;
                          }
                          else $admin_br = 1;
                          $ad = promijeni_admin($admin_br, $idd);
                          $rezulatat = $link->query($ad); 
                          echo '<script type="text/javascript">
                                  window.location = "http://localhost/pages/admin.php";
                                </script>';
                        }
                       echo  '</td>
                        <td>
                        <form id="obrisi" method="post">
                          <input type="hidden" name="id" value="' . $row["id"] . '" />
                          <input type="submit" name="brisanje" value="Delete">
                        </form>';
                        if(isset($_POST["brisanje"])){
                          $di = $_POST['id'];
                          $sql = delete_row_user($di);
                          $result = $link->query($sql); //brisi korisnika
                          $sq = find($di);
                          $reza = $link->query($sq);
                          $red = $reza->fetch_assoc();
                          $kor = $red["username"];
                          $s = e_movies($kor);
                          $rez = $link->query($s);
                          echo '<script type="text/javascript">
                                  window.location = "http://localhost/pages/admin.php";
                                </script>';
                        }
 
                  echo '</td>
                      </tr>';
                    $broj_korisnika++;
                }
                echo '<h6>Trenutni broj korisnika-> <span style="color: green;">' . $broj_korisnika . '</span></h6>';
            } else {
                echo "Nema rezultata :(";
            }
            $link->close();
            
    echo ' </main>
          <div class="clear"></div>
        </div>
        <div style="position: fixed; bottom: 0px; width: 100%;">
          <div id="copyright" class="hoc clear"> 
            <p class="fl_left">Copyright &copy; 2018 - All Rights Reserved - <a href="../index.php">MyMovieBook</a></p>
            <p class="fl_right">Template by <a target="_blank" href="http://www.os-templates.com/" title="Free Website Templates">OS Templates</a></p>
          </div>
        </div>
        <a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
        <script src="../layout/scripts/jquery.backtotop.js"></script>
        <script src="../layout/scripts/jquery.min.js"></script>
        <script src="../layout/scripts/jquery.mobilemenu.js"></script>';
} 
else 
{
  echo 'YOU SHALL NOT PASS!<br>
        Molimo vas odite u vaš dozvoljeni dio. Hvala :D
        <a href="main.php">Dozvoljeni dio!</a>\n';
}

?>
