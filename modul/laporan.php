<?php
include('../koneksi.php');
$daritanggal   = $_POST['daritanggal'];
$sampaitanggal = $_POST['sampaitanggal'];
$ambil         = $koneksi->query("SELECT * FROM tb_pengaturan");
$lihat         = $ambil->fetch_assoc();
$namasitus     = $lihat['namasitus'];
function rupiah($angka){	
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;
}
?>
<title>Laporan</title>
<style>
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}
h1, h4 {
    text-align:center;
}
tr:hover {background-color:#f5f5f5;}
@media print {
  #ngeprint {
    display: none;
  }
}
</style>
<h1>Laporan <?php echo $namasitus;?></h1>
<h4><?php echo $daritanggal;?> - <?php echo $sampaitanggal;?></h4>
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Kode penjualan</th>
                                                <th>Nama barang</th>
                                                <th>Jumlah</th>
                                                <th>Harga jual</th>
                                                <th>Total</th>
                                                <th>Keuntungan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $no = 1;
                                            $sql = $koneksi->query("SELECT * FROM tb_barang, tb_penjualan WHERE
                                            tb_barang.barcode = tb_penjualan.barcode AND tgl_penjualan BETWEEN '$daritanggal'
                                            AND '$sampaitanggal'");
                                            while ($data = $sql->fetch_assoc()){
                                            $tanggal  = date('d F Y', strtotime( $data['tgl_penjualan']));
                                            $profit   = $data['profit'];
                                            $jml      = $data['jumlah'];
                                            $untung   = $profit * $jml;
                                        ?>
                                        <tr>
                                                <td><?php echo $no++;?></td>
                                                <td><?php echo $tanggal;?></td>
                                                <td><?php echo $data['kode_penjualan'];?></td>
                                                <td><?php echo $data['nama_barang'];?></td>
                                                <td><?php echo $data['jumlah'];?></td>
                                                <td><?php echo $data['harga_jual'];?></td>
                                                <td><?php echo $data['total'];?></td>
                                                <td><?php echo $untung?></td>
                                            </tr>
                                            <?php 
                                            $totalpenjualan = $totalpenjualan + $data['total'];
                                            $totaluntung    = $totaluntung + $profit;
                                                }
                                            ?>
                                        </tbody>
                                        <tr>
                                                <th colspan="6">TOTAL</th>
                                                <td style="font-weight:bold"><?php echo rupiah($totalpenjualan);?></td>
                                                <td style="font-weight:bold"><?php echo rupiah($totaluntung);?></td>
                                        </tr>
                                    </table>
                                    <br/>
<input type="button" value="Cetak" onclick="window.print();" id="ngeprint"/>