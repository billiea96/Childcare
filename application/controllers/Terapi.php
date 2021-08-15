<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Terapi extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Terapi_model');
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
		$data['terapi'] = $this->Terapi_model->get();

		$this->load->view('layout/header');
		$this->load->view('terapi/index',$data);
		$this->load->view('layout/footer');
	}
	public function add(){
		$data = array(
			'Nama' => $this->input->post('nama'),
			'Keterangan' => $this->input->post('keterangan'),
		);

		if($this->Terapi_model->add($data))
			$this->session->set_userdata('message', 'Data Terapi Berhasil Ditambahkan');
		else
			$this->session->set_userdata('error', 'Data Terapi Gagal Ditambahkan');

		header("Location: ".site_url('Terapi/index'));
	}
	public function edit(){
		$data = array(
			'Id' => $this->input->post('id_terapi'),
			'Nama' => $this->input->post('nama'),
			'Keterangan' => $this->input->post('keterangan'),
		);

		if($this->Terapi_model->edit($data))
			$this->session->set_userdata('message', 'Data Terpai Berhasil Diperbarui');
		else
			$this->session->set_userdata('error', 'Data Terapi Gagal Diperbarui');

		header("Location: ".site_url('Terapi/index'));
	}
	public function delete(){
		$id_terapi = $this->input->post('id_terapi');

		if($this->Terapi_model->delete($id_terapi))
			$this->session->set_userdata('message', 'Data Terapi Berhasil Dihapus');
		else
			$this->session->set_userdata('error', 'Data Terapi Gagal Dihapus');

		header("Location: ".site_url('Terapi/index'));
	}
}
