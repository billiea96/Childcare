<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KegiatanRutinAnak extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('KegiatanRutin_model');
        $this->load->model('KegiatanRutinAnak_model');
        $this->load->model('FotoKegiatanRutin_model');
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
		if($_SESSION['hak_akses']!='ADMIN'&&$_SESSION['hak_akses']!='NANNY'){
     		header("Location: ".site_url('Anak/index'));
     	}

		$data['anak'] = $this->Anak_model->get_anak();
		$data['kegiatan'] = $this->KegiatanRutin_model->get_kegiatan();

		$data['tampil'] ='';
    	$count=0;
    	foreach ($data['anak'] as $key => $value) {
    		$count++;
    		$data['tampil'].='
    			<tr>
    				<td>'.$count.'</td>
    				<td>'.$value["Nama"].'</td>
    				<td><textarea style="width:100%;" form="form_kegiatan_rutin_anak" class="form-control keterangan" rows="3" id="keterangan'.$value["Id"].'" name="keterangan'.$value["Id"].'" disabled></textarea></td>
    				<td><input form="form_kegiatan_rutin_anak" type="checkbox" name="anak[]" class="pilih" id="'.$value["Id"].'" value="'.$value["Id"].'"></td>
    			</tr>
    		';
    	}

		$this->load->view('layout/header');
		$this->load->view('kegiatan_rutin/kegiatan_rutin_anak',$data);
		$this->load->view('layout/footer');
	}
	public function add(){
		$kegiatan = $this->input->post('kegiatan');
		$tanggal = $this->input->post('tanggal');
		$tanggal = DateTime::createFromFormat('d-m-Y', $tanggal)->format('Y-m-d');
		

		foreach ($this->input->post('anak') as $key => $value) {
			$data = array(
			'Kegiatan_Rutin_Id'	 	=> $kegiatan,
			'Anak_Id' 				=> $value,
			'Catatan' 				=> $this->input->post('keterangan'.$value),
			'Tanggal' 				=> $tanggal,
			);

			if($this->KegiatanRutinAnak_model->exist($data)){

			}else{
				$this->KegiatanRutinAnak_model->add($data);

			}	
		}

		//jika ada upload foto 
		if(is_uploaded_file($_FILES['foto']['tmp_name'][0])){
			$dir = 'public/foto_kegiatan_rutin/'.$kegiatan.'/';

			if(!is_dir($dir))
				mkdir($dir);


			foreach ($_FILES['foto']['tmp_name'] as $key => $value) {
				$a= explode(".", $_FILES['foto']['name'][$key]);
			    $ext=$a[count($a)-1];
			    $foto= md5($_FILES['foto']['name'][$key]).time();
			    $foto=$foto.".".$ext;

			    $foto =$tanggal.$foto;   
				if(move_uploaded_file($_FILES['foto']['tmp_name'][$key],"./".$dir.$foto))
		        {   
		        	$data = array(
		    			'Kegiatan_Rutin_Id' => $kegiatan,
		    			'NamaFoto' => $foto,
		    			'Tanggal' => $tanggal,
		    		);

		    		$this->FotoKegiatanRutin_model->add($data);
		        }
			}
    	}

		$this->session->set_userdata('message', 'Data Kegiatan Anak Berhasil Ditambahkan');

		header("Location: ".site_url('KegiatanRutinAnak/index'));
	}
	public function foto_kegiatan(){
		if($_SESSION['hak_akses']!='ANAK'){
     		header("Location: ".site_url('Anak/index'));
     	}
     	$data['kegiatan'] = $this->KegiatanRutin_model->get_kegiatan();

     	$this->load->view('layout/header');
		$this->load->view('kegiatan_rutin/foto_kegiatan',$data);
		$this->load->view('layout/footer');
	}
	public function tampil_foto(){
		$kegiatan = $_POST['kegiatan'];
		$tanggal_awal = $_POST['tanggal_awal'];
		$tanggal_akhir = $_POST['tanggal_akhir'];
		$tanggal_awal = date('Y-m-d',strtotime($tanggal_awal));
		$tanggal_akhir = date('Y-m-d',strtotime($tanggal_akhir));

		$foto = $this->FotoKegiatanRutin_model->get_by_tanggal($kegiatan,$tanggal_awal,$tanggal_akhir);

		$output = '';
		foreach ($foto as $key => $value) {
			$output.='
				 <div class="col-sm-4">
		              <a download="'.$value['NamaFoto'].'" href="'.base_url().'public/foto_kegiatan_rutin/'.$value['Kegiatan_Rutin_Id'].'/'.$value['NamaFoto'].'" title="ImageName">
		                <img height="150" class="img-responsive img-rounded" width="300" src="'.base_url().'public/foto_kegiatan_rutin/'.$value['Kegiatan_Rutin_Id'].'/'.$value['NamaFoto'].'" title="ImageName">
		              </a>
		         </div>
			';
		}

		echo $output;
	}
}
