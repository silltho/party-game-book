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
$allTags = array();
$allMaterials = array();
$currentUser = validateCurrentUser();
$id = validateNumber($_GET['id']);


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
    $errors = array();
    $gamename = validateString($_POST['gamename']);
    $description = validateHTMLInput($_POST['description']);
    $recommended_age = validateNumber($_POST['recommended_age']);
    $min_player_count = validateNumber($_POST['min_player_count']);
    $max_player_count = validateNumber($_POST['max_player_count']);
    $average_playtime = validateNumber($_POST['average_playtime']);
    if(isset($_POST['tags'])) {
        $tags = validateArray($_POST['tags']);
    } else {
        $tags = array();
    }
    if(isset($_POST['materials'])) {
        $materials = validateArray($_POST['materials']);
    } else {
        $materials = array();
    }

    $errors = validateGameInput($gamename, $description, $recommended_age, $min_player_count, $max_player_count, $average_playtime);
    $sth = $dbh->prepare("SELECT * FROM games WHERE games.id=?");
    $sth->execute(array($id));
    $game = $sth->fetch();

    if($currentUser->id != $game->user_id) {
        header('Location: '.$APP_URL.'/error/403.php');
        exit;
    } else if (count($errors) == 0) {
        try {
            //update game
            $dbh->beginTransaction();
            $sth = $dbh->prepare("UPDATE games SET gamename = ?, description = ?, recommended_age = ?, min_player_count = ?, max_player_count = ?, average_playtime = ?, creation_date = CURRENT_TIMESTAMP WHERE id = ?");
            $sth->execute(array($gamename, $description, $recommended_age, $min_player_count, $max_player_count, $average_playtime, $id));
            
            //append tags
            $sth = $dbh->prepare("DELETE FROM games_tags WHERE game_id = ?");
            $sth->execute(array($id));
            if(count($tags) != 0) {
                foreach ($tags as $tag) {
                    $sth = $dbh->prepare("INSERT INTO games_tags VALUES(? ,?)");
                    $sth->execute(array($id, $tag['id']));
                    //$dbh->commit();
                }
            }
            
            //append material
            $sth = $dbh->prepare("DELETE FROM games_materials WHERE game_id = ?");
            $sth->execute(array($id));
            if(count($materials) != 0) {
                foreach ($materials as $material) {
                    $sth = $dbh->prepare("INSERT INTO games_materials VALUES(? ,?)");
                    $sth->execute(array($id, $material['id']));
                    //$dbh->commit();
                }
            }

            $dbh->commit();
            header('Location: '.$APP_URL.'/game.php?id=' . $id);
        } catch (Exception $e) {
            $dbh->rollback();
            error_log($e->getMessage());
            header('Location: '.$APP_URL.'/error/500.php');
            exit;
        }
    } else {
        $errorHTML = '<div class="callout alert"><h5>Fehler!</h5>';
        foreach ($errors as $error){
            $errorHTML .= '<li>'.$error.'</li>';
        }
        $errorHTML .= '</div>';
    }
} else {
    $sth = $dbh->prepare("SELECT * FROM games WHERE id = ?");
    $sth->execute(array($id));
    $game = $sth->fetch();
    if($currentUser->id != $game->user_id) {
        header('Location: '.$APP_URL.'/error/403.php');
        exit;
    }
    $gamename = $game->gamename;
    $description = $game->description;
    $recommended_age = $game->recommended_age;
    $min_player_count = $game->min_player_count;
    $max_player_count = $game->max_player_count;
    $average_playtime = $game->average_playtime;

    $sth = $dbh->prepare("SELECT tags.id ,tags.name FROM games_tags INNER JOIN tags ON (tag_id = id) WHERE game_id = ?");
    $sth->execute(array($id));
    $tags = $sth->fetchAll();
    $tags = json_decode(json_encode($tags),true);

    $sth = $dbh->prepare("SELECT materials.id, materials.name FROM games_materials INNER JOIN materials ON (material_id = id) WHERE game_id = ?");
    $sth->execute(array($id));
    $materials = $sth->fetchAll();
    $materials = json_decode(json_encode($materials),true);
}
?>
<span style="display:none" id="tagCounter"><?=count($tags)?></span>
<span style="display:none" id="materialCounter"><?=count($materials)?></span>
<div class="row column">
    <h3>Spiel bearbeiten</h3>
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
                <fieldset id="selected-tags" class="fieldset">
                    <legend>Tags</legend>
                    <?php
                    $i = 0;
                    foreach($tags as $key => $tag): ?>
                        <div class="block">
                            <?=$tag['name']?>
                            <i class="fi-x-circle removeBlockIcon"></i>
                            <input type="hidden" value="<?=$tag['id']?>" name="tags[<?=$i?>][id]">
                            <input type="hidden" value="<?=$tag['name']?>" name="tags[<?=$i?>][name]">
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