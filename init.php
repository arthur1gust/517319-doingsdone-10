<?php
session_start();
require_once('functions.php');
$db = require_once('config/db.php');

//$link = mysqli_connect("localhost", "root", "", "Doingsdone");
$link = mysqli_connect($db['host'], $db['user'], $db['password'], $db['database']);
mysqli_set_charset($link, "utf8");

$categories = [];
$content = '';
?>