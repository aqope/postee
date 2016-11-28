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
        $connection = databaseConnection($_POST);
        if (mysqli_connect_error()) {
            include_once "template/error.phtml";
            break;
        } else {
            createTables($connection);
            install($_POST);
            include_once "template/finish.phtml";
            break;
        }
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
 * Check connection to database
 * @param $dbData $_POST data from setup form
 *
 * @return string || boolean
 */
function databaseConnection($dbData) {
    //Not to print non-styled error
    error_reporting(0);

    $connection = new mysqli($dbData["db-host"], $dbData["db-user"], $dbData["db-password"], $dbData["db-name"]);
    if (mysqli_connect_error()) {
        return mysqli_connect_error();
    } else {
        error_reporting(1);
        return $connection;
    }
}

/**
 * Create initial tables in database
 *
 * @param $connection
 * @return bool|string
 */
function createTables($connection)
{
    /* If you want to add new tables, keep current formatting */
    $tableNames = [
        "core_extension" => array(
            "id" => array(
                "INT",
                "AUTO_INCREMENT",
                "PRIMARY",
                "KEY"
            ),
            "extension_name" => array(
                "VARCHAR (255)"
            ),
            "version" => array(
                "VARCHAR (48)"
            )
        ),
        "core_posts" => array(
            "id" => array(
                "INT",
                "AUTO_INCREMENT",
                "PRIMARY",
                "KEY"
            ),
            "title" => array(
                "VARCHAR (255)"
            ),
            "content" => array(
                "TEXT"
            ),
            "author" => array(
                "VARCHAR (48)"
            ),
            "published_date" => array(
                "VARCHAR (255)"
            ),
            "tags" => array(
                "TEXT"
            )
        )
    ];

    foreach ($tableNames as $tableName => $tableColumns) {
        $sql = "CREATE TABLE " . $tableName . " ( ";
        foreach ($tableColumns as $tableColumn => $tableColumnParams) {
            $sql .= " " . $tableColumn;
            foreach ($tableColumnParams as $tableColumnParam) {
                $sql .= " " . $tableColumnParam;
            }
            if(end(array_keys($tableColumns)) != $tableColumn) {
                $sql .= ", ";
            }
        }
        $sql .= " ); ";
        mysqli_query($connection, $sql);
    }

    return true;
}
