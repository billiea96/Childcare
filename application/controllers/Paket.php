<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paket extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Anak_model');
        $this->load->model('Paket_model');
        $this->load->model('DaftarPaket_model');
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

		$data['paket'] = $this->Paket_model->get_paket();

		$this->load->view('layout/header');
		$this->load->view('paket/index',$data);
		$this->load->view('layout/footer');
	}
	public function add(){
		$data = array(
			'Nama' => $this->input->post('nama'),
			'Biaya' => $this->input->post('biaya'),
			'MaxJam' => $this->input->post('maxJam'),
			'Keterangan' => $this->input->post('keterangan'),
		);

		if($this->Paket_model->add_paket($data))
			$this->session->set_userdata('message', 'Data Paket Berhasil Ditambahkan');
		else
			$this->session->set_userdata('error', 'Data Paket Gagal Ditambahkan');

		header("Location: ".site_url('Paket/index'));
	}
	public function edit(){
		$data = array(
			'Id' => $this->input->post('id_paket'),
			'Nama' => $this->input->post('nama'),
			'Biaya' => $this->input->post('biaya'),
			'MaxJam' => $this->input->post('maxJam'),
			'Keterangan' => $this->input->post('keterangan'),
		);

		if($this->Paket_model->edit_paket($data))
			$this->session->set_userdata('message', 'Data Paket Berhasil Diubah');
		else
			$this->session->set_userdata('error', 'Data Paket Gagal Diubah');

		header("Location: ".site_url('Paket/index'));
	}
	public function delete(){
		$id_paket = $this->input->post('id_paket');

		if($this->Paket_model->delete_paket($id_paket))
			$this->session->set_userdata('message', 'Data Pakets Berhasil Dihapus');
		else
			$this->session->set_userdata('error', 'Data Paket Gagal Dihapus');

		header("Location: ".site_url('Paket/index'));
	}
	public function ganti_paket(){
		if($_SESSION['hak_akses']!='ADMIN'){
     		header("Location: ".site_url('Anak/index'));
     	}
		
		$data['anak'] = $this->Anak_model->get_anak();
		$data['paket'] = $this->Paket_model->get_paket();

		$this->load->view('layout/header');
		$this->load->view('paket/ganti_paket',$data);
		$this->load->view('layout/footer');
	}
	public function simpan_ganti_paket(){
		$id_anak = $this->input->post('anak');
		$paket = $this->input->post('paket');

		$temp = $this->DaftarPaket_model->get_daftar_paket($id_anak);

		$this->DaftarPaket_model->set_non_aktif($id_anak,$temp['Id']);

		$data = array(
			'Tanggal' => date('Y-m').'-'.substr($temp['Tanggal'], 8,2),
			'TanggalAkhirBerlaku' =>  date('Y-m').'-'.substr($temp['Tanggal'], 8,2),
			'TanggalDaftar' => date('Y-m-d'),
			'StatusAktif' => 1,
			'Anak_Id' => $id_anak,
			'Paket_Id' => $paket,
		);

		if($this->DaftarPaket_model->add_daftar_paket($data))
			$this->session->set_userdata('message', 'Berhasil Ganti Paket');
		else
			$this->session->set_userdata('error', 'Gagal Mengganti Paket');

		header("Location: ".site_url('Paket/ganti_paket'));

	}
	public function tampil_paket(){
		$id_anak = $_POST['id_anak'];

		$temp = $this->DaftarPaket_model->get_daftar_paket($id_anak);

		$output='
			<label class="control-label col-sm-2" for="anak">Paket saat ini
            </label>
            <div class="col-md-3">
                <input type="text" class="form-control" disabled="" value="'.$temp["Nama"].'">
            </div>';

        echo $output;
	}
}
