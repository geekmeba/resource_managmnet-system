<?php 

class Auth extends Stock_Controller {

public function __construct()
 {
  parent::__construct();
  
  $this->load->model('model_auth');

 }


	public function login()
	{

		    $this->form_validation->set_rules('uname', 'Username', 'required');
        $this->form_validation->set_rules('pass', 'Password', 'required');
        

          if ($this->form_validation->run() == TRUE) {
            // true case
            $uname_exists = $this->model_auth->check_username($this->input->post('uname'));
            

            
            if($uname_exists == TRUE) {
              $Status =   $this->model_auth->check_status($this->input->post('uname'));
              if($Status == TRUE){
              $login = $this->model_auth->login($this->input->post('uname'), $this->input->post('pass'));

              if($login) {

                $logged_in_stock = array(
                  'a_id' => $login['Account_id'],
                  'u_id' => $login['User_id'],
                  'username'  => $login['username'],
                  'fname'  => $login['First_name'],
                  'lname'  => $login['Last_name'],
                  'role'     => $login['Role'],
                  'logged_in' => TRUE
          );

          $this->session->set_userdata($logged_in_stock);
                redirect('dashboard', 'refresh');
              }
              else {
                $this->data['errors'] = 'Incorrect username/password combination';
                $this->load->view('login', $this->data);
              }
            }
            else{
              $this->data['errors'] = 'Your Account is blocked please contact the admins!!!';
              $this->load->view('login', $this->data);
            }
          }
            else {
              $this->data['errors'] = 'Username does not exists';

              $this->load->view('login', $this->data);
            }
          } 
        
      
        else {
            // false case
            $this->load->view('login');
        } 	
		}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('Auth/login', 'refresh');
	}
	

}

?>