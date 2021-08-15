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
          <h2>Menu Pembayaran</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <?php echo validation_errors(); ?>
          <form class="form-horizontal form-label-left" id="form_pembayaran" action="<?php echo site_url('Pembayaran/simpan') ?>" method="POST">
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
            </div>
            <div class="item form-group">
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
            </div>
            <div class="item form-group" id="divTampil">
              <label class="control-label col-sm-4" for="anak">Paket saat ini
              </label>
              <div class="col-md-3">
                  <input type="text" class="form-control" disabled="" value="">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-sm-4" for="anak">Ganti Paket</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <label class="radio-inline"> 
                    <input type="radio" name="gantikah" id="yaGanti" value="Ya"/>
                    Ya
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="gantikah" id="tidakGanti" value="Tidak" checked=""/>
                    Tidak
                  </label>
                </div>
            </div>
            <div class="item form-group" id="divGantiPaket" style="display: none;">
              <label class="control-label col-sm-4" for="paket">Paket
              </label>
              <div class="col-md-3">
                <select class="form-control" id="paket" name="paket">                  
                  <?php foreach($paket as $value): ?>
                    <option value="<?php echo $value['Id']; ?>"><?php echo $value['Nama']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-sm-4" for="harian">Harian</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <label class="radio-inline"> 
                    <input type="radio" name="harian" id="yaHarian" value="Ya"/>
                    Ya
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="harian" id="tidakHarian" value="Tidak" checked=""/>
                    Tidak
                  </label>
              </div>
            </div>
            <div class="item form-group" id="divHarian" style="display: none;">
              <label class="control-label col-sm-4" for="paket">Jumlah Hari
              </label>
              <div class="col-md-2">
                <input type="number" class="form-control" id="jumlahHari" name="jumlahHari">
              </div>
            </div>
            <!-- <div class="item form-group">
              <label class="control-label col-sm-4" for="jumlahBayar">Jumlah Bayar <span class="required">*</span>
              </label>
              <div class="col-md-3">
                 <input type="text" class="form-control harga_format" id="jumlahBayar" placeholder="" required>
                 <input type="hidden" name="jumlah_bayar" id="jumlah_bayar" value="0">
              </div>
            </div> -->
            <textarea style="display: none;" id="tampilan" name="tampilan"></textarea>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-4 col-md-offset-5">
                <button id="generate" type="submit" class="btn btn-primary">Generate</button>
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
          <!-- <h2>Tampilan</h2> -->
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <?php echo validation_errors(); ?>
          <div class="table-responsive col-sm-10 col-sm-offset-1">
            <table id="table_bahan" class="table table-bordered table-hover text-center">
              <thead>
                <tr>
                  <th colspan="4" id="label_tanggal" style="text-align: center;"></th>
                </tr>
                <tr>
                  <th class="col-sm-1" style="text-align: center;">No</th>
                  <th class="col-sm-4" style="text-align: center;">Nama</th>
                  <th class="col-sm-3" style="text-align: center;">Sub total</th>
                  <th class="col-sm-2" style="text-align: center;">Total</th>
                </tr>
              </thead>
              <tbody id="tbody">
                  
              </tbody>
            </table>
          </div>
          <div class="clearfix"></div>
          <div class="ln_solid"></div>
          <div class="col-md-4 col-md-offset-5">
            <button id="simpan" type="submit" form="form_pembayaran" class="btn btn-success col-md-3" disabled="">Simpan</button>
          </div>

        </div>
      </div>
    </div>
  </div>

</div>

