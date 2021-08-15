<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PeriodeAsuh extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('PeriodeAsuh_model');
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
		if($_SESSION['hak_akses']!='ADMIN'){
     		header("Location: ".site_url('Anak/index'));
     	}
		$data['periode_asuh']=$this->PeriodeAsuh_model->get_periode_asuh();
		$this->load->view('layout/header');
		$this->load->view('periode_asuh/index',$data);
		$this->load->view('layout/footer');
	}
	public function add(){
		$tanggalAwal = $this->input->post('TanggalAwal');
		$tanggalAwal = DateTime::createFromFormat('d-m-Y', $tanggalAwal)->format('Y-m-d');
		$tanggalAkhir = $this->input->post('TanggalAkhir');
		$tanggalAkhir = DateTime::createFromFormat('d-m-Y', $tanggalAkhir)->format('Y-m-d');
		$aktifkah = $this->input->post('Aktifkah');
		//jika periode aktif maka set tidak aktif semua periode yang sudah ada
		if($aktifkah==1){
			$this->PeriodeAsuh_model->set_non_aktif();
		}

		$data=array(
			'TanggalAwal' => $tanggalAwal,
			'TanggalAkhir' => $tanggalAkhir,
			'Status' => $aktifkah,
		);

		if($this->PeriodeAsuh_model->add_periode_asuh($data))
			$this->session->set_userdata('message', 'Data Periode Asuh Berhasil Ditambahkan');
		else
			$this->session->set_userdata('error', 'Data Periode Asuh Gagal Ditambahkan');

		header("Location: ".site_url('PeriodeAsuh/index'));
	}
	public function set_aktif(){
		$id = $this->input->post('idPeriode');

		//set semua periode jadi tidak aktif
		$this->PeriodeAsuh_model->set_non_aktif();

		$data = array(
			'Id' => $id,
			'Status' => 1,
		);

		if($this->PeriodeAsuh_model->edit_periode_asuh($data)){
			$this->session->set_userdata('message', 'Berhasil Diaktifkan');
		}else{
			$this->session->set_userdata('error', 'Gagal Diaktifkan');
		}

		header("Location: ".site_url('PeriodeAsuh/index'));
	}
}
