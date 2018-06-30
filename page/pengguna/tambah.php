<div class="card card-outline-danger">
<div class="card-body">
<h4 class="card-title">Tambah Pengguna</h4>
    <h6 class="card-subtitle">Halaman untuk menambahkah pengguna</h6>
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
        <label class="text-info col-sm-2 control-label">Nama Pengguna</label>
            <div class="col-sm-10">
                <input type="text" name="nama" class="form-control" placeholder="Nama Pengguna"/>
            </div>
        </div>

        <div class="form-group">
        <label class="text-primary col-sm-2 control-label">Username</label>
            <div class="col-sm-10">
                <input type="text" onkeypress="return matikan()" name="username" class="form-control" placeholder="Username"/>
            </div>
        </div>

        <div class="form-group">
        <label class="text-danger col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
                <input type="password" name="password" class="form-control" placeholder="Password"/>
            </div>
        </div>

        <div class="form-group">
        <label class="text-success col-sm-2 control-label">Surel</label>
            <div class="col-sm-10">
                <input type="email" name="surel" class="form-control"/>
            </div>
        </div>


        <div class="form-group">
        <label class="text-warning col-sm-2 control-label">Level</label>
            <div class="col-sm-10">
                <select name="level" class="form-control">
                    <option value="">Pilih level</option>
                    <option value="Admin">Admin</option>
                    <option value="Kasir">Kasir</option>
                </select>
            </div>
        </div>

         <div class="form-group">
        <label class="text-primary col-sm-2 control-label">Foto profil</label>
            <div class="col-sm-10">
                <input type="file" name="foto"/>
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
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
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
                        // UPDATE tb_pengguna sesuai ID nya.
                        $koneksi->query("INSERT INTO tb_pengguna (nama, username, 
                        password, surel, level, foto) VALUES('$nama', '$username', 
                        '$password', '$surel', '$level', '$img')");
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
            $noimg = "tanpa_foto.jpg";
            $koneksi->query("INSERT INTO tb_pengguna (nama, username, 
            password, surel, level, foto) VALUES('$nama', '$username', 
            '$password', '$surel', '$level', '$noimg')");
            ?>
            <script type="text/javascript">
            alert("Data berhasil disimpan!");
            window.location.href="?page=pengguna";
            </script>
            <?php
        }
    }
    ?>
<script type="text/javascript">
    // Untuk me-nonaktifkan spasi di input username.
    function matikan() {
        if (event.keyCode == 32) {
        return false;
        }
    }
</script>