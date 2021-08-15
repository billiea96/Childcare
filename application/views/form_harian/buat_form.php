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
          <h2>Buat Form Harian</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <?php echo validation_errors(); ?>
          <form class="form-horizontal form-label-left" id="form_buat_form" action="<?php echo site_url('FormHarian/tambah_form') ?>" method="POST">
            <h4 style="text-align: right;"><strong><?php echo date('D, d-m-Y'); ?></strong></h4>
            <?php if($_SESSION['hak_akses']=='ADMIN'){?>
              <div class="item form-group">
              <label class="control-label col-sm-4" for="pengasuh">Pengasuh <span class="required">*</span>
              </label>
              <div class="col-md-3">
                <select class="form-control select2" id="pengasuh" name="pengasuh" required="">
                  <option></option>
                  <?php foreach($karyawan as $value): ?>
                    <option value="<?php echo $value['Id']; ?>"><?php echo $value['Nama']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <?php } ?>  
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
                <input type="number" class="form-control" name="suhuBadanDatang" id="suhuBadanDatang" required="">
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
            <div class="form-group">
              <div class="col-md-4 col-md-offset-5">
                <button id="simpan" type="submit" class="btn btn-success">simpan</button>
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