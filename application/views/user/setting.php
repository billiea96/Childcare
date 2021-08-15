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
    <div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2">
      <div class="alert alert-warning alert-dismissible fade in" role="alert" id="divNotif" style="display: none;">
        <strong id="textNotif"></strong>
      </div>
      <div class="x_panel">
        <div class="x_title">
          <h2>Setting User</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <?php echo validation_errors(); ?>
          <form class="form-horizontal form-label-left" id="form_user_setting" action="<?php echo site_url('User/simpan_setting') ?>" method="POST">
            <div class="form-group">
              <label class="control-label col-md-5 col-sm-3 col-xs-12" for="username">Username
              </label>
              <div class="col-md-3" id="divUsernameLama">
                <input type="text" required="" class="form-control" id="username_lama" name="username_lama" disabled="" value="<?php echo $_SESSION['username'] ?>">
              </div>
              <div class="col-md-3" id="divUsernameBaru" style="display: none;">
                <input type="text" required="" class="form-control" id="username_baru" name="username_baru" value="<?php echo $_SESSION['username'] ?>">
              </div>
            </div>
            <div class="form-group" id="divPass">
              <label class="control-label col-md-5 col-sm-3 col-xs-12" for="paket2">Password
              </label>
              <div class="col-md-3">
                <input type="password" required="" class="form-control" disabled="" value="********">
              </div>
            </div>
            <div class="form-group" id="divPassLama" style="display: none;">
              <label class="control-label col-md-5 col-sm-3 col-xs-12" for="pass_lama">Password Lama
              </label>
              <div class="col-md-3">
                <input type="password" required="" class="form-control" id="pass_lama" name="pass_lama">
              </div>
            </div>
            <div class="form-group" id="divPassBaru" style="display: none;">
              <label class="control-label col-md-5 col-sm-3 col-xs-12" for="pass_baru">Password Baru
              </label>
              <div class="col-md-3">
                <input type="password" required="" class="form-control" id="pass_baru" name="pass_baru" disabled="">
              </div>
            </div>
            <div class="form-group" id="divUpassBaru" style="display: none;">
              <label class="control-label col-md-5 col-sm-3 col-xs-12" for="upass_baru">Ulangi Password Baru
              </label>
              <div class="col-md-3">
                <input type="password" required="" class="form-control" id="upass_baru" name="upass_baru" disabled="">
              </div>
            </div>

            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-8 col-md-offset-5">
                <button id="ubah" type="button" class="btn btn-primary">Ubah</button>
                <button id="batal" type="submit" class="btn btn-danger" style="display: none;">Batal</button>
                <button id="simpan" type="submit" class="btn btn-success" style="display: none;" disabled="">Simpan</button>

              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- end row -->



</div>

<script>
  $(document).on('click','#ubah',function(){
    document.getElementById('divPass').style.display = 'none';
    document.getElementById('divPassLama').style.display = 'block';
    document.getElementById('divPassBaru').style.display = 'block';
    document.getElementById('divUpassBaru').style.display = 'block';

    document.getElementById('divUsernameLama').style.display = 'none';
    document.getElementById('divUsernameBaru').style.display = 'block';

    document.getElementById('ubah').style.display = 'none';
    document.getElementById('batal').style.display = 'inline-block';
    document.getElementById('simpan').style.display = 'inline-block';
  });
  $(document).on('click','#batal',function(){
    document.getElementById('divPass').style.display = 'block';
    document.getElementById('divPassLama').style.display = 'none';
    document.getElementById('divPassBaru').style.display = 'none';
    document.getElementById('divUpassBaru').style.display = 'none';

    document.getElementById('divUsernameLama').style.display = 'block';
    document.getElementById('divUsernameBaru').style.display = 'none';

    document.getElementById('ubah').style.display = 'block';
    document.getElementById('batal').style.display = 'none';
    document.getElementById('simpan').style.display = 'none';
  });
  $(document).on('input','#pass_lama',function(){
    var pass = $(this).val();

    $.ajax({
      url : '<?php echo site_url("User/cek_pass"); ?>',
      method :'POST',
      data : {'pass':pass},
      success : function(data){
        if(data=='false'){
          document.getElementById('divNotif').style.display ='block';
          $('#textNotif').html('PASSWORD LAMA SALAH!!');

          document.getElementById('pass_baru').disabled = true;
          document.getElementById('upass_baru').disabled = true;
        }
        else{
          document.getElementById('divNotif').style.display ='none';

          document.getElementById('pass_baru').disabled = false;
          document.getElementById('upass_baru').disabled = false;
        }
      },
      error : function(){
        alert('error');
      }
    });
  });
  $(document).on('input','#upass_baru',function(){
    var pass_baru = $('#pass_baru').val();
    var upass_baru = $(this).val();

    if(upass_baru==pass_baru){
      document.getElementById('divNotif').style.display ='none';
      document.getElementById('simpan').disabled = false;
    }else{
      document.getElementById('divNotif').style.display ='block';
      $('#textNotif').html('PASSWORD HARUS SAMA!!');
      document.getElementById('simpan').disabled = true;
    }
        
  });
</script>