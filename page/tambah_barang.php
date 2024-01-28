<div class="row">
    <div class="col-lg-4 center">
    <!--Warna Tampilan-->
    <div class="panel panel-primary">
        <div class="panel-heading">Tambah Inventaris</div>
            <div class="panel-body">
            <form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="">Kode Inventaris</label>
        <input type="text" class="form-control" name="kode_inventaris" placeholder="Masukkan Kode Barang">
    </div>
    <div class="form-group">
        <label for="">Nama Inventaris</label>
        <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Barang">
       </div>
    <div class="form-group">
        <label for="">Kondisi</label>
        <select name="kondisi" id="" class="form-control">
            <option value="" name="kondisi" class="form-control">- Pilih -</option>
            <option value="Baik" name="kondisi" class="form-control">Baik</option>
            <option value="Baik" name="kondisi" class="form-control">Bekas</option>
            <option value="Rusak" name="kondisi" class="form-control">Rusak</option>
        </select>
       </div>
       <div class="form-group">
        <label for="">Jumlah</label>
        <input type="number" class="form-control" name="jumlah" placeholder="Masukkan Jumlah Barang">
       </div>
       <div class="form-group"> <!-- ini jenis inventaris buka-->
            <label for="">Jenis Inventaris</label>
            <select name="id_jenis" id="" class="form-control">

                <option value="" class="form-control">-- pilih --</option>
                <?php
                $sql_jenis = "SELECT * FROM jenis";
                $q_jenis = mysqli_query($koneksi, $sql_jenis);
                while($jenis =  mysqli_fetch_array($q_jenis)){
                    ?>
                        <option value="<?= $jenis['id_jenis'] ?>"><?= $jenis['nama_jenis'] ?></option>
                        <?php
                }
                ?>
            </select>
       </div> <!-- ini jenis inventaris tutup-->
       <div class="form-group"> <!-- ini nama ruang buka-->
            <label for="">Nama Ruang</label>
            <select name="id_ruang" id="" class="form-control">

                <option value="" class="form-control">-- pilih --</option>
                <?php
                $sql_ruang = "SELECT * FROM ruang";
                $q_ruang = mysqli_query($koneksi, $sql_ruang);
                while($ruang =  mysqli_fetch_array($q_ruang)){
                    ?>
                        <option value="<?= $ruang['id_ruang'] ?>"><?= $ruang['nama_ruang'] ?></option>
                        <?php
                }
                ?>
            </select>
       </div> <!-- ini nama ruang tutup-->
       <div class="form-group">
        <label for="">Keterangan</label>
        <textarea name="keterangan" id="" cols="30" rows="5" class="form-control"></textarea>
       </div>   

       <div class="form-group hidden">
        <label for="">Petugas</label>
        <input type="number" name="id_petugas" value="2"  class="form-control">
       </div>   

       <div class="form-group">
            <input type="file" name="img" class="file" >
        </div>

       <div class="form-group">
        <button class="btn btn-md btn-primary" name="simpan">Simpan</button>
        <a href="?p=list-barang" class="btn btn-md btn-default">Kembali</a>
       </div>     
    </form> 
    <?php
        if(isset($_POST['simpan'])){

            if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $ekstensi_diperbolehkan	= array('png','jpg');
            @$img = $_FILES['img']['name'];
            $x = explode('.', $img);
            $ekstensi = strtolower(end($x));
            @$file_tmp = $_FILES['img']['tmp_name'];
            
            $kode_inventaris = $_POST['kode_inventaris'];
            $nama = $_POST['nama'];
            $kondisi = $_POST['kondisi'];
            $jumlah = $_POST['jumlah'];
            $id_jenis = $_POST['id_jenis'];
            $id_ruang = $_POST['id_ruang'];
            $keterangan = $_POST['keterangan'];
            $id_petugas = $_POST['id_petugas'];

            $sql = "INSERT INTO inventaris SET 
            kode_inventaris= '$kode_inventaris', 
            nama='$nama', 
            kondisi= '$kondisi', 
            jumlah='$jumlah', 
            id_jenis='$id_jenis', 
            id_ruang='$id_ruang', 
            keterangan='$keterangan',
            id_petugas='$id_petugas' ";

if (!empty($img)){
    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true){

        //Mengupload img
        move_uploaded_file($file_tmp, 'img/'.$img);

        $sql ="insert into inventaris (kode_inventaris, nama, kondisi, jumlah, id_jenis, id_ruang, keterangan, id_petugas, img) values ('$kode_inventaris', '$nama', '$kondisi', '$jumlah', '$id_jenis', '$id_ruang', '$keterangan', '$id_petugas', '$img')";

        $query = mysqli_query($koneksi, $sql);
        if($query){
        ?>
                    <div class="alert alert-success">Barang berhasil ditambahkan</div>
                <?php
            }else{
                ?>
                    <div class="alert alert-danger">Barang gagal ditambahkan</div>
                <?php
            }
        }
    }else {
        $img="bank_default.png";
        }
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
</script>