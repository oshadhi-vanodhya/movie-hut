<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'videohut');

	class MySQLDatabase{
    private $connection;
    function __construct(){
         $this->open_connection();
    }
    public function open_connection() {
        $this->connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        if (mysqli_connect_errno()){
            die("Database connection failed: " .
            mysqli_connect_error() .
            " (" . mysqli_connect_errno() . ")"
            );
        }
    }
    public function close_connection(){
            if(isset($this->connection)){
               mysqli_close($this->connection);
               unset($this->connection);
            }
    }
    public function query($sql){
        $result = mysqli_query($this->connection, $sql);
        if (!$result){
            die("Database query failed.");
        }
        return $result;
    }
        public function mysqli_prep($string){
        $escaped_string = mysqli_real_escape_string($this->connection, $string);
        return $escaped_string;
    }

        //returns an associative array
        public function fetch_array_assoc($result_set){
            return mysqli_fetch_assoc ($result_set);
        }
		
		// databse-neutral functions
		public function escape_value($string){
			$escaped_string = mysqli_real_escape_string($this->connection, $string);
			return $escaped_string;
		}
		public function fetch_array($result_set){
			return mysqli_fetch_array ($result_set);
		}
		public function num_rows($result_set){
			return mysqli_num_rows($result_set);
		}
		public function insert_id(){
			//get the last id inserted over the current db connection
			return mysqli_insert_id ($this->connection);
		}
		public function affected_rows(){
			return mysqli_affected_rows($this->connection);
		}

    }
 $database = new MySQLDatabase();

?>