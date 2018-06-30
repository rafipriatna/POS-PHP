<script type="text/javascript">
// Fungsi untuk menghitung.
function hitung() {
    var harga_beli = document.getElementsByName('hbeli')[0].value;
    var harga_jual = document.getElementsByName('hjual')[0].value;
    var hasil = parseInt(harga_jual) - parseInt(harga_beli);
    if (!isNaN(hasil)) {
        document.getElementsByName('profit')[0].value = hasil;
    }
}
</script>

<?php
    $rafi = $_GET['id'];
    // Mengambil data barcode dan id kategori buat ditampilin di halaman ubah.
    $sql = $koneksi->query("SELECT * FROM tb_barang, tb_kategoribarang WHERE barcode = '$rafi'
    AND tb_barang.kategori=tb_kategoribarang.id_kategori");
    $tampil = $sql->fetch_assoc();
    $kategori = $tampil['nama_kategori'];
?>
<div class="card card-outline-danger">
<div class="card-body">
<h4 class="card-title">Ubah Barang</h4>
    <h6 class="card-subtitle">Halaman untuk menambahkah barang</h6>
    <form method="POST">
        <div class="form-group">
        <label class="text-info col-sm-2 control-label">Kode Barcode</label>
            <div class="col-sm-10">
                <input type="text" name="barcode" class="form-control"
                value="<?php echo $tampil['barcode']; ?>"/>
            </div>
        </div>

        <div class="form-group">
        <label class="text-primary col-sm-2 control-label">Nama Barang</label>
            <div class="col-sm-10">
                <input type="text" name="nama" class="form-control"
                value="<?php echo $tampil['nama_barang']; ?>"/>
            </div>
        </div>

        <div class="form-group">
        <label class="text-warning col-sm-2 control-label">Kategori</label>
            <div class="col-sm-10">
                <select name="kategori" class="form-control">
                    <option><?php echo $kategori;?></option>
                    <option disabled>---Kategori Lainnya---</option>
                        <?php
                            $kategori = $koneksi->query("SELECT * FROM tb_kategoribarang ORDER BY id_kategori");
                            while ($ea = $kategori->fetch_assoc()){
                                echo "<option value='$ea[id_kategori]'>$ea[nama_kategori]</option>";
                            }
                        ?>
				</select>
            </div>
        </div>

        <div class="form-group">
        <label class="text-danger col-sm-2 control-label">Persediaan</label>
            <div class="col-sm-10">
                <input type="number" name="stock" class="form-control" 
                value="<?php echo $tampil['stock']; ?>"/>
            </div>
        </div>

        <div class="form-group">
        <label class="text-success col-sm-2 control-label">Harga Beli</label>
            <div class="col-sm-10">
                <input type="number" onkeyup="hitung()" name="hbeli" class="form-control"
                value="<?php echo $tampil['harga_beli']; ?>"/>
            </div>
        </div>

        <div class="form-group">
        <label class="text-dark col-sm-2 control-label">Harga Jual</label>
            <div class="col-sm-10">
                <input type="number" onkeyup="hitung()" name="hjual" class="form-control"
                value="<?php echo $tampil['harga_jual']; ?>"/>
            </div>
        </div>

        <div class="form-group">
        <label class="text-primary col-sm-2 control-label">Keuntungan</label>
            <div class="col-sm-10">
                <input type="number" readonly="" name="profit" class="form-control"
                value="<?php echo $tampil['profit']; ?>"/>
            </div>
        </div>

        <input style="float: right;" type="submit" name="simpan" value="Simpan" class="btn btn-info btn-rounded m-b-10 m-l-5">

    </form>
</div>
</div>
    <?php
    // Jika tombol simpan di klik.
        if (isset($_POST['simpan'])) {
            $barcode    = $_POST['barcode'];
            $nama       = $_POST['nama'];
            $kategori   = $_POST['kategori'];
            $stock      = $_POST['stock'];
            $hbeli      = $_POST['hbeli'];
            $hjual      = $_POST['hjual'];
            $profit     = $_POST['profit'];
    // Disimpan di tb_barang.
            $sql2 = $koneksi->query("UPDATE tb_barang SET barcode='$barcode', nama_barang='$nama', 
            kategori='$kategori', stock='$stock', harga_beli='$hbeli', harga_jual='$hjual', profit='$profit'
            WHERE barcode='$rafi'");
    // Jika berhasil disimpan.
            if ($sql2){
                ?>
                <script type="text/javascript">
                alert("Data berhasil diubah!");
                window.location.href="?page=barang";
                </script>
                <?php
            }
        }
    
    ?>