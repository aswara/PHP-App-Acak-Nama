<?php 

//koneksi database
$conn = mysqli_connect('localhost', 'root', '', 'belajararisan');

if(mysqli_connect_errno()){
	printf("Koneksi gagal", mysql_connect_error());
	exit();
}

function query($query) {
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}
	return $rows;
}

//pengamanan input data
function cek($data) {
	return htmlspecialchars($data);
}

//tambah data
function tambah($data, $table) {
	global $conn;
	$nama = cek($data["nama"]);

	//query insert data
	$query = "INSERT INTO $table VALUES ('', '$nama')";
	$result = mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

//hapus data
function hapus($id, $table) {
	global $conn;
	mysqli_query($conn, "DELETE FROM $table WHERE id=$id");

	return mysqli_affected_rows($conn);
}

//edit data
function edit($id, $nama, $table) {
	global $conn;
	mysqli_query($conn, "UPDATE $table SET nama='$nama' WHERE id=$id");

	return mysqli_affected_rows($conn);
}

 ?>