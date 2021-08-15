<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Jabatan_model');
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
     	
		$data['IdKaryawan'] = date('dmY').'-'.date('his');
		$data['jabatan'] = $this->Jabatan_model->get_jabatan();
		$data['karyawan'] = $this->Karyawan_model->get_karyawan();

		$this->load->view('layout/header');
		$this->load->view('karyawan/index',$data);
		$this->load->view('layout/footer');
	}
	public function add(){
		$data = array(
			'Id' => $this->input->post('IdKaryawan'),
			'Nama' => $this->input->post('nama'),
			'Alamat' => $this->input->post('alamat'),
			'NoHP' => $this->input->post('noHP'),
			'Jabatan_Id' => $this->input->post('jabatan')
		);

		if($this->Karyawan_model->add_karyawan($data))
			$this->session->set_userdata('message', 'Data Karyawan Berhasil Ditambahkan');
		else
			$this->session->set_userdata('error', 'Data Karyawan Gagal Ditambahkan');

		header("Location: ".site_url('Karyawan/index'));
	}
	public function edit(){
		$data = array(
			'Id' => $this->input->post('id_karyawan'),
			'Nama' => $this->input->post('nama'),
			'Alamat' => $this->input->post('alamat'),
			'NoHP' => $this->input->post('noHP'),
			'Jabatan_Id' => $this->input->post('jabatan')
		);

		if($this->Karyawan_model->edit_karyawan($data))
			$this->session->set_userdata('message', 'Data Karyawan Berhasil Diperbarui');
		else
			$this->session->set_userdata('error', 'Data Karyawan Gagal Diperbarui');

		header("Location: ".site_url('Karyawan/index'));
	}
	public function delete(){
		$id_karyawan = $this->input->post('id_karyawan');

		if($this->Karyawan_model->delete_karyawan($id_karyawan))
			$this->session->set_userdata('message', 'Data Karyawan Berhasil Dihapus');
		else
			$this->session->set_userdata('error', 'Data karyawan Gagal Dihapus');

		header("Location: ".site_url('Karyawan/index'));
	}
}
