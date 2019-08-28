<?php
$db = require_once 'config/db.php';

$link = mysqli_connect($db['localhost'], $db['root'], $db[''], $db['Doingsdone']);
mysqli_set_charset($link, "utf8");

?>