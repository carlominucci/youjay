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
</head>
<body>

<?php
$query="SELECT videoid,title FROM playlist WHERE play = 'FALSE' AND download = 'TRUE' ORDER BY id LIMIT 1";
$results = $db->query($query);


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

<table>
	<tr>
		<td class="playersx">
			<div id="player"></div>
			<video width="640" height="480" controls autoplay id=video>
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
				echo "<br /><b>Brano corrente:</b><br />";
				print($videotitle."<br />\n");
				$query="UPDATE playlist SET play = 'TRUE' WHERE videoid = '$videoid'";
				$db->query($query);
			?>
			<a href="player.php?delete=all">cancella playlist</a><br />
			<a href="player.php?delete=<?php echo $videoid; ?>">rimuovi brano corrente</a><br />
			<a href="player.php">prossimo brano</a>
			
		</td>
		<td class="playerdx">
			<?php
			$query="SELECT * FROM playlist WHERE download = 'TRUE'";
			$results = $db->query($query);
			echo "<b>Brani nella playlist:</b><br />";
			while ($roba = $results->fetchArray()){
				if($roba['videoid'] == $videoid){
					echo "<div class=\"nowplay\">";
				}else{
					echo "<div>";
				}
				print($roba['title'] . " <a href=\"player.php?delete=" . $roba['videoid'] . "\">[rimuovi]</a></div>\n");
			}
			?>
		</td>
	</tr>
	<tr>
		<td colspan="2" class="banner">prova</td>
	</tr>
</table>

  </body>
</html>
