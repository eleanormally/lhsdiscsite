<?php
function getCoursesFromApi($dataArray) {
	return exec("python /var/www/html/courseapi.py", $status, $return);
}
function getAcctData($lid, $pwd, $dtag) {
	$taskdir = "/tmp/bottasks/";
	$dataArray = array('ASPENUNAME: ' . $lid, 'ASPENPWD: ' . $pwd);
	$url = 'http://aspencourseapi.herokuapp.com/getUserData';		
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $dataArray);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	$response = json_decode(curl_exec($ch), true);
	curl_close($ch);
	if($response['error']){
		$GLOBALS['status'] = 0;
		return "error: " . $response['error'];
	}
	$file = fopen($taskdir . $dtag, "w") or die("unable to create taskfile");
	fwrite($file, $response['name'] . "\n" . $response['grade'] . "\nStudent\n");
	$classes = $response['classes'];
	for($i = 0; $i < count($classes); $i++) {
		fwrite($file, $classes[$i][0] . "/group/" . $classes[$i][1] .  "\n");
	}
	fwrite($file, "\n");
	fclose($file);
	$GLOBALS['status'] = 1;
	return "Your courses have been added and you should get access to your servers shortly.";

}

if (isset($_POST['lid']) && isset($_POST['pwd']) && isset($_POST['dtag'])) {
	$status = 0;
	$result = getAcctData($_POST['lid'], $_POST['pwd'], $_POST['dtag']);
}
else{
	$result = "Error, Missing Credentials. Try going back and retyping your username and password.";
	$status = 0;
}
?>
<html>
<head>
	<title>Log Into LHS Discord</title>
	<link rel="stylesheet" href="done.css">
</head>
<body>
	<h1 style="text-align:center"><?php echo ($status==1)?"Done!":"Login Error"; ?></h1>
	<p style="text-align:center"><?php echo $result . ''?></p><br>
	<button type="button" <?php if($status!=0) {?> style="visibility:hidden" <?php } else { ?> style="position: absolute; left: 50%; -ms-transform: translate(-50%, 0%); transform: translate(-50%, 0%);" <?php } ?> onclick="window.history.go(-1); return false;">Re Enter Credentials</button>
</html>

