if not "%1"=="am_admin" (
    powershell -Command "Start-Process -Verb RunAs -FilePath '%0' -ArgumentList 'am_admin'"
    exit /b
)

tasklist /fi "ImageName eq xampp-control.exe" /fo csv 2>NUL | find /I "xampp-control.exe">NUL
if "%ERRORLEVEL%"=="0" taskkill /F /IM xampp-control.exe

tasklist /fi "ImageName eq httpd.exe" /fo csv 2>NUL | find /I "httpd.exe">NUL
if "%ERRORLEVEL%"=="0" taskkill /F /IM httpd.exe

tasklist /fi "ImageName eq mysqld.exe" /fo csv 2>NUL | find /I "mysqld.exe">NUL
if "%ERRORLEVEL%"=="0" taskkill /F /IM mysqld.exe

pause