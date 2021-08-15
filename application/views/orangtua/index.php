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
          <h2>Daftar Orangtua</h2>
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
                <th class="col-sm-2" style="text-align: center;">Ayah</th>
                <th class="col-sm-2" style="text-align: center;">Ibu</th>
                <th class="col-sm-2" style="text-align: center;">No HP Ayah</th>
                <th class="col-sm-2" style="text-align: center;">No HP Ibu</th>
                <th class="col-sm-2" style="text-align: center;">Status</th>
                <th class="col-sm-4" style="text-align: center;">Alamat Rumah Ayah</th>
                <th class="col-sm-4" style="text-align: center;">Alamat Rumah Ibu</th>
                <th class="col-sm-4" style="text-align: center;">Alamat Kerja Ayah</th>
                <th class="col-sm-4" style="text-align: center;">Alamat Kerja Ibu</th>
                <th class="col-sm-1" style="text-align: center;">Jam Kerja Ayah</th>
                <th class="col-sm-1" style="text-align: center;">Jam Kerja Ibu</th>
                <th class="col-sm-2" style="text-align: center;">No Telp Rumah Ayah</th>
                <th class="col-sm-2" style="text-align: center;">No Tepl Rumah Ibu</th>
                <th class="col-sm-2" style="text-align: center;">No Tempat Kerja Ayah</th>
                <th class="col-sm-2" style="text-align: center;">No Tempat Kerja Ibu</th>
                <th class="col-sm-2" style="text-align: center;">Edit</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $counter=0;
              foreach ($orangtua as $key => $value) { ?>
              <tr>
                <td><?php $counter++; echo $counter; ?></td>
                <td><?php echo $value['NamaAyah'] ?></td>
                <td><?php echo $value['NamaIbu'] ?></td>
                <td><?php echo $value['NoHPAyah'] ?></td>
                <td><?php echo $value['NoHPIbu'] ?></td>
                <td>
                  <?php switch ($value["Hapus?"]) {
                    case 0:
                      echo "AKTIF";
                      break;
                    case 1:
                      echo "TIDAK AKTIF";
                      break;
                    
                    default:
                      # code...
                      break;
                  } ?>
                  
                </td>
                <td><?php echo $value['AlamatRumahAyah'] ?></td>
                <td><?php echo $value['AlamatRumahIbu'] ?></td>
                <td><?php echo $value['AlamatKerjaAyah'] ?></td>
                <td><?php echo $value['AlamatKerjaIbu'] ?></td>
                <td><?php echo $value['JamKerjaAyah'] ?></td>
                <td><?php echo $value['JamKerjaIbu'] ?></td>
                <td><?php echo $value['NoTelpRumahAyah'] ?></td>
                <td><?php echo $value['NoTelpRumahIbu'] ?></td>
                <td><?php echo $value['NoTempatKerjaAyah'] ?></td>
                <td><?php echo $value['NoTempatKerjaIbu'] ?></td>
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
                              <h4 class="modal-title">Edit Data Orang tua</h4>
                          </div>
                          <div class="modal-body">
                              <div class="row">
                                  <div class="col-sm-12 table-responsive">
                                      <?php echo validation_errors(); ?>
                                      <form class="form-horizontal form-label-left" id="formUpdate<?php echo $value['Id']; ?>" action="<?php echo site_url('Orangtua/edit'); ?>" method="POST">
                                          <div class="col-sm-12">
                                                  <input type="hidden" class="form-control" name="id_orangtua" id="id_orangtua" value="<?php echo $value['Id']; ?>">
                                                      
                                                  <div class="item form-group">
                                                    <label style="text-align: right;" class="control-label col-md-3" for="nama">Nama Ayah:
                                                    </label>
                                                    <div class="col-md-3">
                                                      <input  class="form-control" name="namaAyah" required="required" type="text" value="<?php echo $value['NamaAyah'] ?>">
                                                    </div>
                                                    <label style="text-align: right;" class="control-label col-md-2" for="nama">Nama Ibu:
                                                    </label>
                                                    <div class="col-md-3">
                                                      <input class="form-control" name="namaIbu" required="required" type="text" value="<?php echo $value['NamaIbu'] ?>">
                                                    </div>
                                                  </div>
                                                  <div class="clearfix"></div><br>
                                                  <div class="item form-group">
                                                    <label style="text-align: right;" class="control-label col-md-3" for="nama">No HP Ayah:
                                                    </label>
                                                    <div class="col-md-3">
                                                      <input  class="form-control" name="noHPAyah" required="required" type="text" value="<?php echo $value['NoHPAyah'] ?>">
                                                    </div>
                                                    <label style="text-align: right;" class="control-label col-md-2" for="nama">No HP Ibu:
                                                    </label>
                                                    <div class="col-md-3">
                                                      <input class="form-control" name="noHPIbu" required="required" type="text" value="<?php echo $value['NoHPIbu'] ?>">
                                                    </div>
                                                  </div>
                                                  <div class="clearfix"></div><br>
                                                  <div class="item form-group">
                                                    <label style="text-align: right;" class="control-label col-md-3" for="nama">Alamat Rumah Ayah:
                                                    </label>
                                                    <div class="col-md-3">
                                                      <textarea rows="3" class="form-control" name="alamatRumahAyah" required="required" type="text"><?php echo $value['AlamatRumahAyah'] ?></textarea>
                                                    </div>
                                                    <label style="text-align: right;" class="control-label col-md-2" for="nama">Alamat Rumah Ibu:
                                                    </label>
                                                    <div class="col-md-3">
                                                      <textarea class="form-control" rows="3" name="alamatRumahIbu" required="required" type="text"><?php echo $value['AlamatRumahIbu'] ?></textarea>
                                                    </div>
                                                  </div>
                                                  <div class="clearfix"></div><br>
                                                  <div class="item form-group">
                                                    <label style="text-align: right;" class="control-label col-md-3" for="nama">Alamat Kerja Ayah:
                                                    </label>
                                                    <div class="col-md-3">
                                                      <textarea id="nama" class="form-control" name="alamatKerjaAyah" required="required" type="text" rows="3"><?php echo $value['AlamatKerjaAyah'] ?></textarea>
                                                    </div>
                                                    <label style="text-align: right;" class="control-label col-md-2" for="nama">Alamat Kerja Ibu:
                                                    </label>
                                                    <div class="col-md-3">
                                                      <textarea id="nama" class="form-control" name="alamatKerjaIbu" required="required" type="text" rows="3"><?php echo $value['AlamatKerjaIbu'] ?></textarea>
                                                    </div>
                                                  </div>
                                                  <div class="clearfix"></div><br>
                                                  <div class="item form-group">
                                                    <label style="text-align: right;" class="control-label col-md-3" for="nama">Jam Kerja Ayah:
                                                    </label>
                                                    <div class="col-md-2">
                                                      <input  class="form-control" name="jamKerjaAyah" required="required" type="number" value="<?php echo $value['JamKerjaAyah'] ?>">
                                                    </div>
                                                    <label style="text-align: right;" class="control-label col-md-3" for="nama">Jam Kerja Ibu:
                                                    </label>
                                                    <div class="col-md-2">
                                                      <input  class="form-control" name="jamKerjaIbu" required="required" type="number" value="<?php echo $value['JamKerjaIbu'] ?>">
                                                    </div>
                                                  </div>
                                                  <div class="clearfix"></div><br>
                                                  <div class="item form-group">
                                                    <label style="text-align: right;" class="control-label col-md-3" for="nama">No Telp Rumah Ayah:
                                                    </label>
                                                    <div class="col-md-3">
                                                      <input  class="form-control" name="noTelpRumahAyah" required="required" type="text" value="<?php echo $value['NoTelpRumahAyah'] ?>">
                                                    </div>
                                                    <label style="text-align: right;" class="control-label col-md-2" for="nama">No Telp Rumah Ibu:
                                                    </label>
                                                    <div class="col-md-3">
                                                      <input  class="form-control" name="noTelpRumahIbu" required="required" type="text" value="<?php echo $value['NoTelpRumahIbu'] ?>">
                                                    </div>
                                                  </div>
                                                  <div class="clearfix"></div><br>
                                                  <div class="item form-group">
                                                    <label style="text-align: right;" class="control-label col-md-3" for="nama">No Tempat Kerja Ayah:
                                                    </label>
                                                    <div class="col-md-3">
                                                      <input  class="form-control" name="noTempatKerjaAyah" required="required" type="text" value="<?php echo $value['NoTempatKerjaAyah'] ?>">
                                                    </div>
                                                    <label style="text-align: right;" class="control-label col-md-2" for="nama">No Tempat Kerja Ibu:
                                                    </label>
                                                    <div class="col-md-3">
                                                      <input class="form-control" name="noTempatKerjaIbu" required="required" type="text" value="<?php echo $value['NoTempatKerjaIbu'] ?>">
                                                    </div>
                                                  </div>
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
                              <h4 class="modal-title">Hapus Data Orangtua</h4>
                          </div>
                          <div class="modal-body">
                              <div class="row">
                                  <div class="col-sm-12 table-responsive">
                                      <?php echo validation_errors(); ?>
                                      <form class="form-horizontal" id="formDelete<?php echo $value['Id']; ?>" action="<?php echo site_url('Orangtua/delete'); ?>" method="POST">
                                          <div class="col-sm-8 col-sm-offset-2">
                                              <h3 style="text-align: center;" for="newID">
                                                  <i class="fa fa-warning fa-fw" style="color: tomato;"></i>
                                                  <b>Anda yakin ingin menghapus data orangtua ini?</b>
                                              </h3><br>
                                              <input type="hidden" class="form-control" name="id_orangtua" id="id_orangtua"  value="<?php echo $value['Id']; ?>">
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

    // Selector
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()

    });

</script>