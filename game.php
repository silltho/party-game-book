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

if(isset($_GET['id'])) $id = $_GET['id'];

$sth = $dbh->prepare("SELECT * FROM games WHERE games.id=?");
$sth->execute(array($id));
$game = $sth->fetch();
$game->creation_date = strtotime($game->creation_date);
$datum = date("d.m.Y", $game->creation_date);
$uhrzeit = date("H:i", $game->creation_date);
$game->creation_date = $datum . " - " . $uhrzeit;

$sth = $dbh->prepare("SELECT * FROM users WHERE id=?");
$sth->execute(array($game->user_id));
$user = $sth->fetch();

$sth = $dbh->prepare("SELECT tags.id, tags.name FROM games_tags INNER JOIN tags ON (tag_id = id) WHERE game_id = ?");
$sth->execute(array($id));
$tags = $sth->fetchAll();

$sth = $dbh->prepare("SELECT materials.id, materials.name FROM games_materials INNER JOIN materials ON (material_id = id) WHERE game_id = ?");
$sth->execute(array($id));
$materials = $sth->fetchAll();
if (isset($game->gamename)) {
        ?>
        <div class="row column">
            <h3 class="float-left"><?= $game->gamename ?>
                <small> von <a href="<?= $APP_PATH ?>/games.php?user=<?= $user->id ?>"><?= $user->username ?></a>
                </small>
            </h3>
            <?php if (isset($_SESSION['currentUser']) && $_SESSION['currentUser']->id == $game->user_id) : ?>
                <div class="float-right">
                    <a class="button warning" href="<?= $APP_PATH ?>/game_edit.php?id=<?= $game->id ?>"><i class="fi-pencil"></i> bearbeiten</a>
                    <a class="button alert" href="<?= $APP_PATH ?>/game_delete.php?id=<?= $game->id ?>"><i class="fi-trash"></i> löschen</a>
                </div>
            <?php endif; ?>
            <hr>
        </div>
        <div class="row">
            <div class="column medium-6">
                <fieldset class="fieldset">
                    <legend>Beschreibung</legend>
                    <div><?= $game->description ?></div>
                </fieldset>
            </div>
            <div class="column medium-6">
                <dl>
                    <dt>Durchschnittliche Spielzeit:</dt>
                    <dd><?= $game->average_playtime ?></dd>
                    <dt>Spieleranzahl:</dt>
                    <dd><?= $game->min_player_count ?> - <?= $game->max_player_count ?></dd>
                    <dt>Empfohlenes Alter:</dt>
                    <dd><?= $game->recommended_age ?></dd>
                    <dt>Erstellt am:</dt>
                    <dd><?= $game->creation_date ?></dd>
                </dl>
            </div>
            <div class="row">
                <div class="column medium-6">
                    <fieldset class="fieldset">
                        <legend>benötigtes Material</legend>
                        <ul style="margin-bottom: 0">
                            <?php foreach ($materials as $material) : ?>
                                <li>
                                    <a href="<?= $APP_PATH ?>/games.php?material=<?= $material->id ?>"><?= $material->name ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </fieldset>
                </div>
                <div class="column medium-6">
                    <fieldset class="fieldset">
                        <legend>Tags</legend>
                        <?php foreach ($tags as $tag) : ?>
                            <a href="<?= $APP_PATH ?>/games.php?tag=<?= $tag->id ?>"><span class="label" style="cursor: pointer;"><?= $tag->name ?></span></a>
                        <?php endforeach; ?>
                    </fieldset>
                </div>
            </div>
        </div>
        <?php
    } else { ?>
        <div class="row column">
            <h3>Spiel nicht vorhanden!</h3>
        </div>
    <?php }
    include("template/footer.php");?>