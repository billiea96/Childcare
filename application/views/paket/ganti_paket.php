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
          <h2>Menu Ganti Paket</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
              <div class="table-responsive table-striped text-center col-sm-10 col-sm-offset-1">          
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th class="col-sm-1" style="text-align: center;">No</th>
                      <th class="col-sm-2" style="text-align: center;">Nama</th>
                      <th class="col-sm-2" style="text-align: center;">Biaya</th>
                      <th class="col-sm-2" style="text-align: center;">Batas Jam</th>
                      <th class="col-sm-3" style="text-align: center;">Keterangan</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php 
                      $counter=0;
                      foreach ($paket as $key => $value) { ?>
                      <tr>
                        <td><?php $counter++; echo $counter; ?></td>
                        <td><?php echo $value['Nama']; ?></td>
                        <td>Rp. <?php echo number_format($value['Biaya'], 0, ",", "."); ?></td>
                        <td><?php echo DateTime::createFromFormat('H:i:s', $value['MaxJam'])->format('H:i'); ?></td>
                        <td><?php echo $value['Keterangan']; ?></td>
                        <?php } ?>
                  </tbody>
                </table>
              </div>

          <?php echo validation_errors(); ?>
          <form class="form-horizontal form-label-left" id="form_ganti_paket" action="<?php echo site_url('Paket/simpan_ganti_paket') ?>" method="POST">
            <div class="item form-group">
              <label class="control-label col-sm-2" for="anak">Anak <span class="required">*</span>
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
            <div class="item form-group" id="divTampil">
              
            </div>
            <div class="item form-group">
              <label class="control-label col-sm-2" for="paket">Paket <span class="required">*</span>
              </label>
              <div class="col-md-3">
                <select class="form-control select2" id="paket" name="paket" required="">
                  <option></option>
                  <?php foreach($paket as $value): ?>
                    <option value="<?php echo $value['Id']; ?>"><?php echo $value['Nama']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <!-- <div class="form-group">
              <label class="control-label col-md-2 col-sm-3 col-xs-12" for="tanggal_awal">Tanggal Mulai Berlaku<span class="required">*</span>
              </label>
              <div class="col-md-3">
                <input type="text" required="" class="form-control" id="tanggal_awal" name="tanggal_awal">
                <span class="fa fa-calendar form-control-feedback right" aria-hidden="false"></span>
              </div>
            </div> -->
            
            <!-- <div class="item form-group">
              <label class="control-label col-sm-4" for="jumlahBayar">Jumlah Bayar <span class="required">*</span>
              </label>
              <div class="col-md-3">
                 <input type="text" class="form-control harga_format" id="jumlahBayar" placeholder="" required>
                 <input type="hidden" name="jumlah_bayar" id="jumlah_bayar" value="0">
              </div>
            </div> -->
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
    $(document).ready(function() {
        $('#datatable-responsive').DataTable({
            responsive: true
        });
        $('[data-toggle="modal"]').tooltip();
    });

    // Selector
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()

    });
    $('.harga_format').priceFormat({
        prefix: 'Rp. ',
        centsSeparator: ',',
        thousandsSeparator: '.'
    });
    $(document).on('change','#anak',function(){
      var id_anak = $(this).val();

      $.ajax({
        url : '<?php echo site_url("Paket/tampil_paket"); ?>',
        method : 'POST',
        data : {'id_anak' : id_anak},
        success : function(data){
          $('#divTampil').html(data);
        },
      });
    });

</script>