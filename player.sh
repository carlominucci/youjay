#!/bin/bash
video=$(sqlite3 youjay.db "SELECT videoid,title FROM playlist WHERE play = 'FALSE' AND download ='TRUE';" | cut -d"|" -f 1)
mplayer /tmp/$video.*
sqlite3 youjay.db "UPDATE playlist SET play = 'TRUE' WHERE videoid = '$video';"
