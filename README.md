# youjay

Con *youjay* tutti diventano un unico dj.

Presenti alla Maker Faire 2015 di Rimini
![Maker Faire Rimini](https://static.wixstatic.com/media/efa623_ccdf135099c34702a6e9c068b8415a88.gif)

## Concetto ##
*youjay* è un jukebox gratuito usabile da smartphone tramite comoda webapp, non c'è bisogno di installare nulla sul telefono.
Ogni utente, tramite la funzione di ricerca, può aggiungere una o più canzoni alla playlist del server centralizzato, che può
essere un banale computer con un browser.

## Utilità ##
*youjay* può essere usato per feste o cene con amici in cui non sia presente un dj. In cui tutti hanno da suggerire canzoni da ascoltare. 

## Installazione  e utilizzo##
Per installare *youjay* è sufficiente copiare i file *.php* e il file *.db* in una directory del server web.
Poi bisogna lanciare lo script *download.sh* che è il demone che gestisce il download trasparente in brackground dei brani da youtube.
Il file *player.sh* va lanciato a mano in modo da visualizzare sul monitor i video.
Se non funziona regorlamente bisogna dare i permessi *777* al file *youjay.db*.

## Requisiti di sistema ##
Un server web con installato *php5*, *php5-curl*, *php5-sqlite3 e il client *sqlite3* per la riga di comando.
Installare [youtube-dl](https://github.com/rg3/youtube-dl).

Per il player standalone serve che ci sia installato *mplayer*.

Per il player web serve un browser che supporti *html5*.

## Ringraziamenti ##
* Riccardo Mariani: per il brainstorming, la presunta proprietà intellettuale, il casual testing e il foglio di stile.
* Rodolfo Brocchini: per la disponibilità della casa per le cene.
* Fabio Napodano: per il dummy test e per l'email.

## Problemi noti ##
Pare che, per motivi misteriosi, non giri sui server di altervista.
