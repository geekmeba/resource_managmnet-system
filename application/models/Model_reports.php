<?php 

class Model_reports extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getreportData() 
	{
		$sql = "SELECT * FROM loan_request,user WHERE loan_request.Status = 3 AND loan_request.u_id = user.User_id ORDER BY loan_request.Date_requested DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function getItemData($id = null)
{	
		if($id) {
			$sql = "SELECT * FROM item,loan_request,user WHERE loan_request.Loan_id = ? AND loan_request.i_id = item.Item_id AND user.User_id = loan_request.u_id";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
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

	public function getconfirmationData($id = null){
		if($id) {
			$sql = "SELECT * FROM confirm_loan,loan_request,user WHERE loan_request.Loan_id = ? AND loan_request.Loan_id = confirm_loan.l_id AND user.User_id = confirm_loan.u_id";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}
}


	public function getreturnData($id = null){
		if($id) {
			$sql = "SELECT * FROM confirm_return,loan_request,user WHERE loan_request.Loan_id = ? AND loan_request.Loan_id = confirm_return.l_id AND user.User_id = confirm_return.u_id";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}
}




	
	
}

