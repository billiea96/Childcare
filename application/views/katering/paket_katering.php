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

  <?php if(isset($_SESSION['info'])) { ?>
  <div class="alert alert-info alert-dismissible fade in" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
    <strong><?php echo $_SESSION['info']; ?></strong>
  </div>
  <?php unset($_SESSION['info']); ?>
  <?php } ?>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Master Paket Katering</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <?php echo validation_errors(); ?>
          <form class="form-horizontal form-label-left" id="form_paket_katering" action="<?php echo site_url('PaketKatering/add') ?>" method="POST">
            <!-- <div class="item form-group">
              <label class="control-label col-sm-4" for="Nama">Nama <span class="required">*</span>
              </label>
              <div class="col-md-3">
                <select class="form-control" id="Nama" name="Nama" required="">
                  <option value="PAKET 1">PAKET 1</option>
                  <option value="PAKET 2">PAKET 2</option>
                </select>
              </div>
            </div> -->
            <div class="form-group">
              <label class="control-label col-md-2 col-sm-3 col-xs-12" for="tanggal_awal">Tanggal Awal <span class="required">*</span>
              </label>
              <div class="col-md-3 col-sm-6 col-xs-12">
                <input type="text" required="" class="form-control" id="tanggal_awal" name="tanggal_awal">
                <span class="fa fa-calendar form-control-feedback right" aria-hidden="false"></span>
              </div>
               <label class="control-label col-md-2 col-sm-3 col-xs-12" for="tanggal_akhir">Tanggal Akhir <span class="required">*</span>
              </label>
              <div class="col-md-3 col-sm-6 col-xs-12">
                <input type="text" required="" class="form-control" id="tanggal_akhir" name="tanggal_akhir">
                <span class="fa fa-calendar form-control-feedback right" aria-hidden="false"></span>
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-3 col-md-offset-5">
                <button id="generate" type="button" class="btn btn-primary">Generate</button>
              </div>
            </div>
            
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="row" style="display: none;" id="content1">
   <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="col-md-12 table-responsive">
            <table id="table" class="table table-bordered table-hover text-center" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th class="col-md-3" style="text-align: center;">Tanggal</th>
                  <th class="col-md-4" style="text-align: center;">Nama</th>
                  <th class="col-md-3" style="text-align: center;">Makanan</th>
                  <th class="col-md-2" style="text-align: center;">Isi</th>
                </tr>
              </thead>
              <tbody id="tbody">
                
              </tbody>
            </table>
          </div>
          <div class="clearfix"></div>
          <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-3 col-md-offset-5">
                <button id="simpanMakanan" type="submit" form="form_paket_katering" class="btn btn-success" >Simpan</button>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row" id="daftar_paket">
   <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Daftar Paket</h2>
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
                <th class="col-sm-3" style="text-align: center;">Tanggal</th>
                <th class="col-sm-3" style="text-align: center;">Status</th>
                <th class="col-sm-2" style="text-align: center;">Edit</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $counter=0;
              foreach ($paket as $key => $value) { ?>
              <?php if(strtotime($value['Tanggal'])>strtotime(date('Y-m-d'))){ ?>
              <tr>
                <td><?php $counter++; echo $counter; ?></td>
                <td><a href="<?php echo site_url('PaketKatering/detail_katering_index/'.$value['Id']); ?>"><?php echo $value['Nama'] ?></a></td>
                <td><?php echo DateTime::createFromFormat('Y-m-d', $value['Tanggal'])->format('D, d M Y');?></td>
                <td><?php if($value['Status']==1) echo "Detail Makanan Sudah Ada"; else echo "Detail Makanan Belum ada, Harap isi"; ?></td>
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
                              <h4 class="modal-title">Edit Data Paket</h4>
                          </div>
                          <div class="modal-body">
                              <div class="row">
                                  <div class="col-sm-12 table-responsive">
                                      <?php echo validation_errors(); ?>
                                      <form class="form-horizontal form-label-left" id="formUpdate<?php echo $value['Id']; ?>" action="<?php echo site_url('PaketKatering/edit'); ?>" method="POST">
                                          <div class="col-sm-offset-10 col-sm-1"></div><br>
                                          <div class="col-sm-8 col-sm-offset-2">
                                                  <input type="hidden" class="form-control" name="id_paket" id="id_paket" value="<?php echo $value['Id']; ?>">
                                                 
                                                  <div class="item form-group">
                                                    <label style="text-align: right;" class="control-label col-md-4" for="Nama">Nama :
                                                    </label>
                                                    <div class="col-md-6">
                                                      <input type="text" class="form-control" value="<?php echo $value['Nama'] ?>" disabled>
                                                      <input type="hidden" name="nama" value="<?php echo $value['Nama'] ?>">
                                                    </div>
                                                  </div><div class="clearfix"></div><br>
                                                  <div class="item form-group">
                                                    <label style="text-align: right;" class="control-label col-md-4" for="Tanggal">Tanggal :</label>
                                                    <div class="col-md-7">
                                                      <input type="text" required="" class="form-control tanggal" id="Tanggal<?php echo $value['Id'];?>" name="Tanggal" value="<?php echo $value['Tanggal']; ?>">
                                                      <span class="fa fa-calendar form-control-feedback right" aria-hidden="false"></span>
                                                    </div>
                                                  </div><div class="clearfix"></div>
                                                  <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
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
              

              <?php } } ?>
            </tbody>
          </table>


        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal untuk isi makanan-->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg" id="isi_modal">

    <!-- Modal content-->
    <div class="modal-content">
      <div id="modal_body">
        
      </div>
    </div>

  </div>
