<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vaksinasi extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Vaksinasi_model');
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
		$data['vaksinasi'] = $this->Vaksinasi_model->get_vaksinasi();

		$this->load->view('layout/header');
		$this->load->view('vaksinasi/index',$data);
		$this->load->view('layout/footer');
	}
	public function add(){
		$data = array(
			'Nama' => $this->input->post('nama'),
			'Keterangan' => $this->input->post('keterangan'),
		);

		if($this->Vaksinasi_model->add_vaksinasi($data))
			$this->session->set_userdata('message', 'Data Vaksinasi Berhasil Ditambahkan');
		else
			$this->session->set_userdata('error', 'Data Vaksinasi Gagal Ditambahkan');

		header("Location: ".site_url('Vaksinasi/index'));
	}
	public function edit(){
		$data = array(
			'Id' => $this->input->post('id_vaksinasi'),
			'Nama' => $this->input->post('nama'),
			'Keterangan' => $this->input->post('keterangan'),
		);

		if($this->Vaksinasi_model->edit_vaksinasi($data))
			$this->session->set_userdata('message', 'Data Vaksinasi Berhasil Diperbarui');
		else
			$this->session->set_userdata('error', 'Data Vaksinasi Gagal Diperbarui');

		header("Location: ".site_url('Vaksinasi/index'));
	}
	public function delete(){
		$id_vaksinasi = $this->input->post('id_vaksinasi');

		if($this->Vaksinasi_model->delete_vaksinasi($id_vaksinasi))
			$this->session->set_userdata('message', 'Data Vaksinasi Berhasil Dihapus');
		else
			$this->session->set_userdata('error', 'Data Vaksinasi Gagal Dihapus');

		header("Location: ".site_url('Vaksinasi/index'));
	}
}
