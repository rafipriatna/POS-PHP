<?php
    $rafi = $_GET['id'];
// Hapus data berdasarkan barcode
    $sql = $koneksi->query("DELETE FROM tb_barang WHERE barcode = '$rafi'");
// Jika data berhasil dihapus.
    if (sql){
?>
         <script type="text/javascript">
            alert("Data berhasil dihapus!");
            window.location.href="?page=barang";
        </script>
        <?php
}
?>