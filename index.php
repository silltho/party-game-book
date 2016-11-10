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

$sth = $dbh->prepare("SELECT games.id, games.user_id, games.gamename, games.description, users.username FROM games LEFT JOIN users ON(user_id = users.id) ORDER BY RANDOM() LIMIT 4");
$sth->execute();
$randomGames = $sth->fetchAll();

$sth = $dbh->prepare("SELECT games.id, games.user_id, games.gamename, games.description ,games.creation_date ,users.username FROM games LEFT JOIN users ON(user_id = users.id) ORDER BY games.creation_date DESC LIMIT 4");
$sth->execute();
$newestGames = $sth->fetchAll();

?>
<div class="row">
    <div class="column">
        <h3>Wilkommen auf PartyGameBook.com</h3>
        <p>Hier findest du tolle Spiele-Kreationen aus der Community. Wenn du dich mit Facebook anmeldest kannst auch du Spiele gratis erstellen und mit der Welt teilen.</p>
    </div>
</div>
<div class="row column">
    <h3>Neu</h3>
    <hr>
</div>
<div class="row">
    <?php foreach ($newestGames as $game):
        $shortDescriptionLength = strlen($game->description);
        if($shortDescriptionLength > 150) {
            $shortDescriptionLength = strpos($game->description, ' ', 100);
        }
        if($shortDescriptionLength < 150){
            $shortDescription = 150;
        }
        $shortDescription = substr($game->description, 0, $shortDescriptionLength);
        ?>
    <div class="large-3 medium-6 small-12 column">
        <article class="article-card">
            <div class="card-content">
                <div>
                    <h5><?=$game->gamename?></h5>
                    <h6 class="subheader">von <?=$game->username?></h6>
                </div>
                <div><?=$shortDescription?> ...</div>
                <p><a href="<?=$APP_PATH.'/game.php?id='.$game->id?>">&ouml;ffnen</a></p>
            </div>
        </article>
    </div>
    <?php endforeach;?>
</div>
<div class="row column">
    <h3>Zuf&auml;llig</h3>
    <hr>
</div>
<div class="row">
    <?php foreach ($randomGames as $game):
        $shortDescriptionLength = strlen($game->description);
        if($shortDescriptionLength > 100) {
            $shortDescriptionLength = strpos($game->description, ' ', 100);
        }
        $shortDescription = substr($game->description, 0, $shortDescriptionLength);
        ?>
        <div class="large-3 medium-6 small-12 column">
            <article class="article-card">
                <div class="card-content">
                    <div>
                        <h5><?=$game->gamename?></h5>
                        <h6 class="subheader">von <?=$game->username?></h6>
                    </div>
                    <div><?=$shortDescription?> ...</div>
                    <p><a href="<?=$APP_PATH.'/game.php?id='.$game->id?>">&ouml;ffnen</a></p>
                </div>
            </article>
        </div>
    <?php endforeach;?>
</div>
<?php include("template/footer.php");?>