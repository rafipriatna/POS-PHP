<?php
    $id = $_GET['id'];
// Mengambil id penggunanya berdasarkan session.
    $rafi = $koneksi->query("SELECT * FROM tb_pengguna WHERE id = '$id'");
    $tampil = $rafi->fetch_assoc();
    if ($_SESSION['id'] == $id){

    
?>
<div class="card card-outline-danger">
<div class="card-body">
<h4 class="card-title">Profil Kamu</h4>
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
                <input type="text" name="username" class="form-control" value="<?php echo $tampil['username'];?>" readonly/>
            </div>
        </div>

        <div class="form-group">
        <label class="text-success col-sm-2 control-label">Surel</label>
            <div class="col-sm-10">
                <input type="email" name="surel" class="form-control" value="<?php echo $tampil['surel'];?>"/>
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

       

        <input style="float: right;" type="submit" name="simpan" value="Simpan" class="btn btn-info btn-rounded m-b-10 m-l-5">

    </form>
</div>
</div>
    <?php
    // Jika tombol simpan di klik.
        if (isSET($_POST['simpan'])) {
            $nama     = $_POST['nama'];
            $username = $_POST['username'];
            $surel    = $_POST['surel'];
            $foto     = $_FILES['foto']['name'];
            $file     = $_FILES['foto']['tmp_name'];
            $saring   = array('gif','png' ,'jpg');
            $ext      = pathinfo($foto, PATHINFO_EXTENSION);
            // Jika upload foto maka disimpan di images/foto.        
            if (!empty($file)){
            // Cek ekstensi jika tidak sesuai $saring.
                if (!in_array($ext, $saring)){
                    ?>
                    <script type="text/javascript">
                   alert("Error!");
                   </script>
                   <?php

                }else{
            $upload = move_uploaded_file($file, "images/foto/".$foto);                
            // Update data di tb_pengguna.
                    $sql = $koneksi->query("UPDATE tb_pengguna SET nama='$nama', 
                    surel='$surel', foto='$foto' WHERE id='$id'");
            // Jika berhasil.
                    if ($sql){
                        ?>
                         <script type="text/javascript">
                        alert("Data berhasil disimpan!");
                        window.location.href="index.php";
                        </script>
                        <?php
                    }
                }
            }else{               
            // Jika tidak upload foto maka tidak update fotonya.
            $sql = $koneksi->query("UPDATE tb_pengguna SET nama='$nama', 
            surel='$surel' WHERE id='$id'");
            // Jika berhasil.
            if ($sql){
                ?>
                 <script type="text/javascript">
                alert("Data berhasil disimpan!");
                window.location.href="index.php";
                </script>
                <?php
        }
    }
}
        
    ?>
    <?php
    }else{
    // Jika id dan session tidak sama, maka di redirect ke index.
        ?>
        <script type="text/javascript">
        window.location.href = "index.php";
        </script>
        <?php
    }
    ?>