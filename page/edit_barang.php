<?php
$id_inventaris = $_GET['id_inventaris'];
if(empty($id_inventaris)){
    ?>
    <script type="text/javascript">
        window.location.href="?p=list_barang";
    </script>
    <?php
}
    $sql = "SELECT *, inventaris.keterangan as ket FROM inventaris LEFT JOIN ruang ON  ruang.id_ruang = inventaris.id_ruang LEFT JOIN jenis ON jenis.id_jenis = inventaris.id_jenis WHERE id_inventaris ='$id_inventaris'";
    $query = mysqli_query($koneksi, $sql);
    $cek = mysqli_num_rows($query);
    
    if ($cek > 0){
        $data = mysqli_fetch_array($query);
    }else{
        $data = NULL;
    }
?>
<div class="row">
    <div class="col-lg-4 center">
    <!--Warna Tampilan-->
    <div class="panel panel-primary">
        <div class="panel-heading">Edit Inventaris</div>
            <div class="panel-body">
    <form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="">Kode Inventaris</label>
        <input type="text" class="form-control" name="kode_inventaris" value="<?= $data['kode_inventaris']?>">
    </div>
    <div class="form-group">
        <label for="">Nama Inventaris</label>
        <input type="text" class="form-control" name="nama" value="<?= $data['nama']?>">
       </div>
    <div class="form-group">
        <label for="">Kondisi</label>
        <select name="kondisi" id="" class="form-control">
            <option value="<?= $data['kondisi']?>" name="kondisi" class="form-control"><?= $data['kondisi']?></option>
            <option value="baik" name="" class="form-control">Baik</option>
            <option value="bekas" name="" class="form-control">Bekas</option>
            <option value="rusak" name="" class="form-control">Rusak</option>
        </select>
       </div>
       <div class="form-group">
        <label for="">Jumlah</label>
        <input type="number" class="form-control" placeholder="Masukkan Jumlah Barang" name="jumlah" value="<?= $data['jumlah']?>">
       </div>

       <div class="form-group">
        <label for="">Jenis Inventaris</label>
        <select class="form-control" name="id_jenis" id="">
            <option value="<?= $data['id_jenis']?>"class="form-control"><?= $data['nama_jenis']?></option>
            <?php
                $sql_jenis = "SELECT * FROM jenis";
                $q_jenis = mysqli_query($koneksi, $sql_jenis);
                while($jenis = mysqli_fetch_array($q_jenis)){
                    ?>
                    <option value="<?= $jenis['id_jenis']?>"><?= $jenis['nama_jenis']?></option>
                    <?php
                }
            ?>
        </select>
       </div>

       <div class="form-group">
        <label for="">Nama Ruang</label>
        <select name="id_ruang" class="form-control" id="">
            <option value="<?= $data['id_ruang']?>"><?= $data['nama_ruang']?></option>
            <?php
                $sql_ruang = "SELECT * FROM ruang";
                $q_ruang = mysqli_query($koneksi, $sql_ruang);
                while($ruang = mysqli_fetch_array($q_ruang)){
                    ?>
                    <option value="<?= $ruang['id_ruang']?>"><?= $ruang['nama_ruang']?></option>
                    <?php
                }
            ?>
        </select>
       </div>
       <div class="form-group">
        <label for="">Keterangan</label>
        <textarea name="ket" id="" cols="30" rows="5" class="form-control" name="ket" value="<?= $data['ket']?>"><?= $data['ket']?></textarea>
        <div class="form-group">
                <label>Foto</label>
                <input type="file" name="img" class="file">
                <br>
                <img src="img/<?php echo $data['img'];?>" class="file" width='100' alt="">
                <p>nama file : <?= $data['img']?> </p>
       </div>   
       <div class="form-group">
        <button class="btn btn-md btn-primary" name="simpan" type="submit">Simpan</button>
        <a href="?p=list_barang&halaman=1" class="btn btn-md btn-default">Kembali</a>
       </div>     
    </form> 
    </div>
    <?php
        if(isset($_POST['simpan'])){
            $kode_inventaris = $_POST['kode_inventaris'];
            $nama = $_POST['nama'];
            $kondisi = $_POST['kondisi'];
            $jumlah = $_POST['jumlah'];
            $id_jenis = $_POST['id_jenis'];
            $id_ruang = $_POST['id_ruang'];
            $ket = $_POST['ket'];

            $ekstensi_diperbolehkan	= array('png','jpg');
            @$img = $_FILES['img']['name'];
            $x = explode('.', $img);
            $ekstensi = strtolower(end($x));
            @$file_tmp = $_FILES['img']['tmp_name'];

            $newimg = date('dmYHis').$img;
            $path = "img/".$newimg;
            
            $sql_update = "UPDATE inventaris SET kode_inventaris = '$kode_inventaris',
            nama = '$nama',
            kondisi = '$kondisi' ,
            jumlah = '$jumlah' ,
            id_jenis = '$id_jenis' ,
            id_ruang = '$id_ruang' ,
            keterangan = '$ket',
            img = '$newimg' WHERE id_inventaris = '$id_inventaris'";

            // $newimg = date('dmYHis').$img;
            // $path = "img/".$newimg;
            if(move_uploaded_file($file_tmp,$path)){
                $sql = "SELECT *, inventaris.keterangan as ket FROM inventaris LEFT JOIN ruang ON ruang.id_ruang = inventaris.id_ruang LEFT JOIN jenis ON jenis.id_jenis = inventaris.id_jenis WHERE id_inventaris = '$id_inventaris'";
                $query = mysqli_query($koneksi, $sql);
                $cek = mysqli_num_rows($query);
            }
            if(is_file("img/".$data['img'])){
                unlink("img/".$data['img']);
            }

            $q_update = mysqli_query($koneksi, $sql_update);
        if($q_update){
            ?>
                <script type="text/javascript">
                    window.location.href="?p=list_barang&halaman=1"
                </script>
            <?php
        }else{
            ?>
                <div class="alert alert-danger">
                    Inventaris Gagal di update !
                </div>
            <?php
        }
    }
?>
</div>
</div>
</div>
</div>
<script>

function konfirmasi(){
konfirmasi=confirm("Apakah anda yakin ingin menghapus gambar ini?")
document.writeln(konfirmasi)
}

$(document).on("click", "#pilih_gambar", function() {
var file = $(this).parents().find(".file");
file.trigger("click");
});

$('input[type="file"]').change(function(e) {
var fileName = e.target.files[0].name;
$("#file").val(fileName);

var reader = new FileReader();
reader.onload = function(e) {
// get loaded data and render thumbnail.
document.getElementById("preview").src = e.target.result;
};
// read the image file as a data URL.
reader.readAsDataURL(this.files[0]);
});

        </div>
    
    </div>

</div>