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
<div class="card card-outline-danger">
<div class="card-body">
<h4 class="card-title">Tambah Barang</h4>
    <h6 class="card-subtitle">Halaman untuk menambahkah barang</h6>
    <form method="POST">
        <div class="form-group">
        <label class="text-info col-sm-2 control-label">Kode Barcode</label>
            <div class="col-sm-10">
                <input type="text" name="barcode" class="form-control" placeholder="Kode barcode"/>
            </div>
        </div>

        <div class="form-group">
        <label class="text-primary col-sm-2 control-label">Nama Barang</label>
            <div class="col-sm-10">
                <input type="text" name="nama" class="form-control" placeholder="Nama Barang"/>
            </div>
        </div>

        <div class="form-group">
        <label class="text-warning col-sm-2 control-label">Kategori</label>
            <div class="col-sm-10">
                <select name="kategori" class="form-control">
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
                <input type="number" name="stock" class="form-control" placeholder="Jumlah persediaan"/>
            </div>
        </div>

        <div class="form-group">
        <label class="text-success col-sm-2 control-label">Harga Beli</label>
            <div class="col-sm-10">
                <input type="number" onkeyup="hitung()" name="hbeli" class="form-control"/>
            </div>
        </div>

        <div class="form-group">
        <label class="text-dark col-sm-2 control-label">Harga Jual</label>
            <div class="col-sm-10">
                <input type="number" onkeyup="hitung()" name="hjual" class="form-control"/>
            </div>
        </div>

        <div class="form-group">
        <label class="text-primary col-sm-2 control-label">Keuntungan</label>
            <div class="col-sm-10">
                <input type="number" readonly="" name="profit" class="form-control"/>
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
            $sql = $koneksi->query("INSERT INTO tb_barang (barcode, nama_barang, kategori, 
            harga_beli, stock, harga_jual, profit) VALUES('$barcode', '$nama', '$kategori', '$hbeli',
            '$stock', '$hjual', '$profit')");
    // Jika berhasil disimpan.
            if ($sql){
                ?>
                <script type="text/javascript">
                alert("Data berhasil disimpan!");
                window.location.href="?page=barang";
                </script>
                <?php
            }
        }
    
    ?>