<?php
session_start();
if(!isset($_SESSION["id"])){
	$_SESSION["id"] = "0";
}else{
	$_SESSION["id"]++;
}
//echo "sessionid " . $_SESSION["id"];
$tmp=date("Ymd");
$lines=file(sys_get_temp_dir() . "/" . $tmp . ".yjpl");
?>

<!DOCTYPE html>
<html>
<head>
	<title>YouJay player</title>
	<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php

echo count($lines) . " video in coda...<br />";
echo "video: " . ($_SESSION["id"]+1) . "<br />";
if($_SESSION["id"] >= (count($lines)-1)){
	session_unset();
	session_destroy();
}
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
        		location.assign("player.php")
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
<?php
}
?>	<br />
	<!-- <form action="player.php" method="post">
		Seleziona il tempo massimo per ogni video:<select name="time">
			<option value="0" selected="true">nessuno</option>
			<option value="1" >1 min.</option>
			<option value="2" >2 min.</option>
			<option value="3" >3 min.</option>
			<option value="4" >4 min.</option>
			<option value="5" >5 min.</option>
			<option value="6" >6 min.</option>
		</select>
	</form>-->
	<a href="player.php">Avanti...</a>
  </body>
</html>
