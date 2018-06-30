<?php
    $rafi = $_GET['id'];
// Hapus data berdasarkan id kategori.
    $sql = $koneksi->query("DELETE FROM tb_kategoribarang WHERE id_kategori = '$rafi'");
// Jika berhasil dihapus.
    if (sql){
?>
         <script type="text/javascript">
            alert("Data berhasil dihapus!");
            window.location.href="?page=kategori_barang";
        </script>
        <?php
}
?>