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


  <?php if(isset($output)){ ?>
  <div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Tagihan Pembayaran <?php 
              switch (date('m')) {
                case '01':
                  echo 'Januari';
                  break;
                case '02':
                  echo 'Febuari';
                  break;
                case '03':
                  echo 'Maret';
                  break;
                case '04':
                  echo 'April';
                  break;
                case '05':
                  echo 'Mei';
                  break;
                case '06':
                  echo 'Juni';
                  break;
                case '07':
                  echo 'Juli';
                  break;
                case '08':
                  echo 'Agustus';
                  break;
                case '09':
                  echo 'September';
                  break;
                case '10':
                  echo 'Oktober';
                  break;
                case '11':
                  echo 'November';
                  break;
                case '12':
                  echo 'Desember';
                  break;
                default:
                  # code...
                  break;
              }
              echo ' '.date('Y');
            ?> </h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <?php echo validation_errors(); ?>
          <div class="table-responsive col-sm-8 col-sm-offset-2">
            <table id="table_bahan" class="table table-bordered table-hover text-center">
              <thead>
                <tr>
                  <th class="col-sm-1" style="text-align: center;">No</th>
                  <th class="col-sm-4" style="text-align: center;">Nama</th>
                  <th class="col-sm-3" style="text-align: center;">Total</th>
                </tr>
              </thead>
              <tbody id="tbody">
                  <?php echo $output; ?>
              </tbody>
            </table>
          </div>
          <div class="clearfix"></div>
          <div class="ln_solid"></div>
          <!-- <div class="col-md-4 col-md-offset-5">
            <button id="simpan" type="submit" form="form_pembayaran" class="btn btn-success col-md-3" disabled="">Simpan</button>
          </div> -->

        </div>
      </div>
    </div>
  </div>
  <?php }else{ ?>
  <div class="alert alert-info alert-dismissible fade in" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
    <center><strong>TIDAK ADA TAGIHAN</strong></center>
  </div>
  <?php }?>

</div>

<script>
    
</script>