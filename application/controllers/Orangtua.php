<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orangtua extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('OrangTua_model');
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
		$data['orangtua'] = $this->OrangTua_model->get();

		$this->load->view('layout/header');
		$this->load->view('orangtua/index',$data);
		$this->load->view('layout/footer');
	}
	public function edit(){
		$data = array(
			'Id' => $this->input->post('id_orangtua'),
			'NamaAyah' => $this->input->post('namaAyah'),
			'NamaIbu' => $this->input->post('namaIbu'),
			'NoHPAyah' => $this->input->post('noHPAyah'),
			'NoHPIbu' => $this->input->post('noHPIbu'),
			'AlamatRumahAyah' => $this->input->post('alamatRumahAyah'),
			'AlamatRumahIbu' => $this->input->post('alamatRumahIbu'),
			'AlamatKerjaAyah' => $this->input->post('alamatKerjaAyah'),
			'AlamatKerjaIbu' => $this->input->post('alamatKerjaIbu'),
			'JamKerjaAyah' => $this->input->post('jamKerjaAyah'),
			'JamKerjaIbu' => $this->input->post('jamKerjaIbu'),
			'NoTelpRumahAyah' => $this->input->post('noTelpRumahAyah'),
			'NoTelpRumahIbu' => $this->input->post('noTelpRumahIbu'),
			'NoTempatKerjaAyah' => $this->input->post('noTempatKerjaAyah'),
			'NoTempatKerjaIbu' => $this->input->post('noTempatKerjaIbu'),
		);

		if($this->OrangTua_model->edit_orangtua($data))
			$this->session->set_userdata('message', 'Data Orangtua Berhasil Diperbarui');
		else
			$this->session->set_userdata('error', 'Data Orangtua Gagal Diperbarui');

		header("Location: ".site_url('Orangtua/index'));
	}
	public function delete(){
		$id_orangtua = $this->input->post('id_orangtua');

		if($this->OrangTua_model->delete_orangtua($id_orangtua))
			$this->session->set_userdata('message', 'Data Orangtua Berhasil Dihapus');
		else
			$this->session->set_userdata('error', 'Data Orangtua Gagal Dihapus');

		header("Location: ".site_url('Orangtua/index'));
	}
}
