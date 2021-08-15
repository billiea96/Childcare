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
          <h2>Master Detail Paket Katering</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <?php echo validation_errors(); ?>
          <form class="form-horizontal form-label-left" id="form_paket_katering" action="" method="POST">
            <div class="item form-group">
              <label class="control-label col-sm-4" for="Paket">Paket
              </label>
              <div class="col-md-3">
                <input type="text" class="form-control" name="" value="<?php echo $paket['Nama'] ?>" disabled>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-3 col-xs-12" for="Tanggal">Tanggal
              </label>
              <div class="col-md-3 col-sm-6 col-xs-12">
                <input type="text" required="" class="form-control" id="Tanggal" name="Tanggal" value="<?php echo $paket['Tanggal'] ?>" disabled>
                <span class="fa fa-calendar form-control-feedback right" aria-hidden="false"></span>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-sm-4" for="Nama">Nama
              </label>
              <div class="col-md-3">
                <input type="text" class="form-control" name="Nama" id="Nama">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-sm-4" for="Bahan">Bahan
              </label>
              <div class="col-md-4">
                <textarea rows="4" required="required" id="Bahan" name="Bahan" class="form-control"></textarea>
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-7 col-md-offset-4">
                <button id="tambah" type="button" class="btn btn-primary col-md-6"><i class="fa fa-plus"></i></button>
              </div>
            </div>
            
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Daftar Detail Katering</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="table-responsive col-sm-12">
            <table id="table_bahan" class="table table-bordered table-hover table-striped text-center">
              <div align="right">
                  <button type="button" class="btn btn-warning" id="clear">Clear</button>
              </div>
              <thead>
                <tr>
                  <th class="col-sm-1" style="text-align: center;">No</th>
                  <th class="col-sm-2" style="text-align: center;">Nama</th>
                  <th class="col-sm-6" style="text-align: center;">Bahan</th>
                  <th class="col-sm-2" style="text-align: center;">Aksi</th>
                </tr>
              </thead>
              <tbody id="tbody">

              </tbody>
            </table>
          </div>
          <div class="clearfix"></div>
          <div class="ln_solid"></div>
          <form id="form_paket_detail" action="<?php echo site_url('PaketKatering/simpan_detail_katering'); ?>" method="POST">
            <div class="form-group">
              <div class="col-md-5 col-md-offset-11">
                <button id="tambah" type="submit" class="btn btn-success col-md-2">Simpan</button>
                <input type="hidden" name="Paket" value="<?php echo $paket['Id']; ?>">
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>

<script>
    document.getElementById('Nama').focus();
    /*$('#Tanggal').datetimepicker({
        format: 'DD-MM-YYYY'
    });
    $('.tanggal').datetimepicker({
        format: 'DD-MM-YYYY'
    });*/
    $(document).on('click','#tambah', function(){
        
        var nama = document.getElementById('Nama').value;
        var bahan = document.getElementById('Bahan').value;

         $.ajax({
            url: "<?php echo site_url('PaketKatering/tambah_detail'); ?>",
            method: "POST",
            data:{
              'nama':nama,
              'bahan':bahan,
            },
            success:function(data)
            {
                $('#tbody').html(data);
            }   
        });

        document.getElementById('Nama').value ="";
        document.getElementById('Bahan').value="";
        document.getElementById('Nama').focus();
    });
    $(document).on('click','.hapus',function(){
        var rowid = $(this).attr('id');
        $.ajax({
          url : "<?php echo site_url('PaketKatering/hapus_detail'); ?>",
          method : "POST",
          data :{
            'rowid':rowid
          },
          success:function(data){
            $('#tbody').html(data);
          }
        });
    });
    $('#tbody').load('<?php echo site_url("PaketKatering/load_detail") ?>');
    $(document).on('click','#clear',function(){
        if(confirm('Anda yakin ingin menghapus semua?')){
            $.ajax({
              url : "<?php echo site_url('PaketKatering/clear_detail'); ?>",
              method : "POST",
              success : function(data){
                $('#tbody').html(data);
              }
            });
        }
        else{
          return false;
        }
    });
</script>