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
          <h2>Foto Perkembangan</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <?php echo validation_errors(); ?>
          <form class="form-horizontal form-label-left" id="form_foto_perkembangan" action="<?php echo site_url('Riwayat/index'); ?>" method="POST">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-3 col-xs-12" for="bulan">Bulan<span class="required">*</span>
              </label>
              <div class="col-md-2 col-sm-6 col-xs-12">
                <select class="form-control" id="bulan" name="bulan" required="">
                    <option></option>
                    <option value="01">Januari</option>
                    <option value="02">Febuari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>
              </div>
              <div class="col-md-2 col-sm-6 col-xs-12">
                <input type="text" required="" class="form-control" id="tahun" value="<?php echo date('Y'); ?>" name="tanggal">
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
          <h2 id='judul'>Tampil Foto <?php echo date('m-d-Y',strtotime($foto[0]['Tanggal'])); ?></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content" id="content">

          <?php foreach ($foto as $key => $value) { ?>
            <div class="col-sm-4">
              <a download="<?php echo $value['NamaFoto'] ?>" href="<?php echo base_url(); ?>public/foto_perkembangan/<?php echo $value['Anak_Id']; ?>/<?php echo $value['NamaFoto'] ?>" title="ImageName">
                <img height="150" class="img-responsive img-rounded" width="300" src="<?php echo base_url(); ?>public/foto_perkembangan/<?php echo $value['Anak_Id']; ?>/<?php echo $value['NamaFoto'] ?>">
              </a>
            </div>
          <?php } ?>


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
    $('#tahun').datetimepicker({
        format: 'YYYY',
    });

    
    $('#generate').on('click',function(event){
        event.preventDefault();
        var bulan = $('#bulan').val();
        var tahun = $('#tahun').val();

        $.ajax({
          url : '<?php echo site_url("CatatanPerkembangan/tampil_foto"); ?>',
          method : 'POST',
          data : {
            'bulan' : bulan,
            'tahun' : tahun,
          },
          dataType : 'json',
          success : function(data){
            $('#content').html(data.output);
            $('#judul').html('Tampil Foto '+data.Tanggal);
            
          },
          error : function(){
            alert('hmm');
          }
        });

    });


</script>