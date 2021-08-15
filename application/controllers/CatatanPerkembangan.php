<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CatatanPerkembangan extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('KategoriIndikator_model');
        $this->load->model('IndikatorPerkembangan_model');
        $this->load->model('CatatanPerkembangan_model');
        $this->load->model('FotoPerkembangan_model');
        $this->load->model('CatatanPerkembanganHasIndikatorPerkembangan_model');
        $this->load->model('Anak_model');
        $this->load->helper('url_helper');
        $this->load->helper('form');
    	$this->load->library('form_validation');
     	$this->load->library('session');
     	$this->load->library('cart');
     	if(empty($_SESSION['username'])){
     		header("Location: ".site_url('Auth/index'));
     	}
    }
	public function index()
	{	
		if($_SESSION['hak_akses']!='ADMIN'&&$_SESSION['hak_akses']!='NANNY'){
     		header("Location: ".site_url('Anak/index'));
     	}

		$this->cart->destroy();
		$data['kategori'] = $this->KategoriIndikator_model->get();
		$data['indikator'] = $this->IndikatorPerkembangan_model->get();
		$data['anak'] = $this->Anak_model->get_anak();

		$kategori = $this->KategoriIndikator_model->get();

		foreach ($kategori as $key => $value) {
			$temp = array(
				'id' => $value['Id'],
				'name' => $value['Nama'],
				'qty' => 1,
				'price' => 1,
			);

			$this->cart->insert($temp);
		}		

		$data['tampil']='';
		foreach ($this->cart->contents() as $key => $value) {
			$indikator = $this->IndikatorPerkembangan_model->getByKategori($value['id']);
			$countRow = count($indikator)+1;

			$data['tampil'].='
				<tr>
					<td rowspan="'.$countRow.'" style="vertical-align:middle;">'.$value["name"].'</td>
				</tr>
				';

			foreach ($indikator as $key => $value2) {
				$data['tampil'].='
					<tr>
						<td>'.$value2["Indikator"].'</td>
						<td>
							<input type="radio" class="flat" form="form_catatan_perkembangan" name="nilai'.$value2["Id"].'" id="" value="K" checked="" required>
						</td>
						<td>
							<input type="radio" class="flat" form="form_catatan_perkembangan" name="nilai'.$value2["Id"].'" id="" value="C">
						</td>
						<td>
							<input type="radio" class="flat" form="form_catatan_perkembangan" name="nilai'.$value2["Id"].'" id="" value="M">
						</td>
					</tr>
				';
			}
		}
		

		$this->load->view('layout/header');
		$this->load->view('perkembangan/catatan_perkembangan',$data);
		$this->load->view('layout/footer');
	}
	public function add(){
		$id_anak = $this->input->post('anak');
		$data = array(
			'Tanggal' => date('Y-m-d'),
			'KesimpulanSaran' => $this->input->post('kesimpulanSaran'),
			'Anak_Id' => $this->input->post('anak'),
		);

		if($this->CatatanPerkembangan_model->exist($data["Anak_Id"],$data["Tanggal"])){
			$this->session->set_userdata('info', 'Data Catatan Perkembangan Anak ini sudah dibuat');
			header("Location: ".site_url('CatatanPerkembangan/index'));
		}else{

			if($this->CatatanPerkembangan_model->add($data)){
				$perkembangan = $this->CatatanPerkembangan_model->get_last();
				$noForm = $perkembangan['NoForm'];

				foreach ($this->cart->contents() as $key => $value) {
					$indikator = $this->IndikatorPerkembangan_model->getByKategori($value['id']);
					foreach ($indikator as $key => $value2) {
						$temp = array(
							'NoForm' => $noForm,
							'Id' => $value2['Id'],
							'Nilai' => $this->input->post('nilai'.$value2['Id']),
						);

						$this->CatatanPerkembanganHasIndikatorPerkembangan_model->add($temp);	
					}
				}

				//jika ada upload foto 
				if(is_uploaded_file($_FILES['foto']['tmp_name'][0])){
					$dir = 'public/foto_perkembangan/'.$id_anak.'/';

					if(!is_dir($dir))
						mkdir($dir);


					foreach ($_FILES['foto']['tmp_name'] as $key => $value) {
						$a= explode(".", $_FILES['foto']['name'][$key]);
					    $ext=$a[count($a)-1];
					    $foto= md5($_FILES['foto']['name'][$key]).time();
					    $foto=$foto.".".$ext;

					    $anak = $this->Anak_model->get($id_anak);
					    $foto =$anak['Nama'].$foto;   
						if(move_uploaded_file($_FILES['foto']['tmp_name'][$key],"./".$dir.$foto))
				        {   
				        	$data = array(
				    			'NoForm' => $noForm,
				    			'NamaFoto' => $foto,
				    		);

				    		$this->FotoPerkembangan_model->add($data);
				        }
					}
		    	}

				$this->session->set_userdata('message', 'Data Catatan Perkembangan Berhasil Disimpan');
				header("Location: ".site_url('CatatanPerkembangan/index'));
			}
			else{
				$this->session->set_userdata('error', 'Data Catatan Perkembangan Gagal Disimpan');
				header("Location: ".site_url('CatatanPerkembangan/index'));
			}
		}

	}
	public function set_uraian(){
		$idKategori = $_POST['idKategori'];

		$kategori = $this->KategoriIndikator_model->get($idKategori);

		$data = array(
			'id' => $kategori['Id'],
			'name' => $kategori['Nama'],
			'qty' => 1,
			'price' => 1,
		);

		$this->cart->insert($data);
		echo $this->view_uraian();

	}
	public function view_uraian(){
		$output ='';

		foreach ($this->cart->contents() as $key => $value) {
			$indikator = $this->IndikatorPerkembangan_model->getByKategori($value['id']);
			$countRow = count($indikator)+1;

			$output.='
				<tr>
					<td rowspan="'.$countRow.'" style="vertical-align:middle;">
						<button type="buttton" name="btnHapus" class="btn btn-xs btn-danger hapus" id="'.$value["rowid"].'"><i class="fa fa-close"></i></button>
					</td>
					<td rowspan="'.$countRow.'" style="vertical-align:middle;">'.$value["name"].'</td>
				</tr>
				';

			foreach ($indikator as $key => $value2) {
				$output.='
					<tr>
						<td height="44">'.$value2["Indikator"].'</td>
						<td height="44">
							<input type="radio" class="flat" form="form_catatan_perkembangan" name="nilai'.$value2["Id"].'" id="" value="K" checked="" required>
						</td>
						<td height="44">
							<input type="radio" class="flat" form="form_catatan_perkembangan" name="nilai'.$value2["Id"].'" id="" value="C">
						</td>
						<td height="44">
							<input type="radio" class="flat" form="form_catatan_perkembangan" name="nilai'.$value2["Id"].'" id="" value="M">
						</td>
					</tr>
				';
			}



		}

		return $output;
	}
	public function remove_aspek(){
		$row_id = $_POST['row_id'];

		$data = array(
			'rowid' => $row_id,
			'qty' => 0,
		);

		$this->cart->update($data);
		echo $this->view_uraian();
	}
	public function clear_aspek(){
		$this->cart->destroy();
		echo $this->view_uraian();
	}
	//untuk tampil foto perkemabangan anak pada menu anak
	public function foto_perkembangan(){
		if($_SESSION['hak_akses']!='ANAK'){
     		header("Location: ".site_url('Anak/index'));
     	}

     	$data['foto'] = $this->FotoPerkembangan_model->get_by_tanggal($_SESSION['id'],date('m'),date('Y'));
     	$this->load->view('layout/header');
		$this->load->view('perkembangan/foto_perkembangan',$data);
		$this->load->view('layout/footer');

	}
	public function tampil_foto(){
		$bulan = $_POST['bulan'];
		$year = $_POST['tahun'];

		$foto = $this->FotoPerkembangan_model->get_by_tanggal($_SESSION['id'],$bulan,$year);

		$output = '';
		$tanggal ='';
		foreach ($foto as $key => $value) {
			$output.='
				 <div class="col-sm-4">
		              <a download="'.$value['NamaFoto'].'" href="'.base_url().'public/foto_perkembangan/'.$value['Anak_Id'].'/'.$value['NamaFoto'].'" title="ImageName">
		                <img height="150" class="img-responsive img-rounded" width="300" src="'.base_url().'public/foto_perkembangan/'.$value['Anak_Id'].'/'.$value['NamaFoto'].'" title="ImageName">
		              </a>
		         </div>
			';
			$tanggal =$foto[0]['Tanggal'];
		}

		echo json_encode(array(
			'output' => $output,
			'Tanggal' => $tanggal,
		));
	}
}
