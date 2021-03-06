<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
    {
        parent::__construct();
 
        $this->load->database();
 
		$this->load->library(array('form_validation','table',''));
		
		$this->load->model('');
    }

	public function index()
	{
		$data['cssFiles'] = array('slick/slick','slick/slick-theme'
							);
		$data['jsFiles'] = array('slick/slick.min',
							);
		$data['title']="Halaman Awal";
		$data['topbar'] = $this->load->view('home/topbarfix', NULL, TRUE);
		//$data['sidebar'] = $this->load->view('home/sidebar', NULL, TRUE);
		$data['content'] = $this->load->view('home/home', $data, TRUE);
		$this->load->view ('template/main-topnav', $data);
	}

	public function tryemail(){
	$fbbm = array('name'=>'fcode',
						'id'=>'bbm',
						'title'=>'Your LINE or BBM',
						'placeholder'=>'BBM ID',
						'value'=>set_value('fcode'),
						'class'=>'form-control',
						'size'=>'7');
	$data['incode'] = form_input($fbbm);
	$data['insend'] = form_submit();
	$this->load->view('sendemail',$data);
	}
	
	public function save(){
	$this->load->library('MY_Input');
	echo $this->input->post('fcode',false);
	}
	
	public function email(){
		$data['title']= 'try email';
		$this->load->view('home/emailsuccess',$data);
	}

	public function error(){
		$data['urlprev'] = $_SERVER['REQUEST_URI']; 
		$data['topbar'] = $this->load->view('home/topbar', NULL, TRUE);
		$data['sidebar'] = $this->load->view('home/sidebar', NULL, TRUE);
		$data['content'] = $this->load->view('home/error', $data, TRUE);
		$this->load->view ('template/main', $data);
	}
	
	public function agendas(){
		//============= populate agendas ========
		$totagn = $this->Msetting->getset('renderagn');
		$header=['<i class="fa fa-info-circle"></i> Agenda','<i class="fa fa-calendar"></i> Date','<i class="fa fa-clock-o"></i> Time','<i class="fa fa-building"></i> Place','<i class="fa fa-list"></i> Details','<i class="fa fa-sticky-note"></i> Notes'];
		$tmpl = array ( 
				'table_open'  => '<table class="table table-hover table-striped table-responsive">',
				'heading_cell_start'=> '<th style="width:17%;">'
					);
		$this->table->set_template($tmpl);
		$this->table->set_heading($header);

		$this->load->model('Magn');
		$tmpagn = $this->Magn->showagn(array('agtitle','agdate','agtime','agplace','agdescript','idagenda','agnotes'),$totagn,1);
		foreach ($tmpagn as $k => $v) {
			$tmpagn[$k]['agdate'] =  date('d-M-Y',strtotime($v['agdate']));
			unset($tmpagn[$k]['idagenda']);
			
		}
		$data['dtagn'] = $this->table->generate($tmpagn);

		$this->table->set_template($tmpl);
		$this->table->set_heading($header);

		$this->load->model('Magn');
		$tmpprevagn = $this->Magn->showprevagn(array('agtitle','agdate','agtime','agplace','agdescript','idagenda','agnotes'));
		foreach ($tmpprevagn as $k => $v) {
			$tmpprevagn[$k]['agdate'] =  date('d-M-Y',strtotime($v['agdate']));
			unset($tmpprevagn[$k]['idagenda']);
		}
		$data['prevagn'] = $this->table->generate($tmpprevagn);

		$data['title']="Agendas";
		// the "TRUE" argument tells it to return the content, rather than display it immediately
		$data['topbar'] = $this->load->view('home/topbar', NULL, TRUE);
		$data['sidebar'] = $this->load->view('home/sidebar', NULL, TRUE);
		$data['content'] = $this->load->view('home/agendas', $data, TRUE);
		$this->load->view ('template/main', $data);
	}
	
	public function articles(){
		//============= populate articles ========
		$totatcl = $this->Msetting->getset('renderatcl');
		$this->load->model("Matcl");
		$tmpatcl = $this->Matcl->dataatcl(array('idarticle','a_date','a_title','a_isi','category','cat_icon','uname'),$totatcl,1);
		$dtatcl='';
		foreach ($tmpatcl as $k => $v) {
			$dtatcl .='<li class="item">
							<div class="product-img">
								<span class="fa fa-2x '.$v['cat_icon'].'" alt="'.$v['category'].'" title="'.$v['category'].'"></span>
							</div>
							<div class="product-info">
								<a href="'.base_url('Home/readarticle?id='.$v['idarticle']).'" class="product-title">'.$v['a_title'].'</a>
								<span class="label label-default fixed pull-right"><i class="fa fa-pencil"></i> '.$v['uname'].'</span>
								<br/>
								<small class="text-muted"><i class="fa fa-clock-o"></i> '.$this->converttime->time_elapsed_string($v['a_date']).' | <i class="fa fa-tags"></i>'.$v['category'].'</small>
								<span class="product-description">
								'.strip_tags(htmlspecialchars_decode($v['a_isi'])).'							
								</span>
							</div>
							</li>';
		}
		$data['dtatcl']= $dtatcl;


		$data['title']="Articles";
		// the "TRUE" argument tells it to return the content, rather than display it immediately
		$data['topbar'] = $this->load->view('home/topbar', NULL, TRUE);
		$data['sidebar'] = $this->load->view('home/sidebar', NULL, TRUE);
		$data['content'] = $this->load->view('home/articles', $data, TRUE);
		$this->load->view ('template/main', $data);

	}

	public function readarticle(){
		$idatcl = $this->input->get('id');
		if($idatcl!='') {
			$this->load->model("Matcl");
			$tmpatcl = $this->Matcl->detailatcl(array('idarticle','a_date','a_view','a_title','a_isi','category','cat_icon','uname'),$idatcl);
			if(!empty($tmpatcl)){
				//increment view count 
				$this->Matcl->incrementatcl($idatcl);

				$data['titleatcl'] = $tmpatcl[0]['a_title'];
				$data['creatoratcl'] = $tmpatcl[0]['uname'];
				$data['dateatcl'] ='<i class="fa fa-clock-o"></i> '.date("d-M-Y", strtotime($tmpatcl[0]['a_date']))." | ";
				$data['tagsatcl'] = '<i class="fa fa-tags"></i> '.$tmpatcl[0]['category'];
				$data['contentatcl'] = htmlspecialchars_decode($tmpatcl[0]['a_isi']);
				$data['totreadatcl'] = $tmpatcl[0]['a_view']+1;

				$data['title'] = $tmpatcl[0]['a_title'];
				// the "TRUE" argument tells it to return the content, rather than display it immediately
				$data['topbar'] = $this->load->view('home/topbar', NULL, TRUE);
				$data['sidebar'] = $this->load->view('home/sidebar', NULL, TRUE);
				$data['content'] = $this->load->view('home/readarticle', $data, TRUE);
				$this->load->view ('template/main', $data);

			} else {
				$this->session->set_flashdata('x',"Please select valid article to read");
				redirect('Home/Articles');
			}

		} else {
			$this->session->set_flashdata('x',"Please select one article to read");
			redirect('Home/Articles');
		}
	}

	public function about(){
		$this->load->model('Mtmp');
		$data['tmpsef'] = htmlspecialchars_decode($this->Mtmp->gettmpdata($this->Msetting->getset('tmpaboutsef'))->tmpcontent);
		$data['tmprc'] = htmlspecialchars_decode($this->Mtmp->gettmpdata($this->Msetting->getset('tmpaboutrc'))->tmpcontent);


		$data['title']="About Us";
		// the "TRUE" argument tells it to return the content, rather than display it immediately
		$data['topbar'] = $this->load->view('home/topbar', NULL, TRUE);
		$data['sidebar'] = $this->load->view('home/sidebar', NULL, TRUE);
		$data['content'] = $this->load->view('home/about', $data, TRUE);
		$this->load->view ('template/main', $data);
	}

	public function cobaprint(){
		$this->load->library('Mpdf');

		$this->mpdf->generatepdf();
	}
}
