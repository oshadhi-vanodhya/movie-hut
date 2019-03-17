<?php
session_start();

include_once 'class.Users.php';

$users = new Users();

if (isset($_POST['submit'])){
	extract($_POST);

	$createaccount = $users->createaccount($firstName,$lastName,$email,$username,$password,$phoneNumber,$DOB,$address,$country,$state,$zip);
  if ($createaccount ) {
	// Create Account Successful
   header("location:logout.php");
 } else {
	// Save Session Successful
   echo 'Data Not Inserted. Username already exists';
 }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Video Hut">
  <meta name="keywords" content="videostore,rent">
  <meta name="author" content="Vanodhya Oshadhi">
  <title> Login </title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

  <style>
  .bd-placeholder-img {
    font-size: 1.125rem;
    text-anchor: middle;
  }

  @media (min-width: 768px) {
    .bd-placeholder-img-lg {
      font-size: 3.5rem;
    }
  }
</style>
<!-- Custom styles for this template -->
<link href="stylesheets/form-validation.css" rel="stylesheet">
</head>

<body class="bg-light">
  <div class="container" >
    <div class="py-5 text-center">
      <img class="d-block mx-auto mb-4" src="images/student.png" height="120px", width="120px">
      <h2>Create Account </h2>
    </div>

    <div class="row"> 
      <div class = "col-md-12 order-md-1">
        <form class="" action="" method="post" name="createaccount">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="firstName">First name</label>
              <input type="text" class="form-control" id="firstName" name="firstName" placeholder="" value="" required>
            </div>

            <div class="col-md-6 mb-3">
              <label for="lastName">Last name</label>
              <input type="text" class="form-control" id="lastName" name="lastName" placeholder="" value="" >
            </div>
          </div>
          <div class="mb-3">
            <label for="email">Email 
              <span class="text-muted">(Optional)</span></label>
              <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com">
            </div>

            <div class="mb-3">
              <label for="username">Username</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">@</span>
                </div>

                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
              </div>
            </div>

            <div class="mb-3">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="password"  required >
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="phoneNumber">Phone Number</label>
                <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="" value="" required>

              </div>
              <div class="col-md-6 mb-3">
                <label for="DOB">Date of Birth</label>
                <input type="date" class="form-control" id="DOB" name="DOB" placeholder="" value="" >

              </div>
            </div>

            <div class="mb-3">
              <label for="address">Address</label>
              <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St" required>
            </div>        

            <div class="row">
              <div class="col-md-5 mb-3">
                <label for="country">Country</label>
                <select class="custom-select d-block w-100" id="country" name="country" required>
                  <option value="">Choose...</option>
                  <option>United States</option>
                  <option>Sri Lanka</option>
                  <option>India</option>
                </select>
              </div>
              <div class="col-md-4 mb-3">
                <label for="state">State</label>
                <select class="custom-select d-block w-100" id="state" name="state" required>
                  <option value="">Choose...</option>
                  <option>California</option>
                  <option>Western</option>
                  <option>Central</option>
                </select>

              </div>
              <div class="col-md-3 mb-3">
                <label for="zip">Zip</label>
                <input type="text" class="form-control" id="zip" name="zip" placeholder="" >
              </div>
            </div>
            <hr class="mb-4">
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="T&C" name="T&C" required>
              <label class="custom-control-label" for="T&C">I accept Terms and Conditions</label>
            </div><br><br>

            <button class="btn btn-primary btn-lg btn-block" type="submit" onclick="successful()" name="submit">Create Account
            </button></form>
          </div>
          
        </div></div>
        <div id="footer">
         <?php include 'footer.php'; ?>
       </div>    


       <!-- Optional JavaScript -->
       <!-- jQuery first, then Popper.js, then Bootstrap JS -->
       <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
       <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

       <script type="text/javascript">
         function successful() {
          alert ("Your account has being created!")
         }
       </script>

     </body>
     </html>