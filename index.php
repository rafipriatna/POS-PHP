<?php
    include ('koneksi.php');
    ob_start();
    include ('modul/kode_penjualan.php');
    ob_end_clean();
    session_start();
    if (!isset($_SESSION['id'])) {
        header("location: masuk.php");
    }
    else {
        
        if(isset($_SESSION['waktu']) && (time() - $_SESSION['waktu'] > $_SESSION['habis'] )) {
            echo 'Kamu diem aja selama 30 Menit, silahkan <a href="masuk.php">masuk</a> lagi.';
            session_destroy();
        }
        else {
    // Tiap masuk ke halaman, akan selalu di refresh waktu nya.
    // Jik pengguna diem aja sampai waktu habis, maka akan di matikan session nya.
    $_SESSION['waktu'] = time();
    // Masuk ke halaman utama.
    // Mengambil id session yang masuk.
    $id     = $_SESSION['id'];
    // Mengambil data dari tb_pengaturan dan tb_pengguna dan mengambil id dari sessionnya.
    $rafi = $koneksi->query("SELECT * FROM tb_pengaturan, tb_pengguna WHERE id = '$id'");
    $tampil = $rafi->fetch_assoc();

?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="RMarket tempat jualan serba ada.">
    <meta name="author" content="Rafi Priatna Kasbiantoro">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <title><?php echo $tampil['namasitus'];?></title>
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/lib/sweetalert/sweetalert.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="https:**oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https:**oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="fix-header fix-sidebar">
    
    <div id="main-wrapper">
        <div class="header">
        <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">
                        <b>R</b>
                        <span>Market</span>
                    </a>
                </div>
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted  " href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <li class="nav-item m-l-10"> <a class="nav-link sidebartoggler hidden-sm-down text-muted  " href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                    </ul>
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted  " href="#" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <b>LAST LOGIN : </b><?php echo $tampil['kpn_masuk'];?></i>
							</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-info" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/foto/<?php echo  $tampil['foto']; ?>" alt="user" class="profile-pic" />
                            <?php echo $tampil['nama'];?></a>
                            <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                                <ul class="dropdown-user">
                                    <li><a href="?page=profil"><i class="ti-user"></i> Profile</a></li>
                                    <li><a href="?page=profil&aksi=gantipassword"><i class="ti-key"></i> Ganti Password</a></li>
                                    <li><a href="keluar.php"><i class="fa fa-power-off"></i> Keluar</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

        </div>
        <div class="left-sidebar">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-label">Home</li>
                        <li> <a href="index.php" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Dashboard</span></a>
                        </li>

                        <li class="nav-label">Kasir</li>
                        <li> <a href="?page=penjualan&kode_penjualan=<?php echo $kode; ?>" aria-expanded="false"><i class="fa fa-cart-plus"></i><span class="hide-menu">Penjualan</span></a>
                        </li>
                        <li> <a href="?page=transaksi" aria-expanded="false"><i class="fa fa-shopping-cart"></i><span class="hide-menu">Transaksi</span></a>
                        </li>
                        <?php
                        // Jika level adalah Admin.
                            $level = $_SESSION['level'] == 'Admin';
                            if($level){
                        ?>
                        <li class="nav-label">Admin</li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-archive"></i><span class="hide-menu">Barang</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="?page=barang">Data Barang</a></li>
                                <li><a href="?page=kategori_barang">Kategori Barang</a></li>
                            </ul>
                        </li>
                        <li> <a href="?page=pengguna" aria-expanded="false"><i class="fa fa-users"></i><span class="hide-menu">Pengguna</span></a>
                        </li>
                        <li> <a href="?page=pelanggan" aria-expanded="false"><i class="fa fa-user"></i><span class="hide-menu">Pelanggan</span></a>
                        </li>
                        <li><a href="#" data-toggle="modal" aria-expanded="false" data-target="#myModal"><i class="fa fa-area-chart"></i><span class="hide-menu">Laporan</span></a></li>
                        <li> <a href="?page=pengaturan" aria-expanded="false"><i class="fa fa-cogs"></i><span class="hide-menu">Pengaturan</span></a>
                        </li>
                        <?php } ?>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                      
                            <?php
                                // $page = $_GET['page'];
                                // $aksi = $_GET['aksi'];
                                // Awalnya pake variable diatas pake server WAMP di linux, tapi pas pake server XAMPP di windows
                                // Malah muncul error, jadi diganti ke variable dibawah.
                                $page = isset($_GET['page']) ? $_GET['page'] : "";
                                $aksi = isset($_GET['aksi']) ? $_GET['aksi'] : "";
                                // Halaman universal
                                if ($page == ""){
                                    if ($aksi == ""){
                                        include "page/dasbor/dasbor.php";
                                    }

                                }
                                if ($page == "profil"){
                                    if ($aksi == ""){
                                        include "page/profil/profil.php";
                                    }
                                    if ($aksi == "gantipassword"){
                                        include "page/profil/ganti_password.php";
                                    }

                                }
                                // Halaman untuk Admin
                                if ($_SESSION['level'] == 'Admin'){
                                if ($page == "barang") {
                                    if ($aksi == "") {
                                        include "page/barang/barang.php";
                                    }
                                    if ($aksi =="tambah"){
                                        include "page/barang/tambah.php";
                                    }
                                    if ($aksi =="ubah"){
                                        include "page/barang/ubah.php";
                                    }
                                    if ($aksi =="hapus"){
                                        include "page/barang/hapus.php";
                                    }
                                }

                                if ($page == "kategori_barang") {
                                    if ($aksi == "") {
                                        include "page/kategori_barang/kategori_barang.php";
                                    }
                                    if ($aksi =="tambah"){
                                        include "page/kategori_barang/tambah.php";
                                    }
                                    if ($aksi =="ubah"){
                                        include "page/kategori_barang/ubah.php";
                                    }
                                    if ($aksi =="hapus"){
                                        include "page/kategori_barang/hapus.php";
                                    }
                                }

                                if ($page == "pelanggan") {
                                    if ($aksi == "") {
                                        include "page/pelanggan/pelanggan.php";
                                    }
                                    if ($aksi == "tambah") {
                                        include "page/pelanggan/tambah.php";
                                    }
                                    if ($aksi == "ubah") {
                                        include "page/pelanggan/ubah.php";
                                    }
                                    if ($aksi == "hapus") {
                                        include "page/pelanggan/hapus.php";
                                    }
                                }

                                if ($page == "pengguna") {
                                    if ($aksi == "") {
                                        include "page/pengguna/pengguna.php";
                                    }
                                    if ($aksi == "tambah") {
                                        include "page/pengguna/tambah.php";
                                    }
                                    if ($aksi == "ubah") {
                                        include "page/pengguna/ubah.php";
                                    }
                                    if ($aksi == "hapus") {
                                        include "page/pengguna/hapus.php";
                                    }
                                    if ($aksi == "gantipass") {
                                        include "page/pengguna/gantipass.php";
                                    }
                                }

                                if ($page == "pengaturan"){
                                    if ($aksi == ""){
                                        include "page/pengaturan/pengaturan.php";
                                    }
                                    if ($aksi == "tambah"){
                                        include "modul/pembayaran/tambah.php";
                                    }
                                    if ($aksi == "ubah"){
                                        include "modul/pembayaran/ubah.php";
                                    }
                                    if ($aksi == "hapus"){
                                        include "modul/pembayaran/hapus.php";
                                    }
                                }
                                 }else{
                                     
                                 }
                                // Halaman untuk Kasir
                                if ($page == "penjualan") {
                                    if ($aksi == "") {
                                        include "page/penjualan/penjualan.php";
                                    }
                                    if ($aksi == "tambah") {
                                        include "page/penjualan/tambah.php";
                                    }
                                    if ($aksi == "kurang") {
                                        include "page/penjualan/kurang.php";
                                    }
                                    if ($aksi == "hapus") {
                                        include "page/penjualan/hapus.php";
                                    }
                                    if ($aksi == "laporan"){
                                        include "page/penjualan/laporan.php";
                                    }
                                }

                                if ($page == "transaksi") {
                                    if ($aksi == "") {
                                        include "page/transaksi/transaksi.php";
                                    }
                                }
                            
                                
                            ?>
                            </div>
                        </div>
            </div>
        </div>
    </div>

<div class="modal" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Laporan</h5>
      </div>
      <div class="modal-body">
        <p>Lihat laporan berdasarkan tanggal.</p>
        <form method="POST" action="modul/laporan.php">
            <div class="form-group">
                <label>Dari tanggal</label>
                <input class="form-control" type="date" name="daritanggal">
            </div>
            <div class="form-group">
                <label>Sampai tanggal</label>
                <input class="form-control" type="date" name="sampaitanggal">
            </div>
        
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Lihat</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
                            </form>
    </div>
  </div>
</div>

    <script src="js/lib/jquery/jquery.min.js"></script>
    <script src="js/lib/bootstrap/js/popper.min.js"></script>
    <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/sidebarmenu.js"></script>
    <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="js/custom.min.js"></script>

    <script src="js/lib/datatables/datatables.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="js/lib/datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script src="js/lib/datatables/datatables-init.js"></script>
    

</body>

</html>
<?php }
} ?>