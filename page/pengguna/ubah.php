<?php
    $id     = (int) $_GET['id'];
    // Mengambil data pengguna berdasarkan ID.
    $rafi   = $koneksi->query("SELECT * FROM tb_pengguna WHERE id = '$id'");
    $tampil = $rafi->fetch_assoc();
    $level  = $tampil['level'];
?>
<div class="card card-outline-danger">
<div class="card-body">
<h4 class="card-title">Ubah Pengguna</h4>
    <h6 class="card-subtitle">Halaman untuk mengubah pengguna</h6>
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
        <label class="text-info col-sm-2 control-label">Nama Pengguna</label>
            <div class="col-sm-10">
                <input type="text" name="nama" class="form-control" value="<?php echo $tampil['nama'];?>"/>
            </div>
        </div>

        <div class="form-group">
        <label class="text-primary col-sm-2 control-label">Username</label>
            <div class="col-sm-10">
                <input type="text" name="username" class="form-control" value="<?php echo $tampil['username'];?>"/>
            </div>
        </div>

        <div class="form-group">
        <label class="text-success col-sm-2 control-label">Surel</label>
            <div class="col-sm-10">
                <input type="email" name="surel" class="form-control" value="<?php echo $tampil['surel'];?>"/>
            </div>
        </div>


        <div class="form-group">
        <label class="text-warning col-sm-2 control-label">Level</label>
            <div class="col-sm-10">
                <select name="level" class="form-control">
                    <option value="">Pilih level</option>
                    <option value="Admin" <?php if($level=='Admin') { echo "selected"; } ?>>Admin</option>
                    <option value="Kasir" <?php if($level=='Kasir') { echo "selected"; } ?>>Kasir</option>
                </select>
            </div>
        </div>

         <div class="form-group">
        <label class="text-primary col-sm-2 control-label">Foto profil</label>
            <div class="col-sm-10">
                <img src="images/foto/<?php echo $tampil['foto'];?>" width="100" height="100">
            </div>
        </div>

         <div class="form-group">
        <label class="text-primary col-sm-2 control-label">Ganti foto</label>
            <div class="col-sm-10">
                <input type="file" name="foto"/>
            </div>
        </div>

         <div class="form-group">
            <div class="col-sm-10">
                <a class="btn btn-info" href="?page=pengguna&aksi=gantipass&id=<?php echo $tampil['id']?>">Ganti Password</a>
            </div>
        </div>

       

        <input id="simpan" style="float: right;" type="submit" name="simpan" value="Simpan" class="btn btn-info btn-rounded m-b-10 m-l-5">

    </form>
</div>
</div>
    <?php
        // Jika tombol simpan di klik.
        if (isset($_POST['simpan'])) {
            $nama = $_POST['nama'];
            $username = $_POST['username'];
            $surel = $_POST['surel'];
            $level = $_POST['level'];
            // Untuk foto
            $foto     = $_FILES['foto']['name'];
            $file     = $_FILES['foto']['tmp_name'];
            $size     = $_FILES['foto']['size'];
            $tipe     = $_FILES['foto']['type'];
            $folder   = "images/foto/";
            $saring   = array('gif','png' ,'jpg');
            $ext      = pathinfo($foto, PATHINFO_EXTENSION);
        // Proses ubah data.
        if (strlen($foto)){
            // Cek format foto.
            $ext = pathinfo($foto, PATHINFO_EXTENSION);
            if(in_array($ext, $saring)){
                // Cek ukurannya.
                // 5242880 = 5MB.
                if($size<5242880){
                    // Encrypt nama jadi hash sha1.
                    $img     = sha1($foto);
                    // Jika Mencoba upload & jika berhasil di upload
                    if(move_uploaded_file($file, $folder.$img)){
                        // UPDATE tb_pelajar sesuai ID nya.
                        $koneksi->query("UPDATE tb_pengguna SET nama='$nama', 
                        surel='$surel', foto='$img' WHERE id='$id'");
                        ?>
                        <script type="text/javascript">
                        alert("Data berhasil disimpan!");
                        window.location.href="?page=pengguna";
                        </script>
                        <?php
                    }else{
                        // Jika gagal di upload.
                        ?>
                        <script type="text/javascript">
                        alert("Error!");
                        </script>
                        <?php
                    }
                }else{
                    // Jika gambar melebihi ukuran yang ditentukan.
                    ?>
                    <script type="text/javascript">
                    alert("Ukuran gambar terlalu besar! (Max : 5MB)");
                    </script>
                    <?php
                }
            }else{
                // Jika format gambar tidak sesuai dengan $saring
                ?>
                <script type="text/javascript">
                alert("Format gambar tidak dizinkan!");
                </script>
                <?php
            }
        }else{
            // Jika tidak upload foto, diganti dengan tanpa_foto.jpg
            $koneksi->query("UPDATE tb_pengguna SET nama='$nama', username='$username', 
            surel='$surel', level='$level' WHERE id='$id'");
            ?>
            <script type="text/javascript">
            alert("Data berhasil disimpan!");
            window.location.href="?page=pengguna";
            </script>
            <?php
        }
    }
        
    
    ?>

