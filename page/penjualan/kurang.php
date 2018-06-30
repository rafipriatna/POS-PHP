<?php
    
    $id         = $_GET['id'];
    $nomer      = $_GET['nomer'];
    $hargajual  = $_GET['hargajual'];
    $barcode    = $_GET['barcode'];
// Melakukan pengurangan pada tb_penjualan dan tb_barang ditambahkan.
    $sql        = $koneksi->query("UPDATE tb_penjualan SET jumlah=(jumlah - 1) WHERE id='$id'");
    $sql2       = $koneksi->query("UPDATE tb_penjualan SET total=(total - $hargajual) WHERE id='$id'");
    $sql3       = $koneksi->query("UPDATE tb_barang SET stock=(stock + 1) WHERE barcode='$barcode'");
// Jika berhasil.
    if ($sql || $sql2 || $sql3){
        ?>
            <script type="text/javascript">
                window.location.href="?page=penjualan&kode_penjualan=<?php echo $nomer; ?>";
            </script>
        <?php
    }

?>