$SEL = Select-String -Path C:\xampp\apache\conf\httpd.conf -Pattern "C:/xampp/htdocs/Julet"
if ($SEL -ne $null)
{
    echo Contains String
    return 1
}
else
{
    (Get-Content C:\xampp\apache\conf\httpd.conf).Replace('C:/xampp/htdocs', 'C:/xampp/htdocs/Julet') | Set-Content C:\xampp\apache\conf\httpd.conf
    return $SEL
}