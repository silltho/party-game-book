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

$searchDescription = false;
$games = array();
if(isset($_GET['tag'])) {
    $sth = $dbh->prepare("SELECT name FROM tags WHERE tags.id = ?");
    $sth->execute(array($_GET['tag']));
    $tag = $sth->fetch();
    //$sth = $dbh->prepare("SELECT games.id, games.gamename, games.creation_date, string_agg(materials.name, ', ') AS materiallist FROM games_tags INNER JOIN games ON(games.id = games_tags.game_id) INNER JOIN tags ON(games_tags.tag_id = tags.id) INNER JOIN games_materials ON(games.id = games_materials.game_id) INNER JOIn materials ON(materials.id = games_materials.material_id) WHERE games_tags.tag_id =  ? GROUP BY games.id;");
    $sth = $dbh->prepare("SELECT games.id, games.gamename, games.creation_date, users.username , games.user_id FROM games_tags INNER JOIN games ON(games.id = games_tags.game_id) INNER JOIN tags ON(games_tags.tag_id = tags.id) INNER JOIN users ON(games.user_id = users.id) WHERE games_tags.tag_id = ?");
    $sth->execute(array($_GET['tag']));
    $games = $sth->fetchAll();
    $searchDescription = 'Spiele mit dem Tag "'.$tag->name.'"';
}
else if(isset($_GET['material'])) {
    $sth = $dbh->prepare("SELECT name FROM materials WHERE materials.id = ?");
    $sth->execute(array($_GET['material']));
    $material = $sth->fetch();
    $sth = $dbh->prepare("SELECT games.id, games.gamename, games.creation_date, users.username , games.user_id FROM games_materials INNER JOIN games ON(games.id = games_materials.game_id) INNER JOIN materials ON(games_materials.material_id = materials.id) INNER JOIN users ON(games.user_id = users.id) WHERE games_materials.material_id = ?");
    $sth->execute(array($_GET['material']));
    $games = $sth->fetchAll();
    $searchDescription = 'Spiele mit dem Material "'.$material->name.'"';
}
else if(isset($_GET['gamename'])) {
    $gamename = '%'.$_GET['gamename'].'%';
    $sth = $dbh->prepare("SELECT games.id, games.gamename, games.creation_date, users.username , games.user_id FROM games INNER JOIN users ON(users.id = games.user_id) WHERE LOWER(gamename) LIKE LOWER(?)");
    $sth->execute(array($gamename));
    $games = $sth->fetchAll();
    $searchDescription = 'Spiele mit Namen "'.$_GET['gamename'].'"';
}
else if(isset($_GET['user'])) {
    $userId = $_GET['user'];
    $sth = $dbh->prepare("SELECT games.id, games.gamename, games.creation_date, users.username , games.user_id FROM games INNER JOIN users ON(users.id = games.user_id) WHERE user_id = ?");
    $sth->execute(array($userId));
    $games = $sth->fetchAll();
    $searchDescription = 'Spiele vom Benutzer "'.$games[0]->username.'"';
} else {
    $sth = $dbh->prepare("SELECT games.id, games.gamename, games.creation_date, users.username , games.user_id FROM games INNER JOIN users ON (users.id = games.user_id)");
    $sth->execute();
    $games = $sth->fetchAll();
    $searchDescription = 'Alle Spiele';
}?>
<div class="row">
    <div class="column large-6">
        <form action="<?=$APP_PATH?>/games.php" method="GET">
            <div class="input-group">
                <input name="gamename" type="search" placeholder="Spielenamen" class="game-input input-group-field">
                <div class="input-group-button">
                    <input type="submit" class="button" value="suchen">
                </div>
            </div>
        </form>
    </div>
</div>
<?php if($searchDescription):?>
<div class="row column">
    <h4><?=$searchDescription?></h4>
</div>
<?php endif;?>
<div class="row column">
    <table>
        <thead>
        <tr>
            <th>Spielename</th>
            <th class="show-for-medium">Ersteller</th>
            <th class="show-for-medium">Erstellt am</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($games as $game):
            $game->creation_date = strtotime($game->creation_date);
            $datum = date("d.m.Y",$game->creation_date);
            $uhrzeit = date("H:i",$game->creation_date);
            $game->creation_date = $datum." - ".$uhrzeit;
            //echo('<li><a href="game.php?id='.$game->id.'">'.$game->gamename.'</a></li>');?>
        <tr>
            <td><a href="game.php?id=<?=$game->id?>"><?=$game->gamename?></a></td>
            <td class="show-for-medium"><a href="<?=$APP_PATH?>/games.php?user=<?=$game->user_id?>"><?=$game->username?></a></td>
            <td class="show-for-medium"><?=$game->creation_date?></td>
        </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>
<?php include("template/footer.php");?>