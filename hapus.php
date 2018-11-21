<?php 
require 'functions.php';

$id = $_GET["id"];

$hapus = hapus($id, 'users');
	//apakah hapus berhasil
	if($hapus){
		header("Location:peserta.php");
	} else {
		die("gagal menghapus");
	}
