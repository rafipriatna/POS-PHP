<?php
    $jumlah     = $_GET['jumlah'];
    $id         = $_GET['id'];
    $nomer      = $_GET['nomer'];
    $hargajual  = $_GET['hargajual'];
    $barcode    = $_GET['barcode'];
// Ambil data berdasarkan ID dan akan menghapus nomor dari tb_penjualan.
    $sql        = $koneksi->query("DELETE FROM tb_penjualan WHERE id='$id'");
// Dan stock di tb_barang ditambahkan sesuai yang dihapus tadi.
    $sql2       = $koneksi->query("UPDATE tb_barang SET stock=(stock + $jumlah) WHERE barcode='$barcode'");
// Jika berhasil.
    if ($sql || $sql2){
        ?>
            <script type="text/javascript">
                window.location.href="?page=penjualan&kode_penjualan=<?php echo $nomer; ?>";
            </script>
        <?php
    }

?>