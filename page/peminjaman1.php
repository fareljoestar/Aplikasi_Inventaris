<?php
 $sql = "SELECT max(id_peminjaman) as maxKode FROM peminjaman";
 $query = mysqli_query($koneksi, $sql);
 $data = mysqli_fetch_array($query);
 $id_peminjaman =$data['maxKode'];

 @$NoUrut = (int) substr($id_peminjaman, 3, 3);
 $NoUrut++;

 $char = "PMJ";
 $kodePeminjaman = $char . sprintf("%03s", $NoUrut);
?>
<!---<div class="row">-->
    <center>
        <h2>Peminjaman Inventaris</h2>
    </center>
    <hr>
    <div class="col-lg-3">
        <div class="panel panel-primary"></div>
        <div class="panel-heading">Peminjaman</div>
        <div class="panel-body"></div>
        <form action="" method="post">
        <div class="col-md-12">
            <div class="form-group">
            <label for="">Kode Peminjaman</label>
            <input type="text" class="form-control" name="id_peminjaman" value="<?= $kodePeminjaman  ?>" readonly>
            </div>
                <div class="form-group" >
                    <label for="">Nama Peminjam</label>
                    <select name="id_pegawai" id="" class="form-control">
                    <option value="">Nama Pegawai</option>
                    <?php
                    $sql_pegawai = "SELECT * FROM pegawai";
                    $q_pegawai = mysqli_query($koneksi, $sql_pegawai);
                    while($pegawai = mysqli_fetch_array($q_pegawai)){
                        ?>
                        <option value="<?= $pegawai['id_pegawai']?>"><?= $pegawai['nama_pegawai']?></option>
                        <?php
                    }
                    ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Pilih Barang</label>
                    <select name="id_inventaris" id="" class="form-control">
                    <option value="">Nama Barang</option>
                    <?php
                    $sql_inventaris = "SELECT * FROM inventaris";
                    $q_inventaris = mysqli_query($koneksi, $sql_inventaris);
                    while($inventaris = mysqli_fetch_array($q_inventaris)){
                        ?>
                        <option value="<?= $inventaris['id_inventaris']?>"><?= $inventaris['nama']?></option>
                        <?php
                    }
                    ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Jumlah</label>
                    <input type="number" class="form-control" name="jumlah">
               </div>
               <div class="form-group">
                   <button class="btn btn-md btn-primary" name="simpan">Simpan</button>                
               </div>
        </div>
        </form>
    </div>
    <?php
    if(isset($_POST['simpan'])){
        $id_peminjaman = $_POST['id_peminjaman'];
        $id_pegawai = $_POST['id_pegawai'];
        $id_inventaris = $_POST['id_inventaris'];
        $jumlah = $_POST['jumlah'];

        $sql_peminjaman = "INSERT INTO peminjaman SET
        id_peminjaman = '$id_peminjaman',
        id_pegawai = '$id_pegawai',
        status_peminjaman = '0'";   

        $query_input = mysqli_query($koneksi, $sql_peminjaman);
        if($query_input){
            $detail_pinjam = "INSERT INTO detail_pinjam SET
            jumlah = '$jumlah',
            id_inventaris = '$id_inventaris' ,
            id_peminjaman = '$id_peminjaman'";

            $q_detail_pinjam = mysqli_query($koneksi, $detail_pinjam);
            if($q_detail_pinjam){
                ?>
                <script type = "text/javascript">
                    window.location.href="?p=peminjaman1"
                </script>
                <?php
            }else{
                echo "gagal";
            }    
        }else{
            echo "Gagal menyimpan";
        }
    }
    ?>  
    <div class="col-lg-9">
        <div class="panel panel-primary">
            <div class="panel-heading">Daftar Barang Yang Dipinjam</div>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-stripped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Pinjam</th>
                        <th>Tgl.pinjam</th>
                        <th>Nama peminjam</th>
                        <th>Nama Barang</th>
                        <th>JML</th>
                        <th>Tgl.kembali</th>
                        <th>Status</th>
                    </tr>
                
                </thead>
                <tbody>
                    <?php
                    $hari = date('d-m-Y');
                    $d_peminjaman = "SELECT *, detail_pinjam.jumlah as jml FROM detail_pinjam left join peminjaman on peminjaman.id_peminjaman = detail_pinjam.id_peminjaman 
                    left join inventaris on inventaris.id_inventaris = detail_pinjam.id_inventaris left join pegawai on pegawai.id_pegawai = peminjaman.id_pegawai";
                    $d_query =  mysqli_query($koneksi, $d_peminjaman);
                    $cek = mysqli_num_rows($d_query);

                    if ($cek > 0){
                        $no = 1;
                        while($data_d = mysqli_fetch_array($d_query)){
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $data_d['id_peminjaman']?></td>
                                <td><?= $hari?></td>
                                <td><?= $data_d['nama_pegawai']?></td>
                                <td><?= $data_d['nama']?></td>
                                <td><?= $data_d['jml']?></td>
                                <td><?= $data_d['tanggal_kembali']?></td>
                                <td>
                                    <?php
                                    if($data_d['status_peminjaman'] == '0'){
                                        echo "<label class='label label-danger'>Konfirmasi</label>";
                                    }else if($data_d['status_peminjaman'] == '1'){
                                        echo "<label class='label label-warning'>Dipinjam</label>";
                                    }else{
                                        echo "<label class='label label-success'>Dikembalikan</label>";
                                    }
                                    ?>
                                </td>
                                
                            </tr>
                            <?php
                        }
                    }
                    ?>
                        <!--<tr>
                            <td>1</td>
                            <td>PMJ001</td>
                            <td>6-2-2023</td>
                            <td>Andika</td>
                            <td>Laptop</td>
                            <td>10</td>
                            <td>00-00-0000</td>
                            <td>
                                <label for="" class="label label-danger">Belum</label>
                            </td>
                            <td>
                                <a href="" class="btn btn-primary btn-sm">Proses</a>
                            </td>
                        </tr>-->
                </tbody>
            </table>
        </div>
    </div>
</div>