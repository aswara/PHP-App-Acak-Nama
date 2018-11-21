<?php 
require 'functions.php';

$id = $_GET["id"];

$hapus = hapus($id, 'menang');
if ($hapus) {
	header('Location: peserta.php');
} else {
	echo "gagal menghapus";
}
