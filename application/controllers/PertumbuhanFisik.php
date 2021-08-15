<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PertumbuhanFisik extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('PertumbuhanFisik_model');
        $this->load->model('RiwayatImunisasi_model');
        $this->load->model('RiwayatKesehatan_model');
        $this->load->model('Karyawan_model');
        $this->load->model('Anak_model');
        $this->load->model('Pendaftaran_model');
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
		if($_SESSION['hak_akses']!='ADMIN'&&$_SESSION['hak_akses']!='KEPERAWATAN'){
     		header("Location: ".site_url('Anak/index'));
     	}
		$data['anak'] = $this->Anak_model->get_anak();
		$data['karyawan'] = $this->Karyawan_model->get_perawat();

		$this->load->view('layout/header');
		$this->load->view('kesehatan/pertumbuhan_fisik',$data);
		$this->load->view('layout/footer');
	}
	public function add(){
		$anak = $this->Anak_model->get_anak($this->input->post('anak'));

		$lahir = $anak['TanggalLahir'];
		$date = date('Y-m-d');

		$diff = date_diff(date_create($lahir), date_create($date));
		$usia = $diff->format('%y');

		$perawat ='';
		if($_SESSION['hak_akses']=='ADMIN')
			$perawat = $this->input->post('perawat');
		else
			$perawat = $_SESSION['id'];

		$data= array(
			'Anak_Id' => $this->input->post('anak'),
			'Usia' => $usia,
			'Tanggal' => date('Y-m-d'),
			'BeratBadan' => $this->input->post('beratBadan'),
			'TinggiBadan' => $this->input->post('tinggiBadan'),
			'LingkarKepala' => $this->input->post('lingkarKepala'),
			'Perawat' => $perawat,
		);

		if($this->PertumbuhanFisik_model->exist($data["Anak_Id"],date('Y-m-d'))){
			$this->session->set_userdata('error','Data Pertumbuhan fisik anak ini pada bulan ini sudah ada');
		}else{
			$this->PertumbuhanFisik_model->add($data);
			$this->session->set_userdata('message','Data Pertumbuhan fisik berhasil ditambahkan');
		}

		header("Location: ".site_url('PertumbuhanFisik/index'));
	}
	public function daftar_pertumbuhan(){
		$id_anak = $_POST['id_anak'];

		$data = $this->PertumbuhanFisik_model->get_last_year($id_anak);

		$count=0;
		$output='';
		foreach ($data as $key => $value) {
			$count++;

			$output.='
				<tr>
					<td>'.$count.'</td>
					<td>'.$value["Usia"].' tahun</td>
					<td>'.DateTime::createFromFormat('Y-m-d', $value['Tanggal'])->format('d-m-Y').'</td>
					<td>'.$value["BeratBadan"].' kg</td>
					<td>'.$value["TinggiBadan"].' cm</td>
					<td>'.$value["LingkarKepala"].' cm</td>
				</tr>
			';
		}

		echo $output;
	}
	public function buat_laporan(){
		$data['anak'] = $this->Anak_model->get_anak();

		$this->load->view('layout/header');
		$this->load->view('kesehatan/buat_laporan',$data);
		$this->load->view('layout/footer');
	}
	public function simpan_laporan(){
		$anak = $this->input->post('anak');
		$kesimpulan = $this->input->post('kesimpulan');
		$saran = $this->input->post('saran');

		$temp =$this->PertumbuhanFisik_model->get_previous_month($anak);

		$data = array(
			'Id' => $temp['Id'],
			'Kesimpulan' => $kesimpulan,
			'Saran' => $saran,
			'StatusLaporan' => 1,
		);

		if($this->PertumbuhanFisik_model->edit($data)){
			$this->session->set_userdata('message','Laporan Kesehatan anak ini pada bulan ini berhasil dibuat');
		}else{
			$this->session->set_userdata('error','Laporan Kesehatan anak ini gagal dibuat');
		}

		header("Location: ".site_url('PertumbuhanFisik/buat_laporan'));

	}
	public function tampil_laporan(){
		$id_anak = $_POST['id_anak'];

		$status=0;
		$laporan="";
		$namaAnak="";
		$namaPerawat="";
		$usia=0;
		$tanggalSebelumnya='';$tanggal='';
		$beratBadanSebelumnya=0;$tinggiBadanSebelumnya=0;$lingkarKepalaSebelumnya=0;
		$beratBadan=0;$tinggiBadan=0;$lingkarKepala=0;
		$riwayatImunisasi='';
		$riwayatKesehatan='';
		$count=0;

		$datestring=date('Y-m-d').' first day of last month';
        $dt=date_create($datestring);
        $date = $dt->format('Y-m').'-01';
		if($this->PertumbuhanFisik_model->exist($id_anak,date('Y-m-d'))){
			if($this->PertumbuhanFisik_model->has_laporan($id_anak)['StatusLaporan']==1){
				$date = $dt->format('M Y');
				$status=1;
				$laporan="Laporan Kesehatan terakhir anak ini sudah dibuat, silahkan dilihat pada menu laporan";
			}
			else{
				$previous = $this->PertumbuhanFisik_model->get_previous_month($id_anak);
				$now = $this->PertumbuhanFisik_model->get_now($id_anak,date('Y-m-d'));

				$beratBadanSebelumnya=$previous["BeratBadan"];
				$tinggiBadanSebelumnya=$previous["TinggiBadan"];
				$lingkarKepalaSebelumnya=$previous["LingkarKepala"];
				$tanggalSebelumnya=DateTime::createFromFormat('Y-m-d', $previous["Tanggal"])->format('d M Y');


				$beratBadan=$now["BeratBadan"];
				$tinggiBadan=$now["TinggiBadan"];
				$lingkarKepala=$now["LingkarKepala"];

				$namaAnak=$now['NamaAnak'];
				$namaPerawat=$now['NamaKaryawan'];
				$usia=$now['Usia'];
				$tanggal=DateTime::createFromFormat('Y-m-d', $now["Tanggal"])->format('d M Y');;

				$temp_imunisasi = $this->RiwayatImunisasi_model->get_laporan($id_anak,$previous["Tanggal"],$now["Tanggal"]);

				foreach ($temp_imunisasi as $key => $value) {
					$count++;
					$riwayatImunisasi.='
						<tr>
							<td>'.$value["Nama"].'</td>
							<td>'.date("d-m-Y",strtotime($value["Tanggal"])).'</td>
						</tr>
					';
				}
				if($count==0)
					$riwayatImunisasi="<tr><td colspan='2'>Tidak ada riwayat imunisasi</td></tr>";

				$temp_kesehatan = $this->RiwayatKesehatan_model->get_laporan($id_anak,$previous["Tanggal"],$now["Tanggal"]);

				$count=0;
				foreach ($temp_kesehatan as $key => $value) {
					$count++;
					$riwayatKesehatan.='
						<tr>
							<td>'.$count.'</td>
							<td>'.date("d-m-Y",strtotime($value["Tanggal"])).'</td>
							<td>'.$value["Diagnosa"].'</td>
							<td>'.$value["Nama"].'</td>
							<td>'.$value["Catatan"].'</td>
						</tr>
					';
				}
				if($count==0)
					$riwayatKesehatan="<tr><td colspan='5'>Tidak ada riwayat kesehatan</td></tr>";

			}
		}
		else{
			$status=1;
			$laporan="Catatan pertumbuhan Fisik anak untuk bulan ini belum ada";
		}

		echo json_encode(array(
			'status' => $status,
			'laporan' => $laporan,
			'namaAnak' => $namaAnak,
			'namaPerawat' => $namaPerawat,
			'usia' => $usia,
			'beratBadanSebelumnya' => $beratBadanSebelumnya,
			'tinggiBadanSebelumnya' => $tinggiBadanSebelumnya,
			'lingkarKepalaSebelumnya' => $lingkarKepalaSebelumnya,
			'tanggalSebelumnya' => $tanggalSebelumnya,
			'beratBadan' => $beratBadan,
			'tinggiBadan' => $tinggiBadan,
			'lingkarKepala' => $lingkarKepala,
			'tanggal' => $tanggal,
			'riwayatImunisasi' => $riwayatImunisasi,
			'riwayatKesehatan' => $riwayatKesehatan,
		));
	}
}
