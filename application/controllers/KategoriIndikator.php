<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KategoriIndikator extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('KategoriIndikator_model');
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
		$data['kategori'] = $this->KategoriIndikator_model->get();

		$this->load->view('layout/header');
		$this->load->view('kategori_indikator/index',$data);
		$this->load->view('layout/footer');
	}
	public function add(){
		$data = array(
			'Nama' => $this->input->post('nama'),
		);

		if($this->KategoriIndikator_model->add($data))
			$this->session->set_userdata('message', 'Data Kategori Berhasil Ditambahkan');
		else
			$this->session->set_userdata('error', 'Data Kategori Gagal Ditambahkan');

		header("Location: ".site_url('KategoriIndikator/index'));
	}
	public function edit(){
		$data = array(
			'Id' => $this->input->post('id_kategori'),
			'Nama' => $this->input->post('nama'),
		);

		if($this->KategoriIndikator_model->edit($data))
			$this->session->set_userdata('message', 'Data Kategori Berhasil Diperbarui');
		else
			$this->session->set_userdata('error', 'Data Kategori Gagal Diperbarui');

		header("Location: ".site_url('KategoriIndikator/index'));
	}
	public function delete(){
		$id_kategori = $this->input->post('id_kategori');

		if($this->KategoriIndikator_model->delete($id_kategori))
			$this->session->set_userdata('message', 'Data Kategori Berhasil Dihapus');
		else
			$this->session->set_userdata('error', 'Data Kategori Gagal Dihapus');

		header("Location: ".site_url('KategoriIndikator/index'));
	}
	public function set_aktif(){
		$data = array(
			'Id' => $_POST['id'],
			'Aktif' =>1,
		);

		$this->KategoriIndikator_model->edit($data);
	}
	public function set_non_aktif(){
		$data = array(
			'Id' => $_POST['id'],
			'Aktif' =>0,
		);

		$this->KategoriIndikator_model->edit($data);
	}
}
