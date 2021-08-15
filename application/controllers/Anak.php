<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anak extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Anak_model');
        $this->load->model('OrangTua_model');
        $this->load->model('Pendaftaran_model');
        $this->load->helper('url_helper');
        $this->load->helper('form');
        $this->load->helper('file');
    	$this->load->library('form_validation');
     	$this->load->library('session');
     	date_default_timezone_set('Asia/Jakarta');
     	if(empty($_SESSION['username'])){
     		header("Location: ".site_url('Auth/index'));
     	}
    }
	public function index()
	{	
		if($_SESSION['hak_akses']=='ANAK'){
     		header("Location: ".site_url('Anak/profil/'.$_SESSION['id']));
     	}else if($_SESSION['hak_akses']=='GUEST'){
     		header("Location: ".site_url('Pendaftaran/index/'));
     	}
     	
		$data['anak'] = $this->Anak_model->get_anak();

		$this->load->view('layout/header');
		$this->load->view('anak/index',$data);
		$this->load->view('layout/footer');
	}
	public function profil($id_anak=''){
		$data['anak'] = $this->Anak_model->get_anak($id_anak);
		$data['data_pendaftaran'] = $this->Pendaftaran_model->get_pendaftaran_anak($id_anak);
		$data['orangtua'] = $this->Anak_model->get_orangtua_byanak($id_anak);

		$this->load->view('layout/header');
		$this->load->view('anak/profil',$data);
		$this->load->view('layout/footer');
	}
	public function hitungUsia(){
		$id = $_POST['id'];
		$anak = $this->Anak_model->get_anak($id);

		$lahir = $anak['TanggalLahir'];
		$date = date('Y-m-d');

		$diff = date_diff(date_create($lahir), date_create($date));
		$usia = $diff->format('%y');

		echo json_encode($usia);
	}
	public function master(){
		if($_SESSION['hak_akses']!='ADMIN'){
     		header("Location: ".site_url('Anak/index'));
     	}
		$data['anak'] = $this->Anak_model->get();
		$data['orangtua'] = $this->OrangTua_model->get();

		$this->load->view('layout/header');
		$this->load->view('anak/master',$data);
		$this->load->view('layout/footer');
	}
	public function edit(){
		$tanggalLahir = $this->input->post('tanggalLahir');
		$tanggalLahir = date('Y-m-d',strtotime($tanggalLahir));

		$a= explode(".", $_FILES['foto']['name']);
	    $ext=$a[count($a)-1];
	    $foto= md5($_FILES['foto']['name']).time();
	    $foto=$foto.".".$ext;

	    $anak = $this->Anak_model->get($this->input->post('id_anak'));
	    $foto =$anak['Nama'].$foto;

	    if(is_uploaded_file($_FILES['foto']['tmp_name'])){
		    if(move_uploaded_file($_FILES['foto']['tmp_name'],"./public/foto_anak/".$foto))
	        {      
	        	$data = array(
	    			'Id' => $this->input->post('id_anak'),
	    			'Nama' => $this->input->post('nama'),
	    			'Panggilan' => $this->input->post('panggilan'),
	    			'TanggalLahir' => $tanggalLahir,
	    			'Kelamin' => $this->input->post('kelamin'),
	    			'Alergi' => $this->input->post('alergi'),
	    			'Dokter' => $this->input->post('dokter'),
	    			'NoTelpDokter' => $this->input->post('noTelpDokter'),
	    			'Foto' => $foto,
	    			'Orangtua_Id' => $this->input->post('orangtua'),
	    		);

	    		$this->Anak_model->edit_anak($data);

	    		$this->session->set_userdata('message', 'Data Anak Berhasil Diperbarui');
	        }else{
	        	$this->session->set_userdata('error', 'Data Anak Gagal Diperbarui');
	        }
    	}else{
    		$data = array(
    			'Id' => $this->input->post('id_anak'),
    			'Nama' => $this->input->post('nama'),
    			'Panggilan' => $this->input->post('panggilan'),
    			'TanggalLahir' => $tanggalLahir,
    			'Kelamin' => $this->input->post('kelamin'),
    			'Alergi' => $this->input->post('alergi'),
    			'Dokter' => $this->input->post('dokter'),
    			'NoTelpDokter' => $this->input->post('noTelpDokter'),
    			'Orangtua_Id' => $this->input->post('orangtua'),
    		);

    		$this->Anak_model->edit_anak($data);

    		$this->session->set_userdata('message', 'Data Anak Berhasil Diperbarui');
    	}
    	header("Location: ".site_url('Anak/master'));
	}
	public function delete(){
		$id_anak = $this->input->post('id_anak');

		if($this->Anak_model->delete_anak($id_anak))
			$this->session->set_userdata('message', 'Data Anak menjadi tidak aktif');
		else
			$this->session->set_userdata('error', 'Data Anak Gagal Menjadi Tidak Aktif');

		header("Location: ".site_url('Anak/master'));
	}
}
