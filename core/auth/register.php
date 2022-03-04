<?php

include "../assets/filesystem.php";

$name = $_POST['name'];
$username = $_POST['username'];
$password = $_POST['password'];

$user = compact('name', 'username', 'password');

$users = json_decode(read_file('users.json'), true);

$users[$username] = $user;

write_file('users.json', json_encode($users));
make_json_file("/users/$username.json");

header("Location: /view/home.php?user=$username");