<?php

include "../assets/filesystem.php";
include "../assets/str.php";

$user = $_POST['user'];
$path = trim($_POST['path'], ',');
$filename = $_POST['filename'];
$uploaded_file = $_FILES['file'];

if (empty($path)) {
    // code
    exit;
}

if (empty($filename)) {
    // code 
    exit;
}

if (empty($uploaded_file)) {
    // code 
    exit;
}


$fakename = str_random(30);

$file = [
    'name' => $filename,
    'path' => "files/$fakename",
    'size' => $uploaded_file['size'],
    'type' => explode('/', $uploaded_file['type'])[1], 
];

$files = json_decode(read_file("users/$user.json"), true);

// path = root/dir1/dir2
// path = dir1/dir2
// path = dir2
// path = '' 

function addToJson(&$files, $path, $file) {
    if ($path == '') {
        $files[$file['name']] = $file;
        return;
    }

    $path = explode(',', $path);
    addToJson($files[$path[0]], implode(',', array_slice($path, 1)), $file);
}

addToJson($files, $path, $file);


write_file("users/$user.json", json_encode($files));
save_uploaded($uploaded_file, "files/$fakename");

header("Location: /view/home.php?user=$user&path=$path");