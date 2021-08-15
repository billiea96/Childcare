<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PaketKatering extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('PaketKatering_model');
        $this->load->model('DetailKatering_model');
        $this->load->model('SettingPaketKatering_model');
        $this->load->helper('url_helper');
        $this->load->helper('form');
        $this->load->library('cart');
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
		$this->cart->destroy();
		$data['paket'] = $this->PaketKatering_model->get();

		$this->load->view('layout/header');
		$this->load->view('katering/paket_katering',$data);
		$this->load->view('layout/footer');
	}
	public function add(){
		$tanggal_awal = $this->input->post('tanggal_awal');
		$tanggal_akhir = $this->input->post('tanggal_akhir');

		$ket='';
		$status='false';
		for($i=strtotime($tanggal_awal);$i<=strtotime($tanggal_akhir);$i+=86400){
			if(date("l",$i)!="Sunday"&&date("l",$i)!="Saturday"){
				//untuk paket 1
				if($this->PaketKatering_model->exist('PAKET 1',date('Y-m-d',$i))){
					$ket.='Data Paket 1 tanggal '.date('m-d-Y',$i).' sudah ada<br>';
				}else{
					$status='true';
					$paket_katering = array(
						'Nama' => 'PAKET 1',
						'Tanggal' => date('Y-m-d',$i),
						'Status' => 1,
					);
					$this->PaketKatering_model->add($paket_katering);
					$temp = $this->PaketKatering_model->get_last();

					//untuk mendapatkan detail katering dan menyimpannya
					$bahan = $this->input->post('bahan1'.date('dmY',$i));
					foreach ($this->input->post('nama_makanan1'.date('dmY',$i)) as $key => $value) {
						$detail_katering = array(
							'Nama' => $value,
							'Bahan' => $bahan[$key],
							'Paket_Katering_Id' => $temp['Id'],
						);
						$this->DetailKatering_model->add($detail_katering);
					}
				}

				//untuk paket 2
				if($this->PaketKatering_model->exist('PAKET 2',date('Y-m-d',$i))){
					$ket.='Data Paket 2 tanggal '.date('m-d-Y',$i).' sudah ada<br>';
				}else{
					$status='true';
					$paket_katering = array(
						'Nama' => 'PAKET 2',
						'Tanggal' => date('Y-m-d',$i),
						'Status' => 1,
					);
					$this->PaketKatering_model->add($paket_katering);
					$temp = $this->PaketKatering_model->get_last();

					//untuk mendapatkan detail katering dan menyimpannya
					$bahan = $this->input->post('bahan2'.date('dmY',$i));
					foreach ($this->input->post('nama_makanan2'.date('dmY',$i)) as $key => $value) {
						$detail_katering = array(
							'Nama' => $value,
							'Bahan' => $bahan[$key],
							'Paket_Katering_Id' => $temp['Id'],
						);
						$this->DetailKatering_model->add($detail_katering);
					}
				}

			}
		}
		if($ket!=''){
			if($status=='false')
				$this->session->set_userdata('info', $ket);
			else
				$this->session->set_userdata('info', $ket.'Data Paket lainnya berhasil ditambahkan');
		}else{
			$this->session->set_userdata('message', 'Data Paket Katering Berhasil Ditambahkan');
		}
		header("Location: ".site_url('PaketKatering/index'));

	}
	public function generate_katering(){
		$tanggal_awal = $_POST['tanggal_awal'];
		$tanggal_akhir = $_POST['tanggal_akhir'];

		$output='';
		$hari ='';
		for($i=strtotime($tanggal_awal);$i<=strtotime($tanggal_akhir);$i+=86400){
			switch (date("l",$i)) {
			    case 'Monday':
			        $hari='Senin';
			        break;
			    case 'Tuesday':
			        $hari ='Selasa';
			        break;
			    case 'Wednesday':
			        $hari='Rabu';
			        break;
			    case 'Thursday':
			        $hari='Kamis';
			        break;
		        case 'Friday':
			        $hari='Jumat';
			        break;
		        case 'Saturday':
			        $hari='Sabtu';
			        break;
			    default:
			        $hari='Minggu';
			}


			if(date("l",$i)!="Sunday"&&date("l",$i)!="Saturday"){
				$output.='
					<tr>
						<td rowspan="2" style="vertical-align:middle;font-size:16px;">'.$hari.', '.date("d-m-Y",$i).'</td>
						<td align="left">PAKET 1 (Pagi)</td>
						<td>
							<span style="color:red;" id="spanStatus1'.date("dmY",$i).'">Detail makanan belum diisi!!</span>
							<input value="0" type="hidden" class="input_status" id="status1_'.date("dmY",$i).'" name="status1_'.date("dmY",$i).'">
						</td>
						<td>
							<button class="btn btn-xs btn-default showDialog" name="button1_'.date("dmY",$i).'" id="button1_'.date("dmY",$i).'" type="button" data-toggle="modal" data-target="#myModal" title="Isi Makanan" data-paket="1" data-tanggal="'.date("dmY",$i).'" data-backdrop="static" data-keyboard="false">
							<i class="fa fa-pencil-square-o"></i>
							</button>
						</td>
					</tr>
					<tr>
						<td align="left">PAKET 2 (Siang dan sore)</td>
						<td>
							<span style="color:red;" id="spanStatus2'.date("dmY",$i).'">Detail makanan belum diisi!!</span>
							<input value="0" type="hidden" class="input_status" id="status2_'.date("dmY",$i).'" name="status2_'.date("dmY",$i).'">
						</td>
						<td>
							<button class="btn btn-xs btn-default showDialog" name="button2_'.date("dmY",$i).'" id="button2_'.date("dmY",$i).'" type="button" data-toggle="modal" data-target="#myModal" title="Isi Makanan" data-paket="2" data-tanggal="'.date("dmY",$i).'" data-backdrop="static" data-keyboard="false">
							<i class="fa fa-pencil-square-o"></i>
							</button>
						</td>
					</tr>

				';
			}
		}
		echo $output;
	}
	public function show_modal(){
		$paket = $_POST['paket'];
		$tanggal = $_POST['tanggal'];

		$output='';

		$output.='
		<div id="body'.$paket.$tanggal.'">
		<div class="modal-header">
	        <button type="button" class="close simpanHidden" data-paket="'.$paket.'" data-tanggal="'.$tanggal.'" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Detail Makanan</h4>
	    </div>
		<div class="modal-body">
          <table id="table" class="table table-bordered table-hover text-center" cellspacing="0" width="100%">
            <form class="form-horizontal form-label-left">
                  <div class="item form-group">
                    <label style="text-align: right;" class="control-label col-md-1" for="nama_bahan">Nama :
                    </label>
                    <div class="col-md-3">
                      <input type="text" class="form-control" id="nama_makanan'.$paket.$tanggal.'">
                    </div>
                  </div>
                  <div class="clearfix"></div><br>
                  <div class="item form-group">
                    <label style="text-align: right;" class="control-label col-md-1" for="bahan">Bahan :
                    </label>
                    <div class="col-md-6">
                      <textarea class="form-control" rows="2" id="bahan'.$paket.$tanggal.'"></textarea>
                    </div>
                  </div>
                  <div class="item form-group">
                    <div>
                      <button type="button" id="tambah'.$paket.$tanggal.'" class="btn btn-primary tambahMakanan" data-paket="'.$paket.'" data-tanggal="'.$tanggal.'">Tambah</button>
                    </div>
                  </div>
                  <div class="clearfix"></div><br>
            </form>
            <thead>
              <tr>
                <th class="col-md-3" style="text-align: center;">Nama</th>
                <th class="col-md-4" style="text-align: center;">Bahan</th>
                <th class="col-md-2" style="text-align: center;">Hapus</th>
              </tr>
            </thead>
            <tbody id="tbody'.$paket.$tanggal.'">
              
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" id="simpan_makanan'.$paket.$tanggal.'" class="btn btn-default simpanHidden" data-dismiss="modal" data-paket="'.$paket.'" data-tanggal="'.$tanggal.'">Close</button>
        </div>
        </div>';

        echo $output;
	}
	public function tambah_makanan(){
		$paket = $_POST['paket'];
		$tanggal = $_POST['tanggal'];
		$counter = $_POST['counter']+1;
		$nama_makanan = $_POST['nama_makanan'];
		$bahan = $_POST['bahan'];

		$output ='
			<tr id="rowMakanan'.$paket.$tanggal.$counter.'">
				<td>
					'.$nama_makanan.'
					<input type="hidden" value="'.$nama_makanan.'" form="form_paket_katering" name="nama_makanan'.$paket.$tanggal.'[]">
				</td>
				<td>
					'.$bahan.'
					<input type="hidden" value="'.$bahan.'" form="form_paket_katering" name="bahan'.$paket.$tanggal.'[]">
				</td>
				<td>
					<button class="btn btn-xs btn-danger hapusMakanan" id="btnHapasMakanan'.$paket.$tanggal.$counter.'" data-counter="'.$counter.'" data-paket="'.$paket.'" data-tanggal="'.$tanggal.'"><i class="fa fa-trash"></i></button>
				</td>
			</tr>
		';

		echo $output;
	}
	public function edit(){
		$tanggal = $this->input->post('Tanggal');
		$tanggal = DateTime::createFromFormat('d-m-Y', $tanggal)->format('Y-m-d');
		$data = array(
			'Id' => $this->input->post('id_paket'),
			'Nama' => $this->input->post('Nama'),
			'Tanggal' => $tanggal,
		);

		if($this->PaketKatering_model->edit($data))
			$this->session->set_userdata('message', 'Data Paket Berhasil Diperbarui');
		else
			$this->session->set_userdata('error', 'Data Paket Gagal Diperbarui');

		header("Location: ".site_url('PaketKatering/index'));
	}
	public function setting(){
		if($_SESSION['hak_akses']!='ADMIN'){
     		header("Location: ".site_url('Anak/index'));
     	}
		$data['setting'] = $this->SettingPaketKatering_model->get();

		$this->load->view('layout/header');
		$this->load->view('katering/setting_paket',$data);
		$this->load->view('layout/footer');
	}
	public function simpan_setting(){
		$data = array(
			'IdSetting' => 1,
			'Harga' => $this->input->post('paket1'),
		);

		$this->SettingPaketKatering_model->edit($data);

		$data = array(
			'IdSetting' => 2,
			'Harga' => $this->input->post('paket2'),
		);

		$this->SettingPaketKatering_model->edit($data);

		$this->session->set_userdata('message', 'Harga Paket Berhasil disimpan');
		header("Location: ".site_url('PaketKatering/setting'));
	}
	/*
	public function detail_katering_index($id){
		$data['paket'] = $this->PaketKatering_model->get($id);

		$this->load->view('layout/header');
		$this->load->view('katering/detail_katering',$data);
		$this->load->view('layout/footer');
	}
	public function detail_katering(){
		$data['paket'] = $this->PaketKatering_model->get_last();

		$this->load->view('layout/header');
		$this->load->view('katering/paket_detail_katering',$data);
		$this->load->view('layout/footer');
	}
	public function simpan_detail_katering(){
		$id = $this->input->post('Paket');

		foreach ($this->cart->contents() as $key => $value) {
			$data = array(
				'Nama' => $value['name'],
				'Bahan' => $value['bahan'],
				'Paket_Katering_Id' => $id
			);

			$this->DetailKatering_model->add($data);
		}

		//edit status paket katering
		$edit = array(
			'Id' => $id,
			'Status' => 1,
		);

		$this->PaketKatering_model->edit($edit);

		$this->session->set_userdata('message', 'Data Katering Dan Detailnya Berhasil Ditambahkan');
		
		header("Location: ".site_url('PaketKatering/index'));
	}
	public function tambah_detail(){
		$nama = $_POST['nama'];
		$bahan = $_POST['bahan'];

		$id = $this->cart->total_items()+1;

		$data=array(
			'id' => $id,
			'name' => $nama,
			'qty' => 1,
			'price' => 1,
			'bahan' => $bahan,
		);

		$this->cart->insert($data);
		echo $this->view_detail();
	}
	public function view_detail(){
		$count =0;
		$output='';

		foreach ($this->cart->contents() as $key => $value) {
			$count++;
			$output.='
				<tr>
					<td>'.$count.'</td>
					<td>'.$value["name"].'</td>
					<td>'.$value["bahan"].'</td>
					<td><button type="button" class="btn btn-danger btn-xs hapus" name="btnHapus" id="'.$value["rowid"].'">Hapus</buttton></td>
				</tr>
			';
		}
		return $output;
	}
	public function load_detail(){
		echo $this->view_detail();
	}
	public function hapus_detail(){
		$rowid = $_POST['rowid'];
		$data=array(
			'rowid' => $rowid,
			'qty' => 0,
		);
		$this->cart->update($data);
		echo $this->view_detail();
	}
	public function clear_detail(){
		$this->cart->destroy();
		echo $this->view_detail();
	}
	public function load_detail2($id){
		$this->cart->destroy();
		$temp = $this->PaketKatering_model->get_detail($id);

		$id_array = 1;

		foreach ($temp as $key => $value) {
			$arr_data = array(
				'id' => $id_array,
				'name' => $value['NamaDetail'],
				'qty' => 1,
				'price' => 1,
				'bahan' => $value['Bahan']
			);
			$this->cart->insert($arr_data);

			$id_array++;
		}

		$count =0;
		$output='';

		foreach ($this->cart->contents() as $key => $value) {
			$count++;
			$output.='
				<tr>
					<td>'.$count.'</td>
					<td>'.$value["name"].'</td>
					<td>'.$value["bahan"].'</td>
					<td><button type="button" class="btn btn-dafault btn-xs hapus" name="btnHapus" id="'.$value["rowid"].'" disabled>Hapus</buttton></td>
				</tr>
			';
		}
		echo $output;

	}
	public function load_detail3(){
		$count =0;
		$output='';

		foreach ($this->cart->contents() as $key => $value) {
			$count++;
			$output.='
				<tr>
					<td>'.$count.'</td>
					<td>'.$value["name"].'</td>
					<td>'.$value["bahan"].'</td>
					<td><button type="button" class="btn btn-danger btn-xs hapus" name="btnHapus" id="'.$value["rowid"].'">Hapus</buttton></td>
				</tr>
			';
		}
		echo $output;

	}
	public function load_detail4(){
		$count =0;
		$output='';

		foreach ($this->cart->contents() as $key => $value) {
			$count++;
			$output.='
				<tr>
					<td>'.$count.'</td>
					<td>'.$value["name"].'</td>
					<td>'.$value["bahan"].'</td>
					<td><button type="button" class="btn btn-dafault btn-xs hapus" name="btnHapus" id="'.$value["rowid"].'" disabled>Hapus</buttton></td>
				</tr>
			';
		}
		echo $output;

	}
	public function simpan_detail_katering2(){
		$id = $this->input->post('Paket');

		$this->PaketKatering_model->delete_detail($id);

		foreach ($this->cart->contents() as $key => $value) {
			$data = array(
				'Nama' => $value['name'],
				'Bahan' => $value['bahan'],
				'Paket_Katering_Id' => $id
			);

			$this->DetailKatering_model->add($data);
		}

		$edit = array(
			'Id' => $id,
			'Status' => 1,
		);

		$this->PaketKatering_model->edit($edit);

		$this->session->set_userdata('message', 'Data Detail Katering Berhasil Diperbarui');
		
		header("Location: ".site_url('PaketKatering/detail_katering_index/'.$id));
	}*/
}
