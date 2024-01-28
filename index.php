<?php
session_start();
  include "config/koneksi.php";
  if(!empty($_SESSION['username'])){
            @$user = $_SESSION['username'];
            @$level= $_SESSION['level'];
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Aplikasi Inventaris Kantor</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/navbar-fixed-top.css" rel="stylesheet">
    

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
      .dropdown a:hover{
        background-color:yellow;
        transition:0.6s;
      }
      .nav li a:hover{
        background-color:orange;
        color:white;
      }
    </style>
  </head>

  <link rel="stylesheet" href="./dist/css/style.css">

  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	    	<a class="navbar-brand" href="?p=index.html">Inventaris<span>App</span></a>
	    	<!--<form action="#" class="searchform order-sm-start order-lg-last">
          <div class="form-group d-flex">
            <input type="text" class="form-control pl-3" placeholder="Search">
            <button type="submit" placeholder="" class="form-control search"><span class="fa fa-search"></span></button>
          </div>
        </form>-->
	      <!--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="fa fa-bars"></span> Menu
	      </button>-->
	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav m-auto">
          <?php
            if(@$level == "1"){
              ?>
                 <li class="nav-item"><a href="?p=list_barang&halaman=1" class="nav-link">DaftarInventaris</a></li>
                 <li class="nav-item"><a href="?p=peminjaman" class="nav-link">Peminjaman</a></li>
	        	     <li class="nav-item"><a href="?p=pengembalian" class="nav-link">Pengembalian</a></li>
	               <li class="nav-item"><a href="?p=laporan" class="nav-link">Laporan</a></li>
              <?php
            }
            ?>
             <?php
            if(@$level == "2"){
              ?>
                 <li class="nav-item"><a href="?p=peminjaman" class="nav-link">Peminjaman</a></li>
                 <li class="nav-item"><a href="?p=pengembalian" class="nav-link">Pengembalian</a></li>
              <?php
            }
            ?>
              <?php
            if(@$level == "3"){
              ?>
                 <li class="nav-item"><a href="?p=peminjaman1"  class="nav-link">Peminjaman</a></li>
              <?php
            }
              ?>
	        	<!--<li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Page</a>
              <div class="dropdown-menu" aria-labelledby="dropdown04">
              	<a class="dropdown-item" href="#">Page 1</a>
                <a class="dropdown-item" href="#">Page 2</a>
                <a class="dropdown-item" href="#">Page 3</a>
                <a class="dropdown-item" href="#">Page 4</a>
              </div>
            </li>-->
	        	<!--<li class="nav-item"><a href="?p=peminjaman" class="nav-link">Catalog</a></li>
	        	<li class="nav-item"><a href="?p=pengembalian" class="nav-link">Blog</a></li>
	          <li class="nav-item"><a href="?p=laporan" class="nav-link">Contact</a></li>-->
	       
	     
  <body>
    
    <!-- Fixed navbar -->
    <!-- <nav class="navbar navbar-default navbar-fixed-top"> -->
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- <a class="navbar-brand" href="#">Aplikasi Inventaris</a> -->
        </div>
        <div id="navbar" class="navbar-collapse collapse">  
          </ul>
          <!--<li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Page</a>
              <div class="dropdown-menu" aria-labelledby="dropdown04">
              	<a class="dropdown-item" href="#">Page 1</a>
                <a class="dropdown-item" href="#">Page 2</a>
                <a class="dropdown-item" href="#">Page 3</a>
                <a class="dropdown-item" href="#">Page 4</a>
              </div>
            </li>-->
	        	<!--<li class="nav-item"><a href="?p=peminjaman" class="nav-link">Catalog</a></li>
	        	<li class="nav-item"><a href="?p=pengembalian" class="nav-link">Blog</a></li>
	          <li class="nav-item"><a href="?p=laporan" class="nav-link">Contact</a></li>-->
          <ul class="nav navbar-nav navbar-right">
          <?php
             if(!empty($user)){
              ?>
              <li class="nav-item dropdown">
              <a class="nav-link" href="#" id="dropdown04" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                <?= $user ?><span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="page/keluar.php">Keluar</a></li>
              </ul>
            </li>
            </div>
            </ul>
	    </div>
    </nav>
              <?php
             }
          ?>
          </ul>
          </nav>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">

      <!-- Main component for a primary marketing message or call to action -->
     <?php

     if(!empty($_SESSION['username'])){
        $user = $_SESSION['username'];

     @$p = $_GET['p'];
     switch ($p) {
        case 'login':
            include "page/login.php";
            break;

            case 'list_barang':
                include "page/list_barang.php";
                break;

            case 'tambah_barang':
                include "page/tambah_barang.php";
                break;

            case 'edit_barang':
                    include "page/edit_barang.php";
                    break;

            case 'View_barang':
                    include "page/View_barang.php";
                    break;

            case 'peminjaman':
                    include "page/peminjaman.php";
                    break;

            case 'peminjaman1':
                    include "page/peminjaman1.php";
                    break;
                    
            case 'edit_barang':
                    include "page/edit_barang.php";
                    break;

            case 'pengembalian':
                    include "page/pengembalian.php";
                    break; 

           case 'detail_pengembalian':
                    include "page/detail_pengembalian.php";
                    break;  

          case 'laporan':
                    include "page/laporan.php";
                    break;                 
          case 'home':
                    include "page/home.php";
                    break; 
          case 'hapus':
                include "page/hapus.php";
                break;          
        default:
            include "page/login.php";
            break;
     }
     }else{
       include "page/login.php";
     }
     ?>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
<script type="text/javascript">
$(document).on('click','#cetak',function(){
var tgl_awal = $("#tgl_awal").val();
var tgl_sampai = $("#tgl_sampai").val();
window.open('page/cetak_laporan.php?tgl_awal='+tgl_awal+"&tgl_sampai="+tgl_sampai,'_blank');
});
</script>
