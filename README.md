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

This website complies with the rules, guidelines and instructions provided by the General Data Protection Regulation (GDPR). https://eur-lex.europa.eu/legal-content/EN/TXT/PDF/?uri=CELEX:32016R0679. Any saving of private data (not using the two freely availible accounts) is in according to article 6, section f, stating: "processing is necessary for the purposes of the legitimate interests pursued by the controller or by a third party, except where such interests are overridden by the interests or fundamental rights and freedoms of the data subject which require protection of personal data, in particular where the data subject is a child.".

The creator and contributors takes no responsibility for any code that's stolen, changed and hosted by 3rd party users.
