<?php
    include('koneksi.php');
    $barang            = $koneksi->query("SELECT * FROM tb_barang");
    $jual              = $koneksi->query("SELECT * FROM tb_datapenjualan");
    $data_pengguna     = $koneksi->query("SELECT * FROM tb_pengguna");
    $data_penghasilan  = $koneksi->query("SELECT SUM(subtotal) AS penghasilan FROM tb_datapenjualan");
    $data_barang       = mysqli_num_rows($barang);
    $transaksi         = mysqli_num_rows($jual);
    $pengguna          = mysqli_num_rows($data_pengguna);
    $penghasilan       = $data_penghasilan->fetch_assoc();
    function rupiah($angka){
	
        $hasil_rupiah  = number_format($angka,2,',','.');
        return $hasil_rupiah;
    }

    $datasitus         = $koneksi->query("SELECT * FROM tb_pengaturan");
    $ambil             = $datasitus->fetch_assoc();
    
?>
<div class="row">
                    <div class="col-md-3">
                        <div class="card p-30">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                    <span style="font-size:28px" class="text-info">Rp</span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2><?php echo rupiah($penghasilan['penghasilan']); ?></h2>
                                    <p class="m-b-0">Total Penghasilan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-30">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                    <span><i class="fa fa-shopping-cart f-s-40 color-success"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2>
                                    <?php
                                        if ($transaksi > 0){
                                            echo $transaksi;
                                        }else{
                                            echo "0";
                                        }
                                    ?></h2>
                                    <p class="m-b-0">Transaksi</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-30">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                    <span><i class="fa fa-archive f-s-40 color-warning"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2><?php echo $data_barang;?></h2>
                                    <p class="m-b-0">Barang</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-30">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                    <span><i class="fa fa-user f-s-40 color-danger"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2><?php echo $pengguna;?></h2>
                                    <p class="m-b-0">Pengguna</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<div class="card card-outline-danger">
    <div class="card-body">
        <div class="card-title">
        <h4><?php echo $ambil['namasitus'];?></h4>
        </div>
        <p>Aplikasi resmi dari RMarket</br>
        Anda PUAS kami senang :D</p>
    </div>
</div>