<?php
    $rafi = $_GET['id'];
// Hapus data berdasarkan kode pelanggan.
    $sql = $koneksi->query("DELETE FROM tb_pelanggan WHERE kode_pelanggan = '$rafi'");
// Jika berhasil dihapus.
    if (sql){
?>
         <script type="text/javascript">
            alert("Data berhasil dihapus!");
            window.location.href="?page=pelanggan";
        </script>
        <?php
}
?>