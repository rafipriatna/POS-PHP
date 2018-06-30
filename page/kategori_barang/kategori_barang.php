<div class="card card-outline-danger">
<div class="card-body">
<h4 class="card-title">Kategori Barang</h4>
                                <div class="table-responsive m-t-40">
                                <a href="?page=kategori_barang&aksi=tambah" class="btn btn-primary">Tambah</a>
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kategori</th>
                                                <th>Deskripsi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $no = 1; // Mengurutkan nomor.
                                            // Mengambil data dari tb_kategoribarang.
                                            $sql = $koneksi->query("SELECT * FROM tb_kategoribarang");
                                            while ($data = $sql->fetch_assoc()){
                                        ?>
                                        <tr>
                                                <td><?php echo $no++?></td>
                                                <td><?php echo $data['nama_kategori']?></td>
                                                <td><?php echo $data['deskripsi_kategori']?></td>
                                                <td>
                                                    <a href="?page=kategori_barang&aksi=ubah&id=<?php echo $data['id_kategori']?>"
                                                    class="btn btn-success">
                                                    <i title="Ubah" class="fa fa-edit"></i> Ubah</a>
                                                    <a onclick="return confirm ('Hapus jenis pembayaran ini?')"
                                                    href="?page=kategori_barang&aksi=hapus&id=<?php echo $data['id_kategori']?>"
                                                    class="btn btn-danger">
                                                    <i title="Hapus" class="fa fa-window-close"></i> Hapus</a>
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