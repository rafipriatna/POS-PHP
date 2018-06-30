<?php
// Menghapus keseluruhan tb_datapenjualan dan tb_penjualan.
    $sql         = $koneksi->query("TRUNCATE TABLE tb_datapenjualan");
    $sql2        = $koneksi->query("TRUNCATE TABLE tb_penjualan");
// Jika berhasil.
    if ($sql){
        ?>
            <script type="text/javascript">
                alert ("Data berhasil dihapus!");
                window.location.href="?page=transaksi";
            </script>
        <?php
    }

?>