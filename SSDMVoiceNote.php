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
	$link="#";
}else{
	$link="adminvoicenote.php";
}

?>

<html class="no-js consumer" lang="en"> <!-- Page Specific -->
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  
<meta charset="UTF-8">
<meta content="width=1040, user-scalable=yes" name="viewport">
<meta content="Simply click the mic and start dictating text." name="description"/>  
<title>SSDM Asesor Voice Note</title>

<!-- fb metas -->
<meta property="og:title" content="SSDM Polri Voice Note" />
<meta property="og:site_name" content="SSDMVoiceNote"/>
<meta property="og:description" content="Simply click the mic and start dictating text." /> 



<script>
(function(e, p){
  var m = location.href.match(/platform=(win8|win|mac|linux|cros)/);
  e.id = (m && m[1]) ||
  (p.indexOf('Windows NT 6.2') > -1 ? 'win8' : p.indexOf('Windows') > -1 ? 'win' : p.indexOf('Mac') > -1 ? 'mac' : p.indexOf('CrOS') > -1 ? 'cros' : 'linux');
  e.className = e.className.replace(/\bno-js\b/,'js');
})(document.documentElement, window.navigator.userAgent)
</script>
<script src="js/jquery.min.js"></script>
<script src="js/jquery-ui.min.js"></script>

<link href="images/icon.ico" rel="icon" type="image/x-icon"> 
<link rel="stylesheet" type="text/css" href="resources/mybutton.css"/>
<link rel="stylesheet" type="text/css" href="resources/style2.css">  
<link id="stylesheet" rel="stylesheet" type="text/css">  

<script>
  const NEW_LINE = "\n"; //String.fromCharCode(13, 10);

  function changeStyle(){
    if (localStorage.getItem("style")==="full") {
    	localStorage.setItem("style","default");
    	document.getElementById('stylesheet').href='resources/style2.css';
    	view_option.innerHTML='Full Screen View';
      $('#change_view_button').attr('title','Full Screen View');
      $('#change_view_img').attr("src", 'images/largeView.png');
    	$(document).off('keyup');
    } else {
    	localStorage.setItem("style","full");
      document.getElementById('stylesheet').href='resources/style2.css';
      view_option.innerHTML='Back to Regular View';
      $('#change_view_button').attr('title','Back to Regular View');
      $('#change_view_img').attr("src", 'images/regularView.png');      
    	  $('.activityContainer').keypress(keypressHandler);
    	$(document).keyup(function(e) {
    		 if (e.keyCode == 27) { changeStyle(); }   // esc
    	});    	  
    }
  }

if (localStorage.getItem("style")==="full") {
	document.getElementById('stylesheet').href='resources/style2.css';
} else document.getElementById('stylesheet').href='resources/style2.css';

var local_language = window.navigator.userLanguage || window.navigator.language;

if (localStorage.getItem("sessionsList")===null) { localStorage.setItem("sessionsList","");}
if (localStorage.getItem("uniqueID")===null) { localStorage.setItem("uniqueID",renderUniqueID()); console.log("uniqueID = " + localStorage.getItem("uniqueID"));}
if (localStorage.getItem("everPaid")===null) { localStorage.setItem("everPaid","false");}
if (localStorage.getItem("currentCredit")===null) { localStorage.setItem("currentCredit","0");}

function renderUniqueID() {
  var text = "";
  var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
  for( var i=0; i < 10; i++ )
    text += possible.charAt(Math.floor(Math.random() * possible.length));
  return text;
}

function purchase(dollars) {
  var jwtStr, credits;
  switch(dollars) {
  case 0.25:
	  jwtStr = "eyJhbGciOiJIUzI1NiJ9.eyJpc3MiOiIxMzAwOTY2MzE5NDcwN" + 
      "jg5OTAxMiIsImF1ZCI6Ikdvb2dsZSIsInR5cCI6Imdvb2dsZS9" + 
      "wYXltZW50cy9pbmFwcC9pdGVtL3YxIiwiaWF0IjoxNDEwODU0N" + 
      "Tc2LCJleHAiOjE1MTA5NDA4NTUsInJlcXVlc3QiOnsiY3VycmV" + 
      "uY3lDb2RlIjoiVVNEIiwicHJpY2UiOiIwLjI1IiwibmFtZSI6I" + 
      "lNwZWVjaGxvZ2dlciBDcmVkaXQiLCJzZWxsZXJEYXRhIjoic3B" + 
      "lZWNobG9nZ2VyLmFwcHNwb3QuY29tIiwiZGVzY3JpcHRpb24iO" + 
      "iIxLDAwMCBDaGFyYWN0ZXJzIHRvIHRyYW5zbGF0ZSJ9fQ.BPh3" + 
      "3cGv7Qsz4mVaD0lGq8Pgyko0bj3q_zJj6HbeOc8";
	  credits = 1000;
    break;
  case 1:
	  jwtStr = "eyJhbGciOiJIUzI1NiJ9.eyJpc3MiOiIxMzAwOTY2MzE5NDcwN" + 
      "jg5OTAxMiIsImF1ZCI6Ikdvb2dsZSIsInR5cCI6Imdvb2dsZS9" + 
      "wYXltZW50cy9pbmFwcC9pdGVtL3YxIiwiaWF0IjoxNDEwODU0N" + 
      "zIxLCJleHAiOjE1MTA5NDEwNTUsInJlcXVlc3QiOnsiY3VycmV" + 
      "uY3lDb2RlIjoiVVNEIiwicHJpY2UiOiIxIiwibmFtZSI6IlNwZ" + 
      "WVjaGxvZ2dlciBDcmVkaXQiLCJzZWxsZXJEYXRhIjoic3BlZWN" + 
      "obG9nZ2VyLmFwcHNwb3QuY29tIiwiZGVzY3JpcHRpb24iOiIxM" + 
      "CwwMDAgQ2hhcmFjdGVycyB0byB0cmFuc2xhdGUifX0.ln5-fwi" + 
      "1Cmap-eHt0nuiq7uhxVjjfCtGSYbmFZqQOOI";
	  credits = 10000;
	  break;
  case 2:
	  jwtStr = "eyJhbGciOiJIUzI1NiJ9.eyJpc3MiOiIxMzAwOTY2MzE5NDcwN" + 
      "jg5OTAxMiIsImF1ZCI6Ikdvb2dsZSIsInR5cCI6Imdvb2dsZS9" + 
      "wYXltZW50cy9pbmFwcC9pdGVtL3YxIiwiaWF0IjoxNDEwODU0N" + 
      "zcwLCJleHAiOjE1MTA5NDExNjAsInJlcXVlc3QiOnsiY3VycmV" + 
      "uY3lDb2RlIjoiVVNEIiwicHJpY2UiOiIyIiwibmFtZSI6IlNwZ" + 
      "WVjaGxvZ2dlciBDcmVkaXQiLCJzZWxsZXJEYXRhIjoic3BlZWN" + 
      "obG9nZ2VyLmFwcHNwb3QuY29tIiwiZGVzY3JpcHRpb24iOiI0M" + 
      "CwwMDAgQ2hhcmFjdGVycyB0byB0cmFuc2xhdGUifX0.IzMruPB" + 
      "kCz-kzn9ssk8vxGicade9BOZoFTTLcgaZK0Q";
    credits = 40000;
    break;
  }
	google.payments.inapp.buy({
	  jwt: jwtStr,
	  success: function() { credit(credits); },
	  failure: function() { window.alert('Purchase failed. No transaction made.')}
	});
}


//Global parameters...
mainURL=encodeURIComponent('../SSDMVoiceNote/SSDMVoiceNote.php');

//Drive API stuff:
      var CLIENT_ID = '573099443934-8sg0o0rbho9ngvrepprqr27e8nc5e0p5.apps.googleusercontent.com';
      var SCOPES = 'https://www.googleapis.com/auth/drive';
      var TRIED_TO_AUTHORIZE_DRIVE = false;

      /**
       * Called when the client library is loaded to start the auth flow.
       */
      function handleClientLoad() {
        window.setTimeout(checkAuth, 1);
      }

      /**
       * Check if the current user has authorized the application.
       */
      function checkAuth() {
        gapi.auth.authorize(
            {'client_id': CLIENT_ID, 'scope': SCOPES, 'immediate': true},
            handleAuthResult);
      }
      
      function checkAuth2() {
          gapi.auth.authorize(
              {'client_id': CLIENT_ID, 'scope': SCOPES, 'immediate': false},
              handleAuthResult);
      }

      /**
       * Called when authorization server replies.
       *
       * @param {Object} authResult Authorization result.
       */
      function handleAuthResult(authResult) {
        if ((TRIED_TO_AUTHORIZE_DRIVE && authResult) && !authResult.error) {
          // Not the first load in
        	// Access token has been successfully retrieved, requests can be sent to the API.
          var fileNameToSaveAs = session_title.innerText+".txt";
          var body= "";
          if (speaker.value!=="") { body += 'Notes: ' + speaker.value + '\n_________________\n';}
          body += 'Transcript:\n_________________\n' + final_span.innerText;
          if (final_translation.innerHTML.length>1) {body+='\nTranslation\n_________________\n'+final_translation.innerText;}
          body+='\n' + 'SSDMVoiceNote';
          uploadFile(fileNameToSaveAs,body);
        } else {
          // No access token could be retrieved, show the button to start the authorization flow.
        	if (TRIED_TO_AUTHORIZE_DRIVE) //i.e. auth was user triggered - give him error feedback 
        		toastNotification("Oops, it seems like something went wrong...");
        }
        TRIED_TO_AUTHORIZE_DRIVE = true;
      }

      /**
       * Start the file upload.
       *
       * @param {Object} evt Arguments from the file selector.
       */
      function uploadFile(fileName, fileData) {
        gapi.client.load('drive', 'v2', function() {
          insertFile(fileName, fileData);
        });
      }

      /**
       * Insert new file to Drive
       *
       * @param {String} fileData String to read data from.
       * @param {Function} callback Function to call when the request is complete.
       */
      function insertFile(fileName, fileData, callback) {
        const boundary = '-------314159265358979323846';
        const delimiter = "\r\n--" + boundary + "\r\n";
        const close_delim = "\r\n--" + boundary + "--";

        var contentType = 'text/html';
        var metadata = {
            'title': fileName,
            'mimeType': contentType
          };

          //var base64Data = btoa(fileData);
          var base64Data = fileData;
          var multipartRequestBody =
              delimiter +
              'Content-Type: application/json\r\n\r\n' +
              JSON.stringify(metadata) +
              delimiter +
              'Content-Type: ' + contentType + '\r\n' +
              //'Content-Transfer-Encoding: base64\r\n' +
              '\r\n' +
              base64Data +
              close_delim;

          var request = gapi.client.request({
              'path': '/upload/drive/v2/files',
              'method': 'POST',
              'params': {'uploadType': 'multipart'},
              'headers': {
                'Content-Type': 'multipart/mixed; boundary="' + boundary + '"'
              },
              'body': multipartRequestBody});
          if (!callback) {
            callback = function(fileName) {
              console.log(fileName)
              toastNotification("OK");
            };
          }
          request.execute(callback);
      }
</script>
<!-- <script type="text/javascript" src="https://apis.google.com/js/client.js?onload=handleClientLoad"></script> -->
  <title>SSDM Asesor Voice Note</title>
  <meta content="FREE. Accurate. Fun. No installation, no registration. Simply click the mic and start dictating text. Features auto save, auto punctuation, instant translation & more." name="description"/>
  <link rel="canonical" href="../SSDMVoiceNote/en/" />
  <meta name="google-translate-customization" content="6d9589dcc31b9e80-31d4b56986c25c3b-g0aa6e60c6db882bb-1c"></meta>

