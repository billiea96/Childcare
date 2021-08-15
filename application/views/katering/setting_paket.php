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
    <div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2">
      <div class="x_panel">
        <div class="x_title">
          <h2>Setting Harga Paket Katering</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <?php echo validation_errors(); ?>
          <form class="form-horizontal form-label-left" id="form_pembayaran" action="<?php echo site_url('PaketKatering/simpan_setting') ?>" method="POST">
            <div class="form-group">
              <label class="control-label col-md-5 col-sm-3 col-xs-12" for="paket1">PAKET 1
              </label>
              <div class="col-md-3">
                <input type="text" required="" class="form-control harga_format" id="formatHarga1" name="formatHarga1" value="<?php echo $setting[0]['Harga'] ?>00">
                <input type="hidden" name="paket1" id="paket1" value="<?php echo $setting[0]['Harga'] ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-5 col-sm-3 col-xs-12" for="paket2">PAKET 2
              </label>
              <div class="col-md-3">
                <input type="text" required="" class="form-control harga_format" id="formatHarga2" name="formatHarga2" value="<?php echo $setting[1]['Harga'] ?>00">
                <input type="hidden" name="paket2" id="paket2" value="<?php echo $setting[1]['Harga'] ?>">
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-4 col-md-offset-5">
                <button id="simpan" type="submit" class="btn btn-success">Simpan</button>
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
    $('.harga_format').priceFormat({
        prefix: 'Rp. ',
        centsSeparator: ',',
        thousandsSeparator: '.'
    });
    $(document).on('change','#formatHarga1', function(){
        var biaya = $(this).unmask();
        biaya = biaya.substring(1, biaya.length-2);
        biaya = parseInt(biaya);

        document.getElementById('paket1').value=biaya;
    });
    $(document).on('change','#formatHarga2', function(){
        var biaya = $(this).unmask();
        biaya = biaya.substring(1, biaya.length-2);
        biaya = parseInt(biaya);

        document.getElementById('paket2').value=biaya;
    });

</script>