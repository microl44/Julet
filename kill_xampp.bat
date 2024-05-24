tasklist /fi "ImageName eq xampp-control.exe" /fo csv 2>NUL | find /I "xampp-control.exe">NUL
if "%ERRORLEVEL%"=="0" echo xampp-control.exe dead

tasklist /fi "ImageName eq httpd.exe" /fo csv 2>NUL | find /I "httpd.exe">NUL
if "%ERRORLEVEL%"=="0" echo httpd.exe dead

tasklist /fi "ImageName eq mysqld.exe" /fo csv 2>NUL | find /I "mysqld.exe">NUL
if "%ERRORLEVEL%"=="0" echo mysqld.exe dead

pause