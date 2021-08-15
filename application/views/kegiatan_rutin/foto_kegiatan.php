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
          <h2>Foto Kegiatan Rutin</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <?php echo validation_errors(); ?>
          <form class="form-horizontal form-label-left" id="form_foto_kegiatan_rutin" action="" method="POST">
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

  <div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2 id='judul'>Tampil Foto</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content" id="content">

          <!-- <?php foreach ($foto as $key => $value) { ?>
            <div class="col-sm-4">
              <a download="<?php echo $value['NamaFoto'] ?>" href="<?php echo base_url(); ?>public/foto_perkembangan/<?php echo $value['Anak_Id']; ?>/<?php echo $value['NamaFoto'] ?>" title="ImageName">
                <img height="150" class="img-responsive img-rounded" width="200" src="<?php echo base_url(); ?>public/foto_perkembangan/<?php echo $value['Anak_Id']; ?>/<?php echo $value['NamaFoto'] ?>">
              </a>
            </div>
          <?php } ?> -->


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
    $(document).ready(function() {
        $('[data-toggle="modal"]').tooltip();
        /*$('#mytable').DataTable({
              responsive: true,
        });*/
    });
    $('#tanggal_awal').datetimepicker({
        format: 'DD-MM-YYYY'
    });
    $('#tanggal_akhir').datetimepicker({
        format: 'DD-MM-YYYY'
    });

    
    $('#generate').on('click',function(event){
        event.preventDefault();
        var kegiatan = $('#kegiatan').val();
        var tanggal_awal = $('#tanggal_awal').val();
        var tanggal_akhir = $('#tanggal_akhir').val();

        $.ajax({
          url : '<?php echo site_url("KegiatanRutinAnak/tampil_foto"); ?>',
          method : 'POST',
          data : {
            'kegiatan' : kegiatan,
            'tanggal_awal' : tanggal_awal,
            'tanggal_akhir' : tanggal_akhir,
          },
          success : function(data){
            $('#content').html(data);
          },
          error : function(){
            alert('hmm');
          }
        });

    });


</script>