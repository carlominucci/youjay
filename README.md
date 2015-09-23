# youjay

Con *youjay* tutti diventano un unico dj.

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

## Requisiti di sistema ##
Serve un server web con installato *php5* e il supporto a *sqlite3*.
Inoltre bisogna installare [youtube-dl](https://github.com/rg3/youtube-dl) 

## Ringraziamenti ##
* Riccardo Mariani: per il brainstorming, la proprietà intellettuale e il casual testing.
* Rodolfo Brocchini: per la disponibilità della casa per le cene.
* Fabio Napodano: per il dummy test e per l'email.

## Problemi noti ##
Pare che, per motivi misteriosi, non giri sui server di altervista.
