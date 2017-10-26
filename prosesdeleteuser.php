<?php
// Panggil Koneksi ke Database.
include 'connection.php';
// Data Deposit

// Get Data ID Bank
$id=$_GET['id'];

$query_delete = "DELETE FROM uservoice WHERE reg='$id'";
$sql_delete = mysql_query($query_delete);

	if($sql_delete){
		echo "<script>alert('Data User Berhasil di Delete');window.location = 'adminvoicenote.php'</script>";
	}else{
		echo "<script>alert('Koneksi Kedatabase Gagal');window.location = 'adminvoicenote.php'</script>";
	}

?>