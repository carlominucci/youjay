#!/bin/bash
clear
echo "Youjay download daemon starting..."
mkdir tmp
cd tmp
while :
do
	download=$(sqlite3 ../youjay.db "SELECT videoid FROM playlist WHERE download = 'FALSE'" | head -1);
	title=$(sqlite3 ../youjay.db "SELECT title FROM playlist WHERE videoid ='$download'");
	echo "1" > $download.srt
	echo "00:00:02,000 --> 00:00:10,000" >> $download.srt
	echo $title >> $download.srt
	if [ $download ] ; then
		echo $download
		youtube-dl --id http://youtube.com/watch?v=$download
		sqlite3 ../youjay.db "UPDATE playlist SET download = 'TRUE' WHERE videoid = '$download'"
	fi
	echo "   "
	sleep 5;
	df=$(df -h | head -2 | tail -1 | awk '{print $5}' | tr -d "%")
	if [ $df -gt "90" ] ; then
		echo "delete most old video..."
		idold=$(sqlite3 ../youjay.db "SELECT videoid FROM playlist ORDER BY id;" | head -1);
		rm -v $idold.mp4
		sqlite3 ../youjay.db "delete from playlist where videoid = '$idold'"
	fi
done
