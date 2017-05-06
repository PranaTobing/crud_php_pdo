<?php 
require __DIR__ . '/db_connection.php';

class CRUD {
	protected $db;
	
	function __construct(){
		$this->db = DB();
	}
	
	function __destruct(){
		$this->db = null;
	}
	
	public function Create($first_name, $last_name, $email){
		$query = $this->db->prepare("INSERT INTO users(first_name, last_name, email) VALUES(:first_name, :last_name, :email)");
		$query->bindParam("first_name", $first_name);
		$query->bindParam("last_name", $last_name);
		$query->bindParam("email", $email);
		$query->execute();
		
		return $this->db->LastInsertId();
	}
	
	public function Read()
    {
        $query = $this->db->prepare("SELECT * FROM users");
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }
	
	public function Delete($user_id){
		// disini2
		$query = $this->db->prepare("DELETE FROM users WHERE id= :id");
		$query->bindParam("id", $user_id);
		$query->execute();
	}
	
	public function Update($first_name, $last_name, $email, $user_id){
		//disini3
		$query = $this->db->prepare("UPDATE users SET first_name= :first_name,
									last_name= :last_name, email= :email WHERE id= :id");
		$query->bindParam("first_name", $first_name);
		$query->bindParam("last_name", $last_name);
		$query->bindParam("email", $email);
		$query->bindParam("id", $user_id);
		
		$query->execute();
	}
	
	public function Details($user_id){
		// detail
		$query = $this->db->prepare("SELECT * FROM users WHERE id= :id");
		$query->bindParam("id", $user_id, PDO::PARAM_STR);
		
		$query->execute();
		$data = $query->fetch(PDO::FETCH_ASSOC);
		return json_encode($data);
	}
}

?>