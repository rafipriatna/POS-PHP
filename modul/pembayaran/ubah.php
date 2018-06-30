<?php
    $rafi = $_GET['id'];
    // Mengubah data berdasarkan id pembayaran.
    $sql = $koneksi->query("SELECT * FROM tb_pembayaran WHERE id_pembayaran = '$rafi'");
    $tampil = $sql->fetch_assoc();
?>
<div class="card card-outline-danger">
<div class="card-body">
<h4 class="card-title">Ubah Pelanggan</h4>
    <h6 class="card-subtitle">Halaman untuk menambahkah pelangggan</h6>
    <form method="POST">
        <div class="form-group">
        <label class="text-info control-label">Nama pembayaran</label>
            <div class="col-sm-10">
                <input type="text" name="nama_pembayaran" class="form-control" value="<?php echo $tampil['nama_pembayaran'] ;?>"/>
            </div>
        </div>

        <div class="form-group">
        <label class="text-warning control-label">Deskripsi pembayaran</label>
            <div class="col-sm-10">
                <input type="text" name="deskripsi_pembayaran" class="form-control" value="<?php echo $tampil['deskripsi_pembayaran'] ;?>"/>
            </div>
        </div>

        <input style="float: right;" type="submit" name="simpan" value="Simpan" class="btn btn-info btn-rounded m-b-10 m-l-5">

    </form>
</div>
</div>
    <?php
    // Jika tombol simpan di klik.
        if (isset($_POST['simpan'])) {
            $nama_pembayaran        = $_POST['nama_pembayaran'];
            $deskripsi_pembayaran   = $_POST['deskripsi_pembayaran'];
    // Disimpan di tb_pembayaran.        
            $sql = $koneksi->query("UPDATE tb_pembayaran SET nama_pembayaran='$nama_pembayaran', 
            deskripsi_pembayaran='$deskripsi_pembayaran' WHERE id_pembayaran='$rafi'");
    // Jika berhasil disimpan.
            if ($sql){
                ?>
                <script type="text/javascript">
                alert("Data berhasil diubah!");
                window.location.href="?page=pengaturan";
                </script>
                <?php
            }
        }
    
    ?>