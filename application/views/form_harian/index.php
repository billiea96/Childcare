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

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Form Harian</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <?php echo validation_errors(); ?>
          <form class="form-horizontal form-label-left" id="form_catatan_harian" action="<?php echo site_url('FormHarian/add') ?>" method="POST">
            <h4 style="text-align: right;"><strong><?php echo date('D, d-m-Y'); ?></strong></h4>
            <div class="item form-group">
              <label class="control-label col-sm-4" for="noHP">Nama <span class="required">*</span>
              </label>
              <div class="col-md-3">
                <select class="form-control select2" id="anak" name="anak" required="">
                  <option></option>
                  <?php foreach($anak as $value): ?>
                    <option value="<?php echo $value['Id']; ?>"><?php echo $value['Nama']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-sm-4" for="noHP">Suhu Badan Datang <span class="required">*</span>
              </label>
              <div class="col-md-2">
                <input type="text" class="form-control" name="suhuBadanDatang" id="suhuBadanDatang">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-sm-4" for="keterangan">Catatan Khusus dari orang tua (misal : makan/tidur terakhir di rumah atau kejadian penting di rumah) </span>
              </label>
              <div class="col-md-5">
                <textarea rows="4" id="catatanKhususOrangtua" name="catatanKhususOrangtua" class="form-control"></textarea>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-sm-4" for="keterangan">Kondisi kesehatan anak (catatan dari orangtua) </span>
              </label>
              <div class="col-md-5">
                <textarea rows="4" id="kondisiKesehatan" name="kondisiKesehatan" class="form-control"></textarea>
              </div>
            </div>

            <div class="ln_solid"></div>
            <!-- <div class="form-group">
              <div class="col-md-4 col-md-offset-7">
                <button id="simpan" type="submit" class="btn btn-success">simpan</button>
              </div>
            </div> -->
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- end row -->
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Daftar Obat/ Vitamin</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <?php echo validation_errors(); ?>
          <form class="form-horizontal form-label-left">
            <div class="table-responsive col-sm-12">          
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="col-sm-3">Nama obat / Vitamin</th>
                    <th class="col-sm-1">Dosis</th>
                    <th class="col-sm-2">Jadwal minum</th>
                    <th class="col-sm-2">Waktu Pemberian</th>
                    <th class="col-sm-2">Pemberi</th>
                    <th class="col-sm-2">Penanggung Jawab</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- baris 1 -->
                  <tr>
                      <td  rowspan ="2" style="vertical-align: middle;"><input type="text" form="form_catatan_harian" class="form-control" name="namaObat1" id="namaObat1"></td>
                      <td rowspan ="2" style="vertical-align: middle;"><input type="text" form="form_catatan_harian" class="form-control" name="dosis1" id="dosis1"></td>
                      <td><input type="text" form="form_catatan_harian" class="form-control" name="jadwalMinum11" id="jadwalMinum11"></td>
                      <td><input type="text" form="form_catatan_harian" class="form-control" name="waktuPemberian11" id="waktuPemberian11"></td>
                      <td>
                        <select form="form_catatan_harian" class="form-control select2" id="pemberi11" name="pemberi11">
                          <option></option>
                          <?php foreach($karyawan as $value): ?>
                            <option value="<?php echo $value['Id']; ?>"><?php echo $value['Nama']; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </td>
                      <td>
                        <select form="form_catatan_harian" class="form-control select2" id="penanggungJawab11" name="penanggungJawab11">
                          <option></option>
                          <?php foreach($karyawan as $value): ?>
                            <option value="<?php echo $value['Id']; ?>"><?php echo $value['Nama']; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </td>
                  </tr>
                  <tr>
                      <td><input type="text" form="form_catatan_harian" class="form-control" name="jadwalMinum12" id="jadwalMinum12"></td>
                      <td><input type="text" form="form_catatan_harian" class="form-control" name="waktuPemberian12" id="waktuPemberian12"></td>
                      <td>
                        <select form="form_catatan_harian" class="form-control select2" id="pemberi12" name="pemberi12">
                          <option></option>
                          <?php foreach($karyawan as $value): ?>
                            <option value="<?php echo $value['Id']; ?>"><?php echo $value['Nama']; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </td>
                      <td>
                        <select form="form_catatan_harian" class="form-control select2" id="penanggungJawab12" name="penanggungJawab12">
                          <option></option>
                          <?php foreach($karyawan as $value): ?>
                            <option value="<?php echo $value['Id']; ?>"><?php echo $value['Nama']; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </td>
                  </tr>
                  <!-- akhir baris 1 -->

                  <!-- baris 2 -->
                  <tr>
                      <td  rowspan ="2" style="vertical-align: middle;"><input type="text" form="form_catatan_harian" class="form-control" name="namaObat2" id="namaObat2"></td>
                      <td rowspan ="2" style="vertical-align: middle;"><input type="text" form="form_catatan_harian" class="form-control" name="dosis2" id="dosis2"></td>
                      <td><input type="text" form="form_catatan_harian" class="form-control" name="jadwalMinum21" id="jadwalMinum21"></td>
                      <td><input type="text" form="form_catatan_harian" class="form-control" name="waktuPemberian21" id="waktuPemberian21"></td>
                      <td>
                        <select form="form_catatan_harian" class="form-control select2" id="pemberi21" name="pemberi21">
                          <option></option>
                          <?php foreach($karyawan as $value): ?>
                            <option value="<?php echo $value['Id']; ?>"><?php echo $value['Nama']; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </td>
                      <td>
                        <select form="form_catatan_harian" class="form-control select2" id="penanggungJawab21" name="penanggungJawab21">
                          <option></option>
                          <?php foreach($karyawan as $value): ?>
                            <option value="<?php echo $value['Id']; ?>"><?php echo $value['Nama']; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </td>
                  </tr>
                  <tr>
                      <td><input type="text" form="form_catatan_harian" class="form-control" name="jadwalMinum22" id="jadwalMinum22"></td>
                      <td><input type="text" form="form_catatan_harian" class="form-control" name="waktuPemberian22" id="waktuPemberian22"></td>
                      <td>
                        <select form="form_catatan_harian" class="form-control select2" id="pemberi22" name="pemberi22">
                          <option></option>
                          <?php foreach($karyawan as $value): ?>
                            <option value="<?php echo $value['Id']; ?>"><?php echo $value['Nama']; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </td>
                      <td>
                        <select form="form_catatan_harian" class="form-control select2" id="penanggungJawab22" name="penanggungJawab22">
                          <option></option>
                          <?php foreach($karyawan as $value): ?>
                            <option value="<?php echo $value['Id']; ?>"><?php echo $value['Nama']; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </td>
                  </tr>
                  <!-- akhir baris 2 -->

                  <!-- baris 3 -->
                  <tr>
                      <td  rowspan ="2" style="vertical-align: middle;"><input type="text" form="form_catatan_harian" class="form-control" name="namaObat3" id="namaObat3"></td>
                      <td rowspan ="2" style="vertical-align: middle;"><input type="text" form="form_catatan_harian" class="form-control" name="dosis3" id="dosis3"></td>
                      <td><input type="text" form="form_catatan_harian" class="form-control" name="jadwalMinum31" id="jadwalMinum31"></td>
                      <td><input type="text" form="form_catatan_harian" class="form-control" name="waktuPemberian31" id="waktuPemberian31"></td>
                      <td>
                        <select form="form_catatan_harian" class="form-control select2" id="pemberi31" name="pemberi31">
                          <option></option>
                          <?php foreach($karyawan as $value): ?>
                            <option value="<?php echo $value['Id']; ?>"><?php echo $value['Nama']; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </td>
                      <td>
                        <select form="form_catatan_harian" class="form-control select2" id="penanggungJawab31" name="penanggungJawab31">
                          <option></option>
                          <?php foreach($karyawan as $value): ?>
                            <option value="<?php echo $value['Id']; ?>"><?php echo $value['Nama']; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </td>
                  </tr>
                  <tr>
                      <td><input type="text" form="form_catatan_harian" class="form-control" name="jadwalMinum32" id="jadwalMinum32"></td>
                      <td><input type="text" form="form_catatan_harian" class="form-control" name="waktuPemberian32" id="waktuPemberian32"></td>
                      <td>
                        <select form="form_catatan_harian" class="form-control select2" id="pemberi32" name="pemberi32">
                          <option></option>
                          <?php foreach($karyawan as $value): ?>
                            <option value="<?php echo $value['Id']; ?>"><?php echo $value['Nama']; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </td>
                      <td>
                        <select form="form_catatan_harian" class="form-control select2" id="penanggungJawab32" name="penanggungJawab32">
                          <option></option>
                          <?php foreach($karyawan as $value): ?>
                            <option value="<?php echo $value['Id']; ?>"><?php echo $value['Nama']; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </td>
                  </tr>
                  <!-- akhir baris 3 -->

                  <!-- baris 4 -->
                  <tr>
                      <td  rowspan ="2" style="vertical-align: middle;"><input type="text" form="form_catatan_harian" class="form-control" name="namaObat4" id="namaObat4"></td>
                      <td rowspan ="2" style="vertical-align: middle;"><input type="text" form="form_catatan_harian" class="form-control" name="dosis4" id="dosis4"></td>
                      <td><input type="text" form="form_catatan_harian" class="form-control" name="jadwalMinum41" id="jadwalMinum41"></td>
                      <td><input type="text" form="form_catatan_harian" class="form-control" name="waktuPemberian41" id="waktuPemberian41"></td>
                      <td>
                        <select form="form_catatan_harian" class="form-control select2" id="pemberi41" name="pemberi41">
                          <option></option>
                          <?php foreach($karyawan as $value): ?>
                            <option value="<?php echo $value['Id']; ?>"><?php echo $value['Nama']; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </td>
                      <td>
                        <select form="form_catatan_harian" class="form-control select2" id="penanggungJawab41" name="penanggungJawab41">
                          <option></option>
                          <?php foreach($karyawan as $value): ?>
                            <option value="<?php echo $value['Id']; ?>"><?php echo $value['Nama']; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </td>
                  </tr>
                  <tr>
                      <td><input type="text" form="form_catatan_harian" class="form-control" name="jadwalMinum42" id="jadwalMinum42"></td>
                      <td><input type="text" form="form_catatan_harian" class="form-control" name="waktuPemberian42" id="waktuPemberian42"></td>
                      <td>
                        <select form="form_catatan_harian" class="form-control select2" id="pemberi42" name="pemberi42">
                          <option></option>
                          <?php foreach($karyawan as $value): ?>
                            <option value="<?php echo $value['Id']; ?>"><?php echo $value['Nama']; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </td>
                      <td>
                        <select form="form_catatan_harian" class="form-control select2" id="penanggungJawab42" name="penanggungJawab42">
                          <option></option>
                          <?php foreach($karyawan as $value): ?>
                            <option value="<?php echo $value['Id']; ?>"><?php echo $value['Nama']; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </td>
                  </tr>
                  <!-- akhir baris 4 -->

                  <!-- baris 5 -->
                  <tr>
                      <td  rowspan ="2" style="vertical-align: middle;"><input type="text" form="form_catatan_harian" class="form-control" name="namaObat5" id="namaObat5"></td>
                      <td rowspan ="2" style="vertical-align: middle;"><input type="text" form="form_catatan_harian" class="form-control" name="dosis5" id="dosis5"></td>
                      <td><input type="text" form="form_catatan_harian" class="form-control" name="jadwalMinum51" id="jadwalMinum51"></td>
                      <td><input type="text" form="form_catatan_harian" class="form-control" name="waktuPemberian51" id="waktuPemberian51"></td>
                      <td>
                        <select form="form_catatan_harian" class="form-control select2" id="pemberi51" name="pemberi51">
                          <option></option>
                          <?php foreach($karyawan as $value): ?>
                            <option value="<?php echo $value['Id']; ?>"><?php echo $value['Nama']; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </td>
                      <td>
                        <select form="form_catatan_harian" class="form-control select2" id="penanggungJawab51" name="penanggungJawab51">
                          <option></option>
                          <?php foreach($karyawan as $value): ?>
                            <option value="<?php echo $value['Id']; ?>"><?php echo $value['Nama']; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </td>
                  </tr>
                  <tr>
                      <td><input type="text" form="form_catatan_harian" class="form-control" name="jadwalMinum52" id="jadwalMinum52"></td>
                      <td><input type="text" form="form_catatan_harian" class="form-control" name="waktuPemberian52" id="waktuPemberian52"></td>
                      <td>
                        <select form="form_catatan_harian" class="form-control select2" id="pemberi52" name="pemberi52">
                          <option></option>
                          <?php foreach($karyawan as $value): ?>
                            <option value="<?php echo $value['Id']; ?>"><?php echo $value['Nama']; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </td>
                      <td>
                        <select form="form_catatan_harian" class="form-control select2" id="penanggungJawab52" name="penanggungJawab52">
                          <option></option>
                          <?php foreach($karyawan as $value): ?>
                            <option value="<?php echo $value['Id']; ?>"><?php echo $value['Nama']; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </td>
                  </tr>
                  <!-- akhir baris 5 -->

                </tbody>
              </table>
            </div>
            <div class="ln_solid"></div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- end row -->
  <div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Makan</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <?php echo validation_errors(); ?>
          <form class="form-horizontal form-label-left">
            <div class="table-responsive col-sm-12">          
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="col-sm-1"></th>
                    <th class="col-sm-3">jenis</th>
                    <th class="col-sm-3">Waktu</th>
                    <th class="col-sm-5">Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                   <tr>
                     <td>Pagi</td>
                     <td><input form="form_catatan_harian" type="text" class="form-control" name="jenisMakan1" id="jenisMakan1"></td>
                     <td><input form="form_catatan_harian" type="text" class="form-control" name="waktuMakan1" id="waktuMakan1"></td>
                     <td><input form="form_catatan_harian" type="text" class="form-control" name="keteranganMakan1" id="keteranganMakan1"></td>
                   </tr>
                   <tr>
                     <td>Siang</td>
                     <td><input form="form_catatan_harian" type="text" class="form-control" name="jenisMakan2" id="jenisMakan2"></td>
                     <td><input form="form_catatan_harian" type="text" class="form-control" name="waktuMakan2" id="waktuMakan2"></td>
                     <td><input form="form_catatan_harian" type="text" class="form-control" name="keteranganMakan2" id="keteranganMakan2"></td>
                   </tr> 
                   <tr>
                     <td>Sore</td>
                     <td><input form="form_catatan_harian" type="text" class="form-control" name="jenisMakan3" id="jenisMakan3"></td>
                     <td><input form="form_catatan_harian" type="text" class="form-control" name="waktuMakan3" id="waktuMakan3"></td>
                     <td><input form="form_catatan_harian" type="text" class="form-control" name="keteranganMakan3" id="keteranganMakan3"></td>
                   </tr>  
                </tbody>
              </table>
            </div>
            <div class="ln_solid"></div>
          </form>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Snack</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <?php echo validation_errors(); ?>
          <form class="form-horizontal form-label-left">
            <div class="table-responsive col-sm-12">          
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="col-sm-1"></th>
                    <th class="col-sm-3">jenis</th>
                    <th class="col-sm-3">Waktu</th>
                    <th class="col-sm-5">Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                   <tr>
                     <td>Snack 1</td>
                     <td><input form="form_catatan_harian" type="text" class="form-control" name="jenisSnack1" id="jenisSnack1"></td>
                     <td><input form="form_catatan_harian" type="text" class="form-control" name="waktuSnack1" id="waktuSnack1"></td>
                     <td><input form="form_catatan_harian" type="text" class="form-control" name="keteranganSnack1" id="keteranganSnack1"></td>
                   </tr>
                   <tr>
                     <td>Snack 2</td>
                     <td><input form="form_catatan_harian" type="text" class="form-control" name="jenisSnack2" id="jenisSnack2"></td>
                     <td><input form="form_catatan_harian" type="text" class="form-control" name="waktuSnack2" id="waktuSnack2"></td>
                     <td><input form="form_catatan_harian" type="text" class="form-control" name="keteranganSnack2" id="keteranganSnack2"></td>
                   </tr> 
                   <tr>
                     <td>Snack 3</td>
                     <td><input form="form_catatan_harian" type="text" class="form-control" name="jenisSnack3" id="jenisSnack3"></td>
                     <td><input form="form_catatan_harian" type="text" class="form-control" name="waktuSnack3" id="waktuSnack3"></td>
                     <td><input form="form_catatan_harian" type="text" class="form-control" name="keteranganSnack3" id="keteranganSnack3"></td>
                   </tr>  
                </tbody>
              </table>
            </div>
            <div class="ln_solid"></div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- end row -->
  <div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Minum Susu</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <?php echo validation_errors(); ?>
          <form class="form-horizontal form-label-left">
            <div class="table-responsive col-sm-12">          
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="col-sm-4">Waktu</th>
                    <th class="col-sm-3">CC</th>
                    <th class="col-sm-5">Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                   <tr>
                     <td><input form="form_catatan_harian" type="text" class="form-control" name="waktuSusu1" id="waktuSusu1"></td>
                     <td><input form="form_catatan_harian" type="text" class="form-control" name="ccSusu1" id="ccSusu1"></td>
                     <td><input form="form_catatan_harian" type="text" class="form-control" name="keteranganSusu1" id="keteranganSusu1"></td>
                   </tr>
                   <tr>
                     <td><input form="form_catatan_harian" type="text" class="form-control" name="waktuSusu2" id="waktuSusu2"></td>
                     <td><input form="form_catatan_harian" type="text" class="form-control" name="ccSusu2" id="ccSusu2"></td>
                     <td><input form="form_catatan_harian" type="text" class="form-control" name="keteranganSusu2" id="keteranganSusu2"></td>
                   </tr> 
                   <tr>
                     <td><input form="form_catatan_harian" type="text" class="form-control" name="waktuSusu3" id="waktuSusu3"></td>
                     <td><input form="form_catatan_harian" type="text" class="form-control" name="ccSusu3" id="ccSusu3"></td>
                     <td><input form="form_catatan_harian" type="text" class="form-control" name="keteranganSusu3" id="keteranganSusu3"></td>
                   </tr>
                   <tr>
                     <td><input form="form_catatan_harian" type="text" class="form-control" name="waktuSusu4" id="waktuSusu4"></td>
                     <td><input form="form_catatan_harian" type="text" class="form-control" name="ccSusu4" id="ccSusu4"></td>
                     <td><input form="form_catatan_harian" type="text" class="form-control" name="keteranganSusu4" id="keteranganSusu4"></td>
                   </tr>
                   <tr>
                     <td><input form="form_catatan_harian" type="text" class="form-control" name="waktuSusu5" id="waktuSusu5"></td>
                     <td><input form="form_catatan_harian" type="text" class="form-control" name="ccSusu5" id="ccSusu5"></td>
                     <td><input form="form_catatan_harian" type="text" class="form-control" name="keteranganSusu5" id="keteranganSusu5"></td>
                   </tr>  
                </tbody>
              </table>
            </div>
            <div class="ln_solid"></div>
          </form>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>BAB</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <?php echo validation_errors(); ?>
          <form class="form-horizontal form-label-left">
            <div class="table-responsive col-sm-12">          
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="col-sm-4">Waktu</th>
                    <th class="col-sm-8">Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                   <tr>
                     <td><input form="form_catatan_harian" type="text" class="form-control" name="waktuBAB1" id="waktuBAB1"></td>
                     <td><input form="form_catatan_harian" type="text" class="form-control" name="keteranganBAB1" id="keteranganBAB1"></td>
                   </tr>
                   <tr>
                     <td><input form="form_catatan_harian" type="text" class="form-control" name="waktuBAB2" id="waktuBAB2"></td>
                     <td><input form="form_catatan_harian" type="text" class="form-control" name="keteranganBAB2" id="keteranganBAB2"></td>
                   </tr> 
                   <tr>
                     <td><input form="form_catatan_harian" type="text" class="form-control" name="waktuBAB3" id="waktuBAB3"></td>
                     <td><input form="form_catatan_harian" type="text" class="form-control" name="keteranganBAB3" id="keteranganBAB3"></td>
                   </tr>  
                </tbody>
              </table>
            </div>
            <div class="ln_solid"></div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- end row -->
  <div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <?php echo validation_errors(); ?>
          <form class="form-horizontal form-label-left">
            <div class="item form-group">
              <label class="control-label col-sm-5" for="keterangan">Catatan khusus dari Mom-ku </span>
              </label>
            </div>
            <div class="item form-group">
              <div class="col-md-12">
                <textarea rows="4" form="form_catatan_harian" id="catatanKhususMom" name="catatanKhususMom" class="form-control"></textarea>
              </div>
            </div>
            <div class="clearfix"></div>
            <br>
            <div class="item form-group">
              <label class="control-label col-sm-3" for="potongKuku">Potong Kuku </span>
              </label>
              <div class="col-md-9">
                <textarea rows="1" form="form_catatan_harian" id="potongKuku" name="potongKuku" class="form-control"></textarea>
              </div>
            </div>

            <div class="ln_solid"></div>
          </form>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Tidur</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <?php echo validation_errors(); ?>
          <form class="form-horizontal form-label-left">
            <div class="table-responsive col-sm-12">          
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="col-sm-2"></th>
                    <th class="col-sm-5">Mulai</th>
                    <th class="col-sm-5">Bangun</th>
                  </tr>
                </thead>
                <tbody>
                   <tr>
                     <td>Tidur 1</td>
                     <td><input type="text" form="form_catatan_harian" class="form-control" name="mulaiTidur1" id="mulaiTidur1"></td>
                     <td><input type="text" form="form_catatan_harian" class="form-control" name="bangunTidur1" id="bangunTidur1"></td>
                   </tr>
                   <tr>
                     <td>Tidur 2</td>
                     <td><input type="text" form="form_catatan_harian" class="form-control" name="mulaiTidur2" id="mulaiTidur2"></td>
                     <td><input type="text" form="form_catatan_harian" class="form-control" name="bangunTidur2" id="bangunTidur2"></td>
                   </tr> 
                   <tr>
                     <td>Tidur 3</td>
                     <td><input type="text" form="form_catatan_harian" class="form-control" name="mulaiTidur3" id="mulaiTidur3"></td>
                     <td><input type="text" form="form_catatan_harian" class="form-control" name="bangunTidur3" id="bangunTidur3"></td>
                   </tr>  
                </tbody>
              </table>
            </div>
            <div class="ln_solid"></div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- end row -->
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Mom-ku ingin mengingatkan mama untuk membawa barang-barang dibawah ini</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <?php echo validation_errors(); ?>
          <form class="form-horizontal form-label-left">
            <div class="item form-group">
             <div class="col-md-12">
                <div class="col-md-2">
                  <div class="checkbox">
                    <label>
                      <input form="form_catatan_harian" type="checkbox" name="barang[]" class="flat" value="Popok(pampers)"> Popok(pampers)
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input form="form_catatan_harian" type="checkbox" name="barang[]" class="flat" value="Minyak kayu putih"> Minyak kayu putih
                    </label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="checkbox">
                    <label>
                      <input form="form_catatan_harian" type="checkbox" name="barang[]" class="flat" value="Minyak telon"> Minyak telon
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input form="form_catatan_harian" type="checkbox" name="barang[]" class="flat" value="Sabun"> Sabun
                    </label>
                  </div>                  
                </div>
                <div class="col-md-2">
                  <div class="checkbox">
                    <label>
                      <input form="form_catatan_harian" type="checkbox" name="barang[]" class="flat" value="Shampo"> Shampo
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input form="form_catatan_harian" type="checkbox" name="barang[]" class="flat" value="Bedak"> Bedak
                    </label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="checkbox">
                    <label>
                      <input form="form_catatan_harian" type="checkbox" name="barang[]" class="flat" value="Tissue basah"> Tissue basah
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input form="form_catatan_harian" type="checkbox" name="barang[]" class="flat" value="Hair lotion"> Hair lotion
                    </label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="checkbox">
                    <label>
                      <input form="form_catatan_harian" type="checkbox" name="barang[]" class="flat" value="Baby oil"> Baby oil
                    </label>
                  </div>
                </div>
              </div> 
            </div>
            <br>
            <div class="item form-group">
              <label class="control-label col-md-2" for="barangLain">Lain-lain
              </label>
              <div class="col-md-3">
                <textarea form="form_catatan_harian" rows="1" id="barangLain" name="barangLain" class="form-control"></textarea>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-lg-2 col-md-offset-5">
                <button id="simpan" form="form_catatan_harian" type="submit" class="btn btn-lg btn-success">simpan</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- end row -->

</div>

<script>
    $(document).ready(function() {
        $('#datatable-responsive').DataTable({
            responsive: true
        });
        $('[data-toggle="modal"]').tooltip();
    });
    $('#tanggal').datetimepicker({
        format: 'DD-MM-YYYY'
    });

    // Selector
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()

    });

</script>