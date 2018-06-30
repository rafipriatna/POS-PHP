<div class="card card-outline-danger">
<div class="card-body">
<h4 class="card-title">Tambah Kategori Barang</h4>
    <h6 class="card-subtitle">Halaman untuk menambahkah kategori barang</h6>
    <form method="POST">
        <div class="form-group">
        <label class="text-info control-label">Nama kategori</label>
            <div class="col-sm-10">
                <input type="text" name="nama_kategori" class="form-control" placeholder="Nama kategori"/>
            </div>
        </div>

        <div class="form-group">
        <label class="text-warning control-label">Deskripsi kategori</label>
            <div class="col-sm-10">
                <input type="text" name="deskripsi_kategori" class="form-control" placeholder="Kategori Untuk"/>
            </div>
        </div>

        <input style="float: right;" type="submit" name="simpan" value="Simpan" class="btn btn-info btn-rounded m-b-10 m-l-5">

    </form>
</div>
</div>
    <?php
    // Jika tombol simpan di klik.
        if (isset($_POST['simpan'])) {
            $nama_kategori        = $_POST['nama_kategori'];
            $deskripsi_kategori   = $_POST['deskripsi_kategori'];
    // Disimpan di tb_kategoribarang.
            $sql = $koneksi->query("INSERT INTO tb_kategoribarang (nama_kategori, 
            deskripsi_kategori) VALUES('$nama_kategori', '$deskripsi_kategori')");
    // Jika berhasil disimpan.
            if ($sql){
                ?>
                <script type="text/javascript">
                alert("Data berhasil disimpan!");
                window.location.href="?page=kategori_barang";
                </script>
                <?php
            }
        }
    
    ?>