<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index() {
		$this->load->helper('url_helper');
        $this->load->library('session');
		if(empty($_SESSION['username'])){
     		$this->load->view('login');
     	}else{
     		header("Location: ".site_url('Anak/index/'));
     	}
		
	}

	public function login() {
		$data = array(
			'Username' =>addslashes($this->input->post('username')),
			'Password' => addslashes(sha1($this->input->post('password'))),
		);

		$this->load->helper('url_helper');
        $this->load->library('session');
		$this->load->model('User_model'); // load model_user
		$this->load->model('Pembayaran_model');

		if ($this->User_model->cek_user($data)) {
			$user = $this->User_model->cek_user($data);

			$sess_data['username'] = $user['Username'];
			$sess_data['password'] = $user['Password'];
			$sess_data['hak_akses'] = $user['HakAkses'];


			if($this->User_model->get_user_karyawan($data)){
				$temp = $this->User_model->get_user_karyawan($data);

				$sess_data['id'] = $temp['Id'];
				$sess_data['nama'] = $temp['Nama'];
			}else if($this->User_model->get_user_anak($data)){
				$temp = $this->User_model->get_user_anak($data);

				$sess_data['id'] = $temp['Id'];
				$sess_data['nama'] = $temp['Nama'];

				if($this->Pembayaran_model->get_belum_lunas($temp['Id'],date('m'))){
					$sess_data['notif_tagihan'] = "Anda belum membayar tagihan pada bulan ini. <a href='".site_url('Pembayaran/tampil_tagihan')."'>Lihat.</a>";
					$sess_data['notif_tagihan2'] = "Anda belum membayar tagihan pada bulan ini. <a href='".site_url('Pembayaran/tampil_tagihan')."'>Lihat.</a>";					
				}
			}else{
				$sess_data['nama'] = 'Guest';
			}

			$this->session->set_userdata($sess_data);

			header("Location: ".site_url('Anak/index'));
		}
		else {
			echo "<script>alert('Gagal login: username atau password salah!');history.go(-1);</script>";
		}
	}
	public function logout(){
		$this->load->helper('url_helper');
        $this->load->library('session');
		$this->load->model('User_model');
		
		unset($_SESSION['username']);
		unset($_SESSION['password']);
		unset($_SESSION['hak_akses']);
		unset($_SESSION['notif_tagihan']);
		unset($_SESSION['notif_tagihan2']);

		unset($_SESSION['id']);
		unset($_SESSION['nama']);


		header("Location: ".site_url('Auth/index'));
	}

}
