<?php
/**
 * Created by PhpStorm.
 * User: Thomas Siller
 * Zweck: MMP1
 * Studiengang: MultiMediaTechnology
 * 2016, Fachhochschule Salzburg
 */
require_once __DIR__ . '/config.php';

function validateNumber($number){
    if(isset($number)) return filter_var($number, FILTER_VALIDATE_INT);
    else return null;
}

function validateString($string){
    if(isset($string)) return htmlspecialchars($string);
    else return null;
}

function validateHTMLInput($string) {
    //remove all unallowed Tags
    $allowedTags = '<p><br><ul><ol><li><h4><h5><h6><strong><em><blockquote><span><pre><sup><code>';
    return strip_tags($string, $allowedTags);
}

function validateArray($array){
    if(isset($array)) {
        $array = array_map("unserialize", array_unique(array_map("serialize", $array))); //remove all duplicates
        foreach ($array as $key => $item) {
            //validate every Array item
            if (!validateNumber($item['id'])) {
                unset($array[$key]);
            }
        }
        return $array;
    } else {
        return array();
    }
}

function validateGameInput($gamename, $description, $recommended_age,$min_player_count, $max_player_count, $average_playtime) {
    $errors = array();
    if(strlen($gamename)>100) $errors[] = 'gamename to long';
    if ($gamename == null) $errors[] = 'name is required';
    if ($description == null) $errors[] = 'description is required';
    if ($recommended_age == null) $errors[] = 'recommended_age is required';
    if ($min_player_count < 2) $errors[] = 'min_player_count must be bigger than 2';
    if($min_player_count > $max_player_count) $errors[] = 'min_player_count must be smaller than max_player_count';
    if ($min_player_count == null) $errors[] = 'min_player_count is required';
    if ($average_playtime == null) $errors[] = 'average_playtime is required';
    return $errors;
}

function validateCurrentUser(){
    //validate if user is logged in
    global $APP_URL;
    if(!isset($_SESSION['currentUser'])) {
        header('Location: '.$APP_URL.'/error/401.php');
        exit;
    } else {
        return $_SESSION['currentUser'];
    }
}