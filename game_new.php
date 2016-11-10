<?php
/**
 * Created by PhpStorm.
 * User: Thomas Siller
 * Zweck: MMP1
 * Studiengang: MultiMediaTechnology
 * 2016, Fachhochschule Salzburg
 */
include("template/header.php");
require_once __DIR__.'/common/database_connection.php';
require_once __DIR__.'/common/validation_utilities.php';

$gamename = '';
$description = '';
$recommended_age = '';
$min_player_count = '';
$max_player_count = '';
$average_playtime = '';
$tags = array();
$materials = array();
$errors = array();
$allTags = array();
$allMaterials = array();
$currentUser = validateCurrentUser();

//Get all Materials and Tags for tag- material list
try{
    $sth = $dbh->prepare("SELECT * FROM tags ORDER BY name ASC");
    $sth->execute();
    $allTags = $sth->fetchAll();
    $sth = $dbh->prepare("SELECT * FROM materials ORDER BY name ASC");
    $sth->execute();
    $allMaterials = $sth->fetchAll();
} catch (Exception $e) {
    $dbh->rollback();
    error_log($e->getMessage());
    header('Location: '.$APP_URL.'/error/500.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //validation
    $gamename = validateString($_POST['gamename']);
    $description = validateHTMLInput($_POST['description']);
    $recommended_age = validateNumber($_POST['recommended_age']);
    $min_player_count = validateNumber($_POST['min_player_count']);
    $max_player_count = validateNumber($_POST['max_player_count']);
    $average_playtime = validateNumber($_POST['average_playtime']);
    if (isset($_POST['tags'])) {
        $tags = validateArray($_POST['tags']);
    } else {
        $tags = array();
    }
    if (isset($_POST['materials'])) {
        $materials = validateArray($_POST['materials']);
    } else {
        $materials = array();
    }
    $errors = validateGameInput($gamename, $description, $recommended_age, $min_player_count, $max_player_count, $average_playtime);

    if (count($errors) == 0) {
        $dbh->beginTransaction();
        try {
            //create game
            $sth = $dbh->prepare("INSERT INTO games VALUES(nextval('game_id_seq'),? ,? ,? ,? ,? ,? ,CURRENT_TIMESTAMP ,?)");
            $sth->execute(array($gamename, $description, $recommended_age, $min_player_count, $max_player_count, $average_playtime, $_SESSION['currentUser']->id));
            $newGameId = $dbh->lastInsertId('game_id_seq');

            //append tags
            if (count($tags) != 0) {
                foreach ($tags as $tag) {
                    $sth = $dbh->prepare("INSERT INTO games_tags VALUES(? ,?)");
                    $sth->execute(array($newGameId, $tag['id']));
                }
            }

            //append material
            if (count($materials) != 0) {
                foreach ($materials as $material) {
                    $sth = $dbh->prepare("INSERT INTO games_materials VALUES(? ,?)");
                    $sth->execute(array($newGameId, $material['id']));
                }
            }

            $dbh->commit();
            header('Location: '.$APP_URL.'/game.php?id=' . $newGameId);
        } catch (Exception $e) {
            $dbh->rollback();
            error_log($e->getMessage());
            header('Location: '.$APP_URL.'/error/500.php');
            exit;
        }
    } else {
        $errorHTML = '<div class="callout alert"><h5>Fehler!</h5>';
        foreach ($errors as $error) {
            $errorHTML .= '<li>' . $error . '</li>';
        }
        $errorHTML .= '</div>';
    }
}
?>
<span style="display:none" id="tagCounter"><?=count($tags)?></span>
<span style="display:none" id="materialCounter"><?=count($materials)?></span>
<div class="row column">
    <h3>Spiel erstellen</h3>
    <hr>
</div>
<div class="row column">
    <?php if(isset($errorHTML)) echo($errorHTML)?>
    <form action="" method="post">
        <div class="row">
            <div class="column">
                <label>
                    Name*:
                    <input type="text" name="gamename" value="<?=$gamename?>">
                </label>
            </div>
        </div>
        <div class="row">
            <div class="large-3 column">
                <label>
                    Empfohlenes Mindestalter*:
                    <input type="number" name="recommended_age" value="<?=$recommended_age?>">
                </label>
            </div>
            <div class="large-3 column">
                <label>
                    Min. Spieler*:
                    <input type="number" name="min_player_count" value="<?=$min_player_count?>">
                </label>
            </div>
            <div class="large-3 column">
                <label>
                    Max. Spieler*:
                    <input type="number" name="max_player_count" value="<?=$max_player_count?>">
                </label>
            </div>
            <div class="large-3 column">
                <label>
                    Durchschnittliche Spielzeit (min)*:
                    <input type="number" name="average_playtime" value="<?=$average_playtime?>">
                </label>
            </div>
        </div>
        <div class="row">
            <div class="large-6 column">
                <fieldset id="selected-materials" class="fieldset">
                    <legend>Materialien</legend>
                    <?php
                    $i = 0;
                    foreach($materials as $key => $material): ?>
                    <div class="block">
                        <?=$material['name']?>
                        <i class="fi-x-circle removeBlockIcon"></i>
                        <input type="hidden" value="<?=$material['id']?>" name="materials[<?=$i?>][id]">
                        <input type="hidden" value="<?=$material['name']?>" name="materials[<?=$i?>][name]">
                    </div>
                    <?php
                    $i++;
                    endforeach;?>
                </fieldset>
                <div class="row columns">
                    <div id="material-list" class="list-container">
                        <input type="text" class="search" placeholder="Material filtern">
                        <ul class="list">
                            <?php foreach($allMaterials as $material): ?>
                                <li><span class="id" style="display:none"><?=$material->id?></span><span class="name"><?=$material->name?></span></li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="large-6 column">
                <fieldset class="fieldset" id="selected-tags">
                    <legend>Tags</legend>
                    <?php
                    $i = 0;
                    foreach($tags as $key => $tag): ?>
                        <div class="block">
                            <?=$tag['name']?>
                            <i class="fi-x-circle removeBlockIcon"></i>
                            <input type="hidden" value="<?=$tag['id']?>" name="materials[<?=$i?>][id]">
                            <input type="hidden" value="<?=$tag['name']?>" name="materials[<?=$i?>][name]">
                        </div>
                        <?php
                        $i++;
                    endforeach;?>
                </fieldset>
                <div class="row columns">
                    <div id="tag-list" class="list-container">
                        <input type="text" class="search" placeholder="Tags filtern">
                        <ul class="list">
                            <?php foreach($allTags as $tag): ?>
                                <li><span class="id" style="display:none"><?=$tag->id?></span><span class="name"><?=$tag->name?></span></li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="large-6 column">
                <label style="margin-bottom: 10px;">
                    Beschreibung*:
                    <textarea rows="5" name="description"><?=$description?></textarea>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="column">
                <button class="button" type="submit">Absenden</button>
            </div>
        </div>
    </form>
</div>
<?php include("template/footer.php");?>