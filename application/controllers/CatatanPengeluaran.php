<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CatatanPengeluaran extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('KategoriPengeluaran_model');
        $this->load->model('CatatanPengeluaran_model');
        $this->load->model('Karyawan_model');
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

		$data['kategori'] = $this->KategoriPengeluaran_model->get();
		$data['karyawan'] = $this->Karyawan_model->get_karyawan();

		$this->load->view('layout/header');
		$this->load->view('pengeluaran/catatan_pengeluaran',$data);
		$this->load->view('layout/footer');
	}
	public function add(){
		$tanggal = $this->input->post('tanggal');
		$tanggal = DateTime::createFromFormat('d-m-Y', $tanggal)->format('Y-m-d');
		$data = array(
			'Tanggal' => $tanggal,
			'JumlahBayar' => $this->input->post('jumlah_bayar'),
			'Keterangan' => $this->input->post('keterangan'),
			'Kategori_Pengeluaran_Id' => $this->input->post('kategori')
		);

		if($this->CatatanPengeluaran_model->add($data))
			$this->session->set_userdata('message', 'Data Catatan Pengeluaran Berhasil Disimpan');
		else
			$this->session->set_userdata('error', 'Data Catatan Pengeluaran Gagal Disimpan');

		header("Location: ".site_url('CatatanPengeluaran/index'));
	}
}
