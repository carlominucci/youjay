<?php
$db = new SQLite3('youjay.db');
if(isset($_GET['delete'])){
	if($_GET['delete'] == "all"){
		$query="DELETE FROM playlist";
		$db->query($query);
		header("Location: player.php");
	}elseif($_GET['delete'] != "all"){
		$query="DELETE FROM playlist WHERE videoid='" . $_GET['delete'] . "'";
		$db->query($query);
		header("Location: player.php");
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>YouJay player</title>
	<link href="style.css" rel="stylesheet" type="text/css">
	<link href="http://unicorn-ui.com/buttons/css/buttons.css" rel="stylesheet" type="text/css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
<?php
$query="SELECT videoid,title FROM playlist WHERE play = 'FALSE' AND download = 'TRUE' ORDER BY id LIMIT 1";
$results = $db->query($query);

/*echo "<b>Brano corrente:</b><br />";
while ($roba = $results->fetchArray()){
    print($roba['title']."<br />\n");
   	$videoid = $roba['videoid']; 
}
if(isset($videoid)){
	$query="UPDATE playlist SET play = 'TRUE' WHERE videoid = '" .  $videoid . "'";
	$db->query($query);
}elseif(!isset($videoid)){
	$query="SELECT * FROM playlist ORDER BY RANDOM() LIMIT 1";
	$results = $db->query($query);
	while ($roba = $results->fetchArray()){
		print($roba['title']."<br />\n");
	   	$videoid = $roba['videoid']; 
	}
}*/
?>

<!-- <div id="player"></div>
<video width="320" height="240" controls autoplay id=video>
  <source src="tmp/<?php // echo $videoid; ?>.mp4" type="video/mp4">
Your browser does not support the video tag.
</video>
<script type='text/javascript'>
    document.getElementById('video').addEventListener('ended',reloadPage,false);
    function reloadPage(e) {
        location.assign("player.php");
    }
    //window.alert(window.innerWidth + ' ' + window.innerHeight);
</script>
</div>-->

<?php
$query="SELECT * FROM playlist WHERE download = 'TRUE'";
$results = $db->query($query);
echo "<b>Brani nella playlist:</b><br />";
while ($roba = $results->fetchArray()){
    print($roba['title'] . " <a href=\"player.php?delete=" . $roba['videoid'] . "\">[rimuovi]</a><br />\n");
}
?>
	<!-- <a href="player.php">salta video...</a><br />
	<a href="player.php?delete=<?php echo $videoid; ?>">rimuovi brano corrente dalla playlist...</a><br /> -->
	<hr /><a href="player.php?delete=all">cancella playlist...</a>
  </body>
</html>
