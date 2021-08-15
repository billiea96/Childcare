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
          <h2>Master Pengasuh Anak</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <?php echo validation_errors(); ?>
          <form class="form-horizontal form-label-left" id="form_pengasuh_anak" action="<?php echo site_url('PeriodeAsuhKaryawanAnak/add') ?>" method="POST">
            <h4>Periode <?php echo DateTime::createFromFormat('Y-m-d', $periode_asuh['TanggalAwal'])->format('d M Y').' s/d '.DateTime::createFromFormat('Y-m-d', $periode_asuh['TanggalAkhir'])->format('d M Y'); ?></h4>
            <input type="hidden" name="idPeriodeAsuh" value="<?php echo $periode_asuh['Id']; ?>">
             
            <div class="item form-group">
              <label class="control-label col-sm-4" for="pengasuh">Pengasuh <span class="required">*</span>
              </label>
              <div class="col-md-3">
                <select class="form-control select2" id="pengasuh" name="pengasuh" required="">
                  <option></option>
                  <?php foreach($karyawan as $value): ?>
                    <option value="<?php echo $value['Id']; ?>"><?php echo $value['Nama']; ?></option>
                  <?php endforeach; ?>
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
          <h2>Daftar Pengasuh Anak Pada Periode Aktif</h2>
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
                <th class="col-sm-4" style="text-align: center;">Pengasuh</th>
                <th class="col-sm-4" style="text-align: center;">Anak</th>
                <th class="col-sm-2" style="text-align: center;">Edit</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $counter=0;
              foreach ($periode_asuh_karyawan_anak as $key => $value) { ?>
              <tr>
                <td><?php $counter++; echo $counter; ?></td>
                <td><?php echo $value['NamaKaryawan'] ?></td>
                <td><?php echo $value['NamaAnak'] ?></td>
                <td>
                  <div class="btn-group">
                      <button onclick="" class="btn btn-default btn-xs" name="buttonUpdate<?php echo $value['idPeriodeAsuh'].$value['IDKaryawan'].$value['IDAnak']; ?>" id="buttonUpdate<?php echo $value['idPeriodeAsuh'].$value['IDKaryawan'].$value['IDAnak']; ?>" type="button" data-toggle="modal" data-target="#myModalUpdate<?php echo $value['idPeriodeAsuh'].$value['IDKaryawan'].$value['IDAnak']; ?>" title="UBAH">
                          <i class="fa fa-pencil-square-o"></i>
                      </button>
                  </div>
                </td>                
              </tr>
              <!-- Modal Untuk Update -->
              <div id="myModalUpdate<?php echo $value['idPeriodeAsuh'].$value['IDKaryawan'].$value['IDAnak']; ?>" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-lg">
                      <!-- Modal content-->
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Edit Data Pengasuh Anak</h4>
                          </div>
                          <div class="modal-body">
                              <div class="row">
                                  <div class="col-sm-12 table-responsive">
                                      <?php echo validation_errors(); ?>
                                      <form class="form-horizontal form-label-left" id="formUpdate<?php echo $value['Id']; ?>" action="<?php echo site_url('PeriodeAsuhKaryawanAnak/edit'); ?>" method="POST">
                                          <div class="col-sm-offset-10 col-sm-1"></div><br>
                                          <div class="col-sm-8 col-sm-offset-2">
                                            <input type="hidden" name="idPengasuhAnak" value="<?php echo $value['Id']; ?>">
                                                  <div class="item form-group">
                                                    <label style="text-align: right;" class="control-label col-md-4" for="pengasuh">Jabatan :</label>
                                                    <div class="col-md-6">
                                                      <select class="form-control" id="pengasuh" name="pengasuh" required="">
                                                        <option value="<?php echo $value['IDKaryawan'] ?>"><?php echo $value['NamaKaryawan'] ?></option>
                                                        <?php foreach($karyawan as $value2):
                                                          if($value2['Id'] != $value['IDKaryawan']){ ?>
                                                          <option value="<?php echo $value2['Id']; ?>"><?php echo $value2['Nama']; ?></option>
                                                        <?php } endforeach; ?>
                                                      </select>
                                                    </div>
                                                  </div><div class="clearfix"></div><br>
                                                  <div class="item form-group">
                                                    <label style="text-align: right;" class="control-label col-md-4" for="anak">Anak :</label>
                                                    <div class="col-md-6">
                                                      <select class="form-control" id="anak" name="anak" required="">
                                                        <option value="<?php echo $value['IDAnak'] ?>"><?php echo $value['NamaAnak'] ?></option>
                                                        <?php foreach($anak as $value2):
                                                          if($value2['Id'] != $value['IDAnak']){ ?>
                                                          <option value="<?php echo $value2['Id']; ?>"><?php echo $value2['Nama']; ?></option>
                                                        <?php } endforeach; ?>
                                                      </select>
                                                    </div>
                                                  </div><div class="clearfix"></div><br>
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

    })

</script>