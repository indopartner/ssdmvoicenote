<?php
error_reporting(0);

// Kode untuk id ( akan dibuat secara acak ) Konfirmasi
function rand_string( $length ) {
	$chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";	
	$size = strlen( $chars );
	for( $i = 0; $i < $length; $i++ ) {
		$str .= $chars[ rand( 0, $size - 1 ) ];
	}
	return $str;
}

// Panggil Koneksi ke Database.
include 'connection.php';
// Data Register
$id 			= rand_string( 4 );
$departement	= $_POST['departement'];
$email			= $_POST['email'];
$username		= $_POST['username'];
$password		= $_POST['password'];
$repassword		= $_POST['repassword'];
$hakakses		= $_POST['hakakses'];
$kodereg		= "VN-";
$kodeidreg		=$kodereg.$id;

	// cek apakah email sudah terdaftar
	$cekemail = "SELECT email FROM uservoice WHERE email='$email'";
	$findemail = mysql_query($cekemail);
	
	// cek apakah username sudah terdaftar
	$cekusername = "SELECT email FROM uservoice WHERE username='$username'";
	$findusername = mysql_query($cekusername);

	if ($cekemail && mysql_num_rows($cekemail) > 0) {
		echo "<script>alert('Email Sudah Terdaftar');window.location = 'adminvoicenote.php'</script>";
	}else
	if ($findusername && mysql_num_rows($findusername) > 0) {
		echo "<script>alert('Username Sudah Terdaftar');window.location = 'adminvoicenote.php'</script>";
	}else
	if($repassword!=$password){
		echo "<script>alert('Password tidak Sesuai');window.location = 'adminvoicenote.php'</script>";
	}else{	
		// Proses simpan Data ke Database
		$query=("INSERT INTO uservoice SET	reg='$kodeidreg',
											departement='$departement',
											email='$email',
											username='$username',
											password='$password',
											hakakses='$hakakses'");
		$sql = mysql_query($query);
			if($sql){
				echo "<script>alert('User Berhasil ditambahkan');window.location = 'adminvoicenote.php'</script>";
			}else{
				echo "<script>alert('Koneksi ke Database Gagal');window.location = 'adminvoicenote.php'</script>";
			}
		}
?>