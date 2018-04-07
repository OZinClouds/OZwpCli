<?php 

class OZmysql {
		

		public $connState = false; // Check to see if the connection is active
		public $connection=null; // DB connection variable
		public $dbNAME=null; // name of the DB to be processed (new/delete)

	    	public function __construct(){
	    	 	$this->connection = $this->connect(DB_HOST, DB_USER, DB_PASS);
	    	 }//end construct
	    	 
		
		private function connect($host, $user, $pass, $db=null){
			mysqli_report( MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR);
			try
			{
			$thisConn = new mysqli($host, $user, $pass, $db);
				 $this->connState=true; 
				 return $thisConn;
			}
			catch (Exception $e){
				$this->connState=false;
				return $e->getMessage();
			}
		}// end connect


		/*********************** lists all databases in mysql as array ***********************/
		function ListDatabaseArray(){
		$result = $this->connection->query('SHOW DATABASES'); 
			$d=[];
			while( $row = mysqli_fetch_row( $result ) ){
			        $d[]= $row[0];
			    }

		 	$d=array_diff($d,array("information_schema","performance_schema","mysql"));

		return $d;
		}//end list DB

		/*********************** create new DB ***********************/
		function CreateNewDatabase(){

			$sql="CREATE DATABASE " . $this->dbNAME;
				if($this->connection->query($sql)){
					return true;
				} else {
					return false;
				}

		}// end create DB

		/*********************** delete a DB ***********************/
		function DELETEaDatabase(){
			$delSQL="DROP DATABASE IF EXISTS " . $this->dbNAME;
			if($this->connection->query($delSQL)){
				return true;
			} else {
				return false;
			}
		}// end delete DB
		

		/*********************** disconnect ***********************/
		public function disconnect(){
			if ($this->connState){
				$this->connection->close();
				$this->connState = false;
			} else {
				$this->connection = NULL;
				$this->connState = false;
			}
		}

		public function __destruct(){
			$this->disconnect();
		}


}//end class
 ?>