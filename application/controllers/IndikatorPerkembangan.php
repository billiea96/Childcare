<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IndikatorPerkembangan extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('KategoriIndikator_model');
        $this->load->model('IndikatorPerkembangan_model');
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
		$data['indikator'] = $this->IndikatorPerkembangan_model->get();

		$this->load->view('layout/header');
		$this->load->view('indikator_perkembangan/index',$data);
		$this->load->view('layout/footer');
	}
	public function add(){
		$data = array(
			'Indikator' => $this->input->post('indikator'),
			'Kategori_Indikator_Id' => $this->input->post('kategori'),
		);

		if($this->IndikatorPerkembangan_model->add($data))
			$this->session->set_userdata('message', 'Data Indikator Berhasil Ditambahkan');
		else
			$this->session->set_userdata('error', 'Data Indikator Gagal Ditambahkan');

		header("Location: ".site_url('IndikatorPerkembangan/index'));
	}
	public function edit(){
		$data = array(
			'Id' => $this->input->post('id_indikator'),
			'Indikator' => $this->input->post('indikator'),
			'Kategori_Indikator_Id' => $this->input->post('kategori'),
		);

		if($this->IndikatorPerkembangan_model->edit($data))
			$this->session->set_userdata('message', 'Data Indikator Berhasil Diperbarui');
		else
			$this->session->set_userdata('error', 'Data Indikator Gagal Diperbarui');

		header("Location: ".site_url('IndikatorPerkembangan/index'));
	}
	public function delete(){
		$id_indikator = $this->input->post('id_indikator');

		if($this->IndikatorPerkembangan_model->delete($id_indikator))
			$this->session->set_userdata('message', 'Data Indikator Berhasil Dihapus');
		else
			$this->session->set_userdata('error', 'Data Indikator Gagal Dihapus');

		header("Location: ".site_url('IndikatorPerkembangan/index'));
	}
}
