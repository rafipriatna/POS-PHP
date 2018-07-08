<div class="card card-outline-danger">
<div class="card-body">
<h4 class="card-title">Transaksi</h4>
                                    <h6 class="card-subtitle">Data transaksi hari ini</h6>
                                <div class="table-responsive m-t-0">
                                    <table id="myTable"  class="display nowrap table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>ID Penjualan</th>
                                                <th>Tanggal</th>
                                                <th>Pembayaran</th>
                                                <th>Subtotal</th>
                                                <th>Bayar</th>
                                                <th>Kasir</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        // Fungsi mata uang rupiah.
                                            function rupiah($angka){
	
                                                $hasil_rupiah  = "Rp. " . number_format($angka,2,',','.');
                                                return $hasil_rupiah;
                                            }
                                            $no = 1;
                                        // Mengambil data dari tb_datapenjualan.
                                        // Mengambil berdasarkan tanggal hari ini.
                                            $setting    = new DateTime('NOW', new DateTimeZone('Asia/Jakarta'));
                                            $hariini    = $setting->format('Y-m-d');
                                            $sql = $koneksi->query("SELECT * FROM tb_pengguna, tb_pembayaran, tb_datapenjualan WHERE tb_datapenjualan.pembayaran=tb_pembayaran.id_pembayaran
                                            AND tb_datapenjualan.id_kasir=tb_pengguna.id AND tanggal = '$hariini'");
                                            while ($data = $sql->fetch_assoc()){
                                        ?>
                                        <tr>
                                                <td><?php echo $no++?></td>
                                                <td><a style="color:#007bff" href="#" onclick="window.open('page/penjualan/struk.php?nomer=<?php echo $data['kode_penjualan']; ?>
                                                &kasir=<?php echo $data['nama'];?>', 'mywindow', 'toolbar=0,scrollbars=1,statusbar=0,menubar=0,resizable=0,height=500,width=420')">
                                                <?php echo $data['kode_penjualan'];?></a></td>
                                                <td><?php echo $data['tanggal']?></td>
                                                <td><?php echo $data['nama_pembayaran'];?></td>
                                                <td><?php echo rupiah($data['subtotal'])?></td>
                                                <td><?php echo rupiah($data['bayar'])?></td>
                                                <td><?php echo $data['nama'];?></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>