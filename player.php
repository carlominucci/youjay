<?php
session_start();
if(!isset($_SESSION["id"])){
	$_SESSION["id"] = "0";
}elseif(isset($_SESSION["id"])){
	$_SESSION["id"]++;
}
echo "!!" . $_SESSION["id"] . "!!";
//echo "sessionid " . $_SESSION["id"];
$tmp=date("Ymd");

if(isset($_GET["delete"]) && $_GET["delete"] = "yes"){
	unlink(sys_get_temp_dir() . "/" . $tmp . ".yjpl");
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


if(file_exists(sys_get_temp_dir() . "/" . $tmp . ".yjpl")){
	$lines=file(sys_get_temp_dir() . "/" . $tmp . ".yjpl");
	if((count($lines)) < ($_SESSION["id"]+1)){
		session_unset();
		session_destroy();
		?>
		<script>
			location.assign("player.php")
		</script>
		<?php
	}else{
		echo "video: " . ($_SESSION["id"]+1) . " di " . count($lines) . "<br />";
		//echo "|" . $lines[$_SESSION["id"]] . "|<br />";
		//print_r($lines);
		if(count($lines) > 0){
		?>
			<div id="player"></div>
			<script>
			  var tag = document.createElement('script');
			  tag.src = "https://www.youtube.com/iframe_api";
			  var firstScriptTag = document.getElementsByTagName('script')[0];
			  firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
			  var player;
			  function onYouTubeIframeAPIReady() {
				player = new YT.Player('player', {
				  height: '390',
				  width: '640',
				  videoId: '<?php echo str_replace("\n", "", $lines[$_SESSION["id"]]); ?>',
				  events: {
				    'onReady': onPlayerReady,
				    'onStateChange': onPlayerStateChange,
				    'onError': onChangeVideo
				  }
				});
			  }
			  function onPlayerReady(event) {
				event.target.playVideo();
			  }
			  var done = false;
			  function onChangeVideo(event){
			  	location.reload();
			  }
			  function onPlayerStateChange(event) {
			  	//alert(player.getPlayerState());
			  	alert(onError());
			  	if (player.get.PlayerState() == -1){
					if (player.getPlayerState() == 0){
						//location.reload();
						location.assign("player.php");
					}
				}
				/*if (player.getPlayerState() < 0){
					document.write("Problema con il video, passo al successivo tra 5 secondi...");
					setTimeout("location.reload(true);", 5000);
				}*/
			  }
			  function stopVideo() {
				player.stopVideo();
			  }
			</script>
			</div>
		<?php
		}
	}
}else{
	echo "nessun video nella playlist...";
}
?>
	<br />
	<a href="player.php">salta video...</a><br /><a href="player.php?delete=yes">cancella playlist...</a>
  </body>
</html>
