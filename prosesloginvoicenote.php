<?php
// Proses Form Login
// Panggil Koneksi ke Database.
include 'connection.php';

session_start();
// Variable - Perintah - Nilai dari Variable itu sendiri ( Nilai diambil dari Form )
// Tangkap data dari Form Login
$username	= $_POST['username'];
$password	= $_POST['password'];

//untuk mencegah sql injection
//kita gunakan mysql_real_escape_string
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);

$q = mysql_query("select * from uservoice where username='$username' and password='$password'");

if(mysql_num_rows($q) == 0) {
	echo"<script>alert('INVALID USERNAME OR YOUR PASSWORD');window.location = 'loginvoicenote.php'</script>";
}else{
	$_SESSION['username'] = $username;
	header('location:index.php');
}

?>