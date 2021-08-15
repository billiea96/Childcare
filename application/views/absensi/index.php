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
          <h2>Absensi</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <?php echo validation_errors(); ?>
          <form method="post" id="import_csv" enctype="multipart/form-data">
            <div class="col-md-3 col-md-offset-4">
              <div class="item form-group">
                <center><label>Select CSV File</label></center>

                <input class="form-control" type="file" name="csv_file" id="csv_file" required accept=".csv" />
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-3 col-md-offset-4">
                <center><button id="btn_import"  type="submit" class="btn btn-md btn-success">Import Csv</button></center>
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
          <h2>Daftar Absensi</h2>
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
              <thead>
                <tr>
                  <th class="col-sm-1" style="text-align: center;">No</th>
                  <th class="col-sm-2" style="text-align: center;">Nama</th>
                  <th class="col-sm-2" style="text-align: center;">Jam Datang</th>
                  <th class="col-sm-2" style="text-align: center;">Jam Pulang</th>
                  <th class="col-sm-2" style="text-align: center;">Tanggal</th>
                </tr>
              </thead>
              <tbody id="tbody">

              </tbody>
            </table>
          </div>
          <div class="clearfix"></div>
          <div class="ln_solid"></div>
          <?php echo validation_errors(); ?>
          <form class="form-horizontal form-label-left" id="form_absensi" action="<?php echo site_url('Absensi/add') ?>" method="POST">
            <div class="col-md-4 col-md-offset-10">
              <button id="simpan" type="submit" class="btn btn-success col-md-3">Simpan</button>
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
    $('#csv_file').on('click',function(){
      $('#btn_import').html('Import csv');
    });
    $('#import_csv').on('submit', function(event){
        event.preventDefault();

        $.ajax({
          url:"<?php echo site_url('Absensi/import'); ?>",
          method:"POST",
          data:new FormData(this),
          contentType:false,
          cache:false,
          processData:false,
          beforeSend:function(){
            $('#btn_import').html('Importing......');
          },
          success:function(data){
            $('#import_csv')[0].reset();
            $('#btn_import').attr('disabled',false);
            $('#btn_import').html('Import Done');

            $('#tbody').html(data);
          }

        });
    });

</script>