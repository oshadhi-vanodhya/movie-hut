<?php
session_start();
include_once 'class.MovieCollection.php';
include_once 'class.Users.php';
include_once 'class.Rental.php';

$users_id = $_SESSION['users_id'];

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
  
<!-- Font Awesome Icon Library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

  <title> Video Hut - Movie Rental Store </title>
  <style>

  .navbar {
    margin-bottom: 0;
    border-radius: 0;
  }
  .checked {
  color: orange;
  }
  
  footer {
    background-color: #f2f2f2;
    padding: 25px;
  }
  .jumbotron1 {
    padding: 215px 0px;
  }
  .container-fluid {
    padding: 60px 50px;
  }
  .bg-grey {
    background-color: #f6f6f6;
  }
  .item h4 {
    font-size: 19px;
    line-height: 1.375em;
    font-weight: 400;
    font-style: italic;
    margin: 70px 0;
  }
  .item span {
    font-style: normal;
  }
  .panel-footer {
    background-color: white !important;
  }
  .panel-footer h3 {
    font-size: 32px;
  }
  .panel-footer h4 {
    color: #aaa;
    font-size: 14px;
  }
  .panel-footer .btn {
    margin: 15px 0;
    background-color: #f4511e;
    color: #fff;
  }
  @media screen and (max-width: 768px) {
    .col-sm-4 {
      text-align: center;
      margin: 25px 0;
    }
  }

  * {
    box-sizing: border-box;
  }

  #searchname {
    background-image: url('images/searchicon.png');
    background-position: 10px 12px;
    background-repeat: no-repeat;
    width: 100%;
    font-size: 16px;
    padding: 25px 20px 25px 40px;
    border: 1px solid #ddd;
    margin-bottom: 12px;
  }

  #category {padding: 0.7rem 1.75rem 0.7rem .75rem;
    height:auto; }

  </style>
</head>

<body id="myPage" data-target=".navbar" data-offset="60">

  <script language="javascript" type="text/javascript" src= 'javascript/moviedetail.js' >
  </script>

  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Video Hut</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon">
      </span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav mr-auto ">

        <li class="nav-item active">
          <a class="nav-link" href="viewmoviecollection.php">View Movie Collection</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="pasthistory.php">Watched / Burrowed Movies</a>
        </li>
      </ul>
      <a class="btn btn-primary btn-xs" href="../logout.php" role="button">Log Out »</a>

    </div>
  </nav>

  <div class="jumbotron" style="padding: 63px 0px 20px 68px;background-color:#151719;color:#c2c2c2 ;margin-bottom:0px;"><br>
    <div class="" style="padding-left: 5px,padding-right:5px;">
      <h5 class="display-4" style="font-size: 2.5rem;"><br>Our Movie Collection</h5><br><br><br>     
    </div>
  </div>
  <div class="jumbotron">
    <div class="container" ><br>

     <div id="" class=" py-5 text-center" style="padding-bottom: 0;">
       <form class="" name=searchmovie" method="post">
        <div class="row">
          <div class="col-md-7 mb-4">
            <input class="form-control" type="text" id="searchname" name="searchname" required placeholder="Search Movies...">
          </div>
          <div class="col-md-5 mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit" name="searchmovie">Search Movie
            </button>
          </div>
        </div>
      </form>

      <form class="" method="post" action="">

        <div class="row">
          <div class="col-md-8 mb-4" >
            <select class="custom-select d-block w-100" id="category" name="category" required >
              <option value="movie_id" checked>Choose...</option>
              <option value="language">Sort by Language</option>
              <option value="year">Sort by Year</option>
            </select>
          </div>
          <div class="col-md-4 mb-4" style="padding-left: 0px;">
           <button class=" btn btn-outline-secondary btn-lg btn-block" type="submit">Sort</button>                  
         </div>
       </div>
     </form>

   </div>
   
   <div class="py-4 text-left" style="padding-top: 0;">      
     <br>
     <div class="row">

      <?php

      include_once 'class.MovieCollection.php';
      include_once 'class.Users.php';
      include_once 'class.Rental.php';

      $users_id = $_SESSION['users_id'];

      $moviecollection = new MovieCollection();
      $users = new Users();
      $rental = new Rental();

      if (isset($_POST['searchmovie'])){
        extract($_POST);
        $searchmovie = $moviecollection->searchmovie($searchname);
      } elseif 

      (isset($_POST['category'])  ) {
        extract($_POST);
        $_SESSION['category']=$category;
        $viewcollection = $moviecollection->viewcollectionnew();      
      } else {
        $viewcollection = $moviecollection->viewcollectionnew();
      }

      echo "  </div>
      <br>";
      
      if (isset($_POST["submit"])) {
        extract($_POST);
        $createrental = $moviecollection->createrental($movie_id,$qtyAvailable,$qtyRented);
      } 
      echo "</div>";
      ?> 

    </div>
  </div>
  <div id="footer">
    <?php include'footer.php'; 
    ?>
  </div>
</div>
</div>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

<script type="text/javascript">
  function moviedetail2() {
    alert("Sorry! All Copies are burrowed ")
  }
</script>

</body>
</html>