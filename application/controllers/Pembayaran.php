<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Pembayaran_model');
        $this->load->model('DaftarPaket_model');
        $this->load->model('SettingPaketKatering_model');
        $this->load->model('DaftarKatering_model');
        $this->load->model('Absensi_model');
        $this->load->model('Anak_model');
        $this->load->model('BiayaOverTime_model');
        $this->load->model('Paket_model');
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
	public function index()
	{	
		if($_SESSION['hak_akses']!='ADMIN'){
     		header("Location: ".site_url('Anak/index'));
     	}
		$this->cart->destroy();
		$data['paket'] = $this->Paket_model->get_paket();

		$this->load->view('layout/header');
		$this->load->view('pembayaran/index',$data);
		$this->load->view('layout/footer');
	}
	public function simpan(){
		$id_anak = $this->input->post('anak');
		$bulan = $this->input->post('bulan');
		$gantikah = $this->input->post('gantikah');
		$hariankah = $this->input->post('harian');
		$paket_id = $this->input->post('paket');
		$jumlah_hari = $this->input->post('jumlahHari');

		$data = array(
			'Tanggal' => date('Y-m-d'),
			'Lunas' => 0,
			'Anak_Id' => $id_anak,
		);

		foreach ($this->cart->contents() as $key => $value) {
			if($value['id']==1){
				$data['TotalBiayaPenitipan'] = $value['price'];
			}else if($value['id']==2){
				$data['TotalBiayaKatering'] = $value['price'];
			}else if($value['id']==3){
				$data['TotalBiayaOverTime'] = $value['price'];
			}else if($value['id']==4){
				$data['TotalBiayaPendaftaran'] = $value['price'];
			}else if($value['id']==5){
				$data['TotalBiayaRegistrasi'] = $value['price'];
			}else{
				$data['TotalBiayaLain'] = $value['price'];
			}
		}

		$temp['anak'] = $this->Anak_model->get_anak($id_anak);

		/*UNTUK TAMPILAN NOTA*/
		$paket = $this->DaftarPaket_model->get_daftar_paket($id_anak);
		if($gantikah=='Ya'){
			$paket = $this->Paket_model->get_paket($paket_id);
		}
		$daftar_katering = $this->DaftarKatering_model->get_for_bayar($id_anak,$bulan);
		$overtime = $this->BiayaOverTime_model->get_for_bayar($id_anak,$bulan);
		$harga_katering = $this->SettingPaketKatering_model->get();

		$d=cal_days_in_month(CAL_GREGORIAN,date('m'),date('Y'));	
		
		

		//untuk biaya katering
		$biaya_katering1=0;
		$biaya_katering2=0;
		$count1=0;
		$count2=0;
		foreach ($daftar_katering as $key => $value) {
			if($value['Nama']=='PAKET 1'){
				$count1++;
				$biaya_katering1+=$harga_katering[0]['Harga'];
			}else{
				$count2++;
				$biaya_katering2+=$harga_katering[1]['Harga'];
			}		
		}


		//untuk biaya over time
		$biaya_overtime=0;
		$count3=0;
		$temp_biaya=0;
		foreach ($overtime as $key => $value) {
			$biaya_overtime+=$value["Biaya"];
			$count3++;
			$temp_biaya=$value["Biaya"];
		}


		$output='';
		$count=0;
		//untuk memunculkan tampilan
		foreach ($this->cart->contents() as $key => $value) {
			$count++;
			if($value['id']==1){
				if($hariankah=='Ya'){
					$output.='
						<tr>
							<td>'.$count.'</td>
							<td align="left">'.$value["name"].'</td>
							<td>'.$jumlah_hari.' hari x Rp. '.number_format($paket["Biaya"]).'</td>
							<td>Rp. '.number_format($value["price"]).'</td>
						</tr>		
					';
				}else{
					$output.='
						<tr>
							<td>'.$count.'</td>
							<td align="left">'.$value["name"].'</td>
							<td>1 bulan x Rp. '.number_format($value["price"]).'</td>
							<td>Rp. '.number_format($value["price"]).'</td>
						</tr>		
					';
				}
			}else if($value['id']==2){
				$output.='
					<tr>
						<td>'.$count.'</td>
						<td align="left">'.$value["name"].' :</td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td align="left">- Paket 1</td>
						<td>'.$count1.' x Rp. '.number_format($harga_katering[0]['Harga']).'</td>
						<td>Rp. '.number_format($biaya_katering1).'</td>
					</tr>
					<tr>
						<td></td>
						<td align="left">- Paket 2</td>
						<td>'.$count2.' x Rp. '.number_format($harga_katering[1]['Harga']).'</td>
						<td>Rp. '.number_format($biaya_katering2).'</td>
					</tr>
					<tr>
						<td></td>
						<td align="left">Total Biaya Katering</td>
						<td></td>
						<td>Rp. '.number_format($value["price"]).'</td>
					</tr>	
				';
			}else if($value['id']==3){
				$output.='
					<tr>
						<td>'.$count.'</td>
						<td align="left">'.$value["name"].'</td>
						<td>'.$count3.' x Rp. '.number_format($temp_biaya).'</td>
						<td>Rp. '.number_format($value["price"]).'</td>
					</tr>		
				';
			}else if($value['id']==4){
				$output.='
					<tr>
						<td>'.$count.'</td>
						<td align="left">'.$value["name"].'</td>
						<td>-</td>
						<td>Rp. '.number_format($value["price"]).'</td>
					</tr>		
				';
			}else if($value['id']==5){
				$output.='
					<tr>
						<td>'.$count.'</td>
						<td align="left">'.$value["name"].'</td>
						<td>-</td>
						<td>Rp. '.number_format($value["price"]).'</td>
					</tr>		
				';
			}else{
				$output.='
					<tr>
						<td>'.$count.'</td>
						<td align="left">'.$value["name"].'</td>
						<td>-</td>
						<td>Rp. '.number_format($value["price"]).'</td>
					</tr>		
				';
			}
		}
		$output.='
			<tr>
				<td colspan="3"><strong> GRAND TOTAL</strong></td>
				<td id="tdGrandTotal"> <strong>Rp. '.number_format($this->cart->total()).'</strong></td>
			</tr>
		';

		$temp['tampilan'] = $output;

		if($this->Pembayaran_model->add($data)){
			if($gantikah=='Ya'){
				$temp1 = $this->DaftarPaket_model->get_daftar_paket($id_anak);

				$this->DaftarPaket_model->set_non_aktif($id_anak,$temp1['Id']);

				$data = array(
					'Tanggal' => date('Y-m').'-'.substr($temp1['Tanggal'], 8,2),
					'TanggalAkhirBerlaku' =>  date('Y-m').'-'.substr($temp1['Tanggal'], 8,2),
					'TanggalDaftar' => date('Y-m-d'),
					'StatusAktif' => 1,
					'Anak_Id' => $id_anak,
					'Paket_Id' => $paket_id,
				);
				$this->DaftarPaket_model->add_daftar_paket($data);
			}
			$this->session->set_userdata('message', 'Data Pembayaran Berhasil Disimpan');
			$this->load->view('pembayaran/nota',$temp);

		}
		else{
			$this->session->set_userdata('error', 'Data Pembayaran Gagal Disimpan');
			header("Location: ".site_url('Pembayaran/index'));
		}

		
	}
	public function pelunasan(){
		if($_SESSION['hak_akses']!='ADMIN'){
     		header("Location: ".site_url('Anak/index'));
     	}
		$this->cart->destroy();
		$data['anak'] = $this->Anak_model->get_belum_lunas(date('m'));

		$this->load->view('layout/header');
		$this->load->view('pembayaran/pelunasan',$data);
		$this->load->view('layout/footer');
	}
	public function lunas(){
		$id_anak = $this->input->post('id_anak');

		$temp = $this->Pembayaran_model->exist($id_anak,date('m'));

		$data = array(
			'Id' => $temp['Id'],
			'TanggalBayar' => date('Y-m-d'),
			'Lunas' => 1,
		);

		if($this->Pembayaran_model->edit($data)){
			$this->session->set_userdata('message', 'Data Pelunasan Berhasil Disimpan');
		}else{
			$this->session->set_userdata('error', 'Data Pelunasan Gagal Disimpan');
		}
		header("Location: ".site_url('Pembayaran/pelunasan'));
	}
	public function tampil_tagihan(){
		if($_SESSION['hak_akses']!='ANAK'){
     		header("Location: ".site_url('Anak/index'));
     	}
		$this->cart->destroy();
		$data=array();
		if($this->Pembayaran_model->get_belum_lunas($_SESSION['id'],date('m'))){
			$temp =$this->Pembayaran_model->get_belum_lunas($_SESSION['id'],date('m'));

			$data['output']='
				<tr>
					<td>1</td>
					<td align="left">Total biaya penitipan 1 bulan ke depan</td>
					<td>Rp. '.number_format($temp["TotalBiayaPenitipan"]).'</td>
				</tr>
				<tr>
					<td>2</td>
					<td align="left">Total biaya katering</td>
					<td>Rp. '.number_format($temp["TotalBiayaKatering"]).'</td>
				</tr>
				<tr>
					<td>3</td>
					<td align="left">Total biaya Overtime</td>
					<td>Rp. '.number_format($temp["TotalBiayaOverTime"]).'</td>
				</tr>
				<tr>
					<td>4</td>
					<td align="left">Total biaya pendaftaran</td>
					<td>Rp. '.number_format($temp["TotalBiayaPendaftaran"]).'</td>
				</tr>
				<tr>
					<td>5</td>
					<td align="left">Total biaya registrasi</td>
					<td>Rp. '.number_format($temp["TotalBiayaRegistrasi"]).'</td>
				</tr>
				<tr>
					<td>6</td>
					<td align="left">Total biaya lain-lain</td>
					<td>Rp. '.number_format($temp["TotalBiayaLain"]).'</td>
				</tr>
				<tr>
					<td colspan="2">Total biaya lain-lain</td>
					<td>Rp. '.number_format($temp["TotalBiayaLain"]+$temp["TotalBiayaKatering"]+$temp["TotalBiayaPenitipan"]+$temp["TotalBiayaOverTime"]+$temp["TotalBiayaPendaftaran"]+$temp["TotalBiayaRegistrasi"]).'</td>
				</tr>
			';
		}

		$this->load->view('layout/header');
		$this->load->view('pembayaran/tampil_tagihan',$data);
		$this->load->view('layout/footer');
	}
	public function tampil_paket(){
		$id_anak = $_POST['id_anak'];

		$temp = $this->DaftarPaket_model->get_daftar_paket($id_anak);

		$output='
			<label class="control-label col-sm-4" for="anak">Paket saat ini
            </label>
            <div class="col-md-3">
                <input type="text" class="form-control" disabled="" value="'.$temp["Nama"].'">
            </div>';

        echo $output;
	}
	public function anak_notin_pembayaran(){
		$bulan = $_POST['bulan'];

		$anak = $this->Anak_model->get_notin_pembayaran($bulan);

		$output = '<option></option>';
		foreach ($anak as $key => $value) {
			$output.='<option value="'.$value["Id"].'">'.$value["Nama"].'</option>';
		}

		echo $output;
	}
	public function tampil_pembayaran(){
		$this->cart->destroy();
		$bulan = $_POST['bulan'];
		$id_anak = $_POST['id_anak'];
		$gantikah = $_POST['gantikah'];
		$hariankah = $_POST['hariankah'];
		$paket_id = $_POST['paket'];
		$jumlah_hari = $_POST['jumlah_hari'];


		$paket = $this->DaftarPaket_model->get_daftar_paket($id_anak);
		if($gantikah=='Ya'){
			$paket = $this->Paket_model->get_paket($paket_id);
		}
		$daftar_katering = $this->DaftarKatering_model->get_for_bayar($id_anak,$bulan);
		$overtime = $this->BiayaOverTime_model->get_for_bayar($id_anak,$bulan);
		$harga_katering = $this->SettingPaketKatering_model->get();

		$d=cal_days_in_month(CAL_GREGORIAN,date('m'),date('Y'));	
		//untuk biaya penitipian
		if($hariankah=='Ya'){
			$data = array(
				'id' => 1,
				'name' => 'Biaya Penitipan 1 bulan ke depan : '.$paket['Nama'],
				'qty' =>1,
				'price' => $jumlah_hari*$paket['Biaya'],
			);
		}else{
			$data = array(
				'id' => 1,
				'name' => 'Biaya Penitipan 1 bulan ke depan : '.$paket['Nama'],
				'qty' =>1,
				'price' => $paket['Biaya'],
			);
		}
		$this->cart->insert($data);

		//untuk biaya katering
		$biaya_katering1=0;
		$biaya_katering2=0;
		$count1=0;
		$count2=0;
		foreach ($daftar_katering as $key => $value) {
			if($value['Nama']=='PAKET 1'){
				$count1++;
				$biaya_katering1+=$harga_katering[0]['Harga'];
			}else{
				$count2++;
				$biaya_katering2+=$harga_katering[1]['Harga'];
			}		
		}

		$data = array(
			'id' => 2,
			'name' => 'Biaya Katering ',
			'qty' =>1,
			'price' => $biaya_katering1+$biaya_katering2,
		);

		$this->cart->insert($data);


		//untuk biaya over time
		$biaya_overtime=0;
		$count3=0;
		$temp_biaya=0;
		foreach ($overtime as $key => $value) {
			$biaya_overtime+=$value["Biaya"];
			$count3++;
			$temp_biaya=$value["Biaya"];
		}

		$data = array(
			'id' => 3,
			'name' => 'Biaya Overtime ',
			'qty' =>1,
			'price' => $biaya_overtime,
		);

		$this->cart->insert($data);

		//untuk biaya pendaftaran
		$data = array(
			'id' => 4,
			'name' => 'Biaya Pendaftaran ',
			'qty' =>1,
			'price' => 0,
		);

		$this->cart->insert($data);

		//untuk biaya registrasi
		$data = array(
			'id' => 5,
			'name' => 'Biaya Registrasi ',
			'qty' =>1,
			'price' => 0,
		);

		$this->cart->insert($data);

		//untuk biaya lain-lain
		$data = array(
			'id' => 6,
			'name' => 'Biaya Lain-lain ',
			'qty' =>1,
			'price' => 0,
		);

		$this->cart->insert($data);


		$output='';
		$count=0;
		//untuk memunculkan tampilan
		foreach ($this->cart->contents() as $key => $value) {
			$count++;
			if($value['id']==1){
				if($hariankah=='Ya'){
					$output.='
						<tr>
							<td>'.$count.'</td>
							<td align="left">'.$value["name"].'</td>
							<td>'.$jumlah_hari.' hari x Rp. '.number_format($paket["Biaya"]).'</td>
							<td>Rp. '.number_format($value["price"]).'</td>
						</tr>		
					';
				}else{
					$output.='
						<tr>
							<td>'.$count.'</td>
							<td align="left">'.$value["name"].'</td>
							<td>1 bulan x Rp. '.number_format($value["price"]).'</td>
							<td>Rp. '.number_format($value["price"]).'</td>
						</tr>		
					';
				}
			}else if($value['id']==2){
				$output.='
					<tr>
						<td>'.$count.'</td>
						<td align="left">'.$value["name"].' :</td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td align="left">- Paket 1</td>
						<td>'.$count1.' x Rp. '.number_format($harga_katering[0]['Harga']).'</td>
						<td>Rp. '.number_format($biaya_katering1).'</td>
					</tr>
					<tr>
						<td></td>
						<td align="left">- Paket 2</td>
						<td>'.$count2.' x Rp. '.number_format($harga_katering[1]['Harga']).'</td>
						<td>Rp. '.number_format($biaya_katering2).'</td>
					</tr>
					<tr>
						<td></td>
						<td align="left">Total Biaya Katering</td>
						<td></td>
						<td><input type="text" class="form-control harga_format" id="formatBiayaKatering" value="Rp. '.number_format($value["price"]).',00" data-rowid="'.$value["rowid"].'"></td>
					</tr>	
				';
			}else if($value['id']==3){
				$output.='
					<tr>
						<td>'.$count.'</td>
						<td align="left">'.$value["name"].'</td>
						<td>'.$count3.' x Rp. '.number_format($temp_biaya).'</td>
						<td>Rp. '.number_format($value["price"]).'</td>
					</tr>		
				';
			}else if($value['id']==4){
				$output.='
					<tr>
						<td>'.$count.'</td>
						<td align="left">'.$value["name"].'</td>
						<td>-</td>
						<td><input type="text" class="form-control harga_format" id="formatBiayaPendaftaran" value="Rp. '.number_format($value["price"]).',00" data-rowid="'.$value["rowid"].'"></td>
					</tr>		
				';
			}else if($value['id']==5){
				$output.='
					<tr>
						<td>'.$count.'</td>
						<td align="left">'.$value["name"].'</td>
						<td>-</td>
						<td><input type="text" class="form-control harga_format" id="formatBiayaAdministrasi" value="Rp. '.number_format($value["price"]).',00" data-rowid="'.$value["rowid"].'"></td>
					</tr>		
				';
			}else{
				$output.='
					<tr>
						<td>'.$count.'</td>
						<td align="left">'.$value["name"].'</td>
						<td>-</td>
						<td><input type="text" class="form-control harga_format" id="formatBiayaLain" value="Rp. '.number_format($value["price"]).',00" data-rowid="'.$value["rowid"].'"></td>
					</tr>		
				';
			}
		}
		$output.='
			<tr>
				<td colspan="3"><strong> GRAND TOTAL</strong></td>
				<td id="tdGrandTotal"> <strong>Rp. '.number_format($this->cart->total()).'</strong></td>
			</tr>
		';

		echo $output;
	}
	public function update_biaya(){
		$rowid = $_POST['rowid'];
		$biaya = $_POST['biaya'];

		$data = array(
		       'rowid'  => $rowid,
		       'price'  => $biaya,
		);

		$this->cart->update($data);

		echo '<strong>Rp. '.number_format($this->cart->total()).'</strong>';
	}
}
