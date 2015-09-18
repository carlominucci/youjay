<!DOCTYPE html>
<html>
<head>
	<title>YouJay</title>
	<link href="style.css" rel="stylesheet" type="text/css">
	<meta http-equiv ="refresh" content="10; url=index.php">
</head>

<body>
<?php

/*$filename=$_GET[add] . ".yjpl";
$file=fopen(sys_get_temp_dir() . "/" . $filename, "w");
fclose($file);*/

$data=date("U");
$tmp=date("Ymd");
//$fp=fopen(sys_get_temp_dir() . "/" . $tmp . ".yjpl", 'a');
//fwrite($fp, $_GET["id"] . "\n");
//fclose($fp);
$query="INSERT INTO playlist VALUES(\"\", \"" . $_GET["id"] . "\", \"" . addslashes($_GET["title"]) . "\", \"FALSE\", \"FALSE\")";
?>
Traccia aggiunta alla playlist.<br />
<a href="index.php">Torna alla ricerca</a>
</body>
</html>
<?php
echo $query;
//$dlcommand="nohup youtube-dl http://youtube.com/watch?v=" . $_GET["add"] . " -o /tmp/" . $_GET["add"] . " > /dev/null &";
//echo $dlcommand;
//exec($dlcommand);
?>
