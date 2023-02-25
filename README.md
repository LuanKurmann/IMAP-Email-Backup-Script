# IMAP Email Backup Script
This PHP script backs up all emails in an IMAP mailbox and stores them in a backup folder on the local file system. The backup folder is named with the current date and time in the format "YYYY-MM-DD_HH-MM-SS", and a corresponding subfolder is created for each mailbox subfolder.

The script uses the PHP IMAP extension to connect to the IMAP server, retrieve the email IDs and fetch each email before saving them to the backup folder. The script is designed to be easily executed by installing and running on a PHP-enabled web server, making it suitable as a basis for an automated backup solution for IMAP mailboxes.

## Installation
Copy the saveMail.php file to your web server.
Configure the IMAP settings in the script by editing the relevant variables.
Run the script via a web browser or a command line interface.
## Usage
The script will create a backup folder with the current date and time, and a subfolder for each mailbox subfolder. The emails in each subfolder will be fetched and saved in the corresponding backup subfolder. The script can be used as a basis for an automated backup solution for IMAP mailboxes.


*This script was created with the help of ChatGPT, a large language model trained by OpenAI.
