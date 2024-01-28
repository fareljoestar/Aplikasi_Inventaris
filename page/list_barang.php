<link rel="stylesheet" href="./css1/popup.css">
<div class="popup-image">
        <span class="glyphicon glyphicon-remove-circle"></span>
        <img src="img/<?php echo $data['img'];?>" class="image" width='400' alt="">
    </div>

<center><h2>DAFTAR INVENTARIS</h2></center>

<hr>
<a href="?p=tambah_barang" class="btn btn-md btn-primary"><span class="glyphicon glyphicon-plus"></span></a>
<!--pencarian barang-->
<form class="navbar-form navbar-right" role="search" method="get">
        <div class="form-group">
          <input type="hidden" name = "p" value = "list_barang">
          <input type="text" class="form-control" placeholder="Pencarian Barang" name="cari">
        </div>
        <button type="submit" class="btn btn-default">Cari</button>
      </form>

<br><br>     
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Gambar</th>
            <th>Kode Inventaris</th>
            <th>Nama Barang</th>
            <th>Kondisi</th>
            <th>Jumlah</th>
            <th>Ruang</th>
            <th>Tanggal Register</th>
            <th>Keterangan</th>
            <th>Opsi</th>
        </tr>
    </thead>
    <tbody>
    <?php
       @$cari = $_GET['cari'];
        $q_cari = "";
            if(!empty($cari)){
                $q_cari .= "and nama like '%" .$cari."%'";
              }
              $pembagian = 5;
              $page = isset($_GET['halaman']) ? (INT)$_GET['halaman'] : 1;
              $mulai = $page > 1 ? $page * $pembagian - $pembagian : 0;
      
        $sql = "SELECT *, inventaris.keterangan as ket FROM inventaris LEFT JOIN ruang ON ruang.id_ruang = inventaris.id_ruang WHERE 1=1 $q_cari LIMIT $mulai, $pembagian";
        $query = mysqli_query($koneksi, $sql);
        $cek = mysqli_num_rows($query);
        //echo $cek;

        //Mencari Total Halaman
        $sql_total = "SELECT * FROM inventaris";
        $q_total = mysqli_query($koneksi,$sql_total);
        $total = mysqli_num_rows($q_total);
        
        $jumlahHalaman = ceil($total / $pembagian);

        if($cek > 0){
           $no = $mulai + 1;
           while($data = mysqli_fetch_array($query)){
              $tgl = $data['tanggal_register'];
           ?>
           <tr>
            <td><?= $no++ ?></td>
            <td><img src="img/<?php echo $data['img'];?>" class="image popup-trigger" width='100' alt=""></td>
            <td><?= $data['kode_inventaris'] ?></td>
            <td><?= $data['nama'] ?></td>
            <td><?= $data['kondisi'] ?></td>
            <td><?= $data['jumlah'] ?></td>
            <td><?= $data['nama_ruang'] ?></td>
            <td><?= date ("d-m-y", strtotime($tgl)) ?></td>
            <td><?= $data['ket'] ?></td>
            <td>
            <a href="?p=View_barang&id_inventaris=<?= $data['id_inventaris'] ?>" class= "btn btn-md btn-success"><span class="glyphicon glyphicon-eye-open"></span></a>
            <a href="?p=edit_barang&id_inventaris=<?= $data['id_inventaris'] ?>" class="btn btn-md btn-primary"><span class="glyphicon glyphicon-edit"></span></a>
            <a onclick = "return confirm ('Apakah Anda Yakin Ingin Menghapusnya?')" href="page/hapus_barang.php?id_inventaris=<?= $data['id_inventaris']?>" class="btn btn-md btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
          </td>
          </tr>
          <?php
          }
        }
        ?>
      <!--<tr>
        <td>1</td>
        <td>L001</td>
        <td>Laptop</td>
        <td>Baik</td>
        <td>50</td>
        <td>LAB RPL</td>
        <td>5-29-2023</td>
        <td>Barang di dapat dari bantuan provinsi</td>
        <td>
            <a href="?p=edit_barang" class="btn btn-md btn-primary"><span class="glyphicon glyphicon-edit"></span></a>
            <a href="" class="btn btn-md btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
        </td>
      </tr>-->
    </tbody>    
</table>
<!--Halaman Selanjutnya-->
<div class="" style="float:right">
<nav>
  <ul class="pagination">
    <li>
    <a href="?p=list_barang&halaman=<?= $page - 1 ?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
    </a>
    </li>
    <?php
    for ($i = 1; $i <= $jumlahHalaman; $i++){
      ?>
          <li class="<?= ($i == @$_GET['halaman'] ? 'active' : '')?>">
              <a href="?p=list_barang&halaman=<?= $i ?>"><?= $i?></a>
          </li>
        <?php
      }
    ?>
    <!--<li><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li>-->
    <li>
      <a href="?p=list_barang&halaman=<?= $page + 1?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>
</div>
<div class="float-left">
    jumlah : <?= $total?>
</div>

<script>
    document.querySelectorAll('.popup-trigger').forEach(trigger => {
        trigger.onclick = () => {
            document.querySelector('.popup-image').style.display = 'block';
            document.querySelector('.popup-image img').src = trigger.getAttribute('src');
        };
    });

    document.querySelector('.popup-image span').onclick = () => {
        document.querySelector('.popup-image').style.display = 'none';
    };
    // Tambahkan fungsi untuk membuka pop-up
function openPopup() {
    document.querySelector('.popup-image').style.display = 'flex';
    document.body.classList.add('popup-opened');
}

// Tambahkan fungsi untuk menutup pop-up
function closePopup() {
    document.querySelector('.popup-image').style.display = 'none';
    document.body.classList.remove('popup-opened');
}
</script>