
# Log in to DevSeq server (Cambridge)
ssh ubuntu@128.232.226.206
apach

# Restart server (it will take one or two minutes to restart and until login is possible again)
sudo reboot now


# ------------------------------------------ #
# Install available Ubuntu updates and MySQL
# ------------------------------------------ #

# Install available Ubuntu repo updates
sudo apt update
sudo apt upgrade

# Install MySQL Server
sudo apt install mysql-server

# Check MySQL version (recently installed is mysql Ver 8.0.33-0ubuntu0.20.04.2 for Linux on x86_64 ((Ubuntu)))
mysql --version


# ------------------------------- #
# Configure the MySQL Installation
# ------------------------------- #

### 1 - Modify some less secure default options by running the included DBM security script ###
sudo mysql_secure_installation

# Now, select password strength 2 (most secure)
2

# In new shell tap, log in to server again, than start MySQL
sudo mysql

# Define password for the MySQL ROOT USER
ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password by 'Tr21zMP26#r';

# Now, run again the DBM security script (log in to DevSeq server again new tab, then run:)
sudo mysql_secure_installation

# Enter the new MySQL database password
Tr21zMP26#r

# Answer all following questions with "YES" to finish security settings
YES

# All done!

# Then, reset to default MySQL authentification method
mysql -u root -p

# Enter MySQL password
Tr21zMP26#r

# Enter the following to go back to default authentication method
ALTER USER 'root'@'localhost' IDENTIFIED WITH auth_socket;


### 2 - Add a dedicated MySQL user ###

# Open DevSeq server in new tap, log in and then leverage MySQL with sudo privileges
sudo mysql

# Create a new user (bilbo)
CREATE USER 'bilbo'@'localhost' IDENTIFIED WITH mysql_native_password BY 'P#Q25rNL21m';

# Grant the following privileges to user bilbo:
GRANT CREATE, ALTER, DROP, INSERT, UPDATE, DELETE, SELECT, REFERENCES, RELOAD on *.* TO 'bilbo'@'localhost' WITH GRANT OPTION;

# OR, to grant all privileges to the user, run:
GRANT ALL PRIVILEGES ON *.* TO 'bilbo'@'localhost' WITH GRANT OPTION;

# Free up any cached memory on server
FLUSH PRIVILEGES;

# Exit MySQL client
exit

# To log in as user bilbo, use the following comment:
mysql -u bilbo -p

# Enter password
P#Q25rNL21m


### 3 - Check if MySQL server is running

# Test MySQL connection (status should be "Server is operational")
systemctl status mysql.service

# output:
#> ● mysql.service - MySQL Community Server
#>     Loaded: loaded (/lib/systemd/system/mysql.service; enabled; vendor preset: enabled)
#>     Active: active (running) since Tue 2023-06-13 17:52:13 UTC; 1h 22min ago
#>   Main PID: 2245 (mysqld)
#>     Status: "Server is operational"
#>      Tasks: 40 (limit: 19170)
#>     Memory: 368.2M
#>     CGroup: /system.slice/mysql.service
#>             └─2245 /usr/sbin/mysqld

#>Jun 13 17:52:11 test systemd[1]: Starting MySQL Community Server...
#>Jun 13 17:52:13 test systemd[1]: Started MySQL Community Server. 

# If MySQL server is not operational, start it as follows using mysqladmin:
sudo mysqladmin -p -u bilbo version


### 4 - log in to MySQL database as root user to generate databases etc.
sudo mysql -u root -p


# ------------------------------- #
# Set up LAMP stack
# ------------------------------- #

### 1 - Adjust Apache firewall settings to allow HTTP traffic

# Install Apache (if not already installed)
sudo apt install apache2 openssl

# Check which Apache version is installed
apachectl -v
#> Server version: Apache/2.4.41 (Ubuntu)
#> Server built:   2023-03-08T17:32:54

# Enabling Mod_SSL and Mod_Rewrite Modules
sudo a2enmod ssl
sudo a2enmod rewrite

# Use Ubuntu's Uncomplicated FireWall (UFW) configuration tool to show all available profiles:
# First check if UFW is enabled (it is inactive at first)
sudo ufw status
#> Status: inactive

