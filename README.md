Uzdevuma izpildei izmantoju MySQL, Symfony un Angular
Uzreiz gribu minet, ka ieprieks nebiju stradajis ar Symfony un MariaDB serveri. MariaDB ari nepaspeju apskatit, tapec izmantoju phpmyadmin db, kura bija pacelta ar easyPHP vidi.
1) izveleta MySQL serveri izveidot DB ar sql scriptu 'CREATE DATABASE exchange'
2) ieks mapes currency-tracker-server jaatrod failu .env failu
3) salikt parametru vertibas
    DB_USER=
    DB_PASSWORD=
    DB_HOST=
    DB_PORT=
    parametru DB_NAME nav jamaina
4) atvert cmd
5) ieks consoles navigacija uz 'currency-tracker-server'
6) palaist backEnd dalu ar comandu 'php -S 127.0.0.1:8000 -t public'
7) atvert otro cmd
8) ieks consoles navigacija uz 'currency-tracker-client-ng'
9) 'npm install' lai dabutu paketes
10) 'ng serve --open' lai palaistu FrontEnd Angular dalu
11) crop.php kuru var atrast ieks root mapes ir cronjob
12) pirms palaisanas failu jaatver un jasaliek parametrus 
define('DB_SERVER', '127.0.0.1');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'exchange');