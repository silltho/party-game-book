/**
* Created by PhpStorm.
* User: Thomas Siller
* Zweck: MMP1
* Studiengang: MultiMediaTechnology
* 2016, Fachhochschule Salzburg
*/
<?php
require_once __DIR__.'/common/database_connection.php';
require_once __DIR__.'/common/fb_init.php';
require_once __DIR__.'/common/validation_utilities.php';
if(isset($_GET['id'])) {
    $id = validateNumber($_GET['id']);
    $currentUser = validateCurrentUser();

    $sth = $dbh->prepare("SELECT * FROM games WHERE games.id=?");
    $sth->execute(array($id));
    $game = $sth->fetch();

    if ($currentUser->id != $game->user_id) {
        header('Location: '.$APP_URL.'/error/403.php');
        exit;
    } else {
        try {
            $dbh->beginTransaction();
            $sth = $dbh->prepare("DELETE FROM games_tags WHERE game_id = ?");
            $sth->execute(array($id));
            $sth = $dbh->prepare("DELETE FROM games_materials WHERE game_id = ?");
            $sth->execute(array($id));
            $sth = $dbh->prepare("DELETE FROM games WHERE id = ?");
            $sth->execute(array($id));
            $dbh->commit();
            header('Location: '.$APP_URL.'/index.php');
        } catch (Exception $e) {
            error_log($e->getMessage());
            $dbh->rollBack();
            header('Location: '.$APP_URL.'/error/500.php');
            exit;
        }
    }
} else {
    header('Location: '.$APP_URL.'/error/500.php');
}