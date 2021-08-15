<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KategoriPengeluaran extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('KategoriPengeluaran_model');
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

		$this->load->view('layout/header');
		$this->load->view('pengeluaran/kategori_pengeluaran',$data);
		$this->load->view('layout/footer');
	}
	public function add(){
		$data = array(
			'Nama' => $this->input->post('nama'),
			'Keterangan' => $this->input->post('keterangan'),
		);

		if($this->KategoriPengeluaran_model->add($data))
			$this->session->set_userdata('message', 'Data Kategori Pengeluaran Berhasil Ditambahkan');
		else
			$this->session->set_userdata('error', 'Data Kategori Pengeluaran Gagal Ditambahkan');

		header("Location: ".site_url('KategoriPengeluaran/index'));
	}
	public function edit(){
		$data = array(
			'Id' => $this->input->post('id_kategori'),
			'Nama' => $this->input->post('nama'),
			'Keterangan' => $this->input->post('keterangan'),
		);

		if($this->KategoriPengeluaran_model->edit($data))
			$this->session->set_userdata('message', 'Data Kategori Pengeluaran Berhasil Diperbarui');
		else
			$this->session->set_userdata('error', 'Data Kategori Pengeluaran Gagal Diperbarui');

		header("Location: ".site_url('KategoriPengeluaran/index'));
	}
	public function delete(){
		$id_kategori = $this->input->post('id_kategori');

		if($this->KategoriPengeluaran_model->delete($id_kategori))
			$this->session->set_userdata('message', 'Data Kategori Pengeluaran Berhasil Dihapus');
		else
			$this->session->set_userdata('error', 'Data Kategori Pengeluaran Gagal Dihapus');

		header("Location: ".site_url('KategoriPengeluaran/index'));
	}
}
