# lw_simpledownload Plugin

## Einführung

Das lw_simpledownload-Plugin bietet eine einfache Möglichkeit, Dateien, die in Form von Elementen (Items) vorhanden sind, zum Download bereitzustellen.

Standardmässig werden vom lw_simpledownload-Plugin alle Dateien angeboten, die zum einen als Element auf der eigenen Seite vorhanden sind und zum anderen (zumindest) das Keyword 'lw_download' haben.

## Einbindung

Das Plugin wird durch den Aufruf

	[PLUGIN:lw_simpledownload]
	
auf der Seite eingebunden.

## Parameter

Es können drei Parameter angegeben werden: die Seite, von der sich das Plugin die Datei-Elemente zieht, der anzuzeigende Datetyp (pdf, png, doc, etc) und das Keyword, das anzuzeigende Datei-Elemente kennzeichnet.

### Beispiel:

	[PLUGIN:lw_simpledownload?source=34]
	
bietet alle mit 'lw_download' gekennzeichnete Datei-Elemente der Seite mit der Index-Nummer 34 zum Download an.

	[PLUGIN:lw_simpledownload?keyword=PDF]
	
bietet alle mit 'PDF' gekennzeichnete Datei-Elemente zum Download an.

	[PLUGIN:lw_simpledownload?source=172&keyword=PDF]
	
bietet alle mit 'PDF' gekennzeichnete Datei-Elemente der Seite mit der Index-Nummer 172 zum Download an.

	[PLUGIN:lw_simpledownload?filetype=pdf]
	
bietet alle mit 'lw_download' gekennzeichneten Datei-Elemente an, die den Filetyp "pdf" haben.

## CSS-IDs und Klassen

Die Ausgabe des Plugins ist zuerst durch ein DIV der Klasse

	lw_simpledownload
	
und der ID

	lw_simpledownload_OID
	
umschlossen, wobei OID die ID des Contentobjekts ist. Dadurch lassen sich sowohl alle Download-Listen als auch eine spezielle leicht per CSS ansprechen.

Die Liste (UL-Element) ist auch durch die Klasse

	lw_simpledownload_list
	
erreichbar.

Jedes Listitem der UL hat die Klasse

	lw_simpledownload_listitem
	
und entsprechend des FILETYPEs die Klasse
	
	lw_simpledownload_filetype_FILETYPE
	
(wobei FILETYPE hier für 'pdf', 'doc', 'png' o.ä. steht).

Zudem ist jedes Listitem über eine ID

	lw_simpledownload_listitem_OID_X
	
ansprechbar, wobei OID für die ID des Contentobjekts steht und X für das X-te Element in der Liste.

Zudem ist jeder Link in der Liste über die Klasse

	lw_simpledownload_listitem_link
	
ansprechbar und über die ID

	lw_simpledownload_listitem_link_OID_X
	
wobei OID für die ID des Contentobjekts steht und X für das X-te Element in der Liste.

Außerdem wird nach jedem Link ein span eingefügt, in dem die Dateigröße angegeben wird. Dieser kann über die Klasse

	lw_simpledownload_listitem_filesize
	
angesprochen werden.

## Debugging

### Keine Dateien gefunden

Wenn keine Datei-Elemente gefunden wurden, wird als Kommentar

	<!-- no files -->
	
auf der Seite ausgegeben.

