<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Absensi_model');
        $this->load->model('Anak_model');
        $this->load->model('DaftarPaket_model');
        $this->load->model('BiayaOverTime_model');
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

		$this->cart->destroy();
		$data['absensi'] = $this->Absensi_model->get();

		$this->load->view('layout/header');
		$this->load->view('absensi/index',$data);
		$this->load->view('layout/footer');
	}
	public function add(){
		$tanggal='';
		$status=0;
		foreach ($this->cart->contents() as $key => $value) {
			$tanggal = DateTime::createFromFormat('Y-m-d', $value['Tanggal'])->format('d M Y');
			//untuk mengecek apakah udah ada ato tidak absensi pada hari itu
			if($this->Absensi_model->exist($value['Tanggal'],$value['id'])){
			}
			else{
				//untuk mendapatkan paket anak saat ini
				$paket = $this->DaftarPaket_model->get_daftar_paket($value['id']);

				$jamSeharusnya = strtotime($paket['MaxJam']);
				$jamPulang = strtotime($value['JamPulang']);
				$selisihJam=0;

				//jika ada keterlambatan
				if($jamPulang>$jamSeharusnya)
				{
					//Untuk menghitung selisih jam pulang dan jam seharusnya
					$selisihJam= round(abs($jamPulang - $jamSeharusnya) / 60,2);

					//insert ke tabel absensi
					$data = array(
						'JamDatang'		=> $value['JamDatang'],
						'JamPulang' 	=> $value['JamPulang'],
						'Tanggal'		=> $value['Tanggal'],
						'Status' 		=> 1,
						'Anak_Id'		=> $value['id'],
					); 

					$this->Absensi_model->add($data);

					//insert ke tabel biaya overtime
					$data = array(
						'Tanggal'  		=> $value['Tanggal'],
						'Biaya' 		=> 10000,
						'Anak_Id' 		=> $value['id'],
					);
					$this->BiayaOverTime_model->add($data);
				}
				else
				{
					//insert ke tabel absensi
					$data = array(
						'JamDatang'		=> $value['JamDatang'],
						'JamPulang' 	=> $value['JamPulang'],
						'Tanggal'		=> $value['Tanggal'],
						'Status' 		=> 0,
						'Anak_Id'		=> $value['id'],
					); 

					$this->Absensi_model->add($data);
				}
			}
		 }

		$this->session->set_userdata('message', 'Data Absensi Tanggal '.$tanggal.' Berhasil Ditambahkan');

		header("Location: ".site_url('Absensi/index'));
	}
	public function import(){
		$fileData = $this->csvimport->get_array($_FILES["csv_file"]["tmp_name"]);

		foreach ($fileData as $key => $value) {

			$anak = $this->Anak_model->get_anak($value['Anak_Id']);

			$data = array(
				'id' => $value['Anak_Id'],
				'name' => $anak['Nama'],
				'qty' => 1,
				'price' => 1,
				'JamDatang' => $value['JamDatang'],
				'JamPulang' => $value['JamPulang'],
				'Tanggal' => $value['Tanggal'],
			);

			$this->cart->insert($data);
			
		}

		echo $this->view_absensi();
	}
	public function view_absensi(){
		$count=0;
		$output='';

		foreach ($this->cart->contents() as $key => $value) {
			$count++;
			$output.='
				<tr>
					<td>'.$count.'</td>
					<td>'.$value["name"].'</td>
					<td>'.$value["JamDatang"].'</td>
					<td>'.$value["JamPulang"].'</td>
					<td>'.$value["Tanggal"].'</td>
				</tr>
			';
		}

		return $output;
	}
}
