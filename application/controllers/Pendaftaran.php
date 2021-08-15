<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Pertanyaan_model');
        $this->load->model('OrangTua_model');
        $this->load->model('Anak_model');
        $this->load->model('DataFormPendaftaran_model');
        $this->load->model('Pendaftaran_model');
        $this->load->model('Paket_model');
        $this->load->model('DaftarPaket_model');
        $this->load->helper('url_helper');
        $this->load->helper('form');
    	$this->load->library('form_validation');
     	$this->load->library('session');
     	$this->load->library('pdf');
     	date_default_timezone_set('Asia/Jakarta');
     	if(empty($_SESSION['username'])){
     		header("Location: ".site_url('Auth/index'));
     	}
    }
	public function index()
	{	
		if($_SESSION['hak_akses']!='ADMIN'&&$_SESSION['hak_akses']!='GUEST'){
     		header("Location: ".site_url('Anak/index'));
     	}
		$data['pertanyaan'] = $this->Pertanyaan_model->get_pertanyaan();
		$data['paket'] = $this->Paket_model->get_paket();

		$this->load->view('layout/header');
		$this->load->view('pendaftaran/index',$data);
		$this->load->view('layout/footer');
	}
	public function simpan(){
		//Halaman 1
		//data anak
		$namaAnak = $this->input->post('NamaAnak');
		$namaPanggilan = $this->input->post('NamaPanggilan');
		$tanggalLahir = $this->input->post('TanggalLahir');
		$tanggalLahir = DateTime::createFromFormat('d-m-Y', $tanggalLahir)->format('Y-m-d');
		$gender = $this->input->post('Gender');
		$namaDokter = $this->input->post('NamaDokter');
		$telpDokter = $this->input->post('TelpDokter');

		//data ayah
		$namaAyah = $this->input->post('NamaAyah');
		$alamatAyah = $this->input->post('AlamatAyah');
		$telpAyah = $this->input->post('NoTelpAyah');
		$noTempatKerjaAyah = $this->input->post('NoTempatKerjaAyah');
		$noHPAyah = $this->input->post('NoHPAyah');
		$alamatKerjaAyah = $this->input->post('AlamatKerjaAyah');
		$lamaKerjaAyah = $this->input->post('LamaKerjaAyah');

		//data ibu
		$namaIbu = $this->input->post('NamaIbu');
		$alamatIbu = $this->input->post('AlamatIbu');
		$noTelpIbu = $this->input->post('NoTelpIbu');
		$noTempatKerjaIbu = $this->input->post('NoTempatKerjaIbu');
		$noHPIbu = $this->input->post('NoHPIbu');
		$alamatKerjaIbu = $this->input->post('AlamatKerjaIbu');
		$lamaKerjaIbu = $this->input->post('LamaKerjaIbu');

		//data orang lain
		$namaOrangLain1 = $this->input->post('NamaOrangLain1');
		if($namaOrangLain1=='')
			$namaOrangLain1='-';
		
		$hubunganDenganAnak1 = $this->input->post('HubunganDenganAnak1');
		if($hubunganDenganAnak1=='')
			$hubunganDenganAnak1='-';
		
		$noTelpOrang1 = $this->input->post('NoTelpOrang1');
		if($noTelpOrang1=='')
			$noTelpOrang1='-';
		
		$noHPOrang1 = $this->input->post('NoHPOrang1');
		if($noHPOrang1=='')
			$noHPOrang1='-';
		
		$noTelpKerjaOrang1 = $this->input->post('NoTelpKerjaOrang1');
		if($noTelpKerjaOrang1=='')
			$noTelpKerjaOrang1='-';

		$namaOrangLain2 = $this->input->post('NamaOrangLain2');
		if($namaOrangLain2=='')
			$namaOrangLain2='-';

		$hubunganDenganAnak2 = $this->input->post('HubunganDenganAnak2');
		if($hubunganDenganAnak2=='')
			$hubunganDenganAnak2='-';

		$noTelpOrang2 = $this->input->post('NoTelpOrang2');
		if($noTelpOrang2=='')
			$noTelpOrang2='-';

		$noHPOrang2 = $this->input->post('NoHPOrang2');
		if($noHPOrang2=='')
			$noHPOrang2='-';

		$noTelpKerjaOrang2 = $this->input->post('NoTelpKerjaOrang2');
		if($noTelpKerjaOrang2=='')
			$noTelpKerjaOrang2='-';

		//data orang lain lagi
		$orangLain3 = $this->input->post('OrangLain3');
		if($orangLain3=='')
			$orangLain3='-';

		$noOrangLain3 = $this->input->post('NoOrangLain3');
		if($noOrangLain3=='')
			$noOrangLain3='-';

		$orangLain4 = $this->input->post('OrangLain4');
		if($orangLain4=='')
			$orangLain4='-';

		$noOrangLain4 = $this->input->post('NoOrangLain4');	
		if($noOrangLain4=='')
			$noOrangLain4='-';

		$orangLain5 = $this->input->post('OrangLain5');
		if($orangLain5=='')
			$orangLain5='-';

		$noOrangLain5 = $this->input->post('NoOrangLain5');
		if($noOrangLain5=='')
			$noOrangLain5='-';

		//data anak lainnya
		$namaAnakLain1 = $this->input->post('NamaAnakLain1');
		if($namaAnakLain1=='')
			$namaAnakLain1='-';

		$tanggalLahirLain1 = $this->input->post('TanggalLahirLain1');
		if($tanggalLahirLain1=='')
			$tanggalLahirLain1='-';

		$namaAnakLain2 = $this->input->post('NamaAnakLain2');
		if($namaAnakLain2=='')
			$namaAnakLain2='-';

		$tanggalLahirLain2 = $this->input->post('TanggalLahirLain2');
		if($tanggalLahirLain2=='')
			$tanggalLahirLain2='-';

		$namaAnakLain3 = $this->input->post('NamaAnakLain3');
		if($namaAnakLain3=='')
			$namaAnakLain3='-';

		$tanggalLahirLain3 = $this->input->post('TanggalLahirLain3');
		if($tanggalLahirLain3=='')
			$tanggalLahirLain3='-';

		//Menyimpan Data Orang Tua
		$orangtua = array();
		$id=0;
		if($this->OrangTua_model->get_last_orangtua()){
			$temp = $this->OrangTua_model->get_last_orangtua();
			$id = $temp['Id']+1;
		}else
			$id=1;
		
		$orangtua['Id'] = $id;
		$orangtua['NamaAyah'] = $namaAyah;

		if($noHPAyah=='')
			$orangtua['NoHPAyah'] = '-';
		else
			$orangtua['NoHPAyah'] = $noHPAyah;

		if($alamatKerjaAyah=='')
			$orangtua['AlamatKerjaAyah'] = '-';
		else
			$orangtua['AlamatKerjaAyah'] = $alamatKerjaAyah;

		if($lamaKerjaAyah=='')
			$orangtua['JamKerjaAyah'] = '-';
		else
			$orangtua['JamKerjaAyah'] = $lamaKerjaAyah;

		$orangtua['NamaIbu'] = $namaIbu;

		if($noHPIbu=='')
			$orangtua['NoHPIbu'] = '-';
		else
			$orangtua['NoHPIbu'] = $noHPIbu;

		if($alamatKerjaIbu=='')
			$orangtua['AlamatKerjaIbu'] = '-';
		else
			$orangtua['AlamatKerjaIbu'] = $alamatKerjaIbu;

		if($lamaKerjaIbu=='')
			$orangtua['JamKerjaIbu'] = '-';
		else
			$orangtua['JamKerjaIbu'] = $lamaKerjaIbu;

		if($alamatAyah=='')
			$orangtua['AlamatRumahAyah'] = '-';
		else
			$orangtua['AlamatRumahAyah'] = $alamatAyah;

		if($alamatIbu=='')
			$orangtua['AlamatRumahIbu'] = '-';
		else
			$orangtua['AlamatRumahIbu'] = $alamatIbu;

		if($noHPAyah=='')
			$orangtua['NoHPAyah'] = '-';
		else
			$orangtua['NoHPAyah'] = $noHPAyah;

		if($telpAyah=='')
			$orangtua['NoTelpRumahAyah'] = '-';
		else
			$orangtua['NoTelpRumahAyah'] = $telpAyah;

		if($noTelpIbu=='')
			$orangtua['NoTelpRumahIbu'] = '-';
		else
			$orangtua['NoTelpRumahIbu'] = $noTelpIbu;

		if($noTempatKerjaAyah=='')
			$orangtua['NoTempatKerjaAyah'] = '-';
		else
			$orangtua['NoTempatKerjaAyah'] = $noTempatKerjaAyah;

		if($noTempatKerjaIbu=='')
			$orangtua['NoTempatKerjaIbu'] = '-';
		else
			$orangtua['NoTempatKerjaIbu'] = $noTempatKerjaIbu;
		//insert ke model orang tua
		$this->OrangTua_model->add_orangtua($orangtua);

		//simpan data anak
		$anak=array();
		if($this->Anak_model->get_last_anak()){
			$temp = $this->Anak_model->get_last_anak();
			$id = $temp['Id']+1;
		}else
			$id=1;
		
		$temp= $this->OrangTua_model->get_last_orangtua();
		$anak['OrangTua_Id']= $temp['Id'];
		$anak['Id'] = $id;

		$anak['Nama'] = $namaAnak;
		if($namaPanggilan=='')
			$anak['Panggilan'] = '-';
		else
			$anak['Panggilan'] = $namaPanggilan;
		$anak['TanggalLahir'] = $tanggalLahir;
		$anak['Kelamin'] = $gender;
		$anak['Alergi'] ='-';

		if($namaDokter=='')
			$anak['Dokter'] = '-';
		else
			$anak['Dokter'] = $namaDokter;

		if($telpDokter=='')
			$anak['NoTelpDokter'] = '-';
		else
			$anak['NoTelpDokter'] = $telpDokter;

		if($_SESSION['hak_akses']=='GUEST'){
			$anak['Hapus'] =1;
		}
		//insert ke anak model
		$this->Anak_model->add_anak($anak);

		//simpan data form pendaftaran
		$tempAnak = $this->Anak_model->get_last_anak();

		if($_SESSION['hak_akses']=='GUEST'){
			$pendaftaran = array(
				'Tanggal' => date('Y-m-d'),
				'Anak_Id' => $tempAnak['Id']
			);
			//insert ke pendaftaran model
			$this->Pendaftaran_model->add_pendaftaran($pendaftaran);
		}else{
			$pendaftaran = array(
				'Tanggal' => date('Y-m-d'),
				'Anak_Id' => $tempAnak['Id'],
				'StatusValidasi' =>1,
			);
			//insert ke pendaftaran model
			$this->Pendaftaran_model->add_pendaftaran($pendaftaran);
		}
		

		//simpan data form pendaftaran
		$temp = $this->Pendaftaran_model->get_last_pendaftaran();
		$idAnak = $tempAnak['Id'];
		$noForm = $temp['NoForm'];

		$dataForm = array(
			'IdData' => $noForm.'/1/1',
			'Id' => 1,
			'NoForm' => $noForm,
			'Jawaban' => $anak['Nama'],
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/2/2',
			'Id' => 2,
			'NoForm' => $noForm,
			'Jawaban' => $anak['TanggalLahir'],
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/3/3',
			'Id' => 3,
			'NoForm' => $noForm,
			'Jawaban' => $anak['Kelamin'],
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/4/4',
			'Id' => 4,
			'NoForm' => $noForm,
			'Jawaban' => $anak['Panggilan'],
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/5/5',
			'Id' => 5,
			'NoForm' => $noForm,
			'Jawaban' => $anak['Dokter'],
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/6/6',
			'Id' => 6,
			'NoForm' => $noForm,
			'Jawaban' => $anak['NoTelpDokter'],
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/7/7',
			'Id' => 7,
			'NoForm' => $noForm,
			'Jawaban' => $orangtua['NamaAyah'],
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/8/8',
			'Id' => 8,
			'NoForm' => $noForm,
			'Jawaban' => $orangtua['AlamatRumahAyah'],
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/9/9',
			'Id' => 9,
			'NoForm' => $noForm,
			'Jawaban' => $orangtua['NoTelpRumahAyah'],
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/10/10',
			'Id' => 10,
			'NoForm' => $noForm,
			'Jawaban' => $orangtua['NoTempatKerjaAyah'],
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/11/11',
			'Id' => 11,
			'NoForm' => $noForm,
			'Jawaban' => $orangtua['NoHPAyah'],
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/12/12',
			'Id' => 12,
			'NoForm' => $noForm,
			'Jawaban' => $orangtua['AlamatKerjaAyah'],
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/13/13',
			'Id' => 13,
			'NoForm' => $noForm,
			'Jawaban' => $orangtua['JamKerjaAyah'],
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/14/14',
			'Id' => 14,
			'NoForm' => $noForm,
			'Jawaban' => $orangtua['NamaIbu'],
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/15/15',
			'Id' => 15,
			'NoForm' => $noForm,
			'Jawaban' => $orangtua['AlamatRumahIbu'],
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/16/16',
			'Id' => 16,
			'NoForm' => $noForm,
			'Jawaban' => $orangtua['NoTelpRumahIbu'],
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/17/17',
			'Id' => 17,
			'NoForm' => $noForm,
			'Jawaban' => $orangtua['NoTempatKerjaAyah'],
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/18/18',
			'Id' => 18,
			'NoForm' => $noForm,
			'Jawaban' => $orangtua['NoHPIbu'],
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/19/19',
			'Id' => 19,
			'NoForm' => $noForm,
			'Jawaban' => $orangtua['AlamatKerjaIbu'],
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/20/20',
			'Id' => 20,
			'NoForm' => $noForm,
			'Jawaban' => $orangtua['JamKerjaIbu'],
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/21/21',
			'Id' => 21,
			'NoForm' => $noForm,
			'Jawaban' => $namaOrangLain1,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);
		
		$dataForm = array(
			'IdData' => $noForm.'/22/22',
			'Id' => 22,
			'NoForm' => $noForm,
			'Jawaban' => $hubunganDenganAnak1,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/23/23',
			'Id' => 23,
			'NoForm' => $noForm,
			'Jawaban' => $noTelpOrang1,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/24/24',
			'Id' => 24,
			'NoForm' => $noForm,
			'Jawaban' => $noHPOrang1,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/25/25',
			'Id' => 25,
			'NoForm' => $noForm,
			'Jawaban' => $noTelpKerjaOrang1,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/21/26',
			'Id' => 21,
			'NoForm' => $noForm,
			'Jawaban' => $namaOrangLain2,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);
		
		$dataForm = array(
			'IdData' => $noForm.'/22/27',
			'Id' => 22,
			'NoForm' => $noForm,
			'Jawaban' => $hubunganDenganAnak2,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/23/28',
			'Id' => 23,
			'NoForm' => $noForm,
			'Jawaban' => $noTelpOrang2,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/24/29',
			'Id' => 24,
			'NoForm' => $noForm,
			'Jawaban' => $noHPOrang2,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/25/30',
			'Id' => 25,
			'NoForm' => $noForm,
			'Jawaban' => $noTelpKerjaOrang2,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/26/31',
			'Id' => 26,
			'NoForm' => $noForm,
			'Jawaban' => $orangLain3,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/27/32',
			'Id' => 27,
			'NoForm' => $noForm,
			'Jawaban' => $noOrangLain3,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/26/33',
			'Id' => 26,
			'NoForm' => $noForm,
			'Jawaban' => $orangLain4,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/27/34',
			'Id' => 27,
			'NoForm' => $noForm,
			'Jawaban' => $noOrangLain4,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/26/35',
			'Id' => 26,
			'NoForm' => $noForm,
			'Jawaban' => $orangLain5,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/27/36',
			'Id' => 27,
			'NoForm' => $noForm,
			'Jawaban' => $noOrangLain5,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/28/37',
			'Id' => 28,
			'NoForm' => $noForm,
			'Jawaban' => $namaAnakLain1,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/29/38',
			'Id' => 29,
			'NoForm' => $noForm,
			'Jawaban' => $tanggalLahirLain1,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/28/39',
			'Id' => 28,
			'NoForm' => $noForm,
			'Jawaban' => $namaAnakLain2,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/29/40',
			'Id' => 29,
			'NoForm' => $noForm,
			'Jawaban' => $tanggalLahirLain2,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/28/41',
			'Id' => 28,
			'NoForm' => $noForm,
			'Jawaban' => $namaAnakLain3,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/29/42',
			'Id' => 29,
			'NoForm' => $noForm,
			'Jawaban' => $tanggalLahirLain3,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		//data halaman 2
		$asikah = $this->input->post('Asikah');
		$lanjutAsi = $this->input->post('LanjutAsi');
		$rencanaAsi = $this->input->post('RencanaAsi');
		if($rencanaAsi==''){
			$rencanaAsi='-';
		}

		$jadwalAsi = $this->input->post('JadwalAsi');
		if($jadwalAsi==''){
			$jadwalAsi='-';
		}

		$suplemenLain = $this->input->post('SuplemenLain');
		if($suplemenLain==""){
			$suplemenLain="-";
		}

		$susuBotolkah = $this->input->post('SusuBotolkah');

		$jadwalPemberian="-";
		$susuFormula="-";
		$susuMurni="-";
		$air="-";
		if($susuBotolkah=="Ya"){
			if($this->input->post('MerekSusuFormula')!=""){
				$susuFormula=$this->input->post('MerekSusuFormula').', '.$this->input->post('JumlahSusuFormula').', '.$this->input->post('WaktuSusuFormula');
			}
			if($this->input->post('MerekSusuMurni')!=""){
				$susuMurni=$this->input->post('MerekSusuMurni').', '.$this->input->post('JumlahSusuMurni').', '.$this->input->post('WaktuSusuMurni');
			}
			if($this->input->post('MerekAir')!=""){
				$air=$this->input->post('MerekAir').', '.$this->input->post('JumlahAir').', '.$this->input->post('WaktuAir');
			}
		}
		$posisiAnak = $this->input->post('PosisiAnak');
		if($posisiAnak==""){
			$posisiAnak="-";
		}

		$posisiSendawa = $this->input->post('PosisiSendawa');
		if($posisiSendawa==""){
			$posisiSendawa="-";
		}

		$kenalMakananPadatkah = $this->input->post('KenalMakananPadatkah');
		$jenisMakananPadat="-";
		if($kenalMakananPadatkah=="Ya"){
			$jenisMakananPadat = $this->input->post('JenisMakananPadat');
		}

		//simpan data form pendaftaran halaman 2
		$dataForm = array(
			'IdData' => $noForm.'/30/43',
			'Id' => 30,
			'NoForm' => $noForm,
			'Jawaban' => $asikah,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/31/44',
			'Id' => 31,
			'NoForm' => $noForm,
			'Jawaban' => $lanjutAsi,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/32/45',
			'Id' => 32,
			'NoForm' => $noForm,
			'Jawaban' => $rencanaAsi,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/33/46',
			'Id' => 33,
			'NoForm' => $noForm,
			'Jawaban' => $jadwalAsi,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/34/47',
			'Id' => 34,
			'NoForm' => $noForm,
			'Jawaban' => $suplemenLain,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/35/48',
			'Id' => 35,
			'NoForm' => $noForm,
			'Jawaban' => $susuBotolkah,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/36/49',
			'Id' => 36,
			'NoForm' => $noForm,
			'Jawaban' => $jadwalPemberian,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/37/50',
			'Id' => 37,
			'NoForm' => $noForm,
			'Jawaban' => $susuFormula,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/38/51',
			'Id' => 38,
			'NoForm' => $noForm,
			'Jawaban' => $susuMurni,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/39/52',
			'Id' => 39,
			'NoForm' => $noForm,
			'Jawaban' => $air,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/40/53',
			'Id' => 40,
			'NoForm' => $noForm,
			'Jawaban' => $posisiAnak,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/41/54',
			'Id' => 41,
			'NoForm' => $noForm,
			'Jawaban' => $posisiSendawa,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/42/55',
			'Id' => 42,
			'NoForm' => $noForm,
			'Jawaban' => $kenalMakananPadatkah,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/43/56',
			'Id' => 43,
			'NoForm' => $noForm,
			'Jawaban' => $jenisMakananPadat,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);


		//Data Halaman 3
		$merekCereal1='';$merekCereal2='';$merekCereal3='';
		$kepadatanCereal1='';$kepadatanCereal2='';$kepadatanCereal3='';
		$jumlahCereal1='';$jumlahCereal2='';$jumlahCereal3='';
		$waktuCereal1='';$waktuCereal2='';$waktuCereal3='';
		$cereal1='-';$cereal2='-';$cereal3='-';

		if($this->input->post('MerekCereal1')!=''){
			$merekCereal1=$this->input->post('MerekCereal1');
			$kepadatanCereal1=$this->input->post('KepadatanCereal1');
			$jumlahCereal1=$this->input->post('JumlahCereal1');
			$waktuCereal1=$this->input->post('WaktuCereal1');
			$cereal1=$merekCereal1.', '.$kepadatanCereal1.', '.$jumlahCereal1.', '.$waktuCereal1;
		}
		if($this->input->post('MerekCereal2')!=''){
			$merekCereal2=$this->input->post('MerekCereal2');
			$kepadatanCereal2=$this->input->post('KepadatanCereal2');
			$jumlahCereal2=$this->input->post('JumlahCereal2');
			$waktuCereal2=$this->input->post('WaktuCereal2');
			$cereal2=$merekCereal2.', '.$kepadatanCereal2.', '.$jumlahCereal2.', '.$waktuCereal2;
		}
		if($this->input->post('MerekCereal3')!=''){
			$merekCereal3=$this->input->post('MerekCereal3');
			$kepadatanCereal3=$this->input->post('KepadatanCereal3');
			$jumlahCereal3=$this->input->post('JumlahCereal3');
			$waktuCereal3=$this->input->post('WaktuCereal3');
			$cereal3=$merekCereal3.', '.$kepadatanCereal3.', '.$jumlahCereal3.', '.$waktuCereal3;
		}

		$merekSayuran1='';$merekSayuran2='';$merekSayuran3='';$merekSayuran4='';
		$kepadatanSayuran1='';$kepadatanSayuran2='';$kepadatanSayuran3='';$kepadatanSayuran4='';
		$jumlahSayuran1='';$jumlahSayuran2='';$jumlahSayuran3='';$jumlahSayuran4='';
		$waktuSayuran1='';$waktuSayuran2='';$waktuSayuran3='';$waktuSayuran4='';
		$sayuran1='-';$sayuran2='-';$sayuran3='-';$sayuran4='-';

		if($this->input->post('MerekSayuran1')!=''){
			$merekSayuran1=$this->input->post('MerekSayuran1');
			$kepadatanSayuran1=$this->input->post('KepadatanSayuran1');
			$jumlahSayuran1=$this->input->post('JumlahSayuran1');
			$waktuSayuran1=$this->input->post('WaktuSayuran1');
			$sayuran1=$merekSayuran1.', '.$kepadatanSayuran1.', '.$jumlahSayuran1.', '.$waktuSayuran1;
		}
		if($this->input->post('MerekSayuran2')!=''){
			$merekSayuran2=$this->input->post('MerekSayuran2');
			$kepadatanSayuran2=$this->input->post('KepadatanSayuran2');
			$jumlahSayuran2=$this->input->post('JumlahSayuran2');
			$waktuSayuran2=$this->input->post('WaktuSayuran2');
			$sayuran2=$merekSayuran2.', '.$kepadatanSayuran2.', '.$jumlahSayuran2.', '.$waktuSayuran2;
		}
		if($this->input->post('MerekSayuran3')!=''){
			$merekSayuran3=$this->input->post('MerekSayuran3');
			$kepadatanSayuran3=$this->input->post('KepadatanSayuran3');
			$jumlahSayuran3=$this->input->post('JumlahSayuran3');
			$waktuSayuran4=$this->input->post('WaktuSayuran4');
			$sayuran3=$merekSayuran3.', '.$kepadatanSayuran3.', '.$jumlahSayuran3.', '.$waktuSayuran3;
		}
		if($this->input->post('MerekSayuran4')!=''){
			$merekSayuran4=$this->input->post('MerekSayuran4');
			$kepadatanSayuran4=$this->input->post('KepadatanSayuran4');
			$jumlahSayuran4=$this->input->post('JumlahSayuran4');
			$waktuSayuran4=$this->input->post('WaktuSayuran4');
			$sayuran4=$merekSayuran4.', '.$kepadatanSayuran4.', '.$jumlahSayuran4.', '.$waktuSayuran4;
		}

		$merekBuah1='';$merekBuah2='';$merekBuah3='';$merekBuah4='';
		$kepadatanBuah1='';$kepadatanBuah2='';$kepadatanBuah3='';$kepadatanBuah4='';
		$jumlahBuah1='';$jumlahBuah2='';$jumlahBuah3='';$jumlahBuah4='';
		$waktuBuah1='';$waktuBuah2='';$waktuBuah3='';$waktuBuah4='';
		$buah1='-';$buah2='-';$buah3='-';$buah4='-';

		if($this->input->post('MerekBuah1')!=''){
			$merekBuah1=$this->input->post('MerekBuah1');
			$kepadatanBuah1=$this->input->post('KepadatanBuah1');
			$jumlahBuah1=$this->input->post('JumlahBuah1');
			$waktuBuah1=$this->input->post('WaktuBuah1');
			$buah1=$merekBuah1.', '.$kepadatanBuah1.', '.$jumlahBuah1.', '.$waktuBuah1;
		}
		if($this->input->post('MerekBuah2')!=''){
			$merekBuah2=$this->input->post('MerekBuah2');
			$kepadatanBuah2=$this->input->post('KepadatanBuah2');
			$jumlahBuah2=$this->input->post('JumlahBuah2');
			$waktuBuah2=$this->input->post('WaktuBuah2');
			$buah2=$merekBuah2.', '.$kepadatanBuah2.', '.$jumlahBuah2.', '.$waktuBuah2;
		}
		if($this->input->post('MerekBuah3')!=''){
			$merekBuah3=$this->input->post('MerekBuah3');
			$kepadatanBuah3=$this->input->post('KepadatanBuah3');
			$jumlahBuah3=$this->input->post('JumlahBuah3');
			$waktuBuah3=$this->input->post('WaktuBuah3');
			$buah3=$merekBuah3.', '.$kepadatanBuah3.', '.$jumlahBuah3.', '.$waktuBuah3;
		}
		if($this->input->post('MerekBuah4')!=''){
			$merekBuah4=$this->input->post('MerekBuah4');
			$kepadatanBuah4=$this->input->post('KepadatanBuah4');
			$jumlahBuah4=$this->input->post('JumlahBuah4');
			$waktuBuah4=$this->input->post('WaktuBuah4');
			$buah4=$merekBuah4.', '.$kepadatanBuah4.', '.$jumlahBuah4.', '.$waktuBuah4;
		}

		$merekDaging1='';$merekDaging2='';
		$kepadatanDaging1='';$kepadatanDaging2='';
		$jumlahDaging1='';$jumlahDaging2='';
		$waktuDaging1='';$waktuDaging2='';
		$daging1='-';$daging2='-';

		if($this->input->post('MerekDaging1')!=''){
			$merekDaging1=$this->input->post('MerekDaging1');
			$kepadatanDaging1=$this->input->post('KepadatanDaging1');
			$jumlahDaging1=$this->input->post('JumlahDaging1');
			$waktuDaging1=$this->input->post('WaktuDaging1');
			$daging1=$merekDaging1.', '.$kepadatanDaging1.', '.$jumlahDaging1.', '.$waktuDaging1;
		}
		if($this->input->post('MerekDaging2')!=''){
			$merekDaging2=$this->input->post('MerekDaging2');
			$kepadatanDaging2=$this->input->post('KepadatanDaging2');
			$jumlahDaging2=$this->input->post('JumlahDaging2');
			$waktuDaging2=$this->input->post('WaktuDaging2');
			$daging2=$merekDaging2.', '.$kepadatanDaging2.', '.$jumlahDaging2.', '.$waktuDaging2;
		}

		$merekSnack1='';$merekSnack2='';
		$kepadatanSnack1='';$kepadatanSnack2='';
		$jumlahSnack1='';$jumlahSnack2='';
		$waktuSnack1='';$waktuSnack2='';
		$snack1='-';$snack2='-';

		if($this->input->post('MerekSnack1')!=''){
			$merekSnack1=$this->input->post('MerekSnack1');
			$kepadatanSnack1=$this->input->post('KepadatanSnack1');
			$jumlahSnack1=$this->input->post('JumlahSnack1');
			$waktuSnack1=$this->input->post('WaktuSnack1');
			$snack1=$merekSnack1.', '.$kepadatanSnack1.', '.$jumlahSnack1.', '.$waktuSnack1;
		}
		if($this->input->post('MerekSnack2')!=''){
			$merekSnack2=$this->input->post('MerekSnack2');
			$kepadatanSnack2=$this->input->post('KepadatanSnack2');
			$jumlahSnack2=$this->input->post('JumlahSnack2');
			$waktuSnack2=$this->input->post('WaktuSnack2');
			$snack2=$merekSnack2.', '.$kepadatanSnack2.', '.$jumlahSnack2.', '.$waktuSnack2;
		}

		$alergikah=$this->input->post('Alergikah');
		$alergi='-';
		if($alergikah=='Ya'){
			$alergi=$this->input->post('Alergi');

			//untuk mengupdate alergi pada anak
			$data_edit=array(
				'Id' =>$idAnak,
				'Alergi' => $alergi,
			);
			$this->Anak_model->edit_anak($data_edit);
		}

		$makananSukaTidak = $this->input->post('MakananSukaTidak');
		$jadwalTidur = $this->input->post('JadwalTidur');
		$tidurNangiskah = $this->input->post('TidurNangiskah');
		$lamaNangisTidur = '-';
		if($tidurNangiskah=='Ya'){
			$lamaNangisTidur=$this->input->post('LamaNangisTidur');
		}
		$tempatTidur =$this->input->post('TempatTidur');

		//Simpan Data Halaman 3
		$dataForm = array(
			'IdData' => $noForm.'/44/57',
			'Id' => 44,
			'NoForm' => $noForm,
			'Jawaban' => "-",
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/45/58',
			'Id' => 45,
			'NoForm' => $noForm,
			'Jawaban' => $cereal1,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/45/59',
			'Id' => 45,
			'NoForm' => $noForm,
			'Jawaban' => $cereal2,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/45/60',
			'Id' => 45,
			'NoForm' => $noForm,
			'Jawaban' => $cereal3,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/46/61',
			'Id' => 46,
			'NoForm' => $noForm,
			'Jawaban' => $sayuran1,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/46/62',
			'Id' => 46,
			'NoForm' => $noForm,
			'Jawaban' => $sayuran2,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/46/63',
			'Id' => 46,
			'NoForm' => $noForm,
			'Jawaban' => $sayuran3,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/46/64',
			'Id' => 46,
			'NoForm' => $noForm,
			'Jawaban' => $sayuran4,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/47/65',
			'Id' => 47,
			'NoForm' => $noForm,
			'Jawaban' => $buah1,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/47/66',
			'Id' => 47,
			'NoForm' => $noForm,
			'Jawaban' => $buah2,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/47/67',
			'Id' => 47,
			'NoForm' => $noForm,
			'Jawaban' => $buah3,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/47/68',
			'Id' => 47,
			'NoForm' => $noForm,
			'Jawaban' => $buah4,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/48/69',
			'Id' => 48,
			'NoForm' => $noForm,
			'Jawaban' => $daging1,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/48/70',
			'Id' => 48,
			'NoForm' => $noForm,
			'Jawaban' => $daging2,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/49/71',
			'Id' => 49,
			'NoForm' => $noForm,
			'Jawaban' => $snack1,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/49/72',
			'Id' => 49,
			'NoForm' => $noForm,
			'Jawaban' => $snack2,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/50/73',
			'Id' => 50,
			'NoForm' => $noForm,
			'Jawaban' => $alergikah,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/51/74',
			'Id' => 51,
			'NoForm' => $noForm,
			'Jawaban' => $alergi,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/52/75',
			'Id' => 52,
			'NoForm' => $noForm,
			'Jawaban' => $makananSukaTidak,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/53/76',
			'Id' => 53,
			'NoForm' => $noForm,
			'Jawaban' => $jadwalTidur,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/54/77',
			'Id' => 54,
			'NoForm' => $noForm,
			'Jawaban' => $tidurNangiskah,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/55/78',
			'Id' => 55,
			'NoForm' => $noForm,
			'Jawaban' => $lamaNangisTidur,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/56/79',
			'Id' => 56,
			'NoForm' => $noForm,
			'Jawaban' => $tempatTidur,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		//data halaman 4
		$merekPopok=$this->input->post('MerekPopok');
		$pemakaianPopok=$this->input->post('PemakaianPopok');
		$rentanPopok=$this->input->post('RentanPopok');
		$perawatan='-';
		if($rentanPopok=='Ya'){
			$perawatan=$this->input->post('Perawatan');
		}

		$karakter=$this->input->post('Karakter');
		$tandaKarakter=$this->input->post('TandaKarakter');
		$terbiasaTerpisakah=$this->input->post('TerbiasaTerpisahkah').', '.$this->input->post('PenjelasanTerbiasaTerpisah');
		$takutkah = $this->input->post('Takutkah').', '.$this->input->post('PenjelasanTakut');
		$bendaFavorit=$this->input->post('PunyaBendaFavoritkah').', '.$this->input->post('BendaFavorit');
		$denganAnakLainkah = $this->input->post('DenganAnakLainkah');
		$penjelasanDenganAnakLain='-';
		if($denganAnakLainkah=='Ya'){
			$penjelasanDenganAnakLain=$this->input->post('PenjelasanDenganAnakLain');
		}

		$aktivitasFavorit=$this->input->post('AktivitasFavorit');
		$pernahDititipkankah=$this->input->post('PernahDititipkankah');
		$penjelasanDititipkan='-';
		if($pernahDititipkankah=='Ya'){
			$penjelasanDititipkan=$this->input->post('PenjelasanDititipkan');
		}

		//simpan data halaman 4
		$dataForm = array(
			'IdData' => $noForm.'/57/80',
			'Id' => 57,
			'NoForm' => $noForm,
			'Jawaban' => $merekPopok,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/58/81',
			'Id' => 58,
			'NoForm' => $noForm,
			'Jawaban' => $pemakaianPopok,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/59/82',
			'Id' => 59,
			'NoForm' => $noForm,
			'Jawaban' => $rentanPopok,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/60/83',
			'Id' => 60,
			'NoForm' => $noForm,
			'Jawaban' => $perawatan,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/61/84',
			'Id' => 61,
			'NoForm' => $noForm,
			'Jawaban' => $karakter,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/62/85',
			'Id' => 62,
			'NoForm' => $noForm,
			'Jawaban' => $tandaKarakter,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/63/86',
			'Id' => 63,
			'NoForm' => $noForm,
			'Jawaban' => $terbiasaTerpisakah,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/64/87',
			'Id' => 64,
			'NoForm' => $noForm,
			'Jawaban' => $takutkah,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/65/88',
			'Id' => 65,
			'NoForm' => $noForm,
			'Jawaban' => $bendaFavorit,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/66/89',
			'Id' => 66,
			'NoForm' => $noForm,
			'Jawaban' => $denganAnakLainkah,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/67/90',
			'Id' => 67,
			'NoForm' => $noForm,
			'Jawaban' => $penjelasanDenganAnakLain,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/68/91',
			'Id' => 68,
			'NoForm' => $noForm,
			'Jawaban' => $aktivitasFavorit,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/69/92',
			'Id' => 69,
			'NoForm' => $noForm,
			'Jawaban' => $pernahDititipkankah,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/70/93',
			'Id' => 70,
			'NoForm' => $noForm,
			'Jawaban' => $penjelasanDititipkan,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		//data halaman 5
		$rutinImunisasikah=$this->input->post('RutinImunisasikah');
		$alasaImunisasi='-';
		if($rutinImunisasikah=='Tidak'){
			$alasaImunisasi=$this->input->post('AlasanImunisasi');
		}

		$masalahKesehatankah=$this->input->post('MasalahKesehatankah');

		$penyakit='-';
		$arrayPenyakit=$this->input->post('Penyakit');
		foreach ($arrayPenyakit as $key => $value) {
			if($key==0)
				$penyakit='';
			$penyakit.=$value.', ';
		}
		$penyakit.=$this->input->post('PenyakitLain');

		$kecelakaanDanLuka=$this->input->post('KecelakaanDanLuka');
		if($kecelakaanDanLuka=='')
			$kecelakaanDanLuka='-';

		$alergikah2=$this->input->post('Alergikah2');
		$detailAlergi='-';
		if($alergikah2=='Ya'){
			$detailAlergi=$this->input->post('DetailAlergi');
		}

		$obatTertentukah = $this->input->post('ObatTertentukah');
		$detailObatTertentu='-';
		if($obatTertentukah=='Ya'){
			$detailObatTertentu=$this->input->post('DetailObatTertentu');
		}

		$takutPerkembagannyakah = $this->input->post('TakutPerkembagannyakah');
		$alasanTakutPerkembangan = '-';
		if($takutPerkembagannyakah=='Ya'){
			$alasanTakutPerkembangan=$this->input->post('AlasanTakutPerkembangan');
		}

		$informasiKesehatan=$this->input->post('InformasiKesehatan');

		//simpan data halaman 5
		$dataForm = array(
			'IdData' => $noForm.'/71/94',
			'Id' => 71,
			'NoForm' => $noForm,
			'Jawaban' => $rutinImunisasikah,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/72/95',
			'Id' => 72,
			'NoForm' => $noForm,
			'Jawaban' => $alasaImunisasi,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/73/96',
			'Id' => 73,
			'NoForm' => $noForm,
			'Jawaban' => $masalahKesehatankah,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/74/97',
			'Id' => 74,
			'NoForm' => $noForm,
			'Jawaban' => $penyakit,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/75/98',
			'Id' => 75,
			'NoForm' => $noForm,
			'Jawaban' => $kecelakaanDanLuka,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/76/99',
			'Id' => 76,
			'NoForm' => $noForm,
			'Jawaban' => $alergikah2,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/77/100',
			'Id' => 77,
			'NoForm' => $noForm,
			'Jawaban' => $detailAlergi,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/78/101',
			'Id' => 78,
			'NoForm' => $noForm,
			'Jawaban' => $obatTertentukah,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/79/102',
			'Id' => 79,
			'NoForm' => $noForm,
			'Jawaban' => $detailObatTertentu,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/80/103',
			'Id' => 80,
			'NoForm' => $noForm,
			'Jawaban' => $takutPerkembagannyakah,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/81/104',
			'Id' => 81,
			'NoForm' => $noForm,
			'Jawaban' => $alasanTakutPerkembangan,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		$dataForm = array(
			'IdData' => $noForm.'/82/105',
			'Id' => 82,
			'NoForm' => $noForm,
			'Jawaban' => $informasiKesehatan,
		);
		$this->DataFormPendaftaran_model->add_data_form_pendaftaran($dataForm);

		//data paket
		$paket = $this->input->post('paket');
		$tanggalMulai = $this->input->post('TanggalMulai');
		$tanggalMulai = DateTime::createFromFormat('d-m-Y', $tanggalMulai)->format('Y-m-d');

		$time = strtotime($tanggalMulai);
		$tanggalAkhir = date("Y-m-d", strtotime("+1 month", $time));

		$dataPaket = array(
			'Tanggal' => $tanggalMulai,
			'TanggalAkhirBerlaku' => $tanggalAkhir,
			'TanggalDaftar' => date('Y-m-d'),
			'StatusAktif' => 1,
			'Anak_Id' => $idAnak,
			'Paket_Id' => $paket,
		);
		$this->DaftarPaket_model->add_daftar_paket($dataPaket);

		if($_SESSION['hak_akses']=='GUEST'){
			$data['pendaftaran'] = $this->Pendaftaran_model->get_pendaftaran_anak($idAnak);
			$data['anak'] = $this->Anak_model->get($idAnak);
			$data['orangtua'] = $this->Anak_model->get_orangtua_byanak($idAnak);
			$data['paket'] = $this->DaftarPaket_model->get_daftar_paket2($idAnak);


			$this->load->view('pendaftaran/form_pernyataan',$data);
			$this->session->set_userdata('message', 'Data Pendaftaran Berhasil Disimpan');
		}else{
			$this->session->set_userdata('message', 'Data Pendaftaran Berhasil Disimpan');
			header("Location: ".site_url('Pendaftaran/index'));	
		}
		
	}
	public function validasi(){
		if($_SESSION['hak_akses']!='ADMIN'){
     		header("Location: ".site_url('Anak/index'));
     	}
     	
		$data['anak'] = $this->Anak_model->get_need_validation();

		$this->load->view('layout/header');
		$this->load->view('pendaftaran/validasi',$data);
		$this->load->view('layout/footer');
	}
	public function profil($id_anak=''){
		if($_SESSION['hak_akses']=='GUEST'){
     		header("Location: ".site_url('Anak/index'));
     	}

		$data['anak'] = $this->Anak_model->get_anak2($id_anak);
		$data['data_pendaftaran'] = $this->Pendaftaran_model->get_pendaftaran_anak($id_anak);
		$data['orangtua'] = $this->Anak_model->get_orangtua_byanak($id_anak);

		$this->load->view('layout/header');
		$this->load->view('anak/profil',$data);
		$this->load->view('layout/footer');
	}
	public function aktif_validasi(){
		$id_anak = $this->input->post('id_anak');
		$no_form = $this->input->post('no_form');

		$data = array(
			'Id' => $id_anak,
			'Hapus' => 0,
    	);

    	$this->Anak_model->edit_anak($data);

    	$data = array(
			'NoForm' => $no_form,
			'StatusValidasi' => 1,
    	);

    	$this->Pendaftaran_model->edit_pendaftaran($data);

		header("Location: ".site_url('Pendaftaran/validasi'));
	}
}
		