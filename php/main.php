<?php
    //Connect to db
    include("databaseConnect.php");

    //Select album queries
    //$query1 = "SELECT * FROM Albums ORDER BY RAND() LIMIT 1";
    $album1 = "SELECT * FROM Albums ORDER BY RAND() LIMIT 1";
    $album2 = "SELECT * FROM Albums ORDER BY RAND() LIMIT 1";
    $album3 = "SELECT * FROM Albums ORDER BY RAND() LIMIT 1";

	if ($album3 == $album2 || $album3 == $album1) {
		$album3 = "SELECT * FROM Albums ORDER BY RAND() LIMIT 1";
	}
	if ($album2 == $album1 || $album2 == $album3) {
		$album2 = "SELECT * FROM Albums ORDER BY RAND() LIMIT 1";
	}

    //Get results from db
    $row1 = mysqli_fetch_row(mysqli_query($databaseConnect, $album1));
    $row2 = mysqli_fetch_row(mysqli_query($databaseConnect, $album2));
    $row3 = mysqli_fetch_row(mysqli_query($databaseConnect, $album3));
  ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset=utf-8>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>uLike - Your Album Review Site</title>
  <!--Style CSS-->
  <link rel="stylesheet" type="text/css" href="../bootstrap/css/style.css">
  <!--jQuery-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!--Icon-->
  <link rel="icon" href="../images/favicon.ico">
  <!-- Bootstrap -->
  <link rel="stylesheet" href="../bootstrap/css/bootstrap2.min.css">
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <!--w3 CSS Icons-->
  <!-- Add icon library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!--Custom JS-->
  <script src="../js/iconBar.js"></script>
  <script src="../js/sidebarOpacity.js"></script>
  <script src="../js/hideShow.js"></script>
</head>
<body id="body">
  <!--Hidden Side Nav-->
  <div id="mySidenav" class="sidenav">
    <div class="row">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    </div>
    <div class="row">
      <a href="main.php">Home</a>
    </div>
    <div class="row">
      <a href="signIn.php">Sign in</a>
    </div>
    <div class="row">
      <a href="register.php">Register</a>
    </div>
  </div>
  <!--Navbar-->
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-1">
          <span style="font-size:30px;cursor:pointer" onclick="openNav()">
          <div type="button" class="btn" id="iconBar">
            <!-- Use any element to open the sidenav -->
            <div onclick="myFunction(this)">
              <span style="font-size:30px;cursor:pointer" onclick="openNav()"></span>
              <div class="bar1"></div>
              <div class="bar2"></div>
              <div class="bar3"></div>
            </div>
          </div>
        </div>
        <div class="col-md-1">
          <div class="navbar-header">
            <a class="navbar-brand" href="main.php">uLike</a>
          </div>
        </div>
        <div class="muteWrapper">
	  <button type="button" onclick="soundOn()" class="btn btn-lg btn-block btn-warning" name="Unmute" id="Unmute">Unmute Sound</button>
	  <button type="button" onclick="soundOff()" class="btn btn-lg btn-block btn-warning" name="Mute" id="Mute">Mute Sound</button>
	</div>
      </div>
    </div>
  </nav>


  <!--THIS IS WHERE ALL CODE GOES-->
  <div id="styled_video_container">
    <img id="mainpic" src="../images/umphreemcgree.jpg" alt="background">
  </div>
