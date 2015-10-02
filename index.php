<!DOCTYPE html>
<html>
<head>
	<title>YouJay</title>
	<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
<img src="logo_small.png" alt="youjay" />
<form action="index.php" method="post">
<input type="text" size="35" name="keyword"
<?php
if(isset($_POST["keyword"])){
	echo "echo value=\"";
	echo $_POST['keyword'];
	echo "\"";
}
?>
 />
<input type="submit" value="cerca" />
</form><hr />
<?php
if(isset($_POST["keyword"])){
	if($_POST["keyword"] == ""){
		echo "Inserisci la chiave di ricerca...";	
	}elseif(isset($_POST["keyword"])){
		$keyword=addslashes(strip_tags(preg_replace("/\s/i", "+", $_POST["keyword"])));
		$url="https://www.youtube.com/results?safesearch=strict&search_query=" . $keyword;
		$curl = curl_init();
		curl_setopt ($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec ($curl);
		curl_close ($curl);
		
		$arrayhtml=explode("\n", $result);
		$arraytitle = preg_grep("/yt-lockup-content/", $arrayhtml);
		$arrayimg = preg_grep("/yt-thumb video-thumb/", $arrayhtml);

		$keys=(array_keys($arraytitle));
		$keysimg=(array_keys($arrayimg));
		for($i=2; $i<=6; $i++){
			$arraytitle[$keys[$i]];
			$arrdata=explode("=", $arraytitle[$keys[$i]]);
			$videoid=explode("\"", $arrdata[4]);
			preg_match("/title\=(.*?)\"\s+/si", $arraytitle[$keys[$i]], $title);
			preg_match("/((\w+):)(\w+)/i", $arraytitle[$keys[$i]], $time);
			$arraythumb=$arrayimg[$keysimg[$i-2]];
			preg_match("/\"\/\/(.*?)\.jpg/", $arraythumb, $thumb);
			
			echo "<img src=\"http://" . $thumb[1] . ".jpg\" alt=\"" . $title[1] . "/>";
			echo " " . str_ireplace("\"", "", $title[1]) . " - ";
			echo $time[0];
			echo " - <a href=\"add.php?id=" . $videoid[0] . "&title=" . str_ireplace("\"", "", $title[1]) . "\">add</a><hr />\n";
		}
	}
}
$db = new SQLite3('youjay.db');
$query="SELECT * FROM playlist";
$results = $db->query($query);
$queryn="SELECT COUNT(id) FROM playlist;";
$row = $db->querySingle($queryn);

echo $row . " brani presenti nella playlist.<hr />\n";
echo "<b>Playlist corrente:</b><br />\n";
while ($roba = $results->fetchArray()){
	if($roba['download'] == 'FALSE'){
		print("<div class=\"grigino\">" . $roba['title'] . "</div>\n");
	}else{
    	print($roba['title']."<br />\n");
    }
}
echo $roba;
?>
</body>
</html>
