<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FormHarian extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Anak_model');
        $this->load->model('Karyawan_model');
        $this->load->model('FormHarian_model');
        $this->load->helper('url_helper');
        $this->load->helper('form');
    	$this->load->library('form_validation');
     	$this->load->library('session');
     	$this->load->library('cart');
        if(empty($_SESSION['username'])){
            header("Location: ".site_url('Auth/index'));
        }
        date_default_timezone_set('Asia/Jakarta');
    }
    public function buat_form(){
        if($_SESSION['hak_akses']!='ADMIN'&&$_SESSION['hak_akses']!='NANNY'){
            header("Location: ".site_url('Anak/index'));
        }
        else if($_SESSION['hak_akses']=='ADMIN')
            $data['anak'] = $this->Anak_model->get_notin_form_today2();
        else
    	    $data['anak'] = $this->Anak_model->get_notin_form_today($_SESSION['id']);

        $data['karyawan']=$this->Karyawan_model->get_pengasuh();
		$this->load->view('layout/header');
		$this->load->view('form_harian/buat_form',$data);
		$this->load->view('layout/footer');
    }
    public function tambah_form(){
        $pengasuh ='';
        if($_SESSION['hak_akses']=='ADMIN')
            $pengasuh = $this->input->post('pengasuh');
        else
            $pengasuh = $_SESSION['id'];

    	$data = array(
    		'Tanggal' => date('Y-m-d'),
    		'SuhuBadanDatang' => $this->input->post('suhuBadanDatang'),
    		'CatatanOrangtua' => $this->input->post('catatanKhususOrangtua'),
    		'KondisiKesehatan' => $this->input->post('kondisiKesehatan'),
    		'Karyawan_Id' => $pengasuh,
    		'Anak_Id' => $this->input->post('anak'),
    	);
    	if($this->FormHarian_model->add_form_harian($data))
    		$this->session->set_userdata('message', 'Form Harian Berhasil Dibuat');
		else
			$this->session->set_userdata('error', 'Form Harian Gagal Dibuat');

		header("Location: ".site_url('FormHarian/buat_form'));
    }

    /*CATATAN OBAT & VITAMIN*/
    public function catatan_obat_vitamin(){
    	$this->cart->destroy();
        if($_SESSION['hak_akses']!='ADMIN'&&$_SESSION['hak_akses']!='NANNY'){
            header("Location: ".site_url('Anak/index'));
        }
        else if($_SESSION['hak_akses']=='ADMIN')
            $data['anak'] = $this->Anak_model->get_anak_asuh2();
        else
    	    $data['anak'] = $this->Anak_model->get_anak_asuh($_SESSION['id']);
    	
        $data['karyawan'] = $this->Karyawan_model->get_karyawan();

		$this->load->view('layout/header');
		$this->load->view('form_harian/catatan_obat_vitamin',$data);
		$this->load->view('layout/footer');
    }
    public function tambah_catatan_obat_vit(){
    	$anak = $this->input->post('anak');

    	$formHarian = $this->FormHarian_model->get_by_anak_today($anak);

    	foreach ($this->cart->contents() as $key => $value) {
    		$data = array(
    			'Nama' => $value['name'],
    			'Dosis' => $value['dosis'],
    			'JadwalMinum' => $value['jadwalMinum'],
    			'WaktuPemberian' => $value['waktuPemberian'],
    			'NoForm' => $formHarian['NoForm'],
    			'Pemberi' => $value['idPemberi'],
    			'PenanggungJawab' => $value['idPenanggungJawab'],
    		);

    		$this->FormHarian_model->add_daftar_obat_vitamin($data);
    	}
    	$this->session->set_userdata('message', 'Catatan obat vitamin pada anak ini berhasil ditambahkan');
    	header("Location: ".site_url('FormHarian/catatan_obat_vitamin'));
    }

    public function tambah_daftar_obat_vitamin(){
    	$obatVit = $_POST['obatVit'];
    	$dosis = $_POST['dosis'];
    	$jadwalMinum = $_POST['jadwalMinum'];
    	$waktuPemberian = $_POST['waktuPemberian'];
    	$pemberi = $this->Karyawan_model->get_karyawan($_POST['pemberi']);
    	$penanggungJawab = $this->Karyawan_model->get_karyawan($_POST['penanggungJawab']);

    	$data = array(
    		'id' =>	strtotime(date('Y-m-d H:i:s')),
    		'name' => $obatVit,
    		'qty' =>1,
    		'price' => 1,
    		'dosis' => $dosis,
    		'jadwalMinum' => $jadwalMinum,
    		'waktuPemberian' => $waktuPemberian,
    		'idPemberi' => $pemberi['Id'],
    		'namaPemberi' => $pemberi['Nama'],
    		'idPenanggungJawab' => $penanggungJawab['Id'],
    		'namaPenanggungJawab' => $penanggungJawab['Nama'],
    	);

    	$this->cart->insert($data);

    	echo $this->tampil_daftar_obat_vitamin();
    }
    public function tampil_daftar_obat_vitamin(){
    	$output='';
    	$count=0;

    	foreach ($this->cart->contents() as $key => $value) {
    		$count++;
    		$output.='
    			<tr>
    				<td>'.$count.'</td>
    				<td>'.$value["name"].'</td>
    				<td>'.$value["dosis"].'</td>
    				<td>'.$value["jadwalMinum"].'</td>
    				<td>'.$value["waktuPemberian"].'</td>
    				<td>'.$value["namaPemberi"].'</td>
    				<td>'.$value["namaPenanggungJawab"].'</td>
    				<td><button type="button" class="btn btn-xs btn-danger remove" id="'.$value["rowid"].'">Hapus</button></td>
    			</tr>
    		';
    	}
    	if($count==0)
    		$output='';
    	return $output;
    }
    public function remove_daftar_obat_vitamin(){
    	$this->cart->remove($_POST['rowid']);

    	echo $this->tampil_daftar_obat_vitamin();
    }

    /*CATATAN BAB*/
    public function catatan_bab(){
    	$this->cart->destroy();
        if($_SESSION['hak_akses']!='ADMIN'&&$_SESSION['hak_akses']!='NANNY'){
            header("Location: ".site_url('Anak/index'));
        }
        else if($_SESSION['hak_akses']=='ADMIN')
            $data['anak'] = $this->Anak_model->get_anak_asuh2();
        else
            $data['anak'] = $this->Anak_model->get_anak_asuh($_SESSION['id']);

		$this->load->view('layout/header');
		$this->load->view('form_harian/catatan_bab',$data);
		$this->load->view('layout/footer');
    }
    public function tambah_catatan_bab(){
    	$anak = $this->input->post('anak');

    	$formHarian = $this->FormHarian_model->get_by_anak_today($anak);

    	foreach ($this->cart->contents() as $key => $value) {
    		$data = array(
    			'Waktu' => $value['waktu'],
    			'Keterangan' => $value['keterangan'],
    			'NoForm' => $formHarian['NoForm'],
    		);

    		$this->FormHarian_model->add_catatan_bab($data);
    	}
    	$this->session->set_userdata('message', 'Catatan bab pada anak ini berhasil ditambahkan');
    	header("Location: ".site_url('FormHarian/catatan_bab'));
    }
    public function tambah_daftar_bab(){
    	$waktu = $_POST['waktu'];
    	$keterangan = $_POST['keterangan'];

    	$data = array(
    		'id' => strtotime(date('Y-m-d H:i:s')),
    		'name' => 'unknown',
    		'qty' =>1,
    		'price' => 1,
    		'waktu' => $waktu,
    		'keterangan' => $keterangan,
    	);

    	$this->cart->insert($data);

    	echo $this->tampil_daftar_bab();
    }
    public function tampil_daftar_bab(){
    	$output='';
    	$count=0;

    	foreach ($this->cart->contents() as $key => $value) {
    		$count++;
    		$output.='
    			<tr>
    				<td>'.$count.'</td>
    				<td>'.$value["waktu"].'</td>
    				<td>'.$value["keterangan"].'</td>
    				<td><button type="button" class="btn btn-xs btn-danger remove" id="'.$value["rowid"].'">Hapus</button></td>
    			</tr>
    		';
    	}
    	if($count==0)
    		$output='';
    	return $output;
    }
    public function hapus_daftar_bab(){
    	$this->cart->remove($_POST['rowid']);

    	echo $this->tampil_daftar_bab();
    }

    public function catatan_tidur(){
    	$this->cart->destroy();

        if($_SESSION['hak_akses']!='ADMIN'&&$_SESSION['hak_akses']!='NANNY'){
            header("Location: ".site_url('Anak/index'));
        }
        else if($_SESSION['hak_akses']=='ADMIN')
            $data['anak'] = $this->Anak_model->get_anak_asuh2();
        else
            $data['anak'] = $this->Anak_model->get_anak_asuh($_SESSION['id']);

    	$data['tampil'] ='';
    	$count=0;
    	foreach ($data['anak'] as $key => $value) {
    		$count++;
    		$data['tampil'].='
    			<tr>
    				<td>'.$count.'</td>
    				<td>'.$value["Nama"].'</td>
    				<td><input form="form_catatan_tidur" type="checkbox" name="anak[]" class="pilih" value="'.$value["Id"].'"></td>
    			</tr>
    		';
    	}

		$this->load->view('layout/header');
		$this->load->view('form_harian/catatan_tidur',$data);
		$this->load->view('layout/footer');
    }
    public function tambah_catatan_tidur(){
    	foreach ($this->input->post('anak') as $key => $value) {

    		//ambil form harian pada hari ini berdasarkan id anak
    		$formHarian = $this->FormHarian_model->get_by_anak_today($value);

    		$data = array(
    			'JamMulaiTidur' => $this->input->post('jamMulaiTidur'),
    			'JamBangun' => $this->input->post('jamBangun'),
    			'NoForm' => $formHarian['NoForm'],
    		);

    		$this->FormHarian_model->add_catatan_tidur($data);
    	}

    	$this->session->set_userdata('message', 'Berhasil menambahkan catatan tidur pada setiap anak yang dipilih');
    	header("Location: ".site_url('FormHarian/catatan_tidur'));
    }
    public function catatan_minum_susu(){
    	$this->cart->destroy();

        if($_SESSION['hak_akses']!='ADMIN'&&$_SESSION['hak_akses']!='NANNY'){
            header("Location: ".site_url('Anak/index'));
        }
        else if($_SESSION['hak_akses']=='ADMIN')
            $data['anak'] = $this->Anak_model->get_anak_asuh2();
        else
            $data['anak'] = $this->Anak_model->get_anak_asuh($_SESSION['id']);

    	$data['tampil'] ='';
    	$count=0;
    	foreach ($data['anak'] as $key => $value) {
    		$count++;
    		$data['tampil'].='
    			<tr>
    				<td>'.$count.'</td>
    				<td>'.$value["Nama"].'</td>
    				<td><textarea style="width:100%;" form="form_catatan_minum_susu" class="form-control keterangan" rows="3" id="keterangan'.$value["Id"].'" name="keterangan'.$value["Id"].'" disabled></textarea></td>
    				<td><input form="form_catatan_minum_susu" type="checkbox" name="anak[]" class="pilih" id="'.$value["Id"].'" value="'.$value["Id"].'"></td>
    			</tr>
    		';
    	}

		$this->load->view('layout/header');
		$this->load->view('form_harian/catatan_minum_susu',$data);
		$this->load->view('layout/footer');
    }
    public function tambah_catatan_minum_susu(){
    	foreach ($this->input->post('anak') as $key => $value) {

    		//ambil form harian pada hari ini berdasarkan id anak
    		$formHarian = $this->FormHarian_model->get_by_anak_today($value);

    		$data = array(
    			'Waktu' => $this->input->post('waktu'),
    			'CC' => $this->input->post('cc'),
    			'Keterangan' => $this->input->post('keterangan'.$value),
    			'NoForm' => $formHarian['NoForm'],
    		);

    		$this->FormHarian_model->add_catatan_minum_susu($data);
    	}

    	$this->session->set_userdata('message', 'Berhasil menambahkan catatan minum susu pada setiap anak yang dipilih');
    	header("Location: ".site_url('FormHarian/catatan_minum_susu'));
    }
    public function catatan_makan(){
    	$this->cart->destroy();

        if($_SESSION['hak_akses']!='ADMIN'&&$_SESSION['hak_akses']!='NANNY'){
            header("Location: ".site_url('Anak/index'));
        }
    	else if($_SESSION['hak_akses']=='ADMIN')
            $data['anak'] = $this->Anak_model->get_anak_asuh2();
        else
            $data['anak'] = $this->Anak_model->get_anak_asuh($_SESSION['id']);

    	$data['tampil'] ='';
    	$count=0;
    	foreach ($data['anak'] as $key => $value) {
    		$count++;
    		$data['tampil'].='
    			<tr>
    				<td>'.$count.'</td>
    				<td>'.$value["Nama"].'</td>
    				<td><textarea style="width:100%;" form="form_catatan_makan" class="form-control keterangan" rows="3" id="keterangan'.$value["Id"].'" name="keterangan'.$value["Id"].'" disabled></textarea></td>
    				<td><input form="form_catatan_makan" type="checkbox" name="anak[]" class="pilih" id="'.$value["Id"].'" value="'.$value["Id"].'"></td>
    			</tr>
    		';
    	}

		$this->load->view('layout/header');
		$this->load->view('form_harian/catatan_makan',$data);
		$this->load->view('layout/footer');
    }
    public function tambah_catatan_makan(){
    	foreach ($this->input->post('anak') as $key => $value) {

    		//ambil form harian pada hari ini berdasarkan id anak
    		$formHarian = $this->FormHarian_model->get_by_anak_today($value);

    		$data = array(
    			'Jenis' => $this->input->post('jenis'),
    			'Waktu' => $this->input->post('waktu'),
    			'Keterangan' => $this->input->post('keterangan'.$value),
    			'NoForm' => $formHarian['NoForm'],
    		);

    		$this->FormHarian_model->add_catatan_makan($data);
    	}

    	$this->session->set_userdata('message', 'Berhasil menambahkan catatan makan pada setiap anak yang dipilih');
    	header("Location: ".site_url('FormHarian/catatan_makan'));
    }
    public function catatan_snack(){
    	$this->cart->destroy();

        if($_SESSION['hak_akses']!='ADMIN'&&$_SESSION['hak_akses']!='NANNY'){
            header("Location: ".site_url('Anak/index'));
        }
    	else if($_SESSION['hak_akses']=='ADMIN')
            $data['anak'] = $this->Anak_model->get_anak_asuh2();
        else
            $data['anak'] = $this->Anak_model->get_anak_asuh($_SESSION['id']);

    	$data['tampil'] ='';
    	$count=0;
    	foreach ($data['anak'] as $key => $value) {
    		$count++;
    		$data['tampil'].='
    			<tr>
    				<td>'.$count.'</td>
    				<td>'.$value["Nama"].'</td>
    				<td><textarea style="width:100%;" form="form_catatan_snack" class="form-control keterangan" rows="3" id="keterangan'.$value["Id"].'" name="keterangan'.$value["Id"].'" disabled></textarea></td>
    				<td><input form="form_catatan_snack" type="checkbox" name="anak[]" class="pilih" id="'.$value["Id"].'" value="'.$value["Id"].'"></td>
    			</tr>
    		';
    	}

		$this->load->view('layout/header');
		$this->load->view('form_harian/catatan_snack',$data);
		$this->load->view('layout/footer');
    }
    public function tambah_catatan_snack(){
    	foreach ($this->input->post('anak') as $key => $value) {

    		//ambil form harian pada hari ini berdasarkan id anak
    		$formHarian = $this->FormHarian_model->get_by_anak_today($value);

    		$data = array(
    			'Jenis' => $this->input->post('jenis'),
    			'Waktu' => $this->input->post('waktu'),
    			'Keterangan' => $this->input->post('keterangan'.$value),
    			'NoForm' => $formHarian['NoForm'],
    		);

    		$this->FormHarian_model->add_catatan_snack($data);
    	}

    	$this->session->set_userdata('message', 'Berhasil menambahkan catatan snack pada setiap anak yang dipilih');
    	header("Location: ".site_url('FormHarian/catatan_snack'));
    }
    public function catatan_akhir(){
        $this->cart->destroy();

        if($_SESSION['hak_akses']!='ADMIN'&&$_SESSION['hak_akses']!='NANNY'){
            header("Location: ".site_url('Anak/index'));
        }
        else if($_SESSION['hak_akses']=='ADMIN')
            $data['anak'] = $this->Anak_model->get_anak_asuh2();
        else
            $data['anak'] = $this->Anak_model->get_anak_asuh($_SESSION['id']);


        $this->load->view('layout/header');
        $this->load->view('form_harian/catatan_akhir',$data);
        $this->load->view('layout/footer');
    }
    public function tambah_catatan_akhir(){
        //ambil form harian pada hari ini berdasarkan id anak
        $formHarian = $this->FormHarian_model->get_by_anak_today($this->input->post('anak'));

        foreach ($this->input->post('barang') as $key => $value) {
            $dataBarang = array(
                'Nama' => $value,
                'Keterangan' => $this->input->post('keterangan'.$key),
                'NoForm' => $formHarian['NoForm'],
            );
            $this->FormHarian_model->add_barang_harus_dibawa($dataBarang);
        }

        //jika ada barang lain makan ditambahkan
        if($this->input->post('barangLain')!=""){
            $dataBarang = array(
                'Nama' => $this->input->post('barangLain'),
                'Keterangan' => $this->input->post('keteranganLain'),
                'NoForm' => $formHarian['NoForm'],
            );
            $this->FormHarian_model->add_barang_harus_dibawa($dataBarang);   
        }

        //update data form harian
        $dataUpdate = array(
            'NoForm' => $formHarian['NoForm'],
            'PotongKuku' => $this->input->post('potongKuku'),
            'CatatanMom' => $this->input->post('catatanKhusus'),
            'Status' => 1,
        );
        $this->FormHarian_model->edit_form($dataUpdate);

        $this->session->set_userdata('message', 'Berhasil disimpan, form harian untuk anak ini telah selesai');
        header("Location: ".site_url('FormHarian/catatan_akhir'));
    }
    /*CODING SEBELUM REVISI*/
	/*public function index()
	{	
		$data['anak'] = $this->Anak_model->get_anak();
		$data['karyawan'] = $this->Karyawan_model->get_karyawan();

		$this->load->view('layout/header');
		$this->load->view('form_harian/index',$data);
		$this->load->view('layout/footer');
	}
	public function add(){
		$form_harian = array(
			'Tanggal' => date('Y-m-d'),
			'SuhuBadanDatang' => $this->input->post('suhuBadanDatang'),
			'CatatanOrangtua' => $this->input->post('catatanKhususOrangtua'),
			'KondisiKesehatan' => $this->input->post('kondisiKesehatan'),
			'PotongKuku' => $this->input->post('potongKuku'),
			'CatatanMom' => $this->input->post('catatanKhususMom'),
			'Karyawan_Id' => $_SESSION['id'],
			'Anak_Id' => $this->input->post('anak')
		);

		$this->FormHarian_model->add_form_harian($form_harian);

		$temp = $this->FormHarian_model->get_last();
		$noForm = $temp['NoForm'];

		//obat vitamin 1
		if($this->input->post('namaObat1')!=""){
			$daftarObatVitamin = array(
				'Nama' => $this->input->post('namaObat1'),
				'Dosis' => $this->input->post('dosis1'),
				'JadwalMinum' => $this->input->post('jadwalMinum11'),
				'WaktuPemberian' => $this->input->post('waktuPemberian11'),
				'NoForm' => $noForm,
				'Pemberi' => $this->input->post('pemberi11'),
				'PenanggungJawab' => $this->input->post('penanggungJawab11')
			);

			$this->FormHarian_model->add_daftar_obat_vitamin($daftarObatVitamin);

			if($this->input->post('jadwalMinum12')!=""){
				$daftarObatVitamin = array(
					'Nama' => $this->input->post('namaObat1'),
					'Dosis' => $this->input->post('dosis1'),
					'JadwalMinum' => $this->input->post('jadwalMinum12'),
					'WaktuPemberian' => $this->input->post('waktuPemberian12'),
					'NoForm' => $noForm,
					'Pemberi' => $this->input->post('pemberi12'),
					'PenanggungJawab' => $this->input->post('penanggungJawab12')
				);

				$this->FormHarian_model->add_daftar_obat_vitamin($daftarObatVitamin);
			}
		}
		//obat vitamin 2
		if($this->input->post('namaObat2')!=""){
			$daftarObatVitamin = array(
				'Nama' => $this->input->post('namaObat2'),
				'Dosis' => $this->input->post('dosis2'),
				'JadwalMinum' => $this->input->post('jadwalMinum21'),
				'WaktuPemberian' => $this->input->post('waktuPemberian21'),
				'NoForm' => $noForm,
				'Pemberi' => $this->input->post('pemberi21'),
				'PenanggungJawab' => $this->input->post('penanggungJawab21')
			);

			$this->FormHarian_model->add_daftar_obat_vitamin($daftarObatVitamin);

			if($this->input->post('jadwalMinum22')!=""){
				$daftarObatVitamin = array(
					'Nama' => $this->input->post('namaObat2'),
					'Dosis' => $this->input->post('dosis2'),
					'JadwalMinum' => $this->input->post('jadwalMinum22'),
					'WaktuPemberian' => $this->input->post('waktuPemberian22'),
					'NoForm' => $noForm,
					'Pemberi' => $this->input->post('pemberi22'),
					'PenanggungJawab' => $this->input->post('penanggungJawab22')
				);

				$this->FormHarian_model->add_daftar_obat_vitamin($daftarObatVitamin);
			}
		}
		//obat vitamin 3
		if($this->input->post('namaObat3')!=""){
			$daftarObatVitamin = array(
				'Nama' => $this->input->post('namaObat3'),
				'Dosis' => $this->input->post('dosis3'),
				'JadwalMinum' => $this->input->post('jadwalMinum31'),
				'WaktuPemberian' => $this->input->post('waktuPemberian31'),
				'NoForm' => $noForm,
				'Pemberi' => $this->input->post('pemberi31'),
				'PenanggungJawab' => $this->input->post('penanggungJawab31')
			);

			$this->FormHarian_model->add_daftar_obat_vitamin($daftarObatVitamin);

			if($this->input->post('jadwalMinum32')!=""){
				$daftarObatVitamin = array(
					'Nama' => $this->input->post('namaObat3'),
					'Dosis' => $this->input->post('dosis3'),
					'JadwalMinum' => $this->input->post('jadwalMinum32'),
					'WaktuPemberian' => $this->input->post('waktuPemberian32'),
					'NoForm' => $noForm,
					'Pemberi' => $this->input->post('pemberi32'),
					'PenanggungJawab' => $this->input->post('penanggungJawab32')
				);

				$this->FormHarian_model->add_daftar_obat_vitamin($daftarObatVitamin);
			}
		}
		//obat vitamin 4
		if($this->input->post('namaObat4')!=""){
			$daftarObatVitamin = array(
				'Nama' => $this->input->post('namaObat4'),
				'Dosis' => $this->input->post('dosis4'),
				'JadwalMinum' => $this->input->post('jadwalMinum41'),
				'WaktuPemberian' => $this->input->post('waktuPemberian41'),
				'NoForm' => $noForm,
				'Pemberi' => $this->input->post('pemberi41'),
				'PenanggungJawab' => $this->input->post('penanggungJawab41')
			);

			$this->FormHarian_model->add_daftar_obat_vitamin($daftarObatVitamin);

			if($this->input->post('jadwalMinum42')!=""){
				$daftarObatVitamin = array(
					'Nama' => $this->input->post('namaObat4'),
					'Dosis' => $this->input->post('dosis4'),
					'JadwalMinum' => $this->input->post('jadwalMinum42'),
					'WaktuPemberian' => $this->input->post('waktuPemberian42'),
					'NoForm' => $noForm,
					'Pemberi' => $this->input->post('pemberi42'),
					'PenanggungJawab' => $this->input->post('penanggungJawab42')
				);

				$this->FormHarian_model->add_daftar_obat_vitamin($daftarObatVitamin);
			}
		}
		//obat vitamin 5
		if($this->input->post('namaObat5')!=""){
			$daftarObatVitamin = array(
				'Nama' => $this->input->post('namaObat5'),
				'Dosis' => $this->input->post('dosis5'),
				'JadwalMinum' => $this->input->post('jadwalMinum51'),
				'WaktuPemberian' => $this->input->post('waktuPemberian51'),
				'NoForm' => $noForm,
				'Pemberi' => $this->input->post('pemberi51'),
				'PenanggungJawab' => $this->input->post('penanggungJawab51')
			);

			$this->FormHarian_model->add_daftar_obat_vitamin($daftarObatVitamin);

			if($this->input->post('jadwalMinum52')!=""){
				$daftarObatVitamin = array(
					'Nama' => $this->input->post('namaObat5'),
					'Dosis' => $this->input->post('dosis5'),
					'JadwalMinum' => $this->input->post('jadwalMinum52'),
					'WaktuPemberian' => $this->input->post('waktuPemberian52'),
					'NoForm' => $noForm,
					'Pemberi' => $this->input->post('pemberi52'),
					'PenanggungJawab' => $this->input->post('penanggungJawab52')
				);

				$this->FormHarian_model->add_daftar_obat_vitamin($daftarObatVitamin);
			}
		}

		//tambah catatan makan
		if($this->input->post('jenisMakan1')!=""){
			$daftar_makan = array(
				'Nama' => 'Pagi',
				'Jenis' => $this->input->post('jenisMakan1'),
				'Waktu' => $this->input->post('waktuMakan1'),
				'Keterangan' => $this->input->post('keteranganMakan1'),
				'NoForm' => $noForm,
			);

			$this->FormHarian_model->add_catatan_makan($daftar_makan);
		}
		if($this->input->post('jenisMakan2')!=""){
			$daftar_makan = array(
				'Nama' => 'Siang',
				'Jenis' => $this->input->post('jenisMakan2'),
				'Waktu' => $this->input->post('waktuMakan2'),
				'Keterangan' => $this->input->post('keteranganMakan2'),
				'NoForm' => $noForm,
			);

			$this->FormHarian_model->add_catatan_makan($daftar_makan);
		}
		if($this->input->post('jenisMakan3')!=""){
			$daftar_makan = array(
				'Nama' => 'Sore',
				'Jenis' => $this->input->post('jenisMakan3'),
				'Waktu' => $this->input->post('waktuMakan3'),
				'Keterangan' => $this->input->post('keteranganMakan3'),
				'NoForm' => $noForm,
			);

			$this->FormHarian_model->add_catatan_makan($daftar_makan);
		}

		//tambah catatan snack
		if($this->input->post('jenisSnack1')!=""){
			$daftar_snack = array(
				'Nama' => 'Snack 1',
				'Jenis' => $this->input->post('jenisSnack1'),
				'Waktu' => $this->input->post('waktuSnack1'),
				'Keterangan' => $this->input->post('keteranganSnack1'),
				'NoForm' => $noForm,
			);

			$this->FormHarian_model->add_catatan_snack($daftar_snack);
		}
		if($this->input->post('jenisSnack2')!=""){
			$daftar_snack = array(
				'Nama' => 'Snack 2',
				'Jenis' => $this->input->post('jenisSnack2'),
				'Waktu' => $this->input->post('waktuSnack2'),
				'Keterangan' => $this->input->post('keteranganSnack2'),
				'NoForm' => $noForm,
			);

			$this->FormHarian_model->add_catatan_snack($daftar_snack);
		}
		if($this->input->post('jenisSnack3')!=""){
			$daftar_snack = array(
				'Nama' => 'Snack 3',
				'Jenis' => $this->input->post('jenisSnack3'),
				'Waktu' => $this->input->post('waktuSnack3'),
				'Keterangan' => $this->input->post('keteranganSnack3'),
				'NoForm' => $noForm,
			);

			$this->FormHarian_model->add_catatan_snack($daftar_snack);
		}

		//tambah catatan minum susu
		if($this->input->post('waktuSusu1')!=""){
			$susu = array(
				'Waktu' => $this->input->post('waktuSusu1'),
				'CC' => $this->input->post('ccSusu1'),
				'Keterangan' => $this->input->post('keteranganSusu1'),
				'NoForm' => $noForm,
			);

			$this->FormHarian_model->add_catatan_minum_susu($susu);
		}
		if($this->input->post('waktuSusu2')!=""){
			$susu = array(
				'Waktu' => $this->input->post('waktuSusu2'),
				'CC' => $this->input->post('ccSusu2'),
				'Keterangan' => $this->input->post('keteranganSusu2'),
				'NoForm' => $noForm,
			);

			$this->FormHarian_model->add_catatan_minum_susu($susu);
		}
		if($this->input->post('waktuSusu3')!=""){
			$susu = array(
				'Waktu' => $this->input->post('waktuSusu3'),
				'CC' => $this->input->post('ccSusu3'),
				'Keterangan' => $this->input->post('keteranganSusu3'),
				'NoForm' => $noForm,
			);

			$this->FormHarian_model->add_catatan_minum_susu($susu);
		}
		if($this->input->post('waktuSusu4')!=""){
			$susu = array(
				'Waktu' => $this->input->post('waktuSusu4'),
				'CC' => $this->input->post('ccSusu4'),
				'Keterangan' => $this->input->post('keteranganSusu4'),
				'NoForm' => $noForm,
			);

			$this->FormHarian_model->add_catatan_minum_susu($susu);
		}
		if($this->input->post('waktuSusu5')!=""){
			$susu = array(
				'Waktu' => $this->input->post('waktuSusu5'),
				'CC' => $this->input->post('ccSusu5'),
				'Keterangan' => $this->input->post('keteranganSusu5'),
				'NoForm' => $noForm,
			);

			$this->FormHarian_model->add_catatan_minum_susu($susu);
		}

		//tambah catatan bab
		if($this->input->post('waktuBAB1')!=""){
			$bab = array(
				'Waktu' => $this->input->post('waktuBAB1'),
				'Keterangan' => $this->input->post('keteranganBAB1'),
				'NoForm' => $noForm,
			);

			$this->FormHarian_model->add_catatan_bab($bab);
		}
		if($this->input->post('waktuBAB2')!=""){
			$bab = array(
				'Waktu' => $this->input->post('waktuBAB2'),
				'Keterangan' => $this->input->post('keteranganBAB2'),
				'NoForm' => $noForm,
			);

			$this->FormHarian_model->add_catatan_bab($bab);
		}
		if($this->input->post('waktuBAB3')!=""){
			$bab = array(
				'Waktu' => $this->input->post('waktuBAB3'),
				'Keterangan' => $this->input->post('keteranganBAB3'),
				'NoForm' => $noForm,
			);

			$this->FormHarian_model->add_catatan_bab($bab);
		}

		//tambah catatan tidur
		if($this->input->post('mulaiTidur1')!=""){
			$tidur = array(
				'JamMulaiTidur' => $this->input->post('mulaiTidur1'),
				'JamBangun' => $this->input->post('bangunTidur1'),
				'NoForm' => $noForm,
			);

			$this->FormHarian_model->add_catatan_tidur($tidur);
		}
		if($this->input->post('mulaiTidur2')!=""){
			$tidur = array(
				'JamMulaiTidur' => $this->input->post('mulaiTidur2'),
				'JamBangun' => $this->input->post('bangunTidur2'),
				'NoForm' => $noForm,
			);

			$this->FormHarian_model->add_catatan_tidur($tidur);
		}
		if($this->input->post('mulaiTidur3')!=""){
			$tidur = array(
				'JamMulaiTidur' => $this->input->post('mulaiTidur3'),
				'JamBangun' => $this->input->post('bangunTidur3'),
				'NoForm' => $noForm,
			);

			$this->FormHarian_model->add_catatan_tidur($tidur);
		}

		//tambah barang harus dibawa
		foreach ($this->input->post('barang') as $key => $value) {
			$barang = array(
				'Nama' => $value,
				'Keterangan' =>'-',
				'NoForm' => $noForm,
			);

			$this->FormHarian_model->add_barang_harus_dibawa($barang);
		}

		if($this->input->post('barangLain')!=""){
			$barang = array(
				'Nama' => $this->input->post('barangLain'),
				'Keterangan' =>'-',
				'NoForm' => $noForm,
			);

			$this->FormHarian_model->add_barang_harus_dibawa($barang);
		}

		
		$this->session->set_userdata('message', 'Data Form Harian Berhasil Disimpan');


		header("Location: ".site_url('FormHarian/index'));
	}*/
}




