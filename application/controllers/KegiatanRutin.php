<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KegiatanRutin extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('KegiatanRutin_model');
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
		$data['kegiatan'] = $this->KegiatanRutin_model->get_kegiatan();

		$this->load->view('layout/header');
		$this->load->view('kegiatan_rutin/index',$data);
		$this->load->view('layout/footer');
	}
	public function add(){
		$hari='';

		if($this->input->post('senin'))
			$hari.='senin,';
		if($this->input->post('selasa'))
			$hari.='selasa,';
		if($this->input->post('rabu'))
			$hari.='rabu,';
		if($this->input->post('kamis'))
			$hari.='kamis,';
		if($this->input->post('jumat'))
			$hari.='jumat,';
		if($this->input->post('sabtu'))
			$hari.='sabtu';

		$data = array(
			'Nama' => $this->input->post('nama'),
			'Hari' => $hari,
			'JamMulai' => $this->input->post('jamMulai'),
			'JamSelesai' => $this->input->post('jamSelesai'),
			'DetailKegiatan' => $this->input->post('detailKegiatan'),
		);

		if($this->KegiatanRutin_model->add_kegiatan($data))
			$this->session->set_userdata('message', 'Data Kegiatan Rutin Berhasil Ditambahkan');
		else
			$this->session->set_userdata('error', 'Data Kegiatan Rutin Gagal Ditambahkan');

		header("Location: ".site_url('KegiatanRutin/index'));
	}
	public function edit(){
		$data = array(
			'Id' => $this->input->post('id_kegiatan'),
			'Nama' => $this->input->post('nama'),
			'Hari' => $this->input->post('hari'),
			'JamMulai' => $this->input->post('jamMulai'),
			'JamSelesai' => $this->input->post('jamSelesai'),
			'DetailKegiatan' => $this->input->post('detailKegiatan'),
		);

		if($this->KegiatanRutin_model->edit_kegiatan($data))
			$this->session->set_userdata('message', 'Data Kegiatan Rutin Berhasil Diperbarui');
		else
			$this->session->set_userdata('error', 'Data Kegiatan Rutin Gagal Diperbarui');

		header("Location: ".site_url('KegiatanRutin/index'));
	}
	public function delete(){
		$id_kegiatan = $this->input->post('id_kegiatan');

		if($this->KegiatanRutin_model->delete_kegiatan($id_kegiatan))
			$this->session->set_userdata('message', 'Data Kegiatan Rutin Berhasil Dihapus');
		else
			$this->session->set_userdata('error', 'Data Kegiatan Rutin Gagal Dihapus');

		header("Location: ".site_url('KegiatanRutin/index'));
	}
}
