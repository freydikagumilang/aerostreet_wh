<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Formulir extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
    var $data=array();
    public function __construct()
    {
    	parent::__construct();
        // Your own constructor code
        $this->data['title'] = "";
        $this->data['title2'] = "";
        $this->load->helper('captcha');
        // $this->load->model('channel_model');
        $this->load->model('products_model');

    }
	
    public function index()
	{

        $this->data['title'] = "Stock Opname";
        // $this->data['produk'] = $this->products_model->get_all()->result();
        $this->load->view('template/html_head',$this->data);
        
	}
    public function get_sku(){
        $q=$this->products_model->get_all()->result();
        echo json_encode($q);
    }
    function save_so(){
        $set_array=array(
            "user_name"=>strtoupper($this->input->post("user_name")) ,
            "id_produk"=>$this->input->post("id_produk"),
            "kd_produk"=>$this->input->post("kd_produk"),
            $this->input->post("size")=>$this->input->post("stock"),
            "rak"=>strtoupper($this->input->post("rak")),
            "create_date"=>time(),
            
        );
        $id= $this->products_model->save_so($set_array);
        
        $resp = array("status"=>1,
        "msg"=>"Simpan berhasil</br>kode SO-$id");
        echo json_encode($resp);
    }
    
}
