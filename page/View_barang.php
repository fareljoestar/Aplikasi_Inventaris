<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lihat barang</title>
</head>
<body>

<?php
$id_inventaris = $_GET['id_inventaris'];
if(empty($id_inventaris)){
    ?>
        <script type="text/javascript">
            window.location.href="?p=list_barang";
        </script>
    <?php
}

    $sql = "SELECT *, inventaris.keterangan as ket FROM inventaris LEFT JOIN ruang ON ruang.id_ruang = inventaris.id_ruang LEFT JOIN jenis ON jenis.id_jenis = inventaris.id_jenis WHERE id_inventaris = '$id_inventaris'";
    $query = mysqli_query($koneksi, $sql);
    $cek = mysqli_num_rows($query);
    
    if($cek > 0 ){
        $data = mysqli_fetch_array($query);
    }else{
        $data = NULL;
    }
?>
    <div class="col-lg-12 center">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Info Barang
            </div>
            <div class="panel panel-body">
                <!-- isi -->
                <div class="col-lg-3 center">
                    <div class="panel panel-body">
                            <div class="panel panel-success">
                                <div class="panel panel-heading">
                                    <label>Kode Inventaris</label>
                                </div>
                                <div class="panel panel-body">
                                    <input type="text" class="form-control" name="kode_inventaris" value="<?= $data['kode_inventaris']?>" readonly>
                                </div>
                            </div>
                            <!-- Nama Inventaris -->
                            <div class="panel panel-success">
                                <div class="panel panel-heading">
                                    <label>Nama Inventaris</label>
                                </div>
                                <div class="panel panel-body">
                                    <input type="text" class="form-control" name="nama" value="<?= $data['nama']?>" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- start -->
                <div class="col-lg-3 center">
                    <div class="panel panel-body">
                            <div class="panel panel-success">
                                <div class="panel panel-heading">
                                    <label>Foto barang</label>
                                </div>
                                <div class="panel panel-body">
                                    <img src="img/<?php echo $data['img'];?>" class="" width='100%' alt="">
                                </div>
                            </div>
                    </div>
                </div>
                <!-- end -->
                <!-- start -->
                <div class="col-lg-3 center">
                    <div class="panel panel-body">
                            <div class="panel panel-success">
                                <div class="panel panel-heading">
                                    <label>Kondisi barang</label>
                                </div>
                                <div class="panel panel-body">
                                    <input type="text" class="form-control" name="kondisi" value="<?= $data['kondisi']?>" readonly>
                                </div>
                            </div>
                            <!-- hehe -->
                            <div class="panel panel-success">
                                <div class="panel panel-heading">
                                    <label>Tanggal register</label>
                                </div>
                                <div class="panel panel-body">
                                    <input type="text" class="form-control" name="tanggal_register" value="<?= $data['tanggal_register']?>" readonly>
                                </div>
                            </div>
                    </div>
                </div>
                <!-- end -->
                <!-- start -->
                <div class="col-lg-3 center">
                    <div class="panel panel-body">
                            <div class="panel panel-success">
                                <div class="panel panel-heading">
                                    <label>Jumlah barang</label>
                                </div>
                                <div class="panel panel-body">
                                    <input type="text" class="form-control" name="jumlah" value="<?= $data['jumlah']?>" readonly>
                                </div>
                            </div>
                            <!-- hehe -->
                            <div class="panel panel-success">
                                <div class="panel panel-heading">
                                    <label>Jumlah barang</label>
                                </div>
                                <div class="panel panel-body">
                                    <input type="text" class="form-control" name="nama_ruang" value="<?= $data['nama_ruang']?>" readonly>
                                </div>
                            </div>
                    </div>
                    
                </div>
                <!-- hehu -->
                <div class="col-lg-12 center">
                    <div class="panel panel-success">
                        <div class="panel panel-heading">
                            <label>Keterangan barang</label>
                        </div>
                        <div class="panel panel-body">
                            <input type="text" class="form-control" name="ket" value="<?= $data['ket']?>" readonly>
                        </div>
                    </div>
                </div>
                <!---->
            </div>
            <!-- end -->
        </div>
        <!-- penutup form biru -->
        <div class="panel panel-primary">
            <div class="panel panel-heading">
                <label>Opsi</label>
            </div>
            <div class="panel panel-body">
                <a href="?p=list_barang&halaman=1?>" class="btn btn-md btn-success"><span class="glyphicon glyphicon-eye-close"></span></a>
                <a href="?p=edit_barang&id_inventaris=<?= $data['id_inventaris']?>" class="btn btn-md btn-primary"><span class="glyphicon glyphicon-edit"></span></a>
                <a onclick="return confirm('Apakah anda yakin untuk menghapusnya?')" href="page/hapus_barang.php?id_inventaris=<?= $data['id_inventaris']?>" class="btn btn-md btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
            </div>
        </div>
    </div>
</body>
</html>