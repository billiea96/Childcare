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
          <h2>Catatan Minum Susu</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <?php echo validation_errors(); ?>
          <form class="form-horizontal form-label-left" id="form_catatan_minum_susu" action="<?php echo site_url('FormHarian/tambah_catatan_minum_susu') ?>" method="POST">
            <h4 style="text-align: right;"><strong><?php echo date('D, d-m-Y'); ?></strong></h4>
            <div class="item form-group">
              <label class="control-label col-sm-2" for="jamMulaiTidur">Waktu <span class="required">*</span>
              </label>
              <div class="col-md-2">
                <input type="time" name="waktu" id="waktu" class="form-control" required="">
              </div>
              <label class="control-label col-sm-1" for="cc">CC <span class="required">*</span>
              </label>
              <div class="col-md-2">
                <input type="number" name="cc" id="cc" class="form-control" required="">
              </div>
            </div>
            <!-- <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-4 col-md-offset-5">
                <button id="tambah" type="button" class="btn btn-lg btn-success">tambah</button>
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
          <h2>Daftar Anak</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <?php echo validation_errors(); ?>
          <div class="table-responsive col-sm-12">
            <table id="datatable-responsive" class="table table-bordered table-hover text-center">
              <div align="right">
                  <button type="button" class="btn btn-warning" id="pilihSemua"">Pilih Semua</button>
              </div>
              <thead>
                <tr>
                  <th class="col-sm-1" style="text-align: center;">No</th>
                  <th class="col-sm-4" style="text-align: center;">Anak</th>
                  <th class="col-sm-6" style="text-align: center;">Keterangan</th>
                  <th class="col-sm-1" style="text-align: center;">Pilih</th>
                </tr>
              </thead>
              <tbody id="tbody">
                  <?php echo $tampil; ?>
              </tbody>
            </table>
          </div>
          <div class="clearfix"></div>
          <div class="ln_solid"></div>
          <div class="col-md-4 col-md-offset-10">
            <button id="simpan" type="submit" form="form_catatan_minum_susu" class="btn btn-success col-md-3">Simpan</button>
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
    $(document).on('click','#pilihSemua',function(){
      var temp =document.getElementsByClassName('keterangan');
      $('.pilih').prop("checked", true);
      for(i=0;i<temp.length;i++){
        temp[i].disabled= false;
      }
    });   
    $(document).on('change','.pilih',function(){
      var id = $(this).attr('id');
      if(this.checked){
        document.getElementById('keterangan'+id).disabled = false;
      }else{
        document.getElementById('keterangan'+id).disabled = true;
      } 


    });
      

</script>