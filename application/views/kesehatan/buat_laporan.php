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
          <h2>Buat Laporan</h2>
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
              <label class="control-label col-sm-4" for="noHP">Anak <span class="required">*</span>
              </label>
              <div class="col-md-3">
                <select class="form-control select2" form="form_buat_laporan_kesehatan" id="anak" name="anak" required="">
                  <option></option>
                  <?php foreach($anak as $value): ?>
                    <option value="<?php echo $value['Id']; ?>"><?php echo $value['Nama']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-3 col-md-offset-5">
                <button id="generate" type="button" class="btn btn-primary">Generate</button>
              </div>
            </div>
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
          <h2>Tampilan Laporan</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content" id="div_laporan" style="display: none;">
          <h4 style="text-align: right;padding-right: 2%;"><strong><?php 
          echo 'bulan '.date('Y'); ?></strong></h4>
          <div class="table-responsive col-sm-12">
            <table id="table_bahan" border="0" class="table">
                <tr>
                  <td class="col-sm-2" style="text-align: left;font-size:14px;border:0;">Nama</td>
                  <td class="col-sm-10" id="namaAnak" style="text-align: left;font-size:14px;border:0;"> :</td>
                </tr>
                <tr>
                  <td class="col-sm-2" style="text-align: left;font-size:14px;border:0;">Perawat</td>
                  <td class="col-sm-10" id="perawat" style="text-align: left;font-size:14px;border:0;"> :</td>
                </tr>
                <tr>
                  <td class="col-sm-2" style="text-align: left;font-size:14px;border:0;">Usia</td>
                  <td class="col-sm-10" id="usia" style="text-align: left;font-size:14px;border:0;"> :</td>
                </tr>
            </table>
          </div>

          <div class="table-responsive col-sm-12">
            <table id="table_bahan" class="table table-bordered table-hover text-center">
              <thead>
                <tr>
                  <th class="col-sm-6" colspan="2" id="tanggalSebelumnya" style="text-align: center;">Bulan....</th>
                  <th class="col-sm-6" colspan="2" id="tanggalSekarang" style="text-align: center;">Bulan....</th>
                </tr>
              </thead>
              <tbody id="tbody">
                <tr>
                  <td class="col-sm-2" style="text-align: left;border-right: 0;">Berat Badan</td>
                  <td class="col-sm-4" id="beratBadanSebelumnya" style="text-align: left;"> : </td>
                  <td class="col-sm-2" style="text-align: left;border-right: 0;">Berat Badan</td>
                  <td class="col-sm-4" id="beratBadanSekarang" style="text-align: left;"> :</td>
                </tr>
                <tr>
                  <td class="col-sm-2" style="text-align: left;border-right: 0;">Tinggi Badan</td>
                  <td class="col-sm-4" id="tinggiBadanSebelumnya" style="text-align: left;"> : </td>
                  <td class="col-sm-2" style="text-align: left;border-right: 0;">Tinggi Badan</td>
                  <td class="col-sm-4" id="tinggiBadanSekarang" style="text-align: left;"> :</td>
                </tr>
                <tr>
                  <td class="col-sm-2" style="text-align: left;border-right: 0;">Lingkar Kepala</td>
                  <td class="col-sm-4" id="lingkarKepalaSebelumnya" style="text-align: left;"> : </td>
                  <td class="col-sm-2" style="text-align: left;border-right: 0;">Lingkar Kepala</td>
                  <td class="col-sm-4" id="lingkarKepalaSekarang" style="text-align: left;"> :</td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="table-responsive col-sm-12">
            <table id="table_bahan" class="table table-bordered table-hover text-center">
              <thead>
                <tr>
                  <th class="col-sm-12" colspan="2" style="text-align: left;">RIWAYAT IMUNISASI</th>
                </tr>
                <tr>
                  <th class="col-sm-6" style="text-align: center;">Vaksinasi</th>
                  <th class="col-sm-6" style="text-align: center;">Tanggal Pelaksanaan</th>
                </tr>
              </thead>
              <tbody id="riwayatImunisasi">
              </tbody>
            </table>
          </div>

          <div class="table-responsive col-sm-12">
            <table id="table_bahan" class="table table-bordered table-hover text-center">
              <thead>
                <tr>
                  <th class="col-sm-12" colspan="5" style="text-align: left;">RIWAYAT KESEHATAN</th>
                </tr>
                <tr>
                  <th class="col-sm-1" style="text-align: center;">No</th>
                  <th class="col-sm-2" style="text-align: center;">Tanggal</th>
                  <th class="col-sm-3" style="text-align: center;">Keluhan/Diagnosa</th>
                  <th class="col-sm-2" style="text-align: center;">Terapi</th>
                  <th class="col-sm-4" style="text-align: center;">Catatan</th>
                </tr>
              </thead>
              <tbody id="riwayatKesehatan">
              </tbody>
            </table>
          </div>

          <div class="clearfix"></div>
          <br>
          <br>
          <?php echo validation_errors(); ?>
          <form class="form-horizontal form-label-left" id="form_buat_laporan_kesehatan" action="<?php echo site_url('PertumbuhanFisik/simpan_laporan') ?>" method="POST">
            <div class="item form-group">
              <label class="control-label col-sm-2" for="kesimpulan">Kesimpulan</span>
              </label>
              <div class="col-md-5">
                  <textarea class="form-control" rows="3" id="kesimpulan" name="kesimpulan"></textarea>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-sm-2" for="saran">Saran</span>
              </label>
              <div class="col-md-5">
                  <textarea class="form-control" rows="3" id="saran" name="saran"></textarea>
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-4 col-md-offset-10">
                <button id="simpan" type="submit" class="btn btn-success" disabled="">SIMPAN LAPORAN</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

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

    $('#generate').on('click',function(){
        var id = $('#anak').val();

        $.ajax({
            url : '<?php echo site_url("PertumbuhanFisik/tampil_laporan"); ?>',
            method : 'POST',
            dataType: 'json',
            data : {'id_anak':id},
            success : function(data){
              if(data.status==1){
                alert(data.laporan);
                document.getElementById('simpan').disabled=true;
                document.getElementById('div_laporan').style.display='none';
              }else{
                document.getElementById('simpan').disabled=false;
                document.getElementById('div_laporan').style.display='block';
                $('#namaAnak').html(' : '+data.namaAnak);
                $('#perawat').html(' : '+data.namaPerawat);
                $('#usia').html(' : '+data.usia);

                $('#tanggalSebelumnya').html(data.tanggalSebelumnya);
                $('#tanggalSekarang').html(data.tanggal);

                $('#beratBadanSebelumnya').html(': '+data.beratBadanSebelumnya+" kg");
                $('#tinggiBadanSebelumnya').html(': '+data.tinggiBadanSebelumnya+' cm');
                $('#lingkarKepalaSebelumnya').html(': '+data.lingkarKepalaSebelumnya+' cm');

                $('#beratBadanSekarang').html(': '+data.beratBadan+" kg");
                $('#tinggiBadanSekarang').html(': '+data.tinggiBadan+' cm');
                $('#lingkarKepalaSekarang').html(': '+data.lingkarKepala+' cm');

                $('#riwayatImunisasi').html(data.riwayatImunisasi);
                $('#riwayatKesehatan').html(data.riwayatKesehatan);     
              }
            }
        });
    })

</script>