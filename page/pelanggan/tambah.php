<div class="card card-outline-danger">
<div class="card-body">
<h4 class="card-title">Tambah Pelanggan</h4>
    <h6 class="card-subtitle">Halaman untuk menambahkah pelangggan</h6>
    <form method="POST">
        <div class="form-group">
        <label class="text-info col-sm-2 control-label">Nama Pelanggan</label>
            <div class="col-sm-10">
                <input type="text" name="nama" class="form-control" placeholder="Nama pelanggan"/>
            </div>
        </div>

        <div class="form-group">
        <label class="text-warning col-sm-2 control-label">Alamat</label>
            <div class="col-sm-10">
                <input type="text" name="alamat" class="form-control" placeholder="Alamat rumah"/>
            </div>
        </div>

        <div class="form-group">
        <label class="text-danger col-sm-2 control-label">Telpon</label>
            <div class="col-sm-10">
                <input type="number" name="telp" class="form-control" placeholder="Nomor telp"/>
            </div>
        </div>

        <div class="form-group">
        <label class="text-success col-sm-2 control-label">Surel</label>
            <div class="col-sm-10">
                <input type="email" name="surel" class="form-control" placeholder="admin@rmarket.com"/>
            </div>
        </div>

        <input style="float: right;" type="submit" name="simpan" value="Simpan" class="btn btn-info btn-rounded m-b-10 m-l-5">

    </form>
</div>
</div>
    <?php
    // Jika tombol simpan di klik.
        if (isset($_POST['simpan'])) {
            $nama = $_POST['nama'];
            $alamat = $_POST['alamat'];
            $telp = $_POST['telp'];
            $surel = $_POST['surel'];
    // Disimpan di tb_pelanggan.
            $sql = $koneksi->query("INSERT INTO tb_pelanggan (nama, alamat, 
            telp, surel) VALUES('$nama', '$alamat', '$telp', '$surel')");
    // Jika berhasil disimpan.
            if ($sql){
                ?>
                <script type="text/javascript">
                alert("Data berhasil disimpan!");
                window.location.href="?page=pelanggan";
                </script>
                <?php
            }
        }
    
    ?>