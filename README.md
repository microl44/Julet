# Currently Work in Progress. Current main priority: Implementing REST API and refactoring.

Now has biblically accurate angels.  
![image](https://user-images.githubusercontent.com/71311176/210680435-0c2739ec-6a2b-4bb7-8113-8ecadfca4d10.png)

# Julet
Website visualizing data from my watched movies, brought forward by julet.

"Wheel giveth, Wheel taketh" - Abraham Lincoln

# Announcement:
#### We did it guys! 5000 lines of code and only 15% is css!

# Coding Standards

## Indentation:
Code indentation should prefferably use the c# standard cause c# is a good language. An example is as follows:
  ```
  if(condition)
  {
    // place code here
  }
  ```
  One-liners should prefferably use same line for opening, code and closing syntax. An example is as follows:
  ```
  if(condition)
  { // place code here }
  ```
  PHP and HTML code in combination should prefferably use closing PHP closing tags, followed by plain HTML, rather than echoing large blocks of HTML.
  However, heavily-integrated PHP where there's less than 4 lines of plain HTML in a row can instead be echoed out if needed.
  In such a case, echo function should be used on each individual line. An example is as follows:
  ```
  <?php
  echo "<div>";
    echo "<div>";
      echo $phpVar;
    echo "</div>";
  echo "</div>";
  ?>
  <div>
    <div>
      <div>
        <form>
          <input > </input>
          <?php 
          echo "<label for $inputElementName />";
          ?>
        </form>
      </div
    </div>
  </div>
  ```
## Colors to be used:
- ![#bbcadb](https://placehold.co/30x30/bbcadb/bbcadb.png) `#bbcadb`
- ![#BAC3E8](https://placehold.co/30x30/BAC3E8/BAC3E8.png) `#BAC3E8`
- ![#9CC5E0](https://placehold.co/30x30/9CC5E0/9CC5E0.png) `#9CC5E0`
- ![#5397EE](https://placehold.co/30x30/5397EE/5397EE.png) `#5397EE`
- ![#3B7DD5](https://placehold.co/30x30/3B7DD5/3B7DD5.png) `#3B7DD5`

Other color-values can be used if documented appropriately 

# Installation. 

The app has been tested and utilized xampp for testing. 
The guide will explain based on xampp structure on windows 10, 

- Install xampp using standard instructions. 
- Clone the repository in the htdocs folder. 

Once installed, run the install.php script. 
- navigate to *https://localhost/Julet/install.php*

Logg in using the mysql info 
Default username is *root* empty password

# GDPR

This website complies with the rules, guidelines and instructions provided by the General Data Protection Regulation (GDPR). https://eur-lex.europa.eu/legal-content/EN/TXT/PDF/?uri=CELEX:32016R0679. Any processing of private data (not using the two freely availible accounts) is in according to article 6, section f.

The creator and contributors takes no responsibility for any code that's stolen, changed or hosted by 3rd party users. Please view "policy.php" for additional instructions on how data is processed.

In case any external user wants to deploy their own copy of Julet, the following steps must be taken to comply with article 5, section e. The user has to set up a system in which private data is periodically removed. This includes any cookies saved and data within the "activity_log" table of the resulting database. Easy ways to accomplish this is to use cronJob for linux deployments, or the Task Scheduler app on windows deployments.
Open the Task Scheduler by typing "Task Scheduler" into the Start menu search bar and selecting the app.

1. In the Task Scheduler window, click the "Create Basic Task" option in the Actions pane on the right.
2. In the Create Basic Task Wizard, enter a name for the task and a description (optional), then click the "Next" button.
3. On the next page, select the trigger for the task. For example, you can choose to run the task daily, weekly, or at a specific time.
4. On the next page, select the action for the task. Choose "Start a program" as the action, then click the "Next" button.
5. On the next page, enter the path to the MySQL executable file (e.g. "C:\Program Files\MySQL\MySQL Server 8.0\bin\mysql.exe") in the "Program/script" field, and enter the following command in the "Add arguments (optional)" field:
  -u [username] -p[password] Jul -e "DELETE FROM activity_log WHERE timestamp < DATE_SUB(NOW(), INTERVAL 30 DAY);"

In regards to article 6, section f: the only purpose of processed data is to identify, discourage and prevent malicious usage. Only strictly necessary information to accomplish this purpose is processed and saved. Any data processed is stored for 30 days, after which it's then deemed not necessary for said cause and deleted.

Article 5, section e: 
"kept in a form which permits identification of data subjects for no longer than is necessary for the purposes for which the personal data are processed; personal data may be stored for longer periods insofar as the personal data will be processed solely for archiving purposes in the public interest, scientific or historical research purposes or statistical purposes in accordance with Article 89(1) subject to implementation of the appropriate technical and organisational measures required by this Regulation in order to safeguard the rights and freedoms of the data subject (‘storage limitation’);".

Article 6, section f:
"processing is necessary for the purposes of the legitimate interests pursued by the controller or by a third party, except where such interests are overridden by the interests or fundamental rights and freedoms of the data subject which require protection of personal data, in particular where the data subject is a child.".
