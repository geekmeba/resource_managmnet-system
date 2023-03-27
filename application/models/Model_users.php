<?php 

class Model_users extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getUserData() 
	{
		$sql = "SELECT * FROM user";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

		public function getuserinfo($UId = null) 
	{
		if($UId) {
			$sql = "SELECT * FROM user WHERE User_id = ?";
			$query = $this->db->query($sql, array($UId));
			return $query->row_array();
		}
	}

	public function create($data = '')
	{

		if($data) {
			$create = $this->db->insert('account', $data);

			$acc_id = $this->db->insert_id();

			$user_data = array(
				'First_name' => $this->input->post('uname'),
				'Last_name' => $this->input->post('lname'),
				'Email' => $this->input->post('email'),
				'Phone_number' => $this->input->post('phno'),
				'Role' => $this->input->post('role'),
				'a_id' => $acc_id
			);
			$create2 = $this->db->insert('user', $user_data);

			return ($create == true && $create2 == true) ? true : false;
		}
	}

	public function edit($data = array(), $id = null, $aid = null, $acc_data = array())
	{
		$this->db->where('User_id', $id);
		$update = $this->db->update('user', $data);
				
		if($acc_data){
			$this->db->where('Account_id', $aid);
			$update1 = $this->db->update('account', $acc_data);
		}
			
		return ($update == true || $update1 == true) ? true : false;	
	}


	public function countTotalUsers()
	{
		$sql = "SELECT * FROM user";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	public function getUserDataById($id){
		if($id){
		$sql = "SELECT * FROM user WHERE User_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
	}
}

		public function getDataById($id){
		
		if($id){
		
		$sql = "SELECT * FROM user,account WHERE User_id = ? AND user.a_id = account.Account_id";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
	}
}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('User_id', $id);
			$update = $this->db->update('user', $data);
			return ($update == true) ? true : false;
		}
	}
	
}