<?php

include "assets/filesystem.php";

$user = $_GET['user'];

$files = json_decode(read_file("users/$user.json"), true);

$path = $_GET['path'] ?? 'root';

$finalDir = $files;

foreach (explode(',', $path) as $dir) {
    $finalDir = $finalDir[$dir];
}

return $finalDir;