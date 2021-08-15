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
          <h2>PAKET KATERING</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <?php echo validation_errors(); ?>
          <form class="form-horizontal form-label-left" id="" action="" method="POST">
            <div class="item form-group">
              <label class="control-label col-sm-1" for="namaPaket">Paket <span class="required">*</span>
              </label>
              <div class="col-md-4">
                <select class="form-control" id="namaPaket" name="namaPaket" required="">
                    <option value="1">PAKET 1 (Makan pagi)</option>
                    <option value="2">PAKET 2 (makan siang & sore)</option>
                </select>
              </div>
              <input type="hidden" name="temp_paket" id="temp_paket" value="1">
            </div>
          </form> 
          <div class="ln_solid"></div>
          <div id="paket1"><?php echo $calendar; ?></div>
          <div id="paket2" style="display: none;"><?php echo $calendar2; ?></div> 

          <div class="ln_solid"></div>
          <div align="center">
              <button type="button" class="btn btn-warning" id="btnPilihSemua" data-toggle="modal" data-target="#modalPesanSebulan" title="Pesan Sebulan">Pesan Semua Dalam Sebulan</button>
          </div>
          
        </div>
      </div>
    </div>
  </div>

  <div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Order Katering</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <?php echo validation_errors(); ?>
          <form class="form-horizontal form-label-left" id="form_daftar_katering" action="<?php echo site_url('DaftarKatering/add'); ?>" method="POST">
            <?php if($_SESSION['hak_akses']=='ADMIN') {?>
            <div class="item form-group">
              <label class="control-label col-sm-1" for="anak">Anak <span class="required">*</span>
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
           <?php }else{?>
            <input type="hidden" name="anak" id="anak" value="<?php echo $_SESSION['id']; ?>">
            <?php } ?>
          </form>
          <br>
          <div class="table-responsive col-sm-12">
            <table id="myTable" class="table table-bordered table-hover text-center">
              <div align="right">
                  <button type="button" class="btn btn-warning" id="clear" style="display: none;">Clear</button>
              </div>
              <thead>
                <tr>
                  <th class="col-sm-1" style="text-align: center;">No</th>
                  <th class="col-sm-3" style="text-align: center;">Nama</th>
                  <th class="col-sm-2" style="text-align: center;">Jumlah</th>
                  <th class="col-sm-3" style="text-align: center;">Tanggal</th>
                  <th class="col-sm-3" style="text-align: center;">Aksi</th>
                </tr>
              </thead>
              <tbody id="tbody">

              </tbody>
            </table>
          </div>
          <div class="clearfix"></div>
          <div class="ln_solid"></div>
          <div class="col-md-4 col-md-offset-10">
            <button id="simpan" type="submit" form="form_daftar_katering" class="btn btn-success col-md-3">Simpan</button>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Detail Bahan dari setiap makanan</h4>
      </div>
      <div class="modal-body" id="modal_body">
      </div>
      <div class="clearfix"></div>
      <div class="modal-footer" id="modal_footer">
        
      </div>
    </div>
  </div>
</div>

<!-- Modal Untuk Pesan Dalam Sebulan-->
<div class="modal fade" id="modalPesanSebulan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Pesan Katering Dalam Sebulan</h4>
      </div>
      <div class="modal-body" id="modal_body">
        <form class="form-horizontal form-label-left" id="" action="" method="POST">
            <div class="item form-group">
              <label class="control-label col-sm-4" for="namaPaket">Hari <span class="required">*</span>
              </label>
              <div class="col-md-5">
                <select class="form-control" id="hari" name="hari" required="">
                    <option></option>
                    <option value="1">Senin-Jumat</option>
                    <!-- <option value="2">Senin-Sabtu</option> -->
                </select>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-sm-4" for="namaPaket">Bulan <span class="required">*</span>
              </label>
              <div class="col-md-5">
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
          </form> 
      </div>
      <div class="clearfix"></div>
      <div class="modal-footer" id="modal_footer">
        <button type="button" class="btn btn-md btn-default" data-dismiss="modal">cancel</button>
        <button type="button" class="btn btn-md btn-success" id="btnOrderSebulan" data-dismiss="modal">order</button>
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
        $('#datatable-responsive').DataTable({
            responsive: true
        });
        $('[data-toggle="modal"]').tooltip();

    });
    $(document).on('change','#namaPaket',function(){
      var id= $(this).val();
      if(id==1){
        document.getElementById('paket1').style.display ='block';
        document.getElementById('paket2').style.display ='none';
        document.getElementById('temp_paket').value =1;
      }else{
        document.getElementById('paket1').style.display ='none';
        document.getElementById('paket2').style.display ='block';
        document.getElementById('temp_paket').value =2;
      }
    });
    $('.calendar .day').click(function(){
        var day_num = $(this).find('.day_num').html();
        var temp_paket = document.getElementById('temp_paket').value;

        if(temp_paket==1){
          $.ajax({
            url: '<?php echo site_url("DaftarKatering/show_detail"); ?>',
            method: 'POST',
            data : {
              'day':day_num,
              'year':<?php echo $year; ?>,
              'month' :<?php echo $month;?>
            },
            dataType : 'json',
            success: function(data){
              $('#modal_body').html(data.body);
              $('#modal_footer').html(data.footer);
              $('#myModal').modal('toggle'); 
            },
            error:function(){

            }
          });
        }else{
          $.ajax({
            url: '<?php echo site_url("DaftarKatering/show_detail2"); ?>',
            method: 'POST',
            data : {
              'day':day_num,
              'year':<?php echo $year; ?>,
              'month' :<?php echo $month;?>
            },
            dataType : 'json',
            success: function(data){
              $('#modal_body').html(data.body);
              $('#modal_footer').html(data.footer);
              $('#myModal').modal('toggle'); 
            },
            error:function(){

            }
          });
        }
    });
    $(document).on('click','.order',function(){
      var id_paket = $(this).data('paketid');
      var id_anak = $('#anak').val();
      var jumlah = $('#jumlah'+id_paket).val();

      $.ajax({
          url : "<?php echo site_url('DaftarKatering/order_katering'); ?>",
          method : "POST",
          data : {'id_paket' : id_paket,'id_anak' :id_anak, 'jumlah' : jumlah},
          dataType : "json",
          success : function(data){
            $('#tbody').html(data);
          },
          error : function(){
            alert('error');
          }
      });

    });
    $(document).on('click','.remove',function(){
      var row_id = $(this).attr('id');

      $.ajax({
          url : "<?php echo site_url('DaftarKatering/remove_order'); ?>",
          method : "POST",
          data : {'row_id':row_id},
          dataType : 'json',
          success : function(data){
            $('#tbody').html(data);
          },
          error : function(){

          }
      });
    });
    $(document).on('click','#btnOrderSebulan',function(){
      var hari = $('#hari').val();
      var bulan = $('#bulan').val();

      $.ajax({
        url : "<?php echo site_url('DaftarKatering/order_sebulan'); ?>",
        method : "POST",
        data : {
          'hari' : hari,
          'bulan' : bulan,
        },
        dataType : 'json',
        success : function(data){
          $('#tbody').html(data);
        },
        error : function(){
          alert('s');
        }
      });
    });
    $(document).on('change','.qty',function(){
      var rowid = $(this).data('rowid');
      var value = $(this).val();
      
      $.ajax({
        url : '<?php echo site_url("DaftarKatering/update_jumlah"); ?>',
        method : 'POST',
        data : {'rowid' : rowid,'value' : value},
        dataType : 'json',
        success : function(data){
          /*$('#tbody').html(data);*/
        }
      });
    });
  
</script>