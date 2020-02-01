<?php 

	class DbOperations{

		private $con; 

		function __construct(){

			require_once dirname(__FILE__).'/DbConnect.php';

			$db = new DbConnect();

			$this->con = $db->connect();

		}

		/*CRUD -> C -> CREATE */

		public function createUser($username, $pass, $email){
			if($this->isUserExist($username,$email)){
				return 0; 
			}else{
				$password = md5($pass);
				$stmt = $this->con->prepare("INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES (NULL, ?, ?, ?);");
				$stmt->bind_param("sss",$username,$password,$email);

				if($stmt->execute()){
					return 1; 
				}else{
					return 2; 
				}
			}
		}

		public function userLogin($username, $pass){
			$password = $pass;
			$stmt = $this->con->prepare("SELECT customer_id FROM tbl_customers WHERE username = ? AND password = ?");
			$stmt->bind_param("ss",$username,$password);
			$stmt->execute();
			$stmt->store_result(); 
			return $stmt->num_rows > 0; 
		}

		public function getUserByUsername($username){
			$stmt = $this->con->prepare("SELECT * FROM tbl_customers WHERE username = ?");
			$stmt->bind_param("s",$username);
			$stmt->execute();
			return $stmt->get_result()->fetch_assoc();
		}
		

		private function isUserExist($username, $email){
			$stmt = $this->con->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
			$stmt->bind_param("ss", $username, $email);
			$stmt->execute(); 
			$stmt->store_result(); 
			return $stmt->num_rows > 0; 
		}

		public function createGoal($username, $goalName, $amount){
				$stmt = $this->con->prepare("INSERT INTO `tbl_goals` (`username`, `goal_name`, `goal_amount` , `saved_amount`, `goal_status`) VALUES (?, ?, ?, 0, 0);");
				$stmt->bind_param("sss",$username,$goalName,$amount);

				if($stmt->execute()){
					return 1; 
				}else{
					return 2; 
				}
		}

		public function getGoalbyId($goalId){
			$stmt = $this->con->prepare("SELECT * FROM tbl_goals WHERE goal_id = ?");
			$stmt->bind_param("s",$goalId);
			$stmt->execute();
			return $stmt->get_result()->fetch_assoc();
		}

		public function getGoalsByUser($username){
			$stmt = $this->con->prepare("SELECT * FROM tbl_goals WHERE username = ?");
			$stmt->bind_param("s",$username);
			$stmt->execute();
			return $stmt->get_result()->fetch_assoc();
		}

	}