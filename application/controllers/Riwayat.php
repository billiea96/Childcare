<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Riwayat extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Anak_model');
        $this->load->model('Riwayat_model');
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
     	
     	$data['anak'] = $this->Anak_model->get_anak();
		$this->load->view('layout/header');
		$this->load->view('riwayat/index',$data);
		$this->load->view('layout/footer');
	}
	public function tampil_riwayat(){
		$id_anak = $_POST['id_anak'];
		$riwayat = $_POST['riwayat'];
		$bulan = $_POST['bulan'];
		$tahun = $_POST['tahun'];

		$html='';
		switch ($riwayat) {
			case 1:
				$data = $this->Riwayat_model->catatan_makan($id_anak,$bulan,$tahun);
				$html=
				'<thead>
					<tr>
						<th style="text-align:center;" class="col-sm-2">Tanggal</th>
						<th style="text-align:center;"  class="col-sm-3">Jenis</th>
						<th style="text-align:center;"  class="col-sm-2">Waktu</th>
						<th style="text-align:center;"  class="col-sm-5">Keterangan</th>
					</tr>
				</thead><tbody>';

				foreach ($data as $key => $value) {
					$html.=
					'<tr>
						<td>'.date("d-m-Y",strtotime($value["Tanggal"])).'</td>
						<td>'.$value["Jenis"].'</td>
						<td>'.$value["Waktu"].'</td>
						<td>'.$value["Keterangan"].'</td>
					</tr>
					';
				}
				break;

			case 2:
				$data = $this->Riwayat_model->catatan_snack($id_anak,$bulan,$tahun);
				$html=
				'<thead>
					<tr>
						<th style="text-align:center;" class="col-sm-2">Tanggal</th>
						<th style="text-align:center;"  class="col-sm-3">Jenis</th>
						<th style="text-align:center;"  class="col-sm-2">Waktu</th>
						<th style="text-align:center;"  class="col-sm-5">Keterangan</th>
					<tr>
				</thead><tbody>';

				foreach ($data as $key => $value) {
					$html.=
					'<tr>
						<td>'.date("d-m-Y",strtotime($value["Tanggal"])).'</td>
						<td>'.$value["Jenis"].'</td>
						<td>'.$value["Waktu"].'</td>
						<td>'.$value["Keterangan"].'</td>
					</tr>
					';
				}
				break;

			case 3:
				$data = $this->Riwayat_model->catatan_minum_susu($id_anak,$bulan,$tahun);
				$html=
				'<thead>
					<tr>
						<th style="text-align:center;" class="col-sm-2">Tanggal</th>
						<th style="text-align:center;"  class="col-sm-3">Waktu</th>
						<th style="text-align:center;"  class="col-sm-2">CC</th>
						<th style="text-align:center;"  class="col-sm-5">Keterangan</th>
					<tr>
				</thead><tbody>';

				foreach ($data as $key => $value) {
					$html.=
					'<tr>
						<td>'.date("d-m-Y",strtotime($value["Tanggal"])).'</td>
						<td>'.$value["Waktu"].'</td>
						<td>'.$value["CC"].'</td>
						<td>'.$value["Keterangan"].'</td>
					</tr>
					';
				}
				break;
			case 4:
				$data = $this->Riwayat_model->catatan_obat_vit($id_anak,$bulan,$tahun);
				$html=
				'<thead>
					<tr>
						<th style="text-align:center;" class="col-sm-2">Tanggal</th>
						<th style="text-align:center;" class="col-sm-3">Nama</th>
						<th style="text-align:center;" class="col-sm-1">Dosis</th>
						<th style="text-align:center;" class="col-sm-1">Jadwal Minum</th>
						<th style="text-align:center;" class="col-sm-1">Waktu Pemberian</th>
						<th style="text-align:center;" class="col-sm-2">Pemberi</th>
						<th style="text-align:center;" class="col-sm-2">Penanggung Jawab</th>
					<tr>
				</thead><tbody>';

				foreach ($data as $key => $value) {
					$html.=
					'<tr>
						<td>'.date("d-m-Y",strtotime($value["Tanggal"])).'</td>
						<td>'.$value["Nama"].'</td>
						<td>'.$value["Dosis"].'</td>
						<td>'.$value["JadwalMinum"].'</td>
						<td>'.$value["WaktuPemberian"].'</td>
						<td>'.$value["Pemberi"].'</td>
						<td>'.$value["PenanggungJawab"].'</td>
					</tr>
					';
				}
				break;
			case 5:
				$data = $this->Riwayat_model->catatan_tidur($id_anak,$bulan,$tahun);
				$html=
				'<thead>
					<tr>
						<th style="text-align:center;" class="col-sm-4">Tanggal</th>
						<th style="text-align:center;" class="col-sm-4">Jam Tidur</th>
						<th style="text-align:center;" class="col-sm-4">Jam Bangun</th>
					<tr>
				</thead><tbody>';

				foreach ($data as $key => $value) {
					$html.=
					'<tr>
						<td>'.date("d-m-Y",strtotime($value["Tanggal"])).'</td>
						<td>'.$value["JamMulaiTidur"].'</td>
						<td>'.$value["JamBangun"].'</td>
					</tr>
					';
				}
				break;
			case 6:
				$data = $this->Riwayat_model->catatan_bab($id_anak,$bulan,$tahun);
				$html=
				'<thead>
					<tr>
						<th style="text-align:center;" class="col-sm-3">Tanggal</th>
						<th style="text-align:center;" class="col-sm-2">Waktu</th>
						<th style="text-align:center;" class="col-sm-7">Keterangan</th>
					<tr>
				</thead><tbody>';

				foreach ($data as $key => $value) {
					$html.=
					'<tr>
						<td>'.date("d-m-Y",strtotime($value["Tanggal"])).'</td>
						<td>'.$value["Waktu"].'</td>
						<td>'.$value["Keterangan"].'</td>
					</tr>
					';
				}
				break;
			case 7:
				$data = $this->Riwayat_model->kesehatan($id_anak,$bulan,$tahun);
				$html=
				'<thead>
					<tr>
						<th style="text-align:center;" class="col-sm-2">Tanggal</th>
						<th style="text-align:center;" class="col-sm-3">Diagnosa</th>
						<th style="text-align:center;" class="col-sm-2">Terapi</th>
						<th style="text-align:center;" class="col-sm-5">Catatan</th>
					<tr>
				</thead><tbody>';

				foreach ($data as $key => $value) {
					$html.=
					'<tr>
						<td>'.date("d-m-Y",strtotime($value["Tanggal"])).'</td>
						<td>'.$value["Diagnosa"].'</td>
						<td>'.$value["Nama"].'</td>
						<td>'.$value["Catatan"].'</td>
					</tr>
					';
				}
				break;
			case 8:
				$data = $this->Riwayat_model->imunisasi($id_anak,$bulan,$tahun);
				$html=
				'<thead>
					<tr>
						<th style="text-align:center;" class="col-sm-3">Tanggal</th>
						<th style="text-align:center;" class="col-sm-3">Nama</th>
						<th style="text-align:center;" class="col-sm-6">Catatan</th>
					<tr>
				</thead><tbody>';

				foreach ($data as $key => $value) {
					$html.=
					'<tr>
						<td>'.date("d-m-Y",strtotime($value["Tanggal"])).'</td>
						<td>'.$value["Nama"].'</td>
						<td>'.$value["Catatan"].'</td>
					</tr>
					';
				}
				break;

			
			default:
				# code...
				break;
		}
		$html.="</tbody>";

		echo $html;
	}
}
