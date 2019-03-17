<?php
require_once ("database.php");

class Users{

	public $users_id;
	public $username;
	public $password;
	public $firstName;
	public $email;
	public $DOB;
	public $phoneNumber;
	public $address;
	public $status;
	public $isMember;
	public $isAdmin;
	
	
	public function check_login($username, $password){
		global $database;
		
		$query="SELECT * from users WHERE username='$username' and password='$password'";

		//checking if the username is available in the table
		$result = $database->query($query);
		$resultSet = $database->fetch_array_assoc($result);
		$count_row = $result->num_rows;

		if ($count_row == 1) {
		// this login var will use for the session thing
			$_SESSION['login'] = true;
			
			return true;
		}
		else{
			return false;
		}
	}

	//for retreiving User details for user view pages called in login page

	public function find_by_username($username){
		global $database;
		$sql = "SELECT users_id,firstName,isMember,isAdmin FROM users WHERE username = '$username'";
		$result_set =  $database->query($sql);
		$found = $database->fetch_array($result_set);
		$this->users_id = $found['users_id'];
		$this->firstName = $found['firstName'];
		$this->isMember = $found['isMember'];	
		$this->isAdmin = $found['isAdmin'];		
		$_SESSION['users_id']= $found['users_id'];
		$_SESSION['firstName']= $this->firstName;
		$_SESSION['isMember']=$this->isMember;
		$_SESSION['isAdmin']=$this->isAdmin;
		return $found;
	}		

	/***for create account process ***/

	public function createaccount($firstName,$lastName,$email,$username,$password,$phoneNumber,$DOB,$address,$country,$state,$zip){
		global $database;
		$sql1="INSERT INTO users SET firstName='$firstName',lastName='$lastName',email='$email',username='$username',password='$password',phoneNumber='$phoneNumber',DOB='$DOB',address='$address',country='$country',state='$state',zip='$zip'";
		$result = $database->query($sql1);
		return $result;
	}
	
		//viewregistereduders
	public function viewregisteredusers() {
		global $database;
		$sql5 = "SELECT users_id,firstName,lastName,email,DOB,phoneNumber,isMember FROM users WHERE isAdmin = 0 ";
		$result =  $database->query($sql5);
			//$resultSet = $database->fetch_array_assoc($result);
			//$count_row = $result->num_rows;
		if ($result->num_rows > 0) {

			while($row = $result->fetch_assoc()) {
				echo "<tr>";
				echo "<th>". $row["users_id"]."</th>";
				echo "<td>". $row["firstName"]."</td>";
				echo "<td>". $row["lastName"]."</td>";       
				echo "<td>". $row["email"]."</td>";
				echo "<td>". $row["DOB"]."</td>";
				echo "<td>". $row["phoneNumber"]."</td>";
				echo "<td>";

				switch ($row["isMember"])
				{
					case 1 :
					echo "Allowed";

					break;
					case 0 :
					echo "Blocked";			    	
				}
				echo "</td>";
				echo "</tr>";
			}
			echo "</tbody></table>";

		} else {
			echo "No";
		}
		
	}
    //block or unblock user
	public function blacklistuser($users_id,$isMember)
	{
		global $database;
		$sql1="UPDATE users SET isMember='$isMember' WHERE users_id='$users_id'";
		$result = $database->query($sql1);
		return $result;
	}

	public function searchuser($searchname)
	{
		global $database;
		$sql1="SELECT * from users WHERE firstName LIKE '$searchname' or username like '$searchname' ";
		$result = $database->query($sql1);
		if ($result->num_rows > 0) {
			echo "<table class='table table-hover' >
			
			<thead class='thead-light'>
			<tr style='background-color: blue;'>
			<th>ID</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>User Name</th>
			<th>Email</th>
			<th>Date of Birth</th>
			<th>Phone Number</th>
			<th>Block Status</th>
			</tr>
			</thead>
			<tbody>";         

			while($row = $result->fetch_assoc()) {
				echo "<tr>";
				echo "<th>". $row["users_id"]."</th>";
				echo "<td>". $row["firstName"]."</td>";
				echo "<td>". $row["lastName"]."</td>";
				echo "<td>". $row["username"]."</td>";         
				echo "<td>". $row["email"]."</td>";
				echo "<td>". $row["DOB"]."</td>";
				echo "<td>". $row["phoneNumber"]."</td>";
				echo "<td>";

				switch ($row["isMember"])
				{
					case 1 :
					echo "Allowed";

					break;
					case 0 :
					echo "Blocked";			    	
				}
				echo "</td>";
				echo "</tr>";
			}

			echo "</tbody></table>";
		} else {
			echo "</tbody></table>";
			echo "No user found";
		}           
	}
}