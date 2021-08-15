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
          <h2>Validasi Pendaftaran</h2>
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
                <th class="col-sm-1" style="text-align: center;">Panggilan</th>
                <th class="col-sm-2" style="text-align: center;">Tanggal lahir</th>
                <th class="col-sm-2" style="text-align: center;">Kelamin</th>
                <th class="col-sm-2" style="text-align: center;">Orang tua</th>
                <th class="col-sm-2" style="text-align: center;">Paket</th>
                <th class="col-sm-2" style="text-align: center;">Tanggal Titip</th>
                <th class="col-sm-1" style="text-align: center;">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $counter=0;
              foreach ($anak as $key => $value) { ?>
              <tr>
                <td><?php $counter++; echo $counter; ?></td>
                <td><a id='a<?php echo $value['Id']; ?>' href="<?php echo site_url('Pendaftaran/profil/'.$value["Id"]); ?>"><?php echo $value['Nama'] ?></a></td>
                <td><?php echo $value['Panggilan'] ?></td>
                <td><?php echo DateTime::createFromFormat('Y-m-d', $value['TanggalLahir'])->format('d M Y'); ?></td>
                <td>
                  <?php if($value['Kelamin']=='L') echo "Laki-laki"; else echo "Perempuan"; ?>
                </td>
                <td><?php echo $value['NamaAyah'].' & '.$value['NamaIbu'] ?></td>
                <td><?php echo $value['NamaPaket'] ?></td>
                <td><?php echo DateTime::createFromFormat('Y-m-d', $value['TanggalTitip'])->format('d-m-Y'); ?></td>
                <td>
                  <div class="btn-group">
                      <button onclick="" class="btn btn-success btn-xs" name="buttonDelete<?php echo $value['Id']; ?>" id="buttonDelete<?php echo $value['Id']; ?>" type="button" data-toggle="modal" data-target="#myModalDelete<?php echo $value['Id']; ?>" title="Validasi">
                          Validasi
                      </button>
                  </div>
                </td>                
              </tr>
              <!-- Modal Untuk Delete -->
              <div id="myModalDelete<?php echo $value['Id']; ?>" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                      <!-- Modal content-->
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Validasi</h4>
                          </div>
                          <div class="modal-body">
                              <div class="row">
                                  <div class="col-sm-12 table-responsive">
                                      <?php echo validation_errors(); ?>
                                      <form class="form-horizontal" id="formDelete<?php echo $value['Id']; ?>" action="<?php echo site_url('Pendaftaran/aktif_validasi'); ?>" method="POST">
                                          <div class="col-sm-8 col-sm-offset-2">
                                              <h3 style="text-align: center;" for="newID">
                                                  <i class="fa fa-warning fa-fw" style="color: tomato;"></i>
                                                  <b>Anda yakin ingin validasi anak ini?</b>
                                              </h3><br>
                                              <input type="hidden" class="form-control" name="id_anak" id="id_anak"  value="<?php echo $value['Id']; ?>">
                                              <input type="hidden" class="form-control" name="no_form" id="no_form"  value="<?php echo $value['NoForm']; ?>">
                                          </div>
                                      </form>
                                  </div>
                              </div>
                          </div>
                          <div class="modal-footer">
                              <div class="col-sm-12">
                                  <div class="col-sm-offset-8 col-sm-4">
                                      <button type="button" class="btn btn-default btn-md" data-dismiss="modal">Cancel</button>
                                      <input class="btn btn-success btn-md" type="submit" id="simpan" name="simpan" value="Ya" form="formDelete<?php echo $value['Id']; ?>">
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <script>
                 $(document).ready(function(){
                    $("#a<?php echo $value['Id']; ?>").hover(function(){
                        $(this).css("color", "white");
                        $(this).css("background-color", "#6f7a7a");
                        }, function(){
                        $(this).css("color", "#5c7db2");
                        $(this).css("background-color", "transparent");
                    });
                });
              </script>

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
</script>