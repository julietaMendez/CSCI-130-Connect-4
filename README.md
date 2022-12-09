# CSCI-130-Connect-4
---
Project contributors: Julie Mendez and Malee Seechan

## User Setup :
First, ensure that XAMPP Apache and MySQL are both running. On the XAMPP control panel, click on Admin to be directed to your localhost. 

Click on phpMyAdmin and create a new user account with all privileges. The account information will be needed to update credentials in the db_credientials.ini file located in the database folder.

server='localhost'  
username='\<username\>'  
password='\<password\>'  
dbname='connect4_db'
<br /><br />
## Database creation :
Go to localhost/CSCI-130-Connect-4/ in your browser to see the directory of folders. Select the database folder and run the init_db.php file to create the database and player table.
<br /><br />
## Create an Account :
Return to the parent directory and select the login folder. Open login_register_page.php to be directed to the homepage. Create a new user account by providing a username and password. After your user account is created, you will be routed to the homepage where you can read play a game of connect 4, instructions on connect 4, check out the leaderboard, see contact information or log out.
<br /><br />
## Play Connect 4 :
On the game options page, both players will select their chip colors, the board color and select between 2 board sizes: 6x7 or 8x9. Press start to continue to the game page to begin playing. The game page will have information on the right side. This includes, which player's turn it is, game stats, and a live timer to document the length of the game. 

