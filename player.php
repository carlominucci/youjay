<?php
$db = new SQLite3('youjay.db');
if(isset($_GET['delete'])){
	if($_GET['delete'] == "all"){
		$query="DELETE FROM playlist";
		$db->query($query);
	}elseif($_GET['delete'] != "all"){
		$query="DELETE FROM playlist WHERE videoid='" . $_GET['delete'] . "'";
		$db->query($query);
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>YouJay player</title>
	<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
$query="SELECT videoid,title FROM playlist WHERE play = 'FALSE' AND download = 'TRUE' ORDER BY id LIMIT 1";
//echo $query;
$results = $db->query($query);

echo "<b>Brano corrente:</b><br />";
while ($roba = $results->fetchArray()){
    print($roba['title']."<br />\n");
   	$videoid = $roba['videoid']; 
   	//echo $videoid;
}
if(isset($videoid)){
	$query="UPDATE playlist SET play = 'TRUE' WHERE videoid = '" .  $videoid . "'";
	$db->query($query);
}

?>

<div id="player"></div>
<video width="320" height="240" controls autoplay id=video>
  <source src="tmp/<?php echo $videoid; ?>.mp4" type="video/mp4">
Your browser does not support the video tag.
</video>
<script type='text/javascript'>
    document.getElementById('video').addEventListener('ended',reloadPage,false);
    function reloadPage(e) {
        location.assign("player.php");
    }
</script>
</div>
<?php
$query="SELECT * FROM playlist WHERE download = 'TRUE'";
$results = $db->query($query);
echo "<hr /><b>Brani nella playlist:</b><br />";
while ($roba = $results->fetchArray()){
    //print("<a href=\"player.php?delete=" . $roba['videoid'] . "\">rimuovi</a> " . $roba['title'] . "</a><br />\n");
    print($roba['title'] . "<br />\n");
}
?>
	<br />
	<a href="player.php">salta video...</a><br />
	<a href="player.php?delete=<?php echo $videoid; ?>">rimuovi brano corrente dalla playlist...</a><br />
	<a href="player.php?delete=all">cancella playlist...</a><br />
  </body>
</html>
