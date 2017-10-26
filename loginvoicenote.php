<?php
session_start();
include 'connection.php';
//error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
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
	
	<!-- BUTTON -->
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/init.js"></script>


</head>
<body>
	<div id="wrapper" align="center">
		<div id="fullcontent">
			<!-- Form Login -->
			<form action="prosesloginvoicenote.php" method="POST" enctype="multipart/form-data">
				<table class="FORM" border="0" style="margin-top:60px;">
					<tr>
						<td height="100" align="center">
							<img src="images/logosdmlogin.png" width="90" height="100">
						</td>
					</tr>
					<tr>
						<td height="10" align="center" style="font-size:23px; font-family:Tahoma;">SSDM Asesor Voice Note</td>
					</tr>
					<tr>
						<td height="10" align="center"><hr></td>
					</tr>
					<tr>
						<td height="30" align="center" style=" font-size: 16px;"><font color="black">Enter Username and Password to Log In :</font></td>
					</tr>
					<tr>
						<td height="35" width="80%" align="center">
						<input type="text" style="height:40px; width:370px;" name="username" id="username" maxlength="40" placeholder="Username" required=""/>
						</td>
					</tr>
					<tr>
						<td height="35" align="center">
						<input type="password" style="height:40px; width:370px;" name="password" id="password" maxlength="30" placeholder="Password" required=""/>
						</td>
					</tr>
						<td height="80" colspan="2" align="center" style="vertical-align:middle;">
							<button class="btn" type="submit">Login</button>
						</td>
				</table>
			</form>
			<br>
			<!-- End Form Open Account -->
		</div>
	</div>
</body>

</html>
