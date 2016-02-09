<?php

$days = 30;
$dir = "i/";
 
$nofiles = 0;
 
    if ($handle = opendir($dir)) {
    while (( $file = readdir($handle)) !== false ) {
        if ( $file == '.' || $file == '..' || $file == '.htaccess' || is_dir($dir.'/'.$file) ) {
            continue;
        }
 
        if ((time() - filemtime($dir.'/'.$file)) > ($days *84600)) {
            $nofiles++;
            unlink($dir.'/'.$file);
        }
    }
    closedir($handle);
}

require_once(__DIR__ . '/protected/config/config.php');

if ( ! isset($_POST['password']) || $_POST['password'] !== PASSKEY) {
    die("error,e-401");
}

if ( ! ((filesize($_FILES['file']['tmp_name'])) && $_FILES['file']['type'] == "image/png" || $_FILES['file']['type'] == "image/jpeg" || $_FILES['file']['type'] == "image/gif" || $_FILES['file']['type'] == "video/mp4" ||  $_FILES['file']['type'] == "video/webm")) {
    die("error,e-418");
}

if ($_FILES['file']['error'] > 0) {
    die("error,e-503");
}

$dir = __DIR__ . '/i/';

saveImage($_FILES['file']['type'], $_FILES['file']['tmp_name']);

function generateNewHash($type)
{
    $an = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
    $str = "";

    for ($i = 0; $i < 8; $i++) {
        $str .= substr($an, rand(0, strlen($an) - 1), 1);
    }

    if ( ! file_exists(__DIR__ . "/images/$str")) {
        return $str;
    } else {
        return generateNewHash($type);
    }
}

function saveImage($mimeType, $tempName)
{
    global $dir;

    switch ($mimeType) {
        case "image/png":   $type = "png"; break;
        case "image/jpeg":  $type = "jpg"; break;
        case "image/jpg":   $type = "jpg"; break;
        case "image/gif":   $type = "gif"; break;
        case "video/mp4":   $type = "mp4"; break;
        case "video/webm":  $type = "webm"; break;

        default: die("error,e-418");
    }

    $hash = generateNewHash($type);

    if (move_uploaded_file($tempName, $dir . "/$hash.$type")) {
        die("success," . (RAW_IMAGE_LINK ? $dir . "/i/$hash.$type" : ($type == "png" ? "" :  "") .  "$hash" . "." . "$type"));
    }

    die("error,e-503");
}

