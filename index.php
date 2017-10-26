<?php
session_start();
include 'connection.php';
if (empty($_SESSION['username'])) {
header('location:loginvoicenote.php');
}else{
	header('location:SSDMVoiceNote.php');
}

?>
