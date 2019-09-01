<?php
require_once('helpers.php');
require_once('funcs.php');
require_once('init.php');

if (!$link) {
    $error = mysqli_connect_error();
    $content = include_template('error.php', ['error' => $error]);
}





$page_content = include_template('main.php', ['tasks' => $tasks, 'categories' => $categories, 'projects_id' => $projects_id]);

$layout_content = include_template('layout.php', [
    'title' => 'Добавить задачу',
    'content' => $page_content
]);

print($layout_content);

?>