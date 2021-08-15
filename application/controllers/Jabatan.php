<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Jabatan_model');
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
		$data['jabatan'] = $this->Jabatan_model->get_jabatan();

		$this->load->view('layout/header');
		$this->load->view('jabatan/index',$data);
		$this->load->view('layout/footer');
	}
	public function add(){
		$data = array(
			'Nama' => $this->input->post('nama'),
			'JobDesc' => $this->input->post('jobdesc'),
		);

		if($this->Jabatan_model->add_jabatan($data))
			$this->session->set_userdata('message', 'Data Jabatan Berhasil Ditambahkan');
		else
			$this->session->set_userdata('error', 'Data Jabatan Gagal Ditambahkan');

		header("Location: ".site_url('Jabatan/index'));
	}
	public function edit(){
		$data = array(
			'Id' => $this->input->post('id_jabatan'),
			'Nama' => $this->input->post('nama'),
			'JobDesc' => $this->input->post('jobdesc'),
		);

		if($this->Jabatan_model->edit_jabatan($data))
			$this->session->set_userdata('message', 'Data Jabatan Berhasil Diperbarui');
		else
			$this->session->set_userdata('error', 'Data Jabatan Gagal Diperbarui');

		header("Location: ".site_url('Jabatan/index'));
	}
	public function delete(){
		$id_jabatan = $this->input->post('id_jabatan');

		if($this->Jabatan_model->delete_jabatan($id_jabatan))
			$this->session->set_userdata('message', 'Data Jabatan Berhasil Dihapus');
		else
			$this->session->set_userdata('error', 'Data Jabatan Gagal Dihapus');

		header("Location: ".site_url('Jabatan/index'));
	}
}
