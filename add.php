<!DOCTYPE html>
<html>
<head>
	<title>YouJay</title>
	<link href="style.css" rel="stylesheet" type="text/css">
	<meta http-equiv ="refresh" content="5; url=index.php">
</head>

<body>
<?php
$db = new SQLite3('youjay.db');
	
$queryn="SELECT COUNT(id) FROM playlist WHERE videoid = '" . $_GET["id"] . "'";
$row = $db->querySingle($queryn);

if($row == 0){
	$query="INSERT INTO playlist (videoid, title, play, download) VALUES (\"" . ($_GET["id"]) . "\", \"" . str_ireplace("\"", "", $_GET["title"]) . "\", \"FALSE\", \"FALSE\");";
	$results = $db->query($query);
	?>
	Traccia aggiunta alla playlist.<br />
	<?php
}elseif($row > 1){
	echo "Il brano è già presente nella playlist<br />";
}
?>

<a href="index.php">Torna alla ricerca</a>
</body>
</html>
