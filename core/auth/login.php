<?php 

include "../assets/filesystem.php";

$username = $_POST['username'];
$password = $_POST['password'];

$users = json_decode(read_file('users.json'), true);

$user = $users[$username];

if (empty($user)) {
    // code
    exit;
}

if ($user['password'] == $password) {
    header("Location: /view/home.php?user=$username");
    exit;
} else {
    // code
    exit;
}