# Enable UFW
sudo ufw enable
#> Firewall is active and enabled on system startup

# Check UFW status again
sudo ufw status
#> Status: active

sudo ufw app list
#> Available applications:
#>  Apache
#>  Apache Full
#>  Apache Secure
#>  OpenSSH

# Here’s what each of these profiles mean:
#    Apache: This profile opens only port 80 (normal, unencrypted web traffic).
#    Apache Full: This profile opens both port 80 (normal, unencrypted web traffic) and port 443 (TLS/SSL encrypted traffic).
#    Apache Secure: This profile opens only port 443 (TLS/SSL encrypted traffic).

sudo ufw allow in "Apache"
sudo ufw allow in "Apache Full"

# Optional: Allow All Incoming HTTP (port 80)
sudo ufw allow http
# OR
sudo ufw allow 80
#> Rule added
#> Rule added (v6)

# Optional: Allow All Incoming HTTP (port 80)
sudo ufw allow https
# OR
sudo ufw allow 443
#> Rule added
#> Rule added (v6)

# Verify the change with:
sudo ufw status

#> Status: active

#> To                         Action      From
#> --                         ------      ----
#> OpenSSH                    ALLOW       Anywhere                  
#> 80/tcp                     ALLOW       Anywhere                  
#> 443/tcp                    ALLOW       Anywhere                  
#> 80,443/tcp                 ALLOW       Anywhere                  
#> Apache                     ALLOW       Anywhere                  
#> Apache Full                ALLOW       Anywhere                  
#> OpenSSH (v6)               ALLOW       Anywhere (v6)             
#> 80/tcp (v6)                ALLOW       Anywhere (v6)             
#> 443/tcp (v6)               ALLOW       Anywhere (v6)             
#> 80,443/tcp (v6)            ALLOW       Anywhere (v6)             
#> Apache (v6)                ALLOW       Anywhere (v6)             
#> Apache Full (v6)           ALLOW       Anywhere (v6)

# Install the following tools - they can check if http request is reaching server
sudo apt install tcpdump
sudo apt install wireshark

# Now, check if server can be accessed via browser:
http://your_server_ip

# So for the Cambridge DevSeq server use
http://128.232.226.206


### 2 - Install PHP and packages required to run PHP on Apache

# Install the following packages:
# a) php package
# b) libapache2-mod-php (will enable Apache to handle PHP files)
# c) php-mysql (PHP module that allows PHP to communicate with MySQL database)
sudo apt install php libapache2-mod-php php-mysql

# Check installed PHP version
php -v
#> PHP 7.4.3-4ubuntu2.18 (cli) (built: Feb 23 2023 12:43:23) ( NTS )
#> Copyright (c) The PHP Group
#> Zend Engine v3.4.0, Copyright (c) Zend Technologies
#>     with Zend OPcache v7.4.3-4ubuntu2.18, Copyright (c), by Zend Technologies

### 3 - Set up virtual host

# Create a directory for DevSeqPlant domain
sudo mkdir /var/www/devseqplant.org/

# Assign ownership of the directory
sudo chown -R $USER:$USER /var/www/devseqplant.org

# Now, open a new empty configuration file and edit it with a command-line editor (use nano)
sudo nano /etc/apache2/sites-available/devseqplant.org.conf

# Add the following to the config file (paste it in terminal)
<VirtualHost *:80>
    ServerName devseqplant.org
    ServerAlias www.devseqplant.org 
    ServerAdmin webmaster@localhost
    DocumentRoot /var/www/devseqplant.org
    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>

# Save and close the file when you’re done. If you’re using nano, 
# do that by pressing CTRL+X, 
# then Y and ENTER

# Use a2ensite to enable new virtual host
sudo a2ensite devseqplant.org

# Disable Apache's default website
sudo a2dissite 000-default

# Check if configuration is correct and does not contain syntax errors
sudo apache2ctl configtest

# Reload Apache webserver
sudo systemctl reload apache2

# Now create an index.html as default page
nano /var/www/devseqplant.org/index.html

# To remove index.html file, execute:
sudo rm /var/www/devseqplant.org/index.html

