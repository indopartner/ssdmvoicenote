<?php
session_start();
include 'connection.php';
if (empty($_SESSION['username'])) {
header('location:loginvoicenote.php'); // jika belum login, maka dikembalikan ke index.php
}else{
	$terlogin = $_SESSION['username'];
}
$sql_user = mysql_query("SELECT * FROM uservoice WHERE username = '$terlogin'") or die (mysql_error());
$data_user = mysql_fetch_array($sql_user);
$reg=$data_user['reg'];
$departement=$data_user['departement']; 
$email=$data_user['email'];
$password=$data_user['password'];
$hakakses=$data_user['hakakses'];

if($hakakses!="Admin"){
	header('location:loginvoicenote.php'); 
}
?>
<html lang="en">
<head>
	<!-- Meta Data -->
	<!-- ================================================================================== -->
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />  
	<meta charset="UTF-8">
	<meta content="width=1040, user-scalable=yes" name="viewport">
	<meta content="Simply click the mic and start dictating text." name="description"/>  
	<title>SSDM Asesor Voice Note</title>
	<link href="images/icon.ico" rel="icon" type="image/x-icon">
    <!-- CSS Code -->
	<!-- ================================================================================== -->
	<!-- UTAMA -->
	<link rel="stylesheet" type="text/css" href="resources/myform.css"/>
	<link rel="stylesheet" type="text/css" href="resources/mybutton.css"/>
	<link rel="stylesheet" type="text/css" href="resources/style2.css">
	<!-- BUTTON -->
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/init.js"></script>


</head>
<body>
	<div id="wrapper" align="center">
		<div align="center" style="background:black; height:98px; border-bottom:2px solid red;">
			<table border="0" width="96%">
				<tr>
					<td align="center" height="90" width="90" rowspan="2"><a href="index.php"><img src="images/logosdmlogin.png" width="70" height="80"></a></td>
					<td height="50" style="font-family:Tahoma; font-size:30px; color:silver; vertical-align:bottom;">
					SSDM Asesor Voice Note
					</td style="vertical-align:middle;">
					<td align="center" height="90" width="90" rowspan="2">
						<button class="menuhead"><img alt="Preferences" id="preferences_img" src="images/menuicon.png" style="width:50px; height:50px;">
							  <ul class="dropdownmenu" id="select_menu">
								<li><a href="changepasswordvoicenote.php" style="text-decoration:none; color: gray;">Change Password</a></li> 
								<li><a href="logout.php" style="text-decoration:none; color: gray;">Logout</a></li> 
							  </ul>
						</button>
					</td>
				</tr>
				<tr>
					<td style="font-family:Tahoma; font-size:16px; color:gray; vertical-align:top;">
					Jl. Trunojoyo No.3 Kebayoran Baru, Jakarta Selatan (021) 7260001
					</td>
				</tr>
			</table>
		</div>
		<div id="fullcontent">
			<form action="prosesadduser.php" method="POST" enctype="multipart/form-data">
				<table width="100%" border="0">
					<tr>
						<td Height="10" colspan="2"><h2>ADD USER VOICE NOTE</h2></td>
					</tr>
					<tr>
						<td height="40" width="150" style="font-family:Tahoma;">Departement</td>
						<td height="40" style="font-family:Tahoma;">
						<input type="text" style="height:30px; width:370px;" name="departement" maxlength="50" required=""/></td>
					</tr>
					<tr>
						<td height="40" width="150" style="font-family:Tahoma;">Email</td>
						<td height="40" style="font-family:Tahoma;">
						<input type="text" style="height:30px; width:370px;" name="email" maxlength="50" required=""/></td>
					</tr>
					<tr>
						<td height="40" width="150" style="font-family:Tahoma;">Username</td>
						<td height="40" style="font-family:Tahoma;">
						<input type="text" style="height:30px; width:370px;" name="username" maxlength="50" required=""/></td>
					</tr>
					<tr>
						<td height="40" width="150" style="font-family:Tahoma;">Password</td>
						<td height="40" style="font-family:Tahoma;">
						<input type="password" style="height:30px; width:370px;" name="password" maxlength="50" required=""/></td>
					</tr>
					<tr>
						<td height="40" width="150" style="font-family:Tahoma;">Re-type Password</td>
						<td style="font-family:Tahoma;">
						<input type="password" style="height:30px; width:370px;" name="repassword" maxlength="50" required=""/></td>
					</tr>
					<tr>
						<td height="40" width="150" style="font-family:Tahoma;">Hak Akses</td>
						<td style="font-family:Tahoma;">
						<select style="height:30px; width:140px;" name="hakakses" required="">
							<option value="Admin">Admin</option>
							<option value="User" selected="selected">User</option>
						</select></td>
					</tr>
					<tr>
						<td Height="5" colspan="2"><hr color="orange" style=" border:1px solid;"> </td>
					</tr>
					<tr>
						<td height="50" align="left" style="vertical-align:middle;">
							<button class="btn" type="submit">Save</button>
						</td>
					</tr>
				</table>
			</form>
			<br>
		
			<!-- TABLE ACCOUNT-->
			<table width="100%" border="1" style="border-collapse:collapse;">
				<tr style="background:#303030; color:white; vertical-align:middle;">
					<td height="40" align="center" width="5%">No</td>
					<td height="40" align="center" width="10%">Reg</td>
					<td height="40" align="center" width="25%">Departemen</td>
					<td height="40" align="center" width="25%">Email</td>
					<td height="40" align="center" width="20%">Username</td>
					<td height="40" align="center" width="10%">Hak Akses</td>
					<td height="40" align="center" width="5%"></td>
				</tr>
				<?php
					$tbaccount = mysql_query("SELECT * FROM uservoice ORDER BY hakakses ASC") or die (mysql_error());
					$no = 1;
					while ($rstbaccount = mysql_fetch_array($tbaccount)) {
				?>
				<tr style="background:transparent; font-size:16px; color:black; vertical-align:middle;">
					<td height="25" align="center"><?php echo $no;?></td>
					<td height="25" align="center"><?php echo $rstbaccount['reg'];?></td>
					<td height="25" align="left"><?php echo $rstbaccount['departement'];?></td>
					<td height="25" align="left"><?php echo $rstbaccount['email'];?></td>
					<td height="25" align="left"><?php echo $rstbaccount['username'];?></td>
					<td height="25" align="left"><?php echo $rstbaccount['hakakses'];?></td>
					<td class="TOMBOLGAMBAR" height="25" align="center" style="vertiva-align:middle;">
						<a href="prosesdeleteuser.php?id=<?php echo $rstbaccount['reg'];?>" onclick="return confirm('ARE YOU SURE YOU WANT TO DELETE USERNAME <?php echo $rstbaccount['username'];?> ?')">
							<img src="images/delete.png" height="20" width="30" title="Delete <?php echo $rstbaccount['username'];?>" style="vertical-align:middle;">
						</a>
					</td>
				</tr>
				<?php
					$no++;
					}
				?>
			</table>
		</div>
	</div>
</body>

</html>
