<!DOCTYPE html>
<html>
<head>
	<title>YouJay</title>
	<link href="style.css" rel="stylesheet" type="text/css">
	<meta http-equiv ="refresh" content="5; url=index.php">
</head>

<body>
<?php

$data=date("U");
$tmp=date("Ymd");

$query="INSERT INTO playlist (videoid, title, play, download) VALUES (\"" . $_GET["id"] . "\", \"" . addslashes($_GET["title"]) . "\", \"FALSE\", \"FALSE\");";

$db = new SQLite3('youjay.db');
$results = $db->query($query);
?>
Traccia aggiunta alla playlist.<br />
<a href="index.php">Torna alla ricerca</a>
</body>
</html>
