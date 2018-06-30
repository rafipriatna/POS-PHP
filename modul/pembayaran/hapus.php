<?php
    $rafi = $_GET['id'];
// Hapus data berdasarkan id pembayaran.
    $sql = $koneksi->query("DELETE FROM tb_pembayaran WHERE id_pembayaran = '$rafi'");
// Jika berhasil dihapus.
    if (sql){
?>
         <script type="text/javascript">
            alert("Data berhasil dihapus!");
            window.location.href="?page=pengaturan";
        </script>
        <?php
}
?>