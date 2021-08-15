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

  <?php if(isset($_SESSION['info'])) { ?>
  <div class="alert alert-info alert-dismissible fade in" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
    <strong><?php echo $_SESSION['info']; ?></strong>
  </div>
  <?php unset($_SESSION['info']); ?>
  <?php } ?>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Perkembangan Anak</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <?php echo validation_errors(); ?>
          <form class="form-horizontal form-label-left" id="form_catatan_perkembangan" action="<?php echo site_url('CatatanPerkembangan/add') ?>" method="POST" enctype="multipart/form-data">
            <div class="item form-group">
              <label class="control-label col-sm-4" for="anak">Nama <span class="required">*</span>
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
              <label class="control-label col-sm-4" for="usia">Usia <span class="required">*</span>
              </label>
              <div class="col-md-1">
                <input type="text" class="form-control" name="usia" id="usia" disabled="">
              </div>
              <label class="control-label col-sm-1" style="padding-left: 0; text-align: left;">Tahun</label>
            </div>
            <!-- <div class="item form-group">
              <label class="control-label col-sm-4" for="anak">Aspek <span class="required">*</span>
              </label>
              <div class="col-md-3">
                <select class="form-control select2" id="kategori" name="kategori" required="">
                  <option></option>
                  <?php foreach($kategori as $value): ?>
                    <option value="<?php echo $value['Id']; ?>"><?php echo $value['Nama']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div> -->

            <!-- <div class="item form-group">
              <label class="control-label col-sm-4" for="indikator">Indikator/Uraian <span class="required">*</span>
              </label>
              <div class="col-md-4">
                <textarea rows="3" id="indikator" required="required" name="indikator" class="form-control"></textarea>
              </div>
            </div> -->
          </form>
          <!-- <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-4 col-md-offset-5">
              <button id="tambah" name="tambah" class="btn btn-info" disabled="">Tambahkan</button>
            </div>
          </div> -->
        </div>
      </div>
    </div>
  </div>

  <div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="col-md-12 table-responsive">
            <!-- <div align="right">
                <button type="button" class="btn btn-warning" id="clear">Clear</button>
            </div> -->
            <table id="table" class="table table-bordered table-hover text-center" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th class="col-md-3" style="text-align: center;">Aspek</th>
                  <th class="col-md-5" style="text-align: center;">Uraian</th>
                  <th class="col-md-1" style="text-align: center;">K</th>
                  <th class="col-md-1" style="text-align: center;">C</th>
                  <th class="col-md-1" style="text-align: center;">M</th>
                </tr>
              </thead>
              <tbody id="tbody">
                <?php echo $tampil; ?>
              </tbody>
            </table>
          </div>


        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <?php echo validation_errors(); ?>
          <form class="form-horizontal form-label-left" >
            <div class="item form-group">
              <label class="control-label col-sm-4" for="indikator">Simpulan dan saran <span class="required">*</span>
              </label>
              <div class="col-md-5">
                <textarea form="form_catatan_perkembangan" rows="5" id="kesimpulanSaran" required="required" name="kesimpulanSaran" class="form-control"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-4 control-label">
                  Foto (Bisa pilih lebih dari 1 foto)
              </label>
              <div class="col-sm-8">
                  <span class="btn btn-default btn-file">
                      <input form="form_catatan_perkembangan" id="foto" name="foto[]" type="file" class="file" multiple data-show-upload="true" data-show-caption="true" accept="image/*">
                  </span>
              </div>
            </div>
          </form>

          <div class="clearfix"></div>
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-4 col-md-offset-6">
              <button id="simpan" name="simpan" form="form_catatan_perkembangan" class="btn btn-success">Simpan</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<script>
    // Selector
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()

    });

    $(document).on('change','#anak', function(){
      var id = this.value;

      $.ajax({

        url : '<?php echo site_url("Anak/hitungUsia"); ?>',
        method : 'POST',
        data : {'id':id},
        dataType : 'json',
        success : function(data){
          document.getElementById('usia').value = data;
        },
        error : function(){
          alert('error');
        }
      });
    });

    $(document).on('change','#kategori',function(){
      document.getElementById('tambah').disabled = false;
    });

    $(document).on('click','#tambah',function(){
      var idKategori = document.getElementById('kategori').value;

      $.ajax({

        url : '<?php echo site_url('CatatanPerkembangan/set_uraian') ?>',
        method : 'POST',
        data : {'idKategori':idKategori},
        success : function(data){
          $('#tbody').html(data);
        },
        error : function(){

        }
      });
    });

    $(document).on('click','.hapus', function(){
      var row_id = $(this).attr("id");

      $.ajax({
        url : "<?php echo site_url('CatatanPerkembangan/remove_aspek'); ?>",
        method : 'POST',
        data : {'row_id':row_id},
        success : function(data){
          $('#tbody').html(data);
        },
        error:function(){

        }
      });
    });

    $(document).on('click','#clear', function(){

      $.ajax({
        url : "<?php echo site_url('CatatanPerkembangan/clear_aspek'); ?>",
        method : 'POST',
        data : {},
        success : function(data){
          $('#tbody').html(data);
        },
        error:function(){

        }
      });
    });

</script>