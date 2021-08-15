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
          <h2>Master Karyawan</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <?php echo validation_errors(); ?>
          <form class="form-horizontal form-label-left" id="form_karyawan" action="<?php echo site_url('Karyawan/add') ?>" method="POST">
            <div class="item form-group">
              <label class="control-label col-sm-4" for="IdKaryawan">ID Karyawan</span>
              </label>
              <div class="col-md-2">
                <input class="form-control" required="required" disabled="" type="text" value="<?php echo $IdKaryawan; ?>">
                <input type="hidden" name="IdKaryawan" value="<?php echo $IdKaryawan; ?>">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-sm-4" for="nama">Nama <span class="required">*</span>
              </label>
              <div class="col-md-4">
                <input class="form-control" id="nama" name="nama" required="required" type="text">
                <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-sm-4" for="alamat">Alamat <span class="required">*</span>
              </label>
              <div class="col-md-4">
                <textarea rows="3" required="required" id="alamat" name="alamat" class="form-control"></textarea>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-sm-4" for="noHP">No HP <span class="required">*</span>
              </label>
              <div class="col-md-4">
                <input class="form-control" id="noHP" name="noHP" required="required" type="text">
                <span class="fa fa-mobile-phone form-control-feedback right" aria-hidden="true"></span>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-sm-4" for="noHP">Jabatan <span class="required">*</span>
              </label>
              <div class="col-md-4">
                <select class="form-control select2" id="jabatan" name="jabatan" required="">
                  <option></option>
                  <?php foreach($jabatan as $value): ?>
                    <option value="<?php echo $value['Id']; ?>"><?php echo $value['Nama']; ?></option>
                  <?php endforeach; ?>
                </select>
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
          <h2>Daftar Karyawan</h2>
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
                <th class="col-sm-4" style="text-align: center;">Alamat</th>
                <th class="col-sm-2" style="text-align: center;">No HP</th>
                <th class="col-sm-2" style="text-align: center;">Jabatan</th>
                <th class="col-sm-2" style="text-align: center;">Edit</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $counter=0;
              foreach ($karyawan as $key => $value) { ?>
              <tr>
                <td><?php $counter++; echo $counter; ?></td>
                <td><?php echo $value['Nama'] ?></td>
                <td><?php echo $value['Alamat'] ?></td>
                <td><?php echo $value['NoHP'] ?></td>
                <td><?php echo $value['NamaJabatan'] ?></td>
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
                              <h4 class="modal-title">Edit Data Karyawan</h4>
                          </div>
                          <div class="modal-body">
                              <div class="row">
                                  <div class="col-sm-12 table-responsive">
                                      <?php echo validation_errors(); ?>
                                      <form class="form-horizontal form-label-left" id="formUpdate<?php echo $value['Id']; ?>" action="<?php echo site_url('Karyawan/edit'); ?>" method="POST">
                                          <div class="col-sm-offset-10 col-sm-1"></div><br>
                                          <div class="col-sm-8 col-sm-offset-2">
                                                  <div class="item form-group">
                                                      <label style="text-align: right;" class="control-label col-md-4" for="id_jabatan">ID Karyawan :</label>
                                                      <div class="col-md-3">
                                                          <input type="text" class="form-control" value="<?php echo $value['Id']; ?>" disabled>
                                                          <input type="hidden" class="form-control" name="id_karyawan" id="id_karyawan" value="<?php echo $value['Id']; ?>">
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
                                                    <label style="text-align: right;" class="control-label col-md-4" for="alamat">Alamat :</label>
                                                    <div class="col-md-7">
                                                     <textarea rows="3" required="required" id="alamat" name="alamat" class="form-control"><?php echo $value['Alamat']; ?></textarea>
                                                    </div>
                                                  </div><div class="clearfix"></div><br>
                                                  <div class="item form-group">
                                                    <label style="text-align: right;" class="control-label col-md-4" for="noHP">No HP :</label>
                                                    <div class="col-md-7">
                                                      <input id="noHP" class="form-control" name="noHP" required="required" type="text" value="<?php echo $value['NoHP'] ?>">
                                                    </div>
                                                  </div><div class="clearfix"></div><br>
                                                  <div class="item form-group">
                                                    <label style="text-align: right;" class="control-label col-md-4" for="jabatan">Jabatan :</label>
                                                    <div class="col-md-7">
                                                      <select class="form-control" id="jabatan" name="jabatan" required="">
                                                        <option value="<?php echo $value['IDJabatan'] ?>"><?php echo $value['NamaJabatan'] ?></option>
                                                        <?php foreach($jabatan as $value2):
                                                          if($value2['Id'] != $value['IDJabatan']){ ?>
                                                          <option value="<?php echo $value2['Id']; ?>"><?php echo $value2['Nama']; ?></option>
                                                        <?php } endforeach; ?>
                                                      </select>
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
                              <h4 class="modal-title">Hapus Data Karyawan</h4>
                          </div>
                          <div class="modal-body">
                              <div class="row">
                                  <div class="col-sm-12 table-responsive">
                                      <?php echo validation_errors(); ?>
                                      <form class="form-horizontal" id="formDelete<?php echo $value['Id']; ?>" action="<?php echo site_url('Karyawan/delete'); ?>" method="POST">
                                          <div class="col-sm-8 col-sm-offset-2">
                                              <h3 style="text-align: center;" for="newID">
                                                  <i class="fa fa-warning fa-fw" style="color: tomato;"></i>
                                                  <b>Anda yakin ingin menghapus data Karyawan ini?</b>
                                              </h3><br>
                                              <input type="hidden" class="form-control" name="id_karyawan" id="id_karyawan"  value="<?php echo $value['Id']; ?>">
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