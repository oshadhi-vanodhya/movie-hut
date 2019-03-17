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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

  <title> Video Hut - Movie Rental Store </title>
  <style>
  .navbar {
    margin-bottom: 0;
    background-color: black;
    border-radius: 0;
  }
  footer {
    background-color: #f2f2f2;
    padding: 25px;
  }
  .jumbotron {
    padding: 215px 0px;
    margin-bottom: 0px;
    background: linear-gradient(45deg, #dfdfdf 0%, #f8f9fa 100%);
    position:absolute;top:0;left:0;height:100%;width:100%;background-position:center top;

  }
  .container-fluid {
    padding: 60px 50px;
  }
  .bg-grey {
    background-color: #f6f6f6;
  }
  .thumbnail {
    padding: 0 0 15px 0;
    border: none;
    border-radius: 0;
  }
  .thumbnail img {
    width: 100%;
    height: 100%;
    margin-bottom: 10px;
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
  @media screen and (max-width: 768px) {
    .col-sm-4 {
      text-align: center;
      margin: 25px 0;
    }
  }
  @import url(//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css);
  tbody > tr {
    cursor: pointer;
  }
  .result{
    margin-top:20px;
  }    </style>
</style>
</head>
<body id="myPage" data-target=".navbar" data-offset="60">

  <script language="javascript" type="text/javascript" src= 'javascript/moviedetail.js' >
  </script>

  <nav class="navbar fixed-top navbar-expand-lg navbar-dark ">
    <a class="navbar-brand" href="#">Video Hut</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav mr-auto ">
        <li class="nav-item ">
          <a class="nav-link" href="#">Home </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#id01">Movie Collection</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="jumbotron">
    <div class="container">
      <h2 class="display-3" style="font-weight: 300;">Welcome, to Video Hut!
      </h2><br>
      <p style="">VideoHut (Pvt) Ltd. is a company which keeps a collection of movies. They mainly maintain English, Sinhala and Tamil movies (while some other languages are also facilitated)

      VideoHut (Pvt) Ltd. is a company which keeps a collection of movies. They mainly maintain English, Sinhala and Tamil movies (while some other languages are also facilitated)</p><br>
      <b>To rent a movie...
      </b>
      <br><br><br>
      <p>
        <a class="btn btn-primary btn-lg" href="../login.php" role="button">Login Now »
        </a>
      </p>
    </div>
    
    <div class="container" >
      <div id="id01" class="album py-4 text-left" style="padding-top: 0;">
       <div id="" class=" py-4 text-center" style="padding-bottom: 0;">
         <form class="" name=searchindex" method="post">
          <div class="row">
            <div class="col-md-7 mb-4">
              <input class="form-control" type="text" id="searchname" name="searchname"  placeholder="Search Movies...">
            </div>
            <div class="col-md-5 mb-4">
              <button class="btn btn-primary btn-lg btn-block" type="submit" name="searchindex">Search Movie
              </button>
            </div>
          </div>
        </form>
      </div>
      <div class="row">
        
        <?php
        
        include_once 'class.MovieCollection.php';
        include_once 'class.Users.php';
        include_once 'class.Rental.php';

        $moviecollection = new MovieCollection();
        $users = new Users();
        $rental = new Rental();

        if (isset($_POST['searchname'])){
          extract($_POST);
          $searchmovie = $moviecollection->searchindex($searchname);
        } 
        else {
          $viewcollection = $moviecollection->viewcollection();
        }
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

<script type="text/javascript">
  function moviedetail2() {
    alert("Sorry! All Copies are burrowed ")
  }
</script>

</body>
</html>