<?php
// показывать или нет выполненные задачи
	$show_complete_tasks = rand(0, 1);

	require_once('functions.php');
	require_once('data.php');
	

$page_content = include_template('main.php', ['tasks' => $tasks, 'categories' => $categories]);

$layout_content = include_template('layout.php', [
    'title' => 'Главная страница проекта',
    'content' => $page_content
]);

print($layout_content);
?>