</div>

<script>
    document.getElementById("simpanMakanan").addEventListener("click", function(event){
        var temp =document.getElementsByClassName('input_status');
        var jumlahSemua=0;
        for(i=0;i<temp.length;i++){
          jumlahSemua++;
        }
        var counter =0;
        for(i=0;i<temp.length;i++){
          if(temp[i].value ==1){
            counter++;
          }
        }

        if(counter<jumlahSemua){
          alert('Makanan belum terisi semua disetiap paketnya ');
          event.preventDefault();
        }
    });
    $(document).ready(function() {
        $('#datatable-responsive').DataTable({
            responsive: true
        });
        $('[data-toggle="modal"]').tooltip();
    });
    $('#tanggal_awal').datetimepicker({
        format: 'DD-MM-YYYY'
    });
    $('#tanggal_akhir').datetimepicker({
        format: 'DD-MM-YYYY'
    });
    $('.tanggal').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $('#generate').on('click',function(){
      var tanggal_awal = $('#tanggal_awal').val();
      var tanggal_akhir = $('#tanggal_akhir').val();

      document.getElementById('daftar_paket').style.display = 'none';
      document.getElementById('content1').style.display = 'block';

      $.ajax({
        url : '<?php echo site_url("PaketKatering/generate_katering"); ?>',
        method : 'POST',
        data : {
          'tanggal_awal' : tanggal_awal,
          'tanggal_akhir' : tanggal_akhir,
        },
        success : function(data){
          $('#tbody').html(data);
        }
      });
    });
    $(document).on('click','.showDialog',function(){   
      var paket= $(this).data('paket');
      var tanggal= $(this).data('tanggal');

      var elementExists = document.getElementById("body"+paket+tanggal);

      if(elementExists==null){
        $.ajax({
          url : '<?php echo site_url("PaketKatering/show_modal"); ?>',
          method : 'POST',
          data : {
            'paket' :paket,
            'tanggal' : tanggal,
          },
          success : function(data){
            document.getElementById('modal_body').innerHTML += data;
          }
        });
      }else{
        elementExists.style.display ="block";
      }
    });
    $(document).on('click','.simpanHidden',function(){   
      var paket= $(this).data('paket');
      var tanggal= $(this).data('tanggal');

      var elementExists = document.getElementById("body"+paket+tanggal);

      if(elementExists){
        elementExists.style.display ='none';
        var counter = document.getElementById("tbody"+paket+tanggal).childElementCount;
        if(counter==0){
          document.getElementById("status"+paket+"_"+tanggal).value = 0;
          document.getElementById("spanStatus"+paket+tanggal).style.color = "red";
          document.getElementById("spanStatus"+paket+tanggal).innerHTML = "Detail makanan belum disi!!";
        }else{
          document.getElementById("status"+paket+"_"+tanggal).value = 1;
          document.getElementById("spanStatus"+paket+tanggal).style.color = "#5c7db2";

          var nama_makanan = document.getElementsByName('nama_makanan'+paket+tanggal+'[]');

          var temp='';
          for(i=0;i<nama_makanan.length;i++){
            temp+=nama_makanan[i].value+', ';
          }
        
          document.getElementById("spanStatus"+paket+tanggal).innerHTML = temp;
        }
      }
    });
    $(document).on('click','.tambahMakanan',function(){   
      var paket= $(this).data('paket');
      var tanggal= $(this).data('tanggal');
      var nama_makanan = $('#nama_makanan'+paket+tanggal).val();
      var bahan = $('#bahan'+paket+tanggal).val();

      var counter = document.getElementById("tbody"+paket+tanggal).childElementCount;

      $.ajax({
        url : '<?php echo site_url("PaketKatering/tambah_makanan");  ?>',
        method : 'POST',
        data : {
          'paket' : paket,
          'tanggal' : tanggal,
          'counter' : counter,
          'nama_makanan' : nama_makanan,
          'bahan' : bahan,
        },
        success : function(data){
          document.getElementById("tbody"+paket+tanggal).innerHTML += data;
          document.getElementById("nama_makanan"+paket+tanggal).value= "";
          document.getElementById("bahan"+paket+tanggal).value= "";
        }
      });
      
    });
    $(document).on('click','.hapusMakanan',function(){   
      var paket= $(this).data('paket');
      var tanggal= $(this).data('tanggal');
      var counter = $(this).data('counter');

      $("#rowMakanan"+paket+tanggal+counter).remove();
      
    });
</script>