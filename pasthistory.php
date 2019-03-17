    <?php
    session_start();
    include_once 'class.MovieCollection.php';
    include_once 'class.Users.php';
    include_once 'class.Rental.php';

    $users_id1 = $_SESSION['users_id'];

    $moviecollection = new MovieCollection();
    $users = new Users();
    $rental = new Rental();

    ?>  
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="Video Hut">
      <meta name="keywords" content="videostore,rent">
      <meta name="author" content="Vanodhya Oshadhi">

      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

      <title> Video Hut - Movie Rental Store </title>

      <style>

      .navbar {
        margin-bottom: 0;
        border-radius: 0;
      }
      footer {
        background-color: #f2f2f2;
        padding: 25px;
      }
      .jumbotron {
        padding: 215px 0px;
      }
      .container-fluid {
        padding: 60px 50px;
      }
      .bg-grey {
        background-color: #f6f6f6;
      }
    </style>
  </head>
  <body id="myPage" data-target=".navbar" data-offset="60" class="bg-light">

   <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Video Hut</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav mr-auto ">

        <li class="nav-item ">
          <a class="nav-link" href="viewmoviecollection.php">View Movie Collection</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="pasthistory.php">Watched / Burrowed Movies</a>
        </li>
      </ul>
      <a class="btn btn-primary btn-xs" href="../logout.php" role="button">Log Out »</a>
    </div>
  </nav>
  
  <div class="jumbotron" style="padding: 63px 0px 20px 68px;background-color:#151719;color:#c2c2c2 ;">
    <br><br><br>
    <div class="" style="padding-left: 5px,padding-right:5px;">
      <h5 class="display-4" style="font-size: 2.5rem;">View Past History
      </h5><br><br>
    </div>
  </div>
  <div class="container" >

    <div class= "col-md-12 order-md-2" >
     <div id="id01" class="album py-5 text-center">

      <table class="table table-hover" >
        <thead class="thead-dark">
          <tr>
            <th>Movie Title</th>
            <th>Video Copy Id</th>
            <th>Burrowed Date</th>
            <th>Expected Return Date</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>         
          <?php

          include_once 'class.Users.php';
          include_once 'class.Rental.php';
          include_once 'class.MovieCollection.php';

          $rental = new Rental();
          $movieCollection = new MovieCollection();
          $users = new Users();

          $viewpasthistory = $rental->viewpasthistory();
          echo "</tbody>
          </table>";
          ?>       
        </div>
      </div>
    </div>

    <div id="footer">
      <?php include'footer.php';?>
    </div>
  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>


</body>
</html>