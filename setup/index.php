<?php
/**
 * Prevent from running installation if already installed
 */
if (file_exists("../app/config/config.xml")) {
    header("Location: ../index.php");
    die();
}

include_once "template/head.phtml";
$currentStep = empty($_POST["status"]) ? "step-1" : $_POST["status"];

switch ($currentStep) {
    case "step-3":
                include_once "template/error.phtml";
                install($_POST);
                include_once "template/finish.phtml";

        break;
    case "step-2":
        include_once "template/setup.phtml";
        break;
    default:
        include_once "template/index.phtml";
        break;
}

/**
 * Prepare and generate config.xml
 * @param $postData
 */
function install($postData) {
    $blockXMLPath = "../app/config/";

    $dom = new DOMDocument();
    //for formatted output
    $dom->formatOutput = true;

    $config = $dom->appendChild($dom->createElement("config"));
    $database = $config->appendChild($dom->createElement("database"));
    $database->appendChild($dom->createElement("server", $postData['db-host']));
    $database->appendChild($dom->createElement("db", $postData['db-name']));
    $database->appendChild($dom->createElement("user", $postData['db-user']));
    $database->appendChild($dom->createElement("password", $postData['db-password']));

    $dom->save($blockXMLPath . 'config.xml');
}

/**
 * Create initial tables in database
 * @param $dbData $_POST data from setup form
 *
 * @return string || boolean
 */
function initializeDatabaseTables($dbData) {
    $connection = new mysqli($dbData["db-host"], $dbData["db-user"], $dbData["db-password"], $dbData["db-name"]);
    if (mysqli_connect_error()) {
        return mysqli_connect_error();
    } else {
        //if no error found, create tables
        $sqls = [
                "CREATE TABLE core_extension (
                  id INT AUTO_INCREMENT PRIMARY KEY,
                  extension_name VARCHAR(255),
                  version VARCHAR(48)
                )",
                " CREATE TABLE core_posts (
                  id INT AUTO_INCREMENT PRIMARY KEY,
                  title VARCHAR(255),
                  content TEXT,
                  author VARCHAR(48),
                  published_date VARCHAR(48),
                  tags TEXT
                );"
        ];

        foreach ($sqls as $sql) {
            if (!$connection->query($sql) === TRUE) {
                return $connection->error;
            }
        }

        return false;
    }
}
