#!/bin/bash
while :
do
	echo "Youjay download daemon starting..."
	download=$(sqlite3 youjay.db "SELECT videoid FROM playlist WHERE download = 'FALSE'" | head -1);
	if [ $download ]
	then
		echo "$download donwloading"
		youtube-dl http://youtube.com/watch?v=$download --output /tmp/$download
		ls -l /tmp/$download
		sqlite3 youjay.db "UPDATE playlist SET download = 'TRUE' WHERE videoid = '$download'"
	else
		sleep 5
	fi
done
