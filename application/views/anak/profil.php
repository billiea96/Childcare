<div class="">
  <div class="clearfix"></div>

  <?php if(isset($_SESSION['message'])) { ?>
  <div class="alert alert-success alert-dismissible fade in" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
    <strong><?php echo $_SESSION['message']; ?></strong>
  </div>
  <?php unset($_SESSION['message']); ?>
  <?php } ?>
  
  <?php if(isset($_SESSION['error'])) { ?>
  <div class="alert alert-danger alert-dismissible fade in" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
    <strong><?php echo $_SESSION['error']; ?></strong>
  </div>
  <?php unset($_SESSION['error']); ?>
  <?php } ?>

  <?php if(isset($_SESSION['notif_tagihan'])) { ?>
  <div class="alert alert-warning alert-dismissible fade in" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
    <strong><?php echo $_SESSION['notif_tagihan']; ?></strong>
  </div>
  <?php unset($_SESSION['notif_tagihan']); ?>
  <?php } ?>

  <!-- UNTUK MENGHITUNG USIA DAN MENAMPILKAN NOTIFIKASI -->
  <?php 
  function findAge($dob){
    $current_time = time();

    $age_years = date('Y',$current_time) - date('Y',$dob);
    $age_months = date('m',$current_time) - date('m',$dob);
    $age_days = date('d',$current_time) - date('d',$dob);

    if ($age_days<0) {
        $days_in_month = date('t',$current_time);
        $age_months--;
        $age_days= $days_in_month+$age_days;
    }

    if ($age_months<0) {
        $age_years--;
        $age_months = 12+$age_months;
    }

    if($age_years>0){
      if($age_months>0)
        return "$age_years tahun $age_months bulan";    
      else
        return "$age_years tahun";
    }else
      return "$age_months bulan"; 
    
  }
  function findMonth($dob){
    $birthday = new DateTime($dob);
    
    $diff = $birthday->diff(new DateTime());
    $months = $diff->format('%m') + 12 * $diff->format('%y');
    return $months;
  }
  if(findMonth($anak['TanggalLahir'])==1||findMonth($anak['TanggalLahir'])==2||findMonth($anak['TanggalLahir'])==4||findMonth($anak['TanggalLahir'])==6||findMonth($anak['TanggalLahir'])==9||findMonth($anak['TanggalLahir'])==12||findMonth($anak['TanggalLahir'])==15||findMonth($anak['TanggalLahir'])==18||findMonth($anak['TanggalLahir'])==24||findMonth($anak['TanggalLahir'])==36||findMonth($anak['TanggalLahir'])==48||findMonth($anak['TanggalLahir'])==60) { ?>
    <div class="alert alert-warning alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
      <strong><?php echo $anak["Panggilan"].' sudah berusia '.findAge(strtotime($anak['TanggalLahir'])).' waktunya imunisasi'; ?></strong>
    </div>
  <?php } ?>

  <div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Data Pribadi</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="table-responsive col-sm-12">          
            <table class="table">
                <tr>
                  <th style="border: none;" class="col-sm-3">ID</th>
                  <td style="border: none;"><?php echo $anak['Id']; ?></td>
                  <td style="border: none;" rowspan="8" width="35%">
                  <?php if($anak['Foto']!=null){ ?>
                    <?php if(file_exists("./public/foto_anak/".$anak['Foto'])){ ?>
                      <img height="40%" class="img-responsive img-rounded" width="70%" src="<?php echo base_url(); ?>public/foto_anak/<?php echo $anak['Foto']; ?>">
                    <?php }else{?>
                      <img height="40%" class="img-responsive img-rounded" width="70%" src="<?php echo base_url(); ?>public/image/anak_def.jpg">
                    <?php }?>
                  <?php }else{?>
                    <img height="40%" class="img-responsive img-rounded" width="70%" src="<?php echo base_url(); ?>public/image/anak_def.jpg">
                  <?php }?>
                  </td>
                </tr>
                <tr>
                  <th style="border: none;" class="col-sm-3">Nama Lengkap</th>
                  <td style="border: none;"><?php echo $anak['Nama']; ?></td>
                </tr>
                <tr>
                  <th style="border: none;" class="col-sm-3">Nama Panggilan</th>
                  <td style="border: none;"><?php echo $anak['Panggilan']; ?></td>
                </tr>
                <tr>
                  <th style="border: none;" class="col-sm-3">Tanggal Lahir</th>
                  <td style="border: none;"><?php echo DateTime::createFromFormat('Y-m-d', $anak['TanggalLahir'])->format('d M Y'); ?></td>
                </tr>
                <tr>
                  <th style="border: none;" class="col-sm-3">Jenis Kelamin</th>
                  <td style="border: none;"><?php if($anak['Kelamin']=='L') echo "Laki-laki"; else echo "Perempuan"; ?></td>
                </tr>
                <tr>
                  <th style="border: none;" class="col-sm-3">Alergi</th>
                  <td style="border: none;"><?php echo $anak['Alergi']; ?></td>
                </tr>
                <tr>
                  <th style="border: none;" class="col-sm-3">Dokter Pribadi</th>
                  <td style="border: none;"><?php echo $anak['Dokter']; ?></td>
                </tr>
                <tr>
                  <th style="border: none;" class="col-sm-3">No Telp Dokter</th>
                  <td style="border: none;"><?php echo $anak['NoTelpDokter']; ?></td>
                </tr>
                
            </table>
          </div>

          <div class="clearfix"></div>
          <div class="ln_solid"></div>
        </div>

        <div class="x_title">
          <h2>Data Orang Tua</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="table-responsive col-sm-12">          
              <table class="table">
                  <tr>
                    <th style="border: none;" class="col-sm-3">Nama Ayah</th>
                    <td style="border: none;" class="col-sm-3"><?php echo $orangtua['NamaAyah']; ?></td>
                    <th style="border: none;" class="col-sm-3">Nama Ibu</th>
                    <td style="border: none;" class="col-sm-3"><?php echo $orangtua['NamaIbu']; ?></td>
                  </tr>
                  <tr>
                    <th style="border: none;" class="col-sm-3">Alamat</th>
                    <td style="border: none;" class="col-sm-3"><?php echo $orangtua['AlamatRumahAyah']; ?></td>
                    <th style="border: none;" class="col-sm-3">Alamat</th>
                    <td style="border: none;" class="col-sm-3"><?php echo $orangtua['AlamatRumahIbu']; ?></td>
                  </tr>
                  <tr>
                    <th style="border: none;" class="col-sm-3">No HP</th>
                    <td style="border: none;" class="col-sm-3"><?php echo $orangtua['NoHPAyah']; ?></td>
                    <th style="border: none;" class="col-sm-3">No HP</th>
                    <td style="border: none;" class="col-sm-3"><?php echo $orangtua['NoHPIbu']; ?></td>
                  </tr>
                  <tr>
                    <th style="border: none;" class="col-sm-3">No Telp</th>
                    <td style="border: none;" class="col-sm-3"><?php echo $orangtua['NoTelpRumahAyah']; ?></td>
                    <th style="border: none;" class="col-sm-3">No Telp</th>
                    <td style="border: none;" class="col-sm-3"><?php echo $orangtua['NoTelpRumahIbu']; ?></td>
                  </tr>
                  <tr>
                    <th style="border: none;" class="col-sm-3">Tempat Kerja</th>
                    <td style="border: none;" class="col-sm-3"><?php echo $orangtua['AlamatKerjaAyah']; ?></td>
                    <th style="border: none;" class="col-sm-3">Tempat Kerja</th>
                    <td style="border: none;" class="col-sm-3"><?php echo $orangtua['AlamatKerjaIbu']; ?></td>
                  </tr>
                  <tr>
                    <th style="border: none;" class="col-sm-3">No Tempat Kerja</th>
                    <td style="border: none;" class="col-sm-3"><?php echo $orangtua['NoTempatKerjaAyah']; ?></td>
                    <th style="border: none;" class="col-sm-3">No Tempat Kerja</th>
                    <td style="border: none;" class="col-sm-3"><?php echo $orangtua['NoTempatKerjaIbu']; ?></td>
                  </tr>
                  <tr>
                    <th style="border: none;" class="col-sm-3">Lama Jam Kerja</th>
                    <td style="border: none;" class="col-sm-3"><?php echo $orangtua['JamKerjaAyah']; ?></td>
                    <th style="border: none;" class="col-sm-3">Lama Jam Kerja</th>
                    <td style="border: none;" class="col-sm-3"><?php echo $orangtua['JamKerjaIbu']; ?></td>
                  </tr>
                  
              </table>
            </div>
            
            <div class="clearfix"></div>
            <div class="ln_solid"></div>

        </div>

        <div class="x_title">
          <h2>Data Orang Lain</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="table-responsive col-sm-12">          
              <table class="table">
                  <tr>
                    <th style="border: none;" class="col-sm-3">Nama</th>
                    <td style="border: none;" class="col-sm-3"><?php echo $data_pendaftaran[20]['Jawaban']; ?></td>
                    <th style="border: none;" class="col-sm-3">Nama</th>
                    <td style="border: none;" class="col-sm-3"><?php echo $data_pendaftaran[21]['Jawaban']; ?></td>
                  </tr>
                  <tr>
                    <th style="border: none;" class="col-sm-3">Hubungan</th>
                    <td style="border: none;" class="col-sm-3"><?php echo $data_pendaftaran[22]['Jawaban']; ?></td>
                    <th style="border: none;" class="col-sm-3">Hubungan</th>
                    <td style="border: none;" class="col-sm-3"><?php echo $data_pendaftaran[23]['Jawaban']; ?></td>
                  </tr>
                  <tr>
                    <th style="border: none;" class="col-sm-3">No Telp Rumah</th>
                    <td style="border: none;" class="col-sm-3"><?php echo $data_pendaftaran[24]['Jawaban']; ?></td>
                    <th style="border: none;" class="col-sm-3">No Telp Rumah</th>
                    <td style="border: none;" class="col-sm-3"><?php echo $data_pendaftaran[25]['Jawaban']; ?></td>
                  </tr>
                  <tr>
                    <th style="border: none;" class="col-sm-3">No HP</th>
                    <td style="border: none;" class="col-sm-3"><?php echo $data_pendaftaran[26]['Jawaban']; ?></td>
                    <th style="border: none;" class="col-sm-3">No HP</th>
                    <td style="border: none;" class="col-sm-3"><?php echo $data_pendaftaran[27]['Jawaban']; ?></td>
                  </tr>
                  <tr>
                    <th style="border: none;" class="col-sm-3">No Tempat Kerja</th>
                    <td style="border: none;" class="col-sm-3"><?php echo $data_pendaftaran[28]['Jawaban']; ?></td>
                    <th style="border: none;" class="col-sm-3">No Tempat Kerja</th>
                    <td style="border: none;" class="col-sm-3"><?php echo $data_pendaftaran[29]['Jawaban']; ?></td>
                  </tr>
              </table>
            </div>
          
            <div class="clearfix"></div>
            <div class="ln_solid"></div>

        </div>


        <div class="x_content">
            <div class="table-responsive col-sm-12">          
              <table class="table">
                  <tr>
                    <th style="border: none;" class="col-sm-3">Nama</th>
                    <td style="border: none;" class="col-sm-3"><?php echo $data_pendaftaran[30]['Jawaban']; ?></td>
                    <th style="border: none;" class="col-sm-3">No HP & Telp</th>
                    <td style="border: none;" class="col-sm-3"><?php echo $data_pendaftaran[33]['Jawaban']; ?></td>
                  </tr>
                  <tr>
                    <th style="border: none;" class="col-sm-3">Nama</th>
                    <td style="border: none;" class="col-sm-3"><?php echo $data_pendaftaran[31]['Jawaban']; ?></td>
                    <th style="border: none;" class="col-sm-3">No HP & Telp</th>
                    <td style="border: none;" class="col-sm-3"><?php echo $data_pendaftaran[34]['Jawaban']; ?></td>
                  </tr>
                  <tr>
                    <th style="border: none;" class="col-sm-3">Nama</th>
                    <td style="border: none;" class="col-sm-3"><?php echo $data_pendaftaran[32]['Jawaban']; ?></td>
                    <th style="border: none;" class="col-sm-3">No HP & Telp</th>
                    <td style="border: none;" class="col-sm-3"><?php echo $data_pendaftaran[35]['Jawaban']; ?></td>
                  </tr>
              </table>
            </div>
          
            <div class="clearfix"></div>
            <div class="ln_solid"></div>
        </div>


        <div class="x_title">
          <h2>Data Saudara Kandung</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="table-responsive col-sm-12">          
              <table class="table">
                  <tr>
                    <th style="border: none;" class="col-sm-3">Nama</th>
                    <td style="border: none;" class="col-sm-3"><?php echo $data_pendaftaran[36]['Jawaban']; ?></td>
                    <th style="border: none;" class="col-sm-3">Tanggal Lahir</th>
                    <td style="border: none;" class="col-sm-3"><?php echo $data_pendaftaran[39]['Jawaban']; ?></td>
                  </tr>
                  <tr>
                    <th style="border: none;" class="col-sm-3">Nama</th>
                    <td style="border: none;" class="col-sm-3"><?php echo $data_pendaftaran[37]['Jawaban']; ?></td>
                    <th style="border: none;" class="col-sm-3">Tanggal Lahir</th>
                    <td style="border: none;" class="col-sm-3"><?php echo $data_pendaftaran[40]['Jawaban']; ?></td>
                  </tr>
                  <tr>
                    <th style="border: none;" class="col-sm-3">Nama</th>
                    <td style="border: none;" class="col-sm-3"><?php echo $data_pendaftaran[38]['Jawaban']; ?></td>
                    <th style="border: none;" class="col-sm-3">Tanggal Lahir</th>
                    <td style="border: none;" class="col-sm-3"><?php echo $data_pendaftaran[41]['Jawaban']; ?></td>
                  </tr>
              </table>
            </div>
          
            <div class="clearfix"></div>
            <div class="ln_solid"></div>
              
        </div>

        <div class="x_title">
          <h2>Data Mengenai ASI, Susu, dan Makanan</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="table-responsive col-sm-12">          
            <table class="table">
                <tr>
                  <th style="border: none;" class="col-md-3">Mengkonsumsi ASI</th>
                  <td style="border: none;"><?php echo $data_pendaftaran[42]['Jawaban']; ?></td>
                </tr>
                <tr>
                  <th style="border: none;" class="col-md-3">Lanjut ASI</th>
                  <td style="border: none;"><?php echo $data_pendaftaran[43]['Jawaban']; ?></td>
                </tr>
                <tr>
                  <th style="border: none;" class="col-md-3">Rencana</th>
                  <td style="border: none;"><?php echo $data_pendaftaran[44]['Jawaban']; ?></td>
                </tr>
                <tr>
                  <th style="border: none;" class="col-md-3">Jadwal Pemberian</th>
                  <td style="border: none;"><?php echo $data_pendaftaran[45]['Jawaban']; ?></td>
                </tr>
                <tr>
                  <th style="border: none;" class="col-md-3">Suplemen</th>
                  <td style="border: none;"><?php echo $data_pendaftaran[46]['Jawaban']; ?></td>
                </tr>
                <tr>
                  <th style="border: none;" class="col-md-3">Menggunakan Botol</th>
                  <td style="border: none;"><?php echo $data_pendaftaran[47]['Jawaban']; ?></td>
                </tr>
                <tr>
                  <th rowspan="4" style="border: none; vertical-align: middle;" class="col-md-3">Jadwal Pemberian</th>
                </tr>
                <tr>
                  <th style="border: none;" class="col-md-3">Susu Formula</th>
                  <td style="border: none;"><?php echo $data_pendaftaran[49]['Jawaban']; ?></td>
                </tr>
                <tr>
                  <th style="border: none;" class="col-md-3">Susu Murni</th>
                  <td style="border: none;"><?php echo $data_pendaftaran[50]['Jawaban']; ?></td>
                </tr>
                <tr>
                  <th style="border: none;" class="col-md-3">Air</th>
                  <td style="border: none;"><?php echo $data_pendaftaran[51]['Jawaban']; ?></td>
                </tr>
                <tr>
                  <th style="border: none;" class="col-md-3">Posisi Makan</th>
                  <td style="border: none;"><?php echo $data_pendaftaran[52]['Jawaban']; ?></td>
                </tr>
                <tr>
                  <th style="border: none;" class="col-md-3">Posisi yang disukai saat sendawa</th>
                  <td style="border: none;"><?php echo $data_pendaftaran[53]['Jawaban']; ?></td>
                </tr>
                <tr>
                  <th style="border: none;" class="col-md-3">Telah mengenal makanan padat</th>
                  <td style="border: none;"><?php echo $data_pendaftaran[54]['Jawaban']; ?></td>
                </tr>
                <?php if($data_pendaftaran[54]['Jawaban']=="Ya"){ ?>
                <tr>
                  <th style="border: none;" class="col-md-3">Jenis makan padat</th>
                  <td style="border: none;"><?php echo $data_pendaftaran[55]['Jawaban']; ?></td>
                </tr>
                <?php } ?>
                <tr>
                  <th style="border: none;" class="col-md-3">Jadwal pemberian makan :</th>
                </tr>
            </table>
          </div>
          <div class="clearfix"></div>
          <div class="table-responsive col-sm-12">          
            <table class="table">
                <tr>
                  <th style="border: 1px solid;" class="col-md-2"></th>
                  <th style="border: 1px solid;" class="col-md-3">Merek</th>
                  <th style="border: 1px solid;" class="col-md-3">Kepadatan</th>
                  <th style="border: 1px solid;" class="col-md-2">Jumlah</th>
                  <th style="border: 1px solid;" class="col-md-2">Waktu</th>
                </tr>
                <tr>
                  <th rowspan="4" style="border: 1px solid; vertical-align: middle;" class="col-md-2">Cereal</th>
                </tr>
                <?php if($data_pendaftaran[57]['Jawaban']!='-'){ ?>
                <tr>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[57]['Jawaban'])[0]; ?></td>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[57]['Jawaban'])[1]; ?></td>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[57]['Jawaban'])[2]; ?></td>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[57]['Jawaban'])[3]; ?></td>
                </tr>
                <?php }else { ?>
                <tr>
                  <td style="border: 1px solid;"><?php echo '-'; ?></td>
                  <td style="border: 1px solid;"><?php echo '-'; ?></td>
                  <td style="border: 1px solid;"><?php echo '-'; ?></td>
                  <td style="border: 1px solid;"><?php echo '-'; ?></td>
                </tr>
                <?php } ?>
                <?php if($data_pendaftaran[58]['Jawaban']!='-'){ ?>
                <tr>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[58]['Jawaban'])[0]; ?></td>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[58]['Jawaban'])[1]; ?></td>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[58]['Jawaban'])[2]; ?></td>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[58]['Jawaban'])[3]; ?></td>
                </tr>
                <?php }else { ?>
                <tr>
                  <td style="border: 1px solid;">-</td>
                  <td style="border: 1px solid;">-</td>
                  <td style="border: 1px solid;">-</td>
                  <td style="border: 1px solid;">-</td>
                </tr>
                <?php } ?>
                <?php if($data_pendaftaran[59]['Jawaban']!='-'){ ?>
                <tr>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[59]['Jawaban'])[0]; ?></td>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[59]['Jawaban'])[1]; ?></td>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[59]['Jawaban'])[2]; ?></td>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[59]['Jawaban'])[3]; ?></td>
                </tr>
                <?php }else { ?>
                <tr>
                  <td style="border: 1px solid;">-</td>
                  <td style="border: 1px solid;">-</td>
                  <td style="border: 1px solid;">-</td>
                  <td style="border: 1px solid;">-</td>
                </tr>
                <?php } ?>

                <tr>
                  <th rowspan="5" style="border: 1px solid; vertical-align: middle;" class="col-md-2">Sayuran</th>
                </tr>
                <?php if($data_pendaftaran[60]['Jawaban']!='-'){ ?>
                <tr>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[60]['Jawaban'])[0]; ?></td>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[60]['Jawaban'])[1]; ?></td>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[60]['Jawaban'])[2]; ?></td>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[60]['Jawaban'])[3]; ?></td>
                </tr>
                <?php }else { ?>
                <tr>
                  <td style="border: 1px solid;"><?php echo '-'; ?></td>
                  <td style="border: 1px solid;"><?php echo '-'; ?></td>
                  <td style="border: 1px solid;"><?php echo '-'; ?></td>
                  <td style="border: 1px solid;"><?php echo '-'; ?></td>
                </tr>
                <?php } ?>
                <?php if($data_pendaftaran[61]['Jawaban']!='-'){ ?>
                <tr>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[61]['Jawaban'])[0]; ?></td>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[61]['Jawaban'])[1]; ?></td>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[61]['Jawaban'])[2]; ?></td>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[61]['Jawaban'])[3]; ?></td>
                </tr>
                <?php }else { ?>
                <tr>
                  <td style="border: 1px solid;">-</td>
                  <td style="border: 1px solid;">-</td>
                  <td style="border: 1px solid;">-</td>
                  <td style="border: 1px solid;">-</td>
                </tr>
                <?php } ?>
                <?php if($data_pendaftaran[62]['Jawaban']!='-'){ ?>
                <tr>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[62]['Jawaban'])[0]; ?></td>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[62]['Jawaban'])[1]; ?></td>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[62]['Jawaban'])[2]; ?></td>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[62]['Jawaban'])[3]; ?></td>
                </tr>
                <?php }else { ?>
                <tr>
                  <td style="border: 1px solid;">-</td>
                  <td style="border: 1px solid;">-</td>
                  <td style="border: 1px solid;">-</td>
                  <td style="border: 1px solid;">-</td>
                </tr>
                <?php } ?>
                <?php if($data_pendaftaran[63]['Jawaban']!='-'){ ?>
                <tr>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[63]['Jawaban'])[0]; ?></td>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[63]['Jawaban'])[1]; ?></td>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[63]['Jawaban'])[2]; ?></td>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[63]['Jawaban'])[3]; ?></td>
                </tr>
                <?php }else { ?>
                <tr>
                  <td style="border: 1px solid;">-</td>
                  <td style="border: 1px solid;">-</td>
                  <td style="border: 1px solid;">-</td>
                  <td style="border: 1px solid;">-</td>
                </tr>
                <?php } ?>

                <tr>
                  <th rowspan="5" style="border: 1px solid; vertical-align: middle;" class="col-md-2">Buah</th>
                </tr>
                <?php if($data_pendaftaran[64]['Jawaban']!='-'){ ?>
                <tr>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[64]['Jawaban'])[0]; ?></td>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[64]['Jawaban'])[1]; ?></td>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[64]['Jawaban'])[2]; ?></td>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[64]['Jawaban'])[3]; ?></td>
                </tr>
                <?php }else { ?>
                <tr>
                  <td style="border: 1px solid;"><?php echo '-'; ?></td>
                  <td style="border: 1px solid;"><?php echo '-'; ?></td>
                  <td style="border: 1px solid;"><?php echo '-'; ?></td>
                  <td style="border: 1px solid;"><?php echo '-'; ?></td>
                </tr>
                <?php } ?>
                <?php if($data_pendaftaran[65]['Jawaban']!='-'){ ?>
                <tr>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[65]['Jawaban'])[0]; ?></td>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[65]['Jawaban'])[1]; ?></td>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[65]['Jawaban'])[2]; ?></td>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[65]['Jawaban'])[3]; ?></td>
                </tr>
                <?php }else { ?>
                <tr>
                  <td style="border: 1px solid;">-</td>
                  <td style="border: 1px solid;">-</td>
                  <td style="border: 1px solid;">-</td>
                  <td style="border: 1px solid;">-</td>
                </tr>
                <?php } ?>
                <?php if($data_pendaftaran[66]['Jawaban']!='-'){ ?>
                <tr>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[66]['Jawaban'])[0]; ?></td>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[66]['Jawaban'])[1]; ?></td>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[66]['Jawaban'])[2]; ?></td>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[66]['Jawaban'])[3]; ?></td>
                </tr>
                <?php }else { ?>
                <tr>
                  <td style="border: 1px solid;">-</td>
                  <td style="border: 1px solid;">-</td>
                  <td style="border: 1px solid;">-</td>
                  <td style="border: 1px solid;">-</td>
                </tr>
                <?php } ?>
                <?php if($data_pendaftaran[67]['Jawaban']!='-'){ ?>
                <tr>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[67]['Jawaban'])[0]; ?></td>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[67]['Jawaban'])[1]; ?></td>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[67]['Jawaban'])[2]; ?></td>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[67]['Jawaban'])[3]; ?></td>
                </tr>
                <?php }else { ?>
                <tr>
                  <td style="border: 1px solid;">-</td>
                  <td style="border: 1px solid;">-</td>
                  <td style="border: 1px solid;">-</td>
                  <td style="border: 1px solid;">-</td>
                </tr>
                <?php } ?>

                <tr>
                  <th rowspan="3" style="border: 1px solid; vertical-align: middle;" class="col-md-2">Daging</th>
                </tr>
                <?php if($data_pendaftaran[68]['Jawaban']!='-'){ ?>
                <tr>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[68]['Jawaban'])[0]; ?></td>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[68]['Jawaban'])[1]; ?></td>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[68]['Jawaban'])[2]; ?></td>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[68]['Jawaban'])[3]; ?></td>
                </tr>
                <?php }else { ?>
                <tr>
                  <td style="border: 1px solid;"><?php echo '-'; ?></td>
                  <td style="border: 1px solid;"><?php echo '-'; ?></td>
                  <td style="border: 1px solid;"><?php echo '-'; ?></td>
                  <td style="border: 1px solid;"><?php echo '-'; ?></td>
                </tr>
                <?php } ?>
                <?php if($data_pendaftaran[69]['Jawaban']!='-'){ ?>
                <tr>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[69]['Jawaban'])[0]; ?></td>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[69]['Jawaban'])[1]; ?></td>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[69]['Jawaban'])[2]; ?></td>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[69]['Jawaban'])[3]; ?></td>
                </tr>
                <?php }else { ?>
                <tr>
                  <td style="border: 1px solid;">-</td>
                  <td style="border: 1px solid;">-</td>
                  <td style="border: 1px solid;">-</td>
                  <td style="border: 1px solid;">-</td>
                </tr>
                <?php } ?>

                <tr>
                  <th rowspan="3" style="border: 1px solid; vertical-align: middle;" class="col-md-2">Snack</th>
                </tr>
                <?php if($data_pendaftaran[70]['Jawaban']!='-'){ ?>
                <tr>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[70]['Jawaban'])[0]; ?></td>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[70]['Jawaban'])[1]; ?></td>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[70]['Jawaban'])[2]; ?></td>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[70]['Jawaban'])[3]; ?></td>
                </tr>
                <?php }else { ?>
                <tr>
                  <td style="border: 1px solid;"><?php echo '-'; ?></td>
                  <td style="border: 1px solid;"><?php echo '-'; ?></td>
                  <td style="border: 1px solid;"><?php echo '-'; ?></td>
                  <td style="border: 1px solid;"><?php echo '-'; ?></td>
                </tr>
                <?php } ?>
                <?php if($data_pendaftaran[71]['Jawaban']!='-'){ ?>
                <tr>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[71]['Jawaban'])[0]; ?></td>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[71]['Jawaban'])[1]; ?></td>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[71]['Jawaban'])[2]; ?></td>
                  <td style="border: 1px solid;"><?php echo explode(',',$data_pendaftaran[71]['Jawaban'])[3]; ?></td>
                </tr>
                <?php }else { ?>
                <tr>
                  <td style="border: 1px solid;">-</td>
                  <td style="border: 1px solid;">-</td>
                  <td style="border: 1px solid;">-</td>
                  <td style="border: 1px solid;">-</td>
                </tr>
                <?php } ?>
            </table>
          </div> 

          <div class="table-responsive col-sm-12">          
            <table class="table">
                <tr>
                  <th style="border: none;" class="col-md-3">Alegi</th>
                  <td style="border: none;"><?php echo $data_pendaftaran[73]['Jawaban']; ?></td>
                </tr>
                <tr>
                  <th style="border: none;" class="col-md-3">Makanan yang disukai/tidak disukai</th>
                  <td style="border: none;"><?php echo $data_pendaftaran[74]['Jawaban']; ?></td>
                </tr>
            </table>
          </div>

          <data class="clearfix"></data>
          <div class="ln_solid"></div>
        </div>

        <div class="x_title">
          <h2>Data Mengenai Tidur Dan Pemakaian Popok Anak</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="table-responsive col-sm-12">          
            <table class="table">
                <tr>
                  <th style="border: none;" class="col-md-3">Pola tidur anak</th>
                  <td style="border: none;"><?php echo $data_pendaftaran[75]['Jawaban']; ?></td>
                </tr>
                <tr>
                  <th style="border: none;" class="col-md-3">Menangis saat tidur</th>
                  <td style="border: none;"><?php echo $data_pendaftaran[76]['Jawaban'].', '.$data_pendaftaran[77]['Jawaban']; ?></td>
                </tr>
                <tr>
                  <th style="border: none;" class="col-md-3">Tempat tidur</th>
                  <td style="border: none;"><?php echo $data_pendaftaran[78]['Jawaban']; ?></td>
                </tr>
                <tr>
                  <th style="border: none;" class="col-md-3">Merek popok</th>
                  <td style="border: none;"><?php echo $data_pendaftaran[79]['Jawaban']; ?></td>
                </tr>
                <tr>
                  <th style="border: none;" class="col-md-3">Cara pemakaian popok</th>
                  <td style="border: none;"><?php echo $data_pendaftaran[80]['Jawaban']; ?></td>
                </tr>
                <tr>
                  <th style="border: none;" class="col-md-3">Rentan luka karena popok</th>
                  <td style="border: none;"><?php echo $data_pendaftaran[81]['Jawaban']; ?></td>
                </tr>
                <tr>
                  <th style="border: none;" class="col-md-3">Perawatan</th>
                  <td style="border: none;"><?php echo $data_pendaftaran[82]['Jawaban']; ?></td>
                </tr>
            </table>
          </div>
        </div>
        <data class="clearfix"></data>
        <div class="ln_solid"></div>

        <div class="x_title">
          <h2>Data Mengenai Perkembangan Sosial/Emosional</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="table-responsive col-sm-12">          
            <table class="table">
                <tr>
                  <th style="border: none;" class="col-md-3">Karakter</th>
                  <td style="border: none;"><?php echo $data_pendaftaran[83]['Jawaban']; ?></td>
                </tr>
                <tr>
                  <th style="border: none;" class="col-md-3">Tanda ketika lapar, lelah, dan terlalu bersemangat</th>
                  <td style="border: none;"><?php echo $data_pendaftaran[84]['Jawaban']; ?></td>
                </tr>
                <tr>
                  <th style="border: none;" class="col-md-3">Terbiasa terpisah dengan orang tua</th>
                  <td style="border: none;"><?php echo $data_pendaftaran[85]['Jawaban']; ?></td>
                </tr>
                <tr>
                  <th style="border: none;" class="col-md-3">Hal yang ditakuti</th>
                  <td style="border: none;"><?php echo $data_pendaftaran[86]['Jawaban']; ?></td>
                </tr>
                <tr>
                  <th style="border: none;" class="col-md-3">Benda favorit</th>
                  <td style="border: none;"><?php echo $data_pendaftaran[87]['Jawaban']; ?></td>
                </tr>
                <tr>
                  <th style="border: none;" class="col-md-3">Sering menghabiskan waktu dengan anak lain</th>
                  <td style="border: none;"><?php echo $data_pendaftaran[88]['Jawaban'].', '.$data_pendaftaran[89]['Jawaban']; ?></td>
                </tr>
                <tr>
                  <th style="border: none;" class="col-md-3">Aktifitas favorit</th>
                  <td style="border: none;"><?php echo $data_pendaftaran[90]['Jawaban']; ?></td>
                </tr>
                <tr>
                  <th style="border: none;" class="col-md-3">Pernah dititipkan</th>
                  <td style="border: none;"><?php echo $data_pendaftaran[91]['Jawaban'].', '.$data_pendaftaran[92]['Jawaban']; ?></td>
                </tr>
            </table>
          </div>
        </div>
        <data class="clearfix"></data>
        <div class="ln_solid"></div>

        <div class="x_title">
          <h2>Data Berkaitan Dengan Kesehatan Anak</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="table-responsive col-sm-12">          
            <table class="table">
                <tr>
                  <th style="border: none;" class="col-md-3">Rutin imunisasi</th>
                  <td style="border: none;"><?php echo $data_pendaftaran[93]['Jawaban'].', '.$data_pendaftaran[94]['Jawaban']; ?></td>
                </tr>
                <tr>
                  <th style="border: none;" class="col-md-3">Riwayat penyakit </th>
                  <td style="border: none;"><?php echo $data_pendaftaran[96]['Jawaban']; ?></td>
                </tr>
                <tr>
                  <th style="border: none;" class="col-md-3">Riwayat kecelakaan dan luka </th>
                  <td style="border: none;"><?php echo $data_pendaftaran[97]['Jawaban']; ?></td>
                </tr>
                <tr>
                  <th style="border: none;" class="col-md-3">Alergi </th>
                  <td style="border: none;"><?php echo $data_pendaftaran[99]['Jawaban']; ?></td>
                </tr>
                <tr>
                  <th style="border: none;" class="col-md-3">Menggunakan obat tertentu </th>
                  <td style="border: none;"><?php echo $data_pendaftaran[100]['Jawaban']; ?></td>
                </tr>
                <tr>
                  <th style="border: none;" class="col-md-3">Nama obat dan kondisi harus diberikan </th>
                  <td style="border: none;"><?php echo $data_pendaftaran[101]['Jawaban']; ?></td>
                </tr>
                <tr>
                  <th style="border: none;" class="col-md-3">Nama obat dan kondisi harus diberikan </th>
                  <td style="border: none;"><?php echo $data_pendaftaran[101]['Jawaban']; ?></td>
                </tr>
                <tr>
                  <th style="border: none;" class="col-md-3">Kekuatiran akan perkembangan </th>
                  <td style="border: none;"><?php echo $data_pendaftaran[103]['Jawaban']; ?></td>
                </tr>
                <tr>
                  <th style="border: none;" class="col-md-3">Catatan kesehatan </th>
                  <td style="border: none;"><?php echo $data_pendaftaran[104]['Jawaban']; ?></td>
                </tr>
                
            </table>
          </div>
        </div>
        <data class="clearfix"></data>
        <div class="ln_solid"></div>
      </div>
      <!-- end div panel -->
    </div>
  </div>
</div>

<script type="text/javascript">
  
</script>