<div class="card card-outline-danger">
<div class="card-body">
<h4 class="card-title">Tambah Jenis Pembayaran</h4>
    <h6 class="card-subtitle">Halaman untuk menambahkah jenis pembayaran</h6>
    <form method="POST">
        <div class="form-group">
        <label class="text-info control-label">Nama pembayaran</label>
            <div class="col-sm-10">
                <input type="text" name="nama_pembayaran" class="form-control" placeholder="Nama pembayaran"/>
            </div>
        </div>

        <div class="form-group">
        <label class="text-warning control-label">Deskripsi pembayaran</label>
            <div class="col-sm-10">
                <input type="text" name="deskripsi_pembayaran" class="form-control" placeholder="Pembayaran Untuk"/>
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
            $sql = $koneksi->query("INSERT INTO tb_pembayaran (nama_pembayaran, 
            deskripsi_pembayaran) VALUES('$nama_pembayaran', '$deskripsi_pembayaran')");
    // Jika berhasil disimpan.
            if ($sql){
                ?>
                <script type="text/javascript">
                alert("Data berhasil disimpan!");
                window.location.href="?page=pengaturan";
                </script>
                <?php
            }
        }
    
    ?>