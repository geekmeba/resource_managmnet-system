<?php 

class Users extends Stock_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Users';
		
		$this->load->model('model_users');
			}

	public function index()
	{
		$this->render_template('user/index', $this->data);
	}

	public function create(){

		$this->form_validation->set_rules('fname', 'First Name', 'required|trim');
		$this->form_validation->set_rules('lname', 'Last Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[user.email]');
		$this->form_validation->set_rules('phno', 'Phone Number', 'trim|required|is_unique[user.Phone_number]');
		$this->form_validation->set_rules('role', 'Role', 'required');
		$this->form_validation->set_rules('uname', 'Username', 'trim|required|is_unique[account.username]');
		$this->form_validation->set_rules('pass', 'Password', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('cpass', 'Confirm password', 'trim|required|matches[pass]');

		      if ($this->form_validation->run() == TRUE) {
            // true case
		    $password = $this->password_hash($this->input->post('pass'));
        	$data = array(
        		'username' => $this->input->post('uname'),
        		'password' => $password
        	);

        	$create = $this->model_users->create($data);
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('Users/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('Users/create', 'refresh');
        	}
        }else{
        	$this->render_template('user/create', $this->data);

        }	
		

	}


	public function fetchUsersData(){
		$result = array('data' => array());

		$data = $this->model_users->getUserData();

		foreach ($data as $key => $value) {

			// button
			$buttons = '';

				$buttons .= '<a href="'.base_url('Users/Viewdetail/'.$value['User_id']).'" class="btn btn-default"><i class="fa fa-eye"></i></a>';

				if($this->session->userdata('role') == 'Store Manager' || $this->session->userdata('role') == 'Store Keeper'){
				$buttons .= ' <button type="button" class="btn btn-success" onclick="editFunc('.$value['User_id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></button>';
			}
				$status = ($value['Status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';
				

			$result['data'][$key] = array(
				$value['First_name'] .'   '.$value['Last_name'] ,
				$value['Role'],
				$status,
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
			

				$buttons .= ' <button type="button" class="btn btn-danger" onclick="removeFunc('.$value['Item_id'].')">Restore</button>';
				

			$result['data'][$key] = array(
				$value['Item_name'],
				$value['Quantity'],
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	public function Viewdetail($id){
		$user_info = $this->model_users->getuserinfo($id);
		$strtimestamp = $user_info['Start_date'];
 	    $date = date('d-m-Y', strtotime($strtimestamp));
 	    $this->data['startdate'] = $date;
		$this->data['user_info'] = $user_info;


        $this->render_template('user/viewuser', $this->data);
	}
		public function password_hash($pass = '')
	{
		if($pass) {
			$password = password_hash($pass, PASSWORD_DEFAULT);
			return $password;
		}
	}

	public function fetchUserDataById($id){

	if($id) {
			$data = $this->model_users->getUserDataById($id);
			echo json_encode($data);
		}

		return false;
}

public function edit($id)
{

		$response = array();

		if($id) {
			$this->form_validation->set_rules('status', 'Status', 'trim|required');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'Status' => $this->input->post('status')
	        	);

	        	$update = $this->model_users->update($data, $id);
	        	if($update == true) {
	        		$response['success'] = true;
	        		$response['messages'] = 'Status Succesfully Updated';
	        	}
	        	else {
	        		$response['success'] = false;
	        		$response['messages'] = 'Error in the database while updating user status';			
	        	}
	        }
	        else {
	        	$response['success'] = false;
	        	foreach ($_POST as $key => $value) {
	        		$response['messages'][$key] = form_error($key);
	        	}
	        }
		}
		else {
			$response['success'] = false;
    		$response['messages'] = 'Error please refresh the page again!!';
		}

		echo json_encode($response);
}
	public function profile()
	{
		$this->data['page_title'] = 'My profile';
		$user_id = $this->session->userdata('u_id');

		$user_data = $this->model_users->getDataById($user_id);
		$this->data['user_data'] = $user_data;

        $this->render_template('user/profile', $this->data);
	}

		public function setting()
	{	
		$this->data['page_title'] = 'Edit My Profile';
		$id = $this->session->userdata('u_id');
		$a_id = $this->session->userdata('a_id');

		if($id) {
			
			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('fname', 'First name', 'trim|required');
			$this->form_validation->set_rules('lname', 'Last name', 'trim|required');
			$this->form_validation->set_rules('phone', 'Phone Number', 'trim|required');

			if ($this->form_validation->run() == TRUE) {
	            // true case

		        if(empty($this->input->post('password')) && empty($this->input->post('cpassword')) && empty($this->input->post('username'))) {
		        	$data = array(
		        		
		        		'First_name' => $this->input->post('fname'),
		        		'Last_name' => $this->input->post('lname'),
		        		'Email' => $this->input->post('email'),
		        		'Phone_number' => $this->input->post('phone')
		        	);

		        	$update = $this->model_users->edit($data,$id,$a_id);
		        	if($update == true) {
		        		$this->session->set_flashdata('success', 'Successfully updated');
		        		redirect('users/setting/', 'refresh');
		        	}
		        	else {
		        		$this->session->set_flashdata('errors', 'Error occurred!!');
		        		redirect('users/setting/', 'refresh');
		        	}
		        }
		        else {
		        	$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
					$this->form_validation->set_rules('cpassword', 'Confirm password', 'trim|required|matches[password]');

					if($this->form_validation->run() == TRUE) {

						$password = $this->password_hash($this->input->post('password'));

						$data = array(
		        		
		        		'First_name' => $this->input->post('fname'),
		        		'Last_name' => $this->input->post('lname'),
		        		'Email' => $this->input->post('email'),
		        		'Phone_number' => $this->input->post('phone')
		        	      );

						$acc_data = array(
			        		'username' => $this->input->post('username'),
			        		'password' => $password
			        		
			        	);

			        	$update = $this->model_users->edit($data,$id,$a_id,$acc_data);
			        	if($update == true) {
			        		$this->session->set_flashdata('success', 'Successfully updated');
			        		redirect('users/setting/', 'refresh');
			        	}
			        	else {
			        		$this->session->set_flashdata('errors', 'Error occurred!!');
			        		redirect('users/setting/', 'refresh');
			        	}
					}
			        else {
			            // false case
			        	$user_data = $this->model_users->getDataById($id);

			        	$this->data['user_data'] = $user_data;

						$this->render_template('user/setting', $this->data);	
			        }	

		        }
	        }
	        else {
	            // false case
						$user_data = $this->model_users->getDataById($id);

			        	$this->data['user_data'] = $user_data;


						$this->render_template('user/setting', $this->data);		
	        }	
		}
	}
}