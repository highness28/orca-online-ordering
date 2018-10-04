# orca-online-ordering

Project Requirements:
1) xampp with PHP 7.2 or later (https://www.apachefriends.org/download.html)
2) node LTS version (https://nodejs.org/en/download/)

Instructions:
1) Clone to the projec to your htdocs folder (located inside c:/xampp) using https and not ssh
2) Open Git Bash terminal to the folder location
3) You should be able to see "/c/xampp/htdocs/orca-online-ordering (master)" this text in your git bash terminal
4) Type "git checkout develop" and hit enter
5) Type "git pull" and hit enter
6) Type "composer install" and hit enter
7) After installing all the dependencies type "php artisan serve" and hit enter
8) Open browser and type in the address "localhost:8000" then hit enter
9) You should be able to see the Laravel text (this page will be updated along with the project)
10) Click login on top right of the project

Database Setup:
1) Import the .sql file found in the database folder of this project
2) Please uncheck foreign key checking when importing
3) Open the .env file in the root folder of this project.
4) Change these lines of code to match your server
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=orca
DB_USERNAME=root
DB_PASSWORD=1234
```
5) Change the Mailing Service Account (gmail only). here you will have to put your gmail email and password (yes your gmail password). This will be the sender of all the notifications from the system (Please create an account for Orite Copier and Supplies)
```
MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=YOUR_GMAIL_EMAIL
MAIL_PASSWORD=YOUR_GMAIL_PASSWORD
```
