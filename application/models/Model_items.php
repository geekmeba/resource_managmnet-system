<?php 

class Model_items extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getActiveitemData() 
	{
		$sql = "SELECT * FROM item WHERE Status = 1";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function getinActiveitemData(){
		$sql = "SELECT * FROM item WHERE Status = 0";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

		public function getiteminfo($itemId = null) 
	{
		if($itemId) {
			$sql = "SELECT * FROM item WHERE Item_id = ?";
			$query = $this->db->query($sql, array($itemId));
			return $query->row_array();
		}
	}

	public function create($data = '')
	{

		if($data) {
			$create = $this->db->insert('item', $data);

			return ($create == true) ? true : false;
		}
	}

	public function edit($itemid = null)
	{
		$this->db->where('Item_id', $itemid);
		$data = array(
			'Status' => 0
		);
		$update = $this->db->update('item', $data);			
		return ($update == true) ? true : false;	
	}

		public function restore($itemid = null)
	{
		$this->db->where('Item_id', $itemid);
		$data = array(
			'Status' => 1
		);
		$update = $this->db->update('item', $data);			
		return ($update == true) ? true : false;	
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$delete = $this->db->delete('users');
		return ($delete == true) ? true : false;
	}

	public function countTotalActiveItems()
	{
		$sql = "SELECT * FROM item WHERE Status = 1";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	
}