<div class="card card-outline-danger">
<div class="card-body">
<h4 class="card-title">Data Pelanggan</h4>
                                <h6 class="card-subtitle">Daftar semua pelanggan ditampilkan disini</h6>
                                <div class="table-responsive m-t-40">
                                <a href="?page=pelanggan&aksi=tambah" class="btn btn-primary">Tambah</a>
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Alamat</th>
                                                <th>Telpon</th>
                                                <th>Surel</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $no = 1; // Mengurutkan Nomor
                                            // Mengambil data dari tb_pelanggan
                                            $sql = $koneksi->query("SELECT * FROM tb_pelanggan");
                                            while ($data = $sql->fetch_assoc()){
                                        ?>
                                        <tr>
                                                <td><?php echo $no++?></td>
                                                <td><?php echo $data['nama']?></td>
                                                <td><?php echo $data['alamat']?></td>
                                                <td><?php echo $data['telp']?></td>
                                                <td><?php echo $data['surel']?></td>
                                                <td>
                                                    <a href="?page=pelanggan&aksi=ubah&id=<?php echo $data['kode_pelanggan']?>">
                                                    <i title="Ubah" style="color:#2ecc71" class="fa fa-edit"></i></a>
                                                    <a href="?page=pelanggan&aksi=hapus&id=<?php echo $data['kode_pelanggan']?>"
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