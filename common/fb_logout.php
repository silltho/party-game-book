<?php
/**
 * Created by PhpStorm.
 * User: Thomas Siller
 * Zweck: MMP1
 * Studiengang: MultiMediaTechnology
 * 2016, Fachhochschule Salzburg
 */
require_once __DIR__ . '/config.php';
if(!session_id()) {
    session_start();
}
session_destroy();
header('Location: '.$APP_URL);
