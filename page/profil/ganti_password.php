<?php
    $id = $_GET['id'];
// Mengambil id penggunanya berdasarkan session.
    $rafi = $koneksi->query("SELECT * FROM tb_pengguna WHERE id = '$id'");
    $tampil = $rafi->fetch_assoc();
    if ($_SESSION['id'] == $id){

    
?>
<div class="card card-outline-danger">
<div class="card-body">
<h4 class="card-title">Ganti Password</h4>
    <form method="POST">
        <div class="form-group">
        <label class="text-warning control-label">Password Lama</label>
            <div class="col-sm-10">
                <input type="password" name="pass_lama" class="form-control" placeholder="Password Lama"/>
            </div>
        </div>

        <div class="form-group">
        <label class="text-info control-label">Password Baru</label>
            <div class="col-sm-10">
                <input type="password" name="pass_baru" class="form-control" placeholder="Password Baru"/>
            </div>
        </div>

        <div class="form-group">
        <label class="text-success control-label">Konfirmasi Password Baru</label>
            <div class="col-sm-10">
                <input type="password" name="konfirmpass" class="form-control" placeholder="Konfirmasi Password Baru"/>
            </div>
        </div>

        <input style="float: right;" type="submit" name="simpan" value="Simpan" class="btn btn-info btn-rounded m-b-10 m-l-5">

    </form>
</div>
</div>
    <?php
    // Jika tombol simpan di klik.
        if (isset($_POST['simpan'])) {
            $pass_lama    = $_POST['pass_lama'];
            $pass_baru    = $_POST['pass_baru'];
            $konfirmpass  = $_POST['konfirmpass'];
            // Buat hash buat password yang baru
            $passfix        = password_hash($pass_baru, PASSWORD_DEFAULT);

            $cek 			= $koneksi->query("SELECT * FROM tb_pengguna WHERE id = '$id'");
            $data 			= mysqli_num_rows($cek);
            
            if($data  == 1){
            // Ngambil kecocokan dari database.
                $row = $cek->fetch_assoc();
            // Cek panjang password
                if(strlen($pass_baru) <= 6){
                echo "<script type='text/javascript'>alert('Panjang password minimal 6 karakter!');</script>";
                }else{
            // Jika pass baru sama konfirmasi nya cocok.
                if($pass_baru == $konfirmpass){
            // Jika pass lama cocok sama yang di database.
                if(password_verify($pass_lama, $row['password'])){
                $update 		= $koneksi->query("UPDATE tb_pengguna SET password='$passfix' WHERE id='$id'");
                echo "<script type='text/javascript'>alert('Berhasil ganti password!'); window.location.href='index.php';</script>";
            // Jika pass lama tidak cocok sama yang di database.
                }else{
                    echo "<script type='text/javascript'>alert('Password lama tidak cocok!');</script>";
                }
            // Jika konfirmasi pass tidak cocok sama pass yang baru.
                }else{
                echo "<script type='text/javascript'>alert('Password konfirmasi tidak cocok!');</script>";
                }
            }
        }
    }
}else{
    // Jika id dan session tidak sama, maka di redirect ke index.
            ?>
            <script type="text/javascript">
            window.location.href = "index.php";
            </script>
            <?php
        }
    ?>