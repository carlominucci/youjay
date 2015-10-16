#!/bin/bash
while :
do
	video=$(sqlite3 youjay.db "SELECT videoid FROM playlist WHERE play = 'FALSE' AND download = 'TRUE' ORDER BY 'id';" | head -1);
	if [ $video ]
	then
		mplayer tmp/$video.mp4 
		echo "play brano"
		sqlite3 youjay.db "UPDATE playlist SET play = 'TRUE' WHERE videoid = '$video';"
	else	
		randomid=$(sqlite3 youjay.db "SELECT id FROM playlist ORDER BY RANDOM() LIMIT 1";)
		echo "nessun brano nuovo, ne prendo uno a caso"
		videoold=$(sqlite3 youjay.db "SELECT videoid FROM playlist WHERE download = 'TRUE' AND id = '$randomid'");
		mplayer tmp/$videoold.mp4 
		sleep 1
	fi
done
