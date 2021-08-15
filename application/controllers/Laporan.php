<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Absensi_model');
        $this->load->model('Anak_model');
        $this->load->model('DaftarPaket_model');
        $this->load->model('BiayaOverTime_model');
        $this->load->model('FormHarian_model');
        $this->load->model('CatatanPerkembangan_model');
        $this->load->model('KegiatanRutinAnak_model');
        $this->load->model('KegiatanNonRutinAnak_model');
        $this->load->model('PertumbuhanFisik_model');
        $this->load->model('RiwayatImunisasi_model');
        $this->load->model('RiwayatKesehatan_model');
        $this->load->model('DaftarKatering_model');
        $this->load->model('CatatanPengeluaran_model');
        $this->load->model('Pembayaran_model');
        $this->load->helper('url_helper');
        $this->load->helper('form');
    	$this->load->library('form_validation');
     	$this->load->library('session');
     	$this->load->library('pdf');
     	$this->load->library('cart');
     	date_default_timezone_set('Asia/Jakarta');
     	if(empty($_SESSION['username'])){
     		header("Location: ".site_url('Auth/index'));
     	}
    }
	public function form_harian()
	{	
		if($_SESSION['hak_akses']=='KEPERAWATAN'||$_SESSION['hak_akses']=='GUEST'){
     		header("Location: ".site_url('Anak/index'));
     	}

		$data['anak']= $this->Anak_model->get_anak();
		$this->load->view('layout/header');
		$this->load->view('laporan/form_harian/form_harian',$data);
		$this->load->view('layout/footer');
	}
	public function laporan_form_harian(){
		$id_anak = $this->input->post('anak');
		$tanggal = $this->input->post('tanggal');
		$tanggal = DateTime::createFromFormat('d-m-Y', $tanggal)->format('Y-m-d');

		$data['form_harian'] = $this->FormHarian_model->get_laporan($id_anak,$tanggal);
		$data['daftar_obat_vit'] = $this->FormHarian_model->get_daftar_obat_vit($data['form_harian']['NoForm']);
		$data['catatan_makan'] = $this->FormHarian_model->get_catatan_makan($data['form_harian']['NoForm']);
		$data['catatan_snack'] = $this->FormHarian_model->get_catatan_snack($data['form_harian']['NoForm']);
		$data['catatan_minum_susu'] = $this->FormHarian_model->get_catatan_minum_susu($data['form_harian']['NoForm']);
		$data['catatan_bab'] = $this->FormHarian_model->get_catatan_bab($data['form_harian']['NoForm']);
		$data['catatan_tidur'] = $this->FormHarian_model->get_catatan_tidur($data['form_harian']['NoForm']);
		$data['barang'] = $this->FormHarian_model->get_barang_dibawa($data['form_harian']['NoForm']);
		
		$this->load->view('laporan/form_harian/lap_form_harian',$data);
	}
	public function form_perkembangan(){
		if($_SESSION['hak_akses']=='KEPERAWATAN'||$_SESSION['hak_akses']=='GUEST'){
     		header("Location: ".site_url('Anak/index'));
     	}
		$data['anak']= $this->Anak_model->get_anak();

		$this->load->view('layout/header');
		$this->load->view('laporan/form_perkembangan/form_perkembangan',$data);
		$this->load->view('layout/footer');
	}
	public function laporan_form_perkembangan(){
		$id_anak = $this->input->post('anak');
		$tanggal = $this->input->post('tanggal');

		$data['anak']= $this->Anak_model->get_anak($id_anak);

		$lahir = $data['anak']['TanggalLahir'];
		$date = date('Y-m-d');

		$diff = date_diff(date_create($lahir), date_create($date));
		$data['usia'] = $diff->format('%y');

		$data['laporan'] = $this->CatatanPerkembangan_model->get_laporan($id_anak,$tanggal);

		$this->load->view('laporan/form_perkembangan/lap_form_perkembangan',$data);
	}
	public function kegiatan_rutin(){
		if($_SESSION['hak_akses']=='KEPERAWATAN'||$_SESSION['hak_akses']=='GUEST'){
     		header("Location: ".site_url('Anak/index'));
     	}
		$data['anak']= $this->Anak_model->get_anak();

		$this->load->view('layout/header');
		$this->load->view('laporan/kegiatan_rutin/kegiatan_rutin',$data);
		$this->load->view('layout/footer');
	}
	public function laporan_kegiatan_rutin(){
		$id_anak = $this->input->post('anak');
		$tanggal = $this->input->post('tanggal');
		$data['tanggal'] = $tanggal;
		$tanggal = DateTime::createFromFormat('d-m-Y', $tanggal)->format('Y-m-d');

		$data['laporan'] = $this->KegiatanRutinAnak_model->get_laporan($id_anak,$tanggal);
		$data['anak']= $this->Anak_model->get_anak($id_anak);


		$this->load->view('laporan/kegiatan_rutin/lap_kegiatan_rutin',$data);
	}
	public function kegiatan_non_rutin(){
		if($_SESSION['hak_akses']=='KEPERAWATAN'||$_SESSION['hak_akses']=='GUEST'){
     		header("Location: ".site_url('Anak/index'));
     	}
		$data['anak']= $this->Anak_model->get_anak();

		$this->load->view('layout/header');
		$this->load->view('laporan/kegiatan_non_rutin/kegiatan_non_rutin',$data);
		$this->load->view('layout/footer');
	}
	public function laporan_kegiatan_non_rutin(){
		$id_anak = $this->input->post('anak');
		$tanggal = $this->input->post('tanggal');
		$data['tanggal'] = $tanggal;
		$tanggal = DateTime::createFromFormat('d-m-Y', $tanggal)->format('Y-m-d');

		$data['laporan'] = $this->KegiatanNonRutinAnak_model->get_laporan($id_anak,$tanggal);
		$data['anak']= $this->Anak_model->get_anak($id_anak);


		$this->load->view('laporan/kegiatan_non_rutin/lap_kegiatan_non_rutin',$data);
	}
	public function form_kesehatan(){
		if($_SESSION['hak_akses']=='NANNY'||$_SESSION['hak_akses']=='GUEST'){
     		header("Location: ".site_url('Anak/index'));
     	}
		$data['anak']= $this->Anak_model->get_anak();

		$this->load->view('layout/header');
		$this->load->view('laporan/form_kesehatan/form_kesehatan',$data);
		$this->load->view('layout/footer');
	}
	public function laporan_form_kesehatan(){
		$id_anak = $this->input->post('anak');
		$tanggal = $this->input->post('tanggal').'-05';

		$datestring=$tanggal.' first day of last month';
        $dt=date_create($datestring);
        $data['tanggal']= 'Bulan '.date('M Y',strtotime($tanggal));

		$data['anak']= $this->Anak_model->get_anak($id_anak);


		$data['pertumbuhan']= $this->PertumbuhanFisik_model->get_by_date($id_anak,$tanggal);
		$data['pertumbuhan2']= $this->PertumbuhanFisik_model->get_next_month($id_anak,$data['pertumbuhan']['Tanggal']);

		$data['riwayat_imunisasi'] = $this->RiwayatImunisasi_model->get_laporan($id_anak,$data['pertumbuhan']['Tanggal'],$data['pertumbuhan2']['Tanggal']);
		$data['riwayat_kesehatan'] = $this->RiwayatKesehatan_model->get_laporan($id_anak,$data['pertumbuhan']['Tanggal'],$data['pertumbuhan2']['Tanggal']);
		
		$this->load->view('laporan/form_kesehatan/lap_form_kesehatan',$data);
	}
	public function absensi(){
		if($_SESSION['hak_akses']!='ADMIN'&&$_SESSION['hak_akses']!='KEPALA TPA'){
     		header("Location: ".site_url('Anak/index'));
     	}
		$data['anak']= $this->Anak_model->get_anak();

		$this->load->view('layout/header');
		$this->load->view('laporan/absensi/absensi',$data);
		$this->load->view('layout/footer');
	}
	public function laporan_absensi(){
		$tanggal_awal = $this->input->post('tanggal_awal');
		$tanggal_awal = DateTime::createFromFormat('d-m-Y', $tanggal_awal)->format('Y-m-d');
		$tanggal_akhir = $this->input->post('tanggal_akhir');
		$tanggal_akhir = DateTime::createFromFormat('d-m-Y', $tanggal_akhir)->format('Y-m-d');
		$id_anak = $this->input->post('anak');

		$data['anak']= $this->Anak_model->get_anak($id_anak);
		$data['absensi'] = $this->Absensi_model->get_laporan($id_anak,$tanggal_awal,$tanggal_akhir);
		$data['tanggal_awal'] = $this->input->post('tanggal_awal');
		$data['tanggal_akhir'] = $this->input->post('tanggal_akhir');

		$this->load->view('laporan/absensi/lap_absensi',$data);
	}
	public function katering(){
		if($_SESSION['hak_akses']!='ADMIN'&&$_SESSION['hak_akses']!='ANAK'&&$_SESSION['hak_akses']!='KEPALA TPA'){
     		header("Location: ".site_url('Anak/index'));
     	}
		$data['anak']= $this->Anak_model->get_anak();

		$this->load->view('layout/header');
		$this->load->view('laporan/katering/katering',$data);
		$this->load->view('layout/footer');
	}
	public function laporan_katering(){
		$id_anak = $this->input->post('anak');
		$tanggal = $this->input->post('tanggal');

		$data['anak']= $this->Anak_model->get_anak($id_anak);
		$data['katering'] = $this->DaftarKatering_model->get_laporan($id_anak,$tanggal);

		$this->load->view('laporan/katering/lap_katering',$data);
	}
	public function catatan_pengeluaran(){
		if($_SESSION['hak_akses']!='ADMIN'&&$_SESSION['hak_akses']!='KEPALA TPA'){
     		header("Location: ".site_url('Anak/index'));
     	}
		$data['anak']= $this->Anak_model->get_anak();

		$this->load->view('layout/header');
		$this->load->view('laporan/catatan_pengeluaran/catatan_pengeluaran',$data);
		$this->load->view('layout/footer');
	}
	public function laporan_pengeluaran(){
		$tanggal = $this->input->post('tanggal');

		$data['laporan'] = $this->CatatanPengeluaran_model->get_laporan($tanggal);
		$data['tanggal'] = $tanggal;

		$this->load->view('laporan/catatan_pengeluaran/lap_catatan_pengeluaran',$data);
	}
	public function pembayaran(){
		if($_SESSION['hak_akses']!='ADMIN'&&$_SESSION['hak_akses']!='ANAK'&&$_SESSION['hak_akses']!='KEPALA TPA'){
     		header("Location: ".site_url('Anak/index'));
     	}
		$data['anak']= $this->Anak_model->get_anak();

		$this->load->view('layout/header');
		$this->load->view('laporan/pembayaran/pembayaran',$data);
		$this->load->view('layout/footer');
	}
	public function laporan_pembayaran(){
		$id_anak = $this->input->post('anak');
		$tahun = $this->input->post('tahun');

		$data['anak']= $this->Anak_model->get_anak($id_anak);
		$data['laporan']= $this->Pembayaran_model->get_laporan($id_anak,$tahun);
		$data['tahun'] = $tahun;

		$this->load->view('laporan/pembayaran/lap_pembayaran',$data);
	}
}
