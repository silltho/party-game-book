<?php
/**
 * Created by PhpStorm.
 * User: Thomas Siller
 * Zweck: MMP1
 * Studiengang: MultiMediaTechnology
 * 2016, Fachhochschule Salzburg
 */
require_once __DIR__.'/config.php';

if( ! $DB_NAME ) die('please create config.php, define $DB_NAME, $DB_USER, $DB_PASS there');

try {
    $dbh = new PDO($DSN, $DB_USER, $DB_PASS);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,            PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

} catch (Exception $e) {
    die("Problem connecting to database $DB_NAME as $DB_USER: " . $e->getMessage() );
}
