#!/bin/bash
clear
echo "Youjay download daemon starting..."
mkdir tmp
cd tmp
while :
do
	download=$(sqlite3 youjay.db "SELECT videoid FROM playlist WHERE download = 'FALSE'" | head -1);
	if [ $download ] ; then
			youtube-dl --id http://youtube.com/watch?v=$download
			sqlite3 youjay.db "UPDATE playlist SET download = 'TRUE' WHERE videoid = '$download'"
	fi
	echo "refresh..."
	sleep 5;
done
