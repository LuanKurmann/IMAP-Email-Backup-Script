<?php
// IMAP connection details
$hostname = '{imap.example.com:993/imap/ssl}';
$username = 'email@example.com';
$password = 'password';

// Backup directory
$backupFolder = './email_backup/' . date('Y-m-d_H-i-s');
if (!is_dir($backupFolder)) {
    mkdir($backupFolder, 0777, true);
}

// Connect to the IMAP server
$inbox = imap_open($hostname, $username, $password) or die('Could not connect to the IMAP server: ' . imap_last_error());

// Loop through all subfolders
$folders = imap_list($inbox, $hostname, '*');
if (is_array($folders)) {
    foreach ($folders as $folder) {
        // Get email IDs in the current subfolder
        $folderName = str_replace($hostname, '', $folder);
        $backupFolderSub = $backupFolder . '/' . $folderName;
        if (!is_dir($backupFolderSub)) {
            mkdir($backupFolderSub, 0777, true);
        }
        $emails = imap_sort(imap_open($folder, $username, $password), SORTDATE, 0, SE_UID);

        // Save emails in the current subfolder
        if ($emails) {
            foreach ($emails as $email) {
                if ($email > 0) { // Check if $email is a valid email ID
                    $imapStream = imap_open($folder, $username, $password);
                    $emailData = imap_fetchbody($imapStream, $email, '');
                    imap_close($imapStream);
                    $emailInfo = imap_headerinfo(imap_open($folder, $username, $password), $email);
                    $emailSubject = str_replace('/', '_', $emailInfo->subject);
                    $emailFilename = $backupFolderSub . '/' . $emailSubject . '.eml';
                    file_put_contents($emailFilename, $emailData);
                }
            }
        }

        imap_close(imap_open($folder, $username, $password));
    }
}

// Close the connection to the IMAP server
imap_close($inbox);
?>
