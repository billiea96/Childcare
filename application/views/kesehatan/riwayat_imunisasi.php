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
          <h2>Imunisasi</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <?php echo validation_errors(); ?>
          <form class="form-horizontal form-label-left" id="form_imunisasi" action="<?php echo site_url('RiwayatImunisasi/add') ?>" method="POST">
            <div class="item form-group">
              <label class="control-label col-sm-4" for="noHP">Anak <span class="required">*</span>
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
              <label class="control-label col-sm-4" for="noHP">Vaksinasi <span class="required">*</span>
              </label>
              <div class="col-md-3">
                <select class="form-control select2" id="vaksinasi" name="vaksinasi" required="">
                  <option></option>
                  <?php foreach($vaksinasi as $value): ?>
                    <option value="<?php echo $value['Id']; ?>"><?php echo $value['Nama']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <!-- <div class="form-group">
              <label class="control-label col-md-4 col-sm-3 col-xs-12" for="tanggal">Tanggal <span class="required">*</span>
              </label>
              <div class="col-md-3">
                <input type="text" required="" class="form-control" id="tanggal" name="tanggal">
                <span class="fa fa-calendar form-control-feedback right" aria-hidden="false"></span>
              </div>
            </div> -->
            <div class="item form-group">
              <label class="control-label col-sm-4" for="keterangan">Keterangan </span>
              </label>
              <div class="col-md-4">
                <textarea rows="3" id="keterangan" name="keterangan" class="form-control"></textarea>
              </div>
            </div>

            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-4 col-md-offset-7">
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