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

$sth = $dbh->prepare("SELECT tags.id, tags.name, count(*) FROM games_tags INNER JOIN tags ON games_tags.tag_id = tags.id GROUP BY tags.id, tags.name ORDER BY count(*) DESC");
$sth->execute();
$tags = $sth->fetchAll();
?>
<div class="row column">
    <table>
        <thead>
        <tr>
            <th>Tag</th>
            <th>Anzahl</th>
        </tr>
        </thead
        <tbody>
        <?php foreach($tags as $tag):?>
            <tr>
                <td><a href="<?=$APP_PATH?>/games.php?tag=<?=$tag->id?>"><?=$tag->name?></a></td>
                <td><?=$tag->count?></td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>
<?php include("template/footer.php");?>
