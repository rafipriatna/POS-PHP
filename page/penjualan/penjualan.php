<?php
    $kode   = $_GET['kode_penjualan'];
    // Mengambil nama kasir berdasarkan id session yang login.
    $id  = $_SESSION['id'];
    $rafi = $koneksi->query("SELECT * FROM tb_pengaturan, tb_pengguna WHERE id = '$id'");
    $tampil = $rafi->fetch_assoc();
    $kasir  = $tampil['nama'];
?>
<div class="card card-outline-danger">
    <div class="card-body">
    <h4 class="card-title">Penjualan</h4>
<form method="post" enctype="multipart/form-data">
    <div class="row col-lg-6">
        <div class="col-md-6">
            <div class="form-group">
                <label>Kode Penjualan</label>
                <input type="text" value="<?php echo $kode; ?>" disabled class="form-control">
            </div>
        </div>
        <!--/span-->
        <div class="col-md-6">
            <div class="form-group">
                <label>Barcode</label>
                <input type="text" name="barcode" autofocus class="form-control">
            </div>
        </div>
        <!--/span-->
        <div class="form-actions col-lg-6">
            <input type="submit" name="simpan" value="Tambah" class="btn btn-info">   
        </div>
    </div>
</form>
    </br>

<?php
// Jika tombol simpan di klik.
    if(isset($_POST['simpan'])){
// Membuat format untuk tanggal dan waktu.        
        $setting    = new DateTime('NOW', new DateTimeZone('Asia/Jakarta'));
        $tanggal    = $setting->format('Y-m-d');
        $waktu      = $setting->format('H:i:s');
        $kodepj     = $_GET['kode_penjualan'];
        $barcode    = $_POST['barcode'];
// Mengambil data barang berdasarkan barcodenya.
        $barang     = $koneksi->query("SELECT * FROM tb_barang WHERE barcode = '$barcode'");
        $databarang = $barang->fetch_assoc();
        $hargajual  = $databarang['harga_jual'];
        $jumlah     = 1;
        $total      = $jumlah * $hargajual;

        $barang2    = $koneksi->query("SELECT * FROM tb_barang WHERE barcode ='$barcode'");
        while ($databarang2 = $barang2->fetch_assoc()){
            $sisa   = $databarang2['stock'];
// Jika stock barang habis.
            if($sisa == 0){
                ?>
                    <script type="text/javascript">
                    alert("Stock habis gan");
                    window.location.herf="?page=penjualan?kode_penjualan<?php echo $kode;?>";
                    </script>
                <?php
            }else{
// Jika stock masih ada masuk ke tb_penjualan.
                $koneksi->query("INSERT INTO tb_penjualan (kode_penjualan, barcode, jumlah, total,
                tgl_penjualan, waktu_penjualan) VALUES('$kodepj', '$barcode', '$jumlah', '$total', '$tanggal', '$waktu' )");
            }
        }
    }
    
