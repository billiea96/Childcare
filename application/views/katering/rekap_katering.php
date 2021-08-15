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
          <h2>REKAP KATERING</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <form class="form-horizontal form-label-left" id="form_rekap_katering" action="<?php echo site_url('DaftarKatering/cetak_rekap') ?>" method="POST">
            <div class="item form-group">
              <label class="control-label col-sm-4" for="namaPaket">Bulan <span class="required">*</span>
              </label>
              <div class="col-md-3">
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
              <input type="hidden" name="temp_paket" id="temp_paket" value="1">
            </div>
          </form> 

          <div class="ln_solid"></div>
          <div class="col-md-3 col-sm-offset-5">
              <button type="button" class="btn btn-primary" id="btnGenerate"  title="Generate">Generate</button>
          </div>
          
        </div>
      </div>
    </div>
  </div>

   <div class="row" id="daftar_paket">
   <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>DAFTAR PESANAN</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <div class="table-responsive col-sm-12">
            <table id="datatable-responsive" class="table table-bordered table-hover text-center">
              <thead>
                <tr>
                  <th class="col-sm-1" style="text-align: center;">No</th>
                  <th class="col-sm-4" style="text-align: center;">Tanggal</th>
                  <th class="col-sm-4" style="text-align: center;">Nama</th>
                  <th class="col-sm-2" style="text-align: center;">Jumlah</th>
                </tr>
              </thead>
              <tbody id="tbody">

              </tbody>
            </table>
          </div>

          <div class="clearfix"></div>
          <div class="ln_solid"></div>
          <div>
                <button type="submit" form="form_rekap_katering" class="btn btn-default col-sm-12" id="btnCetak"  title="cetak" disabled="">CETAK</button>
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

        });
        $('[data-toggle="modal"]').tooltip();

    });
    
    $(document).on('click','#btnGenerate',function(){
      var bulan = $('#bulan').val();

      $.ajax({
        url : '<?php echo site_url("DaftarKatering/tampil_rekap"); ?>',
        method : 'POST',
        data : {'bulan' : bulan},
        success : function(data){
          $('#tbody').html(data);
          if(data!='')
          document.getElementById('btnCetak').disabled = false;
        }
      });
    });
</script>