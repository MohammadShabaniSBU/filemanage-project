<?php

include "../assets/filesystem.php";

$user = $_POST['user'];
$path = $_POST['path'];
$dirname = $_POST['dirname'];

if (empty($path)) {
    // code
    exit;
}

if (empty($dirname)) {
    // code 
    exit;
}

$files = json_decode(read_file("users/$user.json"), true);

function addDirToFiles(&$files, $path, $dirname) {

    if ($path == '') {
        $files[$dirname] = [];
        return;
    }

    $path = explode(',', $path);

   
    $tmp = $path[0];
    unset($path[0]);

    addDirToFiles($files[$tmp], implode(',', $path), $dirname);
}

addDirToFiles($files, $path, $dirname);
write_file("users/$user.json", json_encode($files));

header("Location: /view/home.php?user=$user&path=$path");