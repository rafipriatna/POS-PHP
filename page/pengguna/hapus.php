<?php
    $id = $_GET['id'];
// Hapus data berdasarkan ID
    $sql = $koneksi->query("DELETE FROM tb_pengguna WHERE id = '$id'");
// Jika data berhasil dihapus.
    if (sql){
?>
         <script type="text/javascript">
            alert("Data berhasil dihapus!");
            window.location.href="?page=pengguna";
        </script>
        <?php
}
?>