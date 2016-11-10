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

$sth = $dbh->prepare("SELECT materials.id, materials.name, count(*) FROM games_materials INNER JOIN materials ON games_materials.material_id = materials.id GROUP BY materials.id, materials.name ORDER BY count(*) DESC");
$sth->execute();
$materials = $sth->fetchAll();
?>
<div class="row column">
    <table>
        <thead>
        <tr>
            <th>Material</th>
            <th>Anzahl</th>
        </tr>
        </thead
        <tbody>
        <?php foreach($materials as $material):?>
            <tr>
                <td><?='<a href="'.$APP_URL.'/games.php?material='.$material->id.'">'.$material->name.'</a>'?></td>
                <td><?=$material->count?></td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>
<?php include("template/footer.php");?>