# Include the following content to the index file:
<html>
  <head>
    <title>devseqplant.org website</title>
  </head>
  <body>
    <h1>The DevSeq Project</h1>

    <p>This is the landing page of <strong>devseqplant.org</strong>.</p>
  </body>
</html>

# Save and close the file when you’re done. If you’re using nano, 
# do that by pressing CTRL+X, 
# then Y and ENTER


# Set index.php as default index file (instead of index.html)
sudo nano /etc/apache2/mods-enabled/dir.conf
# Change the order to:
#> <IfModule mod_dir.c>
#>         DirectoryIndex index.php index.html index.cgi index.pl index.xhtml index.htm
#> </IfModule>

# Save and close the file when you’re done. If you’re using nano, 
# do that by pressing CTRL+X, 
# then Y and ENTER

# Reload Apache server
sudo systemctl reload apache2

# Create a blank info.php file
nano /var/www/devseqplant.org/info.php

# Add the following: 
<?php
phpinfo();

# Save and close the file when you’re done. If you’re using nano, 
# do that by pressing CTRL+X, 
# then Y and ENTER

# Check in webbrowser if http://devseqplant.org/info.php is working => YES
# Remove php file from Apache server (it contains sensitive information)

sudo rm /var/www/devseqplant.org/info.php



### 4 - Install Python3 and required packages

# Install python3
sudo apt-get install python3.10

# Check installed version
python3 --version
#> Python 3.8.10

# Install pip to allow installation of python3 packages in terminal
sudo apt install python3-pip

# Install python packages
pip install numpy
#> Successfully installed numpy-1.24.3
pip install scipy
#> Successfully installed scipy-1.10.1



# --------------------------- #
# Testing database connection
# --------------------------- #

# Connect to MySQL on server
sudo mysql

# Create a new blank database
CREATE DATABASE example_database;

# Show databases
SHOW DATABASES;

# Create test table in example_database named todo_list
CREATE TABLE example_database.todo_list (
  item_id INT AUTO_INCREMENT,
  content VARCHAR(255),
  PRIMARY KEY(item_id)
);

# Select a database:
USE example_database;

# Show all tables in selected database:
SHOW Tables;

# To delete table use:
DROP TABLE todo_list;

# Create a few rows of content
INSERT INTO example_database.todo_list (content) VALUES ("Apache/2.4 ports configured");
INSERT INTO example_database.todo_list (content) VALUES ("MySQL v.8.0 database installed");
INSERT INTO example_database.todo_list (content) VALUES ("Python v.3.8 numpy/scipy installed");
INSERT INTO example_database.todo_list (content) VALUES ("PHP v.7.4 installed and running");
INSERT INTO example_database.todo_list (content) VALUES ("Loading JavaScript src from server: OK");
INSERT INTO example_database.todo_list (content) VALUES ("DevSeq DNS records updated");

# Confirm content
SELECT * FROM example_database.todo_list;

# Exit MySQL console
exit

# Create PHP script that will connect to MySQL example_database
nano /var/www/devseqplant.org/index.php

# Add the following content to the index.php script:
<?php
$user = "bilbo";
$password = "P#Q25rNL21m";
$database = "example_database";
$table = "todo_list";

