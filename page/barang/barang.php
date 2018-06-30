<div class="card card-outline-danger">
<div class="card-body">
<h4 class="card-title">Data Barang</h4>
                                <h6 class="card-subtitle">Daftar semua barang ditampilkan disini</h6>
                                <div class="table-responsive m-t-40">
                                <a href="?page=barang&aksi=tambah" class="btn btn-primary">Tambah</a>
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Kode Barcode</th>
                                                <th>Nama barang</th>
                                                <th>Kategori</th>
                                                <th>Stock</th>
                                                <th>Harga beli</th>
                                                <th>Harga jual</th>
                                                <th>Keuntungan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            // Mengambil data dari tb_barang dan tb_kategoribarang.
                                            $sql = $koneksi->query("SELECT * FROM tb_barang, tb_kategoribarang
                                            WHERE tb_barang.kategori=tb_kategoribarang.id_kategori");
                                            while ($data = $sql->fetch_assoc()){
                                        ?>
                                        <tr>
                                                <td><?php echo $data['barcode']?></td>
                                                <td><?php echo $data['nama_barang']?></td>
                                                <td><?php echo $data['nama_kategori']?></td>
                                                <td><?php echo $data['stock']?></td>
                                                <td><?php echo $data['harga_beli']?></td>
                                                <td><?php echo $data['harga_jual']?></td>
                                                <td><?php echo $data['profit']?></td>
                                                <td>
                                                    <a href="?page=barang&aksi=ubah&id=<?php echo $data['barcode']?>">
                                                    <i title="Ubah" style="color:#2ecc71" class="fa fa-edit"></i></a>
                                                    <a href="?page=barang&aksi=hapus&id=<?php echo $data['barcode']?>"
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