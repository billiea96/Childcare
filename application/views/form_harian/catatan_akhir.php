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
          <h2>Catatan Akhir</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <?php echo validation_errors(); ?>
          <form class="form-horizontal form-label-left" id="form_catatan_akhir" action="<?php echo site_url('FormHarian/tambah_catatan_akhir') ?>" method="POST">
            <h4 style="text-align: right;"><strong><?php echo date('D, d-m-Y'); ?></strong></h4>
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
            <div class="item form-group">
              <label class="control-label col-sm-4" for="potongKuku">Potong kuku
              </label>
              <div class="col-md-4">
                <textarea class="form-control" rows="2" id="potongKuku" name="potongKuku"></textarea>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-sm-4" for="catatanKhusus">Catatan Khusus dari Mom-Ku
              </label>
              <div class="col-md-4">
                <textarea class="form-control" rows="4" id="catatanKhusus" name="catatanKhusus"></textarea>
              </div>
            </div>
            <!-- <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-4 col-md-offset-5">
                <button id="tambah" type="button" class="btn btn-lg btn-success">tambah</button>
              </div>
            </div> -->
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
          <h2>Barang Yang Harus Dibawa</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <?php echo validation_errors(); ?>
          <div class="table-responsive col-sm-12">
            <table id="table_bahan" class="table table-bordered table-hover text-center">
              <div align="right">
                  <button type="button" class="btn btn-warning" id="pilihSemua"">Pilih Semua</button>
              </div>
              <thead>
                <tr>
                  <th class="col-sm-2" style="text-align: center;">Nama</th>
                  <th class="col-sm-3" style="text-align: center;">Keterangan</th>
                  <th class="col-sm-1" style="text-align: center;">Pilih</th>
                  <th class="col-sm-2" style="text-align: center;">Nama</th>
                  <th class="col-sm-3" style="text-align: center;">Keterangan</th>
                  <th class="col-sm-1" style="text-align: center;">Pilih</th>
                </tr>
              </thead>
              <tbody id="tbody">
                  <tr>
                    <td>Popok(pampers)</td>
                    <td><textarea form="form_catatan_akhir" class="form-control keterangan" id="keterangan0" name="keterangan0" disabled></textarea></td>
                    <td><input form="form_catatan_akhir" type="checkbox" name="barang[]" class="pilih" id="0" value="Popok"></td>

                    <td>Minyak kayu putih</td>
                    <td><textarea form="form_catatan_akhir" class="form-control keterangan" id="keterangan1" name="keterangan1" disabled></textarea></td>
                    <td><input form="form_catatan_akhir" type="checkbox" name="barang[]" class="pilih" id="1" value="Minyak kayu putih"></td>  
                  </tr>
                  <tr>
                    <td>Minyak telon</td>
                    <td><textarea form="form_catatan_akhir" class="form-control keterangan" id="keterangan2" name="keterangan2" disabled></textarea></td>
                    <td><input form="form_catatan_akhir" type="checkbox" name="barang[]" class="pilih" id="2" value="Minyak telon"></td>

                    <td>Sabun</td>
                    <td><textarea form="form_catatan_akhir" class="form-control keterangan" id="keterangan3" name="keterangan3" disabled></textarea></td>
                    <td><input form="form_catatan_akhir" type="checkbox" name="barang[]" class="pilih" id="3" value="Sabun"></td>  
                  </tr>
                  <tr>
                    <td>Shampo</td>
                    <td><textarea form="form_catatan_akhir" class="form-control keterangan" id="keterangan4" name="keterangan4" disabled></textarea></td>
                    <td><input form="form_catatan_akhir" type="checkbox" name="barang[]" class="pilih" id="4" value="Shampo"></td>

                    <td>Bedak</td>
                    <td><textarea form="form_catatan_akhir" class="form-control keterangan" id="keterangan5" name="keterangan5" disabled></textarea></td>
                    <td><input form="form_catatan_akhir" type="checkbox" name="barang[]" class="pilih" id="5" value="Bedak"></td>  
                  </tr>
                  <tr>
                    <td>Tisu basah</td>
                    <td><textarea form="form_catatan_akhir" class="form-control keterangan" id="keterangan6" name="keterangan6" disabled></textarea></td>
                    <td><input form="form_catatan_akhir" type="checkbox" name="barang[]" class="pilih" id="6" value="Tisu basah"></td>

                    <td>Hair lotion</td>
                    <td><textarea form="form_catatan_akhir" class="form-control keterangan" id="keterangan7" name="keterangan7" disabled></textarea></td>
                    <td><input form="form_catatan_akhir" type="checkbox" name="barang[]" class="pilih" id="7" value="Hari lotion"></td>  
                  </tr>
                  <tr>
                    <td>Baby oil</td>
                    <td><textarea form="form_catatan_akhir" class="form-control keterangan" id="keterangan8" name="keterangan8" disabled></textarea></td>
                    <td><input form="form_catatan_akhir" type="checkbox" name="barang[]" class="pilih" id="8" value="Baby oil"></td>

                    <td></td>
                    <td></td>
                    <td></td>  
                  </tr>
              </tbody>
            </table>
          </div>
          <form class="form-horizontal form-label-left">
            <div class="item form-group">
              <label class="control-label col-sm-2" for="barangLain">Barang lain
              </label>
              <div class="col-md-3">
                <input form="form_catatan_akhir" type="text" class="form-control" id="barangLain" name="barangLain">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-sm-2" for="keteranganLain">Keterangan
              </label>
              <div class="col-md-4">
                <textarea form="form_catatan_akhir" class="form-control" rows="2" id="keteranganLain" name="keteranganLain"></textarea>
              </div>
            </div>
          </form>
          <div class="clearfix"></div>
          <div class="ln_solid"></div>
          <div class="col-md-4 col-md-offset-10">
            <button id="simpan" type="submit" form="form_catatan_akhir" class="btn btn-success col-md-3">Simpan</button>
          </div>

        </div>
      </div>
    </div>
  </div>

</div>

<script>
    $(document).ready(function() {
        $('#datatable-responsive').DataTable({
            responsive: true
        });
        $('[data-toggle="modal"]').tooltip();
    });
    $('#tanggal').datetimepicker({
        format: 'DD-MM-YYYY'
    });

    // Selector
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()

    });
    $(document).on('click','#pilihSemua',function(){
      var temp =document.getElementsByClassName('keterangan');
      $('.pilih').prop("checked", true);
      for(i=0;i<temp.length;i++){
        temp[i].disabled= false;
      }
    });   
    $(document).on('change','.pilih',function(){
      var id = $(this).attr('id');
      if(this.checked){
        document.getElementById('keterangan'+id).disabled = false;
      }else{
        document.getElementById('keterangan'+id).disabled = true;
      } 


    });
      

</script>