<?php 

class Loans extends Stock_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Loan Request';
		
		$this->load->model('model_loans');
		$this->load->model('model_reports');
	}

	public function index()
	{
		$this->render_template('loans/index', $this->data);
	}

public function submit($id){

	$item_data = $this->model_loans->getItemData($id);

	$this->data['item_data'] = $item_data;

	$quantity = $item_data['Quantity'];

		$this->form_validation->set_rules('quantity', 'Quantity', 'trim|required');

		if ($this->form_validation->run() == TRUE) {
            // true case
                $data = array(
                'requested_quantity' => $this->input->post('quantity'),
        		'u_id' => $this->session->userdata('u_id'),
        		'i_id' => $id
        		);

        	
        	$updatedquantity = $quantity - $this->input->post('quantity');
        	if($updatedquantity > 0){
        		 	$qunatity_data = array(
        		'Quantity' =>  $updatedquantity
        		);
        		
        		$create = $this->model_loans->request($data,$qunatity_data,$id);
        	}
			if($create == true) {
	        		$response['success'] = true;
	        		$response['messages'] = 'Request submitted successfully';
	        	}
	        	else {
	        		$response['success'] = false;
	        		$response['messages'] = 'Error in the database while submiting the request';			
	        	}
	        }
	        else {
	        	$response['success'] = false;
	        	foreach ($_POST as $key => $value) {
	        		$response['messages'][$key] = form_error($key);
	        	}
	        }

		echo json_encode($response);
	}


	public function fetchAvaliableItemData(){
		$result = array('data' => array());

		$data = $this->model_loans->getActiveitemData();

		foreach ($data as $key => $value) {

			// button
			$buttons = '';

				$buttons .= '<a href="'.base_url('Items/Viewdetail/'.$value['Item_id']).'" class="btn btn-default"><i class="fa fa-eye"></i></a>';
			

				$buttons .= ' <button type="button" class="btn btn-primary" onclick="requestFunc('.$value['Item_id'].')" data-toggle="modal" data-target="#requestModal">Submit Request</button>';
				

			$result['data'][$key] = array(
				$value['Item_name'],
				$value['Quantity'],
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	public function fetchrequestData(){
		$result = array('data' => array());

		$data = $this->model_loans->fetchrequestData();

		foreach ($data as $key => $value) {

			// button
			$buttons = '';

				$buttons .= '<a href="'.base_url('Loans/Viewdetail/'.$value['Loan_id']).'" class="btn btn-default"><i class="fa fa-eye"></i></a>';
			

				$buttons .= ' <button type="button" class="btn btn-primary" onclick="approveFunc('.$value['Loan_id'].')" data-toggle="modal" data-target="#approveModal">Approve</button>';

				$buttons .= ' <button type="button" class="btn btn-danger" onclick="rejectFunc('.$value['Loan_id'].')" data-toggle="modal" data-target="#rejectModal">Reject</button>';
				
				$date = date('d-m-Y', strtotime($value['Date_requested']));
				

			$result['data'][$key] = array(
				$value['First_name'] .'  '. $value['Last_name'],
				$date,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}



		public function fetchItemDataById($id)
	{
		if($id) {
			$data = $this->model_loans->getItemData($id);
			echo json_encode($data);
		}

		return false;
	
	}

	public function approve(){
		$this->data['page_title'] = 'Approve Request';
		
        $this->render_template('loans/approve', $this->data);
	}

	public function approved(){
		$this->data['page_title'] = 'Approved Request';
		
        $this->render_template('loans/approved', $this->data);
	}

		public function approverequest()
	{
		
		$loan_id = $this->input->post('Loan_id');

		$response = array();
		$data = array(
			'l_id' => $loan_id,
			'u_id' => $this->session->userdata('u_id')
		);
		if($loan_id) {
			$edit = $this->model_loans->edit($loan_id,$data);
			if($edit == true) {
				$response['success'] = true;
				$response['messages'] = "Successfully Approved";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while approving the request";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refersh the page again!!";
		}

		echo json_encode($response);
	}

			public function rejectrequest()
	{
		
		$loan_id = $this->input->post('Loan_id');

		$response = array();
		if($loan_id) {
			$edit = $this->model_loans->reject($loan_id);
			if($edit == true) {
				$response['success'] = true;
				$response['messages'] = "Request Rejected";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while approving the request";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refersh the page again!!";
		}

		echo json_encode($response);
	}

			public function approvedrequest()
	{
		
		$loan_id = $this->input->post('Loan_id');

		$response = array();
		$data = array(
			'l_id' => $loan_id,
			'u_id' => $this->session->userdata('u_id')
		);
		if($loan_id) {
			$edit = $this->model_loans->confirm($loan_id,$data);
			if($edit == true) {
				$response['success'] = true;
				$response['messages'] = "Successfully Confirmed";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while confirming the loan";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refersh the page again!!";
		}

		echo json_encode($response);
	}


	public function Viewdetail($id){
		$loan_info = $this->model_loans->getloaninfo($id);
		$strtimestamp = $loan_info['Date_requested'];
 	    $date = date('d-m-Y', strtotime($strtimestamp));
 	    $this->data['Date_requested'] = $date;
		$this->data['loan_info'] = $loan_info;


        $this->render_template('loans/viewdetail', $this->data);
	}

		public function viewapprovedetail($id){
		$loan_info = $this->model_loans->getloaninfo($id);
		$approved_info = $this->model_loans->getapprovalinfo($id);
		$strtimestamp = $loan_info['Date_requested'];
		$strtimestamp2 = $approved_info['Date_approved'];
 	    $date = date('d-m-Y', strtotime($strtimestamp));
 	    $date2 = date('d-m-Y', strtotime($strtimestamp2));
 	    $this->data['Date_requested'] = $date;
 	    $this->data['Date_approved'] = $date2;
		$this->data['loan_info'] = $loan_info;
		$this->data['approved_info'] = $approved_info;

        $this->render_template('loans/viewapproveddetail', $this->data);
	}


	public function fetchapprovedData(){
		$result = array('data' => array());

		$data = $this->model_loans->fetchapprovedData();

		foreach ($data as $key => $value) {

			// button
			$buttons = '';

				$buttons .= '<a href="'.base_url('Loans/viewapprovedetail/'.$value['Loan_id']).'" class="btn btn-default"><i class="fa fa-eye"></i></a>';
			

				$buttons .= ' <button type="button" class="btn btn-primary" onclick="confirmFunc('.$value['Loan_id'].')" data-toggle="modal" data-target="#confirmModal">Confirm Loan</button>';
				
				$date = date('d-m-Y', strtotime($value['Date_requested']));
				$dateapp = date('d-m-Y', strtotime($value['Date_approved']));
				

			$result['data'][$key] = array(
				$value['First_name'] .'  '. $value['Last_name'],
				$date,
				$dateapp,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}


		public function fetchconfirmedData(){
		$result = array('data' => array());

		$data = $this->model_loans->fetchconfirmedData();

		foreach ($data as $key => $value) {

			// button
			$buttons = '';

				$buttons .= '<a href="'.base_url('Loans/viewloandetail/'.$value['Loan_id']).'" class="btn btn-default"><i class="fa fa-eye"></i></a>';
			

				$buttons .= ' <button type="button" class="btn btn-primary" onclick="returnFunc('.$value['Loan_id'].')" data-toggle="modal" data-target="#returnModal">Confirm Return</button>';
				
				$date = date('d-m-Y', strtotime($value['Confirmed_date']));
				

			$result['data'][$key] = array(
				$value['First_name'] .'  '. $value['Last_name'],
				$date,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	public function returnitem(){
			$this->data['page_title'] = 'Return Item';
		
        $this->render_template('loans/returnitem', $this->data);
	}
	
	public function viewloandetail($id){
		$return_info = $this->model_loans->getreturninfo($id);		
		$strtimestamp = $return_info['Confirmed_date'];
 	    $date = date('d-m-Y', strtotime($strtimestamp));
 	    $this->data['Date_confirmed'] = $date;
		$this->data['return_info'] = $return_info;

        $this->render_template('loans/viewreturndetail', $this->data);
	}

	public function fetchloanedItemDataById($id){
			if($id) 
		{
			$data = $this->model_loans->getLoanData($id);
			echo json_encode($data);
		}

		return false;
	}

	public function itemreturnconfirmation(){


	$loan_id = 	$this->input->post('Loan_id');
    $loan_data = $this->model_loans->getLoanData($loan_id);

	$this->data['loan_data'] = $loan_data;

	$quantity = $loan_data['requested_quantity'];
	$item_id = $loan_data['i_id'];

	$item_data = $this->model_loans->getItemData($item_id);

	$this->data['item_data'] = $item_data;
	$current_quantity = $item_data['Quantity'];

		

		$updatedquantity = $quantity + $current_quantity;

		$qunatity_data = array(
        		'Quantity' =>  $updatedquantity
        );
		
            
        $data = array(
                'Status' => 3
        		);

        $return_data = array(
        	'l_id' => $loan_id,
        	'u_id' => $this->session->userdata('u_id')
        );
        		 	
        		
        $create = $this->model_loans->returnitem($data,$qunatity_data,$item_id,$return_data,$loan_id);
        	
			if($create == true) {
	        		$response['success'] = true;
	        		$response['messages'] = 'Item successfully returned';
	        	}
	        	else {
	        		$response['success'] = false;
	        		$response['messages'] = 'Error in the database while submiting the request';			
	        	}
	        
	       

		echo json_encode($response);
	}
	public function pending(){
		$this->data['page_title'] = 'My Pending Requests';
		$this->render_template('loans/pending', $this->data);
	}


		public function fetchpendingData(){
		$result = array('data' => array());

		$u_id = $this->session->userdata('u_id');
		$data = $this->model_loans->getpendingData($u_id);

		foreach ($data as $key => $value) {

			// button
			$buttons = '';
			

				$buttons .= ' <button type="button" class="btn btn-default" onclick="reportFunc('.$value['Loan_id'].')" data-toggle="modal" data-target="#reportModal"><i class="fa fa-eye"></button>';
				$date = date('d-m-Y', strtotime($value['Date_requested']));
				

			$result['data'][$key] = array(
				$date,
				$value['Item_name'],
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

		public function fetchloanDataById($id)
	{
		if($id) {
			$data = $this->model_loans->getLoanData($id);
			echo json_encode($data);
		}

		return false;
	
	}
	public function myapproved(){
		$this->data['page_title'] = 'My Approved Requests';
		$this->render_template('loans/myapproved', $this->data);
	}

		public function fetchmyapprovedData(){
		$result = array('data' => array());

		$u_id = $this->session->userdata('u_id');
		$data = $this->model_loans->getmyapprovedData($u_id);

		foreach ($data as $key => $value) {

			// button
			$buttons = '';
			

				$buttons .= ' <button type="button" class="btn btn-default" onclick="reportFunc('.$value['Loan_id'].')" data-toggle="modal" data-target="#reportModal"><i class="fa fa-eye"></button>';
				$date = date('d-m-Y', strtotime($value['Date_approved']));
				

			$result['data'][$key] = array(
				$date,
				$value['Item_name'],
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	public function fetchapprovalDataById($id)
	{
		if($id) {
			$data = $this->model_loans->getapprovalData($id);
			echo json_encode($data);
		}

		return false;
	
	}
	public function oweitems(){
		$this->data['page_title'] = 'Items on hand';
		$this->render_template('loans/oweitems', $this->data);
	}


	public function fetchoweData(){
		$result = array('data' => array());

		$u_id = $this->session->userdata('u_id');
		$data = $this->model_loans->getoweData($u_id);

		foreach ($data as $key => $value) {

			
			$date = date('d-m-Y', strtotime($value['Confirmed_date']));
				

			$result['data'][$key] = array(
				$date,
				$value['Item_name'],
				$value['requested_quantity']
			);
		} // /foreach

		echo json_encode($result);
	}

	public function myhistory(){
		$this->data['page_title'] = 'My Loan History';
		$this->render_template('loans/myhistory', $this->data);
	}
	public function fetchhistoryData(){
		$result = array('data' => array());
		$u_id = $this->session->userdata('u_id');
        $data = $this->model_loans->gethistoryData($u_id);

		foreach ($data as $key => $value) {

			// button
			$buttons = '';
			

				$buttons .= ' <button type="button" class="btn btn-default" onclick="reportFunc('.$value['Loan_id'].')" data-toggle="modal" data-target="#reportModal"><i class="fa fa-eye"></button>';
				$date = date('d-m-Y', strtotime($value['Date_requested']));
				

			$result['data'][$key] = array(
				$date,
				$value['Item_name'],
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}


		public function fetchmyItemDataById($id)
	{
		if($id) {
			$data = $this->model_reports->getItemData($id);
			echo json_encode($data);
		}

		return false;
	
	}

		public function fetchmyApprovalDataById($id)
	{
		if($id) {
			$data = $this->model_reports->getapprovalData($id);
			echo json_encode($data);
		}

		return false;
	
	}

		public function fetchmyConfirmationDataById($id)
	{
		if($id) {
			$data = $this->model_reports->getconfirmationData($id);
			echo json_encode($data);
		}

		return false;
	
	}
		public function fetchmyReturnDataById($id)
	{
		if($id) {
			$data = $this->model_reports->getreturnData($id);
			echo json_encode($data);
		}

		return false;
	
	}	
}
