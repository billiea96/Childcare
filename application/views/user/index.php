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
          <h2>Master User</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <?php echo validation_errors(); ?>
          <form class="form-horizontal form-label-left" id="form_user" action="<?php echo site_url('User/add') ?>" method="POST">
            <div class="item form-group">
              <label class="control-label col-sm-4" for="hak_akses">Hak Akses <span class="required">*</span>
              </label>
              <div class="col-md-3">
                <select class="form-control select2" id="hak_akses" name="hak_akses" required="">
                  <option></option>
                  <option value="ANAK">ANAK</option>
                  <option value="NANNY">NANNY</option>
                  <option value="KEPERAWATAN">KEPERAWATAN</option>
                  <option value="KEPALA TPA">KEPALA TPA</option>
                  <option value="ADMIN">ADMIN</option>
                </select>
              </div>
            </div>
            <div class="item form-group" id="divAnak">
              <label class="control-label col-sm-4" for="anak">Anak <span class="required">*</span>
              </label>
              <div class="col-md-3">
                <select class="form-control select2" id="anak" name="anak">
                  <option></option>
                  <?php foreach($anak as $value): ?>
                    <option value="<?php echo $value['Id']; ?>"><?php echo $value['Nama']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="item form-group" id="divKaryawan">
              <label class="control-label col-sm-4" for="karyawan">Karyawan <span class="required">*</span>
              </label>
              <div class="col-md-3">
                <select class="form-control select2" id="karyawan" name="karyawan">
                  <option></option>
                  <?php foreach($karyawan as $value): ?>
                    <option value="<?php echo $value['Id']; ?>"><?php echo $value['Nama']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="item form-group">
              <label class="control-label col-sm-4" for="username">Username <span class="required">*</span>
              </label>
              <div class="col-md-3">
                <input type="text" class="form-control" name="username" id="username">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-sm-4" for="password">Password <span class="required">*</span>
              </label>
              <div class="col-md-3">
                <input type="password" class="form-control" name="pass" id="pass">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-sm-4" for="upass">Ulangi Password <span class="required">*</span>
              </label>
              <div class="col-md-3">
                <input type="password" class="form-control" name="upass" id="upass">
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-4 col-md-offset-6">
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
          <h2>Daftar User</h2>
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
                <th class="col-sm-4" style="text-align: center;">Username</th>
                <th class="col-sm-2" style="text-align: center;">Hak Akses</th>
                <th class="col-sm-2" style="text-align: center;">Status</th>
                <th class="col-sm-2" style="text-align: center;">Edit</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $counter=0;
              foreach ($user_karyawan as $key => $value) { ?>
              <tr>
                <td><?php $counter++; echo $counter; ?></td>
                <td><?php echo $value['Nama'] ?></td>
                <td><?php echo $value['Username'] ?></td>
                <td><?php echo $value['HakAkses'] ?></td>
                <td>Karyawan</td>
                <td>
                  <div class="btn-group">
                      <button onclick="" class="btn btn-default btn-xs" name="buttonUpdate<?php echo $value['Id']; ?>" id="buttonUpdate<?php echo $value['Id']; ?>" type="button" data-toggle="modal" data-target="#myModalUpdate<?php echo $value['Id']; ?>" title="UBAH">
                          <i class="fa fa-pencil-square-o"></i>
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
                              <h4 class="modal-title">Edit Data User</h4>
                          </div>
                          <div class="modal-body">
                              <div class="row">
                                  <div class="col-sm-12 table-responsive">
                                      <?php echo validation_errors(); ?>
                                      <form class="form-horizontal form-label-left" id="formUpdate<?php echo $value['Id']; ?>" action="<?php echo site_url('User/edit'); ?>" method="POST">
                                          <div class="col-sm-offset-10 col-sm-1"></div><br>
                                          <div class="col-sm-8 col-sm-offset-2">
                                                  <div class="item form-group">
                                                    <label style="text-align: right;" class="control-label col-md-4" for="nama">Nama :
                                                    </label>
                                                    <div class="col-md-6">
                                                      <input id="nama" class="form-control" name="nama" required="required" type="text" value="<?php echo $value['Nama'] ?>" disabled="">
                                                    </div>
                                                  </div><div class="clearfix"></div><br>
                                                   <div class="item form-group">
                                                    <label style="text-align: right;" class="control-label col-md-4" for="nama">Username :
                                                    </label>
                                                    <div class="col-md-6">
                                                      <input id="" class="form-control" name="" required="required" type="text" value="<?php echo $value['Username'] ?>" disabled="">
                                                      <input id="username" class="form-control" name="username" required="required" type="hidden" value="<?php echo $value['Username'] ?>">
                                                    </div>
                                                  </div><div class="clearfix"></div><br>
                                                  <div class="item form-group">
                                                    <label style="text-align: right;" class="control-label col-md-4" for="hak_akses">Hak Akses :</label>
                                                    <div class="col-md-6">
                                                      <select class="form-control" id="hak_akses" name="hak_akses" required="">
                                                        <?php if($value['HakAkses']=='NANNY'){ ?>
                                                          <option value="NANNY">NANNY</option>
                                                          <option value="KEPERAWATAN">KEPERAWATAN</option>
                                                          <option value="ADMIN">ADMIN</option>
                                                          <option value="KEPALA TPA">KEPALA TPA</option>
                                                        <?php }else if($value['HakAkses']=='KEPERAWATAN'){ ?>
                                                          <option value="KEPERAWATAN">KEPERAWATAN</option>
                                                          <option value="NANNY">NANNY</option>
                                                          <option value="ADMIN">ADMIN</option>
                                                          <option value="KEPALA TPA">KEPALA TPA</option>
                                                        <?php }else if($value['HakAkses']=='KEPALA TPA'){ ?>
                                                          <option value="KEPALA TPA">KEPALA TPA</option>
                                                          <option value="KEPERAWATAN">KEPERAWATAN</option>
                                                          <option value="NANNY">NANNY</option>
                                                          <option value="ADMIN">ADMIN</option>
                                                        <?php }else{ ?>
                                                          <option value="ADMIN">ADMIN</option>
                                                          <option value="NANNY">NANNY</option>
                                                          <option value="KEPERAWATAN">KEPERAWATAN</option>
                                                          <option value="KEPALA TPA">KEPALA TPA</option>
                                                        <?php }?>
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

              <?php } ?>

               <?php 
              foreach ($user_anak as $key => $value) { ?>
              <tr>
                <td><?php $counter++; echo $counter; ?></td>
                <td><?php echo $value['Nama'] ?></td>
                <td><?php echo $value['Username'] ?></td>
                <td><?php echo $value['HakAkses'] ?></td>
                <td>Anak</td>
                <td>
                  <div class="btn-group">
                      <button onclick="" class="btn btn-default btn-xs" name="buttonUpdate<?php echo $value['Id']; ?>" id="buttonUpdate<?php echo $value['Id']; ?>" type="button" data-toggle="modal" data-target="#myModalUpdate<?php echo $value['Id']; ?>" title="UBAH">
                          <i class="fa fa-pencil-square-o"></i>
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
                              <h4 class="modal-title">Edit Data User</h4>
                          </div>
                          <div class="modal-body">
                              <div class="row">
                                  <div class="col-sm-12 table-responsive">
                                      <?php echo validation_errors(); ?>
                                      <form class="form-horizontal form-label-left" id="formUpdate<?php echo $value['Id']; ?>" action="<?php echo site_url('User/edit'); ?>" method="POST">
                                          <div class="col-sm-offset-10 col-sm-1"></div><br>
                                          <div class="col-sm-8 col-sm-offset-2">
                                                  <div class="item form-group">
                                                    <label style="text-align: right;" class="control-label col-md-4" for="nama">Nama :
                                                    </label>
                                                    <div class="col-md-6">
                                                      <input id="nama" class="form-control" name="nama" required="required" type="text" value="<?php echo $value['Nama'] ?>" disabled="">
                                                    </div>
                                                  </div><div class="clearfix"></div><br>
                                                   <div class="item form-group">
                                                    <label style="text-align: right;" class="control-label col-md-4" for="nama">Username :
                                                    </label>
                                                    <div class="col-md-6">
                                                      <input id="" class="form-control" name="" required="required" type="text" value="<?php echo $value['Username'] ?>" disabled="">
                                                      <input id="username" class="form-control" name="username" required="required" type="hidden" value="<?php echo $value['Username'] ?>">
                                                    </div>
                                                  </div><div class="clearfix"></div><br>
                                                  <div class="item form-group">
                                                    <label style="text-align: right;" class="control-label col-md-4" for="hak_akses">Hak Akses :</label>
                                                    <div class="col-md-6">
                                                      <select class="form-control" id="hak_akses" name="hak_akses" required="">
                                                          <option value="ANAK">ANAK</option>
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

    $(document).on('change','#hak_akses',function(){
      var hak_akses = $(this).val();

      if(hak_akses=="ANAK"){
        document.getElementById('divAnak').style.display ='block';
        document.getElementById('divKaryawan').style.display ='none';
      }else{
        document.getElementById('divAnak').style.display ='none';
        document.getElementById('divKaryawan').style.display ='block';
      }
    });
    $(document).on('change','#upass',function(){
      if($(this).val()!=$('#pass').val()){
        alert('Password harus sama');
        $(this).val('');
        $(this).focus();
      }
    });
    $(document).on('change','#username',function(){
      var username = $(this).val();

      $.ajax({
        url : '<?php echo site_url("User/cek_username"); ?>',
        method : 'POST',
        data : {'username' : username},
        success : function(data){
          if(data=="TRUE"){
            $('#username').focus();
            $('#username').val('');
            alert("USERNAME SUDAH ADA!!");
          }
        }
      });
    });
</script>