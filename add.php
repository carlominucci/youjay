<?php
$filename=$_GET[add] . ".yjpl";
$file=fopen(sys_get_temp_dir() . "/" . $filename, "w");
fclose($file);
?>
Traccia aggiunta alla playlist.<br />
<a href="index.php">Torna alla ricerca</a>
