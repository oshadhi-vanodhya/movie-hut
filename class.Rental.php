<?php
require_once ("database.php");


class Rental{

	public $rental_id;
	public $users_id;
	public $burrowedDate;
	public $expectedReturnDate;
	public $videoCopy_id;
	public $movie_id;
	public $isReturned;
	//viewallrentals
	public function viewrentalsall() {
		global $database;
		$sql5 = "SELECT rental.users_id,users.firstName,users.lastName,moviecollection.movieTitle,rental.videoCopy_id,rental.burrowedDate,rental.expectedReturnDate,rental.isReturned FROM rental INNER JOIN users on users.users_id=rental.users_id INNER JOIN moviecollection on moviecollection.movie_id=rental.movie_id order by users_id";
		$result =  $database->query($sql5);

		if ($result->num_rows > 0) {

			while($row = $result->fetch_assoc()) {
				echo "<tr>";						              	
				echo "<td>". $row["users_id"]."</td>";
				echo "<td>". $row["firstName"]."</td>";
				echo "<td>". $row["lastName"]."</td>";
				echo "<td>". $row["movieTitle"]."</td>";				
				echo "<td>". $row["videoCopy_id"]."</td>";            	   
				echo "<td>". $row["burrowedDate"]."</td>";
				echo "<td>". $row["expectedReturnDate"]."</td>";

				echo "<td>";
				switch ($row["isReturned"])
				{
					case 1 :
					echo "<b style='color:green';>Returned</b>";

					break;
					case 0 :
					echo "<b style='color:red';>Pending</b>";			    	
				}
				echo "</td>";
				echo "</tr>";
			}
		} else {
			echo "No requests";
		}

	}

	    //mark returned
	public function markreturn($videoCopy_id,$isReturned)
	{
		global $database;
		$sql="SELECT movie_id from videoCopy where videoCopy_id='$videoCopy_id'";
		$result = $database->query($sql);
		$result_set = $database->query($sql);
		$found = $database->fetch_array($result_set);
		$this->movie_id = $found['movie_id'];
		$movie_id = $this->movie_id;

		$sql1="UPDATE rental SET isReturned='$isReturned' WHERE videoCopy_id='$videoCopy_id'";
		$sql2=	"UPDATE moviecollection set qtyAvailable=qtyAvailable+1, qtyRented=qtyRented-1  where movie_id= '$movie_id'";
		$result = $database->query($sql1);
		$result = $database->query($sql2);
		return $result;
	}

       		//viewpasthistory
	public function viewpasthistory() {
		global $database;
		$users_id=$_SESSION['users_id'];
		$sql5 = "SELECT moviecollection.movieTitle,rental.videoCopy_id,rental.burrowedDate,rental.expectedReturnDate,rental.isReturned FROM rental  INNER JOIN moviecollection on moviecollection.movie_id=rental.movie_id Where rental.users_id=$users_id";

		$result =  $database->query($sql5);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo "<tr>";						              	
				echo "<td>". $row["movieTitle"]."</td>";
				echo "<td>". $row["videoCopy_id"]."</td>";   
				echo "<td>". $row["burrowedDate"]."</td>";
				echo "<td>". $row["expectedReturnDate"]."</td>";
				echo "<td>";
				switch ($row["isReturned"])
				{
					case 1 :
					echo "<b style='color:green';>Returned</b>";
					break;
					case 0 :
					echo "<b style='color:red';>Pending</b>";			    	
				}
				echo "</td>";
				echo "</tr>";
			}
		} else {
			echo "No requests";
		}

	}
}