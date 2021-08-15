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
          <h2>Master Periode Asuh</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <?php echo validation_errors(); ?>
          <form class="form-horizontal form-label-left" id="form_jabatan" action="<?php echo site_url('PeriodeAsuh/add') ?>" method="POST">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-3 col-xs-12" for="TanggalAwal">Tanggal Awal<span class="required">*</span>
              </label>
              <div class="col-md-3 col-sm-6 col-xs-12">
                <input type="text" required="" class="form-control" id="TanggalAwal" name="TanggalAwal">
                <span class="fa fa-calendar form-control-feedback right" aria-hidden="false"></span>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-3 col-xs-12" for="TanggalAkhir">Tanggal Akhir<span class="required">*</span>
              </label>
              <div class="col-md-3 col-sm-6 col-xs-12">
                <input type="text" required="" class="form-control" id="TanggalAkhir" name="TanggalAkhir">
                <span class="fa fa-calendar form-control-feedback right" aria-hidden="false"></span>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-sm-4" for="noHP">Set Aktif</span>
              </label>
              <div class="col-md-2">
                <select class="form-control select2" id="Aktifkah" name="Aktifkah" required="">
                  <option value="1">Aktif</option>
                  <option value="0">Belum Aktif</option>
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
          <h2>Daftar Periode</h2>
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
                <th class="col-sm-3" style="text-align: center;">Tanggal Awal</th>
                <th class="col-sm-3" style="text-align: center;">Tanggal Akhir</th>
                <th class="col-sm-3" style="text-align: center;">Status</th>
                <th class="col-sm-2" style="text-align: center;">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $counter=0;
              foreach ($periode_asuh as $key => $value) { ?>
              <tr>
                <td><?php $counter++; echo $counter; ?></td>
                <td><?php echo DateTime::createFromFormat('Y-m-d', $value['TanggalAwal'])->format('d M Y');?></td>
                <td><?php echo DateTime::createFromFormat('Y-m-d', $value['TanggalAkhir'])->format('d M Y');?></td>
                <td>
                  <?php if($value['Status']==0){?>
                      <span style="color: red;">Non Aktif</span>
                  <?php }else{ ?>
                      <span style="color: green;">Aktif</span>
                  <?php } ?>
                </td>
                <td>
                  <?php if($value['Status']==1){?>
                      <button class="btn btn-success btn-xs" disabled>AKTIF</button>
                  <?php }else{ ?>
                    <?php if(strtotime($value['TanggalAkhir'])>strtotime(date('Y-m-d'))){ ?>
                       <button onclick="" class="btn btn-success btn-xs" name="buttonAktif<?php echo $value['Id']; ?>" id="buttonAktif<?php echo $value['Id']; ?>" type="button" data-toggle="modal" data-target="#myModalAktif<?php echo $value['Id']; ?>" title="mengaktifkan">
                          AKTIF
                      </button>
                    <?php }else { ?>
                      <span class="btn btn-success btn-xs" disabled>AKTIF</span>
                    <?php } ?>
                  <?php } ?>
                </td>                
              </tr>

              <!-- Modal Untuk Aktif -->
              <div id="myModalAktif<?php echo $value['Id']; ?>" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                      <!-- Modal content-->
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Aktifkan Periode Asuh</h4>
                          </div>
                          <div class="modal-body">
                              <div class="row">
                                  <div class="col-sm-12 table-responsive">
                                      <?php echo validation_errors(); ?>
                                      <form class="form-horizontal" id="formAktif<?php echo $value['Id']; ?>" action="<?php echo site_url('PeriodeAsuh/set_aktif'); ?>" method="POST">
                                          <div class="col-sm-8 col-sm-offset-2">
                                              <h3 style="text-align: center;" for="newID">
                                                  <i class="fa fa-warning fa-fw" style="color: tomato;"></i>
                                                  <b>Ingin mengaktifkan periode ini?</b>
                                              </h3><br>
                                              <input type="hidden" class="form-control" name="idPeriode" id="idPeriode"  value="<?php echo $value['Id']; ?>">
                                          </div>
                                      </form>
                                  </div>
                              </div>
                          </div>
                          <div class="modal-footer">
                              <div class="col-sm-12">
                                  <div class="col-sm-offset-6 col-sm-5">
                                      <button type="button" class="btn btn-default btn-md" data-dismiss="modal">Cancel</button>
                                      <input class="btn btn-success btn-md" type="submit" id="simpan" name="simpan" value="Aktifkan" form="formAktif<?php echo $value['Id']; ?>">
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
    $('#TanggalAwal').datetimepicker({
        format: 'DD-MM-YYYY'
    });
    $('#TanggalAkhir').datetimepicker({
        format: 'DD-MM-YYYY'
    });
    $(document).ready(function() {
        $('#datatable-responsive').DataTable({
            responsive: true
        });
        $('[data-toggle="modal"]').tooltip();
    });

</script>