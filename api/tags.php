<?php
/**
 * Created by PhpStorm.
 * User: Thomas Siller
 * Zweck: MMP1
 * Studiengang: MultiMediaTechnology
 * 2016, Fachhochschule Salzburg
 */
require_once __DIR__.'/../common/database_connection.php';

$name = $_GET['term'];
if($name!="") {
    $name = '%'.$name.'%';
    $sth = $dbh->prepare("SELECT * FROM tags WHERE name LIKE ?");
    $sth->execute(array($name));
} else {
    $tagsQuery = "SELECT * FROM tags";
    $sth = $dbh->query($tagsQuery);
}
$tags = $sth->fetchAll();

header('Content-Type: application/json');
echo(json_encode($tags));