</head>
<body>

	<script>
  var mydept="<?php echo $departement;?>";
  var monthNames = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ];
  var newDate = new Date();
  var sessionTitle="";
  if (localStorage.getItem("sessionIndex")===null) { 
    localStorage.sessionIndex="1";
    sessionTitle="Welcome! ";
  }
  sessionTitle+="Dept. "+mydept+" #";  
  
  var timeDisplay_list = 
    [['None', 'none'],
    ['Time from Start', 'dif'],
    ['Real Time', 'real']];       
   
  //Language-specific parameters
  var interfaceLang="en";
  var defaultTrans="es";
  </script>

	<div align="center" style="background:black; height:98px; border-bottom:2px solid red;">
		<table border="0" width="96%">
			<tr>
				<td align="center" height="90" width="90" rowspan="2"><img src="images/logosdmlogin.png" width="70" height="80"></td>
				<td height="50" style="font-family:Tahoma; font-size:30px; color:silver; vertical-align:bottom;">
				SSDM Polri Voice Note
				</td style="vertical-align:middle;">
				<td align="center" height="90" width="90" rowspan="2">
					<button class="menuhead"><img alt="Preferences" id="preferences_img" src="images/menuicon.png" style="width:50px; height:50px;">
						  <ul class="dropdownmenu" id="select_menu">
							<li><input type="checkbox" id="save_checkbox"><label for="save_checkbox" id="lbl_save_checkbox">Auto Save</label></li>
							<li><input type="checkbox" id="uncertain_checkbox"><label for="uncertain_checkbox" id="lbl_uncertain_checkbox">Red font for results Speechlogger is unsure about.</label></li>
							<!-- <li id="lbl_translate_key" onclick="$('#translation_key_activity').fadeIn(500);bindEsc();">Translation Credit</li> --> 
							<li style="display:none;"><input type="checkbox" id="read_checkbox"><label for="read_checkbox" id="lbl_read_checkbox">Read-Out Translated</label></li>
							<li><label id="lbl_timeDisplay">Time-labels:</label> &nbsp; <select id="select_timeDisplay" onchange="updateTime()"></select></li>
							<li><a href="<?php echo $link;?>" style="text-decoration:none; color: gray;">Administrator</a></li>
							<li><a href="changepasswordvoicenote.php" style="text-decoration:none; color: gray;">Change Password</a></li> 
							<li><a href="logout.php" style="text-decoration:none; color: gray;">Logout</a></li> 
							<script>  
							  for (var i = 0; i < timeDisplay_list.length; i++) {
								select_timeDisplay.options[i] = new Option(timeDisplay_list[i][0], timeDisplay_list[i][1]); // (text,value)
							  }
							</script>
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
	<div id="notification"></div>
	<table width="100%" border="0" height="40">
		<tr>
			<td>
				<div id="session_title" contenteditable="true"></div>
			</td>
			<td width="250">
				<select style="font-size:16px; font-weight:bold; width:90%; height:30px; margin:10px;" id="select_language" onchange="updateLanguage();"></select>
			</td>
		</tr>
	</table>
	
	<input type="hidden" id="speaker" placeholder="Add context here (such as speaker's name). The title above is editable too. ">
	
	<div id="application">
		<!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
		<div class="activityContainer" id="alert_container">
			<div class="alertNotification">
				<div class="activityTitle" id="alert_title"></div>
				<div class="activityInfo" id="info"></div>
				<div class="closeButton" onclick="$('.activityContainer').hide();unbindEsc();"></div>
				<div class="OkButton"></div>
			</div>
		</div>
        
		<div class="activityContainer" id="punctuation_activity">
			<div class="alertNotification">
				<div class="activityTitle" id="punct_act_title">Automatic Punctuation Settings</div>
				<div class="activityContent">
					<div>
						<span class="activityInfo" id="punct_act_info1">When automatic punctuation is on, Speechlogger will end sentences in </span>
						<span class="activityInfo" id="punct_act_language"></span>
						<span class="activityInfo" id="punct_act_info2">with a   </span>
						<select id="punctuation_mark" onchange="updateTagList('start');updateTagList('end');updateTagList('any');">
							<option value="question">?</option>
							<option value="exclamation">!</option>
							<option value="colon">:</option>
						</select>
						<span class="activityInfo" id="punct_act_info3">mark when:</span>
					</div>
					<div class="activityInfo" id="punct_act_begins_with">The sentences start with one of the following sequences:</div>
					<div class="tagsDisplay" id="display_start_tags"></div>
					<div class="editTags">
						<input id="user_input_tags_start" type="text" placeholder="Input your sequences and ADD."> <!-- TODO important!!!: value="..{fn:escapeXml(guestbookName)}" -->
						<button class="OkButton" onclick="addPunctSequences(user_input_tags_start.value,punctuation_mark.value,'start');"><b>ADD</b></button>
					</div>
					<div class="activityInfo" id="punct_act_ends_with">Or, when they end with one of the following:</div>
					<div class="tagsDisplay" id="display_end_tags"></div>
					<div class="editTags">
						<input id="user_input_tags_end" type="text" placeholder="Input your sequences and ADD."> <!-- TODO important!!!: value="..{fn:escapeXml(guestbookName)}" -->
						<button class="OkButton" onclick="addPunctSequences(user_input_tags_end.value,punctuation_mark.value,'end');"> <b>ADD</b> </button> 
					</div>
					<div class="activityInfo" id="punct_act_contains">Or, when they contain one of the following sequences:</div>
					<div class="tagsDisplay" id="display_any_tags"></div>
					<div class="editTags">
						<input id="user_input_tags_any" type="text" placeholder="Input your sequences and ADD.">  <!-- TODO important!!!: value="..{fn:escapeXml(guestbookName)}" -->
						<button class="OkButton" onclick="addPunctSequences(user_input_tags_any.value,punctuation_mark.value,'any');"> <b>ADD</b> </button>
					</div>
					<div>
						<span class="activityInfo" id="punct_act_info4">In all other cases, the sentence will end with a period.</span>
					</div>
					<div class="OkButton"></div>
				</div>
				<div class="closeButton" onclick="$('.activityContainer').hide();unbindEsc();"></div>
			</div>
		</div>

		<!-- ** NEW ** TODO: activate + Change + multilingual titles for buttons -->     
		<div class="activityContainer" id="translation_key_activity">
			<div class="alertNotification">
			<div class="activityTitle" id="translation_key_title">Translation</div>
			<div class="activityInfo" id="translation_key_info1">Current :     &nbsp<span id="credit_show2"></span></div>
			<div>
			</div>
			<div class="closeButton" onclick="$('.activityContainer').hide();unbindEsc();"></div>
			</div>
		</div> 
		
		<!-- <button id="change_view_button" onclick="changeStyle();"><img alt="Preferences" id="change_view_img" src="images/largeView.png"></button>
	
	
	
		<!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
		<table width="100%" border="0" style="
		background:gray;
		background: -moz-linear-gradient(gray, silver, gray);
		background: -o-linear-gradient(gray, silver, gray);
		background: -webkit-linear-gradient(gray, silver, gray);
		">
			<tr>
				<td width="60%" height="90">
				<script>var QUATATION = '"';</script>
					<div id="punctuationBar">
						<p style="text-align:center;">Klik tanda baca berikut, untuk ditambahkan ke hasil Pendiktean</p>
						<div class="punctuationButton" onclick="insertSymbol('.')" title="Click to insert" id="cell_period">.</div>
						<div class="punctuationButton" onclick="insertSymbol(',')" title="Click to insert" id="cell_comma">,</div>
						<div class="punctuationButton" onclick="insertSymbol('?')" title="Click to insert" id="cell_question">?</div>
						<div class="punctuationButton" onclick="insertSymbol(':')" title="Click to insert" id="cell_colon">:</div>
						<div class="punctuationButton" onclick="insertSymbol(';')" title="Click to insert" id="cell_semi">;</div>
						<div class="punctuationButton" onclick="insertSymbol('!')" title="Click to insert" id="cell_exclamation">!</div>
						<div class="punctuationButton" onclick="insertSymbol(QUATATION)" title="Click to insert" id="cell_quotation">&quot;</div>
						<div class="punctuationButton" onclick="insertSymbol('-')" title="Click to insert" id="cell_dash">-</div>
						<div class="punctuationButton" onclick="insertSymbol(NEW_LINE)" title="Click to insert" id="cell_line">&crarr;</div>
						<div class="punctuationButton" onclick="insertSymbol(NEW_LINE+NEW_LINE)" title="Click to insert" id="cell_paragraph">&crarr;&crarr;</div>
						<div class="punctuationButton" onclick="insertSymbol('(')" title="Click to insert" id="cell_open">(</div>
						<div class="punctuationButton" onclick="insertSymbol(')')" title="Click to insert" id="cell_close">)</div>
						<div class="punctuationButton" onclick="insertSymbol(':-)')" title="Click to insert" id="cell_smiley" style="font-size: 2em;vertical-align: top;">&#9786;</div>
						<div class="punctuationButton" onclick="insertSymbol(':-(')" title="Click to insert" id="cell_sad">&#9785;</div>
					</div> 
				</td>
				<td width="30%" align="center">
					<div id="right_buttons">
						<button onclick="selectContent('results');" title="Select All"><img alt="Select All" src="images/select_all.png"></button>
						<button id="enlarge_button" onclick="zoom(1.25);" title="Zoom In Text        "><img alt="Enlarge" id="enlarge_img" src="images/Zoom-In.png" style="width:50px; height:50px;"></button>  
						<button id="shrink_button" onclick="zoom(0.8);" title="Zoom Out Text"><img alt="shrink" id="shrink_img" src="images/Zoom-Out.png" style="width:50px; height:50px;"></button>
						<button id="new_button" onclick="newButton(event);" title="New Session"><img alt="New" id="new_img" src="images/NewSession.png" style="width:50px; height:50px;"></button>
						<button  class="menuhead" id="export_button"><img alt="Export" id="export_img" src="images/Upload-File.png" style="width:50px; height:50px;">
						  <ul class="dropdownmenu" id="export_menu">  
							<li><div class="exportOption" id="save_txt" onclick="saveAsTxtFile();">Export to Text (.txt)</div></li> <!--N2H: WORD, PRINT, with/wo time labels... -->
							<li><div class="exportOption" id="save_doc" onclick="saveAsDocFile();">Word Document (.doc)</div></li>
							<li><div class="exportOption" id="save_srt" onclick="saveAsSrtFile();">Export to Captions (.srt)</div></li> 
							<li><div class="exportOption" id="save_to_disc" onclick="saveButton(event);">Save to Local Disk</div></li>
							<li><div class="exportOption" id="export2google_translate" onclick="export2googleTranslate();">Export to Google Translate      </div></li>
						  </ul>
						</button>
						<button  class="menuhead" id="open_button"><img alt="Open" id="open_img" src="images/Open-File.png" style="width:50px; height:50px;">
							<ul class="dropdownmenu" id="select_session">
								<li>
									<a id="open_file" onclick="openFile();">Open file from disk</a>
									<input type="file" id="selected_file">
									<output id="list" style="visibility: hidden"></output>
								</li>
								<div id="sessions_menu"></div>
							</ul>
							<script>
								var sessionsList=localStorage.getItem("sessionsList").split(",");
								var shownTitle="";
								var maxChars=25;      
								sessionsDropdown();
								function sessionsDropdown(){ 
								  sessions_menu.innerHTML='';
								  sessionsList=localStorage.getItem("sessionsList").split(",");
								  for (var i = sessionsList.length-2; i>=0 ; i--) {
									  shownTitle=localStorage.getItem("session_title_"+sessionsList[i]);
									  if (shownTitle.length>maxChars) { shownTitle=shownTitle.substring(0,maxChars)+'...'; }
									  sessions_menu.innerHTML+='<li><div class="sessionOption" onclick="loadSession('+sessionsList[i]+')">'+shownTitle+'</div><div class="smallTrash optionIcon" onclick="deleteSession('+sessionsList[i]+');"><img alt="Delete" src="images/trash.png"></div></li>';
								  }
								}
							</script>    
						</button>
					</div>
				</td>
				<td align="center" width="10%">
					<div id="start_button" onclick="if(variables.recognizing){isToRestartImmediately=false;variables.intentionalPause=true;}startButton(event);" title="Start / Pause"><img alt="Start" id="start_img" src="images/Mic-A.png"></div>
				</td>
			</tr>
		</table>
		
		
 
 
 
 
    
  
    
      
    

        

		<div id="preferences_line" style="background: #e0e3ec url(images/pattern.png) repeat top left;">
		  <div id="left_buttons">
			<div id="translate_options" style="display:none;"> 
			  <select id="translate_lang" onchange="updateTranslateLang();"></select>
			  <script>
			  var trans_langs = 'Afrikaans af Albanian sq Arabic ar Azerbaijani az Basque eu Bengali bn Belarusian be Bulgarian bg Catalan ca Chinese-Simplified zh-CN Chinese-Traditional zh-TW Croatian hr Czech cs Danish da Dutch nl English en Esperanto eo Estonian et Filipino tl Finnish fi French fr Galician gl Georgian ka German de Greek el Gujarati gu Haitian-Creole ht Hebrew iw Hindi hi Hungarian hu Icelandic is Bahasa-Indonesia id Irish ga Italian it Japanese ja Kannada kn Korean ko Latin la Latvian lv Lithuanian lt Macedonian mk Malay ms Maltese mt Norwegian no Persian fa Polish pl Portuguese pt Romanian ro Russian ru Serbian sr Slovak sk Slovenian sl Spanish es Swahili sw Swedish sv Tamil ta Telugu te Thai th Turkish tr Ukrainian uk Urdu ur Vietnamese vi Welsh cy Yiddish yi'.split(" ");
			  for (var i = 0; i < trans_langs.length/2; i++) {
				  translate_lang.options[i] = new Option(trans_langs[i*2], trans_langs[i*2+1]); // (text,value)
				  }
			  </script>
			</div>
		  </div>
		</div>
		<div id="output_box" style="background: #e0e3ec url(images/pattern.png) repeat top left;">
			<div id="boxes_container">
				<div class="box widebox" id="results_box">
					<!-- <button class="select_results_button" onclick="selectContent('results');"><img alt="Select All" src="images/select_all.png"></button> -->         
				</div>
				<div class="box rightbox narrowbox" id="translations_box" style="display:none">
					<button class="select_results_button" onclick="selectContent('translations');"><img alt="Select All" src="images/select_all.png"></button>
					<button class="readOut_button" onclick="toggleRead();"><img alt="Select All" id="speak_button_img" src="images/speak_on_48x48.png"></button>
					<a id="google_translate_attribution" href="http://translate.google.com" target="_blank"></a> <!-- TODO: icon,...google rules...  -->
					<div id="credit_panel"><span>Credit: </span><span id="credit_show"></span>&nbsp<button id="refill" onclick='$("#translation_key_activity").fadeIn(500);'>Refill</button></div> 
				</div>
			</div>
			<div id="output_panel">
				<div class="resultsClass widebox" id="results">
					<span class="final" id="final_span"></span> <span class="interim" id="interim_span"></span>
				</div>
				<div class="resultsClass rightbox narrowbox" id="translations" style="display:none">
					<span class="final" id="final_translation"></span>
				</div>
			</div>
		</div>
		<!--
		<p style="font-weight:100;font-size: 90%;display:block; width:100%;position:absolute;bottom:-7px;text-align:center">TIP: Press "Enter"</b>&nbsp;&crarr;&nbsp;<b>to finalize speech results while dictating</p>  
		-->
	</div>

	<div style="display:none" id="temporary_html"></div>

	<script>
		function updateTagList(position){
		  $("#user_input_tags_"+position).val("");
		  var tempStr="";
		  var tempMark=punctMarks[punctuation_mark.value];
		  var tempArray=tempMark[position]; //this array contains the sequences we need to display
		  for (var i=0; i<tempArray.length;i++){
			tempStr+='<div class="inlineTag"><p>'+tempArray[i]+'</p><span class="inlinetrash" onclick="removePunctSequence(punctMarks[punctuation_mark.value]['+"'"+position+"']["+i+"],'"+punctuation_mark.value+"','"+position+"'"+');">x</span></div>';//TODO: replace "R" with trash image. 
		  }
		  $("#display_"+position+"_tags").html(tempStr);
		}
	</script>

	<script>
	  function keypressHandler(e) {
		if(e.which == 13) {  //If 'Enter' pressed
		  $('.OkButton').focus().click(); 
		}
	  }
	  $('.activityContainer').keypress(keypressHandler);
	</script>

	<script> //Assign strings (from the index file) to the HTML layout
	  session_title.innerHTML=sessionTitle + localStorage.sessionIndex + ", " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + ' ' + newDate.getFullYear(); 
	  if (localStorage.getItem("style")==="full") {
		  view_option.innerHTML='Back to Regular View';
		  $('#change_view_button').attr('title','Back to Regular View');           
	   } else {
		  view_option.innerHTML='Full Screen View';
		  $('#change_view_button').attr('title','Full Screen View');      
	   }
	</script>

	<div id="refer_box">
	  <div class="x-button" id="refer_box_closeButton" onclick="$('#refer_box').hide();"></div>
	  <p>SSDM Voice Note Team</p>
	</div>

	<script>
	  if ((localStorage.getItem("sessionIndex")=="5" || localStorage.getItem("sessionIndex")=="15") || localStorage.getItem("sessionIndex")=="55" ) 
		  $( "#refer_box" ).delay(60000).slideDown(300);
	</script>
	<!-- Go to www.addthis.com/dashboard to customize your tools -->
	<script type="text/javascript" src="js/addthis_widget.js#pubid=ra-4fe89bcc181f95ed"></script>

	<script>
		const MSG_SIGNATURE = 'SSDMVoiceNote';
		const MSG_SAVED = "Session saved on your browser and sent to be saved on disk. <br><br>To load, go to the open button. <br><br>You don't need to bother saving if Auto-Save is checked, unless you want it saved on disk outside of your browser.";
		const MSG_URLTOOLONG = "We're sorry, but the text was too long for your browser to automatically export, so we had to cut off the last part.<br>If you need the whole text, please copy and paste it in manually.";
		const MSG_UPGRADE = "Web Speech API is not supported by this browser. Upgrade to <a href='//www.google.com/chrome'>Chrome</a> version 25 or later.";
		const MSG_NOAVAILABLESPACE = "We were unable to save since you ran out of storage space in your browser. <br>You can clear space by deleting older sessions saved in your browser, or uncheck 'Auto Save'.";
		const MSG_DEFAULT_NOTE_TITLE = "Please note...";

		function generateTranscriptionCommands(g){g=g.split("-")[0];var b;var e;var d;var f;var h;var a=[":-)",":-)",":-(",".",",","?",":",";","!","-",NEW_LINE,"(",")"];switch(g){case ("de"):b=["not_implemented"];e=[" punkt"," komma"," fragezeichen"," doppelpunkt"," semikolon"," semikolon"," semikolon"," ausrufezeichen"," ausrufezeichen"," neue zeile"," neuer absatz"," klammer öffnen"," klammer schließen"," bindestrich"];d=["smiley","trauriges gesicht","Bindestrich "];f=[".",",","?",":",";",";",";","!","!",NEW_LINE,NEW_LINE+NEW_LINE,"(",")","-"];h=[":-)",":-(","- "];this.period="Punkt";this.comma="Komma";this.question="Fragezeichen";this.colon="Doppelpunkt";this.semi="Semikolon";this.exclamation="Ausrufezeichen";this.dash="Bindestrich";this.line="Neue Zeile";this.paragraph="Neuer Absatz";this.open="Klammer öffnen";this.close="Klammer schließen";this.smiley="Smiley";this.sad="Trauriges Gesicht";break;case ("es"):b=["not_implemented"];e=[" coma"," signo de interrogación"," dos puntos"," 2 puntos"," punto y coma"," punto y,"," punto y ,",". y coma",". y,",". y ,"," punto"," signo de exclamación"," exclamación"," nueva línea"," nuevo apartado"," abrir paréntesis"," cerrar paréntesis"," guión"];d=["cara sonriente","cara triste","guión "];f=[",","?",":",":",";",";",";",";",";",";",".","!","!",NEW_LINE,NEW_LINE+NEW_LINE,"(",")","-"];h=[":-)",":-(","- "];this.period="Punto";this.comma="Coma";this.question="Signo de interrogación";this.colon="Dos puntos";this.semi="Punto y coma";this.exclamation="Signo de exclamación, Exclamación";this.dash="Guión";this.line="Nueva línea";this.paragraph="Nuevo apartado";this.open="Abrir paréntesis";this.close="Cerrar paréntesis";this.smiley="Cara sonriente";this.sad="Cara triste";break;case ("fr"):b=["not_implemented"];e=[" virgule"," point d'interrogation"," deux-points"," deux points"," 2 points"," point-virgule"," point virgule"," point ,"," point,"," point d'exclamation"," point"," nouvelle ligne"," nouveau paragraphe"," ouvrir la parenthèse"," fermer la parenthèse"," tiret"];d=["smiley","visage triste","tiret "];f=[",","?",":",":",":",";",";",";",";","!",".",NEW_LINE,NEW_LINE+NEW_LINE,"(",")","-"];h=[":-)",":-(","- "];this.period="Point";this.comma="Virgule";this.question="Point d'interrogation";this.colon="Deux-points";this.semi="Point-virgule";this.exclamation="Point d'exclamation";this.dash="Tiret";this.line="Nouvelle ligne";this.paragraph="Nouveau paragraphe";this.open="Ouvrir la parenthèse";this.close="Fermer la parenthèse";this.smiley="Smiley";this.sad="Visage triste";break;case ("it"):b=["not_implemented"];e=[" virgula"," punto interrogativo"," due punti"," 2 punti"," punto e virgola"," punto e,"," punto e ,"," esclamativo"," punto esclamativo"," punto"," nuova riga"," nuovo paragrafo"," apri parentesi"," chiudi parentesi"," trattino"];d=["smiley","faccina sorridente","faccina triste","trattino "];f=[",","?",":",":",";",";",";","!","!",".",NEW_LINE,NEW_LINE+NEW_LINE,"(",")","-"];h=[":-)",":-)",":-(","- "];this.period="Punto";this.comma="Virgola";this.question="Punto interrogativo";this.colon="Due punti";this.semi="Punto e virgula";this.exclamation="Esclamativo, Punto esclamativo";this.dash="Trattino";this.line="Nuova riga";this.paragraph="Nuovo paragrafo";this.open="Apri parentesi";this.close="Chiudi parentesi";this.smiley="Smiley, Faccina sorridente";this.sad="Faccina triste";break;case ("ru"):b=["not_implemented"];e=[" ???????"," ?????????????? ????"," ?????????"," ????? ? ???????"," ????? ?,"," ????? ? ,"," ?????"," ??????????????? ??????"," ??????????????? ????"," ????? ??????"," ????? ????????"," ????????????? ??????"," ????????????? ??????"," ????"];d=["???????","????????","???????? ????","???? "];f=[",","?",":",";",";",";",".","!","!",NEW_LINE,NEW_LINE+NEW_LINE,"(",")","-"];h=[":-)",":-)",":-(","- "];this.period="?????";this.comma="???????";this.question="?????????????? ????";this.colon="?????????";this.semi="????? ? ???????";this.exclamation="??????????????? ??????, ??????????????? ????";this.dash="????";this.line="????? ??????";this.paragraph="????? ????????";this.open="????????????? ??????";this.close="????????????? ??????";this.smiley="???????, ????????";this.sad="???????? ????";break;case ("ja"):b=["not_implemented"];e=[" ???? "," ??? "," ??? "," ??? "," ????? "," ??? ","?????"," ?? "," ????? "," ???? "," ????"," ???? "];d=[" ????? "," ???? "," ???? "];f=[". ",", ","? ",": ","; ","! ","! ",NEW_LINE,NEW_LINE+NEW_LINE," (",") ","-"];h=[" :-) "," :-( ","-"];this.period="????";this.comma="???";this.question="???";this.colon="???";this.semi="?????";this.exclamation="???, ?????";this.dash="????";this.line="??";this.paragraph="?????";this.open="????";this.close="????";this.smiley="?????";this.sad="????";break;case ("cmn"):b=["not_implemented"];e=[" ?? "," ?? "," ?? "," ?? "," ?? "," ??? "," ?? "," ??? "," ???? "," ????"," ??? "];d=[" ?? "," ???? "," ??? "];f=[". ",", ","? ",": ","; ","! ",NEW_LINE,NEW_LINE+NEW_LINE," (",") ","——"];h=[" :-) "," :-( ","——"];this.period="??";this.comma="??";this.question="??";this.colon="??";this.semi="??";this.exclamation="???";this.dash="???";this.line="??";this.paragraph="???";this.open="????";this.close="????";this.smiley="??";this.sad="????";break;case ("ar"):b=["not_implemented"];e=[" ???? "," ????? ??????"," ????? ???????"," ??????"," ?????"," ?? ??????"," ????? ????? "," ?? ????"," ???? ?????"," ???? ???????"," ???? ???????"," ??????"];d=["?????","??? ????","?????? "];f=[".",";","?",":",",","!","!",NEW_LINE,NEW_LINE+NEW_LINE,"(",")","-"];h=[":-)",":-(","- "];this.period="????";this.comma="?????";this.question="????? ???????";this.colon="??????";this.semi="????? ??????";this.exclamation="????? ????? ???? ??????";this.dash="??????";this.line="?? ????";this.paragraph="???? ?????";this.open="???? ???????";this.close="???? ???????";this.smiley="?????? ??? ?????";this.sad="??? ????";break;case ("pt"):b=["not_implemented"];e=[" interrogação"," dois pontos"," 2 pontos"," ponto e vírgula"," ponto e,"," ponto e ,"," ponto"," vírgula"," exclamação"," nova linha"," parágrafo"," abre parêntese"," fecha parêntese"," hífen"];f=["?",":",":",";",";",";",".",",","!",NEW_LINE,NEW_LINE+NEW_LINE,"(",")","-"];d=["smiley","rosto triste","hífen "];h=[":-)",":-(","- "];this.period="Ponto";this.comma="Vírgula";this.question="Interrogação";this.colon="Dois pontos";this.semi="Ponto e vírgula";this.exclamation="Exclamação";this.dash="Hífen";this.line="Nova linha";this.paragraph="Parágrafo";this.open="Abre parêntese";this.close="Fecha parêntese";this.smiley="Smiley";this.sad="Rosto triste";break;default:b=["not_implemented"];e=[" period"," comma"," question mark"," colon"," semicolon"," semi colon"," semi:"," semi :"," exclamation mark"," exclamation point"," new line"," new paragraph"," open parentheses"," close parentheses"," hyphen"];d=["smiley","smiley face","sad face","dash "];f=[".",",","?",":",";",";",";",";","!","!",NEW_LINE,NEW_LINE+NEW_LINE,"(",")","-"];h=[":-)",":-)",":-(","- "];this.period="Period";this.comma="Comma";this.question="Question mark";this.colon="Colon";this.semi="Semi Colon";this.exclamation="Exclamation mark, Exclamation point";this.dash="Dash, Hyphen";this.line="New line";this.paragraph="New paragraph";this.open="Open parentheses";this.close="Close parentheses";this.smiley="Smiley, Smiley face";this.sad="Sad face";break}this.listActionCommands=b;this.listBreakCommands=d.concat(e,a,b);this.listToReplaceCommands=e.concat(d);for(var c=0;c<e.length;c++){e[c]=trimSpaces(e[c])}this.listToReplaceCommands=this.listToReplaceCommands.concat(e);for(var c=0;c<e.length;c++){e[c]=capitalize(e[c])}for(var c=0;c<d.length;c++){d[c]=capitalize(d[c])}this.listToReplaceCommands=this.listToReplaceCommands.concat(e,d);this.listToReplaceMarks=f.concat(h,f)}const END_OF_SENTENCE_SYMBOLS=[".",":","?","!",":-)",":-(",NEW_LINE,"\n"];const PUNCTUATION_SYMBOLS=[".",",",";","-","(",")",":","?","!",":-)",":-(",NEW_LINE,"\n",QUATATION];var COMMANDS=new generateTranscriptionCommands("en-US");var listActionCommands=COMMANDS.listActionCommands;var listBreakCommands=COMMANDS.listBreakCommands;var listToReplaceCommands=COMMANDS.listToReplaceCommands;var listToReplaceMarks=COMMANDS.listToReplaceMarks;var variables=null;var isToRestartImmediately;var isResultInBuffer=false;var resultInBuffer="";var symbolToAppend=null;credit_show.innerHTML="<b>"+localStorage.getItem("currentCredit")+"</b>";credit_show2.innerHTML="<b>"+localStorage.getItem("currentCredit")+"</b>";function bindEsc(){$(document).unbind("keyup");$(document).keyup(function(a){if(a.keyCode==27){$(".activityContainer").hide();unbindEsc()}})}function unbindEsc(){if(localStorage.getItem("style")==="full"){$(document).keyup(function(a){if(a.keyCode==27){changeStyle()}})}}if(localStorage.getItem("style")==="full"){$(document).keyup(function(a){if(a.keyCode==27){changeStyle()}})}if("speechSynthesis" in window){var msg=new SpeechSynthesisUtterance("Welcome to Speech logger");msg.volume=1;msg.rate=0.9;msg.pitch=1;msg.lang="en-GB";msg.onend=function(){msg.text="speech_utterance_ended_111"}}var currentSession=new Session();var readLang="";var allowedReadLangs=["en","es","fr","it","de","ja","ko","zh-CN","zh-TW"];var correspondingReadLangs=["en-GB","es-ES","fr-FR","it-IT","de-DE","ja-JP","ko-KR","zh-CN","zh-CN"];var timeBox="";var RTL_languages=["he","iw","ar"];var saveToIndex=localStorage.sessionIndex;variables=new Variables();var t_punctuation;var timeRunnerFromLastResult;var timeRunnerToFinalizeInterim;timeRunnerFromLastResult=setTimeout(function(){},1500);var searchFlag=false;function Variables(){this.savedOnce=false;this.timer=0;this.firstTime=true;this.recognizing=false;this.intentionalPause=true;this.lastwasfinal=true;this.new_sentence=true;this.start_timestamp=0;this.dif_final_interim=0;this.newTimestamp=0;this.oldTimestamp=0;this.newTimestampFinal=0;this.startSubTime=0;this.punctuation=".";this.addLineBreaks=false;this.sentence="";this.firstArrival=0;this.last_interim="";this.resultTextInstance=new TextInstance()}$("#interface_lang option[value='"+interfaceLang+"']").attr("selected",true);localStorage.interfaceLang=interfaceLang;function updateInterface(){localStorage.interfaceLang=interface_lang.value;switch(interface_lang.value){case ("Hebrew"):window.location.assign("../he/");break;case ("English"):window.location.assign("../en/");break;case ("Romanian"):window.location.assign("../ro/");break;default:window.location.assign("../"+interface_lang.value+"/")}}var source_lang="en";var trans_lang="es";if(localStorage.getItem("selectedLanguage")===null){switch(localStorage.getItem("interfaceLang")){case ("de"):localStorage.setItem("selectedLanguage","de-DE");break;case ("es"):localStorage.setItem("selectedLanguage","es-ES");break;case ("fr"):localStorage.setItem("selectedLanguage","fr-FR");break;case ("ja"):localStorage.setItem("selectedLanguage","ja-JP");break;case ("ru"):localStorage.setItem("selectedLanguage","ru-RU");break;case ("it"):localStorage.setItem("selectedLanguage","it-IT");break;case ("zh"):case ("cn"):localStorage.setItem("selectedLanguage","cmn-Hans-CN");break;case ("ar"):localStorage.setItem("selectedLanguage","ar-EG");break;case ("pt"):localStorage.setItem("selectedLanguage","pt-BR");break;default:localStorage.setItem("selectedLanguage","en-US");break}}var langs=initializeLanguages();$("#select_language option[value='"+localStorage.selectedLanguage+"']").attr("selected",true);updateLanguage();if(localStorage.getItem("selectedTranslation")===null||localStorage.selectedTranslation.split("-")[0]===localStorage.selectedLanguage.split("-")[0]){if(localStorage.selectedLanguage.split("-")[0]===interfaceLang){localStorage.selectedTranslation=defaultTrans}else{localStorage.selectedTranslation=interfaceLang}}$("#translate_lang option[value='"+localStorage.selectedTranslation+"']").attr("selected",true);$("#translate_lang option[value='"+select_language.value+"']").attr("disabled","disabled").siblings().removeAttr("disabled");updateTranslateLang();var time_to_period=1000;var time_to_newline=3000;var time_to_2lines=10000;var punctMarks=new PunctMarks();generateMarks("question","start");generateMarks("question","end");generateMarks("question","any");generateMarks("colon","start");generateMarks("colon","end");generateMarks("colon","any");generateMarks("exclamation","start");generateMarks("exclamation","end");generateMarks("exclamation","any");var en_comma_start=["hi ","hello ","bye bye ","yes ","no ","alright then ","alright ","so ","good job ","good morning ","good afternoon ","good evening ","goodbye ","good ","fine ","hey ","sure thing ","sure ","ok ","okay "];updateTagList("start");updateTagList("end");updateTagList("any");function updateLanguage(){localStorage.setItem("selectedLanguage",select_language.value);switch(select_language.value){case ("cmn-Hans-CN"):case ("cmn-Hans-HK"):case ("cmn-Hant-TW"):case ("yue-Hant-HK"):source_lang="zh";break;default:source_lang=select_language.value.split("-")[0];break}trans_lang=translate_lang.value.split("-")[0];if(source_lang===trans_lang){if(trans_langs.indexOf(source_lang)!==-1){$("#translate_lang option[value='"+source_lang+"']").attr("selected",true)}else{$("#translate_lang option[value='en']").attr("selected",true)}updateTranslateLang()}if(trans_langs.indexOf(select_language.value)!==-1){$("#translate_lang option[value='"+source_lang+"']").attr("disabled","disabled").siblings().removeAttr("disabled")}time_to_period=1000;time_to_newline=3000;time_to_2lines=10000;punctMarks=new PunctMarks();generateMarks("question","start");generateMarks("question","end");generateMarks("question","any");generateMarks("colon","start");generateMarks("colon","end");generateMarks("colon","any");generateMarks("exclamation","start");generateMarks("exclamation","end");generateMarks("exclamation","any");updateTagList("start");updateTagList("end");updateTagList("any");punct_act_language.innerHTML=$("#select_language option[value='"+select_language.value+"']").text();COMMANDS=new generateTranscriptionCommands(select_language.value);listActionCommands=COMMANDS.listActionCommands;listBreakCommands=COMMANDS.listBreakCommands;listToReplaceCommands=COMMANDS.listToReplaceCommands;listToReplaceMarks=COMMANDS.listToReplaceMarks;document.getElementById("cell_period").title=COMMANDS.period;document.getElementById("cell_comma").title=COMMANDS.comma;document.getElementById("cell_question").title=COMMANDS.question;document.getElementById("cell_colon").title=COMMANDS.colon;document.getElementById("cell_semi").title=COMMANDS.semi;document.getElementById("cell_exclamation").title=COMMANDS.exclamation;document.getElementById("cell_dash").title=COMMANDS.dash;document.getElementById("cell_line").title=COMMANDS.line;document.getElementById("cell_paragraph").title=COMMANDS.paragraph;document.getElementById("cell_open").title=COMMANDS.open;document.getElementById("cell_close").title=COMMANDS.close;document.getElementById("cell_smiley").title=COMMANDS.smiley;document.getElementById("cell_sad").title=COMMANDS.sad;if(variables!==null){if(variables.recognizing){restartListening()}}}function updateTranslateLang(){localStorage.selectedTranslation=translate_lang.value;trans_lang=translate_lang.value;if(allowedReadLangs.indexOf(trans_lang)>-1){readLang=correspondingReadLangs[allowedReadLangs.indexOf(trans_lang)];$(".readOut_button").show()}else{readLang="NA";$(".readOut_button").hide()}}function addTranslationKey(a){localStorage.setItem("translationKey",a)}$(".final").on("mouseenter",".results_anchor",function(){var b=this.id;var a=b.split("_")[1];$("#trans_"+a).addClass("highlight");$("#results_"+a).addClass("highlight")});$(".final").on("mouseleave",".results_anchor",function(){var b=this.id;var a=b.split("_")[1];$("#trans_"+a).removeClass("highlight");$("#results_"+a).removeClass("highlight")});$(".final").on("click",".results_anchor",function(){$(this).attr("contenteditable",true);$(this).siblings(".timeDisplay").removeClass("timeDisplay");$(this).removeClass("highlight");$(this).focus()});$(".final").on("blur",".results_anchor",function(){$(this).attr("contenteditable",false);switch(localStorage.displayTimeFlag){case ("real"):$(this).siblings(".realTimeDisplay").addClass("timeDisplay");break;case ("dif"):$(this).siblings(".difTimeDisplay").addClass("timeDisplay");break}});$("#output_panel").on("focus",".results_anchor",function(){var c=this.id;var a=c.split("_")[1];var b=$(this);return b}).on("blur",".results_anchor",function(){var a=$(this);if(typeof a[0].childNodes[0]=="undefined"){a[0].innerHTML="..."}if(localStorage.autoSave==="true"){updateInstanceByID(this.id.split("_")[0],this.id.split("_")[1],a[0].innerText);localSave()}return a});function updateInstanceByID(h,b,g){var c=currentSession.transcript.length;var f=Math.floor(c/2);var j=0;var e=c-1;var d=parseInt(b);var a=0;while(d!=currentSession.transcript[f].id&&a<c*2){a++;if(d<currentSession.transcript[f].id){e=f-1;f=Math.floor(f-(f-j)/2);if(f<j){f=j}}else{j=f+1;f=Math.floor(f+(e+1-f)/2);if(f>e){f=e}}}if(d!=currentSession.transcript[f].id){return}switch(h){case"results":currentSession.transcript[f].textContent=g;break;case"trans":currentSession.transcript[f].translatedContent=g;break}return}
		
		function changeColor(a){switch(a){case"custom":a="transparent";break;case"blue":a="transparent";break;case"green":a="transparent";break;case"red":a="transparent";break;case"yellow":a="transparent";break;case"gray":a="transparent";break}$("#application").css("background-color",a);localStorage.favColor=a}
		if(localStorage.getItem("favColor")===null){localStorage.favColor="#97d1fd"}$("#favcolor").attr("value",localStorage.favColor);$("#application").css("background-color",localStorage.favColor);if(localStorage.getItem("sessionsList")===null){localStorage.sessionsList=""}if(localStorage.getItem("autoPunctuation")===null){if(select_language.value.split("-",1)[0]=="en"){localStorage.autoPunctuation="true"}else{localStorage.autoPunctuation="false"}}$("#punctuation_checkbox").prop("checked",(localStorage.autoPunctuation==="true"));if(localStorage.getItem("translation")===null){localStorage.translation="false"}$("#translate_checkbox").prop("checked",(localStorage.translation==="true"));if(localStorage.getItem("translation")==="true"){$("#translate_options").show();$("#translations").show();$("#translations_box").show();$("#results").addClass("narrowbox",0).removeClass("widebox").addClass("leftbox",0);$("#results_box").addClass("narrowbox",0).removeClass("widebox").addClass("leftbox",0)}if(localStorage.getItem("readOut")===null){if("speechSynthesis" in window){localStorage.readOut="true"}else{localStorage.readOut="false"}}$("#read_checkbox").prop("checked",(localStorage.readOut==="true"));if(localStorage.getItem("readOut")==="false"){document.getElementById("speak_button_img").src="../images/speak_off_48x48.png"}if(localStorage.getItem("highlightUncertain")===null){localStorage.highlightUncertain="true"}$("#uncertain_checkbox").prop("checked",(localStorage.highlightUncertain==="true"));if(localStorage.getItem("autoSave")===null){localStorage.autoSave="true"}$("#save_checkbox").prop("checked",(localStorage.autoSave==="true"));if(localStorage.getItem("threshhold_confidence")===null){localStorage.threshhold_confidence="0.85"}if(localStorage.getItem("max_suggestions")===null){localStorage.max_suggestions="3"}if(localStorage.getItem("displayTimeFlag")===null){localStorage.displayTimeFlag="real"}$("#select_timeDisplay option[value='"+localStorage.displayTimeFlag+"']").attr("selected",true);updateTime();if(localStorage.getItem("zoom")===null){localStorage.zoom="1"}zoom(parseFloat(localStorage.zoom));localStorage.zoom=Math.sqrt(parseFloat(localStorage.zoom));function updateTime(){localStorage.displayTimeFlag=select_timeDisplay.value;switch(localStorage.displayTimeFlag){case ("real"):$(".realTimeDisplay").addClass("timeDisplay");$(".difTimeDisplay").removeClass("timeDisplay");break;case ("dif"):$(".realTimeDisplay").removeClass("timeDisplay");$(".difTimeDisplay").addClass("timeDisplay");break;default:$(".realTimeDisplay").removeClass("timeDisplay");$(".difTimeDisplay").removeClass("timeDisplay")}}$("#translate_checkbox").on("click",function(){localStorage.setItem("translation",translate_checkbox.checked);if(localStorage.getItem("translation")==="true"){if(localStorage.getItem("everPaid")!=="true"){credit(1000)}else{if(Number(localStorage.getItem("currentCredit"))<200){$("#translation_key_activity").fadeIn(500)}}$("#translate_options").show();$("#translations").fadeIn(1000);$("#translations_box").fadeIn(1000);$("#results").addClass("narrowbox",0).addClass("leftbox",200).removeClass("widebox",500);$("#results_box").addClass("narrowbox",0).addClass("leftbox",200).removeClass("widebox",500)}else{$("#translate_options").hide();$("#translations").fadeOut(1000);$("#translations_box").fadeOut(1000);$("#results").addClass("widebox",500).removeClass("narrowbox").removeClass("leftbox",200);$("#results_box").addClass("widebox",500).removeClass("narrowbox").removeClass("leftbox",200)}});$("#save_checkbox").on("click",function(){localStorage.autoSave=save_checkbox.checked});$("#punctuation_checkbox").on("click",function(){localStorage.autoPunctuation=punctuation_checkbox.checked;if(localStorage.getItem("autoPunctuation")=="true"&&select_language.value!="English"){$("#punctuation_activity").fadeIn(500);bindEsc()}});$("#uncertain_checkbox").on("click",function(){localStorage.highlightUncertain=uncertain_checkbox.checked;if(uncertain_checkbox.checked){$(".uncertain").addClass("red_font")}else{$(".uncertain").removeClass("red_font")}});$("#read_checkbox").on("click",function(){if(read_checkbox.checked){if(!("SpeechSynthesisUtterance" in window)){alertNotification('<a target="_blank" href="chrome://flags/#enable-experimental-web-platform-features">chrome://flags/#enable-experimental-web-platform-features</a>');$("#read_checkbox").prop("checked",false)}else{alertNotification("Experimental, works only if you translate to English")}}localStorage.readOut=read_checkbox.checked});function toggleRead(){if(localStorage.getItem("readOut")==="true"){localStorage.setItem("readOut","false");document.getElementById("speak_button_img").src="../images/speak_off_48x48.png";speechSynthesis.cancel()}else{if("speechSynthesis" in window){localStorage.setItem("readOut","true");document.getElementById("speak_button_img").src="../images/speak_on_48x48.png";speechSynthesis.cancel()}else{alert("Sorry, your browser does not support Speech Synthesis")}}}

		function zoom(c){
			localStorage.zoom=parseFloat(localStorage.zoom)*c;
			var b=parseInt($("#results").css("font-size"));
			var a=parseInt($("#results").css("line-height"));
			b=c*b+"px";
			a=c*a+"px";
			$("#results").css({"font-size":b});
			$("#results").css({"line-height":a});
			$("#translations").css({"font-size":b});
			$("#translations").css({"line-height":a})
		}

		function newButton(){
			pauseRecognition();
			currentSession=new Session();
			variables=new Variables();
			speaker.value="";
			saveToIndex=localStorage.sessionIndex;session_title.innerHTML=sessionTitle+saveToIndex+", "+newDate.getDate()+" "+monthNames[newDate.getMonth()]+" "+newDate.getFullYear();
			final_span.innerHTML="";
			interim_span.innerHTML="";
			final_translation.innerHTML=""
		}


		function saveAsTxtFile(){
			var b="";
			if(speaker.value!==""){
				b+="Notes: "+speaker.value+"\n-------------------\n\n"
			}
			b+="Transcript:\n-------------------\n"+final_span.innerText;
			if(final_translation.innerHTML.length>1){
				b+="\n\nTranslation\n-------------------\n"+final_translation.innerText
			}
			b+="\n\n"+MSG_SIGNATURE;
			var e=b;
			var d=session_title.innerText+".txt";
			e=e.replace(/\n/g,"\r\n");
			var c=new Blob([e],{type:"text/plain;charset=utf-8"});
			var a=document.createElement("a");
			a.setAttribute("id","downloadLink_id");
			a.download=d;
			a.innerHTML="Download File";
			a.href=window.webkitURL.createObjectURL(c);
			a.click();
			$("#downloadLink_id").remove()
		}
		
		function saveAsDocFile(){
			var b="";
			if(speaker.value!==""){
				b+="Notes: "+speaker.value+"\n-------------------\n\n"
			}
			b+="Transcript:\n-------------------\n"+final_span.innerText;
			if(final_translation.innerHTML.length>1){
				b+="\n\nTranslation\n-------------------\n"+final_translation.innerText
			}
			b+="\n\n"+MSG_SIGNATURE;
			var e=b;
			var d=session_title.innerText+".doc";
			e=e.replace(/\n/g,"\r\n");
			var c=new Blob([e],{type:"text/plain;charset=utf-8"});
			var a=document.createElement("a");
			a.setAttribute("id","downloadLink_id");
			a.download=d;a.innerHTML="Download File";
			a.href=window.webkitURL.createObjectURL(c);
			a.click();$("#downloadLink_id").remove()
		}
		
		function saveAsSrtFile(){var d=currentSession.toSRT("transcript");var c=session_title.innerText+".srt";var b=new Blob([d],{type:"text/plain;charset=utf-8"});var a=document.createElement("a");a.setAttribute("id","downloadLink_id");a.download=c;a.innerHTML="Download File";a.href=window.webkitURL.createObjectURL(b);a.click();$("#downloadLink_id").remove()}
		
		function export2googleTranslate(){
			var a="";
			var b="";
			a+=final_span.innerText;
			a+="\n\n"+MSG_SIGNATURE;
			b="http://translate.google.com/#"+source_lang+"/"+trans_lang+"/"+encodeURIComponent(a);
			if(b.length>1800){
				b=b.substring(0,1800);
				var c=b.split("%");
				b=b.split("%",c.length-1).join("%");
				alertNotification(MSG_URLTOOLONG)
			}
			window.open(b,"_blank")
		}
		
		function copyAll(){window.getSelection().removeAllRanges();var a=document.createRange();a.selectNode(document.getElementById("results"));window.getSelection().addRange(a)}
		function selectContent(b){window.getSelection().removeAllRanges();var a=document.createRange();a.selectNode(document.getElementById(b));window.getSelection().addRange(a)}function emailButton(){pauseRecognition();var a="";if(speaker.value!==""){a+="Notes: "+speaker.value+"\n_________________\n\n"}a+="Transcript:\n_________________\n"+final_span.innerText;if(final_translation.innerHTML.length>1){a+="\n\nTranslation\n_________________\n"+final_translation.innerText}a+="\n\n"+MSG_SIGNATURE;var b="mailto:?subject="+encodeURI(session_title.innerText)+"&body="+encodeURIComponent(a);if(b.length>1200){b=b.substring(0,1200);var c=b.split("%");b=b.split("%",c.length-1).join("%");alertNotification(MSG_URLTOOLONG)}window.open(b,"_blank")}function printButton(){pauseRecognition();var b=session_title.innerText+"<br><br>";if(speaker.value!==""){b+="Notes: "+speaker.value+"<br>_________________<br>"}b+=final_span.innerText;if(final_translation.innerHTML.length>1){b+="<br><br>_________________<br>"+final_translation.innerText}b+="<br><br>"+MSG_SIGNATURE;b=b.replace(/\n/g,"<br>");var a=window.open("","print to","height=400,width=600");a.document.write("<html><head><title>print to</title>");a.document.write("</head><body >");a.document.write(b);a.document.write("</body></html>");a.document.close();a.focus();a.print();a.close();return true}function saveToDrive(){pauseRecognition();var b=session_title.innerText;var a="";if(speaker.value!==""){a+="Notes: "+speaker.value+"\n_________________\n"}a+="Transcript:\n_________________\n"+final_span.innerText;if(final_translation.innerHTML.length>1){a+="\nTranslation\n_________________\n"+final_translation.innerText}a+="\n"+MSG_SIGNATURE;checkAuth2();return true}function saveButton(){localSave();toastNotification(MSG_SAVED);currentSession.session_title=session_title.innerText;currentSession.timer=variables.timer;currentSession.notes=speaker.value;var d=session_title.innerText+".tst";var b=JSON.stringify(currentSession);var c=new Blob([b],{type:"text/plain;charset=utf-8"});var a=document.createElement("a");a.setAttribute("id","downloadLink_id");a.download=d;a.innerHTML="Download File";a.href=window.webkitURL.createObjectURL(c);a.click();$("#downloadLink_id").remove()}function openFile(){}function handleFileSelect(){var d=document.getElementById("selected_file").files;if(!d.length){alert("Please select a file!");return}var c=d[0];var a=new FileReader();a.onloadend=function(e){if(e.target.readyState==FileReader.DONE){var f=e.target.result;loadSession(f)}};var b=c;a.readAsText(b)}document.getElementById("selected_file").addEventListener("change",handleFileSelect,false);var lastResultTimestamp=0;var lastStartTimeStamp=0;var firstInterimTimeStamp=0;var strToPass="";$(document).keydown(function(a){if((a.which=="115"||a.which=="83")&&(a.ctrlKey||a.metaKey)){a.preventDefault();saveButton();return false}return true});$(document).keydown(function(a){if(a.keyCode==13){if(variables.recognizing&&resultInBuffer!=""){a.preventDefault();restartListening()}}});var timeTimeout=null;var sentenceTimeout=null;var paragraphTimeout=null;function onTimeTimeout(){if(timeTimeout!==null){clearTimeout(timeTimeout);timeTimeout=null}console.log("onTimeTimeout");restartListening()}function onSentenceTimeout(a){console.log("onSentenceTimeout");if(localStorage.getItem("autoPunctuation")==="true"&&variables.sentence.length>0){var b=setPunctuation(variables.sentence);$("#results_"+a).html($("#results_"+a).html()+b);variables.resultTextInstance.textContent+=b;if($("#trans_"+a).html().length>0){$("#trans_"+a).html($("#trans_"+a).html()+b);variables.resultTextInstance.translatedContent+=b}if(localStorage.autoSave==="true"){localSave()}variables.new_sentence=true;variables.sentence="";paragraphTimeout=setTimeout(onParagraphTimeout,3000,a)}}function onParagraphTimeout(a){console.log("onParagraphTimeout");if(localStorage.getItem("autoPunctuation")==="true"&&!isLastSymbolAnyOf(variables.resultTextInstance.textContent,NEW_LINE)){var b=NEW_LINE;document.getElementById("results_"+a).innerText+=b;variables.resultTextInstance.textContent+=b;if($("#trans_"+a).html()!==undefined){if($("#trans_"+a).html().length>0){document.getElementById("trans_"+a).innerText+=b;variables.resultTextInstance.translatedContent+=b}}if(localStorage.autoSave==="true"){localSave()}variables.new_sentence=true;variables.sentence=""}}if(!("webkitSpeechRecognition" in window)){upgrade()}else{start_button.style.display="inline-block";var recognition=new webkitSpeechRecognition();recognition.continuous=true;recognition.interimResults=true;recognition.maxAlternatives=1;recognition.lang=select_language.value;recognition.onstart=function(c){var b=new Date();var a=b.getTime();console.log("On Start"+a);if(searchFlag){search_img.src="images/searchon.gif"}else{start_img.src="images/Mic-G.gif"}symbolToAppend=null;variables.recognizing=true;isResultInBuffer=false;resultInBuffer="";lastStartTimeStamp=a;firstInterimTimeStamp=0;window.clearTimeout(timeRunnerFromLastResult)};recognition.onend=function(c){var b=new Date();var a=b.getTime();console.log("On end"+a);variables.recognizing=false;if(isResultInBuffer){finalize(resultInBuffer,0.5)}if(variables.intentionalPause===false||isToRestartImmediately){console.log("Ended unintentionally");recognition.lang=select_language.value;recognition.start();return false}else{start_img.src="images/Mic-A.png";variables.intentionalPause=true;return true}firstInterimTimeStamp=0};recognition.onspeechstart=function(c){var b=new Date();var a=b.getTime();firstInterimTimeStamp=0;console.log("On SpeechStart"+a);lastStartTimeStamp=a};recognition.onspeechend=function(){};recognition.onnomatch=function(a){console.log("No match")};recognition.onerror=function(a){console.log("Error recognizing")};recognition.onresult=function(c){var d=new Date();var g=d.getTime();console.log("Fired onresult");clearTimeout(sentenceTimeout);clearTimeout(paragraphTimeout);if(typeof(c.results)==="undefined"){recognition.onend=null;variables.intentionalPause=true;recognition.stop();upgrade();return}lastResultTimeStamp=g;window.clearTimeout(timeRunnerFromLastResult);window.clearTimeout(t_punctuation);variables.oldTimestamp=variables.newTimestamp;if(variables.newTimestamp===0){variables.oldTimestamp=variables.start_timestamp}variables.newTimestamp=g;var b="";var a="";var h="";if(variables.lastwasfinal){variables.startSubTime=Math.max(variables.start_timestamp,variables.newTimestampFinal,variables.newTimestamp-c.results[c.resultIndex][0].transcript.length*100-500);variables.last_interim=""}var d=new Date();variables.dif_final_interim=variables.newTimestamp-variables.oldTimestamp;var e="";str="";for(var k=c.resultIndex;k<c.results.length;++k){str=trimSpaces(c.results[k][0].transcript);if(!((str.substring(0,2)==="I "||str.substring(0,2)==="I'")&&select_language.value.split("-")[0]==="en")){str=str[0].toLowerCase()+str.substring(1,str.length)}if(c.results[k].isFinal){if(resultInBuffer.length>c.results[k][0].transcript.length+10){str=trimSpaces(resultInBuffer);if(!((str.substring(0,2)==="I "||str.substring(0,2)==="I'")&&select_language.value.split("-")[0]==="en")){str=str[0].toLowerCase()+str.substring(1,str.length)}}finalize(str,c.results[k][0].confidence)}else{if(0==firstInterimTimeStamp){firstInterimTimeStamp=g}variables.lastwasfinal=false;b+=c.results[k][0].transcript;variables.last_interim=b;isResultInBuffer=true;resultInBuffer=b;var d=new Date();if(timeTimeout!==null){timeTimeout=setTimeout(onTimeTimeout,10000)}if(resultInBuffer.length>120){onTimeTimeout()}console.log(" ----- Interim result= "+c.results[k][0].transcript);str=" "+str;for(var f=0;f<listBreakCommands.length;f++){if(str.indexOf(listBreakCommands[f])!==(-1)){restartListening();isToRestartImmediately=true;return}}}}interim_span.innerHTML=linebreak(resultInBuffer);document.getElementById("output_panel").scrollTop=document.getElementById("output_panel").scrollHeight}}function restartRecognition(){if(true===variables.recognizing){variables.intentionalPause=false;recognition.stop();variables.recognizing=false}return}function finalize(f,e){clearTimeout(timeTimeout);clearTimeout(paragraphTimeout);clearTimeout(sentenceTimeout);timeTimeout=null;var b=new Date();var d=b.getTime();variables.newTimestampFinal=d;lastStartTimeStamp=d;isResultInBuffer=false;resultInBuffer="";variables.lastwasfinal=true;variables.last_interim="";interim_span.innerHTML="";if(variables.firstTime){variables.firstTime=false;localStorage.sessionIndex=parseFloat(localStorage.sessionIndex)+1}firstInterimTimeStamp=0;console.log(" --- Final result= "+f);switch(listActionCommands.indexOf(f)){case 0:return;default:break}for(var c=0;c<listToReplaceCommands.length;c++){f=f.replace(listToReplaceCommands[c],listToReplaceMarks[c])}variables.resultTextInstance=new TextInstance();variables.resultTextInstance.textContent="";variables.resultTextInstance.timeStamp=d;variables.resultTextInstance.timerStart=variables.startSubTime-variables.start_timestamp+variables.timer;variables.resultTextInstance.timerEnd=d-variables.start_timestamp+variables.timer;variables.resultTextInstance.confidence=e;variables.resultTextInstance.id=d;variables.resultTextInstance.lang=source_lang;variables.resultTextInstance.targetLang=trans_lang;timeBox='<div class="realTimeDisplay">'+addZero(b.getHours())+":"+addZero(b.getMinutes())+":"+addZero(b.getSeconds())+'</div><div class="difTimeDisplay">'+addZero(Math.floor(variables.resultTextInstance.timerEnd/3600000))+":"+addZero(Math.floor((variables.resultTextInstance.timerEnd%3600000)/60000))+":"+addZero(Math.floor((variables.resultTextInstance.timerEnd%60000)/1000))+"</div>";if(localStorage.getItem("autoPunctuation")==="true"){variables.resultTextInstance.textContent=prepareText(punctuate(f),false);if(variables.recognizing){paragraphTimeout=setTimeout(onParagraphTimeout,3000,d)}}else{variables.resultTextInstance.textContent=prepareText(f,false)}if(symbolToAppend!==null){variables.resultTextInstance.textContent+=symbolToAppend;symbolToAppend=null}variables.sentence+=variables.resultTextInstance.textContent;currentSession.transcript.push(variables.resultTextInstance);final_span.innerHTML+=variables.resultTextInstance.toHTML(parseFloat(localStorage.threshhold_confidence))[0];if(localStorage.translation==="true"&&source_lang!==trans_lang&&localStorage.getItem("everPaid")==="true"){var h=document.createElement("script");h.type="text/javascript";var i=variables.resultTextInstance.textContent;var g="AIzaSyAS9aNa8SZg6Gxk2ODnEy54_KDWpvnnFMI";var a="https://www.googleapis.com/language/translate/v2?key="+g+"&source="+source_lang+"&target="+trans_lang+"&callback=translateText&q="+i;h.src=a;document.getElementsByTagName("head")[0].appendChild(h)}if(localStorage.getItem("autoSave")==="true"){localSave()}}function prepareText(c,e){if(c.length>0){var b;if(!e){b=document.getElementById("results").innerText}else{b=document.getElementById("translations").innerText}var a=b.substring(b.length-5);var d=(a.length>0&&a[a.length-1]===" ");a=trimSpaces(a);if(isLastSymbolAnyOf(a,END_OF_SENTENCE_SYMBOLS)||a==""||a==="null"){c=capitalize(c)}if(a.length>0&&!d&&[NEW_LINE,"("].indexOf(a[a.length-1])===(-1)&&[".",",",";",":","?","!",")"].indexOf(c[0])===(-1)){c=" "+c}return c}else{return""}}function isLastSymbolAnyOf(d,c){var b="";for(var a=0;a<c.length;a++){b=c[a];if(d.slice(d.length-b.length)===b){return true}}return false}function insertSymbol(a){if(variables.recognizing&&resultInBuffer.length>0){symbolToAppend=a;restartListening()}else{symbolToAppend=null;finalize(a,1)}}function upgrade(){start_button.style.visibility="hidden";alertNotification(MSG_UPGRADE)}var two_line=/\n\n/g;var one_line=/\n/g;function linebreak(a){return a.replace(two_line,"<p></p>").replace(one_line,"<br>")}function trimSpaces(a){while(a[0]===" "){a=a.slice(1)}while(a[a.length-1]===" "){a=a.slice(0,a.length-1)}return a}var first_char=/\S/;function capitalize(a){return a.replace(first_char,function(b){return b.toUpperCase()})}function endVoiceSearch(){if(searchFlag){variables.intentionalPause=false;if(variables.recognizing){pauseRecognition();return}}return}function searchStartButton(a){variables.intentionalPause=false;if(variables.recognizing){pauseRecognition();return}localStorage.selected_language_index=select_language.selectedIndex;localStorage.selected_dialect_index=select_language.selectedIndex;recognition.lang=select_language.value;recognition.maxAlternatives=1;recognition.continuous=false;recognition.interimResults=false;searchFlag=true;recognition.start();search_img.src="../images/searchslash.png"}function restartListening(){if(variables.recognizing){isToRestartImmediately=true;variables.intentionalPause=false;recognition.stop()}return}function startButton(d){window.clearTimeout(timeRunnerFromLastResult);variables.intentionalPause=false;if(variables.recognizing){pauseRecognition();return}localStorage.selected_language_index=select_language.selectedIndex;localStorage.selected_dialect_index=select_language.selectedIndex;recognition.lang=select_language.value;recognition.maxAlternatives=1;updateTranslateLang();recognition.continuous=true;recognition.interimResults=true;searchFlag=false;try{recognition.start()}catch(c){}interim_span.innerHTML="";start_img.src="images/Mic-Slash.png";var b=new Date();var a=b.getTime();variables.start_timestamp=a}function punctuationPreferences(){$("#punctuation_activity").fadeIn(500)}function removePunctSequence(c,d,g){var b=select_language.value.split("-",1)[0];var i=localStorage.getItem(b+"_"+d+"_"+g+"_omit");var a=c;if(i!==null){if(i.indexOf(c)===-1){i+=c+";"}}else{i=c+";"}localStorage.setItem(b+"_"+d+"_"+g+"_omit",i);var e=localStorage.getItem(b+"_"+d+"_"+g);if(e!==null){var j=new RegExp(c,"gi");e=e.replace(j,"");j=new RegExp(";;","g");while(e.indexOf(";;")!==-1){e=e.replace(j,";")}if(e[0]===";"){e=e.substring(1)}localStorage.setItem(b+"_"+d+"_"+g,e)}var f=punctMarks[d];while(f[g].indexOf(c)!==-1){f[g].splice(f[g].indexOf(c),1)}punctMarks[d][g]=f[g];updateTagList(g);url="../resources/update_punctuation_sequences.jsp";var h=$.post(url,{language:b,mark:d,position:g,add:"-1",sequences:a})}function addPunctSequences(k,c,g){var b=select_language.value.split("-",1)[0];var d=localStorage.getItem(b+"_"+c+"_"+g);var j=localStorage.getItem(b+"_"+c+"_"+g+"_omit");k=k.replace(/[$<>{}^&/]/g," ");k=k.toLowerCase();var m=k.split(";");var e=punctMarks[c];var l;var a="";for(var f=0;f<m.length;f++){sequence=m[f];if(sequence===null){continue}while(sequence[0]===" "){sequence=sequence.substring(1)}while(sequence[sequence.length-1]===" "){sequence=sequence.substring(sequence.length-1)}if(sequence.length<1){continue}if(d!==null){if(d.indexOf(sequence)===-1){d+=sequence+";"}}else{d=sequence+";"}localStorage.setItem(b+"_"+c+"_"+g,d);if(e[g].indexOf(sequence)===-1){e[g]=e[g].concat([sequence]);a+=sequence+";"}if(j!==null){l=new RegExp(sequence,"gi");j=j.replace(l,"");l=new RegExp(";;","g");while(j.indexOf(";;")!==-1){j=j.replace(l,";")}if(j[0]===";"){j=j.substring(1)}localStorage.setItem(b+"_"+c+"_"+g+"_omit",j)}}punctMarks[c][g]=e[g];updateTagList(g);url="../resources/update_punctuation_sequences.jsp";var h=$.post(url,{language:b,mark:c,position:g,add:"1",sequences:a})}function generateMarks(d,g){var b=select_language.value.split("-",1)[0];var e=localStorage.getItem(b+"_"+d+"_"+g);var j=localStorage.getItem(b+"_"+d+"_"+g+"_omit");var a=[];if(b!="en"){url="../resources/get_punctuation_sequences.jsp";var h=$.post(url,{language:b,mark:d,position:g},"string");h.done(function(m){a=m.split(";");a.splice(a.length-1,1);console.log(b+" "+d+" "+g+": "+a+"; ");if(e!==null){var n=e.split(";");var o;for(var l=0;l<n.length;l++){o=n[l];if(o===null){continue}if(o.length<1){continue}if(a.indexOf(o)===-1){a=a.concat([o])}}}if(j!==null){var n=j.split(";");for(var l=0;l<n.length;l++){while(a.indexOf(n[l])!==-1){a.splice(a.indexOf(n[l]),1)}}}while(a.indexOf("")!==-1){a.splice(a.indexOf(""),1)}punctMarks[d][g]=a;updateTagList(g)})}else{if(d=="question"&&g=="start"){a=["what","why","how","who","do","when","will","whom","where","can","could","would","does","is","are","were","can't you","don't you think","didn't you","don't you know","don't they"]}else{if(d=="question"&&g=="any"){a=[]}else{if(d=="question"&&g=="end"){a=["question mark"]}else{if(d=="colon"&&g=="start"){a=["here are","here is"]}else{if(d=="colon"&&g=="any"){a=["the following"]}else{if(d=="colon"&&g=="end"){a=["as follows","colon"]}else{if(d=="exclamation"&&g=="start"){a=["wow","see you","love you"]}else{if(d=="exclamation"&&g=="any"){a=["hell no","must be kidding","no way","sure thing"]}else{if(d=="exclamation"&&g=="end"){a=["unbelievable","exclamation mark","for sure","sure thing","i wish","you wish","love you","you wish"]}}}}}}}}}console.log(b+" "+d+" "+g+": "+a+"; ");if(e!==null){var k=e.split(";");var c;for(var f=0;f<k.length;f++){c=k[f];if(c===null){continue}if(c.length<1){continue}if(a.indexOf(c)===-1){a=a.concat([c])}}}if(j!==null){var k=j.split(";");for(var f=0;f<k.length;f++){while(a.indexOf(k[f])!==-1){a.splice(a.indexOf(k[f]),1)}}}while(a.indexOf("")!==-1){a.splice(a.indexOf(""),1)}punctMarks[d][g]=a;updateTagList(g)}}function showInfo(a){if(a){for(var b=info.firstChild;b;b=b.nextSibling){if(b.style){b.style.display=b.id==a?"inline":"none"}}info.style.visibility="visible"}else{info.style.visibility="hidden"}}function switchTranscript(a,b){if(document.getElementById("results_"+a)){document.getElementById("results_"+a).innerHTML=b}}function setPunctuation(b){previousStr=trimSpaces(b);if(isLastSymbolAnyOf(previousStr,PUNCTUATION_SYMBOLS)||previousStr==""||previousStr==="null"||symbolToAppend!==null){return""}var a="";while(b[0]===" "){b=b.slice(1)}if(markFit(b,"question")){return"?"}if(markFit(b,"colon")){return":"}if(markFit(b,"exclamation")){return"!"}return"."}function punctuate(f){var b="";var d="";variables.punctuation=".";var e="";var a=0;while(f[0]===" "){f=f.slice(1)}if(select_language.value.split("-",1)[0]=="en"&&f.indexOf(",")==(-1)){for(var c=0;c<en_comma_start.length;c++){a=en_comma_start[c].length;e=new RegExp(en_comma_start[c],"i");if(e.test(f.slice(0,a+1))){d=f.slice(a);while(d[0]===" "){d=d.slice(1)}if(!(d.slice(0,2)=="to")&&!(d.slice(0,5)=="there")){b=f.slice(0,a-1)+", ";f=d}}}}variables.punctuation=setPunctuation(f);return b+f+variables.punctuation}function markFit(c,d){var a=punctMarks[d];for(var b=0;b<a.start.length;b++){regex=new RegExp(a.start[b],"i");if(regex.test(c.slice(0,a.start[b].length+1))){return true}}for(var b=0;b<a.end.length;b++){regex=new RegExp(a.end[b],"i");if(regex.test(c.slice(0-a.end[b].length-1))){return true}}for(var b=0;b<a.any.length;b++){regex=new RegExp(a.any[b],"i");if(regex.test(c)){return true}}return false}function translateText(a){speechSynthesis.cancel();if(typeof a.data==="undefined"){currentSession.transcript[currentSession.transcript.length-1].translatedContent=""}else{var b=prepareText(a.data.translations[0].translatedText,true);currentSession.transcript[currentSession.transcript.length-1].translatedContent=b;final_translation.innerHTML+=currentSession.transcript[currentSession.transcript.length-1].toHTML(parseFloat(localStorage.threshhold_confidence))[1]}if(localStorage.readOut==="true"&&readLang!=="NA"){temporary_html.innerHTML=a.data.translations[0].translatedText;msg.lang=readLang;msg.text=temporary_html.innerText;speechSynthesis.speak(msg)}}function addZero(a){if(a<10){a="0"+a}return a}function addDoubleZero(a){if(a<100){if(a<10){a="00"+a}else{a="0"+a}}return a}function localSave(){currentSession.session_title=session_title.innerText;currentSession.timer=variables.timer;currentSession.notes=speaker.value;var a=JSON.stringify(currentSession);if((JSON.stringify(localStorage).length+a.length)/1000000>2.2){alertNotification(MSG_NOAVAILABLESPACE)}if(!variables.savedOnce){variables.savedOnce=true;while(localStorage.sessionsList.indexOf(saveToIndex)!==-1){saveToIndex=localStorage.sessionIndex;localStorage.sessionIndex=parseFloat(localStorage.sessionIndex)+1}localStorage.sessionsList+=saveToIndex+","}localStorage.setItem("session_title_"+saveToIndex,session_title.innerText);localStorage.setItem("session_"+saveToIndex,a);sessionsDropdown()}function deleteSession(b){var a="";if(saveToIndex==b){newButton()}a=b+",";localStorage.sessionsList=localStorage.sessionsList.replace(a,"");localStorage.removeItem("session_"+b);localStorage.removeItem("session_title_"+b);sessionsDropdown()}function loadSession(d){pauseRecognition();variables=new Variables();var c;if(localStorage.getItem("session_"+d)!==null){c=localStorage.getItem("session_"+d);saveToIndex=d;variables.savedOnce=true}else{c=d;saveToIndex=localStorage.sessionIndex}currentSession=new Session();$.extend(currentSession,JSON.parse(c));for(var b=0;b<currentSession.transcript.length;b++){var e=new TextInstance();$.extend(e,currentSession.transcript[b]);currentSession.transcript[b]=e}var a=currentSession.toHTML(localStorage.threshhold_confidence);final_span.innerHTML=a[0];final_translation.innerHTML=a[1];session_title.innerHTML=currentSession.session_title;speaker.value=currentSession.notes;variables.firstTime=false;variables.timer=parseFloat(currentSession.timer);variables.addLineBreaks=true;if(uncertain_checkbox.checked){$(".uncertain").addClass("red_font")}else{$(".uncertain").removeClass("red_font")}}

		function pauseRecognition(){
		if(variables.recognizing){
			isToRestartImmediately=false;
			variables.intentionalPause=true;
			variables.timer=variables.timer+Date.now()-variables.start_timestamp;
			recognition.stop()
		}
		if(final_span.innerHTML.length>=2&&save_checkbox.checked){
			localSave()
			}
		}

		function toastNotification(b){
			var a=1000+b.length/5*150;notification.innerHTML=b;
			$("#notification").fadeIn(1000,function(){
				$("#notification").delay(a).fadeOut(1000)
			})
		}
		
		function alertNotification(b,a){
			bindEsc();
			info.innerHTML=b;
			$("#alert_container").fadeIn(500);
			if(typeof a==="string"){
				alert_title.innerHTML=a
			}else{
				alert_title.innerHTML=MSG_DEFAULT_NOTE_TITLE
			}
		}
		
		function srtTime(b){
			var a=addZero(Math.floor(b/3600000))+":"+addZero(Math.floor((b%3600000)/60000))+":"+addZero(Math.floor((b%60000)/1000))+","+addDoubleZero(Math.floor(b%1000));
			return a
		}
		
		function Session(){
			this.transcript=new Array();
			this.session_title;
			this.timer=0;
			this.notes;this.toHTML=a;
			function a(f){
				var d=["",""];
				var c=["",""];
				var b=this.transcript;
				for(var e=0;e<b.length;e++){
					d=b[e].toHTML(f);
					if(e>0){
						if(b[e].timerStart-b[e-1].timerEnd>=time_to_newline){
							c[0]+="<br>";
							c[1]+="<br>";
							if(b[e].timerStart-b[e-1].timerEnd>time_to_2lines){
								c[0]+="<br>";
								c[1]+="<br>"
							}
						}
					}
					c[0]+=d[0];c[1]+=d[1]
				}
				return c
			}
		}
		Session.prototype.toTXT=function(b){
			var e="";
			var c="";
			var f=new TextInstance();
			switch(b){
				case"none":for(var d=0;d<this.transcript.length;d++){f=this.transcript[d];if(d>0){if(this.transcript[d].timerStart-this.transcript[d-1].timerEnd>=time_to_newline){e+="<br>";c+="<br>";if(this.transcript[d].timerStart-this.transcript[d-1].timerEnd>time_to_2lines){e+="<br>";c+="<br>"}}}e+=f.textContent;c+=f.translatedContent}break;case"real":for(var d=0;d<this.transcript.length;d++){f=this.transcript[d];e+=srtTime(f.timeStamp)+" - "+f.textContent+"\r\n";if(f.translatedContent!==""){c+=srtTime(f.timeStamp)+" - "+f.translatedContent+"\r\n"}}break;case"timer":for(var d=0;d<this.transcript.length;d++){f=this.transcript[d];e+=srtTime(f.timeStart)+" - "+f.textContent+"\r\n";if(f.translatedContent!==""){c+=srtTime(f.timeStart)+" - "+f.translatedContent+"\r\n"}}break;default:return -1}var a=e+"\r\n -------------------------------- \r\n"+c;return a};Session.prototype.toSRT=function(a){var b="";var d=new TextInstance();switch(a){case"transcript":for(var c=1;c<=this.transcript.length;c++){d=this.transcript[c-1];b+=c+"\r\n"+srtTime(d.timerStart)+" --> "+srtTime(d.timerEnd)+"\r\n"+capitalize(d.textContent)+"\r\n\r\n"}break;case"translation":for(var c=1;c<=this.transcript.length;c++){d=this.transcript[c-1];if(d.translatedContent!==""){b+=c+"\r\n"+srtTime(d.timerStart)+" --> "+srtTime(d.timerEnd)+"\r\n"+capitalize(d.translatedContent)+"\r\n\r\n"}}break;case"combined":for(var c=1;c<=this.transcript.length;c++){d=this.transcript[c-1];b+=c+"\r\n"+srtTime(d.timerStart)+" --> "+srtTime(d.timerEnd)+"\r\n"+capitalize(d.textContent)+"\r\n Translation: "+capitalize(d.translatedContent)+"\r\n\r\n"}break;default:return -1}return b};function TextInstance(){this.textContent="";this.translatedContent="";this.timeStamp=0;this.timerStart=0;this.timerEnd=0;this.confidence=1;this.id="";this.lang="en";this.targetLang="fr"}TextInstance.prototype.toHTML=function(c){var b=["",""];var d=new Date(this.timeStamp);localStorage.displayTimeFlag=select_timeDisplay.value;switch(localStorage.displayTimeFlag){case ("real"):timeBox='<div class="realTimeDisplay timeDisplay">'+addZero(d.getHours())+":"+addZero(d.getMinutes())+":"+addZero(d.getSeconds())+'</div><div class="difTimeDisplay">'+addZero(Math.floor(this.timerStart/3600000))+":"+addZero(Math.floor((this.timerStart%3600000)/60000))+":"+addZero(Math.floor((this.timerStart%60000)/1000))+"</div>";break;case ("dif"):timeBox='<div class="realTimeDisplay">'+addZero(d.getHours())+":"+addZero(d.getMinutes())+":"+addZero(d.getSeconds())+'</div><div class="difTimeDisplay timeDisplay">'+addZero(Math.floor(this.timerStart/3600000))+":"+addZero(Math.floor((this.timerStart%3600000)/60000))+":"+addZero(Math.floor((this.timerStart%60000)/1000))+"</div>";break;default:timeBox='<div class="realTimeDisplay">'+addZero(d.getHours())+":"+addZero(d.getMinutes())+":"+addZero(d.getSeconds())+'</div><div class="difTimeDisplay">'+addZero(Math.floor(this.timerStart/3600000))+":"+addZero(Math.floor((this.timerStart%3600000)/60000))+":"+addZero(Math.floor((this.timerStart%60000)/1000))+"</div>"}if(RTL_languages.indexOf(this.lang)!=(-1)){var e='<a dir="rtl" class="results_anchor" contenteditable="false" style="cursor: text" id="results_'+this.timeStamp+'">'}else{var e='<a class="results_anchor" contenteditable="false" style="cursor: text" id="results_'+this.timeStamp+'">'}if(RTL_languages.indexOf(this.targetLang)!=(-1)){var a='<a dir="rtl" class="results_anchor" contenteditable="false" style="cursor: text" id="trans_'+this.timeStamp+'">'}else{var a='<a class="results_anchor" contenteditable="false" style="cursor: text" id="trans_'+this.timeStamp+'">'}if(this.confidence<c){if(uncertain_checkbox.checked){b[0]=linebreak(capitalize('<span class="text_results uncertain red_font">'+e+this.textContent+"</a>"+timeBox+"</span>"));if(this.translatedContent!==""){b[1]=linebreak(capitalize('<span class="text_results uncertain red_font">'+a+this.translatedContent+"</a>"+timeBox+"</span>"))}}else{b[0]=linebreak(capitalize('<span class="text_results uncertain">'+e+this.timeStamp+'">'+this.textContent+"</a>"+timeBox+"</span>"));if(this.translatedContent!==""){b[1]=linebreak(capitalize('<span class="text_results uncertain">'+a+this.translatedContent+"</a>"+timeBox+"</span>"))}}}else{b[0]=linebreak(capitalize('<span class="text_results">'+e+this.textContent+"</a>"+timeBox+"</span>"));if(this.translatedContent!==""){b[1]=linebreak(capitalize('<span class="text_results">'+a+this.translatedContent+"</a>"+timeBox+"</span>"))}}return b};function PunctMarks(){this.question=new PunctuationMark("question");this.colon=new PunctuationMark("colon");this.exclamation=new PunctuationMark("exclamation")}function PunctuationMark(a){this.start=[];this.end=[];this.any=[]}function demo_credit(){if(Number(localStorage.getItem("currentCredit"))<200){credit(1000)}else{}}function open_fb_share(){window.open("https://www.facebook.com/sharer/sharer.php?u="+document.URL)}

			

		function initializeLanguages() {
			var toReturn = [
			  ['id-ID', 'Bahasa, Indonesia'],
			  ['en-US', 'English, US'], 
			  ['ms-MY', 'Melayu'],
			  ['bg-BG', 'Bulgarian'],
			  ['cs-CZ', 'Czech'],
			  ['de-DE', 'Deutsch'],
			  ['nl-NL', 'Netherlands'],
			  ['en-AU', 'Australia'],
			  ['en-CA', 'Canada'],
			  ['en-IN', 'India'],
			  ['en-NZ', 'New Zealand'],
			  ['en-ZA', 'S. Africa'],
			  ['en-GB', 'English, UK'],   
			  ['es-AR', 'Argentina'],
			  ['es-BO', 'Bolivia'],
			  ['es-CL', 'Chile'],
			  ['es-CO', 'Colombia'],
			  ['es-CR', 'Costa Rica'],
			  ['es-EC', 'Ecuador'],
			  ['es-SV', 'El Salvador'],
			  ['es-ES', 'Espanyola'],
			  ['es-US', 'Estados Unidos'],
			  ['es-GT', 'Guatemala'],
			  ['es-HN', 'Honduras'],
			  ['es-MX', 'Mexico'],
			  ['es-NI', 'Nicaragua'],
			  ['es-PA', 'Panama'],
			  ['es-PY', 'Paraguay'],
			  ['es-PE', 'Peru'],
			  ['es-PR', 'Puerto Rico'],
			  ['es-DO', 'R. Dominicana'],
			  ['es-UY', 'Uruguay'],
			  ['es-VE', 'Venezuela']
			];
			for (var i = 0; i < toReturn.length; i++) {
			  select_language.options[i] = new Option(toReturn[i][1], toReturn[i][0]); // (text,value)
			}
			return toReturn;
		}
		
		function runonload(){}(function(d,e,j,h,f,c,b){d.GoogleAnalyticsObject=f;d[f]=d[f]||function(){(d[f].q=d[f].q||[]).push(arguments)},d[f].l=1*new Date();c=e.createElement(j),b=e.getElementsByTagName(j)[0];c.async=1;c.src=h;b.parentNode.insertBefore(c,b)})(window,document,"script","//www.google-analytics.com/analytics.js","ga");ga("create","UA-47292499-1","SSDMVoiceNote");ga("send","pageview");
	</script>
</body>
</html>
