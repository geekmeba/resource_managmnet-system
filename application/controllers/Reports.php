<?php 

class Reports extends Stock_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Reports';
		
		$this->load->model('model_reports');

	}

	public function index()
	{
		
		$this->render_template('report', $this->data);
	}
	
	public function fetchreportData(){
		$result = array('data' => array());

		$data = $this->model_reports->getreportData();

		foreach ($data as $key => $value) {

			// button
			$buttons = '';
			

				$buttons .= ' <button type="button" class="btn btn-default" onclick="reportFunc('.$value['Loan_id'].')" data-toggle="modal" data-target="#reportModal"><i class="fa fa-eye"></button>';
				$date = date('d-m-Y', strtotime($value['Date_requested']));
				

			$result['data'][$key] = array(
				$date,
				$value['First_name'].'  '.$value['Last_name'],
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	public function fetchItemDataById($id)
	{
		if($id) {
			$data = $this->model_reports->getItemData($id);
			echo json_encode($data);
		}

		return false;
	
	}

		public function fetchApprovalDataById($id)
	{
		if($id) {
			$data = $this->model_reports->getapprovalData($id);
			echo json_encode($data);
		}

		return false;
	
	}

		public function fetchConfirmationDataById($id)
	{
		if($id) {
			$data = $this->model_reports->getconfirmationData($id);
			echo json_encode($data);
		}

		return false;
	
	}
		public function fetchReturnDataById($id)
	{
		if($id) {
			$data = $this->model_reports->getreturnData($id);
			echo json_encode($data);
		}

		return false;
	
	}	

	
}