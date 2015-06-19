<!DOCTYPE html>
<html>
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
            'onStateChange': onPlayerStateChange
          }
        });
      }
      function onPlayerReady(event) {
        event.target.playVideo();
      }
      var done = false;
      function onPlayerStateChange(event) {
        if (player.getPlayerState() == 0){
        	location.reload();
        }
        /*if (player.getPlayerState() == -1 && player.getPlayerState() != 1){
        	document.write("Problema con il video, passo al successivo tra 5 secondi...");
        	setTimeout("location.reload(true);", 5000);
        }*/
      }
      function stopVideo() {
        player.stopVideo();
      }
    </script>
<?php }else{
	echo "Nessun video in coda al momento...";
}
?>
    <br /><a href="player.php">Avanti...</a>
  </body>
</html>
