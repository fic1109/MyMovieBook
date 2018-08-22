<?php
require 'config.php';
require 'dbmanage.php';
session_start();
if(isset($_SESSION["username"]))
{
  echo '<html>
        <head>
        <title>MyMoviBook Watched</title>
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
                <li><a href="profile.php">Profile</a></li>';
                $sql = r_admin();
                $result = $link->query($sql);
                $red = $result->fetch_assoc();
                if($red["admin"] == '1'){
                  echo '<li><a href="admin.php">Admin</a></li>';
                }
          echo '</ul>
            </nav>
          </header>
        </div>
        <div class="wrapper row2">
          <div id="breadcrumb" class="hoc clear">
          <ul>
              <li><a href="../index.php">Home</a></li>
              <li><a href="watched.php">Watched List</a></li>
            </ul>
          </div>
        </div>
        <div class="wrapper row3">
          <main style="padding: 25px 150px;">';
            $sql = r_watch();
            $result = $link->query($sql);
            $vrijeme=0;
            if ($result->num_rows > 0) {
                echo '<table style=100%>
                            <tr>
                              <th>Title</th>
                              <th>Year</th>
                              <th>Runtime</th>
                              <th>Genre</th>
                              <th>Director</th>
                              <th>Actors</th>
                              <th>Plot</th>
                              <th>Language</th>
                              <th></th>
                            <tr>';
                while($row = $result->fetch_assoc()) {
                echo '<tr>
                        <td>' . $row["Title"] . '</td>
                        <td>' . $row["Year"] . '</td>
                        <td>' . $row["Runtime"] . '</td>
                        <td>' . $row["Genre"] . '</td>
                        <td>' . $row["Director"] . '</td>
                        <td>' . $row["Actors"] . '</td>
                        <td>' . $row["Plot"] . '</td>
                        <td>' . $row["Language"] . '</td>
                        <td>
                        <form id="obrisi" method="post">
                          <input type="hidden" name="id" value="' . $row["id"] . '" />
                          <input type="submit" name="brisanje" value="Delete">
                        </form>';
                        if(isset($_POST["brisanje"])){
                          $di = $_POST['id'];
                          $sql = delete_row($di);
                          $result = $link->query($sql);
                          echo '<script type="text/javascript">
                                  window.location = "http://localhost/pages/watched.php";
                                </script>';
                        }
 
                  echo '</td>
                      </tr>';
                    $vrijeme += $row["Runtime"];
                }
                echo '<h6>Vrijeme ulozeno na gledanje filmova -> <span style="color: green;">' . round($vrijeme/60, 2) . 'h</span></h6>';
            } else {
                echo "Nema rezultata :(";
            }
            $link->close();
            
    echo ' </main>
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
