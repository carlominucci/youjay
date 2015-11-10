<?php
$db = new SQLite3('youjay.db');
if(isset($_GET['delete'])){
	if($_GET['delete'] == "all"){
		$query="DELETE FROM playlist";
		$db->query($query);
		header("Location: player.php#nowplay");
	}elseif($_GET['delete'] != "all" || $_GET['delete'] != "next"){
		$query="DELETE FROM playlist WHERE videoid='" . $_GET['delete'] . "'";
		$db->query($query);
		header("Location: player.php#nowplay");
	}elseif($_GET['delete'] == "next"){
		header("Location: player.php#nowplay");
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
$results = $db->query($query);
while ($roba = $results->fetchArray()){
   	$videoid = $roba['videoid']; 
   	$videotitle = $roba['title'];
}

if(isset($videoid)){
	$query="UPDATE playlist SET play = 'TRUE' WHERE videoid = '" .  $videoid . "'";
	$db->query($query);
}elseif(!isset($videoid)){
	$query="SELECT * FROM playlist ORDER BY RANDOM() LIMIT 1";
	$results = $db->query($query);
	while ($roba = $results->fetchArray()){
		$videotitle = $roba['title'];
	   	$videoid = $roba['videoid']; 
	}
}


?>


	<div class="col1">
		<div id="player"></div>
		<video width="640" height="480" controls autoplay id=video poster="logo.png" class="videoplayer">
			<source src="tmp/<?php  echo $videoid; ?>.mp4" type="video/mp4">
			Your browser does not support the video tag.
		</video>
		<script type='text/javascript'>
			document.getElementById('video').addEventListener('ended',reloadPage,false);
			function reloadPage(e) {
				location.assign("player.php");
			}
			//window.alert(window.innerWidth + ' ' + window.innerHeight);
		</script>
		<?php 
			
			if(isset($videotitle)){
				echo "<div class=\"branocorrente\">";
				print($videotitle."<br />\n");
				?><a href="player.php?delete=all"><img class="tile" src="delplaylist.png" alt="cancella playlist" /></a>
				<a href="player.php?delete=<?php echo $videoid; ?>"><img class="tile" src="delsong.png" alt="rimuovi brano corrente" /></a>
				<a href="player.php?delete=next"><img class="tile" src="next.png" alt="prossimo brano" /></a>
				</div><?php
			}else{
				echo "<br /><b>Nessun brano presente nella playlist.</b><br /><br />";
			}
		?>
	</div>
	<div id="col2">
		<?php
		$query="SELECT * FROM playlist WHERE download = 'TRUE'";
		$results = $db->query($query);
		while ($roba = $results->fetchArray()){
			if($roba['videoid'] == $videoid){
				echo "<div id=\"nowplay\">";
				echo "<a name=\"nowplay\">";
				echo "<img src=\"play.png\" alt=\"now play\" /></a> ";
			}else{
				echo "<div>";
			}
			if($roba['play'] == "FALSE"){
				echo "<i>new</i> ";
			}
			$query="UPDATE playlist SET play = 'TRUE' WHERE videoid = '$videoid'";
			$db->query($query);
			//print($roba['title'] . " <a class=\"btn\" href=\"player.php?delete=" . $roba['videoid'] . "\">-</a> <a class=\"btn\" href=\"player.php?playvideo=" . $roba['videoid'] . "\">►</a></div>\n");
			print($roba['title'] . "</div>");
		}
		?>
	</div>


  </body>
</html>
