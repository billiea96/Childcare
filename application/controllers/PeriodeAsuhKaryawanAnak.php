<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PeriodeAsuhKaryawanAnak extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('PeriodeAsuh_model');
        $this->load->model('PeriodeAsuhKaryawanAnak_model');
        $this->load->model('Karyawan_model');
        $this->load->model('Anak_model');
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
		$data['periode_asuh']=$this->PeriodeAsuh_model->get_periode_asuh_aktif();
		$data['karyawan']=$this->Karyawan_model->get_pengasuh();
		$data['periode_asuh_karyawan_anak']=$this->PeriodeAsuhKaryawanAnak_model->get_periode_asuh_karyawan_anak();
		$data['anak'] = $this->Anak_model->get_tidak_ada_pengasuh();

		$this->load->view('layout/header');
		$this->load->view('periode_asuh_karyawan_anak/index',$data);
		$this->load->view('layout/footer');
	}
	public function add(){
		$idPeriode = $this->input->post('idPeriodeAsuh');
		$pengasuh = $this->input->post('pengasuh');
		$anak=$this->input->post('anak');

		$data=array(
			'Id' => $idPeriode."/".$pengasuh."/".$anak,
			'Periode_Asuh_Id' => $idPeriode,
			'Anak_Id' => $anak,
			'Karyawan_Id' => $pengasuh,
		);

		if($this->PeriodeAsuhKaryawanAnak_model->add_periode_asuh_karyawan_anak($data))
			$this->session->set_userdata('message', 'Data Pengasuh Anak Berhasil Ditambahkan');
		else
			$this->session->set_userdata('error', 'Data Pengasuh Anak Gagal Ditambahkan');

		header("Location: ".site_url('PeriodeAsuhKaryawanAnak/index'));
	}
	public function edit(){
		$idPengasuh = $this->input->post('idPengasuhAnak');
		$pengasuh = $this->input->post('pengasuh');
		$anak = $this->input->post('anak');

		$data = array(
			'Anak_Id' => $anak,
			'Karyawan_Id' => $pengasuh,
		);

		if($this->PeriodeAsuhKaryawanAnak_model->edit_periode_asuh_karyawan_anak($data,$idPengasuh))
			$this->session->set_userdata('message', 'Data Pengasuh Anak Berhasil Diubah');
		else
			$this->session->set_userdata('error', 'Data Pengasuh Anak Gagal Diubah');

		header("Location: ".site_url('PeriodeAsuhKaryawanAnak/index'));

	}
}
