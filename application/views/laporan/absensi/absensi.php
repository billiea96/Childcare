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
          <h2>Laporan Absensi</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <?php echo validation_errors(); ?>
          <form class="form-horizontal form-label-left" id="form_laporan_absensi" action="<?php echo site_url('Laporan/laporan_absensi') ?>" method="POST">
            <div class="item form-group">
              <label class="control-label col-sm-2" for="noHP">Anak <span class="required">*</span>
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
            <div class="form-group">
              <label class="control-label col-md-2 col-sm-3 col-xs-12" for="tanggal_awal">Tanggal Awal<span class="required">*</span>
              </label>
              <div class="col-md-3">
                <input type="text" required="" class="form-control" id="tanggal_awal" name="tanggal_awal">
                <span class="fa fa-calendar form-control-feedback right" aria-hidden="false"></span>
              </div>
              <label class="control-label col-md-2 col-sm-3 col-xs-12" for="tanggal_akhir">Tanggal Akhir<span class="required">*</span>
              </label>
              <div class="col-md-3">
                <input type="text" required="" class="form-control" id="tanggal_akhir" name="tanggal_akhir">
                <span class="fa fa-calendar form-control-feedback right" aria-hidden="false"></span>
              </div>
            </div>

            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-4 col-md-offset-5">
                <button id="generate" type="submit" class="btn btn-md btn-primary">Generate</button>
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
    $('#tanggal_awal').datetimepicker({
        format: 'DD-MM-YYYY'
    });
    $('#tanggal_akhir').datetimepicker({
        format: 'DD-MM-YYYY'
    });
    $(document).on('change','#anak',function(){
      var id_anak = $(this).val();

      $.ajax({
        url: '<?php echo site_url("Pembayaran/set_tanggal"); ?>',
        method: 'POST',
        data : {'id_anak':id_anak},
        dataType:'JSON',
        success:function(data){
          $('#tanggal_awal').val(data.tanggal_awal);
          $('#tanggal_akhir').val(data.tanggal_akhir);
        }
      });
    });

    // Selector
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()

    });

</script>