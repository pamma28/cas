<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Katalog extends CI_Controller {

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
		$data['title']="Katalog Produk";
		$data['topbar'] = $this->load->view('home/topbarfix', NULL, TRUE);
		$data['content'] = $this->load->view('catalog/allproduct', $data, TRUE);
		$this->load->view ('template/main-topnav', $data);
	}

	public function renderproduct($idproduct){
		$txt = '';
		switch ($idproduct) {
			case '1':
				$tot=15;
				break;
			case '2':
				$tot=5;
				break;
			default:
				$tot=10;
				break;
		}
		for($i=0;$i<$tot;$i++){
		$txt .='<div class="col-md-2">
          <div class="box">
              <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="box box-body text-center bg-teal">
                    <div class="product-img text-center"><img class="img-circle img-responsive" src="'.base_url('upload/products/iphone6.png').'" alt="Product name" height="150px"></div>
                    <h4 class="text-center"><b>Iphone 6</b>
                    </h4>
                    <p class="text-center"><i>Rp. 5000.000,-<i></p>       
                    <div class="btn-group">
                    	<button type="button" class="btn btn-success btn-sm btn-buy" data-toggle="tooltip" data-placement="top" title="beli"> <i class="fa fa-shopping-cart"></i></button>
             			<button type="button" class="btn btn-info btn-sm btn-chat" data-toggle="tooltip" data-placement="top" title="tanya stok"> <i class="fa fa-comment"></i></button>
              			<button type="button" class="btn btn-danger btn-sm btn-favorite" data-toggle="tooltip" data-placement="top" title="favorit"><i class="fa fa-heart "></i></button>
                    </div>
                </div>
                            
            </div>
        </div>';
		}
		print($txt);
	}

}