<div class="container">
  <div id="main">
    <br>
      <!--Carousel-->
      <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <div class="row">
              <div class="col-md-12">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                  <li data-target="#myCarousel" data-slide-to="1"></li>
                  <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>
                <!-- Wrapper for slides -->
                <div class="carousel-inner">
				<div class="item active">
                    <span class="carousel-center-helper"></span>
					<?php
					  echo "<div class='testWrap'><img class='carousel-image' alt='carousel image' src='data:image/png;base64,".base64_encode($row1[8])."'/>";
					  echo "<div class='album-info'>
						<table class='albumTable'>
							  <tr>
							<td class='albumName'>" . $row1[2] . "</td>
							<td class='albumYear'>" . $row1[4] . "</td>
							  </tr><tr>
							<td class='albumArtist'>" . $row1[3] . "</td>
							<td class='albumGenre'>Genre: " . $row1[5] . "</td>
						  </tr><tr>
							<td colspan='2' class='albumSpotify'><a class='spotifyButton' target='_blank' href='" . $row1[6] . "'>Link to Spotify <img class='spotifyImg' alt='spotify link' src='../images/spotifyLogo.png'></a></td>
						  </tr>
							</table></div></div>";
					?>
					</div>

					<div class="item">
                    <span class="carousel-center-helper"></span>
                    <?php
		  	  echo "<div class='testWrap'><img class='carousel-image' alt='carousel image' src='data:image/png;base64,".base64_encode($row2[8])."'/>";
			  echo "<div class='album-info'>
			  	<table class='albumTable'>
		        	  <tr>
			  	    <td class='albumName'>" . $row2[2] . "</td>
			  	    <td class='albumYear'>" . $row2[4] . "</td>
				  </tr><tr>
			  	    <td class='albumArtist'>" . $row2[3] . "</td>
				    <td class='albumGenre'>Genre: " . $row2[5] . "</td>
				  </tr><tr>
				    <td colspan='2' class='albumSpotify'><a class='spotifyButton' target='_blank' href='" . $row2[6] . "'>Link to Spotify <img class='spotifyImg' alt='spotify link' src='../images/spotifyLogo.png'></a></td>
				  </tr>
		      		</table></div></div>";
			?>
		  </div>

                  <div class="item">
                    <span class="carousel-center-helper"></span>
		     <?php
		  	  echo "<div class='testWrap'><img class='carousel-image' alt='carousel image' src='data:image/png;base64,".base64_encode($row3[8])."'/>";
			  echo "<div class='album-info'>
			  	<table class='albumTable'>
		        	  <tr>
			  	    <td class='albumName'>" . $row3[2] . "</td>
			  	    <td class='albumYear'>" . $row3[4] . "</td>
				  </tr><tr>
			  	    <td class='albumArtist'>" . $row3[3] . "</td>
				    <td class='albumGenre'>Genre: " . $row3[5] . "</td>
				  </tr><tr>
				    <td colspan='2' class='albumSpotify'><a class='spotifyButton' target='_blank' href='" . $row3[6] . "'>Link to Spotify <img class='spotifyImg' alt='spotify link' src='../images/spotifyLogo.png'></a></td>
				  </tr>
		      		</table></div></div>";
//logo
//<td id='logoCell'><img class='logo' src='images/IconGreenBG.png'></td>
			?>
                  </div>
		</div>
                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                  <span class="glyphicon glyphicon-chevron-left"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                  <span class="glyphicon glyphicon-chevron-right"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
            </div>
        </div>
      <br>
		<div class="row">
		<div class="col-md-12">
        <h2 class="reviewHeader">Welcome to uLike!</h2>
		</div>
		</div>
		<br/>
		<div class="row">
		<div class="col-md-6 col-md-offset-3">
		<a class='btn btn-success btn-block' href='signIn.php'>Sign in to view albums and reviews</a>
		</div>
		</div>
      <hr class="mainHR">
      <div id="ulikefeatures">
        <div class="row">
          <div class="col-md-5">
                <img id="iconMain" class="img-rounded center-block" src="../images/IconGreenBG.png" alt="backgroundLogo">
          </div>
        <div class="col-md-7">
          <div class="row">
            <div class="col-md-12">
              <h2>Upload your Favorite Albums</h2>
              <p>Share the albums you love with the uLike community.</p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <h2>Review Albums</h2>
              <p>Review albums you and others have uploaded.</p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <h2>Discover New Music</h2>
              <p>Find new albums and see what others think about them. Discover new music through Spotify.</p>
            </div>
          </div>
        </div>
        </div>
      </div>
  </div>
</div>
<audio preload="auto" loop>
<source src="../images/places.ogg" type="audio/ogg"/>
</audio>
<script src="../js/music.js"></script>
</body>
</html>
