<?php
## Debugging Configuration
    error_reporting(-1);
    ini_set('display_errors', 'On');
## END

/**
 * Validation for first run
 */
if (!file_exists("app/config/config.xml")) {
    header("Location: setup/index.php");
    die();
} else {
    include_once('app/core/includes.php');
}
