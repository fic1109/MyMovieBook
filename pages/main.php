<?php
require 'config.php';
require 'dbmanage.php';
session_start();
if(isset($_SESSION["username"]))
{
  echo '<html>
        <head>
        <title>MyMoviBook Main</title>
        <meta charset="utf-8">
        <link href="../layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="../layout/scripts/jquery.main.js"></script>
        <style type="text/css">
          input[readonly="readonly"] {
            border:0px;
          }
          textarea { border: none; }
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
                <li><a href="../index.php">Home</a></li>
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
                $link->close();

        echo '</ul>
            </nav>
          </header>
        </div>
        <div class="wrapper row2">
          <div id="breadcrumb" class="hoc clear">
          <ul>
              <li><a href="../index.php">Home</a></li>
              <li><a href="main.php">Main</a></li>
            </ul>
          </div>
        </div>
        <div class="wrapper row3">
          <main class="hoc container clear">
            <div class="content three_quarter">
              <div style="padding: 0px 250px;">
                <form id="formafilm">
                    <label>    
                        <input type="text" id="film" placeholder="Naziv filma">
                    </label>
                    <input type="submit" id="trazi" name="trazi" value="Trazi film!">
                </form>
              </div>
              <div id="MovieInfo" style="padding: 0px 250px;">
                  <form action="unesibazu.php" method="post" name="Opisfilma">
                      <h3>
                      <Label for="Title">Naziv</label>
                      <input type="text"  id="title" name="Title" readonly="readonly">
                      </h3>
                      <Label for="Year">Godina: </Label>
                      <input type="text" id="year" name="Id" readonly="readonly">
                      <Label for="Runtime">Trajanje: </Label>
                      <input type="text" id="runtime" name="Runtime" readonly="readonly">
                      <Label for="Genre">Žanr: </Label>
                      <input type="text" id="genre" n name="Genre" readonly="readonly">
                      <Label for="Directors">Režiser: </Label>
                      <input type="text" id="directors" name="Directors" readonly="readonly">
                      <Label for="Actors">Glumci: </Label>
                      <textarea rows="actors" cols="50" id="actors" name="Actors"></textarea>
                      <Label for="Plot">Opis: </Label>
                      <textarea rows="5" cols="50" id="plot" name="Plot"></textarea>
                      <Label for="language">Jezik: </Label>
                      <input type="text" id="language" name="Language" readonly="readonly">
                      <Label for="poster">Poster: </Label>
                      <input type="image" id="poster" name="Poster" readonly="readonly" alt="Submit">
                      <textarea rows="10" cols="50" id="poster2" name="Poster2" style="display:none;"></textarea>
                      <input type="submit" id="Watched" name="Watched" value="Watched">
                      <input type="submit" id="Wishlist" name="Wishlist" value="Wishlist">
                  </form>
              </div>
            </div>
          <div class="clear"></div>
          </main>
        </div>
        <div class="wrapper row5">
          <div id="copyright" class="hoc clear"> 
            <p class="fl_left">Copyright &copy; 2018 - All Rights Reserved - <a href="../index.php">MyMovieBook</a></p>
            <p class="fl_right">Template by <a target="_blank" href="http://www.os-templates.com/" title="Free Website Templates">OS Templates</a></p>
          </div>
        </div>
        <a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
        <script src="../layout/scripts/jquery.backtotop.js"></script>
        <script src="../layout/scripts/jquery.min.js"></script>
        <script src="../layout/scripts/jquery.mobilemenu.js"></script>\n';
} 
else 
{
  echo 'Please log in first.<br>
        <a href="../index.php">Home</a>\n';
}

?>
