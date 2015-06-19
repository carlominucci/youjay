<img src="youjay_logo.png" alt="youjay" /><br />
<form action="index.php" method="post">
<input type="text" name="keyword" />
<input type="submit" value="cerca" />
</form>
<?php
if(isset($_POST[keyword])){
	$keyword=preg_replace("/\s/i", "+", $_POST[keyword]);
	//grep yt-lockup-content | grep -v list= | awk -F'"' '{print "http://youtube.com" $6 " " $12}' | tail -12 | head -3
	$url="https://www.youtube.com/results?search_query=" . $keyword;
	$curl = curl_init();
	curl_setopt ($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$result = curl_exec ($curl);
	curl_close ($curl);
	$array=split("yt-lockup-content", $result);
	$arr1=split("\"", $array[3]);
	$arr2=split("\"", $array[4]);
	$arr3=split("\"", $array[5]);
	echo $arr1[10];
	$t=explode(".", $arr1[21]);
	$t=explode(": ", $t[0]);
	echo " - " . $t[1];
	$tmp=split("=", $arr1[4]);
	echo " <a href=\"add.php?add=" . $tmp[1] ."\">add</a><br />";
	echo $arr2[10];
	$t=explode(".", $arr2[21]);
	$t=explode(": ", $t[0]);
	echo " - " . $t[1];
	$tmp=split("=", $arr2[4]);
	echo " <a href=\"add.php?add=" . $tmp[1] ."\">add</a><br />";
	echo $arr3[10];
	$t=explode(".", $arr3[21]);
	$t=explode(": ", $t[0]);
	echo " - " . $t[1];
	$tmp=split("=", $arr3[4]);
	echo " <a href=\"add.php?add=" . $tmp[1] ."\">add</a><br />";
}
?>
