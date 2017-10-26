<?php
// Panggil Koneksi ke Database.
include 'connection.php';

//Tangkap data dari Form Change Password
$id 				= $_POST['idreg'];
$mypassword	        = $_POST['mypassword'];
$currentpassword    = $_POST['currentpassword'];
$newpassword		= $_POST['newpassword'];
$confirmnewpassword	= $_POST['confirmnewpassword'];


if($currentpassword != $mypassword){
	echo '<script language="javascript">alert("Current Password Invalid"); document.location="changepasswordvoicenote.php";</script>';
}else
if($confirmnewpassword != $newpassword){
	echo '<script language="javascript">alert("Confirmation Password Invalid"); document.location="changepasswordvoicenote.php";</script>';
}else{
	$updatepassword = "update uservoice set password = '$newpassword' where reg = '$id'";
	$updatequery = mysql_query($updatepassword);
	if($updatequery){
		echo '<script language="javascript">alert("Change New Password Success,.."); document.location="SSDMVoiceNote.php";</script>';
	}else{
		echo '<script language="javascript">alert("Connection to Database Failed,.."); document.location="changepasswordvoicenote.php";</script>';
	}
}
?>