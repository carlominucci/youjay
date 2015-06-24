<!DOCTYPE html>
<html>
<head>
	<title>YouJay player</title>
	<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
$arrfile=array();
foreach (glob(sys_get_temp_dir() . "/" . "*.yjpl") as $filename) {
    $arrfile[filemtime($filename)] = $filename;
}
echo count($arrfile) . " video in coda...<br />";
ksort($arrfile);
if(count($arrfile) > 0){
	$tmp=trim(min($arrfile), ".yjpl");
	$tmp=trim($tmp, "/tmp/");
	unlink(min($arrfile));
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
          videoId: '<?php echo $tmp; ?>',
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
        		location.reload();
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
