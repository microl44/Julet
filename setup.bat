@ECHO OFF
if not "%1"=="am_admin" (
    powershell -Command "Start-Process -Verb RunAs -FilePath '%0' -ArgumentList 'am_admin'"
    exit /b
)

set "DB_CONN=mysql:dbname=Jul;host=localhost;port=3306;"
set "DB_USERNAME=root"
set "DB_PASSWORD=tinytiger997"

C:\xampp\mysql\bin\mysql.exe -u %DB_USERNAME% -p%DB_PASSWORD% -h localhost -e "DROP DATABASE IF EXISTS Jul; CREATE DATABASE Jul; USE Jul; CREATE TABLE users (id int NOT NULL AUTO_INCREMENT, username varchar(50) NOT NULL, email varchar(255) NOT NULL, password varchar(255) NOT NULL, PRIMARY KEY (id)) Engine = InnoDB; CREATE INDEX username ON users(username); INSERT INTO users(username, email, password) VALUES ('user', 'usermail@gmail.com', 'password'), ('admin', 'adminmail@gmail.com', ''),('micke', 'mickemail@gmail.com', 'password'), ('gabbe', 'gabbemail@gmail.com', 'password'),('crippe', 'crippemail@gmail.com', 'password'), ('behrad', 'behradmail@gmail.com', 'password'), ('linus', 'linusmail@gmail.com', 'password'), ('momme', 'mommemail@gmail.com', 'password'), ('doffe', 'doffemail@gmail.com', 'password');"

Powershell.exe -executionpolicy remotesigned -File C:\xampp\htdocs\Julet\setup.ps1

setx "DB_CONN" "mysql:dbname=Jul;host=localhost;port=3306;" /m
setx "DB_USERNAME" "root" /m
setx "DB_PASSWORD" "tinytiger997" /m
setx "PATH" "%PATH%;C:\xampp\htdocs\Julet" /m

pause