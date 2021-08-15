<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KegiatanNonRutin extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('KegiatanNonRutin_model');
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
     	
		$data['kegiatan'] = $this->KegiatanNonRutin_model->get_kegiatan();

		$this->load->view('layout/header');
		$this->load->view('kegiatan_non_rutin/index',$data);
		$this->load->view('layout/footer');
	}
	public function add(){
		$data = array(
			'Nama' => $this->input->post('nama'),
			'DetailKegiatan' => $this->input->post('detailKegiatan'),
		);

		if($this->KegiatanNonRutin_model->add_kegiatan($data))
			$this->session->set_userdata('message', 'Data Kegiatan Non Rutin Berhasil Ditambahkan');
		else
			$this->session->set_userdata('error', 'Data Kegiatan Non Rutin Gagal Ditambahkan');

		header("Location: ".site_url('KegiatanNonRutin/index'));
	}
	public function edit(){
		$data = array(
			'Id' => $this->input->post('id_kegiatan'),
			'Nama' => $this->input->post('nama'),
			'DetailKegiatan' => $this->input->post('detailKegiatan'),
		);

		if($this->KegiatanNonRutin_model->edit_kegiatan($data))
			$this->session->set_userdata('message', 'Data Kegiatan Non Rutin Berhasil Diperbarui');
		else
			$this->session->set_userdata('error', 'Data Kegiatan Non Rutin Gagal Diperbarui');

		header("Location: ".site_url('KegiatanNonRutin/index'));
	}
	public function delete(){
		$id_kegiatan = $this->input->post('id_kegiatan');

		if($this->KegiatanNonRutin_model->delete_kegiatan($id_kegiatan))
			$this->session->set_userdata('message', 'Data Kegiatan Non Rutin Berhasil Dihapus');
		else
			$this->session->set_userdata('error', 'Data Kegiatan Non Rutin Gagal Dihapus');

		header("Location: ".site_url('KegiatanNonRutin/index'));
	}
}
