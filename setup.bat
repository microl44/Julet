@echo off

set "search=C:/xampp/htdocs"
set "replace=C:/xampp/htdocs/Julet"
set "textFile=C:\xampp\apache\conf\httpd.conf"

setx DB_CONN "mysql:dbname=Jul;host=localhost;port=3306;"
setx DB_USERNAME "root"
setx DB_PASSWORD "tinytiger997"

setlocal enableextensions disabledelayedexpansion

C:\xampp\mysql\bin\mysql.exe -u %DB_USERNAME% -p%DB_PASSWORD% -h localhost -e "DROP DATABASE IF EXISTS Jul; CREATE DATABASE Jul; USE Jul; CREATE TABLE users (id int NOT NULL AUTO_INCREMENT, username varchar(50) NOT NULL, email varchar(255) NOT NULL, password varchar(255) NOT NULL, PRIMARY KEY (id)) Engine = InnoDB; CREATE INDEX username ON users(username); INSERT INTO users(username, email, password) VALUES ('user', 'usermail@gmail.com', 'password'), ('admin', 'adminmail@gmail.com', ''),('micke', 'mickemail@gmail.com', 'password'), ('gabbe', 'gabbemail@gmail.com', 'password'),('crippe', 'crippemail@gmail.com', 'password'), ('behrad', 'behradmail@gmail.com', 'password'), ('linus', 'linusmail@gmail.com', 'password'), ('momme', 'mommemail@gmail.com', 'password'), ('doffe', 'doffemail@gmail.com', 'password');"
for /f "delims=" %%i in ('type "%textFile%" ^& break ^> "%textFile%" ') do (
    set "line=%%i"
    setlocal enabledelayedexpansion
    if "%line%" == "C:/xampp/htdocs/Julet"(
        echo "Root dir already fixed, nothing to do...
        exit 0
    )
    >>"%textFile%" echo(!line:%search%=%replace%!
    endlocal
)
pause