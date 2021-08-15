<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Angels N I | </title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>public/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url(); ?>public/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url(); ?>public/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url(); ?>public/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="<?php echo base_url(); ?>public/vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    <!-- DataTables Responsive CSS -->
    <link href="<?php echo base_url(); ?>public/vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/select2/dist/css/select2.min.css">
    <!-- bootstrap-datetimepicker -->
    <link href="<?php echo base_url(); ?>public/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url(); ?>public/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
     <!-- my style calendar -->
     <link href="<?php echo base_url(); ?>public/my_style/calendar.css" rel="stylesheet">
     <!-- my style table -->
     <link href="<?php echo base_url(); ?>public/my_style/table.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url(); ?>public/build/css/custom.min.css" rel="stylesheet">


    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>public/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>public/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url(); ?>public/vendors/nprogress/nprogress.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url(); ?>public/vendors/fastclick/lib/fastclick.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url(); ?>public/vendors/iCheck/icheck.min.js"></script>
    <!-- DataTables JavaScript -->
    <script src="<?php echo base_url(); ?>public/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>public/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>public/vendor/datatables-responsive/dataTables.responsive.js"></script>
    <!-- Select2 -->
    <script src="<?php echo base_url(); ?>public/select2/dist/js/select2.full.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url(); ?>public/vendors/moment/min/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>public/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-datetimepicker -->    
    <script src="<?php echo base_url(); ?>public/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <!-- jQuery Smart Wizard -->
    <script src="<?php echo base_url(); ?>public/vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
    <!-- Format Price -->
    <script src="<?php echo base_url(); ?>public/js/jquery.priceformat.min.js"></script>

  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="#" class="site_title"><i class="fa fa-paw"></i> <span>Angels N I</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php echo base_url(); ?>public/image/profile_def.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $_SESSION['nama']; ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <?php if($_SESSION['hak_akses']=='ADMIN'||$_SESSION['hak_akses']=='NANNY'||$_SESSION['hak_akses']=='KEPERAWATAN'||$_SESSION['hak_akses']=='KEPALA TPA'){?>
                  <li><a href="<?php echo site_url('Anak/index'); ?>"><i class="fa fa-user"></i>Anak</a></li>
                  <?php }else if($_SESSION['hak_akses']=='ANAK'){?>
                  <li><a href="<?php echo site_url('Anak/profil/'.$_SESSION['id']); ?>"><i class="fa fa-user"></i>Profil</a></li>
                  <?php }?>
                  <?php if($_SESSION['hak_akses']=='ADMIN'){?>
                  <ul class="nav side-menu">
                    <li><a><i class="fa fa-pencil-square-o"></i> Pendaftaran <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="<?php echo site_url('Pendaftaran/index'); ?>">Pendaftaran</a></li>
                        <li><a href="<?php echo site_url('Pendaftaran/validasi'); ?>">Validasi</a></li>
                      </ul>
                    </li>
                  </ul>
                  <?php } ?>
                  <?php if($_SESSION['hak_akses']=='GUEST'){ ?>
                  <li><a href="<?php echo site_url('Pendaftaran/index'); ?>"><i class="fa fa-pencil-square-o"></i>Pendaftaran</a></li>
                  <?php } ?>
                  <?php if($_SESSION['hak_akses']=='ADMIN') { ?>
                  <li><a href="<?php echo site_url('Absensi/index'); ?>"><i class="fa fa-check-square-o"></i>Absensi</a>
                  </li>
                  <?php }?>
                
                  <?php if($_SESSION['hak_akses']=='ADMIN'){?>
                  <li><a href="<?php echo site_url('CatatanPengeluaran/index'); ?>"><i class="fa fa-usd"></i>Catatan Pengeluaran</a>
                  </li>
                  <?php } ?>
                  <?php if($_SESSION['hak_akses']=='ANAK'){?>
                    <li><a href="<?php echo site_url('Pembayaran/tampil_tagihan'); ?>"><i class="fa fa-money"></i>Tagihan Pembayaran <span class="fa fa-bell" style="color:red;display: none;" id="spanNotif"></span></a>
                      </li>
                  <?php } ?>
                  <?php if($_SESSION['hak_akses']=='ADMIN'){?>
                  <li><a href="<?php echo site_url('Paket/ganti_paket'); ?>"><i class="fa fa-recycle"></i>Ganti Paket</a>
                  </li>
                  <?php } ?>

                  <!-- <li><a href="<?php echo site_url('FormHarian/index'); ?>"><i class="fa fa-money"></i>Form Harian</a>
                  </li> -->
                  <?php if($_SESSION['hak_akses']=='ADMIN'||$_SESSION['hak_akses']=='NANNY'){?>
                  <li><a href="<?php echo site_url('CatatanPerkembangan/index'); ?>"><i class="fa fa-street-view"></i>Perkembangan Anak</a>
                  </li>
                  <?php } ?>
                  <?php if($_SESSION['hak_akses']=='ANAK') { ?>
                  <li><a href="<?php echo site_url('DaftarKatering/index'); ?>"><i class="fa fa-shopping-basket"></i>Daftar Katering</a></li>
                  <?php } ?>
                  <?php if($_SESSION['hak_akses']=='ANAK'){?>
                    <li><a href="<?php echo site_url('CatatanPerkembangan/foto_perkembangan'); ?>"><i class="fa fa-file-image-o"></i>Foto Perkembangan Anak</a>
                    </li>
                  <?php } ?>
                </ul>

                <?php if($_SESSION['hak_akses']=='ADMIN'){?>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-shopping-basket"></i> Katering <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo site_url('DaftarKatering/index'); ?>">Daftar Katering</a></li>
                      <li><a href="<?php echo site_url('DaftarKatering/rekap'); ?>">Rekap Katering</a></li>
                    </ul>
                  </li>
                </ul>
                <?php } ?>
                <?php if($_SESSION['hak_akses']=='ADMIN'){?>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-money"></i> Pembayaran <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo site_url('Pembayaran/index'); ?>">Tagihan Pembayaran</a>
                      </li>
                      <li><a href="<?php echo site_url('Pembayaran/pelunasan'); ?>">Pelunasan</a></li>
                    </ul>
                  </li>
                </ul>
                <?php } ?>
                <?php if($_SESSION['hak_akses']=='ANAK'){?>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-soccer-ball-o"></i>Foto Kegiatan <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo site_url('KegiatanRutinAnak/foto_kegiatan'); ?>"> Kegiatan Rutin Anak</a>
                      </li>
                      <li><a href="<?php echo site_url('KegiatanNonRutinAnak/foto_kegiatan'); ?>"> Kegiatan Non Rutin Anak</a></li>
                    </ul>
                  </li>
                </ul>
                <?php } ?>
                <?php if($_SESSION['hak_akses']=='ADMIN'||$_SESSION['hak_akses']=='NANNY'){?>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-soccer-ball-o"></i> Kegiatan <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo site_url('KegiatanRutinAnak/index'); ?>"> Kegiatan Rutin Anak</a>
                      </li>
                      <li><a href="<?php echo site_url('KegiatanNonRutinAnak/index'); ?>"> Kegiatan Non Rutin Anak</a></li>
                    </ul>
                  </li>
                </ul>
                <?php } ?>
                <?php if($_SESSION['hak_akses']=='ADMIN'||$_SESSION['hak_akses']=='NANNY'){?>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-book"></i> Form Harian <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo site_url('FormHarian/buat_form'); ?>">Buat Form</a>
                      </li>
                      <li><a href="<?php echo site_url('FormHarian/catatan_makan'); ?>">Catatan Makan</a>
                      </li>
                      <li><a href="<?php echo site_url('FormHarian/catatan_snack'); ?>">Catatan Snack</a>
                      </li>
                      <li><a href="<?php echo site_url('FormHarian/catatan_tidur'); ?>">Catatan Tidur</a>
                      </li>
                      <li><a href="<?php echo site_url('FormHarian/catatan_minum_susu'); ?>">Catatan Minum Susu</a>
                      </li>
                      <li><a href="<?php echo site_url('FormHarian/catatan_bab'); ?>">Catatan BAB</a>
                      </li>
                      <li><a href="<?php echo site_url('FormHarian/catatan_obat_vitamin'); ?>">Catatan 
                      Obat & Vit</a></li>
                      <li><a href="<?php echo site_url('FormHarian/catatan_akhir'); ?>">Catatan Akhir</a>
                      </li>
                    </ul>
                  </li>
                </ul>
                <?php } ?>
                <?php if($_SESSION['hak_akses']=='ADMIN'||$_SESSION['hak_akses']=='KEPERAWATAN'){?>
                 <ul class="nav side-menu">
                  <li><a><i class="fa fa-heartbeat"></i> Menu Kesehatan <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo site_url('RiwayatImunisasi/index'); ?>">Imunisasi</a>
                      </li>
                      <li><a href="<?php echo site_url('RiwayatKesehatan/index'); ?>">Kesehatan</a>
                      </li>
                      <li><a href="<?php echo site_url('PertumbuhanFisik/index'); ?>">Pertumbuhan Fisik</a>
                      <li><a href="<?php echo site_url('PertumbuhanFisik/buat_laporan'); ?>">Buat Laporan</a>
                      </li>
                    </ul>
                  </li>
                </ul>
                <?php }?>
                <?php if($_SESSION['hak_akses']=='ADMIN'){?>
                <ul class="nav side-menu">
                  <li><a href="<?php echo site_url('Riwayat/index'); ?>"><i class="fa fa-archive"></i>Riwayat</a>
                  </li>
                </ul>
                <?php } ?>
                <?php if($_SESSION['hak_akses']=='ADMIN'){?>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-database"></i> Master <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo site_url('Anak/master'); ?>">Anak</a></li>
                      <li><a href="<?php echo site_url('Orangtua/index'); ?>">Orangtua</a></li>
                      <li><a href="<?php echo site_url('Karyawan/index'); ?>">Karyawan</a></li>
                      <li><a href="<?php echo site_url('Jabatan/index'); ?>">Jabatan</a></li>
                      <li><a href="<?php echo site_url('KegiatanNonRutin/index'); ?>">Kegiatan Non Rutin</a></li>
                      <li><a href="<?php echo site_url('KegiatanRutin/index'); ?>">Kegiatan Rutin</a></li>
                      <li><a href="<?php echo site_url('Vaksinasi/index'); ?>">Vaksinasi</a></li>
                      <li><a href="<?php echo site_url('Terapi/index'); ?>">Terapi</a></li>
                      <li><a href="<?php echo site_url('PeriodeAsuh/index'); ?>">Periode Asuh</a></li>
                      <li><a href="<?php echo site_url('PeriodeAsuhKaryawanAnak/index'); ?>">Pengasuh Anak</a></li>
                      <li><a href="<?php echo site_url('Paket/index'); ?>">Paket Pendaftaran</a></li>
                      <li><a href="<?php echo site_url('KategoriIndikator/index'); ?>">Kategori Indikator</a></li>
                      <li><a href="<?php echo site_url('IndikatorPerkembangan/index'); ?>">Indikator Pekembangan</a></li>
                      <li><a href="<?php echo site_url('PaketKatering/index'); ?>">Paket Katering</a></li>
                      <li><a href="<?php echo site_url('KategoriPengeluaran/index'); ?>">Kategori Pengeluaran</a></li>
                      <li><a href="<?php echo site_url('PaketKatering/setting'); ?>">Setting harga paket katering</a></li>
                      <li><a href="<?php echo site_url('User/index'); ?>">User</a></li>
                    </ul>
                  </li>
                </ul>
                <?php }?>
                <?php if($_SESSION['hak_akses']!=='GUEST'){ ?>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-file-text-o"></i> Laporan <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <?php if($_SESSION['hak_akses']=='ADMIN'||$_SESSION['hak_akses']=='KEPALA TPA'||$_SESSION['hak_akses']=='NANNY'||$_SESSION['hak_akses']=='ANAK'){?>
                      <li><a href="<?php echo site_url('Laporan/form_harian'); ?>">Form Harian</a></li>
                      <?php } ?>
                      <?php if($_SESSION['hak_akses']=='ADMIN'||$_SESSION['hak_akses']=='KEPALA TPA'||$_SESSION['hak_akses']=='NANNY'||$_SESSION['hak_akses']=='ANAK'){?>
                      <li><a href="<?php echo site_url('Laporan/form_perkembangan'); ?>">Form Perkembangan</a></li>
                      <?php } ?>
                      <?php if($_SESSION['hak_akses']=='ADMIN'||$_SESSION['hak_akses']=='KEPALA TPA'||$_SESSION['hak_akses']=='NANNY'||$_SESSION['hak_akses']=='ANAK'){?>
                      <li><a href="<?php echo site_url('Laporan/kegiatan_rutin'); ?>">Kegiatan Rutin</a></li>
                      <?php } ?>
                      <?php if($_SESSION['hak_akses']=='ADMIN'||$_SESSION['hak_akses']=='KEPALA TPA'||$_SESSION['hak_akses']=='NANNY'||$_SESSION['hak_akses']=='ANAK'){?>
                      <li><a href="<?php echo site_url('Laporan/Kegiatan_non_rutin'); ?>">Kegiatan Non Rutin</a></li>
                      <?php } ?>
                      <?php if($_SESSION['hak_akses']=='ADMIN'||$_SESSION['hak_akses']=='KEPALA TPA'||$_SESSION['hak_akses']=='KEPERAWATAN'||$_SESSION['hak_akses']=='ANAK'){?>
                      <li><a href="<?php echo site_url('Laporan/form_kesehatan'); ?>">Form Kesehatan</a></li>
                      <?php } ?>
                      <?php if($_SESSION['hak_akses']=='ADMIN'||$_SESSION['hak_akses']=='KEPALA TPA'){?>
                      <li><a href="<?php echo site_url('Laporan/absensi'); ?>">Absensi</a></li>
                      <?php } ?>
                      <?php if($_SESSION['hak_akses']=='ADMIN'||$_SESSION['hak_akses']=='KEPALA TPA'||$_SESSION['hak_akses']=='ANAK'){?>
                      <li><a href="<?php echo site_url('Laporan/katering'); ?>">Katering</a></li>
                      <?php } ?>
                      <?php if($_SESSION['hak_akses']=='ADMIN'||$_SESSION['hak_akses']=='KEPALA TPA'){?>
                      <li><a href="<?php echo site_url('Laporan/catatan_pengeluaran'); ?>">Catatan Pengeluaran</a></li>
                      <?php } ?>
                      <?php if($_SESSION['hak_akses']=='ADMIN'||$_SESSION['hak_akses']=='KEPALA TPA'||$_SESSION['hak_akses']=='ANAK'){?>
                      <li><a href="<?php echo site_url('Laporan/pembayaran'); ?>">Pembayaran</a></li>
                      <?php } ?>
                    </ul>
                  </li>
                </ul>
                <?php } ?>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <?php if($_SESSION['hak_akses']!='GUEST'){ ?>
              <a data-toggle="tooltip" data-placement="top" title="Settings" href="<?php echo site_url('User/setting'); ?>">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <?php } ?>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo site_url('Auth/logout'); ?>">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo base_url(); ?>/public/image/profile_def.png" alt=""><?php echo $_SESSION['username']; ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <?php if($_SESSION['hak_akses']!='GUEST'){ ?>
                    <li><a href="<?php echo site_url('User/setting'); ?>"> Setting</a></li>
                    <?php }?>
                    <!-- <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li> -->
                    <li><a href="<?php echo site_url('Auth/logout'); ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <script type="text/javascript">
          <?php if(isset($_SESSION['notif_tagihan2'])){ ?>
            document.getElementById('spanNotif').style.display='block';
          <?php }?>
        </script>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          
          

          

            



            
          
          
        
