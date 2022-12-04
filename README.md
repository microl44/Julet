# Julet
Website visualizing data from my watched movies, brought forward by julet.

"Wheel giveth, Wheel taketh" - Abraham Lincoln

### COLOR SCHEMES THAT SHOULD BE USED
- ![#bbcadb](https://placehold.co/30x30/bbcadb/bbcadb.png) `#bbcadb`
- ![#BAC3E8](https://placehold.co/30x30/BAC3E8/BAC3E8.png) `#BAC3E8`
- ![#9CC5E0](https://placehold.co/30x30/9CC5E0/9CC5E0.png) `#9CC5E0`
- ![#5397EE](https://placehold.co/30x30/5397EE/5397EE.png) `#5397EE`
- ![#3B7DD5](https://placehold.co/30x30/3B7DD5/3B7DD5.png) `#3B7DD5`

## Installation. 

The app has been tested and utilized xampp for testing. 
The guide will explain based on xampp structure on windows 10, 

- Install xampp using standard instructions. 
- Clone the repository in teh htdocs folder. 

Once installed create an empty database file. 

Needs to create a file called Database.php file in the top of the repository.  

Database.php requires the following function 
´´´
<?php
    function getConnectionString(){
        return "mysql:dbname=$DatabaseFileName;host=$ServerConnectionAddress";
    }
?>
´´´
where the variables are replaced with the following:
- $DatabaseFileName = the Name of the database file created. 
- $ServerConnectionAddress = the Ip address or localhost of the sqlserver

Once done start apache and navigate to *https://localhost/julet*
- assuming the server is on localhost. 
logg in at the navigation bar. 
- navigate to *https://localhost/julet/install.php*

Once the text pops up it is done and the installation is complete.