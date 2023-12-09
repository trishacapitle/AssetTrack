<?php
// clear_history.php

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['clear_history'])) {
    // Path to the history log file
    $logFile = 'history.log';

    // Check if the log file exists
    if (file_exists($logFile)) {
        // Clear the content of the log file
        file_put_contents($logFile, '');

        // Redirect back to the settings page or any other desired page
        header('Location: assetlogs.php');
        exit;
    }
}

// If the form wasn't submitted or an error occurred, redirect back to the settings page
header('Location: assetlogs.php');
exit;
?>
