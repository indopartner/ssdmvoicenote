<?php
session_start();
include 'connection.php';
//--------------------------------------
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
	$link="#";
}else{
	$link="adminvoicenote.php";
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
								<li><a href="<?php echo $link;?>" style="text-decoration:none; color: gray;">Administrator</a></li> 
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
			<!-- Form Login -->
			<form action="proseschangepasswordvoicenote.php" method="POST" enctype="multipart/form-data">
				<table class="FORM" border="0" style="margin-top:60px;">
					<tr>
						<td height="10" align="center" style="font-size:23px; font-family:Tahoma;">Change Password</td>
					</tr>
					<tr>
						<td height="10" align="center"><hr></td>
					</tr>
					<tr>
						<td height="35" width="80%" align="center">
						<input type="hidden" name="idreg" value="<?php echo $reg;?>"/>
						<input type="hidden" name="mypassword" value="<?php echo $password;?>"/>
						<input type="text" style="height:40px; width:370px;" name="username" id="username" value="<?php echo $terlogin;?>" maxlength="40" placeholder="Username" readonly />
						</td>
					</tr>
					<tr>
						<td height="35" align="center">
						<input type="password" style="height:40px; width:370px;" name="currentpassword" id="currentpassword" maxlength="30" placeholder="Current Password" required=""/>
						</td>
					</tr>
					<tr>
						<td height="35" align="center">
						<input type="password" style="height:40px; width:370px;" name="newpassword" id="newpassword" maxlength="30" placeholder="New Password" required=""/>
						</td>
					</tr>
					<tr>
						<td height="35" align="center">
						<input type="password" style="height:40px; width:370px;" name="confirmnewpassword" id="confirmnewpassword" maxlength="30" size="40" placeholder="Confirm New Password" required=""/>
						</td>
					</tr>
						<td height="80" colspan="2" align="center" style="vertical-align:middle;">
							<button class="btn" type="submit">Update</button>
						</td>
				</table>
			</form>
			<br>
			<!-- End Form Open Account -->
		</div>
	</div>
</body>

</html>
