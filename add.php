<!DOCTYPE html>
<html>
<head>
	<title>YouJay</title>
	<link href="style.css" rel="stylesheet" type="text/css">
	<meta http-equiv ="refresh" content="5; url=index.php">
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
<p>
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
}elseif($row > 0){
	echo "Il brano è già presente nella playlist<br />";
}
?>

<a href="index.php">Torna alla ricerca</a>
</p>
</body>
</html>
