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
          <h2>Master Paket</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <?php echo validation_errors(); ?>
          <form class="form-horizontal form-label-left" id="form_paket" action="<?php echo site_url('paket/add') ?>" method="POST">
            <div class="item form-group">
              <label class="control-label col-sm-4" for="nama">Nama <span class="required">*</span>
              </label>
              <div class="col-md-4">
                <input id="nama" class="form-control" name="nama" required="required" type="text">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-sm-4" for="nama">Biaya <span class="required">*</span>
              </label>
              <div class="col-md-3">
                 <input type="text" class="form-control harga_format" id="biayaFormat" placeholder="" required>
                 <input type="hidden" name="biaya" id="biaya" value="0">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-sm-4" for="maxJam">Batas Jam Jemput <span class="required">*</span>
              </label>
              <div class="col-md-2">
                <div class='input-group date' id='jamMulai'>
                  <input type='time' name='maxJam' class="form-control" required="" />
                  <span class="input-group-addon">
                     <span class="glyphicon glyphicon-time"></span>
                  </span>
                </div>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-sm-4" for="keterangan">Keterangan </span>
              </label>
              <div class="col-md-4">
                <textarea rows="5" id="keterangan" name="keterangan" class="form-control"></textarea>
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-4 col-md-offset-7">
                <button id="simpan" type="submit" class="btn btn-success">simpan</button>
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
          <h2>Daftar Paket</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <table id="datatable-responsive" class="table table-bordered table-hover table-striped text-center" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th class="col-sm-1" style="text-align: center;">No</th>
                <th class="col-sm-2" style="text-align: center;">Nama</th>
                <th class="col-sm-2" style="text-align: center;">Biaya</th>
                <th class="col-sm-2" style="text-align: center;">Batas Jam</th>
                <th class="col-sm-3" style="text-align: center;">Keterangan</th>
                <th class="col-sm-2" style="text-align: center;">Edit</th>
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
                <td>
                  <div class="btn-group">
                      <button onclick="" class="btn btn-default btn-xs" name="buttonUpdate<?php echo $value['Id']; ?>" id="buttonUpdate<?php echo $value['Id']; ?>" type="button" data-toggle="modal" data-target="#myModalUpdate<?php echo $value['Id']; ?>" title="UBAH">
                          <i class="fa fa-pencil-square-o"></i>
                      </button>
                      <button onclick="" class="btn btn-default btn-xs" name="buttonDelete<?php echo $value['Id']; ?>" id="buttonDelete<?php echo $value['Id']; ?>" type="button" data-toggle="modal" data-target="#myModalDelete<?php echo $value['Id']; ?>" title="HAPUS">
                          <i class="fa fa-trash"></i>
                      </button>
                  </div>
                </td>                
              </tr>
              <!-- Modal Untuk Update -->
              <div id="myModalUpdate<?php echo $value['Id']; ?>" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-lg">
                      <!-- Modal content-->
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Edit Data Paket</h4>
                          </div>
                          <div class="modal-body">
                              <div class="row">
                                  <div class="col-sm-12 table-responsive">
                                      <?php echo validation_errors(); ?>
                                      <form class="form-horizontal form-label-left" id="formUpdate<?php echo $value['Id']; ?>" action="<?php echo site_url('Paket/edit'); ?>" method="POST">
                                          <div class="col-sm-offset-10 col-sm-1"></div><br>
                                          <div class="col-sm-8 col-sm-offset-2">
                                                  <input type="hidden" class="form-control" name="id_paket" id="id_paket" value="<?php echo $value['Id']; ?>">
                                                     
                                                  <div class="item form-group">
                                                    <label style="text-align: right;" class="control-label col-md-4" for="nama">Nama :
                                                    </label>
                                                    <div class="col-md-6">
                                                      <input id="nama" class="form-control" name="nama" required="required" type="text" value="<?php echo $value['Nama'] ?>">
                                                    </div>
                                                  </div><div class="clearfix"></div><br>
                                                  <div class="item form-group">
                                                    <label style="text-align: right;" class="control-label col-md-4" for="biaya">Biaya :
                                                    </label>
                                                    <div class="col-md-6">
                                                      <input class="form-control harga_format" id="biayaFormat<?php echo $value['Id'] ?>" required="required" type="text" value="<?php echo number_format($value['Biaya'], 2, ",", "."); ?>">
                                                      <input type="hidden" id="biaya<?php echo $value['Id'] ?>" name="biaya" value="<?php echo $value['Biaya'] ?>">
                                                    </div>
                                                  </div><div class="clearfix"></div><br>
                                                  <div class="item form-group">
                                                    <label style="text-align: right;" class="control-label col-md-4" for="maxJam">Batas Jam :
                                                    </label>
                                                    <div class="col-md-6">
                                                      <input id="maxJam" class="form-control" name="maxJam" required="required" type="text" value="<?php echo DateTime::createFromFormat('H:i:s', $value['MaxJam'])->format('H:i'); ?>">
                                                    </div>
                                                  </div><div class="clearfix"></div><br>
                                                  <div class="item form-group">
                                                    <label style="text-align: right;" class="control-label col-md-4" for="keterangan">Keterangan :</label>
                                                    <div class="col-md-7">
                                                      <textarea rows="5" id="keterangan" required="required" name="keterangan" class="form-control" ><?php echo $value['Keterangan'] ?></textarea>
                                                    </div>
                                                  </div><div class="clearfix"></div>
                                          </div>
                                      </form>
                                  </div>
                              </div>
                          </div>
                          <div class="modal-footer">
                              <div class="col-sm-12">
                                  <div class="col-sm-offset-10 col-sm-1">
                                      <input class="btn btn-success btn-md" type="submit" id="simpan" name="simpan" value="Simpan" form="formUpdate<?php echo $value['Id']; ?>">
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <script type="text/javascript">
                $(document).on('change','#biayaFormat<?php echo $value["Id"]; ?>', function(){
                    var biaya = $(this).unmask();
                    biaya = biaya.substring(1, biaya.length-2);
                    biaya = parseInt(biaya);

                    document.getElementById('biaya<?php echo $value["Id"];?>').value=biaya;
                });
              </script>

              <!-- Modal Untuk Delete -->
              <div id="myModalDelete<?php echo $value['Id']; ?>" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                      <!-- Modal content-->
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Hapus Data Paket</h4>
                          </div>
                          <div class="modal-body">
                              <div class="row">
                                  <div class="col-sm-12 table-responsive">
                                      <?php echo validation_errors(); ?>
                                      <form class="form-horizontal" id="formDelete<?php echo $value['Id']; ?>" action="<?php echo site_url('Paket/delete'); ?>" method="POST">
                                          <div class="col-sm-8 col-sm-offset-2">
                                              <h3 style="text-align: center;" for="newID">
                                                  <i class="fa fa-warning fa-fw" style="color: tomato;"></i>
                                                  <b>Anda yakin ingin menghapus paket ini?</b>
                                              </h3><br>
                                              <input type="hidden" class="form-control" name="id_paket" id="id_paket"  value="<?php echo $value['Id']; ?>">
                                          </div>
                                      </form>
                                  </div>
                              </div>
                          </div>
                          <div class="modal-footer">
                              <div class="col-sm-12">
                                  <div class="col-sm-offset-8 col-sm-4">
                                      <button type="button" class="btn btn-default btn-md" data-dismiss="modal">Cancel</button>
                                      <input class="btn btn-danger btn-md" type="submit" id="simpan" name="simpan" value="Hapus" form="formDelete<?php echo $value['Id']; ?>">
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

              <?php } ?>
            </tbody>
          </table>


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
    $('.harga_format').priceFormat({
        prefix: 'Rp. ',
        centsSeparator: ',',
        thousandsSeparator: '.'
    });
    $(document).on('change','#biayaFormat', function(){
        var biaya = $(this).unmask();
        biaya = biaya.substring(1, biaya.length-2);
        biaya = parseInt(biaya);

        document.getElementById('biaya').value=biaya;
    });
</script>