<?php
    /**
     * Created by PhpStorm.
     * User: Thomas Siller
     * Zweck: MMP1
     * Studiengang: MultiMediaTechnology
     * 2016, Fachhochschule Salzburg
     */

    ob_start();
    require_once __DIR__ . '/../common/fb_init.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Party Game Book</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="image/x-icon" href="<?=$APP_URL?>/assets/img/favicon.png">
        <link rel="stylesheet" href="<?=$APP_PATH?>/assets/css/foundation.css">
        <link rel="stylesheet" href="<?=$APP_PATH?>/assets/css/foundation-icons.css">
        <link rel="stylesheet" href="<?=$APP_PATH?>/assets/css/app.css">
        <script type="text/javascript">var APP_PATH = '<?=$APP_PATH?>';</script>
        <script type="text/javascript" src="<?=$APP_PATH?>/assets/js/jquery-2.2.3.min.js"></script>
        <script type="text/javascript" src="<?=$APP_PATH?>/assets/js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="<?=$APP_PATH?>/assets/js/foundation.js"></script>
        <script type="text/javascript" src="<?=$APP_PATH?>/assets/js/list.min.js"></script>
        <script type="text/javascript" src="<?=$APP_PATH?>/assets/js/tinymce/tinymce.min.js"></script>
        <script type="text/javascript" src="<?=$APP_PATH?>/assets/js/tinymce/jquery.tinymce.min.js"></script>
        <script type="text/javascript" src="<?=$APP_PATH?>/assets/js/app.js"></script>
    <body>
    <div class="wrapper">
        <div class="app-container">
            <nav class="top-bar" style="margin-bottom: 10px" data-topbar>
                <div class="row column">

                    <div class="top-bar-title">
                        <span data-responsive-toggle="responsive-menu" data-hide-for="large" style="margin-right: 10px;">
                                <button class="menu-icon" type="button" data-toggle></button>
                        </span>
                        <a href="<?=$APP_PATH?>/index.php" style="color: black;">
                            <img src="<?=$APP_PATH?>/assets/img/book.svg" alt="app-icon" class="app-icon show-for-large"/>
                            <strong>PartyGameBook</strong>
                        </a>
                    </div>

                    <!-- Mobile Nav -->
                    <div class="row column hide-for-large">
                        <div class="top-bar-left">
                            <ul class="menu vertical" id="responsive-menu">
                                <li class="divider"></li>
                                <li><a href="<?=$APP_PATH?>/games.php">Spiele</a></li>
                                <li><a href="<?=$APP_PATH?>/tags.php">Tags</a></li>
                                <li><a href="<?=$APP_PATH?>/materials.php">Material</a></li>
                                <li class="divider"></li>
                                <?php if($FB_LOGIN_URL){?>
                                    <li><a href="<?=$FB_LOGIN_URL?>" class="button facebook"><i class="fi-social-facebook"></i> mit Facebook anmelden</a></li>
                                <?php } else {?>
                                    <li>
                                        <a>
                                            <img src="http://graph.facebook.com/<?=$_SESSION['currentUser']->oauth_uid?>/picture" alt="fb_img" class="fb-img">
                                            <?=$_SESSION['currentUser']->username?>
                                        </a>
                                        <ul class="menu vertical nested">
                                            <li><a href="<?=$APP_PATH?>/game_new.php">Neues Spiel anlegen</a></li>
                                            <li><a href="<?=$APP_PATH?>/common/fb_logout.php">Logout</a></li>
                                        </ul>
                                    </li>
                                <?php }?>
                            </ul>
                        </div>
                    </div>

                    <!-- Desktop Nav -->
                    <div class="show-for-large">
                        <div class="top-bar-left">
                            <ul class="menu vertical large-horizontal">
                                <li><a href="<?=$APP_PATH?>/games.php">Spiele</a></li>
                                <li><a href="<?=$APP_PATH?>/tags.php">Tags</a></li>
                                <li><a href="<?=$APP_PATH?>/materials.php">Material</a></li>
                            </ul>
                        </div>

                        <div class="top-bar-right">
                            <form action="<?=$APP_PATH?>/games.php" method="GET">
                                <ul class="dropdown menu" data-dropdown-menu>
                                    <?php if($FB_LOGIN_URL){?>
                                        <li><a href="<?=$FB_LOGIN_URL?>" class="button facebook"><i class="fi-social-facebook"></i> mit Facebook anmelden</a></li>
                                    <?php } else {?>
                                        <li>
                                            <a style="margin-right: 5px;">
                                                <img src="http://graph.facebook.com/<?=$_SESSION['currentUser']->oauth_uid?>/picture" alt="fb_img" style="width: 30px; height: 30px; margin-right: 10px; margin-top: -6px; margin-bottom: -5px;">
                                                <?=$_SESSION['currentUser']->username?>
                                            </a>
                                            <ul class="menu">
                                                <li><a href="<?=$APP_PATH?>/game_new.php">Neues Spiel anlegen</a></li>
                                                <li><a href="<?=$APP_PATH?>/common/fb_logout.php">Logout</a></li>
                                            </ul>
                                        </li>
                                    <?php } ?>
                                    <li><input name="gamename" type="search" placeholder="Spielenamen" class="game-input"></li>
                                    <li><input type="submit" class="button" value="suchen"></li>
                                </ul>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>