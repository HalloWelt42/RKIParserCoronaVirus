# Autoloader-PSR-4
## Beschreibung

Dieses Beispiel dient als Schnell-Vorlage für den Start mit einem Autoload-Mechanismus nach PSR-4-Standard.
Loslegen kannst Du mit der Programmierung von der Klasse [App](src/App.php) aus.


* Quelle: https://www.php-fig.org/psr/psr-4/ 

## Merkmale:
* nur ein öffentlich sichtbares Verzeichnis [src/public](src/public) mit der einzigen Datei [index.php](src/public/index.php)  

## Vorteil:
Beim Absturz oder einer Fehlkonfiguration des Servers sind die kritischen Pfade, in den PHP liegt nicht öffentlich erreichbar.

