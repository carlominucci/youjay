#!/bin/bash
clear
echo "Youjay download daemon starting..."
mkdir tmp
cd tmp
while :
do
	download=$(sqlite3 ../youjay.db "SELECT videoid FROM playlist WHERE download = 'FALSE'" | head -1);
	if [ $download ] ; then
		echo $download
		youtube-dl --id http://youtube.com/watch?v=$download
		sqlite3 ../youjay.db "UPDATE playlist SET download = 'TRUE' WHERE videoid = '$download'"
	fi
	echo "refresh..."
	sleep 5;
	df=$(df -h | grep "/dev/" | awk '{print $5}' | tr -d "%")
	if [ $df -gt "90" ] ; then
		echo "delete most old video..."
		idold=$(sqlite3 ../youjay.db "SELECT videoid FROM playlist ORDER BY id;" | head -1);
		rm -v $idold.mp4
		sqlite3 ../youjay.db "delete from playlist where videoid = '$idold'"
	fi
done
