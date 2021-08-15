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
          <h2>Kegiatan Non Rutin Anak</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <?php echo validation_errors(); ?>
          <form class="form-horizontal form-label-left" id="form_kegiatan_non_rutin_anak" action="<?php echo site_url('KegiatanNonRutinAnak/add') ?>" method="POST" enctype="multipart/form-data">
            <!-- <div class="item form-group">
              <label class="control-label col-sm-4" for="anak">Anak <span class="required">*</span>
              </label>
              <div class="col-md-3">
                <select class="form-control select2" id="anak" name="anak" required="">
                  <option></option>
                  <?php foreach($anak as $value): ?>
                    <option value="<?php echo $value['Id']; ?>"><?php echo $value['Nama']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div> -->
            <div class="item form-group">
              <label class="control-label col-sm-2" for="kegiatan">Kegiatan <span class="required">*</span>
              </label>
              <div class="col-md-3">
                <select class="form-control select2" id="kegiatan" name="kegiatan" required="">
                  <option></option>
                  <?php foreach($kegiatan as $value): ?>
                    <option value="<?php echo $value['Id']; ?>"><?php echo $value['Nama']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
               <label class="control-label col-md-1 col-sm-3 col-xs-12" for="tanggal">Tanggal <span class="required">*</span>
              </label>
              <div class="col-md-3 col-sm-6 col-xs-12">
                <input type="text" required="" class="form-control" id="tanggal" name="tanggal">
                <span class="fa fa-calendar form-control-feedback right" aria-hidden="false"></span>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">
                  Foto (Bisa pilih lebih dari 1 foto)
              </label>
              <div class="col-sm-8">
                  <span class="btn btn-default btn-file">
                      <input id="foto" name="foto[]" type="file" class="file" multiple data-show-upload="true" data-show-caption="true" accept="image/*">
                  </span>
              </div>
            </div>
            <!-- <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-4 col-md-offset-7">
                <button id="simpan" type="submit" class="btn btn-success">simpan</button>
              </div>
            </div> -->
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- END ROW -->

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
                  <th class="col-sm-6" style="text-align: center;">Catatan</th>
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
            <button id="simpan" type="submit" form="form_kegiatan_non_rutin_anak" class="btn btn-success col-md-3">Simpan</button>
          </div>

        </div>
      </div>
    </div>
  </div>

</div>

<script>
    $(document).ready(function() {
        $('#datatable-responsive').DataTable({
            responsive: true,
            "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
            "iDisplayLength": 25
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