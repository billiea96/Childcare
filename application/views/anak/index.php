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
                <th class="col-sm-3" style="text-align: center;">Nama</th>
                <th class="col-sm-2" style="text-align: center;">Panggilan</th>
                <th class="col-sm-2" style="text-align: center;">Tanggal lahir</th>
                <th class="col-sm-2" style="text-align: center;">Usia</th>
                <th class="col-sm-2" style="text-align: center;">Kelamin</th>
                <!-- <th class="col-sm-2" style="text-align: center;">Edit</th> -->
              </tr>
            </thead>
            <tbody>
              <?php
              function findAge($dob){
                $current_time = time();

                $age_years = date('Y',$current_time) - date('Y',$dob);
                $age_months = date('m',$current_time) - date('m',$dob);
                $age_days = date('d',$current_time) - date('d',$dob);

                if ($age_days<0) {
                    $days_in_month = date('t',$current_time);
                    $age_months--;
                    $age_days= $days_in_month+$age_days;
                }

                if ($age_months<0) {
                    $age_years--;
                    $age_months = 12+$age_months;
                }

                if($age_years>0){
                  if($age_months>0)
                    echo "$age_years tahun $age_months bulan";    
                  else
                    echo "$age_years tahun";
                }else
                  echo "$age_months bulan"; 
                
              }
              function findMonth($dob){
                $birthday = new DateTime($dob);
                
                $diff = $birthday->diff(new DateTime());
                $months = $diff->format('%m') + 12 * $diff->format('%y');
                return $months;
              }
              $counter=0;
              foreach ($anak as $key => $value) { ?>
              <tr>
                <?php if(findMonth($value['TanggalLahir'])==1||findMonth($value['TanggalLahir'])==2||findMonth($value['TanggalLahir'])==4||findMonth($value['TanggalLahir'])==6||findMonth($value['TanggalLahir'])==9||findMonth($value['TanggalLahir'])==12||findMonth($value['TanggalLahir'])==15||findMonth($value['TanggalLahir'])==18||findMonth($value['TanggalLahir'])==24||findMonth($value['TanggalLahir'])==36||findMonth($value['TanggalLahir'])==48||findMonth($value['TanggalLahir'])==60) { ?>
                <td><?php $counter++; echo $counter; ?><span class="fa fa-bell" style="color:red;" id="spanNotif"></span></td>
                <?php }else{ ?>
                <td><?php $counter++; echo $counter; ?></td>
                <?php } ?>
                <td><a id='a<?php echo $value['Id']; ?>' href="<?php echo site_url('Anak/profil/'.$value["Id"]); ?>"><?php echo $value['Nama'] ?></a></td>
                <td><?php echo $value['Panggilan'] ?></td>
                <td><?php echo DateTime::createFromFormat('Y-m-d', $value['TanggalLahir'])->format('d M Y'); ?></td>
                <td><?php findAge(strtotime($value['TanggalLahir'])); ?></td>
                <td>
                  <?php if($value['Kelamin']=='L') echo "Laki-laki"; else echo "Perempuan"; ?>
                </td>
               <!--  <td>
                  <div class="btn-group">
                      <button onclick="" class="btn btn-default btn-xs" name="buttonDelete<?php echo $value['Id']; ?>" id="buttonDelete<?php echo $value['Id']; ?>" type="button" data-toggle="modal" data-target="#myModalDelete<?php echo $value['Id']; ?>" title="HAPUS">
                          <i class="fa fa-trash"></i>
                      </button>
                  </div>
                </td>      -->           
              </tr>
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
                                                  <b>Anda yakin ingin menghapus data anak ini?</b>
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