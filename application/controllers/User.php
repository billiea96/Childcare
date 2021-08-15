<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Anak_model');
        $this->load->model('Karyawan_model');
        $this->load->model('User_model');
        $this->load->helper('url_helper');
        $this->load->helper('form');
    	$this->load->library('form_validation');
     	$this->load->library('session');
     	$this->load->library('csvimport');
     	$this->load->library('cart');
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
		$data['anak'] = $this->Anak_model->get_no_username();
		$data['karyawan'] = $this->Karyawan_model->get_no_username();

		$data['user_anak'] = $this->User_model->get_anak();
		$data['user_karyawan'] = $this->User_model->get_karyawan();

		$this->load->view('layout/header');
		$this->load->view('user/index',$data);
		$this->load->view('layout/footer');
	}
	public function add(){
		$anak = $this->input->post('anak');
		$karyawan = $this->input->post('karyawan');
		$hak_akses = $this->input->post('hak_akses');
		$username = $this->input->post('username');
		$pass = $this->input->post('pass');

		if($this->User_model->exist($username)){
			$this->session->set_userdata('error', 'Gagal Ditambahkan, karena username sudah ada');
			header("Location: ".site_url('User/index'));
		}else{
			$data = array(
				'Username' => $username,
				'Password' => sha1($pass),
				'HakAkses' => $hak_akses,
			);

			$this->User_model->add($data);

			if($hak_akses=="ANAK"){
				$data = array(
					'Id' => $anak,
					'Username' => $username,
				);

				$this->Anak_model->edit_anak($data);
			}else{
				$data = array(
					'Id' => $karyawan,
					'Username' => $username,
				);

				$this->Karyawan_model->edit_karyawan($data);
			}

			$this->session->set_userdata('message', 'Data User Berhasil Ditambahkan');
			header("Location: ".site_url('User/index'));
		}
		
	}
	public function edit(){
		$data = array(
			'Username' => $this->input->post('username'),
			'HakAkses' => $this->input->post('hak_akses'),
		);

		if($this->User_model->edit($data)){
			$this->session->set_userdata('message', 'Data User Berhasil Diedit');
		}else{
			$this->session->set_userdata('error', 'Data User gagal diedit');
		}
		header("Location: ".site_url('User/index'));
	}
	public function cek_username(){
		$username = $_POST['username'];

		if($this->User_model->exist($username)){
			echo 'TRUE';
		}else{
			echo 'FALSE';
		}
	}
	public function setting(){
		if($_SESSION['hak_akses']=='GUEST')
			header("Location: ".site_url('Pendaftaran/index'));
		$this->load->view('layout/header');
		$this->load->view('user/setting');
		$this->load->view('layout/footer');
	}
	public function simpan_setting(){
		$data = array(
			'Username' =>$_SESSION['username'],
			'Password' => $_SESSION['password'],
		);

		$username_baru = $this->input->post('username_baru');
		$pass_baru = sha1($this->input->post('pass_baru'));


		if($this->User_model->get_user_karyawan($data)){
			$temp = $this->User_model->get_user_karyawan($data);

			//dinullkan dulu
			$edit = array(
				'Id' => $temp['Id'],
				'Username' => null,
			);
			$this->Karyawan_model->edit_karyawan($edit);

			//update data baru pada database user
			$data2 = array(
				'Username' => $username_baru,
				'Password' => $pass_baru,
			);

			$this->User_model->edit2($_SESSION['username'],$data2);

			//update field username pada databasae karyawan
			$edit = array(
				'Id' => $temp['Id'],
				'Username' => $username_baru,
			);
			$this->Karyawan_model->edit_karyawan($edit);	

			//untuk mengeset session yang baru
			$user = $this->User_model->cek_user($data2);

			$sess_data['username'] = $user['Username'];
			$sess_data['password'] = $user['Password'];
			$sess_data['hak_akses'] = $user['HakAkses'];		

		}else if($this->User_model->get_user_anak($data)){
			$temp = $this->User_model->get_user_anak($data);

			//dinullkan dulu username pada anak
			$edit = array(
				'Id' => $temp['Id'],
				'Username' => null,
			);
			$this->Anak_model->edit_anak($edit);

			//update data baru pada dabatase user
			$data2 = array(
				'Username' => $username_baru,
				'Password' => $pass_baru,
			);

			$this->User_model->edit2($_SESSION['username'],$data2);

			//update field username pada database anak
			$edit = array(
				'Id' => $temp['Id'],
				'Username' => $username_baru,
			);
			$this->Anak_model->edit_anak($edit);

			//untuk mengeset data session yang baru
			$user = $this->User_model->cek_user($data2);

			$sess_data['username'] = $user['Username'];
			$sess_data['password'] = $user['Password'];
			$sess_data['hak_akses'] = $user['HakAkses'];		

		}else{
			//untuk set data session yang baru
			$data2 = array(
				'Username' => $username_baru,
				'Password' => $pass_baru,
			);

			$this->User_model->edit2($_SESSION['username'],$data2);

			$user = $this->User_model->cek_user($data2);

			$sess_data['username'] = $user['Username'];
			$sess_data['password'] = $user['Password'];
			$sess_data['hak_akses'] = $user['HakAkses'];		
		}

		$this->session->set_userdata($sess_data);
		
		$this->session->set_userdata('message', 'Data User Berhasil Diperbarui');
		header("Location: ".site_url('User/setting'));

	}
	public function cek_pass(){
		$data = array(
			'Username' =>$_SESSION['username'],
			'Password' => sha1($_POST['pass']),
		);
		if($this->User_model->cek_user($data)) {
			echo 'true';
		}else{
			echo 'false';
		}
	}
}
