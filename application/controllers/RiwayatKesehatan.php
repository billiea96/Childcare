<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RiwayatKesehatan extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('RiwayatKesehatan_model');
        $this->load->model('Terapi_model');
        $this->load->model('Anak_model');
        $this->load->helper('url_helper');
        $this->load->helper('form');
        date_default_timezone_set('Asia/Jakarta');
    	$this->load->library('form_validation');
     	$this->load->library('session');
     	if(empty($_SESSION['username'])){
     		header("Location: ".site_url('Auth/index'));
     	}
    }
	public function index()	
	{	
		if($_SESSION['hak_akses']!='ADMIN'&&$_SESSION['hak_akses']!='KEPERAWATAN'){
     		header("Location: ".site_url('Anak/index'));
     	}
		
		$data['terapi'] = $this->Terapi_model->get();
		$data['anak'] = $this->Anak_model->get_anak();

		$this->load->view('layout/header');
		$this->load->view('kesehatan/riwayat_kesehatan',$data);
		$this->load->view('layout/footer');
	}
	public function add(){
		$data= array(
			'Terapi_Id' => $this->input->post('terapi'),
			'Anak_Id' => $this->input->post('anak'),
			'Tanggal' => date('Y-m-d'),
			'Diagnosa' => $this->input->post('diagnosa'),
			'Catatan' => $this->input->post('keterangan'),
		);

		if($this->RiwayatKesehatan_model->add($data)){
			$this->session->set_userdata('message','Data Kesehatan berhasil ditambahkan');
		}else{
			$this->session->set_userdata('error','Data Kesehatan gagal ditambahkan');
		}

		header("Location: ".site_url('RiwayatKesehatan/index'));
	}
	
}
