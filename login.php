<?php
session_start();

include_once 'class.Users.php';

$users = new Users();

if (isset($_POST['submit'])) {
	extract($_POST);
	$login = $users->check_login($username, $password);
	
	if ($login)  {
	    // Login Success
		$users->find_by_username($username);

		switch ($_SESSION['isAdmin']) {
			case 1:
			header("location:viewregisteredusers.php");			    		
			break;
		}
		switch ($_SESSION['isMember'])
		{
			case 1 :
			$users_id=$_SESSION['users_id'];
			    	//echo $_SESSION['users_id'];
			header("location:viewmoviecollection.php");
			break;
			case 0 :
			echo "<script type='text/javascript'>alert('Sorry! You are not allowed to log in');</script>";
		}

	}   else{
		
		echo "<script type='text/javascript'>alert('Wrong Username or Password. Please try again!');</script>";
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

	<link rel="stylesheet" type="text/css" href="stylesheets/login.css">

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
</head>
<body class="text-center">

	<script language="javascript" type="text/javascript" src= 'javascript/login1.js' >
	</script>
	
	<form class="form-signin" action="" method="post" name="login">
		
		<img class="mb-3" src="images/student.png" height="120px", width="120px">
		<h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>    
		<label for="username" class="sr-only">Username</label>
		<input type="username" id="username" class="form-control" name="username" placeholder="Username" required="" autofocus="">
		<label for="password" class="sr-only">Password</label>
		<input type="password" id="password" name="password" class="form-control" placeholder="Password" required="">
		<div class="checkbox mb-3">
			<label>
				<input type="checkbox" value="remember-me"> Remember me
			</label>
		</div>
		<button class="btn btn-lg btn-primary btn-block" onclick="return(submitlogin());" type="submit"  name="submit" value="submit">Sign in
		</button>
		<p class="mt-5 mb-3 text-muted"><a href="createaccount.php"> Not Registered?   Create Account</a></p>
	</form>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>