<?php 

class Dashboard extends Stock_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Dashboard';
		
		$this->load->model('model_items');
		$this->load->model('model_loans');
		$this->load->model('model_users');
	}


	public function index()
	{
		$this->data['total_active_items'] = $this->model_items->countTotalActiveItems();
		$this->data['total_loan_requests'] = $this->model_loans->countTotalLoanRequests();
		$this->data['total_users'] = $this->model_users->countTotalUsers();
		$this->data['total_return'] = $this->model_loans->countReturnItems();
		$this->data['approved'] = $this->model_loans->countApprovedLoans();
		$this->data['myapproved'] = $this->model_loans->countMyApprovedLoans();
		$this->data['mypending'] = $this->model_loans->countMyPendingLoans();
		$this->data['myhistory'] = $this->model_loans->countMyHistory();


		$this->render_template('dashboard', $this->data);
	}
}