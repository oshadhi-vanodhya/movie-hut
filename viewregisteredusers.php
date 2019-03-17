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
  .form-control {
    background-image: url(images/searchicon.png);
    background-position: 10px 12px;
    background-repeat: no-repeat;
    width: 100%;
    font-size: 16px;
    padding: 23px 20px 23px 40px;
    border: 1px solid #ddd;
    margin-bottom: 12px;
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
  .panel {
    border: 1px solid #f4511e; 
    border-radius:0 !important;
    transition: box-shadow 0.5s;
  }
  .panel:hover {
    box-shadow: 5px 0px 40px rgba(0,0,0, .2);
  }
  .panel-footer .btn:hover {
    border: 1px solid #f4511e;
    background-color: #fff !important;
    color: #f4511e;
  }
  .panel-heading {
    color: #fff !important;
    background-color: #f4511e !important;
    padding: 25px;
    border-bottom: 1px solid transparent;
    border-top-left-radius: 0px;
    border-top-right-radius: 0px;
    border-bottom-left-radius: 0px;
    border-bottom-right-radius: 0px;
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

</style>


</head>
<body id="myPage" data-target=".navbar" data-offset="60" class="bg-light">

 <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Admin Panel</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto ">
      <li class="nav-item active">
        <a class="nav-link" href="#">Registered Users <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Rentals</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="rentalsall.php">Rentals - All</a>
        </div>
      </li>

    </ul>
   <a class="btn btn-primary btn-xs" href="../logout.php" role="button">Log Out »</a>

  </div>
</nav>

<br><br>
<div class="jumbotron" style="padding: 63px 0px 20px 68px;">
  <div class="" style="padding-left: 5px,padding-right:5px;">
    <h5 class="display-4" style="font-size: 2.5rem;">View Registered Users</h5><br>
  </div>
</div>
<div class="container" >

 <div id="" class=" py-5 text-center">
   <form class="" name=searchuser" method="post">
    <div class="row">
      <div class="col-md-7 mb-4">
        <input class="form-control" type="text" id="searchname" name="searchname" required placeholder="Search users by username or first name...">
      </div>
      <div class="col-md-5 mb-4">
        <button class="btn btn-primary btn-lg btn-block" type="submit" name="searchuser">Search
        </button>
      </div>
    </div>
  </form>

  <?php
  include_once 'class.Users.php';
  
  $users = new Users();

  echo "</tbody></table>";

  if (isset($_POST['searchuser'])){
    extract($_POST);
    $searchuser = $users->searchuser($searchname);
  }

  ?>
 
</div>

<div class= "col-md-12 order-md-2" >
  <h3>All Registered Users</h3>
  <div id="id01" class="album py-5 text-center">

    <table class="table table-hover" >

      <thead class="thead-dark">
        <tr ">
          <th>ID</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
          <th>Date of Birth</th>
          <th>Phone Number</th>
          <th>Block Status</th>
        </tr>
      </thead>
      <tbody>         
        <?php

        include_once 'class.Users.php';
        
        $users = new Users();

        $viewregisteredusers = $users->viewregisteredusers();

        if (isset($_POST['submit'])){
          extract($_POST);

          $blacklistuser = $users->blacklistuser($users_id,$isMember);
          if ($blacklistuser ) {
            // Create Account Successful

            echo "<script type='text/javascript'>alert('User Permissions changed sucessfully!');</script>";
            
          } else {
            // Save Session Successful
            echo 'Error in changing permissions';
          }
        }
        ?>       
        
      </div>
    </div>
    <div class="py-4 text-center">
      <div class="">
        <div class="col-md-12 order-md-1">

          <h2 class="d-flex justify-content-between align-items-center mb-4">Block User </h2>
          <div class="jumbotron" style="padding: 10% 10%;">

            <form class="" action="" method="post" name="blacklistuser">
              <div class="row">
                <div class="col-md-6 mb-4">
                  <label for="users_id">Enter Users ID</label>
                  <input type="text" class="form-control" id="users_id" name="users_id" placeholder="" value="" required>
                </div>

                <div class="col-md-6 mb-3">
                  <label for="isMember">Blocked Status</label>
                  <select class="custom-select d-block w-100" id="isMember" name="isMember" required>
                    <option value="">Choose...</option>
                    <option value=1>Allowed</option>
                    <option value=0>Block</option>
                  </select>
                </div>
              </div>
              <button class="btn btn-primary btn-lg btn-block" type="submit" name="submit">Set Permissions</button>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<div id="footer">
  <?php include'footer.php';?>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

</body>
</html>