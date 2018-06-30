<?php
$kasir = $_GET['kasir'];
$nomer = $_GET['nomer'];
include ('../../koneksi.php');
// Mengambil data dari tb_pelanggan, tb_pengaturan, tb_penjualan, tb_datapenjualan, tb_barang.
$ea = $koneksi->query("SELECT * FROM tb_pengaturan, tb_penjualan, tb_pelanggan WHERE tb_penjualan.kode_penjualan='$nomer'
AND tb_penjualan.id_pelanggan=tb_pelanggan.kode_pelanggan");
// Fungsi mata uang rupiah.
function rupiah($angka){
	
    $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
    return $hasil_rupiah;}
?>
<script type="text/javascript">
// Reload halaman saat pertama kali dibuka. Agar datanya muncul.
window.onload = function() {
    if(!window.location.hash) {
        window.location = window.location + '#loaded';
        window.location.reload();
    }
    if (window.location.href.toLowerCase().indexOf("loaded") < 0) {
        window.location = window.location.href + '?loaded=1'
   }
}
</script>
<style>
@font-face{
    font-family: code128;
    src: url(../../barcode/code128.ttf);
}
hr.gaya1 {
	background-color: #fff;
	border-top: 2px dashed #8c8b8b;
}
hr.gaya2 {
    border: 0;
    height: 1px;
    background: #333;
    background-image: -webkit-linear-gradient(left, #ccc, #333, #ccc);
    background-image: -moz-linear-gradient(left, #ccc, #333, #ccc);
    background-image: -ms-linear-gradient(left, #ccc, #333, #ccc);
    background-image: -o-linear-gradient(left, #ccc, #333, #ccc);
}
tr.gaya3 {
	border-top: 1px dashed #8c8b8b;
}
fieldset.title {
    background: url(../../images/web/hr.png) repeat-x 0 0;
    border: 0;
    display: block;
    text-align: center;    
    padding-top: 2px;
    padding-bottom: 1px;
}

fieldset.title legend {
    padding: 5px 10px;
    background: #fff;
}
</style>
<?php
    $x = $ea->fetch_assoc();
?>
<center>
<b><?php echo $x['namasitus'];?></b><br>
<?php echo $x['alamat_toko'];?><br>
<?php echo $x['nomer_telp'];?>
</center>
<fieldset class="title">
    <legend>STRUK</legend>
</fieldset>
<table style="width:100%">
    <tr>
        <td>Tanggal</td>
        <td><?php echo $x['tgl_penjualan'];?> <?php echo $x['waktu_penjualan'];?></td>
    </tr>
    <tr>
        <td>Petugas</td>
        <td><?php echo $kasir;?></td>
    </tr>
    <tr>
        <td>Pelanggan</td>
        <td><?php echo $x['nama'];?></td>
    </tr>
</table>
<center>
<font face="code128" size="6em">*<?php echo $x['kode_penjualan'];?>*</font><br>
<font size="2em"><?php echo $x['kode_penjualan'];?></font>
</center>
<hr class="gaya2">
<table style="width:100%; text-align:left">
    <tr>
        <th>Qty</th>
        <th>Nama Barang</th>
        <th>Harga</th>
    </tr>
<?php
    $rafi = $koneksi->query("SELECT * FROM tb_pembayaran, tb_penjualan, tb_datapenjualan, tb_barang
    WHERE tb_penjualan.kode_penjualan = tb_datapenjualan.kode_penjualan
    AND tb_penjualan.barcode = tb_barang.barcode
    AND tb_penjualan.kode_penjualan = '$nomer' AND tb_datapenjualan.pembayaran=tb_pembayaran.id_pembayaran");
    while ($y = $rafi->fetch_assoc()){
    
?>
    <tr>
        <td><?php echo $y['jumlah'];?></td>
        <td><?php echo $y['nama_barang'];?></td>
        <td><?php echo rupiah($y['harga_jual']);?></td>
    </tr>
<?php 
    $totalharga  = $y['harga_jual'] * $y['jumlah'];
    $total_bayar = $total_bayar+$y['total'];
    $diskon      = $y['diskon'];
    $potongan    = rupiah($y['potongan']);
    $subtotal    = rupiah($y['subtotal']);
    $bayar       = rupiah($y['bayar']);
    $kembali     = rupiah($y['kembali']);
    $pembayaran  = $y['nama_pembayaran'];
    }
?>
    <tr>
        <td><b>Total</b></td>
        <td></td>
        <td><b><?php echo rupiah($total_bayar);?></b></td>
    </tr>
</table>
<hr class="gaya1">
<table style="width:100%">
    <tr>
        <td>Diskon</td>  
        <td><?php echo $diskon;?>% (<?php echo $potongan;?>)</td>
    </tr>
    <tr>
        <td>Subtotal</td>
        <td><?php echo $subtotal;?></td>
    </tr>
    <tr>
        <td>Bayar ( <?php echo $pembayaran;?> )</td>
        <td><?php echo $bayar;?></td>
    </tr>
    <tr>
        <td>Kembali</td>
        <td><?php echo $kembali;?></td>
    </tr>
</table>
<hr class="gaya3">
<center>
Harga produk sudah termasuk PPN.
    <h5>Barang yang sudah dibeli tidak dapat dikembalikan.</h5>
</center>