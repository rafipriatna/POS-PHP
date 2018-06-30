<div class="card card-outline-danger">
<div class="card-body">
<h4 class="card-title">Data Pengguna</h4>
                                <h6 class="card-subtitle">Daftar semua pengguana ditampilkan disini</h6>
                                <div class="table-responsive m-t-40">
                                <a href="?page=pengguna&aksi=tambah" class="btn btn-primary">Tambah</a>
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Username</th>
                                                <th>Surel</th>
                                                <th>Level</th>
                                                <th>Foto</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $no = 1; // Mengurutkan nomor.
                                            // Mengambil data dari tb_pengguna.
                                            $sql = $koneksi->query("SELECT * FROM tb_pengguna");
                                            while ($data = $sql->fetch_assoc()){
                                        ?>
                                        <tr>
                                                <td><?php echo $no++?></td>
                                                <td><?php echo $data['nama']?></td>
                                                <td><?php echo $data['username']?></td>
                                                <td><?php echo $data['surel']?></td>
                                                <td><?php echo $data['level']?></td>
                                                <td align="center"><img src="images/foto/<?php echo $data['foto']?>"
                                                width="50" height="50" title="<?php echo $data['nama']?>"></td>
                                                <td>
                                                    <a href="?page=pengguna&aksi=ubah&id=<?php echo $data['id']?>">
                                                    <i title="Ubah" style="color:#2ecc71" class="fa fa-edit"></i></a>
                                                    <a href="?page=pengguna&aksi=hapus&id=<?php echo $data['id']?>"
                                                    onclick="return confirm('Apakah kamu yakin ingin menghapus data ini?')">
                                                    <i title="Hapus" style="color:#e74c3c" class="fa fa-window-close"></i></a>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>