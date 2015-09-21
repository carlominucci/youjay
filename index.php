<!DOCTYPE html>
<html>
<head>
	<title>YouJay</title>
	<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
<img src="logo_small.png" alt="youjay" />
<form action="index.php" method="post">
<input type="text" size="35" name="keyword" />
<input type="submit" value="cerca" />
</form><hr />
<?php
if(isset($_POST["keyword"])){
	if($_POST["keyword"] == ""){
		echo "Inserisci la chiave di ricerca...";	
	}elseif(isset($_POST["keyword"])){
		//$keyword=preg_replace("/\s/i", "+", $_POST[keyword]);
		$keyword=addslashes(strip_tags(preg_replace("/\s/i", "+", $_POST["keyword"])));
		$url="https://www.youtube.com/results?safesearch=strict&search_query=" . $keyword;
		$curl = curl_init();
		curl_setopt ($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec ($curl);
		curl_close ($curl);
		$arrresult=split("num-results", $result);
		$nresults=split(" ", strip_tags($arrresult[1]));
		if($nresults[2] == 0){
			echo "La tua ricerca non ha prodotto risultati...";
		}else{
			$array=split("yt-lockup-content", $result);
			$arrimg=split("yt-thumb video-thumb", $result);
			$arrtime=split("video-time", $result);

			$time1=$arrtime[2];
			$time2=$arrtime[3];
			$time3=$arrtime[4];
			$time4=$arrtime[5];
			$time5=$arrtime[6];

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


			echo "<img src=\"http:" . $img1[4] . "\" alt=\"" . $arr1[10] . "\" height=\"100\" />";
			echo $arr1[10];
			$time=explode(">", $time1);
			echo " - " .substr($time[1], 0, -6);
			$tmp=split("=", $arr1[4]);
			echo " <a href=\"add.php?id=" . $tmp[1] . "&title=" . $arr1[10] . "\">add</a><hr />\n";

			echo "<img src=\"http:" . $img2[4] . "\" alt=\"" . $arr2[10] . "\" height=\"100\" />";
			echo $arr2[10];
			$time=explode(">", $time2);
                        echo " - " .substr($time[1], 0, -6);
			$tmp=split("=", $arr2[4]);
			echo " <a href=\"add.php?id=" . $tmp[1] . "&title=" . $arr2[10] ."\">add</a><hr />\n";

			echo "<img src=\"http:" . $img3[4] . "\" alt=\"" . $arr3[10] . "\" height=\"100\" />";
			echo $arr3[10];
			$time=explode(">", $time3);
                        echo " - " .substr($time[1], 0, -6);
			$tmp=split("=", $arr3[4]);
			echo " <a href=\"add.php?id=" . $tmp[1] . "&title=" . $arr3[10] ."\">add</a><hr />\n";

			echo "<img src=\"http:" . $img4[4] . "\" alt=\"" . $arr4[10] . "\" height=\"100\" />";
			echo $arr3[10];
			$time=explode(">", $time4);
                        echo " - " .substr($time[1], 0, -6);
			$tmp=split("=", $arr3[4]);
			echo " <a href=\"add.php?id=" . $tmp[1] . "&title=" . $arr4[10] . "\">add</a><hr />\n";

			echo "<img src=\"http:" . $img5[4] . "\" alt=\"" . $arr5[10] . "\" height=\"100\" />";
			echo $arr5[10];
			$time=explode(">", $time5);
                        echo " - " .substr($time[1], 0, -6);
			$tmp=split("=", $arr5[4]);
			echo " <a href=\"add.php?id=" . $tmp[1] . "&title=" . $arr5[10] . "\">add</a><hr />\n";
		}
	}
}
$db = new SQLite3('youjay.db');
$query="SELECT * FROM playlist";
$results = $db->query($query);
$row=count($results);
echo $row . " brani presenti nella playlist.<hr />";
echo "<b>Playlist corrente:</b><br />";
while ($roba = $results->fetchArray())
    print($roba['title']."<br />\n");
echo $roba;
?>
</body>
</html>