try {
  $db = new PDO("mysql:host=localhost;dbname=$database", $user, $password);
  echo "<h2>The DevSeq Project</h2><ol>"; 
  foreach($db->query("SELECT content FROM $table") as $row) {
    echo "<li>" . $row['content'] . "</li>";
  }
  echo "</ol>";
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

# Save and close the file when you’re done. If you’re using nano, 
# do that by pressing CTRL+X, 
# then Y and ENTER



# ------------------------------------------ #
# Store JavaScript libraries on DevSeq server
# ------------------------------------------ #

# Move to DevSeq directory
cd /var/www/devseqplant.org/

# Make js folder
mkdir js

# Make js library subfolders
cd /var/www/devseqplant.org/js
mkdir c3
mkdir d3

# Remote-transfer files securely using SCP via SSH (open another terminal Tab)
cd /Applications/XAMPP/xamppfiles/htdocs/D3js_C3js_source/c3
scp c3.min.js ubuntu@128.232.226.206:/var/www/devseqplant.org/js/c3
scp c3.min_CS_settings10.css ubuntu@128.232.226.206:/var/www/devseqplant.org/js/c3

cd /Applications/XAMPP/xamppfiles/htdocs/D3js_C3js_source/d3
scp d3.min.js ubuntu@128.232.226.206:/var/www/devseqplant.org/js/d3




# ------------------------------------------ #
# Make some interactive test chart 
# ------------------------------------------ #

# Create PHP script that will connect to MySQL example_database
nano /var/www/devseqplant.org/index.php

# Add the following content to the index.php script:

<?php
$user = "bilbo";
$password = "P#Q25rNL21m";
$database = "example_database";
$table = "todo_list";

error_reporting(E_ALL);
ini_set('display_errors', '1');

try {
  $db = new PDO("mysql:host=localhost;dbname=$database", $user, $password);
  echo "<h2>The DevSeq Project Test Page</h2><ol>"; 
  foreach($db->query("SELECT content FROM $table") as $row) {
    echo "<li>" . $row['content'] . "</li>";
  }
  echo "</ol>";
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

?>

<!-- ***********************************************************************
Setting up HTML "Head/Style" options
************************************************************************ -->

<html>
<html lang="en">
  <meta http-equiv="content-type" content="text/html"; charset="utf-8"/>
  <meta charset="utf-8">
  <meta name="viewport" content="width=1024, user-scalable=yes">
  <meta name="Description" content="DevSeq plant web application: Plant comparative transcriptomics, plant gene expression evolution, expression atlas, isoforms, lncRNAs and circRNAs">


<head>

  <title>DevSeq | Test Page</title>
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="author" content="Christoph Schuster">

<link href="http://www.devseqplant.org/js/c3/c3.min_CS_settings10.css" rel="stylesheet" />

<script src="http://www.devseqplant.org/js/c3/c3.min.js"></script>
<script src="http://www.devseqplant.org/js/d3/d3.min.js"></script>

</head>

<body>

<div id = "chart" style = "width: 90%; height: 270px">
</div>

<script>

var chart = c3.generate({
    data: {
        columns: [
            ['data1', 30, 200, 100, 400, 150, 250],
            ['data2', 50, 20, 10, 40, 15, 25]
        ]
    }
});

setTimeout(function () {
    chart.load({
        columns: [
            ['data1', 230, 190, 300, 500, 300, 400]
        ]
    });
}, 1000);

setTimeout(function () {
    chart.load({
        columns: [
            ['data3', 130, 150, 200, 300, 200, 100]
        ]
    });
}, 1500);

setTimeout(function () {
    chart.unload({
        ids: 'data1'
    });
}, 2000);

</script>

</body>

</html>


# Save and close the file when you’re done. If you’re using nano, 
# do that by pressing CTRL+X, 
# then Y and ENTER



# -------------------------------------------------------------------------- #
# Load expression data on devseq server and import into MySQL database table
# -------------------------------------------------------------------------- #

# Move to DevSeq directory
cd /var/www/devseqplant.org/

# Make js folder
mkdir data

# Make js library subfolders
cd /var/www/devseqplant.org/data
mkdir expr_data

# Allow access to remote mysql-files directory on server (change folder ownership to root user "ubuntu")
sudo chown ubuntu /var/lib/mysql-files
# Enable all permissions on the remote folder:
sudo chmod 777 /var/lib/mysql-files

# Remote-transfer files securely using SCP via SSH (open another terminal Tab)
cd /Users/hobbit/Documents/Christoph/DevSeqPlant_code_20220622/output/data_tables
scp AT_devseq_genes_all_samples.csv ubuntu@128.232.226.206:/var/lib/mysql-files
scp AT_devseq_genes_all_samples_RE.csv ubuntu@128.232.226.206:/var/lib/mysql-files
scp AT_devseq_transcripts_all_samples.csv ubuntu@128.232.226.206:/var/lib/mysql-files
scp AT_devseq_transcripts_all_samples_RE.csv ubuntu@128.232.226.206:/var/lib/mysql-files
scp AT_devseq_replicate_genes.csv ubuntu@128.232.226.206:/var/lib/mysql-files
scp AT_devseq_replicate_genes_RE.csv ubuntu@128.232.226.206:/var/lib/mysql-files
scp AT_devseq_replicate_transcripts.csv ubuntu@128.232.226.206:/var/lib/mysql-files
scp AT_devseq_replicate_transcripts_RE.csv ubuntu@128.232.226.206:/var/lib/mysql-files

# Move files to MySQL mysql-files directory
mv /var/www/devseqplant.org/data/expr_data/devseq_genes_all_samples.csv /var/lib/mysql-files/

# Show current MySQL user:
sudo mysql
SELECT USER();

# Show current user on Apache2 server:
echo "$USER"
#> ubuntu

# Grant ubuntu user all privileges for MySQL (to allow moving data to mysql-files directory)
grant all privileges 
  on devseq.* 
  to 'ubuntu'@'localhost' 
  identified by 'your_password';
> flush privileges; 

# Import data into MySQL database table
sudo mysql
SHOW DATABASES;
USE devseq;
SHOW Tables;

# Import AT expression data
# MySQL will show the following warning: "(...) Data truncated for column (...)"
# Reason: MySQL data table columns were created with only two decimal (e.g. 2.05), but devseq tables have more decimals
# Genes
LOAD DATA INFILE '/var/lib/mysql-files/AT_devseq_genes_all_samples.csv'
INTO TABLE devseq.Arabidopsis_thaliana_gene_tpm_20230625
FIELDS TERMINATED BY ';'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;

# Genes RE
LOAD DATA INFILE '/var/lib/mysql-files/AT_devseq_genes_all_samples_RE.csv'
INTO TABLE devseq.Arabidopsis_thaliana_gene_tpm_RE_20230625
FIELDS TERMINATED BY ';'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;

# Transcripts
LOAD DATA INFILE '/var/lib/mysql-files/AT_devseq_transcripts_all_samples.csv'
INTO TABLE devseq.Arabidopsis_thaliana_transcript_tpm_20230625
FIELDS TERMINATED BY ';'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;

# Transcripts RE
LOAD DATA INFILE '/var/lib/mysql-files/AT_devseq_transcripts_all_samples_RE.csv'
INTO TABLE devseq.Arabidopsis_thaliana_transcript_tpm_RE_20230625
FIELDS TERMINATED BY ';'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;

# Genes replicate
LOAD DATA INFILE '/var/lib/mysql-files/AT_devseq_replicate_genes.csv'
INTO TABLE devseq.Arabidopsis_thaliana_repl_gene_tpm_20230627
FIELDS TERMINATED BY ';'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;

# Genes replicate RE
LOAD DATA INFILE '/var/lib/mysql-files/AT_devseq_replicate_genes_RE.csv'
INTO TABLE devseq.Arabidopsis_thaliana_repl_gene_tpm_RE_20230627
FIELDS TERMINATED BY ';'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;

# Transcripts replicate
LOAD DATA INFILE '/var/lib/mysql-files/AT_devseq_replicate_transcripts.csv'
INTO TABLE devseq.Arabidopsis_thaliana_repl_transcript_tpm_20230627
FIELDS TERMINATED BY ';'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;

# Transcripts replicate RE
LOAD DATA INFILE '/var/lib/mysql-files/AT_devseq_replicate_transcripts_RE.csv'
INTO TABLE devseq.Arabidopsis_thaliana_repl_transcript_tpm_RE_20230627
FIELDS TERMINATED BY ';'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;

# If something goes wrong, delete table and start again:
DROP TABLE Arabidopsis_thaliana_gene_tpm_20230625;

# To check the first two lines of the table:
SELECT * FROM Arabidopsis_thaliana_gene_tpm_20230625 LIMIT 3;


# Transfer testindex file from MBP13 to server
scp testindex.php ubuntu@128.232.226.206:/var/www/devseqplant.org


### Set up ssl certificate:
### Get free ssl certificate from certbot
https://certbot.eff.org/instructions?ws=apache&os=ubuntufocal

# Set redirect to https to off
sudo nano devseqplant.org.conf
# set RewriteEngine to off
# set it to on again after website testing is completed to allow certbot ssl certificate update
sudo systemctl reload apache2
# Update ssl certificate (need to be done every 90 days)
sudo certbot renew --dry-run # to test if renewal works
# To renew, do
sudo certbot renew











