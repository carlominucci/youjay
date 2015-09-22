#!/bin/bash
while :
do
	video=$(sqlite3 youjay.db "SELECT videoid FROM playlist WHERE play = 'FALSE' AND download = 'TRUE' ORDER BY 'id';" | head -1);
	if [ $video ]
	then
		mplayer /tmp/$video
		echo "play brano"
		sqlite3 youjay.db "UPDATE playlist SET play = 'TRUE' WHERE videoid = '$video';"
	else
		echo "nessun nuovo brano"
		sleep 1
	fi
done
