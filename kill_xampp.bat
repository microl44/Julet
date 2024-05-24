tasklist /fi "ImageName eq xampp-control.exe" /fo csv 2>NUL | find /I "xampp-control.exe">NUL
if "%ERRORLEVEL%"=="0" echo Program is running