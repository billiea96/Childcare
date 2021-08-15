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
          <h2>Master Kegiatan Rutin</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <?php echo validation_errors(); ?>
          <form class="form-horizontal form-label-left" id="form_kegiatan_rutin" action="<?php echo site_url('KegiatanRutin/add') ?>" method="POST">
            <div class="item form-group">
              <label class="control-label col-sm-4" for="nama">Nama <span class="required">*</span>
              </label>
              <div class="col-md-4">
                <input id="nama" class="form-control" name="nama" required="required" type="text">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-sm-4" for="jamMulai">Jam Mulai <span class="required">*</span>
              </label>
              <div class="col-md-2">
                <div class='input-group date' id='jamMulai'>
                  <input type='text' name='jamMulai' placeholder="00:00" format='HH:mm' class="form-control" required="" />
                  <span class="input-group-addon">
                     <span class="glyphicon glyphicon-time"></span>
                  </span>
                </div>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-sm-4" for="jamSelesai">Jam Selesai <span class="required">*</span>
              </label>
              <div class="col-md-2">
                <div class='input-group date' id='jamSelesai'>
                  <input type='text' name='jamSelesai' placeholder="00:00" format='HH:mm' class="form-control" required="" />
                  <span class="input-group-addon">
                     <span class="glyphicon glyphicon-time"></span>
                  </span>
                </div>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-sm-4" for="hari">Hari <span class="required">*</span>
              </label>
              <div class="col-md-6">
                <div class="col-md-3">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" id="senin" name="senin" class="flat"> Senin
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" id="selasa" name="selasa" class="flat" > Selasa
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" id="rabu" name="rabu" class="flat"> Rabu
                    </label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" id="kamis" name="kamis" class="flat"> Kamis
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" id="jumat" name="jumat" class="flat"> Jumat
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" id="sabtu" name="sabtubtu" class="flat"> Sabtu
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-sm-4" for="detailKegiatan">Detail Kegiatan <span class="required">*</span>
              </label>
              <div class="col-md-4">
                <textarea rows="5" required="required" id="detailKegiatan" name="detailKegiatan" class="form-control"></textarea>
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
          <h2>Daftar Kegiatan Rutin</h2>
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
                <th class="col-sm-2" style="text-align: center;">Hari</th>
                <th class="col-sm-1" style="text-align: center;">Jam Mulai</th>
                <th class="col-sm-1" style="text-align: center;">Jam Selesai</th>
                <th class="col-sm-4" style="text-align: center;">Detail Kegiatan</th>
                <th class="col-sm-2" style="text-align: center;">Edit</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $counter=0;
              foreach ($kegiatan as $key => $value) { ?>
              <tr>
                <td><?php $counter++; echo $counter; ?></td>
                <td><?php echo $value['Nama'] ?></td>
                <td><?php echo $value['Hari'] ?></td>
                <td><?php echo $value['JamMulai'] ?></td>
                <td><?php echo $value['JamSelesai'] ?></td>
                <td><?php echo $value['DetailKegiatan'] ?></td>
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
                              <h4 class="modal-title">Edit Data Kegiatan Rutin</h4>
                          </div>
                          <div class="modal-body">
                              <div class="row">
                                  <div class="col-sm-12 table-responsive">
                                      <?php echo validation_errors(); ?>
                                      <form class="form-horizontal form-label-left" id="formUpdate<?php echo $value['Id']; ?>" action="<?php echo site_url('KegiatanRutin/edit'); ?>" method="POST">
                                          <div class="col-sm-offset-10 col-sm-1"></div><br>
                                          <div class="col-sm-8 col-sm-offset-2">
                                                  <div class="item form-group">
                                                      <label style="text-align: right;" class="control-label col-md-4" for="id_kegiatan">ID Kegiatan :</label>
                                                      <div class="col-md-2">
                                                          <input type="text" class="form-control" value="<?php echo $value['Id']; ?>" disabled>
                                                          <input type="hidden" class="form-control" name="id_kegiatan" id="id_kegiatan" value="<?php echo $value['Id']; ?>">
                                                      </div>
                                                  </div><div class="clearfix"></div><br>
                                                  <div class="item form-group">
                                                    <label style="text-align: right;" class="control-label col-md-4" for="nama">Nama :
                                                    </label>
                                                    <div class="col-md-6">
                                                      <input id="nama" class="form-control" name="nama" required="required" type="text" value="<?php echo $value['Nama'] ?>">
                                                    </div>
                                                  </div><div class="clearfix"></div><br>
                                                  <div class="item form-group">
                                                    <label style="text-align: right;" class="control-label col-md-4" for="jamMulai">Jam Mulai :
                                                    </label>
                                                    <div class="col-md-6">
                                                      <input id="jamMulai" class="form-control" name="jamMulai" required="required" type="text" value="<?php echo $value['JamMulai'] ?>">
                                                    </div>
                                                  </div><div class="clearfix"></div><br>
                                                  <div class="item form-group">
                                                    <label style="text-align: right;" class="control-label col-md-4" for="jamSelesai">Jam Selesai :
                                                    </label>
                                                    <div class="col-md-6">
                                                      <input id="jamSelesai" class="form-control" name="jamSelesai" required="required" type="text" value="<?php echo $value['JamSelesai'] ?>">
                                                    </div>
                                                  </div><div class="clearfix"></div><br>
                                                  <div class="item form-group">
                                                    <label style="text-align: right;" class="control-label col-md-4" for="hari">Hari :
                                                    </label>
                                                    <div class="col-md-6">
                                                      <input id="hari" class="form-control" name="hari" required="required" type="text" value="<?php echo $value['Hari'] ?>">
                                                    </div>
                                                  </div><div class="clearfix"></div><br>
                                                  <div class="item form-group">
                                                    <label style="text-align: right;" class="control-label col-md-4" for="detailKegiatan">Detail Kegiatan :</label>
                                                    <div class="col-md-7">
                                                      <textarea rows="5" id="detailKegiatan" required="required" name="detailKegiatan" class="form-control" ><?php echo $value['DetailKegiatan'] ?></textarea>
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

              <!-- Modal Untuk Delete -->
              <div id="myModalDelete<?php echo $value['Id']; ?>" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                      <!-- Modal content-->
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Hapus Data Kegiatan Rutin</h4>
                          </div>
                          <div class="modal-body">
                              <div class="row">
                                  <div class="col-sm-12 table-responsive">
                                      <?php echo validation_errors(); ?>
                                      <form class="form-horizontal" id="formDelete<?php echo $value['Id']; ?>" action="<?php echo site_url('KegiatanRutin/delete'); ?>" method="POST">
                                          <div class="col-sm-8 col-sm-offset-2">
                                              <h3 style="text-align: center;" for="newID">
                                                  <i class="fa fa-warning fa-fw" style="color: tomato;"></i>
                                                  <b>Anda yakin ingin menghapus data Kegiatan Rutin ini?</b>
                                              </h3><br>
                                              <input type="hidden" class="form-control" name="id_kegiatan" id="id_kegiatan"  value="<?php echo $value['Id']; ?>">
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

    $('#jamMulai').datetimepicker({
        format: 'HH:mm'
    });

    $('#jamSelesai').datetimepicker({
        format: 'HH:mm'
    });

</script>