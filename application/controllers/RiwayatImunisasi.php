<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RiwayatImunisasi extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('RiwayatImunisasi_model');
        $this->load->model('Vaksinasi_model');
        $this->load->model('Anak_model');
        $this->load->model('Pendaftaran_model');
        $this->load->helper('url_helper');
        $this->load->helper('form');
    	$this->load->library('form_validation');
     	$this->load->library('session');
     	date_default_timezone_set('Asia/Jakarta');
     	if(empty($_SESSION['username'])){
     		header("Location: ".site_url('Auth/index'));
     	}
    }
	public function index()
	{	
		if($_SESSION['hak_akses']!='ADMIN'&&$_SESSION['hak_akses']!='KEPERAWATAN'){
     		header("Location: ".site_url('Anak/index'));
     	}

		$data['vaksinasi'] = $this->Vaksinasi_model->get_vaksinasi();
		$data['anak'] = $this->Anak_model->get_anak();

		$this->load->view('layout/header');
		$this->load->view('kesehatan/riwayat_imunisasi',$data);
		$this->load->view('layout/footer');
	}
	public function add(){
		$data= array(
			'Vaksinasi_Id' => $this->input->post('vaksinasi'),
			'Anak_Id' => $this->input->post('anak'),
			'Tanggal' => date('Y-m-d'),
			'Catatan' => $this->input->post('keterangan'),
		);

		if($this->RiwayatImunisasi_model->add($data)){
			$this->session->set_userdata('message','Data imunisasi berhasil ditambahkan');
		}else{
			$this->session->set_userdata('error','Data imunisasi gagal ditambahkan');
		}

		header("Location: ".site_url('RiwayatImunisasi/index'));
	}
	
}
