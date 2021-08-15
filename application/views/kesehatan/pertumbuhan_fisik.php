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
          <h2>Pertumbuhan Fisik</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <?php echo validation_errors(); ?>
          <form class="form-horizontal form-label-left" id="form_pertumbuhan_fisik" action="<?php echo site_url('PertumbuhanFisik/add') ?>" method="POST">
            <?php if($_SESSION['hak_akses']=='ADMIN') {?>
              <div class="item form-group">
              <label class="control-label col-sm-4" for="perawat">Perawat <span class="required">*</span>
              </label>
              <div class="col-md-3">
                <select class="form-control select2" id="perawat" name="perawat" required="">
                  <option></option>
                  <?php foreach($karyawan as $value): ?>
                    <option value="<?php echo $value['Id']; ?>"><?php echo $value['Nama']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <?php } ?>
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
              <label class="control-label col-sm-4" for="nama">Berat badan <span class="required">*</span>
              </label>
              <div class="col-md-3">
                <input id="beratBadan" class="form-control" name="beratBadan" required="required" type="number" step=".01">
                <span class="form-control-feedback right" aria-hidden="true">kg</span>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-sm-4" for="nama">Tanggi badan <span class="required">*</span>
              </label>
              <div class="col-md-3">
                <input id="tinggiBadan" class="form-control" name="tinggiBadan" required="required" type="number" step=".01">
                <span class="form-control-feedback right" aria-hidden="true">cm</span>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-sm-4" for="nama">Lingkar kepala <span class="required">*</span>
              </label>
              <div class="col-md-3">
                <input id="lingkarKepala" class="form-control" name="lingkarKepala" required="required" type="number" step=".01">
                <span class="form-control-feedback right" aria-hidden="true">cm</span>
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
   <div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Daftar pertumbuhan anak dalam 1 tahun terakhir</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="table-responsive col-sm-12">
            <table id="table_bahan" class="table table-bordered table-hover text-center">
              <div align="right">
                  <button type="button" class="btn btn-warning" id="clear" style="display: none;">Clear</button>
              </div>
              <thead>
                <tr>
                  <th class="col-sm-1" style="text-align: center;">No</th>
                  <th class="col-sm-2" style="text-align: center;">Usia</th>
                  <th class="col-sm-2" style="text-align: center;">Tanggal</th>
                  <th class="col-sm-2" style="text-align: center;">Berat badan</th>
                  <th class="col-sm-2" style="text-align: center;">Tinggi badan</th>
                  <th class="col-sm-2" style="text-align: center;">Lingkar kepala</th>
                </tr>
              </thead>
              <tbody id="tbody">

              </tbody>
            </table>
          </div>
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

    $('#anak').on('change',function(){
        var id = $(this).val();

        $.ajax({
            url : '<?php echo site_url("PertumbuhanFisik/daftar_pertumbuhan"); ?>',
            method : 'POST',
            data : {'id_anak':id},
            success : function(data){
              $('#tbody').html(data);
            }
        });
    })

</script>