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
          <h2>Daftar Anak</h2>
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
                <th class="col-sm-1" style="text-align: center;">Tanggal Lahir</th>
                <th class="col-sm-1" style="text-align: center;">Kelamin</th>
                <th class="col-sm-2" style="text-align: center;">Alergi</th>
                <th class="col-sm-3" style="text-align: center;">Orang tua</th>
                <th class="col-sm-1" style="text-align: center;">Status</th>
                <th class="col-sm-2" style="text-align: center;">Edit</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $counter=0;
              foreach ($anak as $key => $value) { ?>
              <tr>
                <td><?php $counter++; echo $counter; ?></td>
                <td><?php echo $value['Nama'] ?></td>
                <td><?php echo date('d-m-Y',strtotime($value['TanggalLahir'])); ?></td>
                <td>
                  <?php 
                    switch ($value["Kelamin"]) {
                      case 'P':
                        echo "Perempuan";
                        break;
                      case 'L':
                        echo "Laki-Laki";
                        break;
                      default:
                        # code...
                        break;
                    }
                  ?>
                </td>
                <td><?php echo $value['Alergi'] ?></td>
                <td><?php echo $value['NamaAyah'].' & '.$value['NamaIbu'] ?></td>
                <td>
                  <?php 
                    switch ($value["Hapus"]) {
                      case 0:
                        echo "Aktif";
                        break;
                      case 1:
                        echo "Tidak Aktif";
                        break;
                      default:
                        # code...
                        break;
                    }
                  ?>
                </td>
                <td>
                  <div class="btn-group">
                      <button onclick="" class="btn btn-default btn-xs" name="buttonUpdate<?php echo $value['Id']; ?>" id="buttonUpdate<?php echo $value['Id']; ?>" type="button" data-toggle="modal" data-target="#myModalUpdate<?php echo $value['Id']; ?>" title="UBAH">
                          <i class="fa fa-pencil-square-o"></i>
                      </button>
                      <button onclick="" class="btn btn-default btn-xs" name="buttonDelete<?php echo $value['Id']; ?>" id="buttonDelete<?php echo $value['Id']; ?>" type="button" data-toggle="modal" data-target="#myModalDelete<?php echo $value['Id']; ?>" title="KELUAR">
                          <i class="fa fa-sign-out"></i>
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
                              <h4 class="modal-title">Edit Data Anak</h4>
                          </div>
                          <div class="modal-body">
                              <div class="row">
                                  <div class="col-sm-12 table-responsive">
                                      <?php echo validation_errors(); ?>
                                      <form class="form-horizontal form-label-left" id="formUpdate<?php echo $value['Id']; ?>" action="<?php echo site_url('Anak/edit'); ?>" method="POST" enctype="multipart/form-data">
                                          <div class="col-sm-8 col-sm-offset-2">
                                                  <input type="hidden" class="form-control" name="id_anak" id="id_anak" value="<?php echo $value['Id']; ?>">
                                                      
                                                  <div class="item form-group">
                                                    <label style="text-align: right;" class="control-label col-md-4" for="nama">Nama:
                                                    </label>
                                                    <div class="col-md-5">
                                                      <input class="form-control" name="nama" required="required" type="text" value="<?php echo $value['Nama'] ?>">
                                                    </div>
                                                  </div>
                                                  <div class="clearfix"></div><br>
                                                  <div class="item form-group">
                                                    <label style="text-align: right;" class="control-label col-md-4" for="panggilan">panggilan:
                                                    </label>
                                                    <div class="col-md-4">
                                                      <input class="form-control" name="panggilan" required="required" type="text" value="<?php echo $value['Panggilan'] ?>">
                                                    </div>
                                                  </div>
                                                  <div class="clearfix"></div><br>
                                                  <div class="item form-group">
                                                    <label style="text-align: right;" class="control-label col-md-4" for="tanggalLahir">Tanggal Lahir:
                                                    </label>
                                                    <div class="col-md-4">
                                                      <input class="form-control tanggal" name="tanggalLahir" required="required" type="text" value="<?php echo date('d-m-Y',strtotime($value['TanggalLahir'])); ?>">
                                                    </div>
                                                  </div>
                                                  <div class="clearfix"></div><br>
                                                  <div class="item form-group">
                                                    <label style="text-align: right;" class="control-label col-md-4" for="kelamin">kelamin:
                                                    </label>
                                                    <div class="col-md-4">
                                                      <select class="form-control" id="kelamin" name="kelamin" required="">
                                                        <?php if($value['Kelamin']=='L'){ ?>
                                                        <option value="<?php echo $value['Kelamin'] ?>">Laki-laki</option>
                                                        <option value="P">Perempuan</option>
                                                        <?php }else{?>
                                                          <option value="<?php echo $value['Kelamin'] ?>">Perempuan</option>
                                                          <option value="L">Laki-laki</option>
                                                        <?php }?>
                                                      </select>
                                                    </div>
                                                  </div>
                                                  <div class="clearfix"></div><br>
                                                  <div class="item form-group">
                                                    <label style="text-align: right;" class="control-label col-md-4" for="alergi">Alergi:
                                                    </label>
                                                    <div class="col-md-3">
                                                      <input class="form-control" name="alergi" required="required" type="text" value="<?php echo $value['Alergi']; ?>">
                                                    </div>
                                                  </div>
                                                  <div class="clearfix"></div><br>
                                                  <div class="item form-group">
                                                    <label style="text-align: right;" class="control-label col-md-4" for="dokter">Dokter:
                                                    </label>
                                                    <div class="col-md-6">
                                                      <input class="form-control" name="dokter" type="text" value="<?php echo $value['Dokter']; ?>">
                                                    </div>
                                                  </div>
                                                  <div class="clearfix"></div><br>
                                                  <div class="item form-group">
                                                    <label style="text-align: right;" class="control-label col-md-4" for="noTelpDokter">No. Telp Dokter:
                                                    </label>
                                                    <div class="col-md-6">
                                                      <input class="form-control" name="noTelpDokter" type="text" value="<?php echo $value['NoTelpDokter']; ?>">
                                                    </div>
                                                  </div>
                                                  <div class="clearfix"></div><br>
                                                  <div class="item form-group">
                                                    <label style="text-align: right;" class="control-label col-md-4" for="orangtua">Orang tua :</label>
                                                    <div class="col-md-7">
                                                      <select style="width: 90%;" class="form-control select2" id="orangtua" name="orangtua" required="">
                                                        <option value="<?php echo $value['IDOrangtua'] ?>"><?php echo $value['NamaAyah'].' & '.$value['NamaIbu'] ?></option>
                                                        <?php foreach($orangtua as $value2):
                                                          if($value2['Id'] != $value['IDOrangtua']){ ?>
                                                          <option value="<?php echo $value2['Id']; ?>"><?php echo $value2['NamaAyah'].' & '.$value2['NamaIbu']; ?></option>
                                                        <?php } endforeach; ?>
                                                      </select>
                                                    </div>
                                                  </div>
                                                  <div class="clearfix"></div><br>
                                                  <div class="item form-group">
                                                    <label style="text-align: right;" class="control-label col-md-4" for="foro">Ganti Foto:
                                                    </label>
                                                    <div class="col-md-6">
                                                      <input class="form-control-file" name="foto" type="file" accept="image/*">
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
                              <h4 class="modal-title">Hapus Data Anak</h4>
                          </div>
                          <div class="modal-body">
                              <div class="row">
                                  <div class="col-sm-12 table-responsive">
                                      <?php echo validation_errors(); ?>
                                      <form class="form-horizontal" id="formDelete<?php echo $value['Id']; ?>" action="<?php echo site_url('Anak/delete'); ?>" method="POST">
                                          <div class="col-sm-8 col-sm-offset-2">
                                              <h3 style="text-align: center;" for="newID">
                                                  <i class="fa fa-warning fa-fw" style="color: tomato;"></i>
                                                  <b>Anda yakin ingin menon-aktifkan data anak ini?</b>
                                              </h3><br>
                                              <input type="hidden" class="form-control" name="id_anak" id="id_anak"  value="<?php echo $value['Id']; ?>">
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
    $('.tanggal').datetimepicker({
        format: 'DD-MM-YYYY'
    });
    // Selector
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()

    });

</script>