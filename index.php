<!DOCTYPE html>
<html>
<head>
	<title>YouJay</title>
	<link href="style.css" rel="stylesheet" type="text/css">
	<link href="http://unicorn-ui.com/buttons/css/buttons.css" rel="stylesheet" type="text/css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Google Fonts embed code -->
    <script type="text/javascript">
        (function() {
            var link_element = document.createElement("link"),
                s = document.getElementsByTagName("script")[0];
            if (window.location.protocol !== "http:" && window.location.protocol !== "https:") {
                link_element.href = "http:";
            }
            link_element.href += "//fonts.googleapis.com/css?family=Open+Sans:300italic,300,400italic,400,600italic,600,700italic,700,800italic,800";
            link_element.rel = "stylesheet";
            link_element.type = "text/css";
            s.parentNode.insertBefore(link_element, s);
        })();
    </script>

    
</head>

<body>
<div id="header">
<img src="logo_small.png" alt="youjay" />
<p class="claim">Fai girare la tua musica!</p>
</div>

<div id="search">
<form action="index.php" method="post" class="form-wrapper cf">
<span class="input input--haruki">
	<input class="input__field input__field--haruki" type="text" id="input-1" type="text" size="35" name="keyword" placeholder="cerca" required <?php
if(isset($_POST["keyword"])){
	echo "echo value=\"";
	echo $_POST['keyword'];
	echo "\"";
}
?> /> <br> <input type="submit" value="cerca" class="button button-primary button-pill button-giant"/>
</span>
</form>
</div>

<p class="clear"></p>

<div id="risultato">
<?php
if(isset($_POST["keyword"])){
	if($_POST["keyword"] == ""){
		echo "Inserisci la chiave di ricerca...";	
	}elseif(isset($_POST["keyword"])){
		$keyword=addslashes(strip_tags(preg_replace("/\s/i", "+", $_POST["keyword"])));
		$url="https://www.youtube.com/results?safesearch=strict&search_query=" . $keyword;
		$curl = curl_init();
		curl_setopt ($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec ($curl);
		curl_close ($curl);
		
		$arrayhtml=explode("\n", $result);
		$arraytitle = preg_grep("/yt-lockup-content/", $arrayhtml);
		$arrayimg = preg_grep("/yt-thumb video-thumb/", $arrayhtml);

		$keys=(array_keys($arraytitle));
		$keysimg=(array_keys($arrayimg));
		$imax=6;
		for($i=2; $i<=$imax; $i++){
			$arraytitle[$keys[$i]];
			$arrdata=explode("=", $arraytitle[$keys[$i]]);
			$videoid=explode("\"", $arrdata[4]);

			if(stristr($arraytitle[$keys[$i]], "full album") || stristr($arraytitle[$keys[$i]], "full concert") || $videoid[0] == ""){
				$imax++;
			}else{
				//print_r($arraytitle);
				preg_match("/title\=(.*?)\"\s+/si", $arraytitle[$keys[$i]], $title);
				preg_match("/((\w+):)(\w+)/i", $arraytitle[$keys[$i]], $time);
				$arraythumb=$arrayimg[$keysimg[$i-2]];
				preg_match("/\"\/\/(.*?)\.jpg/", $arraythumb, $thumb);
				echo "<a href=\"add.php?id=" . $videoid[0] . "&title=" . str_ireplace("\"", "", $title[1]) . "\">
				<img src=\"http://" . $thumb[1] . ".jpg\" alt=\"" . $title[1] . " class=\"anteprima\"/></a><br>";
				echo "<span class=\"info\"> " . str_ireplace("\"", "", $title[1]) . " [";
				echo $time[0];
				echo "] <a href=\"add.php?id=" . $videoid[0] . "&title=" . str_ireplace("\"", "", $title[1]) . "\" class=\"button button-primary button-box button-small\"><i class=\"fa fa-plus\"></i></a></span><p class=\"clear spazio\"></p>\n";
			}
		}
	}
}
$db = new SQLite3('youjay.db');
$query="SELECT * FROM playlist";
$results = $db->query($query);
$queryn="SELECT COUNT(id) FROM playlist;";
$row = $db->querySingle($queryn);

echo $row . " brani presenti nella playlist.<hr>\n";
echo "<b>Playlist corrente:</b><br />\n";
while ($roba = $results->fetchArray()){
	if($roba['download'] == 'FALSE'){
		print("<div class=\"grigino\">" . $roba['title'] . "</div>\n");
	}else{
    	print($roba['title']."<br />\n");
    }
}
echo $roba;
?>

</div><!-- fine risultato -->

</body>
</html>