?>
<h4 class="card-title">Daftar Belanjaan</h4>
         <div class="table-responsive m-t-40 ">
             <table class="table table-bordered table-striped">
                 <thead>
                     <tr>
                         <th>No</th>
                         <th>Barcode</th>
                         <th>Nama Barang</th>
                         <th>Harga</th>
                         <th>Jumlah</th>
                         <th>Total</th>
                         <th>Aksi</th>
                     </tr>
                 </thead>
                 <tbody>
                 <?php
                     $no = 1;
                     // Mengambil data dari tb_penjualan dan tb_barang berdasarkan kodenya.
                     $sql = $koneksi->query("SELECT * FROM tb_penjualan, tb_barang WHERE
                     tb_penjualan.barcode = tb_barang.barcode AND kode_penjualan = '$kode'");
                     while ($data = $sql->fetch_assoc()){
                 ?>
                 <tr>
                         <td><?php echo $no++?></td>
                         <td><?php echo $data['barcode']?></td>
                         <td><?php echo $data['nama_barang']?></td>
                         <td><?php echo $data['harga_jual']?></td>
                         <td><?php echo $data['jumlah']?></td>
                         <td><?php echo $data['total']?></td>
                         <td>
                             <a href="?page=penjualan&aksi=tambah&id=<?php echo $data['id']?>&nomer=<?php echo $data['kode_penjualan']; ?>&hargajual=<?php echo $data['harga_jual'];?>&barcode=<?php echo $data['barcode'];?>"
                             class ="btn btn-success">
                             <i title="Tambah" class="fa fa-plus-square"></i> Tambah</a>
                             <a href="?page=penjualan&aksi=kurang&id=<?php echo $data['id']?>&nomer=<?php echo $data['kode_penjualan']; ?>&hargajual=<?php echo $data['harga_jual'];?>&barcode=<?php echo $data['barcode'];?>"
                             class ="btn btn-info">
                             <i title="Kurang" class="fa fa-minus-square"></i> Kurang</a>
                             <a onclick="return confirm ('Hapus barang ini?')"
                             href="?page=penjualan&aksi=hapus&id=<?php echo $data['id']?>&nomer=<?php echo $data['kode_penjualan']; ?>&hargajual=<?php echo $data['harga_jual'];?>&barcode=<?php echo $data['barcode'];?>&jumlah=<?php echo $data['jumlah'];?>"
                             class="btn btn-danger">
                             <i title="Hapus" class="fa fa-window-close"></i> Hapus</a>
                         </td>
                     </tr>
                     <?php
                         $total_bayar = $total_bayar+$data['total'];
                          }
                     ?>
                 </tbody>
             </table>
             </br>
             <div class="col-sm-3">
             <label>Total :</label>
             <input disabled type="text" onkeyup="hitung();" value="<?php echo $total_bayar; ?>" name="totalbayar" autofocus class="form-control"/>
             </div>
            </br>
             <div class="col-lg-12">                         
                                <div class="basic-elements">
                                    <form method="POST">
                                    <div class="card-header col-lg-6">
                                        <h4 class="m-b-0 text-white">Lanjutan</h4>
                                    </div> </br>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Diskon</label>
                                                    <input class="form-control" type="number" onkeyup="hitung();" id="diskon" value="0" name="diskon">
                                                </div>
                                                <div class="form-group">
                                                    <label>Bayar</label>
                                                    <input class="form-control" type="number" onkeyup="hitung();" id="bayar" name="bayar">
                                                </div>
                                                <div class="form-group">
                                                    <label>Kembali</label>
                                                    <input class="form-control" type="number" id="kembali" name="kembali" readonly>
                                                </div>
                                                <div class="form-group" style="width:30%">
                                                    <label>Cetak struk</label>
                                                    <input class="btn btn-info form-control" type="submit" value="cetak" name="cetak"
                                                    onclick="window.open('page/penjualan/struk.php?nomer=<?php echo $kode; ?>
                                                    &kasir=<?php echo $kasir;?>', 'mywindow', 'toolbar=0,scrollbars=1,statusbar=0,menubar=0,resizable=0,height=500,width=420')">
                                                </div>

                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Potongan diskon</label>
                                                    <input class="form-control" type="number" id="potongan" name="potongan" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Sub total</label>
                                                    <input class="form-control" type="number" id="subtotal" name="subtotal" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Pelanggan</label>
                                                    <select name="pelanggan" class="form-control">
                                                        <?php
                                                            $pelanggan = $koneksi->query("SELECT * FROM tb_pelanggan ORDER BY kode_pelanggan");
                                                            while ($datapelanggan = $pelanggan->fetch_assoc()){
                                                                echo "<option value='$datapelanggan[kode_pelanggan]'>$datapelanggan[nama]</option>";
                                                            }
                                                        ?>
													</select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Jenis Pembayaran</label>
                                                    <select name="pembayaran" class="form-control">
                                                        <?php
                                                            $pembayaran = $koneksi->query("SELECT * FROM tb_pembayaran ORDER BY id_pembayaran");
                                                            while ($jenispembayaran = $pembayaran->fetch_assoc()){
                                                                echo "<option value='$jenispembayaran[id_pembayaran]'>$jenispembayaran[nama_pembayaran]</option>";
                                                            }
                                                        ?>
													</select>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                    <?php
                    // Jika tombol cetak di klik.
                        if (isset($_POST['cetak'])){
                            $pelanggan  = $_POST['pelanggan'];
                            $pembayaran = $_POST['pembayaran'];
                            $totalbayar = $_POST['totalbayar'];
                            $diskon     = $_POST['diskon'];
                            $potongan   = $_POST['potongan'];
                            $subtotal   = $_POST['subtotal'];
                            $bayar      = $_POST['bayar'];
                            $kembali    = $_POST['kembali'];
                            $id_kasir   = $id;
                            $setting    = new DateTime('NOW', new DateTimeZone('Asia/Jakarta'));
                            $tanggal    = $setting->format('Y-m-d');
                    // Disimpan di tb_datapenjualan.       
                            $koneksi->query("INSERT INTO tb_datapenjualan(kode_penjualan, bayar, kembali,
                            diskon, potongan, subtotal, tanggal, id_kasir, pembayaran) VALUES ('$kode', '$bayar', '$kembali', '$diskon', '$potongan', '$subtotal', '$tanggal', '$id_kasir', '$pembayaran')");

                            $koneksi->query("UPDATE tb_penjualan SET id_pelanggan = '$pelanggan' WHERE kode_penjualan = '$kode'");
                        }
                    ?>
                    <script type="text/javascript">
                    // Membuat fungsi hitung diskon dsb.
                        function hitung(){
                            var totalbayar  = document.getElementsByName('totalbayar')[0].value;
                            var diskon      = document.getElementsByName('diskon')[0].value;

                            var hasil       = parseInt(totalbayar) * parseInt(diskon) / parseInt(100);
                            if (!isNaN(hasil)) {
                            var potongan    = document.getElementsByName('potongan')[0].value = hasil;
                            }

                            var akhir       = parseInt(totalbayar) - parseInt(potongan);
                            if(!isNaN(akhir)){
                            var subtotal    = document.getElementsByName('subtotal')[0].value = akhir;
                            }

                            var bayar       = document.getElementsByName('bayar')[0].value;
                            var bayar2      = parseInt(bayar) - parseInt(akhir);
                            if(!isNaN(bayar2)){
                            var kembali   = document.getElementsByName('kembali')[0].value = bayar2;
                            }
                        }
                        
                        
                    </script>
         </div>
     </div>
 </div>
</div></div>
 