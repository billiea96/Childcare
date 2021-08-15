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
          <h2>Pendaftaran <small><?php echo date('d-M-Y'); ?></small></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <form id="FormPendaftaran" class="form-horizontal form-label-left FormPendaftaran" action="<?php echo site_url('Pendaftaran/simpan'); ?>" method="POST">  

          <!-- HALAMAN 1 -->
          <div id="page1" style="display: block;">
              <div class="form-group">
                <!-- Data Anak -->
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?php echo $pertanyaan[0]['Pertanyaan']; ?><span class="required">*</span>
                </label>
                <div class="col-md-4 col-sm-6 col-xs-12">
                  <input type="text" id="NamaAnak" name="NamaAnak" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo $pertanyaan[3]['Pertanyaan']; ?></label>
                <div class="col-md-4 col-sm-6 col-xs-12">
                  <input type="text" id="NamaPanggilan" name="NamaPanggilan" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"><?php echo $pertanyaan[1]['Pertanyaan']; ?> <span class="required">*</span>
                </label>
                <div class="col-md-3 col-sm-6 col-xs-12">
                  <input type="text" required="" class="form-control" id="TanggalLahir" name="TanggalLahir">
                  <span class="fa fa-calendar form-control-feedback right" aria-hidden="false"></span>
                </div>
              </div>
              <div class="form-group">
                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo $pertanyaan[2]['Pertanyaan']; ?><span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <label class="control-label"> 
                    <input type="radio" class="flat" name="Gender" id="GenderL" value="L" checked="" required 
                  />
                    Laki-laki 
                  </label>
                  <label class="control-label">
                    <input type="radio" class="flat" name="Gender" id="GenderP" value="P" />
                    Perempuan 
                  </label>
                </div>
              </div>
              <div class="form-group">
                <class>
                <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo $pertanyaan[4]['Pertanyaan']; ?>
                </label>
                <div class="col-md-4 col-sm-6 col-xs-12">
                  <input id="NamaDokter" name="NamaDokter" class="form-control col-md-7 col-xs-12" type="text">
                </div>
                <label style="width:auto;" class="control-label col-md-1"><?php echo $pertanyaan[5]['Pertanyaan']; ?>
                </label>
                <div class="col-md-2 col-sm-6 col-xs-12">
                  <input style="width:auto;" id="TelpDokter" name="TelpDokter" class="form-control col-md-7 col-xs-12" type="text">
                </div>
              </div>
              
              <div class="ln_solid"></div>
              <!-- Data Ayah -->
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo $pertanyaan[6]['Pertanyaan']; ?> <span class="required">*</span>
                </label>
                <div class="col-md-4 col-sm-6 col-xs-12">
                  <input id="NamaAyah" name="NamaAyah" class="form-control col-md-7 col-xs-12" required="required" type="text">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo $pertanyaan[7]['Pertanyaan']; ?>
                </label>
                <div class="col-md-5 col-sm-6 col-xs-12">
                  <input id="AlamatAyah" name="AlamatAyah" class="form-control col-md-7 col-xs-12" type="text">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo $pertanyaan[8]['Pertanyaan']; ?>
                </label>
                <div class="col-md-2 col-sm-6 col-xs-12">
                  <input id="NoTelpAyah" name="NoTelpAyah" class="form-control col-md-7 col-xs-12" type="text">
                </div>
                <label style="width:auto;" class="control-label col-md-2"><?php echo $pertanyaan[9]['Pertanyaan']; ?>
                </label>
                <div class="col-md-2 col-sm-6 col-xs-12">
                  <input id="NoTempatKerjaAyah" name="NoTempatKerjaAyah" class="form-control col-md-7 col-xs-12" type="text">
                </div>
                <label style="width:auto;" class="control-label col-md-1 col-sm-3 col-xs-12"><?php echo $pertanyaan[10]['Pertanyaan']; ?>
                </label>
                <div class="col-md-2 col-sm-6 col-xs-12">
                  <input id="NoHPAyah" name="NoHPAyah" class="form-control col-md-7 col-xs-12" type="text">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo $pertanyaan[11]['Pertanyaan']; ?>
                </label>
                <div class="col-md-5 col-sm-6 col-xs-12">
                  <input id="AlamatKerjaAyah" name="AlamatKerjaAyah" class="form-control col-md-7 col-xs-12" type="text">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo $pertanyaan[12]['Pertanyaan']; ?>
                </label>
                <div class="col-md-2 col-sm-6 col-xs-12">
                  <input id="LamaKerjaAyah" name="LamaKerjaAyah" class="form-control col-md-7 col-xs-12" type="number">
                </div>
              </div>
              
              <div class="ln_solid"></div>
              <!-- Data Ibu -->
             <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo $pertanyaan[13]['Pertanyaan']; ?> <span class="required">*</span>
                </label>
                <div class="col-md-4 col-sm-6 col-xs-12">
                  <input id="NamaIbu" name="NamaIbu" class="form-control col-md-7 col-xs-12" required="required" type="text">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo $pertanyaan[14]['Pertanyaan']; ?>
                </label>
                <div class="col-md-5 col-sm-6 col-xs-12">
                  <input id="AlamatIbu" name="AlamatIbu" class="form-control col-md-7 col-xs-12" type="text">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo $pertanyaan[15]['Pertanyaan']; ?>
                </label>
                <div class="col-md-2 col-sm-6 col-xs-12">
                  <input id="NoTelpIbu" name="NoTelpIbu" class="form-control col-md-7 col-xs-12" type="text">
                </div>
                <label style="width:auto;" class="control-label col-md-2"><?php echo $pertanyaan[16]['Pertanyaan']; ?>
                </label>
                <div class="col-md-2 col-sm-6 col-xs-12">
                  <input id="NoTempatKerjaIbu" name="NoTempatKerjaIbu" class="form-control col-md-7 col-xs-12" type="text">
                </div>
                <label style="width:auto;" class="control-label col-md-1 col-sm-3 col-xs-12"><?php echo $pertanyaan[17]['Pertanyaan']; ?>
                </label>
                <div class="col-md-2 col-sm-6 col-xs-12">
                  <input id="NoHPIbu" name="NoHPIbu" class="form-control col-md-7 col-xs-12" type="text">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo $pertanyaan[18]['Pertanyaan']; ?>
                </label>
                <div class="col-md-5 col-sm-6 col-xs-12">
                  <input id="AlamatKerjaIbu" name="AlamatKerjaIbu" class="form-control col-md-7 col-xs-12" type="text">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo $pertanyaan[19]['Pertanyaan']; ?>
                </label>
                <div class="col-md-2 col-sm-6 col-xs-12">
                  <input id="LamaKerjaIbu" name="LamaKerjaIbu" class="form-control col-md-7 col-xs-12" type="number">
                </div>
              </div>

              <div class="ln_solid"></div>
              <!-- Data Orang Lain -->
              <div class="col-sm-1"></div><h4 style="font-weight: bold;"><span style="color: red;">*</span>Orang yang dapat dikontak saat darurat dan dapat menjemput anak tersebut</h4><br>
              <div class="col-sm-12">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="control-label col-md-5 col-sm-3 col-xs-12"><?php echo $pertanyaan[20]['Pertanyaan']; ?>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input id="NamaOrangLain1" name="NamaOrangLain1" class="form-control col-md-7 col-xs-12" type="text">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-5 col-sm-3 col-xs-12"><?php echo $pertanyaan[21]['Pertanyaan']; ?>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input id="HubunganDenganAnak1" name="HubunganDenganAnak1" class="form-control col-md-7 col-xs-12" type="text">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-5 col-sm-3 col-xs-12"><?php echo $pertanyaan[22]['Pertanyaan']; ?>
                    </label>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <input id="NoTelpOrang1" name="NoTelpOrang1" class="form-control col-md-7 col-xs-12" type="text">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-5 col-sm-3 col-xs-12"><?php echo $pertanyaan[23]['Pertanyaan']; ?>
                    </label>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <input id="NoHPOrang1" name="NoHPOrang1" class="form-control col-md-7 col-xs-12" type="text">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-5 col-sm-3 col-xs-12"><?php echo $pertanyaan[24]['Pertanyaan']; ?>
                    </label>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <input id="NoTelpKerjaOrang1" name="NoTelpKerjaOrang1" class="form-control col-md-7 col-xs-12" type="text">
                    </div>
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="control-label col-md-5 col-sm-3 col-xs-12"><?php echo $pertanyaan[20]['Pertanyaan']; ?>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input id="NamaOrangLain2" name="NamaOrangLain2" class="form-control col-md-7 col-xs-12" type="text">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-5 col-sm-3 col-xs-12"><?php echo $pertanyaan[21]['Pertanyaan']; ?>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input id="HubunganDenganAnak2" name="HubunganDenganAnak2" class="form-control col-md-7 col-xs-12" type="text">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-5 col-sm-3 col-xs-12"><?php echo $pertanyaan[22]['Pertanyaan']; ?>
                    </label>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <input id="NoTelpOrang2" name="NoTelpOrang2" class="form-control col-md-7 col-xs-12" type="text">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-5 col-sm-3 col-xs-12"><?php echo $pertanyaan[23]['Pertanyaan']; ?>
                    </label>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <input id="NoHPOrang2" name="NoHPOrang2" class="form-control col-md-7 col-xs-12" type="text">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-5 col-sm-3 col-xs-12"><?php echo $pertanyaan[24]['Pertanyaan']; ?>
                    </label>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <input id="NoTelpKerjaOrang2" name="NoTelpKerjaOrang2" class="form-control col-md-7 col-xs-12" type="text">
                    </div>
                  </div>
                </div>

              </div>
              <div class="clearfix"></div>
              <div class="ln_solid"></div>

              <!-- Orang Lain -->
              <div class="col-sm-1"></div><h4 style="font-weight: bold;"><span style="color: red;">*</span>Orang lain yang dapat menjemput anak tersebut</h4><br>
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-3 col-xs-12"><?php echo $pertanyaan[25]['Pertanyaan']; ?>
                </label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input id="OrangLain3" name="OrangLain3" class="form-control col-md-7 col-xs-12" type="text">
                </div>
                <label style="width: auto;" class="control-label col-md-2 col-sm-3 col-xs-12"><?php echo $pertanyaan[26]['Pertanyaan']; ?>
                </label>
                <div class="col-md-3 col-sm-6 col-xs-12">
                  <input id="NoOrangLain3" name="NoOrangLain3" class="form-control col-md-7 col-xs-12" type="text">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-3 col-xs-12"><?php echo $pertanyaan[25]['Pertanyaan']; ?>
                </label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input id="OrangLain4" name="OrangLain4" class="form-control col-md-7 col-xs-12" type="text">
                </div>
                <label style="width: auto;" class="control-label col-md-2 col-sm-3 col-xs-12"><?php echo $pertanyaan[26]['Pertanyaan']; ?>
                </label>
                <div class="col-md-3 col-sm-6 col-xs-12">
                  <input id="NoOrangLain4" name="NoOrangLain4" class="form-control col-md-7 col-xs-12" type="text">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-3 col-xs-12"><?php echo $pertanyaan[25]['Pertanyaan']; ?>
                </label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input id="OrangLain5" name="OrangLain5" class="form-control col-md-7 col-xs-12" type="text">
                </div>
                <label style="width: auto;" class="control-label col-md-2 col-sm-3 col-xs-12"><?php echo $pertanyaan[26]['Pertanyaan']; ?>
                </label>
                <div class="col-md-3 col-sm-6 col-xs-12">
                  <input id="NoOrangLain5" name="NoOrangLain5" class="form-control col-md-7 col-xs-12" type="text">
                </div>
              </div>

            
              <div class="ln_solid"></div>

              <!-- Anak Lainnya -->
              <div class="col-sm-1"></div><h4 style="font-weight: bold;"><span style="color: red;">*</span>Anak lainnya dalam keluarga anda</h4><br>
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-3 col-xs-12"><?php echo $pertanyaan[27]['Pertanyaan']; ?>
                </label>
                <div class="col-md-4 col-sm-6 col-xs-12">
                  <input id="NamaAnakLain1" name="NamaAnakLain1" class="form-control col-md-7 col-xs-12" type="text">
                </div>
                <label style="width: auto;" class="control-label col-md-2 col-sm-3 col-xs-12"><?php echo $pertanyaan[28]['Pertanyaan']; ?>
                </label>
                <div class="col-md-3 col-sm-6 col-xs-12">
                  <input type="text" class="form-control" id="TanggalLahirLain1" name="TanggalLahirLain1">
                  <span class="fa fa-calendar form-control-feedback right" aria-hidden="false"></span>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-3 col-xs-12"><?php echo $pertanyaan[27]['Pertanyaan']; ?>
                </label>
                <div class="col-md-4 col-sm-6 col-xs-12">
                  <input id="NamaAnakLain2" name="NamaAnakLain2" class="form-control col-md-7 col-xs-12" type="text">
                </div>
                <label style="width: auto;" class="control-label col-md-2 col-sm-3 col-xs-12"><?php echo $pertanyaan[28]['Pertanyaan']; ?>
                </label>
                <div class="col-md-3 col-sm-6 col-xs-12">
                  <input type="text" class="form-control" id="TanggalLahirLain2" name="TanggalLahirLain2">
                  <span class="fa fa-calendar form-control-feedback right" aria-hidden="false"></span>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-3 col-xs-12"><?php echo $pertanyaan[27]['Pertanyaan']; ?>
                </label>
                <div class="col-md-4 col-sm-6 col-xs-12">
                  <input id="NamaAnakLain3" name="NamaAnakLain3" class="form-control col-md-7 col-xs-12" type="text">
                </div>
                <label style="width: auto;" class="control-label col-md-2 col-sm-3 col-xs-12"><?php echo $pertanyaan[28]['Pertanyaan']; ?>
                </label>
                <div class="col-md-3 col-sm-6 col-xs-12">
                  <input type="text" class="form-control" id="TanggalLahirLain3" name="TanggalLahirLain3">
                  <span class="fa fa-calendar form-control-feedback right" aria-hidden="false"></span>
                </div>
              </div>

              <div class="ln_solid"></div>

              <div class="form-group">
                <div class="col-md-2 col-sm-6 col-xs-12 col-md-offset-10">
                  <button class="btn btn-primary" id="buttonPage1" type="button">Selanjutnya > </button>
                </div>
              </div>
          </div>

          <!-- HALAMAN 2 -->
          <div id="page2" style="display: none;">
            <div class="col-sm-1"></div><h4 style="font-weight: bold;margin: 0px;">Makanan</h4>
            <div class="form-group">
              <label for="middle-name" class="control-label col-md-5 col-sm-3 col-xs-12"><?php echo $pertanyaan[29]['Pertanyaan']; ?></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <label class="control-label"> 
                  <input type="radio" name="Asikah" id="asikahYa" value="Ya" checked=""/>
                  Ya 
                </label>
                <label class="control-label">
                  <input type="radio" name="Asikah" value="Tidak" />
                  Tidak 
                </label>
              </div>
            </div>
            <div class="form-group" id="divLanjutAsi">
              <label for="middle-name" class="control-label col-md-5 col-sm-3 col-xs-12">Jika ya, <?php echo $pertanyaan[30]['Pertanyaan']; ?></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <label class="control-label"> 
                  <input type="radio" name="LanjutAsi" id="LanjutAsiYa" value="Ya" checked=""/>
                  Ya 
                </label>
                <label class="control-label">
                  <input type="radio" name="LanjutAsi" value="Tidak" />
                  Tidak 
                </label>
              </div>
            </div>
            <div class="form-group" id="divRencanaAsi">
              <label for="middle-name" class="control-label col-md-5 col-sm-3 col-xs-12">Jika ya, <?php echo $pertanyaan[31]['Pertanyaan']; ?></label>
              <div class="col-md-5 col-sm-6 col-xs-12">
                 <textarea rows="4" id="RencanaAsi" name="RencanaAsi" class="form-control"></textarea>
              </div>
            </div>
            <div class="form-group" id="divJadwalAsi">
              <label for="middle-name" class="control-label col-md-5 col-sm-3 col-xs-12"><?php echo $pertanyaan[32]['Pertanyaan']; ?></label>
              <div class="col-md-4 col-sm-6 col-xs-12">
                 <textarea rows="3" id="JadwalAsi" name="JadwalAsi" class="form-control"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="middle-name" class="control-label col-md-5 col-sm-3 col-xs-12"><?php echo $pertanyaan[33]['Pertanyaan']; ?></label>
              <div class="col-md-4 col-sm-6 col-xs-12">
                 <textarea rows="1" id="SuplemenLain" name="SuplemenLain" class="form-control"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="middle-name" class="control-label col-md-5 col-sm-3 col-xs-12"><?php echo $pertanyaan[34]['Pertanyaan']; ?></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <label class="control-label"> 
                  <input type="radio" name="SusuBotolkah" value="Ya" checked=""/>
                  Ya 
                </label>
                <label class="control-label">
                  <input type="radio" name="SusuBotolkah" value="Tidak" />
                  Tidak 
                </label>
              </div>
            </div>
            <div id="divJadwalSusuBotol">
              <div class="form-group">
                <label for="middle-name" class="control-label col-md-5 col-sm-3 col-xs-12">Jika ya, <?php echo $pertanyaan[35]['Pertanyaan']; ?> ?</label>
              </div>
              <div class="table-responsive col-sm-10 col-sm-offset-1">          
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th class="col-sm-2">Cairan</th>
                      <th>Merek</th>
                      <th>Jumlah</th>
                      <th>Waktu</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><?php echo $pertanyaan[36]['Pertanyaan']; ?></td>
                      <td><input type="text" class="form-control" id="MerekSusuFormula" name="MerekSusuFormula"></td>
                      <td><input type="text" class="form-control" id="JumlahSusuFormula" name="JumlahSusuFormula"></td>
                      <td><input type="text" class="form-control" id="WaktuSusuFormula" name="WaktuSusuFormula"></td>
                    </tr>
                    <tr>
                      <td><?php echo $pertanyaan[37]['Pertanyaan']; ?></td>
                      <td><input type="text" class="form-control" id="MerekSusuMurni" name="MerekSusuMurni"></td>
                      <td><input type="text" class="form-control" id="JumlahSusuMurni" name="JumlahSusuMurni"></td>
                      <td><input type="text" class="form-control" id="WaktuSusuMurni" name="WaktuSusuMurni"></td>
                    </tr>
                    <tr>
                      <td><?php echo $pertanyaan[38]['Pertanyaan']; ?></td>
                      <td><input type="text" class="form-control" id="MerekAir" name="MerekAir"></td>
                      <td><input type="text" class="form-control" id="JumlahAir" name="JumlahAir"></td>
                      <td><input type="text" class="form-control" id="WaktuAir" name="WaktuAir"></td>
                    </tr>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="form-group">
              <label for="middle-name" class="control-label col-md-6 col-sm-3 col-xs-12"><?php echo $pertanyaan[39]['Pertanyaan']; ?></label>
              <div class="col-md-4 col-sm-6 col-xs-12">
                 <textarea rows="1" id="PosisiAnak" name="PosisiAnak" class="form-control"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="middle-name" class="control-label col-md-6 col-sm-3 col-xs-12"><?php echo $pertanyaan[40]['Pertanyaan']; ?></label>
              <div class="col-md-4 col-sm-6 col-xs-12">
                 <textarea rows="1" id="PosisiSendawa" name="PosisiSendawa" class="form-control"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="middle-name" class="control-label col-md-6 col-sm-3 col-xs-12"><?php echo $pertanyaan[41]['Pertanyaan']; ?></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <label class="control-label"> 
                  <input type="radio" name="KenalMakananPadatkah" value="Ya" />
                  Ya 
                </label>
                <label class="control-label">
                  <input type="radio" name="KenalMakananPadatkah" value="Tidak" checked=""/>
                  Tidak 
                </label>
              </div>
            </div>
            <div class="form-group" id="divJenisMakanPadat" style="display: none;">
              <label for="middle-name" class="control-label col-md-6 col-sm-3 col-xs-12">Jika ya, <?php echo $pertanyaan[42]['Pertanyaan']; ?></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <label class="control-label"> 
                  <input type="radio" name="JenisMakananPadat" value="makanan bayi" checked=""/>
                  makanan bayi  
                </label>
                <label class="control-label">
                  <input type="radio" name="JenisMakananPadat" value="makanan orang dewasa" />
                  makanan dewasa 
                </label>
              </div>
            </div>
            <div class="ln_solid"></div>

            <div class="form-group">
              <div class="col-md-8 col-sm-6 col-xs-12 col-md-offset-9">
                <button class="btn btn-primary" id="buttonPreviousPage2" type="button">< Sebelumnya</button>
                <button class="btn btn-primary" id="buttonPage2" type="button">Selanjutnya > </button>
              </div>
            </div>
          </div>

          <!-- Halaman 3 -->
          <div id="page3" style="display: none;">
            <div id="divJadwalPemberianMakan">
              <div class="form-group">
                <label for="middle-name" class="control-label col-md-5 col-sm-3 col-xs-12"><?php echo $pertanyaan[43]['Pertanyaan']; ?> ?</label>
              </div>
              <div class="table-responsive col-sm-10 col-sm-offset-1">          
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th class="col-sm-2">Makanan padat</th>
                      <th>Merek</th>
                      <th>Kepadatan</th>
                      <th>Jumlah</th>
                      <th>Waktu</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><?php echo $pertanyaan[44]['Pertanyaan']; ?></td>
                      <td><input type="text" class="form-control" id="MerekCereal1" name="MerekCereal1"></td>
                      <td><input type="text" class="form-control" id="KepadatanCereal1" name="KepadatanCereal1"></td>
                      <td><input type="text" class="form-control" id="JumlahCereal1" name="JumlahCereal1"></td>
                      <td><input type="text" class="form-control" id="WaktuCereal1" name="WaktuCereal1"></td>
                    </tr>
                    <tr>
                      <td><?php echo $pertanyaan[44]['Pertanyaan']; ?></td>
                      <td><input type="text" class="form-control" id="MerekCereal2" name="MerekCereal2"></td>
                      <td><input type="text" class="form-control" id="KepadatanCereal2" name="KepadatanCereal2"></td>
                      <td><input type="text" class="form-control" id="JumlahCereal2" name="JumlahCereal2"></td>
                      <td><input type="text" class="form-control" id="WaktuCereal2" name="WaktuCereal2"></td>
                    </tr>
                    <tr>
                      <td><?php echo $pertanyaan[44]['Pertanyaan']; ?></td>
                      <td><input type="text" class="form-control" id="MerekCereal3" name="MerekCereal3"></td>
                      <td><input type="text" class="form-control" id="KepadatanCereal3" name="KepadatanCereal3"></td>
                      <td><input type="text" class="form-control" id="JumlahCereal3" name="JumlahCereal3"></td>
                      <td><input type="text" class="form-control" id="WaktuCereal3" name="WaktuCereal3"></td>
                    </tr>
                    <tr>
                      <td><?php echo $pertanyaan[45]['Pertanyaan']; ?></td>
                      <td><input type="text" class="form-control" id="MerekSayuran1" name="MerekSayuran1"></td>
                      <td><input type="text" class="form-control" id="KepadatanSayuran1" name="KepadatanSayuran1"></td>
                      <td><input type="text" class="form-control" id="JumlahSayuran1" name="JumlahSayuran1"></td>
                      <td><input type="text" class="form-control" id="WaktuSayuran1" name="WaktuSayuran1"></td>
                    </tr>
                    <tr>
                      <td><?php echo $pertanyaan[45]['Pertanyaan']; ?></td>
                      <td><input type="text" class="form-control" id="MerekSayuran2" name="MerekSayuran2"></td>
                      <td><input type="text" class="form-control" id="KepadatanSayuran2" name="KepadatanSayuran2"></td>
                      <td><input type="text" class="form-control" id="JumlahSayuran2" name="JumlahSayuran2"></td>
                      <td><input type="text" class="form-control" id="WaktuSayuran2" name="WaktuSayuran2"></td>
                    </tr>
                    <tr>
                      <td><?php echo $pertanyaan[45]['Pertanyaan']; ?></td>
                      <td><input type="text" class="form-control" id="MerekSayuran3" name="MerekSayuran3"></td>
                      <td><input type="text" class="form-control" id="KepadatanSayuran3" name="KepadatanSayuran3"></td>
                      <td><input type="text" class="form-control" id="JumlahSayuran3" name="JumlahSayuran3"></td>
                      <td><input type="text" class="form-control" id="WaktuSayuran3" name="WaktuSayuran3"></td>
                    </tr>
                    <tr>
                      <td><?php echo $pertanyaan[45]['Pertanyaan']; ?></td>
                      <td><input type="text" class="form-control" id="MerekSayuran4" name="MerekSayuran4"></td>
                      <td><input type="text" class="form-control" id="KepadatanSayuran4" name="KepadatanSayuran4"></td>
                      <td><input type="text" class="form-control" id="JumlahSayuran4" name="JumlahSayuran4"></td>
                      <td><input type="text" class="form-control" id="WaktuSayuran4" name="WaktuSayuran4"></td>
                    </tr>
                    <tr>
                      <td><?php echo $pertanyaan[46]['Pertanyaan']; ?></td>
                      <td><input type="text" class="form-control" id="MerekBuah1" name="MerekBuah1"></td>
                      <td><input type="text" class="form-control" id="KepadatanBuah1" name="KepadatanBuah1"></td>
                      <td><input type="text" class="form-control" id="JumlahBuah1" name="JumlahBuah1"></td>
                      <td><input type="text" class="form-control" id="WaktuBuah1" name="WaktuBuah1"></td>
                    </tr>
                    <tr>
                      <td><?php echo $pertanyaan[46]['Pertanyaan']; ?></td>
                      <td><input type="text" class="form-control" id="MerekBuah2" name="MerekBuah2"></td>
                      <td><input type="text" class="form-control" id="KepadatanBuah2" name="KepadatanBuah2"></td>
                      <td><input type="text" class="form-control" id="JumlahBuah2" name="JumlahBuah2"></td>
                      <td><input type="text" class="form-control" id="WaktuBuah2" name="WaktuBuah2"></td>
                    </tr>
                    <tr>
                      <td><?php echo $pertanyaan[46]['Pertanyaan']; ?></td>
                      <td><input type="text" class="form-control" id="MerekBuah3" name="MerekBuah3"></td>
                      <td><input type="text" class="form-control" id="KepadatanBuah3" name="KepadatanBuah3"></td>
                      <td><input type="text" class="form-control" id="JumlahBuah3" name="JumlahBuah3"></td>
                      <td><input type="text" class="form-control" id="WaktuBuah3" name="WaktuBuah3"></td>
                    </tr>
                    <tr>
                      <td><?php echo $pertanyaan[46]['Pertanyaan']; ?></td>
                      <td><input type="text" class="form-control" id="MerekBuah4" name="MerekBuah4"></td>
                      <td><input type="text" class="form-control" id="KepadatanBuah4" name="KepadatanBuah4"></td>
                      <td><input type="text" class="form-control" id="JumlahBuah4" name="JumlahBuah4"></td>
                      <td><input type="text" class="form-control" id="WaktuBuah4" name="WaktuBuah4"></td>
                    </tr>
                    <tr>
                      <td><?php echo $pertanyaan[47]['Pertanyaan']; ?></td>
                      <td><input type="text" class="form-control" id="MerekDaging1" name="MerekDaging1"></td>
                      <td><input type="text" class="form-control" id="KepadatanDaging1" name="KepadatanDaging1"></td>
                      <td><input type="text" class="form-control" id="JumlahDaging1" name="JumlahDaging1"></td>
                      <td><input type="text" class="form-control" id="WaktuDaging1" name="WaktuDaging1"></td>
                    </tr>
                    <tr>
                      <td><?php echo $pertanyaan[47]['Pertanyaan']; ?></td>
                      <td><input type="text" class="form-control" id="MerekDaging2" name="MerekDaging2"></td>
                      <td><input type="text" class="form-control" id="KepadatanDaging2" name="KepadatanDaging2"></td>
                      <td><input type="text" class="form-control" id="JumlahDaging2" name="JumlahDaging2"></td>
                      <td><input type="text" class="form-control" id="WaktuDaging2" name="WaktuDaging2"></td>
                    </tr>
                    <tr>
                      <td><?php echo $pertanyaan[48]['Pertanyaan']; ?></td>
                      <td><input type="text" class="form-control" id="MerekSnack1" name="MerekSnack1"></td>
                      <td><input type="text" class="form-control" id="KepadatanSnack1" name="KepadatanSnack1"></td>
                      <td><input type="text" class="form-control" id="JumlahSnack1" name="JumlahSnack1"></td>
                      <td><input type="text" class="form-control" id="WaktuSnack1" name="WaktuSnack1"></td>
                    </tr>
                    <tr>
                      <td><?php echo $pertanyaan[48]['Pertanyaan']; ?></td>
                      <td><input type="text" class="form-control" id="MerekSnack2" name="MerekSnack2"></td>
                      <td><input type="text" class="form-control" id="KepadatanSnack2" name="KepadatanSnack2"></td>
                      <td><input type="text" class="form-control" id="JumlahSnack2" name="JumlahSnack2"></td>
                      <td><input type="text" class="form-control" id="WaktuSnack2" name="WaktuSnack2"></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="form-group">
              <label for="middle-name" class="control-label col-md-5 col-sm-3 col-xs-12"><?php echo $pertanyaan[49]['Pertanyaan']; ?></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <label class="control-label"> 
                  <input type="radio" name="Alergikah" value="Ya" checked=""/>
                  Ya 
                </label>
                <label class="control-label">
                  <input type="radio" name="Alergikah" value="Tidak" />
                  Tidak 
                </label>
              </div>
            </div>
            <div class="form-group" id="divAlergi">
              <label for="middle-name" class="control-label col-md-5 col-sm-3 col-xs-12">Jika ya, <?php echo $pertanyaan[50]['Pertanyaan']; ?></label>
              <div class="col-md-4 col-sm-6 col-xs-12">
                 <textarea rows="2" id="Alergi" name="Alergi" class="form-control"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="middle-name" class="control-label col-md-5 col-sm-3 col-xs-12"><?php echo $pertanyaan[51]['Pertanyaan']; ?></label>
              <div class="col-md-4 col-sm-6 col-xs-12">
                 <textarea rows="2" id="MakananSukaTidak" name="MakananSukaTidak" class="form-control"></textarea>
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="col-sm-1"></div><h4 style="font-weight: bold;margin: 0px;">Tidur</h4>
            <div class="form-group">
              <label for="middle-name" class="control-label col-md-6 col-sm-3 col-xs-12"><?php echo $pertanyaan[52]['Pertanyaan']; ?></label>
              <div class="col-md-5 col-sm-6 col-xs-12">
                 <textarea rows="3" id="JadwalTidur" name="JadwalTidur" class="form-control"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="middle-name" class="control-label col-md-6 col-sm-3 col-xs-12"><?php echo $pertanyaan[53]['Pertanyaan']; ?></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <label class="control-label"> 
                  <input type="radio" name="TidurNangiskah" value="Ya" checked=""/>
                  Ya 
                </label>
                <label class="control-label">
                  <input type="radio" name="TidurNangiskah" value="Tidak" />
                  Tidak 
                </label>
              </div>
            </div>
            <div class="form-group" id="divLamaNangisTidur">
              <label for="middle-name" class="control-label col-md-6 col-sm-3 col-xs-12">Jika ya, <?php echo $pertanyaan[54]['Pertanyaan']; ?></label>
              <div class="col-md-4 col-sm-6 col-xs-12">
                 <textarea rows="1" id="LamaNangisTidur" name="LamaNangisTidur" class="form-control"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="middle-name" class="control-label col-md-6 col-sm-3 col-xs-12"><?php echo $pertanyaan[55]['Pertanyaan']; ?></label>
              <div class="col-md-4 col-sm-6 col-xs-12">
                 <textarea rows="1" id="TempatTidur" name="TempatTidur" class="form-control"></textarea>
              </div>
            </div>

            <div class="ln_solid"></div>

            <div class="form-group">
              <div class="col-md-8 col-sm-6 col-xs-12 col-md-offset-9">
                <button class="btn btn-primary" id="buttonPreviousPage3" type="button">< Sebelumnya</button>
                <button class="btn btn-primary" id="buttonPage3" type="button">Selanjutnya > </button>
              </div>
            </div>
          </div>

          <!-- Halaman 4 -->
          <div id="page4" style="display: none;">
            <div class="col-sm-1"></div><h4 style="font-weight: bold;margin: 0px;">Merek Popok</h4>
            <div class="form-group">
              <label class="control-label col-md-6 col-sm-3 col-xs-12"><?php echo $pertanyaan[56]['Pertanyaan']; ?></label>
              <div class="col-md-4 col-sm-6 col-xs-12">
                <input type="text" id="MerekPopok" name="MerekPopok" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="form-group">
              <label for="middle-name" class="control-label col-md-6 col-sm-3 col-xs-12"><?php echo $pertanyaan[57]['Pertanyaan']; ?></label>
              <div class="col-md-5 col-sm-6 col-xs-12">
                 <textarea rows="3" id="PemakaianPopok" name="PemakaianPopok" class="form-control"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="middle-name" class="control-label col-md-6 col-sm-3 col-xs-12"><?php echo $pertanyaan[58]['Pertanyaan']; ?></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <label class="control-label"> 
                  <input type="radio" name="RentanPopok" value="Ya" checked=""/>
                  Ya 
                </label>
                <label class="control-label">
                  <input type="radio" name="RentanPopok" value="Tidak" />
                  Tidak 
                </label>
              </div>
            </div>
            <div class="form-group" id="divPerawatan">
              <label for="middle-name" class="control-label col-md-6 col-sm-3 col-xs-12"><?php echo $pertanyaan[59]['Pertanyaan']; ?></label>
              <div class="col-md-4 col-sm-6 col-xs-12">
                 <textarea rows="3" id="Perawatan" name="Perawatan" class="form-control"></textarea>
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="col-sm-1"></div><h4 style="font-weight: bold;margin: 0px;">Perkembagan Sosial/Emosional</h4>
            <div class="form-group">
              <label for="middle-name" class="control-label col-md-6 col-sm-3 col-xs-12"><?php echo $pertanyaan[60]['Pertanyaan']; ?></label>
              <div class="col-md-5 col-sm-6 col-xs-12">
                 <textarea rows="3" id="Karakter" name="Karakter" class="form-control"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="middle-name" class="control-label col-md-6 col-sm-3 col-xs-12"><?php echo $pertanyaan[61]['Pertanyaan']; ?></label>
              <div class="col-md-5 col-sm-6 col-xs-12">
                 <textarea rows="3" id="TandaKarakter" name="TandaKarakter" class="form-control"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="middle-name" class="control-label col-md-6 col-sm-3 col-xs-12"><?php echo $pertanyaan[62]['Pertanyaan']; ?></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <label class="control-label"> 
                  <input type="radio" name="TerbiasaTerpisahkah" value="Ya" checked=""/>
                  Ya 
                </label>
                <label class="control-label">
                  <input type="radio" name="TerbiasaTerpisahkah" value="Tidak" />
                  Tidak 
                </label>
              </div>
            </div>
            <div class="form-group" id="divPenjelasanTerbiasaTerpisah">
              <label for="middle-name" class="control-label col-md-6 col-sm-3 col-xs-12">Jelaskan</label>
              <div class="col-md-4 col-sm-6 col-xs-12">
                 <textarea rows="3" id="PenjelasanTerbiasaTerpisah" name="PenjelasanTerbiasaTerpisah" class="form-control"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="middle-name" class="control-label col-md-6 col-sm-3 col-xs-12"><?php echo $pertanyaan[63]['Pertanyaan']; ?></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <label class="control-label"> 
                  <input type="radio" name="Takutkah" value="Ya" checked=""/>
                  Ya 
                </label>
                <label class="control-label">
                  <input type="radio" name="Takutkah" value="Tidak" />
                  Tidak 
                </label>
              </div>
            </div>
            <div class="form-group" id="divPenjelasanTakut">
              <label for="middle-name" class="control-label col-md-6 col-sm-3 col-xs-12">Jelaskan</label>
              <div class="col-md-4 col-sm-6 col-xs-12">
                 <textarea rows="3" id="PenjelasanTakut" name="PenjelasanTakut" class="form-control"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="middle-name" class="control-label col-md-6 col-sm-3 col-xs-12"><?php echo $pertanyaan[64]['Pertanyaan']; ?></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <label class="control-label"> 
                  <input type="radio" name="PunyaBendaFavoritkah" value="Ya" checked=""/>
                  Ya 
                </label>
                <label class="control-label">
                  <input type="radio" name="PunyaBendaFavoritkah" value="Tidak" />
                  Tidak 
                </label>
              </div>
            </div>
            <div class="form-group" id="divBendaFavorit">
              <label for="middle-name" class="control-label col-md-6 col-sm-3 col-xs-12">Sebutkan</label>
              <div class="col-md-4 col-sm-6 col-xs-12">
                 <textarea rows="3" id="BendaFavorit" name="BendaFavorit" class="form-control"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="middle-name" class="control-label col-md-6 col-sm-3 col-xs-12"><?php echo $pertanyaan[65]['Pertanyaan']; ?></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <label class="control-label"> 
                  <input type="radio" name="DenganAnakLainkah" value="Ya" checked=""/>
                  Ya 
                </label>
                <label class="control-label">
                  <input type="radio" name="DenganAnakLainkah" value="Tidak" />
                  Tidak 
                </label>
              </div>
            </div>
            <div class="form-group" id="divPenjelasanDenganAnakLain">
              <label for="middle-name" class="control-label col-md-6 col-sm-3 col-xs-12"><?php echo $pertanyaan[66]['Pertanyaan']; ?></label>
              <div class="col-md-4 col-sm-6 col-xs-12">
                 <textarea rows="3" id="PenjelasanDenganAnakLain" name="PenjelasanDenganAnakLain" class="form-control"></textarea>
              </div>
            </div>
            <div class="form-group" id="">
              <label for="middle-name" class="control-label col-md-6 col-sm-3 col-xs-12"><?php echo $pertanyaan[67]['Pertanyaan']; ?></label>
              <div class="col-md-3 col-sm-6 col-xs-12">
                 <textarea rows="2" id="AktivitasFavorit" name="AktivitasFavorit" class="form-control"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="middle-name" class="control-label col-md-6 col-sm-3 col-xs-12"><?php echo $pertanyaan[68]['Pertanyaan']; ?></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <label class="control-label"> 
                  <input type="radio" name="PernahDititipkankah" value="Ya" checked=""/>
                  Ya 
                </label>
                <label class="control-label">
                  <input type="radio" name="PernahDititipkankah" value="Tidak" />
                  Tidak 
                </label>
              </div>
            </div>
            <div class="form-group" id="divPenjelasanDititipkan">
              <label for="middle-name" class="control-label col-md-6 col-sm-3 col-xs-12">Jika ya, <?php echo $pertanyaan[69]['Pertanyaan']; ?></label>
              <div class="col-md-4 col-sm-6 col-xs-12">
                 <textarea rows="3" id="PenjelasanDititipkan" name="PenjelasanDititipkan" class="form-control"></textarea>
              </div>
            </div>
            
            <div class="ln_solid"></div>

            <div class="form-group">
              <div class="col-md-8 col-sm-6 col-xs-12 col-md-offset-9">
                <button class="btn btn-primary" id="buttonPreviousPage4" type="button">< Sebelumnya</button>
                <button class="btn btn-primary" id="buttonPage4" type="button">Selanjutnya > </button>
              </div>
            </div>
          </div>

          <!-- Halaman 5 -->
          <div id="page5" style="display: none;">
            <div class="form-group">
              <label for="middle-name" class="control-label col-md-4 col-sm-3 col-xs-12"><?php echo $pertanyaan[70]['Pertanyaan']; ?></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <label class="control-label"> 
                  <input type="radio" name="RutinImunisasikah" value="Ya" checked=""/>
                  Ya 
                </label>
                <label class="control-label">
                  <input type="radio" name="RutinImunisasikah" value="Tidak" />
                  Tidak 
                </label>
              </div>
            </div>
            <div class="form-group" id="divAlasanImunisasi" style="display: none;">
              <label for="middle-name" class="control-label col-md-4 col-sm-3 col-xs-12">Jika tidak, <?php echo $pertanyaan[71]['Pertanyaan']; ?></label>
              <div class="col-md-4 col-sm-6 col-xs-12">
                 <textarea rows="3" id="AlasanImunisasi" name="AlasanImunisasi" class="form-control"></textarea>
              </div>
            </div>
            <div class="col-xs-1"></div><h6 style="font-weight: bold;margin: 0px;">Catatan: sertakan dokumen imunisasi</h6>
            
            <div class="ln_solid"></div>

            <div class="col-sm-5"></div><h4 style="font-weight: bold;margin: 0px;">Kesehatan Anak</h4>
            <div class="form-group">
              <label for="middle-name" class="control-label col-md-4 col-sm-3 col-xs-12"><?php echo $pertanyaan[72]['Pertanyaan']; ?></label>
              <div class="col-md-4 col-sm-4 col-xs-12">
                <label class="control-label"> 
                  <input type="radio" name="MasalahKesehatankah" value="Ya" checked=""/>
                  Ya 
                </label>
                <label class="control-label">
                  <input type="radio" name="MasalahKesehatankah" value="Tidak" />
                  Tidak 
                </label>
                <label class="control-label">(Jika ya sertakan surat-surat yang berkaitan)</label>
              </div>
            </div>
            <br>
            <div class="item form-group">
              <label class="control-label col-sm-4" for="hari"><?php echo $pertanyaan[73]['Pertanyaan']; ?></span>
              </label>
              <div class="col-md-8">
                <div class="col-md-3">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="Penyakit[]" class="flat" value="Asma"> Asma
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="Penyakit[]" class="flat" value="Eksim"> Eksim
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="Penyakit[]" class="flat" value="ISPA"> ISPA
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="Penyakit[]" class="flat" value="Difteri"> Difteri
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="Penyakit[]" class="flat" value="Rheumatic Fever"> Rheumatic Fever
                    </label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="Penyakit[]" class="flat" value="Sakit Telinga"> Sakit Telinga
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="Penyakit[]" class="flat" value="Radang Paru"> Radang Paru
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="Penyakit[]" class="flat" value="Radang amandel"> Radang amandel
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="Penyakit[]" class="flat" value="Kejang"> Kejang
                    </label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="Penyakit[]" class="flat" value="Gondok"> Gondok
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="Penyakit[]" class="flat" value="Polio"> Polio
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="Penyakit[]" class="flat" value="Campak"> Campak
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="Penyakit[]" class="flat" value="Batuk Rejan"> Batuk Rejan
                    </label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="Penyakit[]" class="flat" value="Cacar air"> Cacar air
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="Penyakit[]" class="flat" value="Flu"> Flu
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="Penyakit[]" class="flat" value="Bronchitis"> Bronchitis
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="Penyakit[]" class="flat" value="Sering Deman"> Sering Demam
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-3 col-xs-12">Lain-lain</label>
              <div class="col-md-3 col-sm-6 col-xs-12">
                <input type="text" id="PenyakitLain" name="PenyakitLain" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <label for="middle-name" class="control-label col-md-6 col-sm-3 col-xs-12"><?php echo $pertanyaan[74]['Pertanyaan']; ?></label>
              <div class="col-md-4 col-sm-6 col-xs-12">
                 <textarea rows="3" id="KecelakaanDanLuka" name="KecelakaanDanLuka" class="form-control"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="middle-name" class="control-label col-md-6 col-sm-3 col-xs-12"><?php echo $pertanyaan[75]['Pertanyaan']; ?></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <label class="control-label"> 
                  <input type="radio" name="Alergikah2" value="Ya" checked=""/>
                  Ya 
                </label>
                <label class="control-label">
                  <input type="radio" name="Alergikah2" value="Tidak" />
                  Tidak 
                </label>
              </div>
            </div>
            <div class="form-group" id="divDetailAlergi">
              <label for="middle-name" class="control-label col-md-6 col-sm-3 col-xs-12">Jika ya, <?php echo $pertanyaan[76]['Pertanyaan']; ?></label>
              <div class="col-md-4 col-sm-6 col-xs-12">
                 <textarea rows="3" id="DetailAlergi" name="DetailAlergi" class="form-control"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="middle-name" class="control-label col-md-6 col-sm-3 col-xs-12"><?php echo $pertanyaan[77]['Pertanyaan']; ?></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <label class="control-label"> 
                  <input type="radio" name="ObatTertentukah" value="Ya" checked=""/>
                  Ya 
                </label>
                <label class="control-label">
                  <input type="radio" name="ObatTertentukah" value="Tidak" />
                  Tidak 
                </label>
              </div>
            </div>
            <div class="form-group" id="divDetailObatTertentu">
              <label for="middle-name" class="control-label col-md-6 col-sm-3 col-xs-12">Jika ya, <?php echo $pertanyaan[78]['Pertanyaan']; ?></label>
              <div class="col-md-4 col-sm-6 col-xs-12">
                 <textarea rows="3" id="DetailObatTertentu" name="DetailObatTertentu" class="form-control"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="middle-name" class="control-label col-md-6 col-sm-3 col-xs-12"><?php echo $pertanyaan[79]['Pertanyaan']; ?></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <label class="control-label"> 
                  <input type="radio" name="TakutPerkembagannyakah" value="Ya" checked=""/>
                  Ya 
                </label>
                <label class="control-label">
                  <input type="radio" name="TakutPerkembagannyakah" value="Tidak" />
                  Tidak 
                </label>
              </div>
            </div>
            <div class="form-group" id="divAlasanTakutPerkembangan">
              <label for="middle-name" class="control-label col-md-6 col-sm-3 col-xs-12">Jika ya, <?php echo $pertanyaan[80]['Pertanyaan']; ?></label>
              <div class="col-md-4 col-sm-6 col-xs-12">
                 <textarea rows="3" id="AlasanTakutPerkembangan" name="AlasanTakutPerkembangan" class="form-control"></textarea>
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <label for="middle-name" class="control-label"><?php echo $pertanyaan[81]['Pertanyaan']; ?></label>
            </div>
            <div class="form-group">
              <div class="col-md-6 col-sm-offset-4">
                 <textarea rows="3" id="InformasiKesehatan" name="InformasiKesehatan" class="form-control"></textarea>
              </div>
            </div>
            <div class="ln_solid"></div>

            <div class="form-group">
              <div class="col-md-8 col-md-offset-9">
                <button class="btn btn-primary" id="buttonPreviousPage5" type="button">< Sebelumnya</button>
                <button class="btn btn-primary" id="buttonPage5" type="button">Selanjutnya ></button>
              </div>
            </div>
          </div>

          <!-- HALAMAN 6 -->
          <div id="page6" style="display: none;">
            <h4 class="col-sm-offset-1">Daftar Paket</h4>
              <div class="table-responsive table-striped text-center col-sm-10 col-sm-offset-1">          
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th class="col-sm-1" style="text-align: center;">No</th>
                      <th class="col-sm-2" style="text-align: center;">Nama</th>
                      <th class="col-sm-2" style="text-align: center;">Biaya</th>
                      <th class="col-sm-2" style="text-align: center;">Batas Jam</th>
                      <th class="col-sm-3" style="text-align: center;">Keterangan</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php 
                      $counter=0;
                      foreach ($paket as $key => $value) { ?>
                      <tr>
                        <td><?php $counter++; echo $counter; ?></td>
                        <td><?php echo $value['Nama']; ?></td>
                        <td>Rp. <?php echo number_format($value['Biaya'], 0, ",", "."); ?></td>
                        <td><?php echo DateTime::createFromFormat('H:i:s', $value['MaxJam'])->format('H:i'); ?></td>
                        <td><?php echo $value['Keterangan']; ?></td>
                        <?php } ?>
                  </tbody>
                </table>
              </div>
              <div class="item form-group">
                <label class="control-label col-sm-2" for="paket">Paket </label>
                <div class="col-md-3">
                  <select class="form-control" id="paket" name="paket" required="">
                    <option></option>
                    <?php foreach($paket as $value): ?>
                      <option value="<?php echo $value['Id']; ?>"><?php echo $value['Nama']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                  <label class="control-label col-md-2" for="TanggalMulai">Tanggal mulai dititipkan </label>
                  <div class="col-md-3 col-sm-6 col-xs-12">
                    <input type="text" required="" class="form-control" id="TanggalMulai" name="TanggalMulai">
                    <span class="fa fa-calendar form-control-feedback right" aria-hidden="false"></span>
                  </div>
              </div>

              <?php if($_SESSION['hak_akses']=='GUEST'){ ?>
              <br>
              <div>
                <h4 style="font-weight: bold;"><span style="color: red;">*Penting!!!</span><br>Setelah submit, cetak form pernyataan sebagai bukti telah mendaftar</h4>
              </div>
              <?php } ?>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-8 col-md-offset-9">
                  <button class="btn btn-primary" id="buttonPreviousPage6" type="button">< Sebelumnya</button>
                  <button class="btn btn-success" id="buttonPage6" type="submit">Submit</button>
                </div>
              </div>
          </div>

        </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $('#TanggalLahir').datetimepicker({
        format: 'DD-MM-YYYY'
  });
  $('#TanggalLahirLain1').datetimepicker({
        format: 'DD-MM-YYYY'
  });
  $('#TanggalLahirLain2').datetimepicker({
        format: 'DD-MM-YYYY'
  });
  $('#TanggalLahirLain3').datetimepicker({
        format: 'DD-MM-YYYY'
  });
  $('#TanggalMulai').datetimepicker({
        format: 'DD-MM-YYYY'
  });

  $(document).on('click', '#buttonPage1', function(){
        document.getElementById('page1').style.display ='none';
        document.getElementById('page2').style.display ='block';
        document.getElementById('RencanaAsi').focus();
  });
  $(document).on('click', '#buttonPage2', function(){
        document.getElementById('page2').style.display ='none';
        document.getElementById('page3').style.display ='block';
        document.getElementById('MerekCereal1').focus();
  });
  $(document).on('click', '#buttonPage3', function(){
        document.getElementById('page3').style.display ='none';
        document.getElementById('page4').style.display ='block';
        document.getElementById('MerekPopok').focus();
  });
  $(document).on('click', '#buttonPage4', function(){
        document.getElementById('page4').style.display ='none';
        document.getElementById('page5').style.display ='block';
        document.getElementById('PenyakitLain').focus();
  });
  $(document).on('click', '#buttonPage5', function(){
        document.getElementById('page5').style.display ='none';
        document.getElementById('page6').style.display ='block';
        /*document.getElementById('').focus();*/
  });

  $(document).on('click', '#buttonPreviousPage2', function(){
        document.getElementById('page2').style.display ='none';
        document.getElementById('page1').style.display ='block';
        document.getElementById('NamaAnak').focus();
  });
  $(document).on('click', '#buttonPreviousPage3', function(){
        document.getElementById('page3').style.display ='none';
        document.getElementById('page2').style.display ='block';
        document.getElementById('RencanaAsi').focus();
  });
  $(document).on('click', '#buttonPreviousPage4', function(){
        document.getElementById('page4').style.display ='none';
        document.getElementById('page3').style.display ='block';
        document.getElementById('MerekCereal1').focus();
  });
  $(document).on('click', '#buttonPreviousPage5', function(){
        document.getElementById('page5').style.display ='none';
        document.getElementById('page4').style.display ='block';
        document.getElementById('MerekPopok').focus();
  });
  $(document).on('click', '#buttonPreviousPage6', function(){
        document.getElementById('page6').style.display ='none';
        document.getElementById('page5').style.display ='block';
        document.getElementById('PenyakitLain').focus();
  });
  
  $('input[type=radio][name=Asikah]').change(function() {
      if(this.value =='Ya') {
          document.getElementById('divLanjutAsi').style.display="block";
          if($("#LanjutAsiYa").is(':checked')){
            document.getElementById('divRencanaAsi').style.display="block";
            document.getElementById('divJadwalAsi').style.display="block";
          }else{
            document.getElementById('divRencanaAsi').style.display="none";  
            document.getElementById('divJadwalAsi').style.display="none";
          }
      }
      else if(this.value=='Tidak') {
          document.getElementById('divLanjutAsi').style.display="none";
          document.getElementById('divRencanaAsi').style.display="none";
          document.getElementById('divJadwalAsi').style.display="none";
      }
  });
  $('input[type=radio][name=LanjutAsi]').change(function() {
      if(this.value =='Ya') {
          document.getElementById('divRencanaAsi').style.display="block";
          document.getElementById('divJadwalAsi').style.display="block";
      }
      else if(this.value=='Tidak') {
          document.getElementById('divRencanaAsi').style.display="none";
          document.getElementById('divJadwalAsi').style.display="none";
      }
  });
  $('input[type=radio][name=SusuBotolkah]').change(function() {
      if(this.value =='Ya') {
          document.getElementById('divJadwalSusuBotol').style.display="block";
      }
      else if(this.value=='Tidak') {
          document.getElementById('divJadwalSusuBotol').style.display="none";
      }
  });
  $('input[type=radio][name=KenalMakananPadatkah]').change(function() {
      if(this.value =='Ya') {
          document.getElementById('divJenisMakanPadat').style.display="block";
      }
      else if(this.value=='Tidak') {
          document.getElementById('divJenisMakanPadat').style.display="none";
      }
  });
  $('input[type=radio][name=Alergikah]').change(function() {
      if(this.value =='Ya') {
          document.getElementById('divAlergi').style.display="block";
      }
      else if(this.value=='Tidak') {
          document.getElementById('divAlergi').style.display="none";
      }
  });
  $('input[type=radio][name=TidurNangiskah]').change(function() {
      if(this.value =='Ya') {
          document.getElementById('divLamaNangisTidur').style.display="block";
      }
      else if(this.value=='Tidak') {
          document.getElementById('divLamaNangisTidur').style.display="none";
      }
  });
  $('input[type=radio][name=RentanPopok]').change(function() {
      if(this.value =='Ya') {
          document.getElementById('divPerawatan').style.display="block";
      }
      else if(this.value=='Tidak') {
          document.getElementById('divPerawatan').style.display="none";
      }
  });
  $('input[type=radio][name=PunyaBendaFavoritkah]').change(function() {
      if(this.value =='Ya') {
          document.getElementById('divBendaFavorit').style.display="block";
      }
      else if(this.value=='Tidak') {
          document.getElementById('divBendaFavorit').style.display="none";
      }
  });
  $('input[type=radio][name=DenganAnakLainkah]').change(function() {
      if(this.value =='Ya') {
          document.getElementById('divPenjelasanDenganAnakLain').style.display="block";
      }
      else if(this.value=='Tidak') {
          document.getElementById('divPenjelasanDenganAnakLain').style.display="none";
      }
  });
  $('input[type=radio][name=PernahDititipkankah]').change(function() {
      if(this.value =='Ya') {
          document.getElementById('divPenjelasanDititipkan').style.display="block";
      }
      else if(this.value=='Tidak') {
          document.getElementById('divPenjelasanDititipkan').style.display="none";
      }
  });
  $('input[type=radio][name=RutinImunisasikah]').change(function() {
      if(this.value =='Ya') {
          document.getElementById('divAlasanImunisasi').style.display="none";
      }
      else if(this.value=='Tidak') {
          document.getElementById('divAlasanImunisasi').style.display="block";
      }
  });
  $('input[type=radio][name=Alergikah2]').change(function() {
      if(this.value =='Ya') {
          document.getElementById('divDetailAlergi').style.display="block";
      }
      else if(this.value=='Tidak') {
          document.getElementById('divDetailAlergi').style.display="none";
      }
  });
  $('input[type=radio][name=ObatTertentukah]').change(function() {
      if(this.value =='Ya') {
          document.getElementById('divDetailObatTertentu').style.display="block";
      }
      else if(this.value=='Tidak') {
          document.getElementById('divDetailObatTertentu').style.display="none";
      }
  });
  $('input[type=radio][name=TakutPerkembagannyakah]').change(function() {
      if(this.value =='Ya') {
          document.getElementById('divAlasanTakutPerkembangan').style.display="block";
      }
      else if(this.value=='Tidak') {
          document.getElementById('divAlasanTakutPerkembangan').style.display="none";
      }
  });
</script>
