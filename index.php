<?php 
require 'functions.php';
//tampil peserta
$peserta = query('SELECT * FROM users');
//tampil pemenang
$pemenang = query('SELECT * FROM menang');
//tampil acak

//tambah data
if( isset($_POST["tambah"])) {
	$cek = tambah($_POST, 'users');
	//cek tambah data
	if ($cek) {
		header('Refresh:0');
	} else {
		echo "gagal menambah";
	}
}
//pindah data
if(isset($_POST["pindah"])) {
	$cek = tambah($_POST, 'users');
	//cek tambah data
	if ($cek) {
		header('Refresh:0');
	} else {
		echo "gagal menambah";
	}
}
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	   <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <link rel="stylesheet" type="text/css" href="css/style.css">
 	<title>Selamat Datang</title>
 </head>
 <body>
 	<div class="col s12">
 		<h1>Acak Nama</h1>
 	</div>
 	<div class="row">
 		<div class="col s4">
 			<div>
 				<form action="" method="POST">
 					<input type="text" name="nama" required="" placeholder="masukan nama">
 					<button type="submit" name="tambah" class="btn waves-effect waves-light">tambah</button>
 				</form>
 			</div>
 			<div>
 				<?php if(isset($_GET["id"])) {
 					$id = $_GET['id'];
 					$pesertaubah = query("SELECT * FROM users WHERE id=$id");

 					foreach ($pesertaubah as $pu) { ?>
 					<form action="" method="POST">
 						<input type="hidden" name="id" value="<?= $pu["id"]; ?>">
 						<input type="text" name="nama" value="<?= $pu["nama"]; ?>">
 						<button type="submit" name="ubah" class="btn waves-effect waves-light">ubah</button>
 					</form>
 				<?php } } if(isset($_POST["ubah"])) {
 					$nama = $_POST["nama"];
 					$id = $_POST["id"];
 					var_dump($id);
 					$edit = edit($id, $nama, 'users');
 					// cek jika berhasil reload
 					if ($edit) {
 						header("Location: peserta.php");
 					} } ?>
 			</div>
 	<table class="">
 		<thead>
 			<tr>
 				<th>No</th>
 				<th>Nama</th>
 				<th>Aksi</th>
 			</tr>
 		</thead>
 		<tbody>
 			<?php $i = 1; ?>
 			<?php foreach ($peserta as $psr) : ?>
 			<tr>
 				<td><?= $i; ?></td>
 				<td><?= $psr['nama'] ?></td>
 				<td>
 					<a href="peserta.php?id=<?= $psr['id']; ?>">edit</a>
 					| <a href="hapus.php?id=<?= $psr['id']; ?>">hapus</a>
 				</td>
 			</tr>
 			<?php $i++; ?>
 		<?php endforeach; ?>
 		</tbody>
 	</table>
 		</div>
 		<div class="col s5">
 			<form action="" method="POST">
 				<button name="acak" class="waves-effect waves-light btn-large">Mulai Acak</button>
 					<?php  	if(isset($_POST["acak"])){
					$acak = query('SELECT * FROM users ORDER BY rand()LIMIT 1');  ?>
 					<h4>Selamat Pemenangnya</h4>
 					<?php foreach ($acak as $ac) : ?>
 					<h1><?= $ac["nama"]; ?></h1>
 					<?php endforeach; 
 					//tambah data
 					tambah($ac, 'menang');
 					//hapus data
 					hapus($ac["id"], 'users');
 					} ?>
 			</form>
 		</div>
 		<div class="col s3">
 			<table>
 				<thead>
 					<tr>
 						<th>No</th>
 						<th>Nama</th>
 						<th>Aksi</th>
 					</tr>
 				</thead>
 				<tbody>
 					<h5>Urutan Pemenang</h5>
 					<?php $i=1; ?>
 					<?php foreach ( $pemenang as $menang ) : ?>
 					<tr>
 						<td><?= $i; ?></td>
 						<td><?= $menang['nama']; ?></td>
 						<td>
 							<a href="hapusmenang.php?id=<?= $menang['id']; ?>">hapus</a>
 							<form action="" method="POST">
 								<button name="pindah">
 									<input type="hidden" name="nama" value="<?=$menang['nama']; ?>">pindah</button>
 							</form>
 						</td>
 					</tr>
 					<?php $i++; ?>
 					<?php endforeach; ?>
 				</tbody>
 			</table>
 		</div>
 	</div>
<!--JavaScript at end of body for optimized loading-->
<script type="text/javascript" src="js/materialize.min.js"></script>
<script type="text/javascript" src="js/javascript.js"></script>
</body>
</html>