<script>
    var gantikah='Tidak';
    var hariankah='Tidak';
    $(document).ready(function() {
        $('#datatable-responsive').DataTable({
            responsive: true
        });
        $('[data-toggle="modal"]').tooltip();
        $('input[type=radio][name=gantikah]').change(function() {
          gantikah = this.value;
          if (this.value == 'Ya') {
              document.getElementById('divGantiPaket').style.display ='block';
          }
          else if (this.value == 'Tidak') {
              document.getElementById('divGantiPaket').style.display ='none';   
          }
        });
        $('input[type=radio][name=harian]').change(function() {
          hariankah = this.value;
          if (this.value == 'Ya') {
              document.getElementById('divHarian').style.display ='block';
          }
          else if (this.value == 'Tidak') {
              document.getElementById('divHarian').style.display ='none';   
          }
        });
    });
    $('#tanggal_awal').datetimepicker({
        format: 'DD-MM-YYYY'
    });
    $('#tanggal_akhir').datetimepicker({
        format: 'DD-MM-YYYY',
        /*date: new Date(<?php echo strtotime(date("Y-m-d")); ?>)*/
    });

    // Selector
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()

    });
    $(document).on('input','.harga_format',function(){
      $(this).priceFormat({
          prefix: 'Rp. ',
          centsSeparator: ',',
          thousandsSeparator: '.'
      });
    });
     $(document).on('change','.harga_format',function(){
        var biaya = $(this).unmask();
        biaya = biaya.substring(1, biaya.length-2);
        biaya = parseInt(biaya);

        var rowid = $(this).data('rowid');

        $.ajax({
          url : '<?php echo site_url("Pembayaran/update_biaya"); ?>',
          method : 'POST',
          data : {
            'biaya' : biaya,
            'rowid' : rowid,
          },
          success : function(data){
            $('#tdGrandTotal').html(data);
          },
        });

    });
    $('.harga_format').priceFormat({
        prefix: 'Rp. ',
        centsSeparator: ',',
        thousandsSeparator: '.'
    });
    $(document).on('change','#bulan',function(){
      var bulan = $(this).val();

      $.ajax({
        url : '<?php echo site_url("Pembayaran/anak_notin_pembayaran"); ?>',
        method : 'POST',
        data : {'bulan' : bulan},
        success : function(data){
          $('#anak').html(data);
        }
      });
    });
    $(document).on('change','#jumlahBayar', function(){
        var biaya = $(this).unmask();
        biaya = biaya.substring(1, biaya.length-2);
        biaya = parseInt(biaya);

        document.getElementById('jumlah_bayar').value=biaya;
    });
    $(document).on('change','#anak',function(){
      var id_anak = $(this).val();

      $.ajax({
        url : '<?php echo site_url("Pembayaran/tampil_paket"); ?>',
        method : 'POST',
        data : {'id_anak' : id_anak},
        success : function(data){
          $('#divTampil').html(data);
          document.getElementById('simpan').disabled = true;
        },
      });
    });
    $('#generate').on('click',function(event){
        event.preventDefault();
        var bulan = $('#bulan').val();
        var id_anak = $('#anak').val();
        var paket = $('#paket').val();
        var jumlah_hari = $('#jumlahHari').val();
        
        $.ajax({
          url : '<?php echo site_url("Pembayaran/tampil_pembayaran"); ?>',
          method : 'POST',
          data : {
            'bulan' : bulan,
            'id_anak' : id_anak,
            'gantikah' : gantikah,
            'hariankah' : hariankah,
            'paket' : paket,
            'jumlah_hari' : jumlah_hari,
          },
          success : function(data){
            $('#tbody').html(data);
            if(bulan=="01")
              bulan='Januari';
            else if(bulan=="02")
              bulan = 'Febuari';
            else if(bulan=="03")
              bulan = 'Maret';
            else if(bulan=="04")
              bulan = 'April';
            else if(bulan=="05")
              bulan = 'Mei';
            else if(bulan=="06")
              bulan = 'Juni';
            else if(bulan=="07")
              bulan = 'Juli';
            else if(bulan=="08")
              bulan = 'Agustus';
            else if(bulan=="09")
              bulan = 'September';
            else if(bulan=="10")
              bulan = 'Oktober';
            else if(bulan=="11")
              bulan = 'November';
            else
              bulan = 'Desember';
            $('#label_tanggal').html('Bulan '+bulan);
            $('#tampilan').val(data);
            document.getElementById('simpan').disabled =false;
          }
        });
    });

</script>