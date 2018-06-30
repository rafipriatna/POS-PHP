<?php
    include("koneksi.php");
    // Mengambil data dari tb_pengaturan.
    $sql = $koneksi->query("SELECT * FROM tb_pengaturan");
    $x   = $sql->fetch_assoc();
?>
<div class="card card-outline-danger">
    <div class="card-body">
        <h4 class="card-title">Pengaturan</h4>
        <form method="POST">
        <div class="row">
           <div class="col-lg-6">
               <div class="form-group">
                    <label>Nama situs</label>
                    <input type="text" name="namasitus" class="form-control" value="<?php echo $x['namasitus']; ?>">
               </div>
               <div class="form-group">
                    <label>Alamat Toko</label></br>
                    <label class="text-danger">Gunakan code <b>&lt;br&gt;</b> untuk membuat baris baru.</label>
                    <textarea rows="4" cols="50" name="alamat_toko"><?php echo $x['alamat_toko'];?></textarea>
               </div>
               <div class="form-group">
                    <label>Nomor Telp</label>
                    <input type="text" name="nomer_telp" class="form-control" value="<?php echo $x['nomer_telp']; ?>">
               </div>
               <div class="form-group" style="width:30%">
                    <input class="btn btn-info form-control" type="submit" value="Simpan" name="simpan">
               </div>

           </div>
           <div class="col-lg-6">
               
                   <label>Data Situs akan terlihat seperti ini:</label></br>
                   <p><?php echo $x['namasitus'];?></p>
                   <p><?php echo $x['alamat_toko'];?></p>
                   <p><i class='fa fa-phone'></i> <?php echo $x['nomer_telp'];?></p>
               
           </div>
            
        </form>
        </br>
    </div>
</div>
<?php
// Jika tombol simpan di klik.
    if(isset($_POST['simpan'])){
        $namasitus      = $_POST['namasitus'];
        $alamat_toko    = $_POST['alamat_toko'];
        $nomer_telp     = $_POST['nomer_telp'];
// Disimpan di tb_pengaturan.
        $apdet = $koneksi->query("UPDATE tb_pengaturan SET namasitus='$namasitus', alamat_toko='$alamat_toko', nomer_telp='$nomer_telp'");
// Jika berhasil disimpan.
        if ($apdet){
            ?>
            <script type="text/javascript">
            alert("Data berhasil disimpan!");
            window.location.href="?page=pengaturan";
            </script>
            <?php
        }
    }
?>

<h4 class="card-title">Jenis Pembayaran</h4>
         <div class="table-responsive m-t-40 ">
             <table class="display nowrap table table-bordered table-striped">
                 <thead>
                     <tr>
                         <th>No</th>
                         <th>Jenis Pembayaran</th>
                         <th>Deskripsi Pembayaran</th>
                         <th>Aksi</th>
                     </tr>
                 </thead>
                 <tbody>
                 <?php
                     $no = 1;
                     // Mengambil data dari tb_datapenjualan.
                     $sql = $koneksi->query("SELECT * FROM tb_pembayaran");
                     while ($data = $sql->fetch_assoc()){
                ?>     
                 <tr>
                         <td><?php echo $no++?></td>
                         <td><?php echo $data['nama_pembayaran']?></td>
                         <td><?php echo $data['deskripsi_pembayaran']?></td>
                         <td>
                             <a href="?page=pengaturan&aksi=ubah&id=<?php echo $data['id_pembayaran']?>"
                             class="btn btn-success">
                             <i title="Ubah" class="fa fa-edit"></i> Ubah</a>
                             <a onclick="return confirm ('Hapus jenis pembayaran ini?')"
                             href="?page=pengaturan&aksi=hapus&id=<?php echo $data['id_pembayaran']?>"
                             class="btn btn-danger">
                             <i title="Hapus" class="fa fa-window-close"></i> Hapus</a>
                         </td>
                     </tr>
                     <?php } ?>
                 </tbody>
             </table>
             <br>
             <a href="?page=pengaturan&aksi=tambah" class="btn btn-primary">Tambah</a>