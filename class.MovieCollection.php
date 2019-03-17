  <?php
  require_once ("database.php");

  class MovieCollection{

    public $movie_id;
    public $moviePoster;
    public $movieTitle;
    public $year;
    public $genre;
    public $language;
    public $movieCertificate;
    public $rating;
    public $qtyAvailable;
    public $qtyRented;

  	//viewallrentals
    public function viewrentalsall() {
     global $database;
     $sql5 = "SELECT rental_id,users_id,firstName,lastName,movieTitle,burrowedDate,expectedReturnDate,videoCopy_id,isReturned FROM users,rental,moviecollection WHERE users_id='$users_id, movie_id='$movie_id'";
     $result =  $database->query($sql5);

     if ($result->num_rows > 0) {
       while($row = $result->fetch_assoc()) {
        echo "<tr>";						              	
        echo "<td>". $row["rental_id"]."</td>";
        echo "<td>". $row["videoCopy_id"]."</td>";
        echo "<th>". $row["users_id"]."</th>";
        echo "<td>". $row["firstName"]."</td>";
        echo "<td>". $row["lastName"]."</td>";       
        echo "<td>". $row["movieTitle"]."</td>";
        echo "<td>". $row["burrowedDate"]."</td>";
        echo "<td>". $row["expectedReturnDate"]."</td>";
        echo "<td>";
        switch ($row["isReturned"])
        {
          case 1 :
          echo "Returned";
          break;
          case 0 :
          echo "Pending";			    	
        }
        echo "</td>";
        echo "</tr>";
      }
    } else 
    {
      echo "No requests";
    }

  }

        //createrental
  public function createrental($movie_id,$qtyAvailable,$qtyRented) {
    global $database;
    $users_id = $_SESSION['users_id'];

    $burrowedDate=date('Y-m-d');
    $expectedReturnDate= date('Y-m-d', strtotime($burrowedDate. ' + 7 days'));
    $videoCopy_id = 1023;
    $qtyAvailable = $qtyAvailable - 1;
    $qtyRented = $qtyRented + 1;

    $sql5 = "UPDATE moviecollection SET qtyAvailable='$qtyAvailable', qtyRented='$qtyRented' where movie_id='$movie_id'";
    $sql6 = "INSERT INTO rental(users_id,videoCopy_id,movie_id,burrowedDate,expectedReturnDate) VALUES ('$users_id','$videoCopy_id','$movie_id','$burrowedDate','$expectedReturnDate')";
    $result = $database->query($sql5);
    $result = $database->query($sql6);

    echo "<script>alert('Rental Request is processed. Rental allowed for 7 days. The requested movie needs to be returned by ".$expectedReturnDate."!');</script>";

  }
  	//viewcollection-loggedin and sorted
  public function viewcollectionnew() {
    global $database;

    $category=$_SESSION['category'];
    $sql5 = "SELECT * FROM moviecollection order by $category";
    $result =  $database->query($sql5);
    $found = $database->fetch_array($result);

    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $this->movie_id = $row['movie_id'];
        $_SESSION['movie_id']= $row['movie_id'];
        $movie_id= $_SESSION['movie_id'];
        $movieTitle=$row['movieTitle'];
        $movieTitle=str_replace(' ', '',$movieTitle );

        $this->qtyAvailable = $row['qtyAvailable'];
        $_SESSION['qtyAvailable']= $row['qtyAvailable'];
        $qtyAvailable=$this->qtyAvailable;

        $this->qtyRented = $row['qtyRented'];
        $_SESSION['qtyRented']= $row['qtyRented'];
        $qtyRented=$_SESSION['qtyRented'];

        $this->rating = $row['rating'];
        $_SESSION['rating']= $row['rating'];
        $rating=$_SESSION['rating'];


        echo  
        "<div class='col-md-3'>
        <div class='card mb-4 shadow-sm'>
        <img class='bd-placeholder-img card-img-top' width height='377' src ='{$row['moviePoster']}'preserveAspectRatio='xMidYMid slice'>
        <div class='card-body'>
        <p class='card-text'>
        <h6>{$row['movieTitle']}</h6><br>
        Year: {$row['year']}<br>
        Genre: {$row['genre']}<br><br>
        Rating: 
        <small class='text-muted' style='align-items:center;'><b style='color:#007bff;'>
        <h3> {$row['rating']}</h3>
        </b><h5> / 10 </h5>
        </small></p>
        <div class='d-flex justify-content-between align-items-center'>
        <button type='button' class='btn btn-sm btn-primary' data-toggle='modal' data-target=#".$movieTitle.">Learn More >>
        </button>";
        if ($qtyRented < 5) {
                    //create rental request
          echo "
          <form action ='' method='post' name='createrental' id='createrental'>
          <input type='text' id='movie_id' name='movie_id' value='$movie_id' hidden>
          <input type='text' id='qtyAvailable' name='qtyAvailable' value='$qtyAvailable' hidden>
          <input type='text' id='qtyRented' name='qtyRented' value='$qtyRented' hidden>
          <button type='submit' name='submit' class='btn btn-sm btn-outline-secondary' onClick='moviedetail()'>Request</button></form>
          "; 
        } else  
        {
          echo "
          <button type='submit' id='button2' name='button2' class='btn btn-sm btn-outline-secondary'  onClick='moviedetail2()' value=".$movie_id.">Request</button>
          ";

        } 
        "<small class='text-muted'>Rating: <b style='color:#007bff;'><h3> {$row['rating']}</h3></b> / 10 </small></br>";
        echo  "
        </div>
        </div>
        </div>";
                 //modal content code for each tile
        echo
        "<div class='modal fade' id=".$movieTitle ." tabindex='-1' style='display:none;' aria-hidden='true'>
        <div class='modal-dialog'>
        <div class='modal-content'>
        <div class='modal-header'>
        <h5 class='modal-title'>{$row['movieTitle']}</h5>
        <button type='button' class='close' data-dismiss='modal' >
        &times;
        </button>
        </div>
        <div class='modal-body'>
        <table class='pull-left col-md-8 '>
        <tbody>

        <tr>
        <td class='h6'><strong>Movie ID</strong></td>
        <td class=''>{$row['movie_id']}</td>
        </tr>

        <tr>
        <td class='h6'><strong>Movie Title</strong></td>
        <td class=''>{$row['movieTitle']}</td>
        </tr>

        <tr>
        <td class='h6'><strong>Year</strong></td>
        <td class=''>{$row['year']}</td>
        </tr>

        <tr>
        <td class='h6'><strong>Genre</strong></td>
        <td class=''>{$row['genre']}</td>
        </tr>

        <tr>
        <td class='h6'><strong>Language</strong></td>
        <td class=''>{$row['language']}</td>
        </tr>

        <tr>
        <td class='h6'><strong>Rating</strong></td>
        <td class=''>";
        switch ($row["rating"]) {
          case 5:
          echo "<span class='fa fa-star checked'></span>
          <span class='fa fa-star checked'></span>
          <span class='fa fa-star checked'></span>
          <span class='fa fa-star checked'></span>
          <span class='fa fa-star checked'></span>";
          break;
          case 4:
          echo "<span class='fa fa-star checked'></span>
          <span class='fa fa-star checked'></span>
          <span class='fa fa-star checked'></span>
          <span class='fa fa-star checked'></span>
          <span class='fa fa-star '></span>";
          break;
          case 3:
          echo "<span class='fa fa-star checked'></span>
          <span class='fa fa-star checked'></span>
          <span class='fa fa-star checked'></span>
          <span class='fa fa-star '></span>
          <span class='fa fa-star '></span>";
          break;
          case 2:
          echo "<span class='fa fa-star checked'></span>
          <span class='fa fa-star checked'></span>
          <span class='fa fa-star '></span>
          <span class='fa fa-star '></span>
          <span class='fa fa-star '></span>";
          break;
          case 1:
          echo "<span class='fa fa-star checked'></span>
          <span class='fa fa-star '></span>
          <span class='fa fa-star '></span>
          <span class='fa fa-star '></span>
          <span class='fa fa-star '></span>";
        }
        echo " </td>
        </tr>

        <tr>
        <td class='h6'><strong>Movie Certificate</strong></td>
        <td class=''>{$row['movieCertificate']}</td>
        </tr>                          

        </tbody>
        </table>

        <div class='col-md-5'> 
        <img src='{$row['moviePoster']}' class='img-thumbnail'>  
        </div>

        </div>

        <div class='modal-footer'>

        <button type='button' class='btn btn-sm btn-danger' data-dismiss='modal'>Close</button>

        </div>
        </div>
        </div>
        </div>
        </div>";

      }
    }
  }

  	//viewcollection-no rating
  public function viewcollection() {
    global $database;

    $sql5 = "SELECT * FROM moviecollection";
    $result =  $database->query($sql5);
    $found = $database->fetch_array($result);

    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {

        $this->movie_id = $row['movie_id'];
        $_SESSION['movie_id']= $row['movie_id'];
        $movie_id= $_SESSION['movie_id'];
        $movieTitle=$row['movieTitle'];
        $movieTitle=str_replace(' ', '',$movieTitle );

        $this->qtyAvailable = $row['qtyAvailable'];
                //$_SESSION['qtyAvailable']= $row['qtyAvailable'];
        $qtyAvailable=$this->qtyAvailable;

        $this->qtyRented = $row['qtyRented'];
        $_SESSION['qtyRented']= $row['qtyRented'];
        $qtyRented=$_SESSION['qtyRented'];

        echo  

        "<div class='col-md-3'>
        <div class='card mb-4 shadow-sm'>

        <img class='bd-placeholder-img card-img-top' width height='377' src ='{$row['moviePoster']}'preserveAspectRatio='xMidYMid slice'>

        <div class='card-body'>
        <p class='card-text'>
        <h6>{$row['movieTitle']}</h6><br>
        Year: {$row['year']}<br>
        Genre: {$row['genre']}<br><br>
        </p>
        <div class='d-flex justify-content-between align-items-center'>
        <button type='button' class='btn btn-sm btn-primary' data-toggle='modal' data-target=#".$movieTitle.">Learn More >> 
        </button>";

        echo  "<small class='text-muted'>Rating: <b style='color:blue;'><a href='login.php'> Login </a></b>
        </small>
        </div>
        </div>
        </div>";

                 //modal content code for each tile
        echo
        "<div class='modal fade' id=".$movieTitle ." tabindex='-1' style='display:none;' aria-hidden='true'>
        <div class='modal-dialog'>
        <div class='modal-content'>

        <div class='modal-header'>
        <h5 class='modal-title'>{$row['movieTitle']}</h5>
        <button type='button' class='close' data-dismiss='modal' >
        &times;
        </button>
        </div>
        <div class='modal-body'>

        <table class='pull-left col-md-8 '>
        <tbody>
        <tr>
        <td class='h6'><strong>Movie ID</strong></td>
        <td class=''>{$row['movie_id']}</td>
        </tr>

        <tr>
        <td class='h6'><strong>Movie Title</strong></td>
        <td class=''>{$row['movieTitle']}</td>
        </tr>

        <tr>
        <td class='h6'><strong>Year</strong></td>
        <td class=''>{$row['year']}</td>
        </tr>

        <tr>
        <td class='h6'><strong>Genre</strong></td>
        <td class=''>{$row['genre']}</td>
        </tr>

        <tr>
        <td class='h6'><strong>Language</strong></td>
        <td class=''>{$row['language']}</td>
        </tr>

        <tr>
        <td class='h6'><strong>Movie Certificate</strong></td>
        <td class=''>{$row['movieCertificate']}</td>
        </tr>                           

        </tbody>
        </table>

        <div class='col-md-4'> 
        <img src='{$row['moviePoster']}' class='img-thumbnail'>  
        </div>

        </div>
        <div class='modal-footer'>

        <a href='login.php'><button type='button' id='button' name='button2' class='btn btn-sm btn-secondary' data-toggle='popover' data-content='Login to request movie'>Log in to  Request Movie</button></a>           

        <button type='button' class='btn btn-sm btn-danger' data-dismiss='modal'>Close</button>
        </div>
        </div>
        </div>
        </div>
        </div>";

      }

    }

  }

  public function searchmovie($searchname) {
    global $database;
    $sql1="SELECT * from moviecollection WHERE movieTitle LIKE '$searchname' or movieTitle like '%".$searchname."%' ";
    $result = $database->query($sql1);
    if ($result->num_rows > 0) {

      while($row = $result->fetch_assoc()) {

        $this->movie_id = $row['movie_id'];
        $_SESSION['movie_id']= $row['movie_id'];
        $movie_id= $_SESSION['movie_id'];
        $movieTitle=$row['movieTitle'];
        $movieTitle=str_replace(' ', '',$movieTitle );

        $this->qtyAvailable = $row['qtyAvailable'];
        $_SESSION['qtyAvailable']= $row['qtyAvailable'];
        $qtyAvailable=$this->qtyAvailable;

        $this->qtyRented = $row['qtyRented'];
        $_SESSION['qtyRented']= $row['qtyRented'];
        $qtyRented=$_SESSION['qtyRented'];

        echo  
        "<div class='col-md-3'>
        <div class='card mb-4 shadow-sm'>

        <img class='bd-placeholder-img card-img-top' width height='377' src ='{$row['moviePoster']}'preserveAspectRatio='xMidYMid slice'>

        <div class='card-body'>
        <p class='card-text'>
        <h6>{$row['movieTitle']}</h6><br>
        Year: {$row['year']}<br>
        Genre: {$row['genre']}<br><br>
        Rating: 
        <small class='text-muted' style='align-items:center;'><b style='color:#007bff;'>
        <h3> {$row['rating']}</h3>
        </b><h5> / 10 </h5>
        </small>

        </p>
        <div class='d-flex justify-content-between align-items-center'>
        <button type='button' class='btn btn-sm btn-primary' data-toggle='modal' data-target=#".$movieTitle.">Learn More >>
        </button>";

        if ($qtyRented < 5) {
                    //create rental request
          echo "
          <form action ='' method='post' name='createrental' id='createrental'>
          <input type='text' id='movie_id' name='movie_id' value='$movie_id' hidden>
          <input type='text' id='qtyAvailable' name='qtyAvailable' value='$qtyAvailable' hidden>
          <input type='text' id='qtyRented' name='qtyRented' value='$qtyRented' hidden>
          <button type='submit' name='submit' class='btn btn-sm btn-outline-secondary' onClick='moviedetail()'>Request</button></form>
          "; 
        } else  
        {
          echo "
          <button type='submit' id='button2' name='button2' class='btn btn-sm btn-outline-secondary'  onClick='moviedetail2()' value=".$movie_id.">Request</button>
          ";

        } 
        "<small class='text-muted'>Rating: <b style='color:#007bff;'><h3> {$row['rating']}</h3></b> / 10 </small></br>";

        echo  "
        </div>
        </div>
        </div>";

                 //modal content code for each tile
        echo
        "<div class='modal fade' id=".$movieTitle ." tabindex='-1' style='display:none;' aria-hidden='true'>
        <div class='modal-dialog'>
        <div class='modal-content'>

        <div class='modal-header'>
        <h5 class='modal-title'>{$row['movieTitle']}</h5>
        <button type='button' class='close' data-dismiss='modal' >
        &times;
        </button>
        </div>
        <div class='modal-body'>

        <table class='pull-left col-md-8 '>
        <tbody>
        <tr>
        <td class='h6'><strong>Movie ID</strong></td>
        <td class=''>{$row['movie_id']}</td>
        </tr>

        <tr>
        <td class='h6'><strong>Movie Title</strong></td>
        <td class=''>{$row['movieTitle']}</td>
        </tr>

        <tr>
        <td class='h6'><strong>Year</strong></td>
        <td class=''>{$row['year']}</td>
        </tr>

        <tr>
        <td class='h6'><strong>Genre</strong></td>
        <td class=''>{$row['genre']}</td>
        </tr>

        <tr>
        <td class='h6'><strong>Language</strong></td>
        <td class=''>{$row['language']}</td>
        </tr>

        <tr>
        <td class='h6'><strong>Rating</strong></td>
        <td class=''>
        ";
        switch ($row["rating"]) {
          case 5:
          echo "<span class='fa fa-star checked'></span>
          <span class='fa fa-star checked'></span>
          <span class='fa fa-star checked'></span>
          <span class='fa fa-star checked'></span>
          <span class='fa fa-star checked'></span>";
          break;
          case 4:
          echo "<span class='fa fa-star checked'></span>
          <span class='fa fa-star checked'></span>
          <span class='fa fa-star checked'></span>
          <span class='fa fa-star checked'></span>
          <span class='fa fa-star '></span>";
          break;
          case 3:
          echo "<span class='fa fa-star checked'></span>
          <span class='fa fa-star checked'></span>
          <span class='fa fa-star checked'></span>
          <span class='fa fa-star '></span>
          <span class='fa fa-star '></span>";
          break;
          case 2:
          echo "<span class='fa fa-star checked'></span>
          <span class='fa fa-star checked'></span>
          <span class='fa fa-star '></span>
          <span class='fa fa-star '></span>
          <span class='fa fa-star '></span>";
          break;
          case 1:
          echo "<span class='fa fa-star checked'></span>
          <span class='fa fa-star '></span>
          <span class='fa fa-star '></span>
          <span class='fa fa-star '></span>
          <span class='fa fa-star '></span>";
        }
        echo "</td>
        </tr>

        <tr>
        <td class='h6'><strong>Movie Certificate</strong></td>
        <td class=''>{$row['movieCertificate']}</td>
        </tr>                          

        </tbody>
        </table>

        <div class='col-md-5'> 
        <img src='{$row['moviePoster']}' class='img-thumbnail'>  
        </div>
        </div>

        <div class='modal-footer'>

        <button type='button' class='btn btn-sm btn-danger' data-dismiss='modal'>Close</button>

        </div>
        </div>
        </div>
        </div>
        </div>";

      }

    } else {
      echo "No search critera found.";
    }
  }

  public function searchindex($searchname) {
    global $database;
    $sql1="SELECT * from moviecollection WHERE movieTitle LIKE '$searchname' or movieTitle like '%".$searchname."%' ";
    $result = $database->query($sql1);
    if ($result->num_rows > 0) {

      while($row = $result->fetch_assoc()) {
        $this->movie_id = $row['movie_id'];
        $_SESSION['movie_id']= $row['movie_id'];
        $movie_id= $_SESSION['movie_id'];
        $movieTitle=$row['movieTitle'];
        $movieTitle=str_replace(' ', '',$movieTitle );

        $this->qtyAvailable = $row['qtyAvailable'];
                //$_SESSION['qtyAvailable']= $row['qtyAvailable'];
        $qtyAvailable=$this->qtyAvailable;

        $this->qtyRented = $row['qtyRented'];
        $_SESSION['qtyRented']= $row['qtyRented'];
        $qtyRented=$_SESSION['qtyRented'];

        echo  

        "<div class='col-md-3'>
        <div class='card mb-4 shadow-sm'>

        <img class='bd-placeholder-img card-img-top' width height='377' src ='{$row['moviePoster']}'preserveAspectRatio='xMidYMid slice'>

        <div class='card-body'>
        <p class='card-text'>
        <h6>{$row['movieTitle']}</h6><br>
        Year: {$row['year']}<br>
        Genre: {$row['genre']}<br><br>
        </p>
        <div class='d-flex justify-content-between align-items-center'>
        <button type='button' class='btn btn-sm btn-primary' data-toggle='modal' data-target=#".$movieTitle.">Learn More >> 
        </button>";

        echo  "<small class='text-muted'>Rating: <b style='color:blue;'><a href='login.php'> Login </a></b>
        </small>
        </div>
        </div>
        </div>";
                 //modal content code for each tile
        echo
        "<div class='modal fade' id=".$movieTitle ." tabindex='-1' style='display:none;' aria-hidden='true'>
        <div class='modal-dialog'>
        <div class='modal-content'>

        <div class='modal-header'>
        <h5 class='modal-title'>{$row['movieTitle']}</h5>
        <button type='button' class='close' data-dismiss='modal' >
        &times;
        </button>
        </div>
        <div class='modal-body'>

        <table class='pull-left col-md-8 '>
        <tbody>
        <tr>
        <td class='h6'><strong>Movie ID</strong></td>
        <td class=''>{$row['movie_id']}</td>
        </tr>

        <tr>
        <td class='h6'><strong>Movie Title</strong></td>
        <td class=''>{$row['movieTitle']}</td>
        </tr>

        <tr>
        <td class='h6'><strong>Year</strong></td>
        <td class=''>{$row['year']}</td>
        </tr>

        <tr>
        <td class='h6'><strong>Genre</strong></td>
        <td class=''>{$row['genre']}</td>
        </tr>

        <tr>
        <td class='h6'><strong>Language</strong></td>
        <td class=''>{$row['language']}</td>
        </tr>

        <tr>
        <td class='h6'><strong>Movie Certificate</strong></td>
        <td class=''>{$row['movieCertificate']}</td>
        </tr>  
        
        </tbody>
        </table>

        <div class='col-md-4'> 
        <img src='{$row['moviePoster']}' class='img-thumbnail'>  
        </div>

        </div>
        <div class='modal-footer'>

        <a href='login.php'><button type='button' id='button' name='button2' class='btn btn-sm btn-secondary' data-toggle='popover' data-content='Login to request movie'>Log in to  Request Movie</button></a>           

        <button type='button' class='btn btn-sm btn-danger' data-dismiss='modal'>Close</button>

        </div>
        </div>
        </div>
        </div>
        </div>";
      }

    } else {

      echo "No search critera found.";

    }
  }
}
?>