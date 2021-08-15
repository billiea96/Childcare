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
          <h2>Catatan BAB</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <?php echo validation_errors(); ?>
          <form class="form-horizontal form-label-left" id="form_catatan_bab" action="<?php echo site_url('FormHarian/tambah_catatan_bab') ?>" method="POST">
            <h4 style="text-align: right;"><strong><?php echo date('D, d-m-Y'); ?></strong></h4>
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
            <div class="ln_solid"></div>
            <div class="item form-group">
              <label class="control-label col-sm-4" for="waktu">Waktu <span class="required">*</span>
              </label>
              <div class="col-md-2">
                <input type="time" name="waktu" id="waktu" class="form-control">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-sm-4" for="keterangan">Keterangan <span class="required">*</span>
              </label>
              <div class="col-md-4">
                <textarea class="form-control" rows="3" name="keterangan" id="keterangan"></textarea>
              </div>
            </div>
            <div class="item form-group">
              
            </div>

            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-4 col-md-offset-5">
                <button id="tambah" type="button" class="btn btn-lg btn-success">tambah</button>
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
          <h2>Daftar BAB</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <?php echo validation_errors(); ?>
          <div class="table-responsive col-sm-12">
            <table id="table_bahan" class="table table-bordered table-hover text-center">
              <div align="right">
                  <button type="button" class="btn btn-warning" id="clear" style="display: none;">Clear</button>
              </div>
              <thead>
                <tr>
                  <th class="col-sm-1" style="text-align: center;">No</th>
                  <th class="col-sm-2" style="text-align: center;">Waktu</th>
                  <th class="col-sm-8" style="text-align: center;">Keterangan</th>
                  <th class="col-sm-1" style="text-align: center;">Aksi</th>
                </tr>
              </thead>
              <tbody id="tbody">

              </tbody>
            </table>
          </div>
          <div class="clearfix"></div>
          <div class="ln_solid"></div>
          <div class="col-md-4 col-md-offset-10">
            <button id="simpan" type="submit" form="form_catatan_bab" class="btn btn-success col-md-3">Simpan</button>
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

    $(document).on('click','#tambah',function(){
        var waktu = $('#waktu').val();
        var keterangan = $('#keterangan').val();

        $.ajax({
          url : '<?php echo site_url("FormHarian/tambah_daftar_bab"); ?>',
          method : 'POST',
          data:{
            'waktu':waktu,
            'keterangan' : keterangan,
          },
          success: function(data){
            $('#tbody').html(data);
          }
        });

    });
    $(document).on('click','.remove',function(){
        var rowid = $(this).attr('id');

        $.ajax({
          url : '<?php echo site_url("FormHarian/hapus_daftar_bab"); ?>',
          method : 'POST',
          data:{
            'rowid':rowid,
          },
          success: function(data){
            $('#tbody').html(data);
          }
        });

    });

</script>