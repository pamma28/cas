<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends Cus_Controller {

	function __construct()
    {
        parent::__construct();
 
        $this->load->database();
 
		$this->load->library(array('table'));
		$this->load->helper(array());
		
		$this->load->model(array(''));
    }

	public function index(){
		//============ form pengajuan =========
		$data['fdetail'] = form_textarea(array(
							'name'=>'sdetail',
							'class'=>'form-control',
							'rows'=>2,
							'placeholder'=>'Deskripsikan secara detil kerusakan/keluhan supaya memudahkan untuk pengerjaan dan penanganan barang'
							));

		//=============== Template ============
		$data['cssFiles'] = array(
							);
							
		$data['jsFiles'] = array(
							);
		
		$data['title']="Pengajuan Service";
		$data['topbar'] = $this->load->view('dashboard/topbar', NULL, TRUE);
		$data['sidebar'] = $this->load->view('dashboard/customer/sidebar', NULL, TRUE);
		$data['content'] = $this->load->view('dashboard/customer/servis/request', $data, TRUE);
		$this->load->view ('template/main', $data);
	}
	
	public function allnotification(){
		//===================== table handler =============
		$this->load->library("Notifications");
		$data["listdata"]=$this->notifications->getallmynotif();


		//=============== Template ============
		$data['jsFiles'] = array('selectpicker/select.min'
							);
		$data['cssFiles'] = array('selectpicker/select.min'
							);  
		// =============== view handler ============
		$data['title']="All Notification";
		$data['topbar'] = $this->load->view('dashboard/topbar', NULL, TRUE);
		$data['sidebar'] = $this->load->view('dashboard/admin/sidebar', NULL, TRUE);
		$data['content'] = $this->load->view('dashboard/admin/mynotif', $data, TRUE);
		$this->load->view ('template/main', $data);
	}
	
}
