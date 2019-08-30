<?php
// показывать или нет выполненные задачи
	$show_complete_tasks = rand(0, 1);

	require_once('functions.php');
	require_once('data.php');
	require_once('init.php');
	
	
if (!$link) {
    $error = mysqli_connect_error();
    $content = include_template('error.php', ['error' => $error]);
}
else {
	// Получаем список проектов
	$sql_projects = 'select `id`, `title` FROM projects';

	//Выполняем запрос
	$result = mysqli_query($link, $sql_projects);
	
	if ($result) {
		$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);	
	}
	else {
		$error = mysqli_error($link);
		$content = include_template('error.php', ['error' => $error]);
	}
}
	

$page_content = include_template('main.php', ['tasks' => $tasks, 'categories' => $categories]);

$layout_content = include_template('layout.php', [
    'title' => 'Главная страница проекта',
    'content' => $page_content
]);

print($layout_content);
?>

