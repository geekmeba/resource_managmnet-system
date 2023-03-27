<?php 

class Model_loans extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getActiveitemData() 
	{
		$sql = "SELECT * FROM item WHERE Status = 1 AND Quantity > 0";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function getItemData($id = null)
{
		
		if($id) {
			$sql = "SELECT * FROM item WHERE Item_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}
	
}

		public function fetchrequestData() 
	{
			$sql = "SELECT * FROM item,user,loan_request WHERE item.Item_id = loan_request.i_id AND loan_request.u_id = user.User_id AND loan_request.Status = 0";
			$query = $this->db->query($sql);
			return $query->result_array();
		
	}

		public function fetchapprovedData() 
	{
			$sql = "SELECT * FROM user,loan_request,approved_request WHERE loan_request.u_id = user.User_id AND loan_request.Status = 1 AND loan_request.Loan_id = approved_request.l_id";
			$query = $this->db->query($sql);
			return $query->result_array();
		
	}

	public function request($data = '' , $quantity_data = '', $id = null){

	if($data && $quantity_data){
		$insert = $this->db->insert('loan_request', $data);
		
		$this->db->where('Item_id', $id);
		$update = $this->db->update('item', $quantity_data);

		return ($insert && $update == true) ? true : false;
	}


}

public function getloaninfo($id = null) 
	{
		if($id) {
			$sql = "SELECT * FROM item,user,loan_request WHERE loan_request.Loan_id = ? AND loan_request.i_id = item.Item_id AND loan_request.u_id = user.User_id";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}
	}
public function getreturninfo($id = null) 
	{
		if($id) {
			$sql = "SELECT * FROM item,user,loan_request,confirm_loan WHERE loan_request.Loan_id = ? AND loan_request.i_id = item.Item_id AND loan_request.u_id = user.User_id AND loan_request.Loan_id = confirm_loan.l_id";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}
	}


public function getapprovalinfo($id = null) 
	{
		if($id) {
			$sql = "SELECT * FROM item,user,loan_request,approved_request WHERE loan_request.Loan_id = ? AND loan_request.i_id = item.Item_id AND approved_request.u_id = user.User_id AND approved_request.l_id = loan_request.Loan_id";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}
	}


	public function edit($loanid = null,$data1 = null)
	{
		$this->db->where('Loan_id', $loanid);
		$data = array(
			'Status' => 1
		);
		$update = $this->db->update('loan_request', $data);

		$create = $this->db->insert('approved_request', $data1);			
		
		return ($update == true && $create == true) ? true : false;	
	}	


	public function reject($loanid = null)
	{
		$this->db->where('Loan_id', $loanid);
		$data = array(
			'Status' => 5
		);
		$update = $this->db->update('loan_request', $data);

						
		return ($update == true ) ? true : false;	
	}	
	public function confirm($loanid = null,$data1 = null)
	{
		$this->db->where('Loan_id', $loanid);
		$data = array(
			'Status' => 2
		);
		$update = $this->db->update('loan_request', $data);

		$create = $this->db->insert('confirm_loan', $data1);			
		
		return ($update == true && $create == true) ? true : false;	
	}
		public function fetchconfirmedData() 
	{
			$sql = "SELECT * FROM loan_request,confirm_loan,user WHERE confirm_loan.l_id = loan_request.Loan_id AND loan_request.Status = 2 AND loan_request.u_id = user.User_id";
			$query = $this->db->query($sql);
			return $query->result_array();
		
	}
	public function getLoanData($id){
				if($id) {
			$sql = "SELECT * FROM loan_request WHERE Loan_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}
	}
	public function returnitem($data = '',$quantity_data ='',$id = '',$return_data = '',$loan_id = ''){
		if($data && $quantity_data && $return_data){
		
		
		$this->db->where('Item_id', $id);
		$update = $this->db->update('item', $quantity_data);

		$this->db->where('Loan_id', $loan_id);
		$update1 = $this->db->update('loan_request', $data);

		$insert = $this->db->insert('confirm_return', $return_data);

		return ($insert == true && $update == true && $update1 == true) ? true : false;
	}

	}
	public function getpendingData($uid = null) 
	{
		if($uid){
		$sql = "SELECT * FROM loan_request,item WHERE loan_request.Status = 0 AND loan_request.u_id = ? AND loan_request.i_id = item.Item_id";
		$query = $this->db->query($sql, array($uid));
		return $query->result_array();
	}
}


		public function getmyapprovedData($uid = null) 
	{
		if($uid){
		$sql = "SELECT * FROM loan_request,item,approved_request WHERE loan_request.Status = 1 AND loan_request.u_id = ? AND loan_request.i_id = item.Item_id AND loan_request.Loan_id = approved_request.l_id";
		$query = $this->db->query($sql, array($uid));
		return $query->result_array();
	}
}

		public function getapprovalData($id = null)
{	
		if($id) {
			$sql = "SELECT * FROM approved_request,loan_request,user WHERE loan_request.Loan_id = ? AND loan_request.Loan_id = approved_request.l_id AND user.User_id = approved_request.u_id";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}	
}

		public function getoweData($uid = null) 
	{
		if($uid){
		$sql = "SELECT * FROM loan_request,item,confirm_loan WHERE loan_request.Status = 2 AND loan_request.u_id = ? AND loan_request.i_id = item.Item_id AND loan_request.Loan_id = confirm_loan.l_id";
		$query = $this->db->query($sql, array($uid));
		return $query->result_array();
	}
}

public function gethistoryData($uid){
	if($uid){
		$sql = "SELECT * FROM loan_request,item WHERE loan_request.Status = 3 AND loan_request.u_id = ? AND loan_request.i_id = item.Item_id ORDER BY loan_request.Date_requested DESC";
		$query = $this->db->query($sql, array($uid));
		return $query->result_array();
	}
}
public function countTotalLoanRequests()
	{
		$sql = "SELECT * FROM loan_request WHERE Status = 0";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	public function countReturnItems()
	{
		$sql = "SELECT * FROM loan_request WHERE Status = 2";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
		public function countApprovedLoans()
	{
		$sql = "SELECT * FROM loan_request WHERE Status = 1";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	public function countMyApprovedLoans()
	{
		$u_id = $this->session->userdata('u_id'); 
		$sql = "SELECT * FROM loan_request WHERE Status = 1 AND u_id = $u_id";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

		public function countMyPendingLoans()
	{
		$u_id = $this->session->userdata('u_id'); 
		$sql = "SELECT * FROM loan_request WHERE Status = 0 AND u_id = $u_id";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

		public function countMyHistory()
	{
		$u_id = $this->session->userdata('u_id'); 
		$sql = "SELECT * FROM loan_request WHERE Status = 3 AND u_id = $u_id";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	
	

}

