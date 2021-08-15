<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DaftarKatering extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('DaftarKatering_model');
        $this->load->model('Anak_model');
        $this->load->model('PaketKatering_model');
        $this->load->helper('url_helper');
        $this->load->helper('form');
    	$this->load->library('form_validation');
     	$this->load->library('session');
     	$this->load->library('cart');
     	$this->load->library('pdf');
     	date_default_timezone_set('Asia/Jakarta');
     	if(empty($_SESSION['username'])){
     		header("Location: ".site_url('Auth/index'));
     	}
    }
	public function index($year = null,$month=null)
	{	
		if($_SESSION['hak_akses']!='ADMIN'&&$_SESSION['hak_akses']!='ANAK'){
     		header("Location: ".site_url('Anak/index'));
     	}
		if($year==null||$month==null){
			$year=substr(date('Y-m-d'),0,4);
			$month=substr(date('Y-m-d'),5,2);
		}

		$data['year']=$year;
		$data['month']=$month;

		$this->cart->destroy();

		$data['anak'] = $this->Anak_model->get_anak();
		$data['calendar'] = $this->DaftarKatering_model->generate($year,$month);
		$data['calendar2'] = $this->DaftarKatering_model->generate2($year,$month);

		$this->load->view('layout/header');
		$this->load->view('katering/daftar_katering',$data);
		$this->load->view('layout/footer');
	}
	public function add(){
		$id_anak = $this->input->post('anak');

		$ket='';
		$temp='false';
		foreach ($this->cart->contents() as $key => $value) {
			if($this->DaftarKatering_model->exist($id_anak,$value['id'])){
				$ket.='Anak ini sudah mendaftar paket tanggal '.date('m-d-Y',strtotime($value['tanggal'])).'<br>';
			}else{
				$temp='true';
				$data = array(
					'Anak_Id' => $id_anak,
					'Paket_Katering_Id' => $value['id'],
					'Tanggal' => date('Y-m-d'),
					'Jumlah' => $value['qty'],
				);

				$this->DaftarKatering_model->add($data);
			}
		}

		$this->cart->destroy();
		if($ket!=''){
			if($temp=='false')
				$this->session->set_userdata('info', $ket);
			else
				$this->session->set_userdata('info', $ket.'Paket lainnya yang dipesan berhasil disimpan');
		}else{
			$this->session->set_userdata('message', 'Data Order berhasil disimpan');
		}
		header("Location: ".site_url('DaftarKatering/index'));
	}
	public function show_detail(){
		$tanggal = $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];
		$temp = $this->DaftarKatering_model->get_detail_by_tanggal($tanggal);

		$output='';

		if((strtotime($tanggal)-259200)>=strtotime(date('Y-m-d'))){
			foreach ($temp as $row) {
				$output.='
			            <div class="col-md-4">
			              <div class="panel panel-default">
			                <div class="panel-heading">'.$row["Nama"].'</div>
			                <div class="panel-body">
			                	'.$row["Bahan"].'
			                </div>
			              </div>
			            </div>
	    		';
			}
			$output.='
			<br><div class="clearfix"></div>
			<form>
			<div class="item form-group">
              <label class="control-label col-sm-2" for="jumlah">Jumlah <span class="required">*</span>
              </label>
              <div class="col-md-4">
                <input id="jumlah'.$temp[0]["Id"].'" class="form-control" name="jumlah" value="1" min="1" required="required" type="number">
              </div>
            </div>
            </form>
            <br><div class="clearfix"></div>
			';
		}
		$footer='
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-success" disabled>Order</button>
        ';
		if($output!=''){
			$footer='
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-success order" data-paketid="'.$temp[0]["Id"].'" data-dismiss="modal">Order</button>
        ';
		}
		echo json_encode(array('body'=>$output,'footer'=>$footer));
	}
	public function show_detail2(){
		$tanggal = $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];
		$temp = $this->DaftarKatering_model->get_detail_by_tanggal2($tanggal);

		$output='';

		if((strtotime($tanggal)-259200)>=strtotime(date('Y-m-d'))){
			foreach ($temp as $row) {
				$output.='
			            <div class="col-md-4">
			              <div class="panel panel-default">
			                <div class="panel-heading">'.$row["Nama"].'</div>
			                <div class="panel-body">
			                	'.$row["Bahan"].'
			                </div>
			              </div>
			            </div>
	    		';
			}
			$output.='
			<br><div class="clearfix"></div>
			<form>
			<div class="item form-group">
              <label class="control-label col-sm-2" for="jumlah">Jumlah <span class="required">*</span>
              </label>
              <div class="col-md-4">
                <input id="jumlah'.$temp[0]["Id"].'" class="form-control" name="jumlah" value="1" min="1" required="required" type="number">
              </div>
            </div>
            </form>
            <br><div class="clearfix"></div>
			';
		}
		$footer='
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-success" disabled>Order</button>
        ';
		if($output!=''){
			$footer='
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-success order" data-paketid="'.$temp[0]["Id"].'" data-dismiss="modal">Order</button>
        ';
		}
		echo json_encode(array('body'=>$output,'footer'=>$footer));
	}
	public function order_katering(){
		$id_paket = $_POST['id_paket'];
		$jumlah = $_POST['jumlah'];

		$paket = $this->PaketKatering_model->get($id_paket);

		$data = array(
			'id' => $paket['Id'],
			'name' => $paket["Nama"],
			'qty' => $jumlah,
			'price' => 1,
			'tanggal' => $paket['Tanggal'],
		);

		$this->cart->insert($data);

		echo $this->show_order();
	}
	public function show_order(){
		$output="";
		$count=0;

		foreach ($this->cart->contents() as $key => $value) {
			$count++;
			$output.='
			<tr>
				<td>'.$count.'</td>
				<td>'.$value["name"].'</td>
				<td><input id="jumlah2'.$value["id"].'" class="form-control qty" name="jumlah2" data-rowid="'.$value["rowid"].'" value="'.$value["qty"].'" min="1" required="required" type="number"></td>
				<td>'.date('l, d-m-Y',strtotime($value['tanggal'])).'</td>
				<td><buttton type="button" name="btnHapus" id="'.$value["rowid"].'" class="btn btn-xs btn-danger remove">Hapus</button></td>
			</tr>
			';
		}

		if($count==0)
			$output='';

		return json_encode($output);
	}
	public function remove_order(){
		$rowid = $_POST['row_id'];

		$data= array(
			'rowid' => $rowid,
			'qty' =>0,
		);

		$this->cart->update($data);
		echo $this->show_order();
	}
	public function order_sebulan(){
		$bulan = $_POST['bulan'];
		$hari = $_POST['hari'];

		$paket = $this->PaketKatering_model->get_by_month($bulan);

		if($bulan>=date('m')){
			if($hari==1){
				foreach ($paket as $key => $value) {
					if(strtotime($value['Tanggal'])-259200>strtotime(date('Y-m-d'))){
						if(date('l',strtotime($value['Tanggal']))!='Saturday'){
							$data = array(
								'id' => $value['Id'],
								'name' => $value["Nama"],
								'qty' => 1,
								'price' => 1,
								'tanggal' => $value['Tanggal'],
							);

							$this->cart->insert($data);	
						}
					}
				}

			}else{
				foreach ($paket as $key => $value) {
					if(strtotime($value['Tanggal'])>strtotime(date('Y-m-d'))){
						$data = array(
							'id' => $value['Id'],
							'name' => $value["Nama"],
							'qty' => 1,
							'price' => 1,
							'tanggal' => $value['Tanggal'],
						);
					
						$this->cart->insert($data);	
					}
				}
			}
		}
		
		echo $this->show_order();
	}
	public function update_jumlah(){
		$row_id = $_POST['rowid'];
		$value = $_POST['value'];

		$data= array(
			'rowid' => $row_id,
			'qty' =>$value,
		);

		$this->cart->update($data);
		/*echo $this->show_order();*/
	}

	public function rekap(){
		if($_SESSION['hak_akses']!='ADMIN'){
     		header("Location: ".site_url('Anak/index'));
     	}

		$this->load->view('layout/header');
		$this->load->view('katering/rekap_katering');
		$this->load->view('layout/footer');
	}
	public function cetak_rekap(){
		$bulan = $this->input->post('bulan');

		$data['rekap'] = $this->DaftarKatering_model->get_rekap($bulan);

		$this->load->view('katering/lap_rekap',$data);
	}
	public function tampil_rekap(){
		$bulan = $_POST['bulan'];

		$data = $this->DaftarKatering_model->get_rekap($bulan);

		$output='';
		$count=0;
		foreach ($data as $key => $value) {
			$count++;
			$hari = date("l",strtotime($value["Tanggal"]));

			switch ($hari) {
				case 'Monday':
					$hari='Senin';
					break;
				case 'Tuesday':
					$hari='Selasa';
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
					# code...
					break;
			}
			$tanggal = date("d-m-Y",strtotime($value["Tanggal"]));
			$output.='
				<tr>
					<td>'.$count.'</td>
					<td>'.$hari.', '.$tanggal.'</td>
					<td>'.$value["Nama"].'</td>
					<td>'.$value["Jumlah"].'</td>
				</tr>
			';
		}
		echo $output;
	}
}
