<!DOCTYPE html>
<html>
<head>
	<title>YouJay</title>
	<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
<form action="index.php" method="post">
<img src="youjay_logo.png" alt="youjay" />
<input type="text" name="keyword" />
<input type="submit" value="cerca" />
</form><hr />
<?php
if(isset($_POST[keyword])){
	//$keyword=preg_replace("/\s/i", "+", $_POST[keyword]);
	$keyword=addslashes(strip_tags(preg_replace("/\s/i", "+", $_POST[keyword])));
	$url="https://www.youtube.com/results?safesearch=strict&search_query=" . $keyword;
	$curl = curl_init();
	curl_setopt ($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$result = curl_exec ($curl);
	curl_close ($curl);
	$array=split("yt-lockup-content", $result);
	$arrimg=split("yt-thumb video-thumb", $result);
	$arr1=split("\"", $array[3]);
	$arr2=split("\"", $array[4]);
	$arr3=split("\"", $array[5]);
	$arr4=split("\"", $array[6]);
	$arr5=split("\"", $array[7]);
	
	$img1=split("\"", $arrimg[1]);
	$img2=split("\"", $arrimg[2]);
	$img3=split("\"", $arrimg[3]);
	$img4=split("\"", $arrimg[4]);
	$img5=split("\"", $arrimg[5]);

	
	echo "<img src=\"http:" . $img1[2] . "\" alt=\"" . $arr1[10] . "\" height=\"100\" />";
	echo $arr1[10];
	$t=explode(".", $arr1[21]);
	$t=explode(": ", $t[0]);
	echo " - " . $t[1];
	$tmp=split("=", $arr1[4]);
	echo " <a href=\"add.php?add=" . $tmp[1] ."\">add</a><hr />\n";
	
	echo "<img src=\"http:" . $img2[2] . "\" alt=\"" . $arr2[10] . "\" height=\"100\" />";
	echo $arr2[10];
	$t=explode(".", $arr2[21]);
	$t=explode(": ", $t[0]);
	echo " - " . $t[1];
	$tmp=split("=", $arr2[4]);
	echo " <a href=\"add.php?add=" . $tmp[1] ."\">add</a><hr />\n";
	
	echo "<img src=\"http:" . $img3[2] . "\" alt=\"" . $arr3[10] . "\"height=\"100\" />";
	echo $arr3[10];
	$t=explode(".", $arr3[21]);
	$t=explode(": ", $t[0]);
	echo " - " . $t[1];
	$tmp=split("=", $arr3[4]);
	echo " <a href=\"add.php?add=" . $tmp[1] ."\">add</a><hr />\n";
	
	echo "<img src=\"http:" . $img4[2] . "\" alt=\"" . $arr4[10] . "\" height=\"100\" />";
	echo $arr3[10];
	$t=explode(".", $arr3[21]);
	$t=explode(": ", $t[0]);
	echo " - " . $t[1];
	$tmp=split("=", $arr3[4]);
	echo " <a href=\"add.php?add=" . $tmp[1] ."\">add</a><hr />\n";
	
	echo "<img src=\"http:" . $img5[2] . "\" alt=\"" . $arr5[10] . "\" height=\"100\" />";
	echo $arr5[10];
	$t=explode(".", $arr5[21]);
	$t=explode(": ", $t[0]);
	echo " - " . $t[1];
	$tmp=split("=", $arr5[4]);
	echo " <a href=\"add.php?add=" . $tmp[1] ."\">add</a><hr />\n";
}
?>
</body>
</html>
