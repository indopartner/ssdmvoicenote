<?php
// Membuat tombol Logout.
// Dan yang terakhir adalah membuat file logout.php
// untuk menghapus session yang telah digunakan, isi dengan kode dibawah.
session_start(); // memulai session
session_destroy(); // menghapus session
header('location:loginvoicenote.php'); // mengambalikan ke form_login.php

?>
