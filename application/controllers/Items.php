<?php 

class Items extends Stock_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Items';
		
		$this->load->model('model_items');
		// $this->load->model('model_orders');
		// $this->load->model('model_users');
		// $this->load->model('model_stores');
	}

	public function index()
	{
		// $this->data['total_products'] = $this->model_products->countTotalProducts();
		// $this->data['total_paid_orders'] = $this->model_orders->countTotalPaidOrders();
		// $this->data['total_users'] = $this->model_users->countTotalUsers();
		// $this->data['total_stores'] = $this->model_stores->countTotalStores();

		// $user_id = $this->session->userdata('id');
		// $is_admin = ($user_id == 1) ? true :false;

		// $this->data['is_admin'] = $is_admin;
		$this->render_template('items/active', $this->data);
	}

	public function inactive(){
		$this->render_template('items/inactive', $this->data);
	}
	public function create(){
		$this->data['page_title'] = 'Create New Item';

		$this->form_validation->set_rules('iname', 'Item Name', 'required');
		$this->form_validation->set_rules('model', 'Model', 'required');
		$this->form_validation->set_rules('quantity', 'Quantity', 'required');
		$this->form_validation->set_rules('type', 'Type', 'required');

		      if ($this->form_validation->run() == TRUE) {
            // true case
        	$data = array(
        		'Item_name' => $this->input->post('iname'),
        		'Model' => $this->input->post('model'),
        		'Quantity' => $this->input->post('quantity'),
        		'Type' => $this->input->post('type')
        	);

        	$create = $this->model_items->create($data);
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('Items', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('Items/create', 'refresh');
        	}
        }else{
        	$this->render_template('items/create', $this->data);

        }	
		

	}


	public function fetchActiveItemData(){
		$result = array('data' => array());

		$data = $this->model_items->getActiveitemData();

		foreach ($data as $key => $value) {

			// button
			$buttons = '';

				
				$buttons .= '<a href="'.base_url('Items/Viewdetail/'.$value['Item_id']).'" class="btn btn-default"><i class="fa fa-eye"></i></a>';
				

				if($this->session->userdata('role') == 'Store Manager' || $this->session->userdata('role') == 'Store Keeper'){
				$buttons .= ' <button type="button" class="btn btn-danger" onclick="removeFunc('.$value['Item_id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
				}

			$result['data'][$key] = array(
				$value['Item_name'],
				$value['Quantity'],
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}


	public function fetchinActiveItemData(){
		$result = array('data' => array());

		$data = $this->model_items->getinActiveitemData();

		foreach ($data as $key => $value) {

			// button
			$buttons = '';

			
			$buttons .= '<a href="'.base_url('Items/Viewdetail/'.$value['Item_id']).'" class="btn btn-default"><i class="fa fa-eye"></i></a>';
			
			if($this->session->userdata('role') == 'Store Manager' || $this->session->userdata('role') == 'Store Keeper'){
           $buttons .= ' <button type="button" class="btn btn-success" onclick="restoreFunc('.$value['Item_id'].')" data-toggle="modal" data-target="#restoreModal">Restore</button>';
			}	
				

			$result['data'][$key] = array(
				$value['Item_name'],
				$value['Quantity'],
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	public function Viewdetail($id){
		$item_info = $this->model_items->getiteminfo($id);
		$this->data['item_info'] = $item_info;

        $this->render_template('items/viewitem', $this->data);
	}

		public function remove()
	{
		
		$item_id = $this->input->post('Item_id');

		$response = array();
		if($item_id) {
			$delete = $this->model_items->edit($item_id);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Successfully removed";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the item information";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refersh the page again!!";
		}

		echo json_encode($response);
	}


			public function restore()
	{
		
		$item_id = $this->input->post('Item_id');

		$response = array();
		if($item_id) {
			$delete = $this->model_items->restore($item_id);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Successfully Restored";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while restoring the item information";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refersh the page again!!";
		}

		echo json_encode($response);
	}
}